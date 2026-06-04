<?php
require_once __DIR__ . '/includes/header.php';
$slug = $_GET['slug'] ?? null;
$project = fetchOne('SELECT p.*, c.name AS category_name FROM portfolios p LEFT JOIN portfolio_categories c ON p.category_id = c.id WHERE p.slug = :slug AND p.active = 1 LIMIT 1', [':slug' => $slug]);
if (!$project) {
    header('HTTP/1.0 404 Not Found');
    echo '<section class="py-6"><div class="container"><h1>Project not found</h1><p>The requested project could not be found.</p></div></section>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}
$galleryItems = fetchAll('SELECT * FROM portfolio_images WHERE portfolio_id = :id ORDER BY id', [':id' => $project['id']]);
$meta = [
    'meta_title' => $project['title'] . ' | Afterthink Studio',
    'meta_description' => substr($project['description'], 0, 155),
    'og_image' => $project['cover_image'],
];
?>
<section class="py-6">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <h1><?= getSafe($project['title']) ?></h1>
                <p class="text-muted mb-1"><?= getSafe($project['category_name']) ?> &middot; <?= getSafe($project['location']) ?></p>
                <p class="mb-3"><?= getSafe($project['description']) ?></p>
                <ul class="list-unstyled">
                    <li><strong>Area:</strong> <?= getSafe($project['area']) ?></li>
                    <li><strong>Completion Date:</strong> <?= getSafe($project['completion_date']) ?></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <?php if (!empty($project['cover_image'])): ?>
                    <img src="<?= UPLOAD_URL . getSafe($project['cover_image']) ?>" class="img-fluid rounded shadow" alt="<?= getSafe($project['title']) ?>">
                <?php endif; ?>
            </div>
        </div>
        <?php if ($galleryItems): ?>
            <div class="row g-3 mt-5">
                <?php foreach ($galleryItems as $item): ?>
                    <div class="col-md-4">
                        <div class="card overflow-hidden shadow-sm">
                            <img src="<?= UPLOAD_URL . getSafe($item['image']) ?>" class="card-img-top" alt="Project image">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($project['project_video'])): ?>
            <div class="mt-5">
                <h3>Project Video</h3>
                <div class="ratio ratio-16x9">
                    <iframe src="<?= getSafe($project['project_video']) ?>" title="Project video" allowfullscreen></iframe>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
