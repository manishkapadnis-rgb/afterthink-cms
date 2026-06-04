<?php
require_once __DIR__ . '/../includes/admin_header.php';
$editId = $_GET['edit'] ?? null;
$project = null;
if ($editId) {
    $project = fetchOne('SELECT * FROM portfolios WHERE id = :id LIMIT 1', [':id' => $editId]);
}
$categories = fetchAll('SELECT * FROM portfolio_categories WHERE active = 1 ORDER BY sort_order, id');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '') ?: slugify($title);
    $categoryId = intval($_POST['category_id'] ?? 0) ?: null;
    $location = trim($_POST['location'] ?? '');
    $area = trim($_POST['area'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $projectVideo = trim($_POST['project_video'] ?? '');
    $completionDate = trim($_POST['completion_date'] ?? '');
    $sortOrder = intval($_POST['sort_order'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    $coverImage = uploadFile('cover_image', $project['cover_image'] ?? null);
    if ($editId) {
        execute('UPDATE portfolios SET title = :title, slug = :slug, category_id = :category_id, location = :location, area = :area, description = :description, cover_image = :cover_image, project_video = :project_video, completion_date = :completion_date, sort_order = :sort_order, active = :active WHERE id = :id', [
            ':title' => $title,
            ':slug' => $slug,
            ':category_id' => $categoryId,
            ':location' => $location,
            ':area' => $area,
            ':description' => $description,
            ':cover_image' => $coverImage,
            ':project_video' => $projectVideo,
            ':completion_date' => $completionDate,
            ':sort_order' => $sortOrder,
            ':active' => $active,
            ':id' => $editId,
        ]);
        $portfolioId = $editId;
    } else {
        execute('INSERT INTO portfolios (title, slug, category_id, location, area, description, cover_image, project_video, completion_date, sort_order, active) VALUES (:title, :slug, :category_id, :location, :area, :description, :cover_image, :project_video, :completion_date, :sort_order, :active)', [
            ':title' => $title,
            ':slug' => $slug,
            ':category_id' => $categoryId,
            ':location' => $location,
            ':area' => $area,
            ':description' => $description,
            ':cover_image' => $coverImage,
            ':project_video' => $projectVideo,
            ':completion_date' => $completionDate,
            ':sort_order' => $sortOrder,
            ':active' => $active,
        ]);
        $portfolioId = $pdo->lastInsertId();
    }
    $files = uploadMultipleFiles('gallery_images');
    foreach ($files as $filename) {
        execute('INSERT INTO portfolio_images (portfolio_id, image) VALUES (:portfolio_id, :image)', [
            ':portfolio_id' => $portfolioId,
            ':image' => $filename,
        ]);
    }
    redirect('portfolio.php');
}
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $item = fetchOne('SELECT * FROM portfolios WHERE id = :id LIMIT 1', [':id' => $deleteId]);
    if ($item && !empty($item['cover_image'])) {
        @unlink(UPLOAD_DIR . $item['cover_image']);
    }
    $images = fetchAll('SELECT * FROM portfolio_images WHERE portfolio_id = :id', [':id' => $deleteId]);
    foreach ($images as $img) {
        @unlink(UPLOAD_DIR . $img['image']);
    }
    execute('DELETE FROM portfolios WHERE id = :id', [':id' => $deleteId]);
    redirect('portfolio.php');
}
if (isset($_GET['delete_image'])) {
    $imageId = intval($_GET['delete_image']);
    $row = fetchOne('SELECT * FROM portfolio_images WHERE id = :id LIMIT 1', [':id' => $imageId]);
    if ($row) {
        @unlink(UPLOAD_DIR . $row['image']);
        execute('DELETE FROM portfolio_images WHERE id = :id', [':id' => $imageId]);
    }
    redirect('portfolio.php?edit=' . intval($_GET['project']));
}
$projects = fetchAll('SELECT p.*, c.name AS category_name FROM portfolios p LEFT JOIN portfolio_categories c ON p.category_id = c.id ORDER BY sort_order, id');
$galleryImages = [];
if ($editId) {
    $galleryImages = fetchAll('SELECT * FROM portfolio_images WHERE portfolio_id = :id ORDER BY id', [':id' => $editId]);
}
?>
<h1 class="mb-4">Manage Portfolio Projects</h1>
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title"><?= $project ? 'Edit Project' : 'Add Project' ?></h5>
        <form method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Project Title</label>
                    <input type="text" name="title" class="form-control" value="<?= getSafe($project['title'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="<?= getSafe($project['slug'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">Select category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= isset($project['category_id']) && $project['category_id'] == $category['id'] ? 'selected' : '' ?>><?= getSafe($category['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="<?= getSafe($project['location'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Area</label>
                    <input type="text" name="area" class="form-control" value="<?= getSafe($project['area'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Completion Date</label>
                    <input type="date" name="completion_date" class="form-control" value="<?= getSafe($project['completion_date'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= getSafe($project['sort_order'] ?? '0') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5"><?= getSafe($project['description'] ?? '') ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cover Image</label>
                    <input type="file" name="cover_image" class="form-control">
                    <?php if (!empty($project['cover_image'])): ?>
                        <img src="<?= UPLOAD_URL . getSafe($project['cover_image']) ?>" class="img-fluid rounded mt-2" alt="Cover image" style="max-height:120px;">
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Project Video (embed URL)</label>
                    <input type="text" name="project_video" class="form-control" value="<?= getSafe($project['project_video'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Gallery Images</label>
                    <input type="file" name="gallery_images[]" class="form-control" multiple>
                    <div class="mt-3 row g-3">
                        <?php foreach ($galleryImages as $image): ?>
                            <div class="col-md-3 text-center">
                                <img src="<?= UPLOAD_URL . getSafe($image['image']) ?>" class="img-fluid rounded mb-2" alt="Project gallery" style="max-height:120px;">
                                <div>
                                    <a class="btn btn-sm btn-outline-danger" href="portfolio.php?edit=<?= $project['id'] ?>&delete_image=<?= $image['id'] ?>&project=<?= $project['id'] ?>" onclick="return confirm('Remove image?');">Remove</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" <?= isset($project['active']) && $project['active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-dark mt-3" type="submit"><?= $project ? 'Update Project' : 'Save Project' ?></button>
            <?php if ($project): ?>
                <a href="portfolio.php" class="btn btn-secondary mt-3 ms-2">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-3">Portfolio List</h5>
        <table class="table table-bordered table-striped">
            <thead><tr><th>ID</th><th>Title</th><th>Category</th><th>Active</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($projects as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= getSafe($row['title']) ?></td>
                        <td><?= getSafe($row['category_name']) ?></td>
                        <td><?= $row['active'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="portfolio.php?edit=<?= $row['id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="portfolio.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this project?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
