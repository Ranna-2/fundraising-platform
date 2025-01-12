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
    $donation_id = $_POST['donation_id'];
    $sql = "UPDATE donations SET status='approved' WHERE donation_id='$donation_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Donation approved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['reject'])) {
    $donation_id = $_POST['donation_id'];
    $rejection_reason = $_POST['rejection_reason'];

    // Validate rejection reason before updating
    if (!empty($rejection_reason)) {
        $sql = "UPDATE donations SET status='rejected', rejection_reason='$rejection_reason' WHERE donation_id='$donation_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Donation rejected successfully!";
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
    <title>Donation Requests | Crowdfunding Admin</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/DataTables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Donation Requests</h3>
        <div class="table-responsive">
            <table class="table table-hover" id="donation-table">
                <thead>
                    <tr>
                        <th>Donation ID</th>
                        <th>Campaign ID</th>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                        <th>Donation Date</th>
                        <th>Transfer Slip</th>
                        <th>Anonymous</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM donations WHERE status='pending'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['donation_id'] . "</td>";
                            echo "<td>" . $row['campaign_id'] . "</td>";
                            echo "<td>" . $row['user_id'] . "</td>";
                            echo "<td>" . $row['amount'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>" . $row['payment_method'] . "</td>";
                            echo "<td>" . $row['donation_date'] . "</td>";
                            echo "<td><a href='" . $row['transfer_slip'] . "' target='_blank'>View Slip</a></td>";
                            echo "<td>" . ($row['anonymous'] ? 'Yes' : 'No') . "</td>";
                            echo "<td>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='donation_id' value='" . $row['donation_id'] . "'>
                                        <button type='submit' name='approve' class='btn btn-success'>Approve</button>
                                    </form>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='donation_id' value='" . $row['donation_id'] . "'>
                                        <input type='text' name='rejection_reason' placeholder='Reason for rejection' class='form-control mb-2'>
                                        <button type='submit' name='reject' class='btn btn-danger'>Reject</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No pending donation requests found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
</body>
</html>
