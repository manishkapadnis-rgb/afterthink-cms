<?php
require_once __DIR__ . '/../includes/admin_header.php';
$editId = $_GET['edit'] ?? null;
$item = null;
if ($editId) {
    $item = fetchOne('SELECT * FROM gallery_items WHERE id = :id LIMIT 1', [':id' => $editId]);
}
$categories = fetchAll('SELECT * FROM gallery_categories WHERE active = 1 ORDER BY sort_order, id');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $categoryId = intval($_POST['category_id'] ?? 0) ?: null;
    $type = in_array($_POST['type'] ?? 'image', ['image', 'video']) ? $_POST['type'] : 'image';
    $sortOrder = intval($_POST['sort_order'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    if ($type === 'video') {
        $fileValue = trim($_POST['video_url'] ?? '');
    } else {
        $fileValue = uploadFile('file', $item['file'] ?? null);
    }
    if ($editId) {
        execute('UPDATE gallery_items SET title = :title, category_id = :category_id, type = :type, file = :file, sort_order = :sort_order, active = :active WHERE id = :id', [
            ':title' => $title,
            ':category_id' => $categoryId,
            ':type' => $type,
            ':file' => $fileValue,
            ':sort_order' => $sortOrder,
            ':active' => $active,
            ':id' => $editId,
        ]);
        redirect('gallery.php');
    } else {
        execute('INSERT INTO gallery_items (title, category_id, type, file, sort_order, active) VALUES (:title, :category_id, :type, :file, :sort_order, :active)', [
            ':title' => $title,
            ':category_id' => $categoryId,
            ':type' => $type,
            ':file' => $fileValue,
            ':sort_order' => $sortOrder,
            ':active' => $active,
        ]);
        redirect('gallery.php');
    }
}
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $row = fetchOne('SELECT * FROM gallery_items WHERE id = :id LIMIT 1', [':id' => $deleteId]);
    if ($row && $row['type'] === 'image' && !empty($row['file'])) {
        @unlink(UPLOAD_DIR . $row['file']);
    }
    execute('DELETE FROM gallery_items WHERE id = :id', [':id' => $deleteId]);
    redirect('gallery.php');
}
$items = fetchAll('SELECT g.*, c.name AS category_name FROM gallery_items g LEFT JOIN gallery_categories c ON g.category_id = c.id ORDER BY sort_order, id');
?>
<h1 class="mb-4">Manage Gallery</h1>
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title"><?= $item ? 'Edit Gallery Item' : 'Add Gallery Item' ?></h5>
        <form method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="<?= getSafe($item['title'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">Select category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= isset($item['category_id']) && $item['category_id'] == $category['id'] ? 'selected' : '' ?>><?= getSafe($category['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Item Type</label>
                    <select name="type" class="form-select" id="galleryType">
                        <option value="image" <?= empty($item['type']) || $item['type'] === 'image' ? 'selected' : '' ?>>Image</option>
                        <option value="video" <?= isset($item['type']) && $item['type'] === 'video' ? 'selected' : '' ?>>Video</option>
                    </select>
                </div>
                <div class="col-md-6" id="imageInput" style="display: <?= empty($item['type']) || $item['type'] === 'image' ? 'block' : 'none' ?>;">
                    <label class="form-label">Image</label>
                    <input type="file" name="file" class="form-control">
                    <?php if (!empty($item['file']) && ($item['type'] === 'image' || empty($item['type']))): ?>
                        <img src="<?= UPLOAD_URL . getSafe($item['file']) ?>" class="img-fluid rounded mt-2" alt="Gallery" style="max-height:120px;">
                    <?php endif; ?>
                </div>
                <div class="col-md-6" id="videoInput" style="display: <?= isset($item['type']) && $item['type'] === 'video' ? 'block' : 'none' ?>;">
                    <label class="form-label">Video URL</label>
                    <input type="text" name="video_url" class="form-control" value="<?= $item['type'] === 'video' ? getSafe($item['file']) : '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= getSafe($item['sort_order'] ?? '0') ?>">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" <?= isset($item['active']) && $item['active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-dark mt-3" type="submit"><?= $item ? 'Update Item' : 'Add Item' ?></button>
            <?php if ($item): ?>
                <a href="gallery.php" class="btn btn-secondary mt-3 ms-2">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead><tr><th>ID</th><th>Title</th><th>Type</th><th>Category</th><th>Active</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($items as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= getSafe($row['title']) ?></td>
                        <td><?= getSafe($row['type']) ?></td>
                        <td><?= getSafe($row['category_name']) ?></td>
                        <td><?= $row['active'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="gallery.php?edit=<?= $row['id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="gallery.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this item?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$('#galleryType').on('change', function() {
    if (this.value === 'video') {
        $('#imageInput').hide();
        $('#videoInput').show();
    } else {
        $('#imageInput').show();
        $('#videoInput').hide();
    }
});
</script>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
