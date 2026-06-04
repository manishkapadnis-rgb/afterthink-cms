<?php
require_once __DIR__ . '/../includes/admin_header.php';
$editId = $_GET['edit'] ?? null;
$testimonial = null;
if ($editId) {
    $testimonial = fetchOne('SELECT * FROM testimonials WHERE id = :id LIMIT 1', [':id' => $editId]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $position = trim($_POST['position'] ?? '');
    $review = trim($_POST['review'] ?? '');
    $sortOrder = intval($_POST['sort_order'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    $image = uploadFile('image', $testimonial['image'] ?? null);
    if ($editId) {
        execute('UPDATE testimonials SET name = :name, position = :position, review = :review, image = :image, sort_order = :sort_order, active = :active WHERE id = :id', [
            ':name' => $name,
            ':position' => $position,
            ':review' => $review,
            ':image' => $image,
            ':sort_order' => $sortOrder,
            ':active' => $active,
            ':id' => $editId,
        ]);
        redirect('testimonials.php');
    } else {
        execute('INSERT INTO testimonials (name, position, review, image, sort_order, active) VALUES (:name, :position, :review, :image, :sort_order, :active)', [
            ':name' => $name,
            ':position' => $position,
            ':review' => $review,
            ':image' => $image,
            ':sort_order' => $sortOrder,
            ':active' => $active,
        ]);
        redirect('testimonials.php');
    }
}
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $item = fetchOne('SELECT * FROM testimonials WHERE id = :id LIMIT 1', [':id' => $deleteId]);
    if ($item && !empty($item['image'])) {
        @unlink(UPLOAD_DIR . $item['image']);
    }
    execute('DELETE FROM testimonials WHERE id = :id', [':id' => $deleteId]);
    redirect('testimonials.php');
}
$testimonials = fetchAll('SELECT * FROM testimonials ORDER BY sort_order, id');
?>
<h1 class="mb-4">Manage Testimonials</h1>
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?= getSafe($testimonial['name'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Position</label>
                    <input type="text" name="position" class="form-control" value="<?= getSafe($testimonial['position'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Review</label>
                    <textarea name="review" class="form-control" rows="4" required><?= getSafe($testimonial['review'] ?? '') ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (!empty($testimonial['image'])): ?>
                        <img src="<?= UPLOAD_URL . getSafe($testimonial['image']) ?>" class="img-fluid rounded mt-2" alt="Testimonial" style="max-height:120px;">
                    <?php endif; ?>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= getSafe($testimonial['sort_order'] ?? '0') ?>">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" <?= isset($testimonial['active']) && $testimonial['active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-dark mt-3" type="submit"><?= $testimonial ? 'Update Testimonial' : 'Add Testimonial' ?></button>
            <?php if ($testimonial): ?>
                <a href="testimonials.php" class="btn btn-secondary mt-3 ms-2">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead><tr><th>ID</th><th>Name</th><th>Position</th><th>Active</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($testimonials as $item2): ?>
                    <tr>
                        <td><?= $item2['id'] ?></td>
                        <td><?= getSafe($item2['name']) ?></td>
                        <td><?= getSafe($item2['position']) ?></td>
                        <td><?= $item2['active'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="testimonials.php?edit=<?= $item2['id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="testimonials.php?delete=<?= $item2['id'] ?>" onclick="return confirm('Delete this testimonial?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
