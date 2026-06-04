<?php
require_once __DIR__ . '/../includes/admin_header.php';
$settings = getSeoSettings();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metaTitle = trim($_POST['meta_title'] ?? '');
    $metaDescription = trim($_POST['meta_description'] ?? '');
    $metaKeywords = trim($_POST['meta_keywords'] ?? '');
    $ogTitle = trim($_POST['og_title'] ?? '');
    $ogDescription = trim($_POST['og_description'] ?? '');
    execute('UPDATE seo_settings SET meta_title = :meta_title, meta_description = :meta_description, meta_keywords = :meta_keywords, og_title = :og_title, og_description = :og_description WHERE id = :id', [
        ':meta_title' => $metaTitle,
        ':meta_description' => $metaDescription,
        ':meta_keywords' => $metaKeywords,
        ':og_title' => $ogTitle,
        ':og_description' => $ogDescription,
        ':id' => $settings['id'],
    ]);
    redirect('seo_settings.php');
}
?>
<h1 class="mb-4">Manage SEO Settings</h1>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="post">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="<?= getSafe($settings['meta_title'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3"><?= getSafe($settings['meta_description'] ?? '') ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="<?= getSafe($settings['meta_keywords'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Open Graph Title</label>
                    <input type="text" name="og_title" class="form-control" value="<?= getSafe($settings['og_title'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Open Graph Description</label>
                    <textarea name="og_description" class="form-control" rows="3"><?= getSafe($settings['og_description'] ?? '') ?></textarea>
                </div>
            </div>
            <button class="btn btn-dark mt-3">Save SEO Settings</button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
