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
        campaigns.picture,
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
        /* Basic Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(45deg, #01383e, #c69595);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
        }

        .program-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
            text-align: center;
        }
        /* Donation Tracker Progress Bar */
.progress-container {
    width: 80%; /* Reduced width */
    height: 8px;
    background-color: #f0f0f0;
    border-radius: 5px;
    margin-bottom: 10px;
    margin-left: auto; /* Center the progress bar */
    margin-right: auto; /* Center the progress bar */
}

.progress-bar {
    height: 100%;
    background-color: #38f05f;
    width: 60%; /* Adjust as needed */
    border-radius: 5px;
}

/* Donate Button */
.donate-btn {
    display: inline-block;
    background-color: #38f05f;
    color: white;
    padding: 8px 15px; /* Reduced padding */
    border-radius: 5px;
    text-decoration: none;
    margin-top: 10px;
    font-size: 14px; /* Reduced font size */
    width: auto; /* Let the button width adjust based on content */
    max-width: 200px; /* Set a max width to avoid it getting too long */
    text-align: center;
    margin-left: auto;
    margin-right: auto;
}

    </style>
</head>
<body>
    <div class="sidenav">
        <h2 style="text-align: center; color: #38f05f;"><b>Campaigns</b></h2>
        <a href="healthcare.php">Healthcare</a>
        <a href="education.php">Education</a>
        <a href="animals.php">Animals</a>
        <a href="environment.php">Environment</a>
        <a href="hunger_relief.php">Hunger Relief</a>
        <!-- Add more links as needed -->
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
                    ?>

                    <div class="program-card">
                        <img src="<?php echo htmlspecialchars($row['picture']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <div class="card-content">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                            <div class="progress-container">
                                <div class="progress-bar" style="width: <?php echo round($progress); ?>%;"></div>
                            </div>
                            <p><?php echo round($progress); ?>% funded</p>
                            <a href="../donation.html" class="donate-btn">Donate Now</a>
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
