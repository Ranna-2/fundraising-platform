<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "fundarising_platform");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch campaign and donation data for 'Mental Health'
$sql = "
    SELECT 
        campaigns.campaign_id,
        campaigns.title,
        campaigns.goal_amount,
        campaigns.description,
        IFNULL(SUM(donations.amount), 0) AS total_donations
    FROM campaigns
    LEFT JOIN donations ON campaigns.campaign_id = donations.campaign_id
    WHERE campaigns.campaign_type = 'Mental Health'
    GROUP BY campaigns.campaign_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Programs</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles1.css">
    <style>
        header {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(45deg, #01383e, #6be9cf);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .progress-container {
            width: 80%;
            height: 8px;
            background-color: #f0f0f0;
            border-radius: 5px;
            margin-bottom: 10px;
            margin-left: auto;
            margin-right: auto;
        }

        .progress-bar {
            height: 100%;
            background-color: #38f05f;
            border-radius: 5px;
        }

        .donate-btn {
            display: inline-block;
            background-color: #38f05f;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <!-- Side Navigation Bar -->
    <div class="sidenav">
        <h2 style="text-align: center; color: #38f05f;"><b>Campaigns</b></h2>
        <a href="index.html" class="filter-btn" data-filter="all"><i class="fas fa-th-list"></i> All</a>
        <a href="healthcare.php"><i class="fas fa-heartbeat"></i> Healthcare</a>
        <a href="education.php"><i class="fas fa-book"></i> Education</a>
        <a href="animal.php"><i class="fas fa-paw"></i> Animals</a>
        <a href="environment.php"><i class="fas fa-leaf"></i> Environment</a>
        <a href="hunger.php"><i class="fas fa-utensils"></i> Hunger Relief</a>
        <a href="cleanwater.php"><i class="fas fa-water"></i> Clean Water</a>
        <a href="disasterrelief.php"><i class="fas fa-hands-helping"></i> Disaster Relief</a>
        <a href="mentalhealth.php"><i class="fas fa-brain"></i> Mental Health</a>
        <a href="refugees.php"><i class="fas fa-user-shield"></i> Refugee Support</a>
    </div>

    <!-- Header -->
    <div class="content">
        <header>
            <h1>Mental Health Programs</h1>
            <p>Join us in supporting mental health initiatives aimed at fostering well-being and providing support to those in need.</p>
        </header>

        <!-- Programs Section -->
        <div class="programs-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Calculate progress
                    $progress = ($row['total_donations'] / $row['goal_amount']) * 100;
                    $progress = min($progress, 100); // Cap at 100%
                    ?>
                    <div class="program-card">
                        <div class="card-content">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                            <div class="progress-container">
                                <div class="progress-bar" style="width: <?php echo round($progress); ?>%;"></div>
                            </div>
                            <p><?php echo round($progress); ?>% funded</p>
                            <a href="../donation.php" class="donate-btn">Donate Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No campaigns found.</p>";
            }
            $conn->close();
            ?>
        </div>

        <!-- Footer -->
        <footer>
            &copy; 2024 KindledHope. All Rights Reserved.
        </footer>
    </div>
</body>

</html>
