<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';
requireAdmin();

$adminEmail = $_SESSION['admin_email'] ?? 'admin@afterthink.com';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Afterthink Studio</title>
    <link rel="stylesheet" href="<?php echo assetUrl('css/admin.css'); ?>">
</head>
<body>
<div class="admin-wrapper">
    <header class="admin-header">
        <h1>Admin Dashboard</h1>
    </header>
    <main class="admin-content">
        <p>Welcome, <?php echo e($adminEmail); ?>.</p>
        <div class="admin-navigation">
            <article class="admin-card">
                <h3>Services</h3>
                <a href="manage.php?module=services">Manage Services</a>
            </article>
            <article class="admin-card">
                <h3>Projects</h3>
                <a href="manage.php?module=projects">Manage Projects</a>
            </article>
            <article class="admin-card">
                <h3>Testimonials</h3>
                <a href="manage.php?module=testimonials">Manage Testimonials</a>
            </article>
            <article class="admin-card">
                <h3>Blog</h3>
                <a href="manage.php?module=blog">Manage Blog</a>
            </article>
            <article class="admin-card">
                <h3>Media Library</h3>
                <a href="media.php">Manage Media</a>
            </article>
            <article class="admin-card">
                <h3>Inquiries</h3>
                <a href="inquiries.php">View Inquiries</a>
            </article>
            <article class="admin-card">
                <h3>Logout</h3>
                <a href="logout.php">Sign Out</a>
            </article>
        </div>
    </main>
</div>
</body>
</html>
