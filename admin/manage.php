<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';
requireAdmin();

$modules = [
    'services' => [
        'label' => 'Services',
        'table' => 'services',
        'title' => 'name',
        'list' => ['name', 'slug', 'status'],
        'fields' => [
            'name' => ['label' => 'Service Name', 'type' => 'text', 'required' => true],
            'slug' => ['label' => 'Slug', 'type' => 'text'],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'span' => 2],
            'image' => ['label' => 'Image URL / Path', 'type' => 'text'],
            'icon' => ['label' => 'Icon', 'type' => 'text'],
            'sort_order' => ['label' => 'Sort Order', 'type' => 'number'],
            'meta_title' => ['label' => 'Meta Title', 'type' => 'text'],
            'meta_description' => ['label' => 'Meta Description', 'type' => 'textarea', 'span' => 2],
            'meta_keywords' => ['label' => 'Meta Keywords', 'type' => 'textarea', 'span' => 2],
            'status' => ['label' => 'Status', 'type' => 'status'],
        ],
    ],
    'projects' => [
        'label' => 'Projects',
        'table' => 'projects',
        'title' => 'name',
        'list' => ['name', 'slug', 'category', 'status'],
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
    'testimonials' => [
        'label' => 'Testimonials',
        'table' => 'testimonials',
        'title' => 'client_name',
        'list' => ['client_name', 'company', 'rating', 'status'],
        'fields' => [
            'client_name' => ['label' => 'Client Name', 'type' => 'text', 'required' => true],
            'company' => ['label' => 'Company / Context', 'type' => 'text'],
            'review' => ['label' => 'Review', 'type' => 'textarea', 'span' => 2, 'required' => true],
            'rating' => ['label' => 'Rating', 'type' => 'number'],
            'photo' => ['label' => 'Photo URL / Path', 'type' => 'text'],
            'status' => ['label' => 'Status', 'type' => 'status'],
        ],
    ],
    'blog' => [
        'label' => 'Blog Posts',
        'table' => 'blog_posts',
        'title' => 'title',
        'list' => ['title', 'slug', 'category_name', 'status'],
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

function fetchCrudItems(PDO $db, array $module): array
{
    $table = $module['table'];
    if ($table === 'blog_posts') {
        return $db->query('SELECT p.*, c.name AS category_name FROM blog_posts p LEFT JOIN blog_categories c ON c.id = p.category_id ORDER BY p.created_at DESC, p.id DESC')->fetchAll();
    }
    return $db->query("SELECT * FROM {$table} ORDER BY id DESC")->fetchAll();
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
    if ($config['type'] === 'number') {
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
            setFlash($module['label'] . ' item deleted.');
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

        $titleField = $module['title'];
        if (empty($data[$titleField])) {
            $errors[] = $module['fields'][$titleField]['label'] . ' is required.';
        }

        if (array_key_exists('slug', $data) && empty($data['slug']) && !empty($data[$titleField])) {
            $data['slug'] = slugify((string) $data[$titleField]);
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
                setFlash($module['label'] . ' item updated.');
            } else {
                $columns = array_keys($data);
                $placeholders = array_map(fn (string $column): string => ':' . $column, $columns);
                $stmt = $db->prepare("INSERT INTO {$module['table']} (" . implode(', ', $columns) . ') VALUES (' . implode(', ', $placeholders) . ')');
                $stmt->execute($data);
                setFlash($module['label'] . ' item created.');
            }
            redirectAdmin('manage.php?module=' . urlencode($moduleKey));
        }
    }
}

$item = null;
if ($action === 'edit' && $id > 0) {
    $item = fetchCrudItem($db, $module, $id);
    if (!$item) {
        setFlash('Item not found.', 'danger');
        redirectAdmin('manage.php?module=' . urlencode($moduleKey));
    }
}

$items = $action === 'list' ? fetchCrudItems($db, $module) : [];
$flash = getFlash();
$csrfToken = csrfToken();
$title = ($action === 'edit' ? 'Edit ' : 'New ') . rtrim($module['label'], 's');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($module['label']); ?> | Afterthink Admin</title>
    <link rel="stylesheet" href="<?php echo assetUrl('css/admin.css'); ?>">
</head>
<body>
<div class="admin-wrapper">
    <header class="admin-header">
        <h1><?php echo e($module['label']); ?></h1>
    </header>
    <main class="admin-content">
        <p><a class="admin-link" href="dashboard.php">Back to dashboard</a></p>

        <?php if ($flash) : ?>
            <div class="alert <?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div>
        <?php endif; ?>

        <?php if (!empty($errors)) : ?>
            <div class="alert danger">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($action === 'new' || $action === 'edit') : ?>
            <div class="admin-toolbar">
                <h2><?php echo e($title); ?></h2>
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
                            <?php else : ?>
                                <input id="<?php echo e($field); ?>" type="<?php echo e($config['type'] === 'datetime' ? 'datetime-local' : $config['type']); ?>" name="<?php echo e($field); ?>" value="<?php echo e((string) $value); ?>" <?php echo !empty($config['required']) ? 'required' : ''; ?>>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="submit">Save</button>
            </form>
        <?php else : ?>
            <div class="admin-toolbar">
                <h2>Manage <?php echo e($module['label']); ?></h2>
                <a class="admin-link" href="manage.php?module=<?php echo e($moduleKey); ?>&action=new">Create New</a>
            </div>
            <table class="admin-table">
                <thead>
                <tr>
                    <?php foreach ($module['list'] as $column) : ?>
                        <th><?php echo e(ucwords(str_replace('_', ' ', $column))); ?></th>
                    <?php endforeach; ?>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $row) : ?>
                    <tr>
                        <?php foreach ($module['list'] as $column) : ?>
                            <td><?php echo e((string) ($row[$column] ?? '')); ?></td>
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
                    <tr><td colspan="<?php echo e((string) (count($module['list']) + 1)); ?>" class="muted">No records yet.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</div>
</body>
</html>
