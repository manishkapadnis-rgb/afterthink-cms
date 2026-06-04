<?php
require_once __DIR__ . '/includes/header.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? 'Project Inquiry');
    $messageText = trim($_POST['message'] ?? '');

    if ($name && $email && $messageText) {
        execute('INSERT INTO inquiries (name, email, phone, subject, message, created_at, status) VALUES (:name, :email, :phone, :subject, :message, NOW(), :status)', [
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':subject' => $subject,
            ':message' => $messageText,
            ':status' => 'pending'
        ]);
        $message = 'Thank you! Your message has been submitted successfully.';
    } else {
        $message = 'Please fill out the required fields.';
    }
}
?>
<section class="py-6 bg-light">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-7">
                <p class="text-uppercase text-muted small mb-2">Contact</p>
                <h1 class="section-title">Let’s start your project</h1>
                <p class="lead section-text">Reach out to Afterthink Studio to discuss your architecture or interior design project. We will respond with next steps and a project discovery conversation.</p>
            </div>
            <div class="col-lg-5">
                <div class="section-card">
                    <h3>Get in touch</h3>
                    <p>We are available for consultations, site reviews, and new commissions. Tell us about your project and we’ll be in touch shortly.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-6">
    <div class="container">
        <?php if ($message): ?>
            <div class="alert alert-info"><?= getSafe($message) ?></div>
        <?php endif; ?>
        <div class="row g-4">
            <div class="col-lg-6">
                <form method="post" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" value="Project Inquiry">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="6" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark">Send Message</button>
                </form>
            </div>
            <div class="col-lg-6">
                <div class="section-card h-100">
                    <h3>Contact information</h3>
                    <p class="section-text mb-4">Use the details below to connect directly with our studio, or send a project summary using the form.</p>
                    <p class="mb-2"><strong>Address:</strong><br><?= getSafe($siteSettings['address'] ?? '123 Premium Ave, Design City') ?></p>
                    <p class="mb-2"><strong>Phone:</strong><br><?= getSafe($siteSettings['phone'] ?? '+1 555 854 3210') ?></p>
                    <p class="mb-2"><strong>Email:</strong><br><a href="mailto:<?= getSafe($siteSettings['contact_email'] ?? 'info@afterthinkstudio.com') ?>"><?= getSafe($siteSettings['contact_email'] ?? 'info@afterthinkstudio.com') ?></a></p>
                    <div class="mt-4">
                        <h5>Office Hours</h5>
                        <p class="mb-0">Monday – Friday: 9:00 AM – 6:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
