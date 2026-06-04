<?php
require_once __DIR__ . '/includes/header.php';
$slug = $_GET['slug'] ?? null;
$post = fetchOne('SELECT * FROM blogs WHERE slug = :slug AND active = 1 LIMIT 1', [':slug' => $slug]);
if (!$post) {
    header('HTTP/1.0 404 Not Found');
    echo '<section class="py-6"><div class="container"><h1>Article not found</h1><p>The requested blog article could not be found.</p></div></section>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}
$meta = [
    'meta_title' => $post['seo_title'] ?: $post['title'] . ' | Afterthink Studio',
    'meta_description' => $post['seo_description'] ?: substr($post['excerpt'], 0, 155),
    'meta_keywords' => $post['seo_keywords'] ?: '',
    'og_image' => $post['image'],
];
?>
<section class="py-6">
    <div class="container">
        <div class="mb-4">
            <small class="text-muted"><?= date('F j, Y', strtotime($post['published_at'])) ?></small>
            <h1 class="mt-2"><?= getSafe($post['title']) ?></h1>
        </div>
        <?php if (!empty($post['image'])): ?>
            <img src="<?= UPLOAD_URL . getSafe($post['image']) ?>" class="img-fluid rounded shadow mb-4" alt="<?= getSafe($post['title']) ?>">
        <?php endif; ?>
        <div class="content text-muted">
            <?= nl2br(getSafe($post['content'])) ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
