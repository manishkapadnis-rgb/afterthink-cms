<?php
require_once __DIR__ . '/../includes/admin_header.php';
$editId = $_GET['edit'] ?? null;
$faq = null;
if ($editId) {
    $faq = fetchOne('SELECT * FROM faqs WHERE id = :id LIMIT 1', [':id' => $editId]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = trim($_POST['question'] ?? '');
    $answer = trim($_POST['answer'] ?? '');
    $sortOrder = intval($_POST['sort_order'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    if ($editId) {
        execute('UPDATE faqs SET question = :question, answer = :answer, sort_order = :sort_order, active = :active WHERE id = :id', [
            ':question' => $question,
            ':answer' => $answer,
            ':sort_order' => $sortOrder,
            ':active' => $active,
            ':id' => $editId,
        ]);
        redirect('faqs.php');
    } else {
        execute('INSERT INTO faqs (question, answer, sort_order, active) VALUES (:question, :answer, :sort_order, :active)', [
            ':question' => $question,
            ':answer' => $answer,
            ':sort_order' => $sortOrder,
            ':active' => $active,
        ]);
        redirect('faqs.php');
    }
}
if (isset($_GET['delete'])) {
    execute('DELETE FROM faqs WHERE id = :id', [':id' => intval($_GET['delete'])]);
    redirect('faqs.php');
}
$faqs = fetchAll('SELECT * FROM faqs ORDER BY sort_order, id');
?>
<h1 class="mb-4">Manage FAQs</h1>
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form method="post">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Question</label>
                    <input type="text" name="question" class="form-control" value="<?= getSafe($faq['question'] ?? '') ?>" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Answer</label>
                    <textarea name="answer" class="form-control" rows="4" required><?= getSafe($faq['answer'] ?? '') ?></textarea>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= getSafe($faq['sort_order'] ?? '0') ?>">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" <?= isset($faq['active']) && $faq['active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-dark mt-3" type="submit"><?= $faq ? 'Update FAQ' : 'Add FAQ' ?></button>
            <?php if ($faq): ?>
                <a href="faqs.php" class="btn btn-secondary mt-3 ms-2">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead><tr><th>ID</th><th>Question</th><th>Active</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($faqs as $item2): ?>
                    <tr>
                        <td><?= $item2['id'] ?></td>
                        <td><?= getSafe($item2['question']) ?></td>
                        <td><?= $item2['active'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="faqs.php?edit=<?= $item2['id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="faqs.php?delete=<?= $item2['id'] ?>" onclick="return confirm('Delete this FAQ?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
