<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Campaigns</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Manage Campaigns</h2>
    <table class="table table-striped" id="campaign-table">
        <thead>
        <tr>
            <th>Campaign ID</th>
            <th>User</th>
            <th>Title</th>
            <th>Goal Amount</th>
            <th>Funds Raised</th>
            <th>Donors</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $conn = new mysqli("localhost", "root", "", "fundarising_platform");
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

        $query = "SELECT campaigns.campaign_id, users.first_name AS user, campaigns.title, 
                         campaigns.goal_amount, campaigns.current_amount, 
                         (SELECT COUNT(*) FROM donations WHERE donations.campaign_id = campaigns.campaign_id) AS donors, 
                         campaigns.created_at AS start_date, campaigns.deadline, campaigns.status
                  FROM campaigns
                  JOIN users ON campaigns.user_id = users.user_id";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr data-id='{$row['campaign_id']}'>
                        <td>{$row['campaign_id']}</td>
                        <td>{$row['user']}</td>
                        <td>{$row['title']}</td>
                        <td>$" . number_format($row['goal_amount'], 2) . "</td>
                        <td>$" . number_format($row['current_amount'], 2) . "</td>
                        <td>{$row['donors']}</td>
                        <td>{$row['start_date']}</td>
                        <td>{$row['deadline']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <button class='btn btn-sm btn-primary edit-btn'>Edit</button>
                            <button class='btn btn-sm btn-danger delete-btn'>Delete</button>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No campaigns found.</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Edit Form -->
    <div id="edit-form" class="mt-4" style="display: none;">
        <h4>Edit Campaign</h4>
        <form id="edit-campaign-form">
            <input type="hidden" name="campaign_id" id="campaign_id">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="goal_amount">Goal Amount</label>
                <input type="number" class="form-control" id="goal_amount" name="goal_amount" required>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date" class="form-control" id="deadline" name="deadline" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Active">Active</option>
                    <option value="Completed">Completed</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save Changes</button>
        </form>
    </div>
</div>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/datatables/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#campaign-table').DataTable();

        // Open Edit Form
        $('.edit-btn').on('click', function () {
            const row = $(this).closest('tr');
            $('#campaign_id').val(row.data('id'));
            $('#title').val(row.find('td:eq(2)').text());
            $('#goal_amount').val(row.find('td:eq(3)').text().replace('$', '').replace(',', ''));
            $('#deadline').val(row.find('td:eq(7)').text());
            $('#status').val(row.find('td:eq(8)').text());
            $('#edit-form').show();
            $('html, body').animate({ scrollTop: $('#edit-form').offset().top }, 'slow');
        });

        // Submit Edit Form
        $('#edit-campaign-form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '',
                method: 'POST',
                data: $(this).serialize() + '&action=edit',
                success: function (response) {
                    if (response.success) {
                        const row = $('tr[data-id="' + response.data.campaign_id + '"]');
                        row.find('td:eq(2)').text(response.data.title);
                        row.find('td:eq(3)').text('$' + parseFloat(response.data.goal_amount).toFixed(2));
                        row.find('td:eq(7)').text(response.data.deadline);
                        row.find('td:eq(8)').text(response.data.status);
                        alert('Campaign updated successfully!');
                        $('#edit-form').hide();
                    } else {
                        alert('Campaign updated successfully, please head to add campaign page');
                    }
                },
                error: function () {
                    alert('Failed to process your request.');
                }
            });
        });

        // Delete Campaign
        $('.delete-btn').on('click', function () {
            const row = $(this).closest('tr');
            const campaign_id = row.data('id');
            if (confirm('Are you sure you want to delete this campaign?')) {
                $.ajax({
                    url: '',
                    method: 'POST',
                    data: { action: 'delete', campaign_id: campaign_id },
                    success: function (response) {
                        if (response.success) {
                            row.remove();
                            alert('Campaign deleted successfully!');
                        } else {
                            alert('Campaign deleted successfully, please head to add campaign page');
                        }
                    }
                });
            }
        });
    });
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $conn = new mysqli("localhost", "root", "", "fundarising_platform");

    if ($conn->connect_error) die(json_encode(['success' => false, 'message' => 'Database connection failed.']));

    if ($_POST['action'] === 'edit') {
        $id = $_POST['campaign_id'];
        $title = $_POST['title'];
        $goal = $_POST['goal_amount'];
        $deadline = $_POST['deadline'];
        $status = $_POST['status'];

        $stmt = $conn->prepare("UPDATE campaigns SET title=?, goal_amount=?, deadline=?, status=? WHERE campaign_id=?");
        $stmt->bind_param("sdssi", $title, $goal, $deadline, $status, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'data' => compact('id', 'title', 'goal', 'deadline', 'status')]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Campaign updated successfully, please head to add campaign page']);
        }
    }

    if ($_POST['action'] === 'delete') {
        $id = $_POST['campaign_id'];
        if ($conn->query("DELETE FROM campaigns WHERE campaign_id=$id")) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Campaign updated successfully, please head to add campaign page']);
        }
    }
    $conn->close();
    exit();
}
?>
</body>
</html>
