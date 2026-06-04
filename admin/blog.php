<?php
require_once __DIR__ . '/../includes/admin_header.php';
$editId = $_GET['edit'] ?? null;
$post = null;
if ($editId) {
    $post = fetchOne('SELECT * FROM blogs WHERE id = :id LIMIT 1', [':id' => $editId]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '') ?: slugify($title);
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $seoTitle = trim($_POST['seo_title'] ?? '');
    $seoDescription = trim($_POST['seo_description'] ?? '');
    $seoKeywords = trim($_POST['seo_keywords'] ?? '');
    $publishedAt = trim($_POST['published_at'] ?? date('Y-m-d H:i:s'));
    $sortOrder = intval($_POST['sort_order'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    $image = uploadFile('image', $post['image'] ?? null);
    if ($editId) {
        execute('UPDATE blogs SET title = :title, slug = :slug, excerpt = :excerpt, content = :content, image = :image, seo_title = :seo_title, seo_description = :seo_description, seo_keywords = :seo_keywords, published_at = :published_at, sort_order = :sort_order, active = :active WHERE id = :id', [
            ':title' => $title,
            ':slug' => $slug,
            ':excerpt' => $excerpt,
            ':content' => $content,
            ':image' => $image,
            ':seo_title' => $seoTitle,
            ':seo_description' => $seoDescription,
            ':seo_keywords' => $seoKeywords,
            ':published_at' => $publishedAt,
            ':sort_order' => $sortOrder,
            ':active' => $active,
            ':id' => $editId,
        ]);
        redirect('blog.php');
    } else {
        execute('INSERT INTO blogs (title, slug, excerpt, content, image, seo_title, seo_description, seo_keywords, published_at, sort_order, active) VALUES (:title, :slug, :excerpt, :content, :image, :seo_title, :seo_description, :seo_keywords, :published_at, :sort_order, :active)', [
            ':title' => $title,
            ':slug' => $slug,
            ':excerpt' => $excerpt,
            ':content' => $content,
            ':image' => $image,
            ':seo_title' => $seoTitle,
            ':seo_description' => $seoDescription,
            ':seo_keywords' => $seoKeywords,
            ':published_at' => $publishedAt,
            ':sort_order' => $sortOrder,
            ':active' => $active,
        ]);
        redirect('blog.php');
    }
}
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $item = fetchOne('SELECT * FROM blogs WHERE id = :id LIMIT 1', [':id' => $deleteId]);
    if ($item && !empty($item['image'])) {
        @unlink(UPLOAD_DIR . $item['image']);
    }
    execute('DELETE FROM blogs WHERE id = :id', [':id' => $deleteId]);
    redirect('blog.php');
}
$posts = fetchAll('SELECT * FROM blogs ORDER BY published_at DESC, sort_order, id');
?>
<h1 class="mb-4">Manage Blog</h1>
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="<?= getSafe($post['title'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="<?= getSafe($post['slug'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Excerpt</label>
                    <textarea name="excerpt" class="form-control" rows="3"><?= getSafe($post['excerpt'] ?? '') ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control" rows="6"><?= getSafe($post['content'] ?? '') ?></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (!empty($post['image'])): ?>
                        <img src="<?= UPLOAD_URL . getSafe($post['image']) ?>" class="img-fluid rounded mt-2" alt="Blog" style="max-height:120px;">
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Published At</label>
                    <input type="datetime-local" name="published_at" class="form-control" value="<?= getSafe(date('Y-m-d\TH:i', strtotime($post['published_at'] ?? date('Y-m-d H:i:s')))) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= getSafe($post['sort_order'] ?? '0') ?>">
                </div>
                <div class="col-12"><h5>SEO Fields</h5></div>
                <div class="col-md-6">
                    <label class="form-label">SEO Title</label>
                    <input type="text" name="seo_title" class="form-control" value="<?= getSafe($post['seo_title'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">SEO Keywords</label>
                    <input type="text" name="seo_keywords" class="form-control" value="<?= getSafe($post['seo_keywords'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">SEO Description</label>
                    <textarea name="seo_description" class="form-control" rows="3"><?= getSafe($post['seo_description'] ?? '') ?></textarea>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" <?= isset($post['active']) && $post['active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-dark mt-3" type="submit"><?= $post ? 'Update Post' : 'Add Post' ?></button>
            <?php if ($post): ?>
                <a href="blog.php" class="btn btn-secondary mt-3 ms-2">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead><tr><th>ID</th><th>Title</th><th>Published</th><th>Active</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($posts as $item2): ?>
                    <tr>
                        <td><?= $item2['id'] ?></td>
                        <td><?= getSafe($item2['title']) ?></td>
                        <td><?= date('Y-m-d', strtotime($item2['published_at'])) ?></td>
                        <td><?= $item2['active'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="blog.php?edit=<?= $item2['id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="blog.php?delete=<?= $item2['id'] ?>" onclick="return confirm('Delete this blog post?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
