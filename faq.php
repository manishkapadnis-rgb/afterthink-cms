<?php
require_once __DIR__ . '/includes/header.php';
$questions = fetchAll('SELECT * FROM faqs WHERE active = 1 ORDER BY sort_order, id');
?>
<section class="py-6 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1>Frequently Asked Questions</h1>
            <p class="text-muted">Answers to the most common questions about our architecture and design services.</p>
        </div>
        <div class="accordion" id="faqAccordion">
            <?php foreach ($questions as $index => $question): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $question['id'] ?>">
                        <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $question['id'] ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $question['id'] ?>">
                            <?= getSafe($question['question']) ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $question['id'] ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $question['id'] ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <?= nl2br(getSafe($question['answer'])) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
