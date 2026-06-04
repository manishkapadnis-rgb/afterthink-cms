<?php
require_once __DIR__ . '/includes/header.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? 'General Inquiry');
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
        // Optionally send an email notification to the admin
        // mail(EMAIL_FROM, 'New inquiry received', $messageText, "From: $name <$email>");
    } else {
        $message = 'Please fill out the required fields.';
    }
}
?>
<section class="py-6">
    <div class="container">
        <div class="text-center mb-5">
            <h1>Contact</h1>
            <p class="text-muted">Get in touch with Afterthink Studio for your next project.</p>
        </div>
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
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark">Send Message</button>
                </form>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-light rounded shadow-sm">
                    <h4>Contact Information</h4>
                    <p class="mb-1"><strong>Address:</strong> <?= getSafe($siteSettings['address'] ?? '123 Premium Ave, Design City') ?></p>
                    <p class="mb-1"><strong>Phone:</strong> <?= getSafe($siteSettings['phone'] ?? '+1 555 854 3210') ?></p>
                    <p class="mb-1"><strong>Email:</strong> <a href="mailto:<?= getSafe($siteSettings['contact_email'] ?? 'info@afterthinkstudio.com') ?>"><?= getSafe($siteSettings['contact_email'] ?? 'info@afterthinkstudio.com') ?></a></p>
                    <div class="mt-4">
                        <h5>Office Hours</h5>
                        <p class="mb-0">Monday - Friday: 9:00 AM - 6:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php';
