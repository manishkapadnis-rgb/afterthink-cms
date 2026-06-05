<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';
requireAdmin();

$db = getDatabase();
$results = [];

/**
 * Each step is idempotent: it checks current schema state and only applies
 * what is missing, so this page is safe to run any number of times.
 */
function columnExists(PDO $db, string $table, string $column): bool
{
    $stmt = $db->prepare(
        'SELECT COUNT(*) FROM information_schema.COLUMNS
         WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :t AND COLUMN_NAME = :c'
    );
    $stmt->execute(['t' => $table, 'c' => $column]);
    return (int) $stmt->fetchColumn() > 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();

    $steps = [
        'hero_slides table' => static function (PDO $db): string {
            $db->exec(
                "CREATE TABLE IF NOT EXISTS `hero_slides` (
                  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                  `title` VARCHAR(255) NOT NULL,
                  `subtitle` VARCHAR(255) DEFAULT NULL,
                  `button_text` VARCHAR(150) DEFAULT NULL,
                  `button_link` VARCHAR(255) DEFAULT NULL,
                  `desktop_image` VARCHAR(255) DEFAULT NULL,
                  `mobile_image` VARCHAR(255) DEFAULT NULL,
                  `sort_order` INT NOT NULL DEFAULT 0,
                  `status` ENUM('draft','published') NOT NULL DEFAULT 'published',
                  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
            );
            return 'ready';
        },
        'hero_slides seed' => static function (PDO $db): string {
            if ((int) $db->query('SELECT COUNT(*) FROM hero_slides')->fetchColumn() > 0) {
                return 'already has rows — left as is';
            }
            $db->exec(
                "INSERT INTO `hero_slides` (`title`,`subtitle`,`button_text`,`button_link`,`sort_order`,`status`) VALUES
                ('The Poetry of Space','Curation & Design','Explore Interior Design','services',1,'published'),
                ('Defined Ambition','Executive Environments','Workspace Portfolio','portfolio',2,'published'),
                ('Timeless Horizons','Architectural Mastery','View Residences','portfolio',3,'published')"
            );
            return 'seeded 3 default slides';
        },
        'login_attempts table' => static function (PDO $db): string {
            $db->exec(
                "CREATE TABLE IF NOT EXISTS `login_attempts` (
                  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                  `ip_address` VARCHAR(45) NOT NULL,
                  `email` VARCHAR(150) DEFAULT NULL,
                  `attempted_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`),
                  INDEX `idx_login_attempts_ip_time` (`ip_address`,`attempted_at`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
            );
            return 'ready';
        },
        'services.sort_order column' => static function (PDO $db): string {
            if (columnExists($db, 'services', 'sort_order')) {
                return 'already present';
            }
            $db->exec('ALTER TABLE `services` ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `icon`');
            return 'added';
        },
        'projects.sort_order column' => static function (PDO $db): string {
            if (columnExists($db, 'projects', 'sort_order')) {
                return 'already present';
            }
            $db->exec('ALTER TABLE `projects` ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `gallery_preview`');
            return 'added';
        },
        'contact_settings default row' => static function (PDO $db): string {
            if ((int) $db->query('SELECT COUNT(*) FROM contact_settings')->fetchColumn() > 0) {
                return 'already present';
            }
            $db->exec(
                "INSERT INTO `contact_settings` (`phone`,`email`,`address`) VALUES
                ('+1 212 555 0184','hello@afterthink.studio','Afterthink Studio, Architecture and Interiors')"
            );
            return 'seeded default contact details';
        },
    ];

    foreach ($steps as $label => $step) {
        try {
            $results[] = ['label' => $label, 'ok' => true, 'detail' => $step($db)];
        } catch (Throwable $e) {
            $results[] = ['label' => $label, 'ok' => false, 'detail' => $e->getMessage()];
        }
    }
    setFlash('Migration run complete.');
}

$flash = getFlash();
$csrfToken = csrfToken();
$pageTitle = 'Database Migration';
$activeNav = '';
require __DIR__ . '/partials/layout_top.php';
?>
<?php if ($flash) : ?><div class="alert <?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div><?php endif; ?>

<?php if (!empty($results)) : ?>
    <div class="panel">
        <h2 style="margin-top:0;">Results</h2>
        <table class="admin-table">
            <thead><tr><th>Step</th><th>Status</th><th>Detail</th></tr></thead>
            <tbody>
            <?php foreach ($results as $r) : ?>
                <tr>
                    <td><?php echo e($r['label']); ?></td>
                    <td><span class="badge <?php echo $r['ok'] ? 'published' : 'archived'; ?>"><?php echo $r['ok'] ? 'OK' : 'ERROR'; ?></span></td>
                    <td><?php echo e($r['detail']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <p style="margin-top:18px;"><a class="admin-link" href="manage.php?module=hero_slides">Go to Hero Slider →</a></p>
    </div>
<?php endif; ?>

<div class="panel">
    <h2 style="margin-top:0;">Run schema migration</h2>
    <p class="muted">Creates any missing tables/columns (hero slides, login rate
        limiting, sort ordering, default contact details) and seeds defaults.
        This is idempotent — running it again will not duplicate or overwrite data.</p>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
        <button type="submit">Run Migration</button>
    </form>
</div>
<?php require __DIR__ . '/partials/layout_bottom.php'; ?>
