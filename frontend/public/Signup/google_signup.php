<?php
require_once 'vendor/autoload.php';

// Google Client Configuration
$client = new Google_Client();
$client->setClientId('YOUR_GOOGLE_CLIENT_ID'); // REPLACE WITH YOUR GOOGLE ID !!!!!!
$client->setClientSecret('YOUR_GOOGLE_CLIENT_SECRET'); // Replace with your Google Client Secret !!!!
$client->setRedirectUri('http://localhost/google_signup.php'); 
$client->addScope('email');
$client->addScope('profile');

// Handle OAuth response
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Get user info
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
        // Insert new user
        $role = 'Donor'; // i will use donor for default role when google sign up
        $sql = "INSERT INTO Users (email, full_name, role, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $full_name, $role);
        if ($stmt->execute()) {
            echo "Registration successful! You can now <a href='login.html'>log in</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
    $conn->close();
} else {
    // Redirect to Google Login URL
    $login_url = $client->createAuthUrl();
    header("Location: " . $login_url);
    exit();
}
?>
