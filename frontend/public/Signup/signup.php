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
    $full_name = $_POST['full_name'];
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
        $sql = "INSERT INTO Users (email, password, full_name, role, created_at) 
                VALUES (?, ?, ?, ?, NOW())";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssss", $email, $hashed_password, $full_name, $role);
            
            // Execute the query
            if ($stmt->execute()) {
                echo "Registration successful! You can now <a href='login.html'>log in</a>.";
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
