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

function seedTable(PDO $db, string $table, array $columns, array $rows): string
{
    if ((int) $db->query("SELECT COUNT(*) FROM `{$table}`")->fetchColumn() > 0) {
        return 'skipped — already has content';
    }
    $cols = implode(', ', array_map(static fn (string $c): string => "`{$c}`", $columns));
    $ph = implode(', ', array_map(static fn (string $c): string => ':' . $c, $columns));
    $stmt = $db->prepare("INSERT INTO `{$table}` ({$cols}) VALUES ({$ph})");
    foreach ($rows as $row) {
        $params = [];
        foreach ($columns as $i => $c) {
            $params[$c] = $row[$i];
        }
        $stmt->execute($params);
    }
    return 'seeded ' . count($rows) . ' rows';
}

function seedBlog(PDO $db, array $blog): string
{
    if ((int) $db->query('SELECT COUNT(*) FROM blog_posts')->fetchColumn() > 0) {
        return 'skipped — already has posts';
    }
    $cat = $db->prepare('SELECT id FROM blog_categories WHERE slug = :s LIMIT 1');
    $cat->execute(['s' => $blog['category']['slug']]);
    $catId = $cat->fetchColumn();
    if (!$catId) {
        $db->prepare('INSERT INTO blog_categories (name, slug) VALUES (:n, :s)')
            ->execute(['n' => $blog['category']['name'], 's' => $blog['category']['slug']]);
        $catId = (int) $db->lastInsertId();
    }
    $stmt = $db->prepare('INSERT INTO blog_posts (category_id, title, slug, content, status, published_at) VALUES (:c, :t, :sl, :ct, \'published\', NOW())');
    foreach ($blog['posts'] as $p) {
        $stmt->execute(['c' => (int) $catId, 't' => $p['title'], 'sl' => $p['slug'], 'ct' => $p['content']]);
    }
    return 'seeded ' . count($blog['posts']) . ' posts';
}

function backfillTable(PDO $db, string $table, array $cfg): string
{
    $key = $cfg['backfill']['key'];
    $keyIdx = array_search($key, $cfg['columns'], true);
    $n = 0;
    foreach ($cfg['rows'] as $row) {
        $sets = [];
        $conds = [];
        $params = [':k' => $row[$keyIdx]];
        foreach ($cfg['backfill']['columns'] as $c) {
            $idx = array_search($c, $cfg['columns'], true);
            $sets[] = "`{$c}` = :{$c}";
            $params[":{$c}"] = $row[$idx];
            $conds[] = "(`{$c}` IS NULL OR `{$c}` = '')";
        }
        $sql = "UPDATE `{$table}` SET " . implode(', ', $sets)
            . " WHERE `{$key}` = :k AND (" . implode(' OR ', $conds) . ')';
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $n += $stmt->rowCount();
    }
    return "backfilled {$n} empty value(s)";
}

function runSeed(PDO $db): array
{
    $data = require __DIR__ . '/seed_data.php';
    $results = [];
    foreach ($data as $table => $cfg) {
        try {
            if ($table === 'blog') {
                $results[] = ['label' => 'blog posts', 'ok' => true, 'detail' => seedBlog($db, $cfg)];
                continue;
            }
            $detail = seedTable($db, $table, $cfg['columns'], $cfg['rows']);
            if (!empty($cfg['backfill'])) {
                $detail .= '; ' . backfillTable($db, $table, $cfg);
            }
            $results[] = ['label' => $table, 'ok' => true, 'detail' => $detail];
        } catch (Throwable $e) {
            $results[] = ['label' => $table, 'ok' => false, 'detail' => $e->getMessage()];
        }
    }
    return $results;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'seed') {
    requireValidCsrf();
    $results = runSeed($db);
    setFlash('Starter content load complete.');
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        'widen image/url columns' => static function (PDO $db): string {
            $alters = [
                'ALTER TABLE `hero_slides` MODIFY `desktop_image` VARCHAR(1024) DEFAULT NULL',
                'ALTER TABLE `hero_slides` MODIFY `mobile_image` VARCHAR(1024) DEFAULT NULL',
                'ALTER TABLE `projects` MODIFY `featured_image` VARCHAR(1024) DEFAULT NULL',
                'ALTER TABLE `projects` MODIFY `gallery_preview` VARCHAR(1024) DEFAULT NULL',
                'ALTER TABLE `services` MODIFY `image` VARCHAR(1024) DEFAULT NULL',
                'ALTER TABLE `testimonials` MODIFY `photo` VARCHAR(1024) DEFAULT NULL',
                'ALTER TABLE `team_members` MODIFY `image` VARCHAR(1024) DEFAULT NULL',
                'ALTER TABLE `blog_posts` MODIFY `featured_image` VARCHAR(1024) DEFAULT NULL',
                'ALTER TABLE `project_gallery` MODIFY `image_path` VARCHAR(1024) NOT NULL',
                'ALTER TABLE `pages` MODIFY `og_image` VARCHAR(1024) DEFAULT NULL',
            ];
            $done = 0;
            foreach ($alters as $sql) {
                try { $db->exec($sql); $done++; } catch (Throwable $e) { /* column may not exist */ }
            }
            return "widened {$done} columns to hold long image URLs";
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

<div class="panel">
    <h2 style="margin-top:0;">Load starter content</h2>
    <p class="muted">Populates empty modules (hero slides, services, projects,
        testimonials, team, pages and blog) with the site's starter content so
        the admin is editable and the frontend renders from the database. Only
        tables that are currently empty are filled — existing content is never
        changed or duplicated.</p>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
        <input type="hidden" name="action" value="seed">
        <button type="submit">Load Starter Content</button>
    </form>
</div>
<?php require __DIR__ . '/partials/layout_bottom.php'; ?>
