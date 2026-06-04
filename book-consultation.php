<?php
require_once __DIR__ . '/includes/header.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $messageText = trim($_POST['message'] ?? '');

    if ($name && $email && $messageText) {
        execute('INSERT INTO inquiries (name, email, phone, subject, message, created_at, status) VALUES (:name, :email, :phone, :subject, :message, NOW(), :status)', [
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':subject' => 'Consultation Booking',
            ':message' => $messageText,
            ':status' => 'pending'
        ]);
        $message = 'Your consultation request has been submitted. We will contact you soon.';
    } else {
        $message = 'Please fill out all required fields.';
    }
}
?>
<section class="py-6 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1>Book Consultation</h1>
            <p class="text-muted">Request a design consultation and start planning your project.</p>
        </div>
        <?php if ($message): ?>
            <div class="alert alert-info"><?= getSafe($message) ?></div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form method="post" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="form-label">Tell us about your project</label>
                        <textarea name="message" class="form-control" rows="6" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
