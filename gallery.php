<?php
require_once __DIR__ . '/includes/header.php';
$categorySlug = $_GET['category'] ?? null;
$categories = fetchAll('SELECT * FROM gallery_categories WHERE active = 1 ORDER BY sort_order, id');
$params = [];
$sql = 'SELECT g.*, c.name AS category_name FROM gallery_items g LEFT JOIN gallery_categories c ON g.category_id = c.id WHERE g.active = 1';
if ($categorySlug) {
    $sql .= ' AND c.slug = :slug';
    $params[':slug'] = $categorySlug;
}
$sql .= ' ORDER BY g.sort_order, g.id';
$items = fetchAll($sql, $params);
?>
<section class="py-6 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1>Gallery</h1>
            <p class="text-muted">A curated collection of images and videos representing our work.</p>
        </div>
        <div class="mb-4 text-center">
            <a href="<?= baseUrl('gallery.php') ?>" class="btn btn-sm btn-outline-dark <?= $categorySlug ? '' : 'active' ?>">All</a>
            <?php foreach ($categories as $category): ?>
                <a href="<?= baseUrl('gallery.php?category=' . urlencode($category['slug'])) ?>" class="btn btn-sm btn-outline-dark <?= $categorySlug === $category['slug'] ? 'active' : '' ?>"><?= getSafe($category['name']) ?></a>
            <?php endforeach; ?>
        </div>
        <div class="row g-4">
            <?php foreach ($items as $item): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <?php if ($item['type'] === 'image'): ?>
                            <a href="<?= UPLOAD_URL . getSafe($item['file']) ?>" target="_blank">
                                <img src="<?= UPLOAD_URL . getSafe($item['file']) ?>" class="card-img-top" alt="<?= getSafe($item['title']) ?>">
                            </a>
                        <?php else: ?>
                            <div class="ratio ratio-16x9">
                                <iframe src="<?= getSafe($item['file']) ?>" title="<?= getSafe($item['title']) ?>" allowfullscreen></iframe>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= getSafe($item['title']) ?></h5>
                            <p class="text-muted small mb-0"><?= getSafe($item['category_name']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
