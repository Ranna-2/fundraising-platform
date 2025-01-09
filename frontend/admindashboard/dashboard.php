<?php
// Database connection settings
$host = 'localhost';
$dbname = 'fundarising_platform';
$username = 'root';
$password = '';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data for dashboard cards
$totalUsers = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$totalDonations = $conn->query("SELECT COUNT(*) as count FROM donations")->fetch_assoc()['count'];
$totalFunds = $conn->query("SELECT SUM(amount) as total FROM donations")->fetch_assoc()['total'];
$totalCampaigns = $conn->query("SELECT COUNT(*) as count FROM campaigns")->fetch_assoc()['count'];
$totalDonated = $conn->query("SELECT SUM(amount) as total FROM donations")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          <span class="material-icons-outlined">search</span>
        </div>
        <div class="header-right">
          <span class="material-icons-outlined">notifications</span>
          <span class="material-icons-outlined">email</span>
          <span class="material-icons-outlined">account_circle</span>
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">inventory</span> Admin Panel
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="dashboard.php">
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="user_management.php">
              <span class="material-icons-outlined">people</span> User Management
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="campaigns.php">
              <span class="material-icons-outlined">campaign</span> Campaigns
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="campaign_requests.php">
              <span class="material-icons-outlined">assignment</span> Campaign Requests
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="analytics.php">
              <span class="material-icons-outlined">bar_chart</span> Analytics & Reporting
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="payment_settings.php">
              <span class="material-icons-outlined">payment</span> Payment Settings
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="add_campaign.php">
              <span class="material-icons-outlined">add_box</span> Add Campaign
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="settings.php">
              <span class="material-icons-outlined">settings</span> Settings
            </a>
          </li>
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">DASHBOARD</p>
        </div>

        <div class="main-cards">
          <div class="card">
            <div class="card-inner">
              <p class="text-primary">NUMBER OF USERS</p>
              <span class="material-icons-outlined text-blue">people</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $totalUsers; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">NUMBER OF DONATIONS</p>
              <span class="material-icons-outlined text-orange">payments</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $totalDonations; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">FUNDS RAISED</p>
              <span class="material-icons-outlined text-green">attach_money</span>
            </div>
            <span class="text-primary font-weight-bold">$<?php echo number_format($totalFunds, 2); ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">CAMPAIGNS</p>
              <span class="material-icons-outlined text-red">campaign</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $totalCampaigns; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">AMOUNT DONATED SO FAR</p>
              <span class="material-icons-outlined text-purple">money</span>
            </div>
            <span class="text-primary font-weight-bold">$<?php echo number_format($totalDonated, 2); ?></span>
          </div>
        </div>

        <div class="charts">
          <div class="charts-card">
            <p class="chart-title">Campaign Performance</p>
            <div id="bar-chart"></div>
          </div>

          <div class="charts-card">
            <p class="chart-title">Donation Trends</p>
            <div id="area-chart"></div>
          </div>
        </div>
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
  </body>
</html>
<?php $conn->close(); ?>
