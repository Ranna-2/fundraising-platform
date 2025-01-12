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
$title = $goal_amount = $description = $deadline = $campaign_type = $error_message = $success_message = "";

// Function to sanitize input
function sanitize_input($input)
{
    return htmlspecialchars(stripslashes(trim($input)));
}

// Handle insert or update
if (isset($_POST['submit'])) {
    $title = sanitize_input($_POST['title']);
    $goal_amount = sanitize_input($_POST['goal_amount']);
    $description = sanitize_input($_POST['description']);
    $deadline = sanitize_input($_POST['deadline']);
    $campaign_type = sanitize_input($_POST['campaign_type']);
    $user_id = 1; // Replace with session variable for logged-in user

    if (!$error_message) {
        // Insert campaign
        $sql = "INSERT INTO campaigns (user_id, title, goal_amount, description, deadline, campaign_type, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isdsss", $user_id, $title, $goal_amount, $description, $deadline, $campaign_type);

        if ($stmt->execute()) {
            $success_message = "Campaign added successfully!";
            $title = $goal_amount = $description = $deadline = $campaign_type = ""; // Reset fields
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        /* Basic Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            flex-shrink: 0;
            padding: 20px 15px;
            height: 100vh;
            position: fixed;
        }

        .sidebar-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar-header h3 {
            font-size: 1.5rem;
            color: #007bff;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        /* Content Styles */
        .content {
            margin-left: 250px;
            padding: 30px;
            flex: 1;
            background: #f9f9f9;
        }

        .content h3 {
            margin-bottom: 20px;
            color: #343a40;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .alert {
            margin-top: 20px;
        }

        /* Card Styles */
        .card {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: none;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3>Campaign Management</h3>
            </div>
            <a href="HomePage.html">Homepage</a>
        </div>

        <!-- Content Area -->
        <div class="content">
            <h3>Manage Campaigns</h3>

            <!-- Alert Messages -->
            <?php if ($error_message) : ?>
                <div class="alert alert-danger"><?= $error_message; ?></div>
            <?php elseif ($success_message) : ?>
                <div class="alert alert-success"><?= $success_message; ?></div>
            <?php endif; ?>

            <!-- Form -->
            <form method="POST" action="campaign_wizard.php">
                <div class="form-group">
                    <label for="title">Campaign Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $title ?>" required>
                </div>

                <div class="form-group">
                    <label for="goal_amount">Goal Amount</label>
                    <input type="number" class="form-control" id="goal_amount" name="goal_amount" value="<?= $goal_amount ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Campaign Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required><?= $description ?></textarea>
                </div>

                <div class="form-group">
                    <label for="deadline">Campaign Deadline</label>
                    <input type="date" class="form-control" id="deadline" name="deadline" value="<?= $deadline ?>" required>
                </div>

                <div class="form-group">
                    <label for="campaign_type">Campaign Type</label>
                    <select class="form-control" id="campaign_type" name="campaign_type" required>
                        <option value="Healthcare" <?= $campaign_type == 'Healthcare' ? 'selected' : '' ?>>Healthcare</option>
                        <option value="Education" <?= $campaign_type == 'Education' ? 'selected' : '' ?>>Education</option>
                        <option value="Animals" <?= $campaign_type == 'Animals' ? 'selected' : '' ?>>Animals</option>
                        <option value="Environment" <?= $campaign_type == 'Environment' ? 'selected' : '' ?>>Environment</option>
                        <option value="Hunger Relief" <?= $campaign_type == 'Hunger Relief' ? 'selected' : '' ?>>Hunger Relief</option>
                        <option value="Clean Water" <?= $campaign_type == 'Clean Water' ? 'selected' : '' ?>>Clean Water</option>
                        <option value="Disaster Relief" <?= $campaign_type == 'Disaster Relief' ? 'selected' : '' ?>>Disaster Relief</option>
                        <option value="Mental Health" <?= $campaign_type == 'Mental Health' ? 'selected' : '' ?>>Mental Health</option>
                        <option value="Refugee Support" <?= $campaign_type == 'Refugee Support' ? 'selected' : '' ?>>Refugee Support</option>
                    </select>
                </div>

                <!-- Submit buttons -->
                <button type="submit" class="btn btn-primary" name="submit">Save Campaign</button>
            </form>
        </div>
    </div>
</body>

</html>
