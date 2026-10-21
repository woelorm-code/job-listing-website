<?php
session_start();
$user = $_SESSION['user'] ?? null;
$jobs = [
    ['title' => 'Customer Service Representative', 'company' => 'BrightPath Ltd.', 'location' => 'Nairobi', 'type' => 'Full Time', 'salary' => 'KSh 40,000 - 60,000', 'category' => 'Customer Service', 'summary' => 'Support clients and handle service requests efficiently.'],
    ['title' => 'Data Entry Clerk', 'company' => 'Accurate Solutions', 'location' => 'Kisumu', 'type' => 'Contract', 'salary' => 'KSh 30,000 - 45,000', 'category' => 'Administration', 'summary' => 'Manage records and maintain organized files.'],
    ['title' => 'Sales Associate', 'company' => 'Urban Mart', 'location' => 'Mombasa', 'type' => 'Full Time', 'salary' => 'KSh 35,000 - 55,000', 'category' => 'Sales', 'summary' => 'Assist shoppers and complete sales.'],
    ['title' => 'Junior Graphic Designer', 'company' => 'Creative Hive', 'location' => 'Nairobi', 'type' => 'Part Time', 'salary' => 'KSh 25,000 - 40,000', 'category' => 'Design', 'summary' => 'Create social media and marketing assets.'],
    ['title' => 'Warehouse Assistant', 'company' => 'LogiCore', 'location' => 'Eldoret', 'type' => 'Full Time', 'salary' => 'KSh 32,000 - 50,000', 'category' => 'Logistics', 'summary' => 'Sort stock and support warehouse operations.'],
    ['title' => 'Security Guard', 'company' => 'Guardian Force', 'location' => 'Nakuru', 'type' => 'Full Time', 'salary' => 'KSh 28,000 - 42,000', 'category' => 'Security', 'summary' => 'Monitor premises and maintain security protocols.']
];

$q = strtolower(trim($_GET['q'] ?? ''));
$location = strtolower(trim($_GET['location'] ?? ''));
$results = [];

foreach ($jobs as $job) {
    $matchesQuery = $q === '' || stripos($job['title'], $q) !== false || stripos($job['category'], $q) !== false || stripos($job['summary'], $q) !== false;
    $matchesLocation = $location === '' || stripos($job['location'], $location) !== false;

    if ($matchesQuery && $matchesLocation) {
        $results[] = $job;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Jobs | JobLink Kenya</title>
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
                <a href="search.php" class="active">Search Jobs</a>
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
                <p class="eyebrow">Find your next role</p>
                <h1>Search jobs by keyword and location.</h1>
            </div>
        </section>

        <section class="search-panel search-page-panel">
            <div class="container">
                <form action="search.php" method="GET" class="job-search-form">
                    <div class="field-group">
                        <label for="job-title">Keyword</label>
                        <input type="text" id="job-title" name="q" value="<?= htmlspecialchars($q); ?>" placeholder="e.g. sales, data entry, customer service">
                    </div>
                    <div class="field-group">
                        <label for="job-location">Location</label>
                        <input type="text" id="job-location" name="location" value="<?= htmlspecialchars($location); ?>" placeholder="e.g. Nairobi, Mombasa">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="results-header">
                    <h2>Search results</h2>
                    <p><?= count($results); ?> matching jobs</p>
                </div>

                <?php if (empty($results)): ?>
                    <div class="empty-state">
                        <h3>No jobs found</h3>
                        <p>Try another keyword or location to discover more opportunities.</p>
                    </div>
                <?php else: ?>
                    <div class="jobs-grid">
                        <?php foreach ($results as $job): ?>
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
                                <button type="button" class="btn btn-secondary full-width">Apply now</button>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
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
