<?php
require_once __DIR__ . '/includes/header.php';
$team = fetchAll('SELECT * FROM team_members WHERE active = 1 ORDER BY sort_order, id');
$aboutTitle = $siteSettings['about_title'] ?? 'About Afterthink Studio';
$aboutText = $siteSettings['about_text'] ?? 'We design architecture that supports unforgettable living experiences.';
?>
<section class="py-6 bg-light">
    <div class="container">
        <div class="row align-items-end gy-5">
            <div class="col-lg-6">
                <p class="text-uppercase text-muted small mb-2">About</p>
                <h1 class="section-title"><?= getSafe($aboutTitle) ?></h1>
                <p class="lead section-text"><?= getSafe($aboutText) ?></p>
                <p class="section-text">Afterthink Studio approaches architecture with a belief that every space should feel calm, carefully composed and personal. We design homes, studios and tailored interiors with a quiet sense of luxury.</p>
            </div>
            <div class="col-lg-6">
                <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm">
                    <img src="<?= !empty($siteSettings['about_image']) ? UPLOAD_URL . $siteSettings['about_image'] : baseUrl('assets/images/about-hero.jpg') ?>" alt="About Afterthink Studio" class="w-100 h-100 object-fit-cover">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-6">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="section-card">
                    <h2>Our Studio Philosophy</h2>
                    <p>We believe good architecture is quiet, generous and deeply responsive to client needs, context, and everyday life. Every project is guided by material intelligence, spatial clarity, and restrained detail.</p>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-3"><strong>Thoughtful craft</strong> in every material and finish choice.</li>
                        <li class="mb-3"><strong>Balanced composition</strong> across light, scale and proportion.</li>
                        <li class="mb-3"><strong>Client-led design</strong> that reflects personal ambitions.</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm">
                    <img src="<?= UPLOAD_URL . ($siteSettings['about_image'] ?? '') ?>" alt="Design studio interior" class="w-100 h-100 object-fit-cover">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-6 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <p class="text-uppercase text-muted small mb-2">Team</p>
            <h2 class="section-title">Creative leadership</h2>
            <p class="section-text">A collaborative team of architects, designers and project managers working together from concept through completion.</p>
        </div>
        <div class="row g-4">
            <?php if ($team): ?>
                <?php foreach ($team as $member): ?>
                    <div class="col-md-4">
                        <div class="card h-100 section-card">
                            <?php if (!empty($member['image'])): ?>
                                <div class="ratio ratio-4x3 overflow-hidden rounded-top">
                                    <img src="<?= UPLOAD_URL . getSafe($member['image']) ?>" alt="<?= getSafe($member['name']) ?>" class="w-100 h-100 object-fit-cover">
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h3><?= getSafe($member['name']) ?></h3>
                                <p class="text-muted mb-3"><?= getSafe($member['role']) ?></p>
                                <p><?= getSafe($member['bio']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Team details are being prepared for this studio profile.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
