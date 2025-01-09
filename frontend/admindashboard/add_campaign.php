<?php
// Include database connection
$host = 'localhost';
$dbname = 'fundarising_platform'; // Correct database name
$username = 'root';
$password = '';

// Create the connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Initialize variables
$campaign_id = $title = $goal_amount = $description = $deadline = $status = "";
$error_message = $success_message = "";

// Function to sanitize input
function sanitize_input($input)
{
    return htmlspecialchars(stripslashes(trim($input)));
}

// Check if form is submitted to search campaign by ID
if (isset($_POST['search_campaign'])) {
    $campaign_id = sanitize_input($_POST['campaign_id']);

    if (filter_var($campaign_id, FILTER_VALIDATE_INT)) {
        // Fetch campaign details by ID
        $sql = "SELECT * FROM campaigns WHERE campaign_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $campaign_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Populate form with data
            $campaign = $result->fetch_assoc();
            $title = $campaign['title'];
            $goal_amount = $campaign['goal_amount'];
            $description = $campaign['description'];
            $deadline = $campaign['deadline'];
            $status = $campaign['status'];
        } else {
            $error_message = "Campaign ID not found!";
        }
    } else {
        $error_message = "Invalid Campaign ID!";
    }
}

// Handle insert or update
if (isset($_POST['submit'])) {
    $title = sanitize_input($_POST['title']);
    $goal_amount = sanitize_input($_POST['goal_amount']);
    $description = sanitize_input($_POST['description']);
    $deadline = sanitize_input($_POST['deadline']);
    $status = sanitize_input($_POST['status']);
    $user_id = 1; // Replace with session variable for logged-in user

    if (isset($_POST['update_campaign'])) {
        // Update campaign
        $campaign_id = sanitize_input($_POST['campaign_id']);
        if (filter_var($campaign_id, FILTER_VALIDATE_INT)) {
            $sql = "UPDATE campaigns 
                    SET title = ?, goal_amount = ?, description = ?, deadline = ?, status = ?, updated_at = NOW() 
                    WHERE campaign_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdsssi", $title, $goal_amount, $description, $deadline, $status, $campaign_id);
        } else {
            $error_message = "Invalid Campaign ID!";
        }
    } else {
        // Insert campaign
        $sql = "INSERT INTO campaigns (user_id, title, goal_amount, description, deadline, status, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isdssi", $user_id, $title, $goal_amount, $description, $deadline, $status);
    }

    if (isset($stmt) && $stmt->execute()) {
        $success_message = isset($_POST['update_campaign']) ? "Campaign updated successfully!" : "Campaign added successfully!";
        $campaign_id = $title = $goal_amount = $description = $deadline = $status = ""; // Reset fields
    } else {
        $error_message = "Error: " . $stmt->error;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Campaign | Crowdfunding Admin</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <?php include 'sidebar.html'; ?>
    <div id="body" class="active">
        <?php include 'header.html'; ?>
        <div class="content">
            <div class="container">
                <h3>Add Campaign</h3>

                <?php if ($error_message) : ?>
                    <div class="alert alert-danger"><?= $error_message; ?></div>
                <?php elseif ($success_message) : ?>
                    <div class="alert alert-success"><?= $success_message; ?></div>
                <?php endif; ?>

                <form method="POST" action="add_campaign.php">
    <div class="form-group">
        <label for="campaign_id">Campaign ID</label>
        <input type="text" class="form-control" id="campaign_id" name="campaign_id" value="<?= $campaign_id ?>">
        <button type="submit" class="btn btn-primary mt-2" name="search_campaign">Search</button>
    </div>

    <div class="form-group">
        <label for="title">Campaign Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $title ?>" <?= isset($_POST['search_campaign']) ? '' : 'required' ?>>
    </div>

    <div class="form-group">
        <label for="goal_amount">Goal Amount</label>
        <input type="number" class="form-control" id="goal_amount" name="goal_amount" value="<?= $goal_amount ?>" <?= isset($_POST['search_campaign']) ? '' : 'required' ?>>
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

    <!-- Submit buttons -->
    <button type="submit" class="btn btn-success" name="update_campaign">Update Campaign</button>
    <button type="submit" class="btn btn-primary" name="submit">Save Campaign</button>
</form>

            </div>
        </div>
    </div>
</div>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
