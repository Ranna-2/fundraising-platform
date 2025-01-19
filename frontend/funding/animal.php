<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "fundarising_platform");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch campaign and donation data for 'Animals'
$sql = "
    SELECT 
        campaigns.campaign_id,
        campaigns.title,
        campaigns.goal_amount,
        campaigns.description,
        IFNULL(SUM(donations.amount), 0) AS total_donations
    FROM campaigns
    LEFT JOIN donations ON campaigns.campaign_id = donations.campaign_id
    WHERE campaigns.campaign_type = 'Animals'
    GROUP BY campaigns.campaign_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Welfare Programs</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles1.css">
    <style>
   body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidenav {
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #2a2a2a;
            color: white;
            padding-top: 20px;
        }

        .sidenav a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            text-align: center;
        }

        .sidenav a:hover {
            background-color: #575757;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }

        header {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(45deg, #01383e, #6be9cf);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .programs-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .program-card {
            width: calc(33% - 20px);
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            padding: 15px;
        }

        .card-content {
            text-align: center;
        }

        .progress-container {
            width: 80%;
            height: 8px;
            background-color: #f0f0f0;
            border-radius: 5px;
            margin: 10px auto;
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
            font-size: 14px;
            margin-top: 10px;
        }

        footer {
            text-align: center;
            padding: 1rem;
            margin-top: 20px;
            background-color: #2a2a2a;
            color: white;
        }
    </style>
</head>
<body>
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

    <div class="content">
        <header>
            <h1>Animal Welfare Programs</h1>
            <p>Protecting and improving the lives of animals around the world.</p>
        </header>

        <!-- Programs Section -->
        <div class="programs-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Calculate progress
                    $progress = ($row['total_donations'] / $row['goal_amount']) * 100;
                    $progress = min($progress, 100); // Cap at 100%

                    // Display the campaign card
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
