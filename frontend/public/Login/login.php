<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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


if (isset($_POST['submit'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Query to fetch user from the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if user exists
    if ($result->num_rows > 0) {
        
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store user info in session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];

            // Check user role and redirect
            switch ($user['role']) {
                case 'Donor':
                    echo "Login successful! You can now go to your <a href='../Campaign/index.html'>Donor Dashboard</a>.";
                    exit();
                case 'Admin':
                    echo "Login successful! You can now go to the <a href='../../admindashboard/dashboard.html'>Admin Dashboard</a>.";
                    exit();
                case 'Fundraiser':
                    echo "Login successful! You can now go to your <a href='../Campaign/index.html'>Fundraiser Dashboard</a>.";
                    exit();
                default:
                    echo "Unknown role!";
                    break;
            }
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
// Close connection
$conn->close();
?>
