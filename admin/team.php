<?php
require_once __DIR__ . '/../includes/admin_header.php';
$editId = $_GET['edit'] ?? null;
$member = null;
if ($editId) {
    $member = fetchOne('SELECT * FROM team_members WHERE id = :id LIMIT 1', [':id' => $editId]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $role = trim($_POST['role'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    $linkedin = trim($_POST['linkedin'] ?? '');
    $instagram = trim($_POST['instagram'] ?? '');
    $facebook = trim($_POST['facebook'] ?? '');
    $sortOrder = intval($_POST['sort_order'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    $image = uploadFile('image', $member['image'] ?? null);
    if ($editId) {
        execute('UPDATE team_members SET name = :name, role = :role, bio = :bio, image = :image, linkedin = :linkedin, instagram = :instagram, facebook = :facebook, sort_order = :sort_order, active = :active WHERE id = :id', [
            ':name' => $name,
            ':role' => $role,
            ':bio' => $bio,
            ':image' => $image,
            ':linkedin' => $linkedin,
            ':instagram' => $instagram,
            ':facebook' => $facebook,
            ':sort_order' => $sortOrder,
            ':active' => $active,
            ':id' => $editId,
        ]);
        redirect('team.php');
    } else {
        execute('INSERT INTO team_members (name, role, bio, image, linkedin, instagram, facebook, sort_order, active) VALUES (:name, :role, :bio, :image, :linkedin, :instagram, :facebook, :sort_order, :active)', [
            ':name' => $name,
            ':role' => $role,
            ':bio' => $bio,
            ':image' => $image,
            ':linkedin' => $linkedin,
            ':instagram' => $instagram,
            ':facebook' => $facebook,
            ':sort_order' => $sortOrder,
            ':active' => $active,
        ]);
        redirect('team.php');
    }
}
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $item = fetchOne('SELECT * FROM team_members WHERE id = :id LIMIT 1', [':id' => $deleteId]);
    if ($item && !empty($item['image'])) {
        @unlink(UPLOAD_DIR . $item['image']);
    }
    execute('DELETE FROM team_members WHERE id = :id', [':id' => $deleteId]);
    redirect('team.php');
}
$team = fetchAll('SELECT * FROM team_members ORDER BY sort_order, id');
?>
<h1 class="mb-4">Manage Team Members</h1>
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?= getSafe($member['name'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <input type="text" name="role" class="form-control" value="<?= getSafe($member['role'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="4"><?= getSafe($member['bio'] ?? '') ?></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">LinkedIn</label>
                    <input type="text" name="linkedin" class="form-control" value="<?= getSafe($member['linkedin'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="<?= getSafe($member['instagram'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="<?= getSafe($member['facebook'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (!empty($member['image'])): ?>
                        <img src="<?= UPLOAD_URL . getSafe($member['image']) ?>" class="img-fluid rounded mt-2" alt="Team member" style="max-height:120px;">
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= getSafe($member['sort_order'] ?? '0') ?>">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" <?= isset($member['active']) && $member['active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-dark mt-3" type="submit"><?= $member ? 'Update Team Member' : 'Add Team Member' ?></button>
            <?php if ($member): ?>
                <a href="team.php" class="btn btn-secondary mt-3 ms-2">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead><tr><th>ID</th><th>Name</th><th>Role</th><th>Active</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($team as $item2): ?>
                    <tr>
                        <td><?= $item2['id'] ?></td>
                        <td><?= getSafe($item2['name']) ?></td>
                        <td><?= getSafe($item2['role']) ?></td>
                        <td><?= $item2['active'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="team.php?edit=<?= $item2['id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="team.php?delete=<?= $item2['id'] ?>" onclick="return confirm('Delete this team member?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
