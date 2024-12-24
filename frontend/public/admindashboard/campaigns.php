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
                            <table width="100%" class="table table-hover" id="dataTables-example">
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
                                    $conn = new mysqli('localhost', 'root', '', 'fundarising_platform');

                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Query to fetch campaigns and related donation stats
                                    $sql = "
                                        SELECT 
                                            c.campaign_id,
                                            u.name AS user_name,
                                            c.title,
                                            c.goal_amount,
                                            c.current_amount,
                                            c.created_at AS start_date,
                                            c.deadline AS end_date,
                                            c.status,
                                            COUNT(d.donation_id) AS donor_count
                                        FROM 
                                            campaign c
                                        LEFT JOIN 
                                            users u ON c.user_id = u.user_id
                                        LEFT JOIN 
                                            donation d ON c.campaign_id = d.campaign_id
                                        GROUP BY 
                                            c.campaign_id
                                        ORDER BY 
                                            c.created_at DESC
                                    ";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr data-id='{$row['campaign_id']}'>
                                                <td>{$row['campaign_id']}</td>
                                                <td>{$row['user_name']}</td>
                                                <td>{$row['title']}</td>
                                                <td>{$row['goal_amount']}</td>
                                                <td>{$row['current_amount']}</td>
                                                <td>{$row['donor_count']}</td>
                                                <td>{$row['start_date']}</td>
                                                <td>{$row['end_date']}</td>
                                                <td>{$row['status']}</td>
                                                <td>
                                                    <button class='btn btn-primary btn-sm edit-btn'>Edit</button>
                                                </td>
                                            </tr>";
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
                        <form action="update_campaign.php" method="POST">
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
    <script src="assets/js/initiate-datatables.js"></script>
    <script>
        $(document).ready(function () {
            $('.edit-btn').on('click', function () {
                const row = $(this).closest('tr');
                const id = row.data('id');
                const title = row.find('td:eq(2)').text();
                const goal = row.find('td:eq(3)').text();
                const deadline = row.find('td:eq(7)').text();
                const status = row.find('td:eq(8)').text();

                $('#campaign_id').val(id);
                $('#title').val(title);
                $('#goal_amount').val(goal);
                $('#deadline').val(deadline);
                $('#status').val(status);

                $('#edit-campaign-form').show();
            });
        });
    </script>
</body>
</html>
