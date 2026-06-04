<?php
require_once __DIR__ . '/includes/header.php';
$categorySlug = $_GET['category'] ?? null;
$categories = fetchAll('SELECT * FROM portfolio_categories WHERE active = 1 ORDER BY sort_order, id');
$params = [];
$sql = 'SELECT p.*, c.name AS category_name FROM portfolios p LEFT JOIN portfolio_categories c ON p.category_id = c.id WHERE p.active = 1';
if ($categorySlug) {
    $sql .= ' AND c.slug = :slug';
    $params[':slug'] = $categorySlug;
}
$sql .= ' ORDER BY p.sort_order, p.id';
$portfolioItems = fetchAll($sql, $params);
?>
<section class="py-6 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1>Portfolio</h1>
            <p class="text-muted">Browse our completed projects across categories and scales.</p>
        </div>
        <div class="mb-4 text-center">
            <a href="<?= baseUrl('portfolio.php') ?>" class="btn btn-sm btn-outline-dark <?= $categorySlug ? '' : 'active' ?>">All</a>
            <?php foreach ($categories as $category): ?>
                <a href="<?= baseUrl('portfolio.php?category=' . urlencode($category['slug'])) ?>" class="btn btn-sm btn-outline-dark <?= $categorySlug === $category['slug'] ? 'active' : '' ?>"><?= getSafe($category['name']) ?></a>
            <?php endforeach; ?>
        </div>
        <div class="row g-4">
            <?php foreach ($portfolioItems as $project): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($project['cover_image'])): ?>
                            <img src="<?= UPLOAD_URL . getSafe($project['cover_image']) ?>" class="card-img-top" alt="<?= getSafe($project['title']) ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <small class="text-muted"><?= getSafe($project['category_name']) ?></small>
                            <h5 class="card-title mt-2"><?= getSafe($project['title']) ?></h5>
                            <p class="card-text text-muted"><?= getSafe($project['location']) ?></p>
                            <a href="<?= baseUrl('project.php?slug=' . urlencode($project['slug'])) ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
