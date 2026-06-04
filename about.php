<?php
require_once __DIR__ . '/includes/header.php';
$team = fetchAll('SELECT * FROM team_members WHERE active = 1 ORDER BY sort_order, id');
$aboutTitle = $siteSettings['about_title'] ?? 'About Afterthink Studio';
$aboutText = $siteSettings['about_text'] ?? 'We design architecture that supports unforgettable living experiences.';
?>
<section class="py-6 bg-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h1><?= getSafe($aboutTitle) ?></h1>
                <p class="lead"><?= getSafe($aboutText) ?></p>
                <p><?= getSafe($siteSettings['about_details'] ?? 'Our practice blends thoughtful modernism and refined materiality to create spaces that feel both intimate and expansive.') ?></p>
            </div>
            <div class="col-lg-6">
                <img src="<?= UPLOAD_URL . ($siteSettings['about_image'] ?? '') ?>" class="img-fluid rounded shadow" alt="About us">
            </div>
        </div>
        <div class="mt-5">
            <h2>Our Team</h2>
            <div class="row g-4 mt-3">
                <?php foreach ($team as $member): ?>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <?php if (!empty($member['image'])): ?>
                                <img src="<?= UPLOAD_URL . getSafe($member['image']) ?>" class="card-img-top" alt="<?= getSafe($member['name']) ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5><?= getSafe($member['name']) ?></h5>
                                <p class="text-muted mb-2"><?= getSafe($member['role']) ?></p>
                                <p><?= getSafe($member['bio']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
