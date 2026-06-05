<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';
requireAdmin();

$modules = [
    'hero_slides' => [
        'label' => 'Hero Slides', 'singular' => 'Hero Slide', 'table' => 'hero_slides',
        'title' => 'title', 'nav' => 'hero_slides',
        'list' => ['title', 'subtitle', 'sort_order', 'status'],
        'order' => 'sort_order ASC, id ASC', 'search' => ['title', 'subtitle'],
        'fields' => [
            'title' => ['label' => 'Title', 'type' => 'text', 'required' => true],
            'subtitle' => ['label' => 'Subtitle / Eyebrow', 'type' => 'text'],
            'button_text' => ['label' => 'Button Text', 'type' => 'text'],
            'button_link' => ['label' => 'Button Link (route or URL)', 'type' => 'text'],
            'desktop_image' => ['label' => 'Desktop Image URL / Path', 'type' => 'text'],
            'mobile_image' => ['label' => 'Mobile Image URL / Path', 'type' => 'text'],
            'sort_order' => ['label' => 'Sort Order', 'type' => 'number'],
            'status' => ['label' => 'Status', 'type' => 'status'],
        ],
    ],
    'pages' => [
        'label' => 'Pages', 'singular' => 'Page', 'table' => 'pages',
        'title' => 'title', 'nav' => 'pages',
        'list' => ['title', 'slug', 'status'],
        'order' => 'id DESC', 'search' => ['title', 'slug'],
        'fields' => [
            'title' => ['label' => 'Page Title', 'type' => 'text', 'required' => true],
            'slug' => ['label' => 'Slug', 'type' => 'text'],
            'meta_title' => ['label' => 'Meta Title', 'type' => 'text'],
            'meta_description' => ['label' => 'Meta Description', 'type' => 'textarea', 'span' => 2],
            'meta_keywords' => ['label' => 'Meta Keywords', 'type' => 'textarea', 'span' => 2],
            'canonical_url' => ['label' => 'Canonical URL', 'type' => 'text'],
            'og_title' => ['label' => 'OG Title', 'type' => 'text'],
            'og_description' => ['label' => 'OG Description', 'type' => 'textarea', 'span' => 2],
            'og_image' => ['label' => 'OG Image URL / Path', 'type' => 'text'],
            'content' => ['label' => 'Content', 'type' => 'textarea', 'span' => 2],
            'status' => ['label' => 'Status', 'type' => 'status'],
        ],
    ],
    'services' => [
        'label' => 'Services', 'singular' => 'Service', 'table' => 'services',
        'title' => 'name', 'nav' => 'services',
        'list' => ['name', 'slug', 'sort_order', 'status'],
        'order' => 'sort_order ASC, id ASC', 'search' => ['name', 'slug'],
        'fields' => [
            'name' => ['label' => 'Service Name', 'type' => 'text', 'required' => true],
            'slug' => ['label' => 'Slug', 'type' => 'text'],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'span' => 2],
            'image' => ['label' => 'Image URL / Path', 'type' => 'text'],
            'icon' => ['label' => 'Icon (material symbol name)', 'type' => 'text'],
            'sort_order' => ['label' => 'Sort Order', 'type' => 'number'],
            'meta_title' => ['label' => 'Meta Title', 'type' => 'text'],
            'meta_description' => ['label' => 'Meta Description', 'type' => 'textarea', 'span' => 2],
            'meta_keywords' => ['label' => 'Meta Keywords', 'type' => 'textarea', 'span' => 2],
            'status' => ['label' => 'Status', 'type' => 'status'],
        ],
    ],
    'projects' => [
        'label' => 'Projects', 'singular' => 'Project', 'table' => 'projects',
        'title' => 'name', 'nav' => 'projects',
        'list' => ['name', 'slug', 'category', 'sort_order', 'status'],
        'order' => 'sort_order ASC, id ASC', 'search' => ['name', 'slug', 'category'],
        'fields' => [
            'name' => ['label' => 'Project Name', 'type' => 'text', 'required' => true],
            'slug' => ['label' => 'Slug', 'type' => 'text'],
            'category' => ['label' => 'Category', 'type' => 'text'],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'span' => 2],
            'featured_image' => ['label' => 'Featured Image URL / Path', 'type' => 'text'],
            'gallery_preview' => ['label' => 'Gallery Preview URL / Path', 'type' => 'text'],
            'sort_order' => ['label' => 'Sort Order', 'type' => 'number'],
            'meta_title' => ['label' => 'Meta Title', 'type' => 'text'],
            'meta_description' => ['label' => 'Meta Description', 'type' => 'textarea', 'span' => 2],
            'meta_keywords' => ['label' => 'Meta Keywords', 'type' => 'textarea', 'span' => 2],
            'status' => ['label' => 'Status', 'type' => 'status'],
        ],
    ],
    'gallery' => [
        'label' => 'Project Gallery', 'singular' => 'Gallery Image', 'table' => 'project_gallery',
        'title' => 'image_path', 'nav' => 'gallery',
        'list' => ['project_name', 'image_path', 'caption', 'sort_order'],
        'order' => 'sort_order ASC, id DESC', 'search' => ['caption', 'image_path'],
        'join' => 'LEFT JOIN projects pr ON pr.id = t.project_id',
        'select_extra' => ', pr.name AS project_name',
        'fields' => [
            'project_id' => ['label' => 'Project', 'type' => 'reference', 'required' => true, 'ref_table' => 'projects', 'ref_label' => 'name'],
            'image_path' => ['label' => 'Image URL / Path', 'type' => 'text', 'required' => true],
            'caption' => ['label' => 'Caption', 'type' => 'text'],
            'sort_order' => ['label' => 'Sort Order', 'type' => 'number'],
        ],
    ],
    'testimonials' => [
        'label' => 'Testimonials', 'singular' => 'Testimonial', 'table' => 'testimonials',
        'title' => 'client_name', 'nav' => 'testimonials',
        'list' => ['client_name', 'company', 'rating', 'status'],
        'order' => 'id DESC', 'search' => ['client_name', 'company'],
        'fields' => [
            'client_name' => ['label' => 'Client Name', 'type' => 'text', 'required' => true],
            'company' => ['label' => 'Company / Context', 'type' => 'text'],
            'review' => ['label' => 'Review', 'type' => 'textarea', 'span' => 2, 'required' => true],
            'rating' => ['label' => 'Rating (1-5)', 'type' => 'number'],
            'photo' => ['label' => 'Photo URL / Path', 'type' => 'text'],
            'status' => ['label' => 'Status', 'type' => 'status'],
        ],
    ],
    'team_members' => [
        'label' => 'Team Members', 'singular' => 'Team Member', 'table' => 'team_members',
        'title' => 'name', 'nav' => 'team_members',
        'list' => ['name', 'designation', 'status'],
        'order' => 'id DESC', 'search' => ['name', 'designation'],
        'fields' => [
            'name' => ['label' => 'Name', 'type' => 'text', 'required' => true],
            'designation' => ['label' => 'Designation', 'type' => 'text'],
            'bio' => ['label' => 'Bio', 'type' => 'textarea', 'span' => 2],
            'image' => ['label' => 'Photo URL / Path', 'type' => 'text'],
            'status' => ['label' => 'Status', 'type' => 'status'],
        ],
    ],
    'blog' => [
        'label' => 'Blog Posts', 'singular' => 'Blog Post', 'table' => 'blog_posts',
        'title' => 'title', 'nav' => 'blog',
        'list' => ['title', 'slug', 'category_name', 'status'],
        'order' => 'p.created_at DESC, p.id DESC', 'search' => ['title', 'slug'],
        'fields' => [
            'title' => ['label' => 'Title', 'type' => 'text', 'required' => true],
            'slug' => ['label' => 'Slug', 'type' => 'text'],
            'category_name' => ['label' => 'Category', 'type' => 'text', 'virtual' => true],
            'content' => ['label' => 'Content', 'type' => 'textarea', 'span' => 2],
            'featured_image' => ['label' => 'Featured Image URL / Path', 'type' => 'text'],
            'published_at' => ['label' => 'Published At', 'type' => 'datetime'],
            'meta_title' => ['label' => 'Meta Title', 'type' => 'text'],
            'meta_description' => ['label' => 'Meta Description', 'type' => 'textarea', 'span' => 2],
            'meta_keywords' => ['label' => 'Meta Keywords', 'type' => 'textarea', 'span' => 2],
            'status' => ['label' => 'Status', 'type' => 'status'],
        ],
    ],
    'blog_categories' => [
        'label' => 'Blog Categories', 'singular' => 'Blog Category', 'table' => 'blog_categories',
        'title' => 'name', 'nav' => 'blog_categories',
        'list' => ['name', 'slug'],
        'order' => 'name ASC', 'search' => ['name', 'slug'],
        'fields' => [
            'name' => ['label' => 'Category Name', 'type' => 'text', 'required' => true],
            'slug' => ['label' => 'Slug', 'type' => 'text'],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'span' => 2],
        ],
    ],
];

