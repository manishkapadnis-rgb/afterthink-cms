<?php
require_once __DIR__ . '/../includes/admin_header.php';
if (isset($_POST['status']) && isset($_POST['id'])) {
    execute('UPDATE inquiries SET status = :status WHERE id = :id', [
        ':status' => trim($_POST['status']),
        ':id' => intval($_POST['id']),
    ]);
    redirect('contact_inquiries.php');
}
$inquiries = fetchAll('SELECT * FROM inquiries ORDER BY created_at DESC');
?>
<h1 class="mb-4">Contact Inquiries</h1>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Submitted</th><th>Status</th><th>Action</th></tr></thead>
            <tbody>
                <?php foreach ($inquiries as $inquiry): ?>
                    <tr>
                        <td><?= $inquiry['id'] ?></td>
                        <td><?= getSafe($inquiry['name']) ?></td>
                        <td><?= getSafe($inquiry['email']) ?></td>
                        <td><?= getSafe($inquiry['subject']) ?></td>
                        <td><?= date('Y-m-d H:i', strtotime($inquiry['created_at'])) ?></td>
                        <td><?= getSafe($inquiry['status']) ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#details-<?= $inquiry['id'] ?>">View</button>
                        </td>
                    </tr>
                    <tr class="collapse" id="details-<?= $inquiry['id'] ?>">
                        <td colspan="7">
                            <div class="mb-3"><strong>Message:</strong><br><?= nl2br(getSafe($inquiry['message'])) ?></div>
                            <form method="post" class="d-flex gap-2 align-items-center">
                                <input type="hidden" name="id" value="<?= $inquiry['id'] ?>">
                                <label class="mb-0">Status:</label>
                                <select name="status" class="form-select w-auto">
                                    <option value="pending" <?= $inquiry['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="reviewed" <?= $inquiry['status'] === 'reviewed' ? 'selected' : '' ?>>Reviewed</option>
                                    <option value="closed" <?= $inquiry['status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
                                </select>
                                <button class="btn btn-sm btn-dark" type="submit">Save</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php';
