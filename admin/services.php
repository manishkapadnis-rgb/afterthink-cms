<?php
require_once __DIR__ . '/../includes/admin_header.php';
$editId = $_GET['edit'] ?? null;
$service = null;
if ($editId) {
    $service = fetchOne('SELECT * FROM services WHERE id = :id LIMIT 1', [':id' => $editId]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $sortOrder = intval($_POST['sort_order'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    $image = uploadFile('image', $service['image'] ?? null);
    if ($editId) {
        execute('UPDATE services SET title = :title, description = :description, image = :image, sort_order = :sort_order, active = :active WHERE id = :id', [
            ':title' => $title,
            ':description' => $description,
            ':image' => $image,
            ':sort_order' => $sortOrder,
            ':active' => $active,
            ':id' => $editId,
        ]);
        redirect('services.php');
    } else {
        execute('INSERT INTO services (title, description, image, sort_order, active) VALUES (:title, :description, :image, :sort_order, :active)', [
            ':title' => $title,
            ':description' => $description,
            ':image' => $image,
            ':sort_order' => $sortOrder,
            ':active' => $active,
        ]);
        redirect('services.php');
    }
}
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $item = fetchOne('SELECT * FROM services WHERE id = :id LIMIT 1', [':id' => $deleteId]);
    if ($item && !empty($item['image'])) {
        @unlink(UPLOAD_DIR . $item['image']);
    }
    execute('DELETE FROM services WHERE id = :id', [':id' => $deleteId]);
    redirect('services.php');
}
$services = fetchAll('SELECT * FROM services ORDER BY sort_order, id');
?>
<h1 class="mb-4">Manage Services</h1>
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title"><?= $service ? 'Edit Service' : 'Add Service' ?></h5>
        <form method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="<?= getSafe($service['title'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= getSafe($service['sort_order'] ?? '0') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" required><?= getSafe($service['description'] ?? '') ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (!empty($service['image'])): ?>
                        <img src="<?= UPLOAD_URL . getSafe($service['image']) ?>" class="img-fluid rounded mt-2" alt="Service image" style="max-height:120px;">
                    <?php endif; ?>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" <?= isset($service['active']) && $service['active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-dark mt-3" type="submit"><?= $service ? 'Update Service' : 'Save Service' ?></button>
            <?php if ($service): ?>
                <a href="services.php" class="btn btn-secondary mt-3 ms-2">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-3">Service List</h5>
        <table class="table table-bordered table-striped">
            <thead>
                <tr><th>ID</th><th>Title</th><th>Active</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach ($services as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= getSafe($item['title']) ?></td>
                        <td><?= $item['active'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="services.php?edit=<?= $item['id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="services.php?delete=<?= $item['id'] ?>" onclick="return confirm('Delete this service?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
