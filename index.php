<?php
require_once __DIR__ . '/includes/header.php';
$sliders = fetchAll('SELECT * FROM hero_sliders WHERE active = 1 ORDER BY sort_order, id');
$services = fetchAll('SELECT * FROM services WHERE active = 1 ORDER BY sort_order, id LIMIT 6');
$portfolioItems = fetchAll('SELECT p.*, c.name AS category_name FROM portfolios p LEFT JOIN portfolio_categories c ON p.category_id = c.id WHERE p.active = 1 ORDER BY p.sort_order, p.id LIMIT 6');
$testimonials = fetchAll('SELECT * FROM testimonials WHERE active = 1 ORDER BY sort_order, id LIMIT 4');
$blogs = fetchAll('SELECT * FROM blogs WHERE active = 1 ORDER BY published_at DESC LIMIT 3');
$aboutTitle = $siteSettings['about_title'] ?? 'Our Philosophy';
$aboutText = $siteSettings['about_text'] ?? 'We create architecture and spaces that feel timeless, refined, and deeply personal.';
$defaultSlides = [
    [
        'label' => 'Luxury Living',
        'title' => 'Architecture that feels deliberate, calm and considered',
        'description' => 'We shape elegant environments where material, light and spatial proportion work together.',
        'button_text' => 'View Portfolio',
        'button_url' => baseUrl('portfolio.php'),
        'image' => baseUrl('assets/images/home-hero-1.jpg')
    ],
    [
        'label' => 'Interior Stories',
        'title' => 'Tailored interiors with a sense of stillness and craft',
        'description' => 'Every project is designed with a balanced blend of beauty and purpose.',
        'button_text' => 'Our Services',
        'button_url' => baseUrl('services.php'),
        'image' => ''
    ],
    [
        'label' => 'Complete Spaces',
        'title' => 'From concept to completion, we design high-end environments',
        'description' => 'We collaborate with clients and consultants to deliver exceptional homes and studios.',
        'button_text' => 'Contact Us',
        'button_url' => baseUrl('contact.php'),
        'image' => ''
    ]
];
$slides = $sliders ?: $defaultSlides;
?>
<section class="hero-section position-relative text-white">
    <?php foreach ($slides as $index => $slide):
        $imageUrl = !empty($slide['image']) ? UPLOAD_URL . getSafe($slide['image']) : '';
        $backgroundStyle = $imageUrl ? "background-image: url('$imageUrl');" : 'background: linear-gradient(180deg, rgba(17,17,17,0.96) 0%, rgba(17,17,17,0.88) 100%);';
    ?>
        <div class="hero-slide <?= $index === 0 ? 'active' : '' ?>" style="<?= $backgroundStyle ?>">
            <div class="container h-100 d-flex align-items-end pb-5 hero-content">
                <div class="col-lg-7 px-0">
                    <span class="text-uppercase text-white-50 small mb-3 d-inline-block"><?= getSafe($slide['label']) ?></span>
                    <h1><?= getSafe($slide['title']) ?></h1>
                    <p class="lead mt-4 mb-4"><?= getSafe($slide['description']) ?></p>
                    <a href="<?= getSafe($slide['button_url']) ?>" class="btn btn-outline-light btn-lg"><?= getSafe($slide['button_text']) ?></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="hero-controls container justify-content-center">
        <button class="btn btn-outline-light btn-sm" type="button" data-action="prev-slide"><span class="material-symbols-outlined">chevron_left</span></button>
        <?php foreach ($slides as $index => $slide): ?>
            <button class="hero-dot <?= $index === 0 ? 'active' : '' ?>" type="button"></button>
        <?php endforeach; ?>
        <button class="btn btn-outline-light btn-sm" type="button" data-action="next-slide"><span class="material-symbols-outlined">chevron_right</span></button>
    </div>
</section>
<section class="py-6 bg-light">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
                <h2 class="section-title"><?= getSafe($aboutTitle) ?></h2>
                <p class="lead section-text"><?= getSafe($aboutText) ?></p>
                <p class="section-text">Our studio merges thoughtful architecture, refined interiors, and curated details to create calm yet compelling spaces. Every interior is designed to feel considered, functional, and quietly luxurious.</p>
                <a class="btn btn-dark mt-3" href="<?= baseUrl('about.php') ?>">Learn More</a>
            </div>
            <div class="col-lg-6">
                <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm">
                    <img src="<?= UPLOAD_URL . ($siteSettings['about_image'] ?? '') ?>" alt="About Afterthink Studio" class="w-100 h-100 object-fit-cover">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-6">
    <div class="container">
        <div class="text-center mb-5">
            <p class="text-uppercase text-muted small mb-2">What we do</p>
            <h2 class="section-title">Signature services</h2>
            <p class="section-text">A refined approach to architecture, interiors, and project management for residential and commercial spaces.</p>
        </div>
        <div class="row g-4">
            <?php if ($services): ?>
                <?php foreach ($services as $service): ?>
                    <div class="col-md-4">
                        <div class="section-card h-100">
                            <?php if (!empty($service['image'])): ?>
                                <img src="<?= UPLOAD_URL . getSafe($service['image']) ?>" alt="<?= getSafe($service['title']) ?>" class="mb-4 rounded-3 w-100" style="height: 260px; object-fit: cover;">
                            <?php endif; ?>
                            <h3><?= getSafe($service['title']) ?></h3>
                            <p><?= getSafe($service['description']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-4">
                    <div class="section-card h-100">
                        <h3>Bespoke Architecture</h3>
                        <p>Concept design, documentation, and project delivery for homes, studios, and boutique commercial spaces.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-card h-100">
                        <h3>Interior Direction</h3>
                        <p>Material, furniture, and lighting schemes that support understated luxury and lasting comfort.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-card h-100">
                        <h3>Project Management</h3>
                        <p>Integrated planning and coordination to ensure every build phase remains organized and deliberate.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="py-6 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <p class="text-uppercase text-muted small mb-2">Recent work</p>
            <h2 class="section-title">Featured Projects</h2>
            <p class="section-text">A selection of completed projects that illustrate our approach to form, materials, and space.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($portfolioItems as $project): ?>
                <div class="col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <?php if (!empty($project['cover_image'])): ?>
                            <div class="ratio ratio-4x3 overflow-hidden rounded-top">
                                <img src="<?= UPLOAD_URL . getSafe($project['cover_image']) ?>" alt="<?= getSafe($project['title']) ?>" class="w-100 h-100 object-fit-cover">
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <small class="text-uppercase text-muted"><?= getSafe($project['category_name'] ?: 'Architecture') ?></small>
                            <h3 class="mt-3"><?= getSafe($project['title']) ?></h3>
                            <p class="text-muted mb-3"><?= getSafe($project['location']) ?></p>
                            <a href="<?= baseUrl('project.php?slug=' . urlencode($project['slug'])) ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="py-6">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title">Design with clarity and craft</h2>
                <p class="section-text">Our process is shaped around collaboration, material research, and careful refinement. From initial study to final installation, we guide every element with precision.</p>
                <ul class="list-unstyled mt-4">
                    <li class="mb-3"><strong>Research-led concept</strong> that responds to site, light, and client priorities.</li>
                    <li class="mb-3"><strong>Thoughtful material selection</strong> for longevity and tactile quality.</li>
                    <li class="mb-3"><strong>Integrated delivery</strong> to keep design and construction aligned.</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="testimonial-box">
                    <p>“Afterthink Studio created a calm, elegant home that feels bespoke in every detail. Their sense of proportion and finish is exceptional.”</p>
                    <p class="testimonial-author mb-0">— Client testimonial, luxury residence</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
