<?php
require_once __DIR__ . '/../includes/admin_header.php';
$editId = $_GET['edit'] ?? null;
$slide = null;
if ($editId) {
    $slide = fetchOne('SELECT * FROM hero_sliders WHERE id = :id LIMIT 1', [':id' => $editId]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $label = trim($_POST['label'] ?? '');
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $buttonText = trim($_POST['button_text'] ?? '');
    $buttonUrl = trim($_POST['button_url'] ?? '');
    $sortOrder = intval($_POST['sort_order'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    $existingImage = $slide['image'] ?? null;
    $image = uploadFile('image', $existingImage);
    if ($editId) {
        execute('UPDATE hero_sliders SET label = :label, title = :title, description = :description, button_text = :button_text, button_url = :button_url, image = :image, sort_order = :sort_order, active = :active WHERE id = :id', [
            ':label' => $label,
            ':title' => $title,
            ':description' => $description,
            ':button_text' => $buttonText,
            ':button_url' => $buttonUrl,
            ':image' => $image,
            ':sort_order' => $sortOrder,
            ':active' => $active,
            ':id' => $editId,
        ]);
        redirect('hero_slider.php');
    } else {
        execute('INSERT INTO hero_sliders (label, title, description, button_text, button_url, image, sort_order, active) VALUES (:label, :title, :description, :button_text, :button_url, :image, :sort_order, :active)', [
            ':label' => $label,
            ':title' => $title,
            ':description' => $description,
            ':button_text' => $buttonText,
            ':button_url' => $buttonUrl,
            ':image' => $image,
            ':sort_order' => $sortOrder,
            ':active' => $active,
        ]);
        redirect('hero_slider.php');
    }
}
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $slideToDelete = fetchOne('SELECT * FROM hero_sliders WHERE id = :id LIMIT 1', [':id' => $deleteId]);
    if ($slideToDelete && !empty($slideToDelete['image'])) {
        @unlink(UPLOAD_DIR . $slideToDelete['image']);
    }
    execute('DELETE FROM hero_sliders WHERE id = :id', [':id' => $deleteId]);
    redirect('hero_slider.php');
}
$slides = fetchAll('SELECT * FROM hero_sliders ORDER BY sort_order, id');
?>
<h1 class="mb-4">Manage Hero Slider</h1>
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title"><?= $slide ? 'Edit Slide' : 'Add Slide' ?></h5>
        <form method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Label</label>
                    <input type="text" name="label" class="form-control" value="<?= getSafe($slide['label'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="<?= getSafe($slide['title'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?= getSafe($slide['description'] ?? '') ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="<?= getSafe($slide['button_text'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Button URL</label>
                    <input type="text" name="button_url" class="form-control" value="<?= getSafe($slide['button_url'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (!empty($slide['image'])): ?>
                        <img src="<?= UPLOAD_URL . getSafe($slide['image']) ?>" class="img-fluid rounded mt-2" alt="Slide image" style="max-height:120px;">
                    <?php endif; ?>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= getSafe($slide['sort_order'] ?? '0') ?>">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" <?= isset($slide['active']) && $slide['active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-dark mt-3"><?= $slide ? 'Update Slide' : 'Save Slide' ?></button>
            <?php if ($slide): ?>
                <a href="hero_slider.php" class="btn btn-secondary mt-3 ms-2">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-3">Slide List</h5>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slides as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= getSafe($item['title']) ?></td>
                        <td><?= $item['active'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <a href="hero_slider.php?edit=<?= $item['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="hero_slider.php?delete=<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this slide?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
