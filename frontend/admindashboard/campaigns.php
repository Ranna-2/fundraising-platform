<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Campaigns | Crowdfunding Admin</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/DataTables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.html'; ?>
        <div id="body" class="active">
            <!-- Header -->
            <?php include 'header.html'; ?>
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Campaigns</h3>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <table class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Campaign ID</th>
                                        <th>User</th>
                                        <th>Title</th>
                                        <th>Goal</th>
                                        <th>Funds Raised</th>
                                        <th>Number of Donors</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Database connection
                                    $conn = new mysqli("localhost", "root", "", "fundarising_platform");
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    $sql = "
                                        SELECT 
                                            campaigns.campaign_id, 
                                            users.first_name AS user, 
                                            campaigns.title, 
                                            campaigns.goal_amount, 
                                            campaigns.current_amount, 
                                            (SELECT COUNT(*) FROM donations WHERE donations.campaign_id = campaigns.campaign_id) AS donors, 
                                            campaigns.created_at AS start_date, 
                                            campaigns.deadline, 
                                            campaigns.status 
                                        FROM campaigns 
                                        JOIN users ON campaigns.user_id = users.user_id";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr data-id='" . $row['campaign_id'] . "'>";
                                            echo "<td>" . htmlspecialchars($row['campaign_id']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['user']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                            echo "<td>$" . number_format($row['goal_amount'], 2) . "</td>";
                                            echo "<td>$" . number_format($row['current_amount'], 2) . "</td>";
                                            echo "<td>" . $row['donors'] . "</td>";
                                            echo "<td>" . $row['start_date'] . "</td>";
                                            echo "<td>" . $row['deadline'] . "</td>";
                                            echo "<td>" . ucfirst($row['status']) . "</td>";
                                            echo "<td>
                                                    <button class='btn btn-sm btn-primary edit-btn'>Edit</button>
                                                  </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='10'>No campaigns found.</td></tr>";
                                    }

                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Edit Campaign Form -->
                    <div id="edit-campaign-form" class="mt-4" style="display: none;">
                        <h4>Edit Campaign</h4>
                        <form id="ajax-edit-form">
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
                                <select class="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable();

            // Handle Edit button click
            $('.edit-btn').on('click', function () {
                const row = $(this).closest('tr');
                const id = row.data('id');
                const title = row.find('td:eq(2)').text();
                const goal = row.find('td:eq(3)').text().replace('$', '').replace(',', '');
                const deadline = row.find('td:eq(7)').text();
                const status = row.find('td:eq(8)').text();

                $('#campaign_id').val(id);
                $('#title').val(title);
                $('#goal_amount').val(goal);
                $('#deadline').val(deadline);
                $('#status').val(status.toLowerCase());

                $('#edit-campaign-form').show();
                $('html, body').animate({ scrollTop: $('#edit-campaign-form').offset().top }, 'slow');
            });

            // Handle form submission with AJAX
            $('#ajax-edit-form').on('submit', function (e) {
                e.preventDefault();

                const formData = $(this).serialize();

                $.ajax({
                    url: '', // Same file
                    method: 'POST',
                    data: formData + '&ajax=1', // Add flag for AJAX requests
                    success: function (response) {
                        if (response.success) {
                            const row = $('tr[data-id="' + response.data.campaign_id + '"]');
                            row.find('td:eq(2)').text(response.data.title);
                            row.find('td:eq(3)').text('$' + parseFloat(response.data.goal_amount).toFixed(2));
                            row.find('td:eq(7)').text(response.data.deadline);
                            row.find('td:eq(8)').text(response.data.status);

                            alert('Campaign updated successfully!');
                            $('#edit-campaign-form').hide();
                        } else {
                            alert('Failed to update campaign: ' + response.message);
                        }
                    },
                    error: function () {
                        alert('An error occurred while updating the campaign.');
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php
// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    header('Content-Type: application/json');
    $conn = new mysqli("localhost", "root", "", "fundarising_platform");

    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
        exit();
    }

    $campaign_id = $_POST['campaign_id'];
    $title = $_POST['title'];
    $goal_amount = $_POST['goal_amount'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    $sql = "UPDATE campaigns 
            SET title = ?, goal_amount = ?, deadline = ?, status = ? 
            WHERE campaign_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssi", $title, $goal_amount, $deadline, $status, $campaign_id);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'data' => [
                'campaign_id' => $campaign_id,
                'title' => $title,
                'goal_amount' => $goal_amount,
                'deadline' => $deadline,
                'status' => ucfirst($status)
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update campaign.']);
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
