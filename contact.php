<?php
session_start();
$user = $_SESSION['user'] ?? null;
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        $successMessage = 'Please complete all fields before sending your message.';
    } else {
        $successMessage = 'Thank you for contacting us. We will get back to you soon.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | JobLink Kenya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="site-header">
        <div class="container nav">
            <div class="brand">
                <a href="index.php">JobLink Kenya</a>
            </div>
            <button class="menu-toggle" aria-label="Open menu">☰</button>
            <nav class="main-nav">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="search.php">Search Jobs</a>
                <a href="contact.php" class="active">Contact</a>
                <?php if (!empty($user)): ?>
                    <span class="welcome-text">Hi, <?= htmlspecialchars($user['name']); ?></span>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="signup.php" class="btn btn-primary small">Sign Up</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="page-content">
        <section class="page-hero">
            <div class="container narrow">
                <p class="eyebrow">Contact us</p>
                <h1>We’re here to help you find the right opportunity.</h1>
            </div>
        </section>

        <section class="section">
            <div class="container contact-grid">
                <div class="contact-info">
                    <h2>Get in touch</h2>
                    <p>Email: support@joblinkkenya.com</p>
                    <p>Phone: +254 700 000 000</p>
                    <p>Address: Moi Avenue, Nairobi, Kenya</p>
                </div>

                <div class="form-card">
                    <?php if ($successMessage): ?>
                        <div class="alert success"><?= htmlspecialchars($successMessage); ?></div>
                    <?php endif; ?>
                    <form method="POST" action="contact.php" class="styled-form">
                        <div class="field-group">
                            <label for="name">Your name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                        </div>
                        <div class="field-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="your@example.com" required>
                        </div>
                        <div class="field-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="How can we help?" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send message</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <p>© <span id="year"></span> JobLink Kenya. All rights reserved.</p>
            <div class="footer-links">
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <a href="login.php">Login</a>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
