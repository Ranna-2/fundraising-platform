<?php
require_once 'vendor/autoload.php';

// Google Client Configuration
$client = new Google_Client();
$client->setClientId('342493587366-8ja5ftp0hfempp3lh1a89qqqb31legq6.apps.googleusercontent.com'); // Replace with your Google Client ID
$client->setClientSecret('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'); // Replace with your Google Client Secret
$client->setRedirectUri('http://localhost/google_signup.php'); 
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

    // Connect to your database
    $conn = new mysqli('localhost', 'root', '', 'Fundarising_platform');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "You are already registered! <a href='login.html'>Log in</a>";
    } else {
        // Insert new user with 'Donor' as the default role
        $role = 'Donor';
        $sql = "INSERT INTO Users (email, full_name, role, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $full_name, $role);
        
        if ($stmt->execute()) {
            // Redirect to login after successful registration
            echo "Registration successful! You can now <a href='login.html'>log in</a>";
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
