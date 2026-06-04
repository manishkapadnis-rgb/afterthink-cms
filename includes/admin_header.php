<?php
require_once __DIR__ . '/functions.php';
adminAuth();
$siteSettings = getSiteSettings();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel - <?= getSafe($siteSettings['site_name'] ?? 'Afterthink Studio') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= baseUrl('assets/css/style.css') ?>">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
<div class="d-flex admin-layout min-vh-100">
    <aside class="admin-sidebar bg-dark text-white p-3">
        <div class="mb-4">
            <h4><?= getSafe($siteSettings['site_name'] ?? 'Afterthink Studio') ?></h4>
            <small>Admin Panel</small>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
            <a class="nav-link text-white" href="hero_slider.php">Hero Slider</a>
            <a class="nav-link text-white" href="about.php">About Section</a>
            <a class="nav-link text-white" href="services.php">Services</a>
            <a class="nav-link text-white" href="portfolio.php">Portfolio</a>
            <a class="nav-link text-white" href="portfolio_categories.php">Portfolio Categories</a>
            <a class="nav-link text-white" href="gallery.php">Gallery</a>
            <a class="nav-link text-white" href="gallery_categories.php">Gallery Categories</a>
            <a class="nav-link text-white" href="testimonials.php">Testimonials</a>
            <a class="nav-link text-white" href="team.php">Team</a>
            <a class="nav-link text-white" href="blog.php">Blog</a>
            <a class="nav-link text-white" href="faqs.php">FAQs</a>
            <a class="nav-link text-white" href="social_links.php">Social Links</a>
            <a class="nav-link text-white" href="contact_inquiries.php">Inquiries</a>
            <a class="nav-link text-white" href="seo_settings.php">SEO Settings</a>
            <a class="nav-link text-white" href="site_settings.php">Website Settings</a>
            <a class="nav-link text-danger" href="logout.php">Logout</a>
        </nav>
    </aside>
    <div class="admin-content flex-grow-1 p-4 bg-light">