$moduleKey = $_GET['module'] ?? 'services';
if (!is_string($moduleKey) || !isset($modules[$moduleKey])) {
    http_response_code(404);
    echo 'Unknown admin module.';
    exit;
}

$module = $modules[$moduleKey];
$db = getDatabase();
$errors = [];
$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? max(0, (int) $_GET['id']) : 0;
$search = trim((string) ($_GET['q'] ?? ''));
$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 12;

function refOptions(PDO $db, array $field): array
{
    $table = preg_replace('/[^a-z_]/', '', $field['ref_table']);
    $label = preg_replace('/[^a-z_]/', '', $field['ref_label']);
    try {
        return $db->query("SELECT id, {$label} AS label FROM {$table} ORDER BY {$label} ASC")->fetchAll();
    } catch (Throwable $e) {
        return [];
    }
}

function fetchCrudItem(PDO $db, array $module, int $id): ?array
{
    $table = $module['table'];
    if ($table === 'blog_posts') {
        $stmt = $db->prepare('SELECT p.*, c.name AS category_name FROM blog_posts p LEFT JOIN blog_categories c ON c.id = p.category_id WHERE p.id = :id LIMIT 1');
    } else {
        $stmt = $db->prepare("SELECT * FROM {$table} WHERE id = :id LIMIT 1");
    }
    $stmt->execute(['id' => $id]);
    return $stmt->fetch() ?: null;
}

