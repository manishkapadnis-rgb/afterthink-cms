<?php
require_once __DIR__ . '/includes/header.php';
$services = fetchAll('SELECT * FROM services WHERE active = 1 ORDER BY sort_order, id');
$faqs = fetchAll('SELECT * FROM faqs WHERE active = 1 ORDER BY sort_order, id LIMIT 4');
?>
<section class="py-6 bg-light">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
                <p class="text-uppercase text-muted small mb-2">Services</p>
                <h1 class="section-title">What we offer</h1>
                <p class="lead section-text">From architecture to interior composition, we deliver refined and purposeful design solutions tailored to each project.</p>
            </div>
            <div class="col-lg-6">
                <div class="section-card">
                    <h3>Creative direction for every stage</h3>
                    <p>We work closely with clients to translate vision into spaces that feel elevated, calm, and practical. Our service offering supports both new build and renovation projects.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-6">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our Service Portfolio</h2>
            <p class="section-text">A curated range of architecture, interior design and planning services for contemporary living.</p>
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
                        <h3>Architecture Strategy</h3>
                        <p>Concept development, material studies, and building documentation for residential and commercial projects.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-card h-100">
                        <h3>Interior Styling</h3>
                        <p>Design direction for furniture, lighting, and finishes that create coherent and inviting interiors.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-card h-100">
                        <h3>Project Coordination</h3>
                        <p>Delivery support, procurement guidance, and contractor coordination to ensure design integrity through construction.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="py-6 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="section-card">
                    <h2 class="section-title">Design process matters</h2>
                    <p class="section-text">We believe clear communication, smart planning and long-term materials thinking are the foundation of every successful project.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="section-card h-100">
                            <h3>Concept Planning</h3>
                            <p>Early feasibility and site analysis help define the design direction with clarity.</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="section-card h-100">
                            <h3>Detail Development</h3>
                            <p>We refine spatial layouts, technical details, and material selections for confident delivery.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-6">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Frequently asked questions</h2>
            <p class="section-text">Common project questions answered for a smoother collaboration.</p>
        </div>
        <div class="row g-4">
            <?php if ($faqs): ?>
                <?php foreach ($faqs as $faq): ?>
                    <div class="col-md-6">
                        <div class="section-card h-100">
                            <h4><?= getSafe($faq['question']) ?></h4>
                            <p><?= getSafe($faq['answer']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="section-card h-100">
                        <h4>Project start timelines</h4>
                        <p>Typical new project timelines depend on scope, but initial design proposals are usually available within 2–4 weeks.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
