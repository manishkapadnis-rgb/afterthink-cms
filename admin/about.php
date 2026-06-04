<?php
require_once __DIR__ . '/../includes/admin_header.php';
$siteSettings = getSiteSettings();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aboutTitle = trim($_POST['about_title'] ?? '');
    $aboutText = trim($_POST['about_text'] ?? '');
    $aboutDetails = trim($_POST['about_details'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $contactEmail = trim($_POST['contact_email'] ?? '');
    $image = uploadFile('about_image', $siteSettings['about_image'] ?? null);
    execute('UPDATE site_settings SET about_title = :about_title, about_text = :about_text, about_details = :about_details, about_image = :about_image, address = :address, phone = :phone, contact_email = :contact_email WHERE id = :id', [
        ':about_title' => $aboutTitle,
        ':about_text' => $aboutText,
        ':about_details' => $aboutDetails,
        ':about_image' => $image,
        ':address' => $address,
        ':phone' => $phone,
        ':contact_email' => $contactEmail,
        ':id' => $siteSettings['id'],
    ]);
    redirect('about.php');
}
?>
<h1 class="mb-4">Manage About Section</h1>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">About Title</label>
                    <input type="text" name="about_title" class="form-control" value="<?= getSafe($siteSettings['about_title'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Contact Email</label>
                    <input type="email" name="contact_email" class="form-control" value="<?= getSafe($siteSettings['contact_email'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Short About Text</label>
                    <textarea name="about_text" class="form-control" rows="3"><?= getSafe($siteSettings['about_text'] ?? '') ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Detailed About Content</label>
                    <textarea name="about_details" class="form-control" rows="5"><?= getSafe($siteSettings['about_details'] ?? '') ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="<?= getSafe($siteSettings['address'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= getSafe($siteSettings['phone'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">About Image</label>
                    <input type="file" name="about_image" class="form-control">
                    <?php if (!empty($siteSettings['about_image'])): ?>
                        <img src="<?= UPLOAD_URL . getSafe($siteSettings['about_image']) ?>" class="img-fluid rounded mt-2" alt="About image" style="max-height:120px;">
                    <?php endif; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-dark mt-3">Save</button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
