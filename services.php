<?php
require_once __DIR__ . '/includes/header.php';
$services = fetchAll('SELECT * FROM services WHERE active = 1 ORDER BY sort_order, id');
?>
<section class="py-6">
    <div class="container">
        <div class="text-center mb-5">
            <h1>Our Services</h1>
            <p class="text-muted">Comprehensive architecture and interior design services from concept through completion.</p>
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
<?php require_once __DIR__ . '/includes/footer.php';
