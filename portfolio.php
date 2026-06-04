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
            <p class="text-uppercase text-muted small mb-2">Portfolio</p>
            <h1 class="section-title">Recent projects</h1>
            <p class="section-text">Discover a range of completed works that define our thoughtful architectural and interior approach.</p>
        </div>
        <div class="mb-5 text-center">
            <a href="<?= baseUrl('portfolio.php') ?>" class="btn btn-sm btn-outline-dark <?= $categorySlug ? '' : 'active' ?>">All</a>
            <?php foreach ($categories as $category): ?>
                <a href="<?= baseUrl('portfolio.php?category=' . urlencode($category['slug'])) ?>" class="btn btn-sm btn-outline-dark <?= $categorySlug === $category['slug'] ? 'active' : '' ?>"><?= getSafe($category['name']) ?></a>
            <?php endforeach; ?>
        </div>
        <div class="row g-4 masonry-grid">
            <?php foreach ($portfolioItems as $project): ?>
                <div class="col-lg-6 masonry-item">
                    <div class="card h-100 border-0 shadow-sm position-relative overflow-hidden">
                        <?php if (!empty($project['cover_image'])): ?>
                            <img src="<?= UPLOAD_URL . getSafe($project['cover_image']) ?>" class="w-100" alt="<?= getSafe($project['title']) ?>" style="height: 420px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="overlay"></div>
                        <div class="masonry-item-content p-4">
                            <small class="text-uppercase text-white-75"><?= getSafe($project['category_name'] ?: 'Architecture') ?></small>
                            <h3 class="text-white mt-2"><?= getSafe($project['title']) ?></h3>
                            <p class="text-white-75 mb-0"><?= getSafe($project['location']) ?></p>
                            <a href="<?= baseUrl('project.php?slug=' . urlencode($project['slug'])) ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