function buildSearchClause(array $module, string $search, array &$params): string
{
    if ($search === '' || empty($module['search'])) {
        return '';
    }
    $prefix = $module['table'] === 'blog_posts' ? 'p.' : ($module['table'] === 'project_gallery' ? 't.' : '');
    $parts = [];
    foreach ($module['search'] as $i => $col) {
        $parts[] = "{$prefix}{$col} LIKE :q{$i}";
        $params[":q{$i}"] = '%' . $search . '%';
    }
    return ' WHERE (' . implode(' OR ', $parts) . ')';
}

function countCrudItems(PDO $db, array $module, string $search): int
{
    $params = [];
    if ($module['table'] === 'blog_posts') {
        $sql = 'SELECT COUNT(*) FROM blog_posts p' . buildSearchClause($module, $search, $params);
    } else {
        $sql = "SELECT COUNT(*) FROM {$module['table']} t" . buildSearchClause($module, $search, $params);
    }
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return (int) $stmt->fetchColumn();
}

function fetchCrudItems(PDO $db, array $module, string $search, int $limit, int $offset): array
{
    $params = [];
    if ($module['table'] === 'blog_posts') {
        $sql = 'SELECT p.*, c.name AS category_name FROM blog_posts p LEFT JOIN blog_categories c ON c.id = p.category_id'
            . buildSearchClause($module, $search, $params)
            . ' ORDER BY ' . $module['order'];
    } else {
        $extra = $module['select_extra'] ?? '';
        $join = $module['join'] ?? '';
        $sql = "SELECT t.*{$extra} FROM {$module['table']} t {$join}"
            . buildSearchClause($module, $search, $params)
            . ' ORDER BY ' . $module['order'];
    }
    $sql .= " LIMIT {$limit} OFFSET {$offset}";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function getOrCreateBlogCategory(PDO $db, string $name): ?int
{
    $name = trim($name);
    if ($name === '') {
        return null;
    }
    $slug = slugify($name);
    $stmt = $db->prepare('SELECT id FROM blog_categories WHERE slug = :slug LIMIT 1');
    $stmt->execute(['slug' => $slug]);
    $existing = $stmt->fetch();
    if ($existing) {
        return (int) $existing['id'];
    }
    $stmt = $db->prepare('INSERT INTO blog_categories (name, slug) VALUES (:name, :slug)');
    $stmt->execute(['name' => $name, 'slug' => $slug]);
    return (int) $db->lastInsertId();
}

function normalizeCrudValue(string $field, array $config): mixed
{
    $value = $_POST[$field] ?? null;
    if ($config['type'] === 'number' || $config['type'] === 'reference') {
        return (int) ($value ?? 0);
    }
    if ($config['type'] === 'status') {
        return normalizeStatus((string) ($value ?? 'draft'));
    }
    if ($config['type'] === 'datetime') {
        $value = trim((string) ($value ?? ''));
        return $value !== '' ? str_replace('T', ' ', $value) . (strlen($value) === 16 ? ':00' : '') : null;
    }
    $value = trim((string) ($value ?? ''));
    return $value !== '' ? $value : null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();
    $postAction = $_POST['action'] ?? '';

    if ($postAction === 'delete') {
        $deleteId = max(0, (int) ($_POST['id'] ?? 0));
        if ($deleteId > 0) {
            $stmt = $db->prepare("DELETE FROM {$module['table']} WHERE id = :id");
            $stmt->execute(['id' => $deleteId]);
            setFlash($module['singular'] . ' deleted.');
        }
        redirectAdmin('manage.php?module=' . urlencode($moduleKey));
    }

    if ($postAction === 'save') {
        $saveId = max(0, (int) ($_POST['id'] ?? 0));
        $data = [];
        foreach ($module['fields'] as $field => $config) {
            if (!empty($config['virtual'])) {
                continue;
            }
            $data[$field] = normalizeCrudValue($field, $config);
        }

        foreach ($module['fields'] as $field => $config) {
            if (!empty($config['required']) && empty($config['virtual']) && empty($data[$field])) {
                $errors[] = $config['label'] . ' is required.';
            }
        }

        if (array_key_exists('slug', $data) && empty($data['slug']) && !empty($data[$module['title']])) {
            $data['slug'] = slugify((string) $data[$module['title']]);
        }

        if ($module['table'] === 'blog_posts') {
            $data['category_id'] = getOrCreateBlogCategory($db, (string) ($_POST['category_name'] ?? ''));
            if (empty($data['published_at']) && ($data['status'] ?? '') === 'published') {
                $data['published_at'] = date('Y-m-d H:i:s');
            }
        }

        if (empty($errors)) {
            if ($saveId > 0) {
                $sets = [];
                foreach ($data as $column => $_) {
                    $sets[] = "{$column} = :{$column}";
                }
                $data['id'] = $saveId;
                $stmt = $db->prepare("UPDATE {$module['table']} SET " . implode(', ', $sets) . ' WHERE id = :id');
                $stmt->execute($data);
                setFlash($module['singular'] . ' updated.');
            } else {
                $columns = array_keys($data);
                $placeholders = array_map(fn (string $c): string => ':' . $c, $columns);
                $stmt = $db->prepare("INSERT INTO {$module['table']} (" . implode(', ', $columns) . ') VALUES (' . implode(', ', $placeholders) . ')');
                $stmt->execute($data);
                setFlash($module['singular'] . ' created.');
            }
            redirectAdmin('manage.php?module=' . urlencode($moduleKey));
        }
    }
}

$schemaError = false;
$item = null;
try {
    if ($action === 'edit' && $id > 0) {
        $item = fetchCrudItem($db, $module, $id);
        if (!$item) {
            setFlash('Item not found.', 'danger');
            redirectAdmin('manage.php?module=' . urlencode($moduleKey));
        }
    }
} catch (Throwable $e) {
    $schemaError = true;
}

$total = 0;
$items = [];
$totalPages = 1;
if ($action === 'list' && !$schemaError) {
    try {
        $total = countCrudItems($db, $module, $search);
        $totalPages = max(1, (int) ceil($total / $perPage));
        $page = min($page, $totalPages);
        $items = fetchCrudItems($db, $module, $search, $perPage, ($page - 1) * $perPage);
    } catch (Throwable $e) {
        $schemaError = true;
    }
}

if ($schemaError) {
    $errors[] = 'Could not load this module. The “' . $module['table']
        . '” table may be missing — import database.sql or run database_migration.sql on the database.';
}

$flash = getFlash();
$csrfToken = csrfToken();

function renderCell(string $column, mixed $value, array $module): string
{
    $value = (string) ($value ?? '');
    if ($column === 'status') {
        return '<span class="badge ' . e($value) . '">' . e($value) . '</span>';
    }
    $imageLike = preg_match('/(image|photo|featured_image|image_path|desktop_image)/', $column) === 1;
    if ($imageLike && $value !== '') {
        return '<img class="thumb" src="' . e($value) . '" alt="">';
    }
    if (mb_strlen($value) > 80) {
        $value = mb_substr($value, 0, 80) . '…';
    }
    return e($value);
}

$pageTitle = $module['label'];
$activeNav = $module['nav'];
require __DIR__ . '/partials/layout_top.php';
?>
<?php if ($flash) : ?><div class="alert <?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div><?php endif; ?>
<?php if (!empty($errors)) : ?>
    <div class="alert danger"><?php foreach ($errors as $error) : ?><p><?php echo e($error); ?></p><?php endforeach; ?></div>
<?php endif; ?>

<?php if ($action === 'new' || $action === 'edit') : ?>
    <div class="panel">
        <div class="admin-toolbar">
            <h2><?php echo $action === 'edit' ? 'Edit ' : 'New '; ?><?php echo e($module['singular']); ?></h2>
            <a class="admin-link" href="manage.php?module=<?php echo e($moduleKey); ?>">Cancel</a>
        </div>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?php echo e((string) ($item['id'] ?? 0)); ?>">
            <div class="admin-form-grid">
                <?php foreach ($module['fields'] as $field => $config) : ?>
                    <?php
                    $value = $_POST[$field] ?? ($item[$field] ?? '');
                    if (($config['type'] ?? '') === 'datetime' && is_string($value) && $value !== '') {
                        $value = str_replace(' ', 'T', substr($value, 0, 16));
                    }
                    $span = !empty($config['span']) ? 'span-2' : '';
                    ?>
                    <div class="form-group <?php echo e($span); ?>">
                        <label for="<?php echo e($field); ?>"><?php echo e($config['label']); ?></label>
                        <?php if ($config['type'] === 'textarea') : ?>
                            <textarea id="<?php echo e($field); ?>" name="<?php echo e($field); ?>" <?php echo !empty($config['required']) ? 'required' : ''; ?>><?php echo e((string) $value); ?></textarea>
                        <?php elseif ($config['type'] === 'status') : ?>
                            <select id="<?php echo e($field); ?>" name="<?php echo e($field); ?>">
                                <option value="published" <?php echo $value === 'published' ? 'selected' : ''; ?>>Published</option>
                                <option value="draft" <?php echo $value === 'draft' ? 'selected' : ''; ?>>Draft</option>
                            </select>
                        <?php elseif ($config['type'] === 'reference') : ?>
                            <select id="<?php echo e($field); ?>" name="<?php echo e($field); ?>" <?php echo !empty($config['required']) ? 'required' : ''; ?>>
                                <option value="">— Select —</option>
                                <?php foreach (refOptions($db, $config) as $opt) : ?>
                                    <option value="<?php echo e((string) $opt['id']); ?>" <?php echo (string) $value === (string) $opt['id'] ? 'selected' : ''; ?>><?php echo e((string) $opt['label']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php else : ?>
                            <input id="<?php echo e($field); ?>" type="<?php echo e($config['type'] === 'datetime' ? 'datetime-local' : $config['type']); ?>" name="<?php echo e($field); ?>" value="<?php echo e((string) $value); ?>" <?php echo !empty($config['required']) ? 'required' : ''; ?>>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit">Save <?php echo e($module['singular']); ?></button>
        </form>
    </div>
<?php else : ?>
    <div class="panel">
        <div class="list-toolbar">
            <form class="search-form" method="get">
                <input type="hidden" name="module" value="<?php echo e($moduleKey); ?>">
                <input type="text" name="q" value="<?php echo e($search); ?>" placeholder="Search <?php echo e(strtolower($module['label'])); ?>…">
                <button type="submit">Search</button>
            </form>
            <a class="admin-link" href="manage.php?module=<?php echo e($moduleKey); ?>&action=new">+ Add <?php echo e($module['singular']); ?></a>
        </div>
        <p class="muted" style="margin-top:0;"><?php echo e((string) $total); ?> total<?php echo $search !== '' ? ' matching “' . e($search) . '”' : ''; ?></p>
        <table class="admin-table">
            <thead>
            <tr>
                <?php foreach ($module['list'] as $column) : ?>
                    <th><?php echo e(ucwords(str_replace(['_name', '_'], ['', ' '], $column))); ?></th>
                <?php endforeach; ?>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $row) : ?>
                <tr>
                    <?php foreach ($module['list'] as $column) : ?>
                        <td><?php echo renderCell($column, $row[$column] ?? '', $module); ?></td>
                    <?php endforeach; ?>
                    <td>
                        <div class="admin-actions">
                            <a href="manage.php?module=<?php echo e($moduleKey); ?>&action=edit&id=<?php echo e((string) $row['id']); ?>">Edit</a>
                            <form method="post" onsubmit="return confirm('Delete this item?');">
                                <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo e((string) $row['id']); ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($items)) : ?>
                <tr><td colspan="<?php echo e((string) (count($module['list']) + 1)); ?>" class="muted">No records found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>

        <?php if ($totalPages > 1) : ?>
            <?php $base = 'manage.php?module=' . urlencode($moduleKey) . ($search !== '' ? '&q=' . urlencode($search) : '') . '&page='; ?>
            <div class="pagination">
                <a class="<?php echo $page <= 1 ? 'disabled' : ''; ?>" href="<?php echo e($base . ($page - 1)); ?>">‹ Prev</a>
                <?php for ($p = 1; $p <= $totalPages; $p++) : ?>
                    <?php if ($p === $page) : ?>
                        <span class="current"><?php echo $p; ?></span>
                    <?php else : ?>
                        <a href="<?php echo e($base . $p); ?>"><?php echo $p; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
                <a class="<?php echo $page >= $totalPages ? 'disabled' : ''; ?>" href="<?php echo e($base . ($page + 1)); ?>">Next ›</a>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php require __DIR__ . '/partials/layout_bottom.php'; ?>
