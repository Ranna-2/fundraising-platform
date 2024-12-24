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
                                    <!-- Add campaign data here -->
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
