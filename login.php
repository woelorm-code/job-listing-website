<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header('Location: index.php');
    exit;
}

$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $loginError = 'Please enter both email and password.';
    } else {
        $users = $_SESSION['users'] ?? [];
        if (isset($users[$email]) && password_verify($password, $users[$email]['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $users[$email];
            header('Location: index.php');
            exit;
        }

        $loginError = 'Invalid email or password. If you are new, please sign up first.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | JobLink Kenya</title>
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
                <a href="contact.php">Contact</a>
                <a href="login.php" class="active">Login</a>
                <a href="signup.php" class="btn btn-primary small">Sign Up</a>
            </nav>
        </div>
    </header>

    <main class="page-content auth-page">
        <div class="container auth-wrap">
            <div class="auth-box">
                <h1>Welcome back</h1>
                <p class="muted">New users must sign up first before logging in.</p>

                <?php if (!empty($_SESSION['signup_success'])): ?>
                    <div class="alert success"><?= htmlspecialchars($_SESSION['signup_success']); ?></div>
                    <?php unset($_SESSION['signup_success']); ?>
                <?php endif; ?>

                <?php if ($loginError): ?>
                    <div class="alert error"><?= htmlspecialchars($loginError); ?></div>
                <?php endif; ?>

                <form method="POST" action="login.php" class="styled-form">
                    <div class="field-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="your@email.com" required>
                    </div>
                    <div class="field-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <button type="submit" class="btn btn-primary full-width">Login</button>
                </form>

                <p class="switch-text">Don’t have an account? <a href="signup.php">Sign up here</a></p>
            </div>
        </div>
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
