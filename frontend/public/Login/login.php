<?php
// Start session to store user data
session_start();

// Include database connection
include('db_connection.php');

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

            // Redirect based on user role
            if ($user['role'] === 'donor') {
                header("Location: donor_dashboard.php");
                exit(); // Stop further execution
            } elseif ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
                exit(); // Stop further execution
            } elseif ($user['role'] === 'fundraiser') {
                header("Location: fundraiser_dashboard.php");
                exit(); // Stop further execution
            }
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>
