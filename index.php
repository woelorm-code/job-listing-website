<?php
session_start();
$user = $_SESSION['user'] ?? null;
$jobs = [
    [
        'title' => 'Customer Service Representative',
        'company' => 'BrightPath Ltd.',
        'location' => 'Nairobi',
        'type' => 'Full Time',
        'salary' => 'KSh 40,000 - 60,000',
        'category' => 'Customer Service',
        'summary' => 'Support clients, answer inquiries, and handle service requests efficiently.'
    ],
    [
        'title' => 'Data Entry Clerk',
        'company' => 'Accurate Solutions',
        'location' => 'Kisumu',
        'type' => 'Contract',
        'salary' => 'KSh 30,000 - 45,000',
        'category' => 'Administration',
        'summary' => 'Manage records, input data accurately, and maintain organized files.'
    ],
    [
        'title' => 'Sales Associate',
        'company' => 'Urban Mart',
        'location' => 'Mombasa',
        'type' => 'Full Time',
        'salary' => 'KSh 35,000 - 55,000',
        'category' => 'Sales',
        'summary' => 'Assist shoppers, complete sales, and maintain customer satisfaction.'
    ],
    [
        'title' => 'Junior Graphic Designer',
        'company' => 'Creative Hive',
        'location' => 'Nairobi',
        'type' => 'Part Time',
        'salary' => 'KSh 25,000 - 40,000',
        'category' => 'Design',
        'summary' => 'Create social media content, brochures, and visual assets using design tools.'
    ],
    [
        'title' => 'Warehouse Assistant',
        'company' => 'LogiCore',
        'location' => 'Eldoret',
        'type' => 'Full Time',
        'salary' => 'KSh 32,000 - 50,000',
        'category' => 'Logistics',
        'summary' => 'Receive stock, sort items, and ensure warehouse operations run smoothly.'
    ],
    [
        'title' => 'Security Guard',
        'company' => 'Guardian Force',
        'location' => 'Nakuru',
        'type' => 'Full Time',
        'salary' => 'KSh 28,000 - 42,000',
        'category' => 'Security',
        'summary' => 'Monitor premises, protect property, and maintain safety procedures.'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobLink Kenya | Find Opportunities Near You</title>
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
                <a href="index.php" class="active">Home</a>
                <a href="about.php">About</a>
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

    <main>
        <section class="hero">
            <div class="container hero-inner">
                <div class="hero-copy">
                    <p class="eyebrow">Your next opportunity starts here</p>
                    <h1>Find jobs that match your skills and goals.</h1>
                    <p>JobLink Kenya helps unemployed people discover trusted job openings, improve job readiness, and connect with opportunity.</p>
                    <div class="hero-actions">
                        <a href="search.php" class="btn btn-primary">Search Jobs</a>
                        <?php if (empty($user)): ?>
                            <a href="signup.php" class="btn btn-secondary">Create Account</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="hero-card">
                    <div class="mini-card">
                        <span>Jobs Available</span>
                        <strong>250+</strong>
                    </div>
                    <div class="mini-card">
                        <span>Active Users</span>
                        <strong>4,200</strong>
                    </div>
                    <div class="mini-card">
                        <span>Locations</span>
                        <strong>25 Cities</strong>
                    </div>
                </div>
            </div>
        </section>

        <section class="search-panel">
            <div class="container">
                <form action="results.php" method="GET" class="job-search-form">
                    <div class="field-group">
                        <label for="job-title">Job title or keyword</label>
                        <input type="text" id="job-title" name="q" placeholder="e.g. customer service, sales, design">
                    </div>
                    <div class="field-group">
                        <label for="job-location">Location</label>
                        <input type="text" id="job-location" name="location" placeholder="e.g. Nairobi, Kisumu">
                    </div>
                    <button type="submit" class="btn btn-primary">Search Jobs</button>
                </form>
            </div>
        </section>

        <section class="featured-jobs section">
            <div class="container">
                <div class="section-head">
                    <div>
                        <p class="eyebrow">Featured roles</p>
                        <h2>Latest job opportunities</h2>
                    </div>
                    <a href="search.php" class="text-link">View all jobs</a>
                </div>

                <div class="jobs-grid">
                    <?php foreach (array_slice($jobs, 0, 4) as $job): ?>
                        <article class="job-card">
                            <div class="job-top-row">
                                <span class="tag"><?= htmlspecialchars($job['type']); ?></span>
                                <span class="tag muted"><?= htmlspecialchars($job['category']); ?></span>
                            </div>
                            <h3><?= htmlspecialchars($job['title']); ?></h3>
                            <p class="company"><?= htmlspecialchars($job['company']); ?></p>
                            <p class="location"><?= htmlspecialchars($job['location']); ?></p>
                            <p class="summary"><?= htmlspecialchars($job['summary']); ?></p>
                            <div class="job-meta">
                                <strong><?= htmlspecialchars($job['salary']); ?></strong>
                            </div>
                            <a href="search.php" class="btn btn-secondary full-width">Apply now</a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="how-it-works section alt-bg">
            <div class="container">
                <div class="section-head center">
                    <p class="eyebrow">How it works</p>
                    <h2>Simple steps to start your job search</h2>
                </div>
                <div class="steps-grid">
                    <div class="step-item">
                        <span>1</span>
                        <h3>Create account</h3>
                        <p>Sign up with your personal details, qualification, preferred jobs, and upload your CV.</p>
                    </div>
                    <div class="step-item">
                        <span>2</span>
                        <h3>Search jobs</h3>
                        <p>Explore openings by keyword, location, and role preferences that fit your profile.</p>
                    </div>
                    <div class="step-item">
                        <span>3</span>
                        <h3>Apply with confidence</h3>
                        <p>Use your profile and uploaded documents to apply for suitable opportunities faster.</p>
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
