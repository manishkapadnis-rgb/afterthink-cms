<?php
require_once __DIR__ . '/../includes/admin_header.php';
$editId = $_GET['edit'] ?? null;
$link = null;
if ($editId) {
    $link = fetchOne('SELECT * FROM social_links WHERE id = :id LIMIT 1', [':id' => $editId]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $platform = trim($_POST['platform'] ?? '');
    $url = trim($_POST['url'] ?? '');
    $sortOrder = intval($_POST['sort_order'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    if ($editId) {
        execute('UPDATE social_links SET platform = :platform, url = :url, sort_order = :sort_order, active = :active WHERE id = :id', [
            ':platform' => $platform,
            ':url' => $url,
            ':sort_order' => $sortOrder,
            ':active' => $active,
            ':id' => $editId,
        ]);
        redirect('social_links.php');
    } else {
        execute('INSERT INTO social_links (platform, url, sort_order, active) VALUES (:platform, :url, :sort_order, :active)', [
            ':platform' => $platform,
            ':url' => $url,
            ':sort_order' => $sortOrder,
            ':active' => $active,
        ]);
        redirect('social_links.php');
    }
}
if (isset($_GET['delete'])) {
    execute('DELETE FROM social_links WHERE id = :id', [':id' => intval($_GET['delete'])]);
    redirect('social_links.php');
}
$links = fetchAll('SELECT * FROM social_links ORDER BY sort_order, id');
?>
<h1 class="mb-4">Manage Social Links</h1>
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form method="post">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Platform</label>
                    <input type="text" name="platform" class="form-control" value="<?= getSafe($link['platform'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">URL</label>
                    <input type="text" name="url" class="form-control" value="<?= getSafe($link['url'] ?? '') ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= getSafe($link['sort_order'] ?? '0') ?>">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" <?= isset($link['active']) && $link['active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-dark mt-3" type="submit"><?= $link ? 'Update Link' : 'Add Link' ?></button>
            <?php if ($link): ?>
                <a href="social_links.php" class="btn btn-secondary mt-3 ms-2">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead><tr><th>ID</th><th>Platform</th><th>URL</th><th>Active</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($links as $item2): ?>
                    <tr>
                        <td><?= $item2['id'] ?></td>
                        <td><?= getSafe($item2['platform']) ?></td>
                        <td><?= getSafe($item2['url']) ?></td>
                        <td><?= $item2['active'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="social_links.php?edit=<?= $item2['id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="social_links.php?delete=<?= $item2['id'] ?>" onclick="return confirm('Delete this social link?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
