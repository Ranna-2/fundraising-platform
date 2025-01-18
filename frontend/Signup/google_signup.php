<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'C:/xampp/htdocs/FundraisingProject/vendor/autoload.php';



// Google Client Configuration
$client = new Google_Client();
$client->setClientId('342493587366-8ja5ftp0hfempp3lh1a89qqqb31legq6.apps.googleusercontent.com'); //  Google Client ID
$client->setClientSecret('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'); //  Google Client Secret
$client->setRedirectUri('http://localhost/FundraisingProject/frontend/Signup/google_signup.php');
$client->addScope('email');
$client->addScope('profile');

// Handle OAuth response
if (isset($_GET['code'])) {
    // Fetch the access token with the authorization code
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Get user info from Google API
    $google_service = new Google_Service_Oauth2($client);
    $google_user = $google_service->userinfo->get();

    // User information
    $email = $google_user->email;
    $full_name = $google_user->name;

    // Split full name into first name and last name
    $names = explode(' ', $full_name, 2);
    $first_name = $names[0];
    $last_name = isset($names[1]) ? $names[1] : '';

    // Connect to your database
    $conn = new mysqli('localhost', 'root', '', 'fundarising_platform');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $conn->query("
        CREATE TABLE IF NOT EXISTS Users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL UNIQUE,
            first_name VARCHAR(255),
            last_name VARCHAR(255),
            role VARCHAR(50),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "You are already registered! <a href='../donation.php'>Log in</a>";
    } else {
        // Insert new user with 'Donor' as the default role
        $role = 'Donor';
        $sql = "INSERT INTO Users (email, first_name, last_name, role, created_at) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $email, $first_name, $last_name, $role);
        
        if ($stmt->execute()) {
            // Redirect to login after successful registration
            echo "Registration successful! You can now <a href='../donation.php'>continue</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close database connections
    $stmt->close();
    $conn->close();
} else {
    // Redirect to Google Login URL if no code is received
    $login_url = $client->createAuthUrl();
    header("Location: " . $login_url);
    exit();
}
?>
