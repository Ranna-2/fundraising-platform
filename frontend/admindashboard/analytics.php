<?php
// Database connection
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

// Fetch analytics data
$sql = "
    SELECT 
        a.analytics_id,
        c.title AS campaign_title,
        a.donation_trends,
        a.donor_count,
        a.average_donation,
        a.total_donations,
        a.created_at
    FROM analytics a
    JOIN campaigns c ON a.campaign_id = c.campaign_id
";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Analytics & Reporting | Crowdfunding Admin</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
                    <h3>Analytics & Reporting</h3>
                </div>
                <div class="row">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($row['campaign_title']); ?></h5>
                                        <p class="card-text">
                                            <strong>Donation Trends:</strong> <?= htmlspecialchars($row['donation_trends']); ?><br>
                                            <strong>Donor Count:</strong> <?= htmlspecialchars($row['donor_count']); ?><br>
                                            <strong>Average Donation:</strong> $<?= htmlspecialchars($row['average_donation']); ?><br>
                                            <strong>Total Donations:</strong> $<?= htmlspecialchars($row['total_donations']); ?><br>
                                            <strong>Last Updated:</strong> <?= htmlspecialchars($row['created_at']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-warning">No analytics data available.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>
<?php
$conn->close();
?>
