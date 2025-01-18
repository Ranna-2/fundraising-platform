<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Management | KindledHope Admin</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar" class="active">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined">inventory</span> Admin Panel
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item"><a href="dashboard.html"><span class="material-icons-outlined">dashboard</span> Dashboard</a></li>
                <li class="sidebar-list-item"><a href="user_management.html"><span class="material-icons-outlined">people</span> User Management</a></li>
                <li class="sidebar-list-item"><a href="campaigns.html"><span class="material-icons-outlined">campaign</span> Campaigns</a></li>
                <li class="sidebar-list-item"><a href="campaign_requests.html"><span class="material-icons-outlined">assignment</span> Campaign Requests</a></li>
                <li class="sidebar-list-item"><a href="analytics_reporting.html"><span class="material-icons-outlined">bar_chart</span> Analytics & Reporting</a></li>
                <li class="sidebar-list-item"><a href="payment_settings.html"><span class="material-icons-outlined">payment</span> Payment Settings</a></li>
                <li class="sidebar-list-item"><a href="add_campaigns.html"><span class="material-icons-outlined">add_box</span> Add Campaign</a></li>
                <li class="sidebar-list-item"><a href="settings.html"><span class="material-icons-outlined">settings</span> Settings</a></li>
            </ul>
        </aside>
        <!-- End Sidebar -->

        <div id="body" class="active">
            <!-- Header -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button type="button" id="sidebarCollapse" class="btn btn-light"><i class="fas fa-bars"></i><span></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav1" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> <span>Admin</span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu" aria-labelledby="nav1">
                                    <ul class="nav-list">
                                        <li><a href="" class="dropdown-item"><i class="fas fa-address-card"></i> Profile</a></li>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>User Management</h3>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <table width="100%" class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Database connection
                                    $conn = new mysqli("localhost", "root", "", "fundarising_platform");
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Fetch users from the database
                                    $sql = "SELECT first_name, email, role FROM users";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                <td>" . htmlspecialchars($row['first_name']) . "</td>
                                                <td>" . htmlspecialchars($row['email']) . "</td>
                                                <td>" . htmlspecialchars($row['role']) . "</td>
                                                
                                                
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No users found.</td></tr>";
                                    }

                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
    <script>
        // Sidebar toggle
        document.getElementById("sidebarCollapse").addEventListener("click", function () {
            document.getElementById("sidebar").classList.toggle("active");
        });

        function closeSidebar() {
            document.getElementById("sidebar").classList.remove("active");
        }
    </script>
</body>

</html>
