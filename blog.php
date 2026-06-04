<?php
require_once __DIR__ . '/includes/header.php';
$posts = fetchAll('SELECT * FROM blogs WHERE active = 1 ORDER BY published_at DESC');
?>
<section class="py-6 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1>Blog</h1>
            <p class="text-muted">Insights and design thinking from the Afterthink Studio team.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($post['image'])): ?>
                            <img src="<?= UPLOAD_URL . getSafe($post['image']) ?>" class="card-img-top" alt="<?= getSafe($post['title']) ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <small class="text-muted"><?= date('F j, Y', strtotime($post['published_at'])) ?></small>
                            <h5 class="card-title mt-2"><?= getSafe($post['title']) ?></h5>
                            <p class="card-text text-muted"><?= getSafe($post['excerpt']) ?></p>
                            <a href="<?= baseUrl('blog-details.php?slug=' . urlencode($post['slug'])) ?>" class="btn btn-sm btn-outline-dark">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
