<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';
requireAdmin();

$model = new InquiryModel();
$db = getDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();
    $action = $_POST['action'] ?? '';
    $id = max(0, (int) ($_POST['id'] ?? 0));

    if ($id > 0 && $action === 'status') {
        $model->updateStatus($id, (string) ($_POST['status'] ?? 'new'));
        setFlash('Inquiry status updated.');
    }
    if ($id > 0 && $action === 'delete') {
        $model->delete($id);
        setFlash('Inquiry deleted.');
    }
    redirectAdmin('inquiries.php');
}

$search = trim((string) ($_GET['q'] ?? ''));
$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 15;

$params = [];
$where = '';
if ($search !== '') {
    $where = ' WHERE name LIKE :q OR email LIKE :q OR message LIKE :q';
    $params[':q'] = '%' . $search . '%';
}
$countStmt = $db->prepare('SELECT COUNT(*) FROM inquiries' . $where);
$countStmt->execute($params);
$total = (int) $countStmt->fetchColumn();
$totalPages = max(1, (int) ceil($total / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$listStmt = $db->prepare('SELECT * FROM inquiries' . $where . " ORDER BY created_at DESC LIMIT {$perPage} OFFSET {$offset}");
$listStmt->execute($params);
$inquiries = $listStmt->fetchAll();

$flash = getFlash();
$csrfToken = csrfToken();
$pageTitle = 'Contact Inquiries';
$activeNav = 'inquiries';
require __DIR__ . '/partials/layout_top.php';
?>
<?php if ($flash) : ?><div class="alert <?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div><?php endif; ?>
<div class="panel">
    <div class="list-toolbar">
        <form class="search-form" method="get">
            <input type="text" name="q" value="<?php echo e($search); ?>" placeholder="Search inquiries…">
            <button type="submit">Search</button>
        </form>
        <span class="muted"><?php echo e((string) $total); ?> inquir<?php echo $total === 1 ? 'y' : 'ies'; ?></span>
    </div>
    <table class="admin-table">
        <thead>
        <tr><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Status</th><th>Received</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php foreach ($inquiries as $inquiry) : ?>
            <tr>
                <td><?php echo e((string) $inquiry['name']); ?></td>
                <td><?php echo e((string) $inquiry['email']); ?></td>
                <td><?php echo e((string) ($inquiry['phone'] ?? '')); ?></td>
                <td><?php echo nl2br(e((string) $inquiry['message'])); ?></td>
                <td><span class="badge <?php echo e((string) $inquiry['status']); ?>"><?php echo e((string) $inquiry['status']); ?></span></td>
                <td><?php echo e((string) $inquiry['created_at']); ?></td>
                <td>
                    <div class="admin-actions">
                        <form method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
                            <input type="hidden" name="action" value="status">
                            <input type="hidden" name="id" value="<?php echo e((string) $inquiry['id']); ?>">
                            <select name="status">
                                <option value="new" <?php echo $inquiry['status'] === 'new' ? 'selected' : ''; ?>>New</option>
                                <option value="read" <?php echo $inquiry['status'] === 'read' ? 'selected' : ''; ?>>Read</option>
                                <option value="archived" <?php echo $inquiry['status'] === 'archived' ? 'selected' : ''; ?>>Archived</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                        <form method="post" onsubmit="return confirm('Delete this inquiry?');">
                            <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo e((string) $inquiry['id']); ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($inquiries)) : ?><tr><td colspan="7" class="muted">No inquiries found.</td></tr><?php endif; ?>
        </tbody>
    </table>
    <?php if ($totalPages > 1) : ?>
        <?php $base = 'inquiries.php?' . ($search !== '' ? 'q=' . urlencode($search) . '&' : '') . 'page='; ?>
        <div class="pagination">
            <a class="<?php echo $page <= 1 ? 'disabled' : ''; ?>" href="<?php echo e($base . ($page - 1)); ?>">‹ Prev</a>
            <?php for ($p = 1; $p <= $totalPages; $p++) : ?>
                <?php if ($p === $page) : ?><span class="current"><?php echo $p; ?></span>
                <?php else : ?><a href="<?php echo e($base . $p); ?>"><?php echo $p; ?></a><?php endif; ?>
            <?php endfor; ?>
            <a class="<?php echo $page >= $totalPages ? 'disabled' : ''; ?>" href="<?php echo e($base . ($page + 1)); ?>">Next ›</a>
        </div>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/partials/layout_bottom.php'; ?>
