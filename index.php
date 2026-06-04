<?php
require_once __DIR__ . '/includes/header.php';
$sliders = fetchAll('SELECT * FROM hero_sliders WHERE active = 1 ORDER BY sort_order, id');
$services = fetchAll('SELECT * FROM services WHERE active = 1 ORDER BY sort_order, id LIMIT 6');
$portfolioItems = fetchAll('SELECT p.*, c.name AS category_name FROM portfolios p LEFT JOIN portfolio_categories c ON p.category_id = c.id WHERE p.active = 1 ORDER BY p.sort_order, p.id LIMIT 6');
$testimonials = fetchAll('SELECT * FROM testimonials WHERE active = 1 ORDER BY sort_order, id LIMIT 4');
$blogs = fetchAll('SELECT * FROM blogs WHERE active = 1 ORDER BY published_at DESC LIMIT 3');
$aboutTitle = $siteSettings['about_title'] ?? 'Our Philosophy';
$aboutText = $siteSettings['about_text'] ?? 'We create architecture and spaces that feel timeless, refined, and deeply personal.';
?>
<section class="hero-slider position-relative overflow-hidden text-white" style="background:#111">
    <div class="container py-6">
        <div class="row">
            <?php if ($sliders): ?>
                <div class="col-12">
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($sliders as $index => $slide): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" style="background-image:url('<?= UPLOAD_URL . getSafe($slide['image']) ?>'); background-size:cover; background-position:center; min-height: 620px;">
                                    <div class="carousel-caption d-flex flex-column justify-content-center h-100 bg-dark bg-opacity-50 p-4 rounded">
                                        <span class="text-uppercase text-warning mb-3"><?= getSafe($slide['label'] ?? 'Architecture') ?></span>
                                        <h1 class="display-5 fw-bold"><?= getSafe($slide['title'] ?? 'Signature Architecture & Interiors') ?></h1>
                                        <p class="lead mb-4"><?= getSafe($slide['description'] ?? 'Design with clarity, craft, and purpose.') ?></p>
                                        <?php if (!empty($slide['button_text'])): ?>
                                            <a href="<?= getSafe($slide['button_url'] ?: baseUrl('portfolio.php')) ?>" class="btn btn-outline-light"><?= getSafe($slide['button_text']) ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-12 text-center py-6">
                    <h1 class="display-4">Afterthink Studio</h1>
                    <p class="lead">Luxury architecture and interior design for discerning clients.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2><?= getSafe($aboutTitle) ?></h2>
                <p class="lead"><?= getSafe($aboutText) ?></p>
                <a class="btn btn-dark" href="<?= baseUrl('about.php') ?>">Learn More</a>
            </div>
            <div class="col-lg-6">
                <img src="<?= UPLOAD_URL . ($siteSettings['about_image'] ?? '') ?>" class="img-fluid rounded shadow" alt="About Afterthink Studio">
            </div>
        </div>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Our Services</h2>
            <p class="text-muted">Design services that cover architecture, interiors, and high-end project planning.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($services as $service): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($service['image'])): ?>
                            <img src="<?= UPLOAD_URL . getSafe($service['image']) ?>" class="card-img-top" alt="<?= getSafe($service['title']) ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= getSafe($service['title']) ?></h5>
                            <p class="card-text"><?= getSafe($service['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Featured Projects</h2>
            <p class="text-muted">A selection of our portfolio pieces across residential and commercial architecture.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($portfolioItems as $project): ?>
                <div class="col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($project['cover_image'])): ?>
                            <img src="<?= UPLOAD_URL . getSafe($project['cover_image']) ?>" class="card-img-top" alt="<?= getSafe($project['title']) ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <small class="text-uppercase text-muted"><?= getSafe($project['category_name'] ?: 'Architecture') ?></small>
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
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Testimonials</h2>
            <p class="text-muted">Hear from clients who have designed with Afterthink Studio.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($testimonials as $review): ?>
                <div class="col-md-6">
                    <div class="card bg-secondary text-white h-100 shadow-sm">
                        <div class="card-body">
                            <p class="card-text">"<?= getSafe($review['review']) ?>"</p>
                            <div class="mt-4">
                                <strong><?= getSafe($review['name']) ?></strong>
                                <div class="text-muted small"><?= getSafe($review['position']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Latest Insights</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($blogs as $post): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($post['image'])): ?>
                            <img src="<?= UPLOAD_URL . getSafe($post['image']) ?>" class="card-img-top" alt="<?= getSafe($post['title']) ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= getSafe($post['title']) ?></h5>
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
