<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fundarising_platform";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle approval or rejection
if (isset($_POST['approve'])) {
    $campaign_id = $_POST['campaign_id'];
    $sql = "UPDATE campaigns SET status='approved' WHERE campaign_id='$campaign_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Campaign approved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['reject'])) {
    $campaign_id = $_POST['campaign_id'];
    $rejection_reason = $_POST['rejection_reason'];

    // Validate rejection reason before updating
    if (!empty($rejection_reason)) {
        $sql = "UPDATE campaigns SET status='rejected', rejection_reason='$rejection_reason' WHERE campaign_id='$campaign_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Campaign rejected successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Rejection reason is required!";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Campaign Requests | Crowdfunding Admin</title>
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
                        <h3>Campaign Requests</h3>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <table width="100%" class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Campaign Details</th>
                                        <th>Campaign Category</th>
                                        <th>Beneficiary</th>
                                        <th>Goal</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Title & Story</th>
                                        <th>Proof</th>
                                        <th>Bank Account Details</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM campaigns WHERE status='pending'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td>General</td>"; // Assuming a default category for now
                                            echo "<td>" . $row['user_id'] . "</td>";
                                            echo "<td>" . $row['goal_amount'] . "</td>";
                                            echo "<td>" . $row['created_at'] . "</td>";
                                            echo "<td>" . $row['deadline'] . "</td>";
                                            echo "<td>" . $row['title'] . "</td>";
                                            echo "<td>Proof Placeholder</td>"; // Replace with actual proof data
                                            echo "<td>Bank Account Placeholder</td>"; // Replace with actual bank details

                                            echo "<td>
                                                    <form method='POST' action=''>
                                                        <input type='hidden' name='campaign_id' value='" . $row['campaign_id'] . "'>
                                                        <button type='submit' name='approve' class='btn btn-success'>Approve</button>
                                                    </form>
                                                    <form method='POST' action=''>
                                                        <input type='hidden' name='campaign_id' value='" . $row['campaign_id'] . "'>
                                                        <input type='text' name='rejection_reason' placeholder='Reason for rejection' class='form-control mb-2'>
                                                        <button type='submit' name='reject' class='btn btn-danger'>Reject</button>
                                                    </form>
                                                  </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='10'>No campaign requests found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
