<?php
// Database connection
try {
    $conn = new PDO('mysql:host=localhost;dbname=fundarising_platform', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle form submission for donation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['donate'])) {
    $transferSlip = $_FILES['transfer_slip']['name'];
    $campaignId = $_POST['campaign_id'];  // You can pass the campaign ID dynamically
    $donationAmount = $_POST['donation_amount'];  // Amount entered by user
    $anonymous = isset($_POST['anonymous']) ? 1 : 0;

    // Upload the transfer slip image to server
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($transferSlip);
    move_uploaded_file($_FILES["transfer_slip"]["tmp_name"], $targetFile);

    // Save donation data to database
    $stmt = $conn->prepare("INSERT INTO donations (campaign_id, amount, transfer_slip, anonymous, created_at) 
                            VALUES (:campaign_id, :donation_amount, :transfer_slip, :anonymous, NOW())");
    $stmt->bindParam(':campaign_id', $campaignId);
    $stmt->bindParam(':donation_amount', $donationAmount);
    $stmt->bindParam(':transfer_slip', $transferSlip);
    $stmt->bindParam(':anonymous', $anonymous);

    if ($stmt->execute()) {
        echo "<script>alert('Donation submitted successfully. Waiting for admin approval.');</script>";
    } else {
        echo "<script>alert('Error submitting your donation.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - Crowdfunding Platform</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="logo.jpg" style="height: 50px;"></a>
            <h1 class="text-2xl font-extrabold text-gray-800 animate-bounce">
                <a href="./HomePage/HomePage.html" class="hover:text-blue-600 transition duration-200">
                    <span class="bg-gradient-to-r from-blue-500 to-green-500 text-transparent bg-clip-text">KindledHope</span>
                </a>
            </h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="./HomePage/HomePage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./funding/index.html">Campaigns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white" href="./Login/login.php">Donate Now</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary" href="./Signup/signup.php">Fundraise</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Donation Form -->
    <div class="container mt-5" id="campaign-container">
        <h2 id="campaign-title">Make a Donation</h2>
        <p id="campaign-description">Thank you for supporting this cause. Please donate using the details below.</p>

        <!-- Bank Details Section -->
        <div class="container my-4 p-3 bg-white rounded shadow">
            <h5 class="text-2xl font-bold mb-2">Bank Details for Donation</h5>
            <p><strong>Bank Name:</strong> <span id="bank-name">Bank of Hope</span></p>
            <p><strong>Account Number:</strong> <span id="account-number">123-456-789</span></p>
            <p><strong>Account Name:</strong> <span id="account-name">KindledHope Charity</span></p>
            <p><strong>SWIFT Code:</strong> <span id="swift-code">BOH1234</span></p>
        </div>

        <!-- Donation Form Section -->
        <div class="container my-3 p-3 bg-white rounded shadow container-section">
            <h5 class="text-2xl font-bold mb-2">Upload Transfer Slip</h5>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="campaign_id" value="1" />  <!-- Replace with dynamic campaign ID -->
                <div class="mb-3">
                    <label class="form-label" for="donation-amount">Donation Amount</label>
                    <input class="form-control" id="donation-amount" name="donation_amount" type="number" placeholder="Enter your donation amount" required />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="transfer-slip">Transfer Slip</label>
                    <input class="form-control" id="transfer-slip" name="transfer_slip" type="file" required />
                </div>
                <div class="mb-3">
                    <label for="anonymous-donation" class="form-label">
                        <input type="checkbox" id="anonymous-donation" name="anonymous"> Donate Anonymously
                    </label>
                </div>
                   <!-- Support Section -->
        <div class="container mt-5">
            <h5>Words of Support</h5>
            <textarea class="form-control" rows="3" placeholder="Leave a message of support..."></textarea>
        </div>
    </div>
                <div class="text-center">
                    <button type="submit" name="donate" class="btn btn-primary">Submit Donation</button>
                </div>
            </form>
        </div>

     

    <!-- Admin Donation Table -->


    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3">
            © 2024 KindledHope.lk | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
