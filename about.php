<?php
session_start();
$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | JobLink Kenya</title>
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
                <a href="about.php" class="active">About</a>
                <a href="search.php">Search Jobs</a>
                <a href="contact.php">Contact</a>
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
                <p class="eyebrow">About us</p>
                <h1>Helping job seekers connect to real opportunities.</h1>
            </div>
        </section>

        <section class="section">
            <div class="container two-col">
                <div>
                    <h2>Why JobLink Kenya exists</h2>
                    <p>Many unemployed people have the right skills, but they struggle to find platforms that are simple, trusted, and relevant to their needs. JobLink Kenya was created to close that gap by bringing job announcements closer to people who need them most.</p>
                    <p>We focus on accessibility, clarity, and job readiness. Our users can search for suitable positions, build professional profiles, and apply with confidence.</p>
                </div>
                <div class="info-box">
                    <h3>Our mission</h3>
                    <p>To make job searching easier, more inclusive, and more connected for the unemployed.</p>
                </div>
            </div>
        </section>

        <section class="section alt-bg">
            <div class="container">
                <div class="section-head center">
                    <p class="eyebrow">What we offer</p>
                    <h2>Support for every step of the job search</h2>
                </div>
                <div class="steps-grid three-col">
                    <div class="step-item">
                        <span>01</span>
                        <h3>Clear listings</h3>
                        <p>View a simple list of relevant vacancies with details on role, location, and pay.</p>
                    </div>
                    <div class="step-item">
                        <span>02</span>
                        <h3>Profile-based sign up</h3>
                        <p>Users create a personal profile with their education, skill interests, and contact information.</p>
                    </div>
                    <div class="step-item">
                        <span>03</span>
                        <h3>Easy access</h3>
                        <p>Search jobs quickly and apply through a user-friendly experience designed for everyone.</p>
                    </div>
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
