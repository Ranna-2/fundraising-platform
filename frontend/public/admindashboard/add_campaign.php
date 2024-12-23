<?php
// Include database connection
$host = 'localhost';
$dbname = 'fundarising_platform';  // Ensure the correct database name
$username = 'root';
$password = '';

// Create the connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variables to hold campaign data
$campaign_id = $title = $goal_amount = $description = $deadline = $status = "";
$error_message = "";

// Check if form is submitted to search campaign by ID
if (isset($_POST['search_campaign'])) {
    $campaign_id = $_POST['campaign_id'];
    
    // Fetch campaign details by ID
    $sql = "SELECT * FROM campaigns WHERE campaign_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $campaign_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // If campaign found, fill form with data
        $campaign = $result->fetch_assoc();
        $title = $campaign['title'];
        $goal_amount = $campaign['goal_amount'];
        $description = $campaign['description'];
        $deadline = $campaign['deadline'];
        $status = $campaign['status'];
    } else {
        // Show invalid ID message
        $error_message = "Campaign ID not found!";
    }
}

// Handle campaign insert or update
if (isset($_POST['submit']) && !isset($_POST['search_campaign'])) { // Only handle insert/update if it's not a search
    $user_id = 1; // Hardcoded for now, you can replace it with session variable for logged-in user
    $title = $_POST['title'];
    $goal_amount = $_POST['goal_amount'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    // Insert or update logic
    if (isset($_POST['update_campaign'])) {
        // Update existing campaign logic (if campaign_id is passed)
        $campaign_id = $_POST['campaign_id'];
        $sql = "UPDATE campaigns SET title = ?, goal_amount = ?, description = ?, deadline = ?, status = ?, updated_at = NOW() WHERE campaign_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdsssi", $title, $goal_amount, $description, $deadline, $status, $campaign_id);
    } else {
        // Insert new campaign
        $sql = "INSERT INTO campaigns (user_id, title, goal_amount, description, deadline, status, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isdssi", $user_id, $title, $goal_amount, $description, $deadline, $status);
    }

    if ($stmt->execute()) {
        echo "Campaign " . (isset($_POST['update_campaign']) ? "updated" : "added") . " successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Campaign | Crowdfunding Admin</title>
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
                        <h3>Add Campaign</h3>
                    </div>

                    <!-- Display error message if campaign ID is not found -->
                    <?php if (isset($error_message)) { echo "<div class='alert alert-danger'>$error_message</div>"; } ?>

                    <form method="POST" action="add_campaign.php">
                        <div class="form-group">
                            <label for="campaign_id">Campaign ID</label>
                            <input type="text" class="form-control" id="campaign_id" name="campaign_id" value="<?= $campaign_id ?>" required>
                            <button type="submit" class="btn btn-primary mt-2" name="search_campaign">Search</button>
                        </div>

                        <div class="form-group">
                            <label for="title">Campaign Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= $title ?>" <?= isset($_POST['search_campaign']) ? '' : 'required' ?>>
                        </div>
                        <div class="form-group">
                            <label for="goal_amount">Goal Amount</label>
                            <input type="number" class="form-control" id="goal_amount" name="goal_amount" value="<?= $goal_amount ?>" step="0.01" <?= isset($_POST['search_campaign']) ? '' : 'required' ?>>
                        </div>
                        <div class="form-group">
                            <label for="description">Campaign Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" <?= isset($_POST['search_campaign']) ? '' : 'required' ?>><?= $description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="deadline">Campaign Deadline</label>
                            <input type="date" class="form-control" id="deadline" name="deadline" value="<?= $deadline ?>" <?= isset($_POST['search_campaign']) ? '' : 'required' ?>>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" <?= isset($_POST['search_campaign']) ? '' : 'required' ?>>
                                <option value="Active" <?= $status == 'Active' ? 'selected' : '' ?>>Active</option>
                                <option value="Completed" <?= $status == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                <option value="Pending" <?= $status == 'Pending' ? 'selected' : '' ?>>Pending</option>
                            </select>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-success" name="update_campaign">Update Campaign</button>
                        <button type="submit" class="btn btn-primary" name="submit">Save Campaign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
