<?php
require_once __DIR__ . '/includes/header.php';
$steps = [
    ['title' => 'Discovery', 'description' => 'We begin by understanding your goals, budget, and the vision for your space.'],
    ['title' => 'Concept', 'description' => 'Our designers create tailored concepts that reflect your style and functional needs.'],
    ['title' => 'Development', 'description' => 'We refine materials, finishes, and construction details for a cohesive result.'],
    ['title' => 'Delivery', 'description' => 'The final phase brings your project to life with careful coordination and quality control.'],
];
?>
<section class="py-6 bg-light">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
                <p class="text-uppercase text-muted small mb-2">Process</p>
                <h1 class="section-title">A thoughtful process</h1>
                <p class="lead section-text">From initial concept to final delivery, our process is structured to ensure clarity, collaboration and high-quality outcomes.</p>
            </div>
            <div class="col-lg-6">
                <div class="section-card">
                    <h3>Designed for confident decision-making</h3>
                    <p>We structure each phase so clients stay informed and design decisions are made with clarity and intention.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-6">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($steps as $index => $step): ?>
                <div class="col-md-6">
                    <div class="process-step">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-dark rounded-pill me-3">Step <?= $index + 1 ?></span>
                            <h4 class="mb-0"><?= getSafe($step['title']) ?></h4>
                        </div>
                        <p class="text-muted"><?= getSafe($step['description']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="py-6 bg-light">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm">
                    <img src="<?= !empty($siteSettings['about_image']) ? UPLOAD_URL . $siteSettings['about_image'] : baseUrl('assets/images/process-1.jpg') ?>" alt="Design process" class="w-100 h-100 object-fit-cover">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-card">
                    <h3>Why our process works</h3>
                    <p>Clear milestones, thoughtful coordination, and strong communication ensure design intent carries through construction and handover.</p>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-3"><strong>Focused principles</strong> that shape every decision.</li>
                        <li class="mb-3"><strong>Consultant collaboration</strong> for seamless delivery.</li>
                        <li class="mb-3"><strong>Careful sequencing</strong> to reduce risk and streamline the build.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
