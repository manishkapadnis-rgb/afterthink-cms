<?php
require_once __DIR__ . '/includes/header.php';
$steps = [
    ['title' => 'Discovery', 'description' => 'We begin by understanding your goals, budget, and the vision for your space.'],
    ['title' => 'Concept', 'description' => 'Our designers create tailored concepts that reflect your style and functional needs.'],
    ['title' => 'Development', 'description' => 'We refine materials, finishes, and construction details for a cohesive result.'],
    ['title' => 'Delivery', 'description' => 'The final phase brings your project to life with careful coordination and quality control.'],
];
?>
<section class="py-6">
    <div class="container">
        <div class="text-center mb-5">
            <h1>Our Process</h1>
            <p class="text-muted">A structured design process that keeps every project aligned and thoughtfully executed.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($steps as $index => $step): ?>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="badge bg-dark rounded-pill mb-3">Step <?= $index + 1 ?></div>
                            <h5><?= getSafe($step['title']) ?></h5>
                            <p class="text-muted mt-3"><?= getSafe($step['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
