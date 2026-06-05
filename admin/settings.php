<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';
requireAdmin();

$section = ($_GET['section'] ?? 'contact') === 'seo' ? 'seo' : 'contact';
$model = new SettingModel();

$forms = [
    'contact' => [
        'title' => 'Contact Settings', 'nav' => 'contact',
        'load' => static fn (SettingModel $m): array => $m->getContactSettings(),
        'save' => static fn (SettingModel $m, array $d): bool => $m->updateContactSettings($d),
        'fields' => [
            'phone' => ['label' => 'Phone', 'type' => 'text'],
            'email' => ['label' => 'Email', 'type' => 'text'],
            'address' => ['label' => 'Address', 'type' => 'text', 'span' => 2],
            'google_map' => ['label' => 'Google Map Embed URL', 'type' => 'textarea', 'span' => 2],
            'facebook' => ['label' => 'Facebook URL', 'type' => 'text'],
            'instagram' => ['label' => 'Instagram URL', 'type' => 'text'],
            'linkedin' => ['label' => 'LinkedIn URL', 'type' => 'text'],
            'twitter' => ['label' => 'Twitter / X URL', 'type' => 'text'],
        ],
    ],
    'seo' => [
        'title' => 'SEO Settings', 'nav' => 'seo',
        'load' => static fn (SettingModel $m): array => $m->getSettings(),
        'save' => static fn (SettingModel $m, array $d): bool => $m->updateSettings($d),
        'fields' => [
            'site_name' => ['label' => 'Site Name', 'type' => 'text'],
            'default_meta_title' => ['label' => 'Default Meta Title', 'type' => 'text', 'span' => 2],
            'default_meta_description' => ['label' => 'Default Meta Description', 'type' => 'textarea', 'span' => 2],
            'default_meta_keywords' => ['label' => 'Default Meta Keywords', 'type' => 'textarea', 'span' => 2],
            'og_image' => ['label' => 'Default OG Image URL / Path', 'type' => 'text', 'span' => 2],
            'logo' => ['label' => 'Logo URL / Path', 'type' => 'text'],
            'favicon' => ['label' => 'Favicon URL / Path', 'type' => 'text'],
        ],
    ],
];

$form = $forms[$section];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();
    $data = [];
    foreach ($form['fields'] as $field => $config) {
        $value = trim((string) ($_POST[$field] ?? ''));
        $data[$field] = $value !== '' ? $value : null;
    }
    if ($form['save']($model, $data)) {
        setFlash($form['title'] . ' saved.');
    } else {
        setFlash('Could not save settings.', 'danger');
    }
    redirectAdmin('settings.php?section=' . $section);
}

$current = $form['load']($model);
$flash = getFlash();
$csrfToken = csrfToken();
$pageTitle = $form['title'];
$activeNav = $form['nav'];
require __DIR__ . '/partials/layout_top.php';
?>
<?php if ($flash) : ?><div class="alert <?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div><?php endif; ?>
<div class="panel">
    <div class="admin-toolbar">
        <h2><?php echo e($form['title']); ?></h2>
        <div class="admin-actions">
            <a href="settings.php?section=contact">Contact</a>
            <a href="settings.php?section=seo">SEO</a>
        </div>
    </div>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
        <div class="admin-form-grid">
            <?php foreach ($form['fields'] as $field => $config) : ?>
                <?php $value = $_POST[$field] ?? ($current[$field] ?? ''); ?>
                <div class="form-group <?php echo !empty($config['span']) ? 'span-2' : ''; ?>">
                    <label for="<?php echo e($field); ?>"><?php echo e($config['label']); ?></label>
                    <?php if ($config['type'] === 'textarea') : ?>
                        <textarea id="<?php echo e($field); ?>" name="<?php echo e($field); ?>"><?php echo e((string) $value); ?></textarea>
                    <?php else : ?>
                        <input id="<?php echo e($field); ?>" type="text" name="<?php echo e($field); ?>" value="<?php echo e((string) $value); ?>">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit">Save Settings</button>
    </form>
</div>
<?php require __DIR__ . '/partials/layout_bottom.php'; ?>
