<?php

// Establish database connection
try {
    $conn = new PDO('mysql:host=localhost;dbname=fundarising_platform', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle contact form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_contact'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);
    $created_at = date('Y-m-d H:i:s');

    // Validate inputs
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        echo "<script>alert('All fields are required!');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!');</script>";
    } else {
        try {
            // Insert message into the database
            $sql = "INSERT INTO contact_form (name, email, phone, message, created_at) 
                    VALUES (:name, :email, :phone, :message, :created_at)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':created_at', $created_at);

            if ($stmt->execute()) {
                echo "<script>alert('Message sent successfully!');</script>";
            } else {
                echo "<script>alert('Error sending your message. Please try again later.');</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Database error: {$e->getMessage()}');</script>";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>KindledHope Fundraising Platform</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-100 font-roboto">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="logo.jpg" style="height: 20px;"></a>
            <h1 class="text-2xl font-extrabold text-gray-800 animate-bounce">
                <a href="../HomePage/HomePage.html" class="hover:text-blue-600 transition duration-200">
                    <span class="bg-gradient-to-r from-blue-500 to-green-500 text-transparent bg-clip-text">KindledHope</span>
                </a>
            </h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../funding/index.html">Campaigns</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">More</a>
                        <ul class="dropdown-menu" aria-labelledby="moreDropdown">
                            <li><a class="dropdown-item" href="#">About Us</a></li>
                            <li><a class="nav-link" href="#how-it-works">How it Works</a></li>
                            <li><a class="dropdown-item" href="../HelpCenter/index.html">Help Center</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white" href="../Login/login.html">Log in</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-primary" href="../Signup/signup.html">Sign up</a></li>
                    <li class="nav-item"><a class="nav-link" href="../admindashboard/dashboard.html">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section relative bg-cover bg-center h-screen" style="background-image: url('env.jpg');">
        <div class="hero-overlay absolute inset-0 bg-black opacity-50"></div>
        <div class="hero-content flex flex-col items-center justify-center h-full text-white relative z-10 p-4">
            <div class="glass-title-container">
                <h1 class="glass-title">Raise Money for What Matters</h1>
            </div>
            <div class="glass-subtitle-container">
                <p class="glass-subtitle">KindledHope.lk is a platform designed to bring together individuals and communities to support causes that matter. By donating or starting your own fundraising campaign, you can make a significant difference in the lives of others.</p>
            </div>
            <div class="button-container">
                <a href="../HomePage/campaign_wizard.php" class="btn btn-primary">Start a Campaign</a>
                <a href="../funding/index.html" class="btn btn-primary">Learn More</a>
            </div>

            <!-- Search Bar -->
            <div class="search-bar-container mt-4" style="display: flex; justify-content: center; padding: 20px; border-radius: 8px; backdrop-filter: blur(5px);">
                <form class="row g-3 justify-content-center" style="width: 100%; max-width: 800px;" method="GET" action="">
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-lg" placeholder="Search here" name="search_query" style="height: 40px;" />
                    </div>
                    <div class="col-md-3">
                        <select class="form-select form-select-lg" name="category" style="height: 50px;">
                            <option selected>Category</option>
                            <option value="Health">Health</option>
                            <option value="Education">Education</option>
                            <option value="Animals">Animals</option>
                            <option value="Environment">Environment</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select form-select-lg" style="height: 50px;">
                            <option selected>Location</option>
                            <option value="1">Colombo</option>
                            <option value="2">Kandy</option>
                            <option value="3">Galle</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg" style="height: 50px;">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section class="mb-12">
    <h2 class="section-title">Recent Campaigns</h2>
    <div class="campaign-grid">
        <div class="campaign-card">
            <img alt="A placeholder image of a fundraising campaign" class="campaign-image" src="program1.jpg"/>
            <div class="campaign-content">
                <h3 class="campaign-title">Free Health Checkups</h3>
                <p class="campaign-description">Providing free health checkup camps for underprivileged communities to detect and treat diseases early.</p>
                <div class="campaign-footer">
                    <span class="campaign-raised">$5,000 raised</span>
                    <a href="../donation.php" class="donate-button" >Donate </a>
                </div>
            </div>
        </div>
        <div class="campaign-card">
            <img alt="A placeholder image of a fundraising campaign" class="campaign-image" src="disaster2.jpg"/>
            <div class="campaign-content">
                <h3 class="campaign-title">Food & Water Relief</h3>
                <p class="campaign-description">Delivering essential food supplies and clean drinking water to affected regions after a disaster.</p>
                <div class="campaign-footer">
                    <span class="campaign-raised">$3,200 raised</span>
                    <a href="../donation.php" class="donate-button" >Donate </a>
                </div>
            </div>
        </div>
        <div class="campaign-card">
            <img alt="A placeholder image of a fundraising campaign" class="campaign-image" src="hunger5.jpg"/>
            <div class="campaign-content">
                <h3 class="campaign-title">School Meal Programs</h3>
                <p class="campaign-description">Ensuring that children in need receive daily meals to keep them healthy and focused in school.</p>
                <div class="campaign-footer">
                    <span class="campaign-raised">$7,800 raised</span>
                    <a href="../donation.php" class="donate-button" >Donate </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="how-it-works" class="mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4" style="text-align: center;">How It Works</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white shadow rounded p-6">
                    <i class="fas fa-user-plus text-green-500 text-3xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Create an Account</h3>
                    <p class="text-gray-600">Sign up using your email or social media accounts.</p>
                </div>
                <div class="bg-white shadow rounded p-6">
                    <i class="fas fa-bullhorn text-green-500 text-3xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Launch a Campaign</h3>
                    <p class="text-gray-600">Use our campaign wizard to set up your fundraising campaign.</p>
                </div>
                <div class="bg-white shadow rounded p-6">
                    <i class="fas fa-donate text-green-500 text-3xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Receive Donations</h3>
                    <p class="text-gray-600">Securely process donations and track your progress in real-time.</p>
                </div>
            </div>
        </section>
        <section class="mb-12 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">What Our Users Say</h2>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm testimonial-card">
                        <img src="https://th.bing.com/th/id/OIP.OUruZMA7_BwAkDVzHvD_oQHaK3?pid=ImgDet&w=184&h=270&c=7&dpr=1.3" class="card-img-top" alt="Alice Johnson" />
                        <div class="card-body">
                            <h5 class="card-title">Alice Johnson</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Entrepreneur</h6>
                            <div class="star-rating mb-2">
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                            </div>
                            <p class="card-text">KindledHope helped me raise the funds I needed to launch my startup. The community support was incredible!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm testimonial-card">
                        <img src="https://th.bing.com/th/id/OIP.vhm3qJupqdo9Afdj5MzKyQHaLF?w=641&h=960&rs=1&pid=ImgDetMain" class="card-img-top" alt="Bob Smith" />
                        <div class="card-body">
                            <h5 class="card-title">Bob Smith</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Non-Profit Organizer</h6>
                            <div class="star-rating mb-2">
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star">★</span>
                            </div>
                            <p class="card-text">I was able to gather donations for my charity project in no time. The platform is user-friendly and effective.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm testimonial-card">
                        <img src="https://th.bing.com/th/id/OIP.X7_uZjwc9_aEN5jEtpDrywHaLH?pid=ImgDet&w=184&h=276&c=7&dpr=1.3" class="card-img-top" alt="Charlie Brown" />
                        <div class="card-body">
                            <h5 class="card-title">Charlie Brown</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Artist</h6>
                            <div class="star-rating mb-2">
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                            </div>
                            <p class="card-text">Thanks to KindledHope, I was able to fund my art project and connect with amazing supporters. Highly recommend!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contactForm" class="mb-10 text-center">
            <div class ="container";>
            <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Stay in touch!</h2>
            <p class="text-center text-success">Any questions or remarks? Just write us a message.</p>
            <div class="row align-items-stretch">
                <div class="col-md-4">
                    <div class="bg-success text-white p-4 rounded h-100 d-flex flex-column justify-content-between">
                        <div>
                            <h5>Contact Information</h5>
                            <p>Fill up the form and our team will get back to you within 24 hours.</p>
                            <p><i class="fas fa-phone"></i> <a href="tel:+94766665629" class="text-white">+94766665629</a></p>
                            <p><i class="fas fa-envelope"></i> <a href="mailto:Kindledhope@gmail.com" class="text-white">Kindledhope@gmail.com</a></p>
                        </div>
                        <div class="social-icons mt-3">
                            <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <form id="contactForm" class="bg-white p-4 rounded shadow h-100" method="POST" action="">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="John Smith" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="JohnSmith@gmail.com" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+233546227893" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Write your message..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="submit_contact">Send Message</button>
</form>


                </div>
            </div>
        </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 KindledHope.lk | All Rights Reserved</p>
            <div class="footer-links">
                <a href="../PrivacyPolicy/privacy.html" class="text-white hover:text-blue-500">Privacy Policy</a> |
                <a href="../TermsOfService/terms.html" class="text-white hover:text-blue-500">Terms of Service</a> |
                <a href="../Contact/contact.html" class="text-white hover:text-blue-500">Contact Us</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
