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
$campaign_id = $title = $goal_amount = $description = $deadline = $status = $campaign_type = $picture = "";
$error_message = $success_message = "";

// Function to sanitize input
function sanitize_input($input)
{
    return htmlspecialchars(stripslashes(trim($input)));
}

// Handle file upload
function upload_file($file)
{
    $target_dir = "uploads/"; // Folder to save images
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file type
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        return "Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Move uploaded file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file; // Return file path if upload succeeds
    }

    return "Failed to upload the file.";
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
            $campaign_type = $campaign['campaign_type'];
            $picture = $campaign['picture'];
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
    $campaign_type = sanitize_input($_POST['campaign_type']);
    $user_id = 1; // Replace with session variable for logged-in user

    // Handle picture upload
    $uploaded_file_path = upload_file($_FILES['picture']);
    if ($uploaded_file_path && !str_contains($uploaded_file_path, "Failed")) {
        $picture = $uploaded_file_path;
    } else {
        $error_message = $uploaded_file_path;
    }

    if (!$error_message) {
        if (isset($_POST['update_campaign'])) {
            // Update campaign
            $campaign_id = sanitize_input($_POST['campaign_id']);
            if (filter_var($campaign_id, FILTER_VALIDATE_INT)) {
                $sql = "UPDATE campaigns 
                        SET title = ?, goal_amount = ?, description = ?, deadline = ?, status = ?, campaign_type = ?, picture = ?, updated_at = NOW() 
                        WHERE campaign_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdsssssi", $title, $goal_amount, $description, $deadline, $status, $campaign_type, $picture, $campaign_id);
            } else {
                $error_message = "Invalid Campaign ID!";
            }
        } else {
            // Insert campaign
            $sql = "INSERT INTO campaigns (user_id, title, goal_amount, description, deadline, status, campaign_type, picture, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isdsssss", $user_id, $title, $goal_amount, $description, $deadline, $status, $campaign_type, $picture);
        }

        if (isset($stmt) && $stmt->execute()) {
            $success_message = isset($_POST['update_campaign']) ? "Campaign updated successfully!" : "Campaign added successfully!";
            $campaign_id = $title = $goal_amount = $description = $deadline = $status = $campaign_type = $picture = ""; // Reset fields
        } else {
            $error_message = "Error: " . $stmt->error;
        }
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

                <form method="POST" action="add_campaign.php" enctype="multipart/form-data">
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

                    <div class="form-group">
                        <label for="campaign_type">Campaign Type</label>
                        <select class="form-control" id="campaign_type" name="campaign_type" <?= isset($_POST['search_campaign']) ? '' : 'required' ?>>
                            <option value="Healthcare" <?= $campaign_type == 'Healthcare' ? 'selected' : '' ?>>Healthcare</option>
                            <option value="Education" <?= $campaign_type == 'Education' ? 'selected' : '' ?>>Education</option>
                            <option value="Animals" <?= $campaign_type == 'Animals' ? 'selected' : '' ?>>Animals</option>
                            <option value="Environment" <?= $campaign_type == 'Environment' ? 'selected' : '' ?>>Environment</option>
                            <option value="Hunger Relief" <?= $campaign_type == 'Hunger Relief' ? 'selected' : '' ?>>Hunger Relief</option>
                            <option value="Clean Water" <?= $campaign_type == 'Clean Water' ? 'selected' : '' ?>>Clean Water</option>
                            <option value
="Disaster Relief" <?= $campaign_type == 'Disaster Relief' ? 'selected' : '' ?>>Disaster Relief</option> <option value="Mental Health" <?= $campaign_type == 'Mental Health' ? 'selected' : '' ?>>Mental Health</option> <option value="Refugee Support" <?= $campaign_type == 'Refugee Support' ? 'selected' : '' ?>>Refugee Support</option> </select> </div>

                <div class="form-group">
                    <label for="picture">Upload Picture</label>
                    <input type="file" class="form-control" id="picture" name="picture" <?= isset($_POST['search_campaign']) ? '' : 'required' ?>>
                    <?php if ($picture): ?>
                        <img src="<?= $picture ?>" alt="Campaign Image" class="img-thumbnail mt-2" style="width: 150px;">
                    <?php endif; ?>
                </div>

                <!-- Submit buttons -->
                <button type="submit" class="btn btn-success" name="update_campaign">Update Campaign</button>
                <button type="submit" class="btn btn-primary" name="submit">Save Campaign</button>
            </form>
        </div>
    </div>
</div>
</div> <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> </body> </html> 