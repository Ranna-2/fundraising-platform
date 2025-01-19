<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Management | KindledHope Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .wrapper {
            display: flex;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #343a40;
            color: #fff;
            padding: 15px;
        }

        #sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }

        #sidebar a:hover {
            background: #495057;
        }

        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <h4>Admin Panel</h4>
            <ul class="list-unstyled">
                <li><a href="dashboard.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="user_management.html"><i class="fas fa-users"></i> User Management</a></li>
                <li><a href="campaigns.html"><i class="fas fa-bullhorn"></i> Campaigns</a></li>
                <li><a href="campaign_requests.html"><i class="fas fa-tasks"></i> Campaign Requests</a></li>
                <li><a href="analytics_reporting.html"><i class="fas fa-chart-bar"></i> Analytics & Reporting</a></li>
                <li><a href="payment_settings.html"><i class="fas fa-credit-card"></i> Payment Settings</a></li>
                <li><a href="add_campaigns.html"><i class="fas fa-plus-square"></i> Add Campaign</a></li>
                <li><a href="settings.html"><i class="fas fa-cogs"></i> Settings</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="content">
            <div class="container">
                <h3>User Management</h3>
                <?php
                // Database connection
                $conn = new mysqli("localhost", "root", "", "fundarising_platform");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Handle user deletion
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
                    $userId = $_POST['user_id'];
                    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
                    $stmt->bind_param("i", $userId);
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>User deleted successfully.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error deleting user. Please try again.</div>";
                    }
                    $stmt->close();
                }

                // Fetch users from the database
                $sql = "SELECT user_id, first_name, email, role FROM users";
                $result = $conn->query($sql);
                ?>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($row['first_name']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . htmlspecialchars($row['role']) . "</td>
                                    <td>
                                        <form method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to delete this user?\");'>
                                            <input type='hidden' name='user_id' value='" . htmlspecialchars($row['user_id']) . "'>
                                            <button type='submit' name='delete_user' class='btn btn-danger btn-sm'>Delete</button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php $conn->close(); ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
