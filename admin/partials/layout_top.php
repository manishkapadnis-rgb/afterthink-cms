<?php
/**
 * Shared admin shell (sidebar + topbar).
 * Expects: $pageTitle (string), $activeNav (string key matching $navItems below).
 */
declare(strict_types=1);

$pageTitle = $pageTitle ?? 'Dashboard';
$activeNav = $activeNav ?? 'dashboard';
$adminName = $_SESSION['admin_name'] ?? ($_SESSION['admin_email'] ?? 'Admin');
$adminInitial = strtoupper(substr((string) $adminName, 0, 1));

$navItems = [
    ['dashboard', 'Dashboard', 'dashboard.php'],
    ['hero_slides', 'Hero Slider', 'manage.php?module=hero_slides'],
    ['pages', 'Pages', 'manage.php?module=pages'],
    ['services', 'Services', 'manage.php?module=services'],
    ['projects', 'Projects', 'manage.php?module=projects'],
    ['gallery', 'Gallery', 'manage.php?module=gallery'],
    ['testimonials', 'Testimonials', 'manage.php?module=testimonials'],
    ['team_members', 'Team Members', 'manage.php?module=team_members'],
    ['blog', 'Blog', 'manage.php?module=blog'],
    ['blog_categories', 'Blog Categories', 'manage.php?module=blog_categories'],
    ['media', 'Media Library', 'media.php'],
    ['__sep1', '', ''],
    ['contact', 'Contact Settings', 'settings.php?section=contact'],
    ['seo', 'SEO Settings', 'settings.php?section=seo'],
    ['inquiries', 'Inquiries', 'inquiries.php'],
    ['__sep2', '', ''],
    ['profile', 'Profile', 'profile.php'],
    ['logout', 'Logout', 'logout.php'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pageTitle); ?> | Afterthink Admin</title>
    <link rel="stylesheet" href="<?php echo assetUrl('css/admin.css'); ?>">
</head>
<body class="admin-body">
<aside class="admin-sidebar">
    <div class="brand">Afterthink <span>Studio</span></div>
    <nav>
        <?php foreach ($navItems as [$key, $label, $href]) : ?>
            <?php if (strpos($key, '__sep') === 0) : ?>
                <div class="nav-sep"></div>
            <?php else : ?>
                <a class="<?php echo $activeNav === $key ? 'active' : ''; ?>" href="<?php echo e($href); ?>">
                    <span class="dot"></span><?php echo e($label); ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </nav>
    <div class="sidebar-foot">Afterthink Studio CMS</div>
</aside>
<div class="admin-main">
    <header class="admin-topbar">
        <h1><?php echo e($pageTitle); ?></h1>
        <div class="admin-user">
            <span><?php echo e((string) $adminName); ?></span>
            <span class="avatar"><?php echo e($adminInitial); ?></span>
        </div>
    </header>
    <div class="admin-page">
