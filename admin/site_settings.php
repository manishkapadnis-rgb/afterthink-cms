<?php
require_once __DIR__ . '/../includes/admin_header.php';
$settings = getSiteSettings();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $siteName = trim($_POST['site_name'] ?? '');
    $footerText = trim($_POST['footer_text'] ?? '');
    $logo = uploadFile('logo', $settings['logo'] ?? null);
    $favicon = uploadFile('favicon', $settings['favicon'] ?? null, ['image/x-icon', 'image/vnd.microsoft.icon', 'image/png', 'image/svg+xml']);
    execute('UPDATE site_settings SET site_name = :site_name, footer_text = :footer_text, logo = :logo, favicon = :favicon WHERE id = :id', [
        ':site_name' => $siteName,
        ':footer_text' => $footerText,
        ':logo' => $logo,
        ':favicon' => $favicon,
        ':id' => $settings['id'],
    ]);
    redirect('site_settings.php');
}
?>
<h1 class="mb-4">Manage Website Settings</h1>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="<?= getSafe($settings['site_name'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Footer Text</label>
                    <input type="text" name="footer_text" class="form-control" value="<?= getSafe($settings['footer_text'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control">
                    <?php if (!empty($settings['logo'])): ?>
                        <img src="<?= UPLOAD_URL . getSafe($settings['logo']) ?>" class="img-fluid rounded mt-2" alt="Logo" style="max-height:120px;">
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Favicon</label>
                    <input type="file" name="favicon" class="form-control">
                    <?php if (!empty($settings['favicon'])): ?>
                        <img src="<?= UPLOAD_URL . getSafe($settings['favicon']) ?>" class="img-fluid rounded mt-2" alt="Favicon" style="max-height:120px;">
                    <?php endif; ?>
                </div>
            </div>
            <button class="btn btn-dark mt-3">Save Website Settings</button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
