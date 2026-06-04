<?php
require_once __DIR__ . '/../includes/admin_header.php';
$sliderCount = fetchOne('SELECT COUNT(*) AS count FROM hero_sliders');
$serviceCount = fetchOne('SELECT COUNT(*) AS count FROM services');
$projectCount = fetchOne('SELECT COUNT(*) AS count FROM portfolios');
$inquiryCount = fetchOne('SELECT COUNT(*) AS count FROM inquiries WHERE status = "pending"');
?>
<h1 class="mb-4">Dashboard</h1>
<div class="row g-4">
    <div class="col-md-3">
        <div class="card shadow-sm p-4">
            <h5>Hero Slides</h5>
            <p class="display-6 mb-0"><?= $sliderCount['count'] ?></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm p-4">
            <h5>Services</h5>
            <p class="display-6 mb-0"><?= $serviceCount['count'] ?></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm p-4">
            <h5>Portfolio</h5>
            <p class="display-6 mb-0"><?= $projectCount['count'] ?></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm p-4">
            <h5>Pending Inquiries</h5>
            <p class="display-6 mb-0"><?= $inquiryCount['count'] ?></p>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
