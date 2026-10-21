<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header('Location: index.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requiredFields = [
        'name',
        'gender',
        'age',
        'qualification',
        'job_options',
        'phone',
        'residence',
        'email',
        'password',
        'confirm_password',
        'backup_contact'
    ];

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
            $errors[] = 'Please complete the ' . str_replace('_', ' ', $field) . ' field.';
        }
    }

    if (empty($errors)) {
        $name = trim($_POST['name']);
        $gender = trim($_POST['gender']);
        $age = trim($_POST['age']);
        $qualification = trim($_POST['qualification']);
        $jobOptions = trim($_POST['job_options']);
        $phone = trim($_POST['phone']);
        $residence = trim($_POST['residence']);
        $email = strtolower(trim($_POST['email']));
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $backupContact = trim($_POST['backup_contact']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }

        if (strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters long.';
        }

        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match.';
        }

        if (!is_numeric($age) || (int)$age < 15 || (int)$age > 100) {
            $errors[] = 'Age must be a valid number between 15 and 100.';
        }

        if (!empty($_FILES['cv']['name']) && $_FILES['cv']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'CV upload failed. Please try again.';
        }

        if (!empty($_FILES['profile_picture']['name']) && $_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Profile picture upload failed. Please try again.';
        }

        $allowedCv = ['pdf', 'doc', 'docx'];
        $cvExtension = strtolower(pathinfo($_FILES['cv']['name'] ?? '', PATHINFO_EXTENSION));
        if (!empty($_FILES['cv']['name']) && !in_array($cvExtension, $allowedCv, true)) {
            $errors[] = 'CV must be a PDF, DOC, or DOCX file.';
        }

        $allowedImage = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($_FILES['profile_picture']['name'] ?? '', PATHINFO_EXTENSION));
        if (!empty($_FILES['profile_picture']['name']) && !in_array($imageExtension, $allowedImage, true)) {
            $errors[] = 'Profile picture must be a JPG, JPEG, or PNG file.';
        }

        $users = $_SESSION['users'] ?? [];
        if (isset($users[$email])) {
            $errors[] = 'This email already has an account. Please log in instead.';
        }

        if (empty($errors)) {
            $user = [
                'name' => $name,
                'gender' => $gender,
                'age' => $age,
                'qualification' => $qualification,
                'job_options' => $jobOptions,
                'phone' => $phone,
                'residence' => $residence,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'cv_name' => $_FILES['cv']['name'] ?? '',
                'profile_picture_name' => $_FILES['profile_picture']['name'] ?? '',
                'backup_contact' => $backupContact
            ];

            $_SESSION['users'][$email] = $user;
            $_SESSION['signup_success'] = 'Signup successful! Please log in with your email and password.';
            header('Location: login.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | JobLink Kenya</title>
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
                <a href="login.php">Login</a>
                <a href="signup.php" class="btn btn-primary small active">Sign Up</a>
            </nav>
        </div>
    </header>

    <main class="page-content auth-page">
        <div class="container auth-wrap wide-wrap">
            <div class="auth-box wide-box">
                <h1>Create your account</h1>
                <p class="muted">All fields below are required. You must sign up before you can log in.</p>

                <?php if (!empty($errors)): ?>
                    <div class="alert error">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="signup.php" class="styled-form multi-column" enctype="multipart/form-data">
                    <div class="field-group">
                        <label for="name">Full name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                    </div>

                    <div class="field-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="field-group">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" min="15" max="100" placeholder="Enter age" required>
                    </div>

                    <div class="field-group">
                        <label for="qualification">Qualification</label>
                        <input type="text" id="qualification" name="qualification" placeholder="e.g. Diploma in Business Management" required>
                    </div>

                    <div class="field-group full-width">
                        <label for="job_options">Preferred job options</label>
                        <textarea id="job_options" name="job_options" rows="3" placeholder="e.g. Customer service, sales, data entry" required></textarea>
                    </div>

                    <div class="field-group">
                        <label for="phone">Phone number</label>
                        <input type="tel" id="phone" name="phone" placeholder="e.g. +254712345678" required>
                    </div>

                    <div class="field-group">
                        <label for="residence">Residence</label>
                        <input type="text" id="residence" name="residence" placeholder="Your current residence" required>
                    </div>

                    <div class="field-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="your@email.com" required>
                    </div>

                    <div class="field-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" minlength="6" placeholder="Create a password" required>
                    </div>

                    <div class="field-group">
                        <label for="confirm_password">Confirm password</label>
                        <input type="password" id="confirm_password" name="confirm_password" minlength="6" placeholder="Repeat password" required>
                    </div>

                    <div class="field-group">
                        <label for="cv">CV upload</label>
                        <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                    </div>

                    <div class="field-group">
                        <label for="profile_picture">Profile picture</label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/jpeg,image/png" required>
                    </div>

                    <div class="field-group full-width">
                        <label for="backup_contact">Backup contact</label>
                        <input type="text" id="backup_contact" name="backup_contact" placeholder="Emergency or alternative contact number" required>
                    </div>

                    <div class="full-width submit-row">
                        <button type="submit" class="btn btn-primary full-width">Create account</button>
                    </div>
                </form>

                <p class="switch-text">Already have an account? <a href="login.php">Log in</a></p>
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
