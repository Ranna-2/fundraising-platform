<?php
// Start session to manage user login
session_start();

// Database connection
$host = 'localhost'; 
$dbname = 'Fundarising_platform'; 
$username = 'root'; 
$password = ''; 

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role']; // Capture the selected role

  // Query to check if the email and role match in the database
  $sql = "SELECT * FROM Users WHERE email = ? AND role = ?";
  if ($stmt = $conn->prepare($sql)) {
    // Bind parameters
    $stmt->bind_param("ss", $email, $role);
    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if email and role exist
    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      // Verify password
      if (password_verify($password, $user['password'])) {
        // Start session and store user info
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        exit();
      } else {
        echo "Invalid password.";
      }
    } else {
      echo "No user found with this email and role.";
    }

    // Close the statement
    $stmt->close();
  }
}

// Close connection
$conn->close();
?>
