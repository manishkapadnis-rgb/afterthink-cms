<?php
require_once __DIR__ . '/functions.php';
$siteSettings = getSiteSettings();
$seoSettings = getSeoSettings();
$meta = $meta ?? [];
$mergedMeta = array_merge($seoSettings ?: [], $meta);
?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php renderMeta($mergedMeta); ?>
    <link rel="shortcut icon" href="<?= UPLOAD_URL . ($siteSettings['favicon'] ?? '') ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= baseUrl('assets/css/style.css') ?>">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
<header class="site-header py-3 border-bottom bg-white">
    <div class="container d-flex align-items-center justify-content-between">
        <a class="navbar-brand fw-bold text-dark" href="<?= baseUrl('index.php') ?>"><?= getSafe($siteSettings['site_name'] ?? 'Afterthink Studio') ?></a>
        <nav class="d-none d-md-flex gap-3">
            <a class="nav-link" href="<?= baseUrl('index.php') ?>">Home</a>
            <a class="nav-link" href="<?= baseUrl('about.php') ?>">About</a>
            <a class="nav-link" href="<?= baseUrl('services.php') ?>">Services</a>
            <a class="nav-link" href="<?= baseUrl('portfolio.php') ?>">Portfolio</a>
            <a class="nav-link" href="<?= baseUrl('gallery.php') ?>">Gallery</a>
            <a class="nav-link" href="<?= baseUrl('process.php') ?>">Process</a>
            <a class="nav-link" href="<?= baseUrl('contact.php') ?>">Contact</a>
        </nav>
        <a class="btn btn-outline-dark d-none d-md-inline-block" href="<?= baseUrl('book-consultation.php') ?>">Book Consultation</a>
        <button class="btn btn-outline-dark d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">Menu</button>
    </div>
</header>
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="nav flex-column">
            <a class="nav-link" href="<?= baseUrl('index.php') ?>">Home</a>
            <a class="nav-link" href="<?= baseUrl('about.php') ?>">About</a>
            <a class="nav-link" href="<?= baseUrl('services.php') ?>">Services</a>
            <a class="nav-link" href="<?= baseUrl('portfolio.php') ?>">Portfolio</a>
            <a class="nav-link" href="<?= baseUrl('gallery.php') ?>">Gallery</a>
            <a class="nav-link" href="<?= baseUrl('process.php') ?>">Process</a>
            <a class="nav-link" href="<?= baseUrl('contact.php') ?>">Contact</a>
            <a class="nav-link" href="<?= baseUrl('book-consultation.php') ?>">Book Consultation</a>
        </nav>
    </div>
</div>
<main class="site-content">