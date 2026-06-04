<?php
require_once __DIR__ . '/../includes/admin_header.php';
$editId = $_GET['edit'] ?? null;
$category = null;
if ($editId) {
    $category = fetchOne('SELECT * FROM portfolio_categories WHERE id = :id LIMIT 1', [':id' => $editId]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '') ?: slugify($name);
    $sortOrder = intval($_POST['sort_order'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    if ($editId) {
        execute('UPDATE portfolio_categories SET name = :name, slug = :slug, sort_order = :sort_order, active = :active WHERE id = :id', [
            ':name' => $name,
            ':slug' => $slug,
            ':sort_order' => $sortOrder,
            ':active' => $active,
            ':id' => $editId,
        ]);
        redirect('portfolio_categories.php');
    } else {
        execute('INSERT INTO portfolio_categories (name, slug, sort_order, active) VALUES (:name, :slug, :sort_order, :active)', [
            ':name' => $name,
            ':slug' => $slug,
            ':sort_order' => $sortOrder,
            ':active' => $active,
        ]);
        redirect('portfolio_categories.php');
    }
}
if (isset($_GET['delete'])) {
    execute('DELETE FROM portfolio_categories WHERE id = :id', [':id' => intval($_GET['delete'])]);
    redirect('portfolio_categories.php');
}
$categories = fetchAll('SELECT * FROM portfolio_categories ORDER BY sort_order, id');
?>
<h1 class="mb-4">Portfolio Categories</h1>
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title"><?= $category ? 'Edit Category' : 'Add Category' ?></h5>
        <form method="post">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?= getSafe($category['name'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="<?= getSafe($category['slug'] ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= getSafe($category['sort_order'] ?? '0') ?>">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" <?= isset($category['active']) && $category['active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-dark mt-3" type="submit"><?= $category ? 'Update Category' : 'Add Category' ?></button>
            <?php if ($category): ?>
                <a href="portfolio_categories.php" class="btn btn-secondary mt-3 ms-2">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead><tr><th>ID</th><th>Name</th><th>Slug</th><th>Active</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($categories as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= getSafe($item['name']) ?></td>
                        <td><?= getSafe($item['slug']) ?></td>
                        <td><?= $item['active'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="portfolio_categories.php?edit=<?= $item['id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="portfolio_categories.php?delete=<?= $item['id'] ?>" onclick="return confirm('Delete this category?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
