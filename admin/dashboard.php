<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';
requireAdmin();

$db = getDatabase();

function dashCount(PDO $db, string $table): int
{
    try {
        return (int) $db->query("SELECT COUNT(*) FROM `{$table}`")->fetchColumn();
    } catch (Throwable $e) {
        return 0;
    }
}

function dashRows(PDO $db, string $sql): array
{
    try {
        return $db->query($sql)->fetchAll();
    } catch (Throwable $e) {
        return [];
    }
}

$stats = [
    ['Services', dashCount($db, 'services'), 'manage.php?module=services'],
    ['Projects', dashCount($db, 'projects'), 'manage.php?module=projects'],
    ['Testimonials', dashCount($db, 'testimonials'), 'manage.php?module=testimonials'],
    ['Blog Posts', dashCount($db, 'blog_posts'), 'manage.php?module=blog'],
    ['Media Files', dashCount($db, 'media_library'), 'media.php'],
    ['Inquiries', dashCount($db, 'inquiries'), 'inquiries.php'],
];

$recentInquiries = dashRows($db, 'SELECT name, email, status, created_at FROM inquiries ORDER BY created_at DESC, id DESC LIMIT 5');
$recentPosts = dashRows($db, 'SELECT title, slug, status, created_at FROM blog_posts ORDER BY created_at DESC, id DESC LIMIT 5');

$pageTitle = 'Dashboard';
$activeNav = 'dashboard';
require __DIR__ . '/partials/layout_top.php';
?>
<div class="stat-grid">
    <?php foreach ($stats as [$label, $value, $href]) : ?>
        <a class="stat-card" href="<?php echo e($href); ?>" style="text-decoration:none;color:inherit;">
            <div class="label"><?php echo e($label); ?></div>
            <div class="value"><?php echo e((string) $value); ?></div>
        </a>
    <?php endforeach; ?>
</div>

<div class="panel">
    <h2 style="margin-top:0;">Quick Actions</h2>
    <div class="quick-actions">
        <a href="manage.php?module=hero_slides&action=new">+ Hero Slide</a>
        <a href="manage.php?module=services&action=new">+ Service</a>
        <a href="manage.php?module=projects&action=new">+ Project</a>
        <a href="manage.php?module=blog&action=new">+ Blog Post</a>
        <a href="media.php">↑ Upload Media</a>
        <a href="inquiries.php">✉ View Inquiries</a>
    </div>
</div>

<div class="dash-cols">
    <div class="panel">
        <h2 style="margin-top:0;">Recent Inquiries</h2>
        <table class="admin-table">
            <thead><tr><th>Name</th><th>Email</th><th>Status</th><th>Received</th></tr></thead>
            <tbody>
            <?php foreach ($recentInquiries as $row) : ?>
                <tr>
                    <td><?php echo e((string) $row['name']); ?></td>
                    <td><?php echo e((string) $row['email']); ?></td>
                    <td><span class="badge <?php echo e((string) $row['status']); ?>"><?php echo e((string) $row['status']); ?></span></td>
                    <td><?php echo e((string) $row['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($recentInquiries)) : ?><tr><td colspan="4" class="muted">No inquiries yet.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="panel">
        <h2 style="margin-top:0;">Recent Blog Posts</h2>
        <table class="admin-table">
            <thead><tr><th>Title</th><th>Status</th><th>Created</th></tr></thead>
            <tbody>
            <?php foreach ($recentPosts as $row) : ?>
                <tr>
                    <td><a href="manage.php?module=blog">&nbsp;<?php echo e((string) $row['title']); ?></a></td>
                    <td><span class="badge <?php echo e((string) $row['status']); ?>"><?php echo e((string) $row['status']); ?></span></td>
                    <td><?php echo e((string) $row['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($recentPosts)) : ?><tr><td colspan="3" class="muted">No posts yet.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/partials/layout_bottom.php'; ?>
