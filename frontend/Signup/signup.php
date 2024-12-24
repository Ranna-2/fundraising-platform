<?php
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
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Validate password confirmation
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert data
        $sql = "INSERT INTO Users (email, password, first_name, last_name, role, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("sssss", $email, $hashed_password, $first_name, $last_name, $role);
            
            // Execute the query
            if ($stmt->execute()) {
                echo "Registration successful! You can now <a href='../Login/login.html'>log in</a>.";
            } else {
                echo "Error: " . $stmt->error;
            }
            // Close the statement
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>
