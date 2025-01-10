<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fundarising_platform");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch donor campaigns
$donorId = 1; // Replace with the actual donor ID from session or login
$campaignsQuery = "
    SELECT c.title, c.description, c.goal_amount, c.current_amount, 
           (c.current_amount / c.goal_amount) * 100 AS progress
    FROM campaigns c
    JOIN donations d ON c.campaign_id = d.campaign_id
    WHERE d.donation_id = ?";
$campaignsStmt = $conn->prepare($campaignsQuery);
$campaignsStmt->bind_param("i", $donorId);
$campaignsStmt->execute();
$campaignsResult = $campaignsStmt->get_result();

// Fetch donation history
$donationsQuery = "
    SELECT d.donation_date, c.title AS campaign, d.amount
    FROM donations d
    JOIN campaigns c ON d.campaign_id = c.campaign_id
    WHERE d.donation_id = ?";
$donationsStmt = $conn->prepare($donationsQuery);
$donationsStmt->bind_param("i", $donorId);
$donationsStmt->execute();
$donationsResult = $donationsStmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!--Logo Image -->
        <a class="navbar-brand" href="#"><img src="logo.jpg" style="height: 20px;"></a>
        <!-- Centered Logo -->
        <h1 class="text-2xl font-extrabold text-gray-800 animate-bounce">
            <a href="#" class="hover:text-blue-600 transition duration-200">
                <span class="bg-gradient-to-r from-blue-500 to-green-500 text-transparent bg-clip-text">
                    KindledHope
                </span>
            </a>
        </h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../funding/index.html">Campaigns</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="moreDropdown">
                        <li><a class="dropdown-item" href="#">About Us</a></li>
                        <li><a class="dropdown-item" href="../HomePage/HomePage.html#how-it-works">How it Works</a></li>
                        <li><a class="dropdown-item" href="../HelpCenter/index.html">Help Center</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white" href="../Login/login.php">Donate Now</a>
                </li>
                &nbsp;
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-primary" href="../Signup/Register.php">Fundraise</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admindashboard/dashboard.html">Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container mt-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Welcome, Donor!</h2>
        <div class="row">
            <div class="col-md-8">
                <h4>Your Campaigns</h4>
                <?php if ($campaignsResult->num_rows > 0): ?>
                    <?php while ($campaign = $campaignsResult->fetch_assoc()): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($campaign['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($campaign['description']); ?></p>
                                <div class="progress mb-2">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: <?php echo round($campaign['progress'], 2); ?>%;" 
                                         aria-valuenow="<?php echo round($campaign['progress'], 2); ?>" 
                                         aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <a href="#" class="btn btn-primary">View Campaign</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>You have not donated to any campaigns yet.</p>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <h4>Your Donation History</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Campaign</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($donationsResult->num_rows > 0): ?>
                            <?php while ($donation = $donationsResult->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($donation['date']); ?></td>
                                    <td><?php echo htmlspecialchars($donation['campaign']); ?></td>
                                    <td>$<?php echo number_format($donation['amount'], 2); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No donations found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>
