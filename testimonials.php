<?php
require_once __DIR__ . '/includes/header.php';
$testimonials = fetchAll('SELECT * FROM testimonials WHERE active = 1 ORDER BY sort_order, id');
?>
<section class="py-6">
    <div class="container">
        <div class="text-center mb-5">
            <h1>Testimonials</h1>
            <p class="text-muted">Client reviews and project experiences from our design portfolio.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($testimonials as $review): ?>
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
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
<?php require_once __DIR__ . '/includes/footer.php';
