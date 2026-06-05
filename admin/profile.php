<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';
requireAdmin();

$model = new AdminModel();
$adminId = (int) ($_SESSION['admin_id'] ?? 0);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();

    $fullName = trim((string) ($_POST['full_name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $currentPw = (string) ($_POST['current_password'] ?? '');
    $newPw = (string) ($_POST['new_password'] ?? '');
    $confirmPw = (string) ($_POST['confirm_password'] ?? '');

    if ($fullName === '') {
        $errors[] = 'Full name is required.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email is required.';
    } elseif ($model->emailTakenByOther($email, $adminId)) {
        $errors[] = 'That email is already in use.';
    }

    $admin = $model->getById($adminId);
    if (!$admin) {
        $errors[] = 'Account not found.';
    }

    $wantsPasswordChange = $newPw !== '' || $confirmPw !== '';
    if ($wantsPasswordChange) {
        if (!$admin || !password_verify($currentPw, $admin['password'])) {
            $errors[] = 'Current password is incorrect.';
        }
        if (strlen($newPw) < 8) {
            $errors[] = 'New password must be at least 8 characters.';
        }
        if ($newPw !== $confirmPw) {
            $errors[] = 'New password and confirmation do not match.';
        }
    }

    if (empty($errors) && $admin) {
        $model->updateProfile($adminId, $fullName, $email);
        if ($wantsPasswordChange) {
            $model->updatePassword($adminId, password_hash($newPw, PASSWORD_BCRYPT, ['cost' => 12]));
        }
        $_SESSION['admin_name'] = $fullName;
        $_SESSION['admin_email'] = $email;
        setFlash('Profile updated.');
        redirectAdmin('profile.php');
    }
}

$admin = $model->getById($adminId) ?? ['full_name' => '', 'email' => '', 'last_login' => null];
$flash = getFlash();
$csrfToken = csrfToken();
$pageTitle = 'Profile';
$activeNav = 'profile';
require __DIR__ . '/partials/layout_top.php';
?>
<?php if ($flash) : ?><div class="alert <?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div><?php endif; ?>
<?php if (!empty($errors)) : ?><div class="alert danger"><?php foreach ($errors as $error) : ?><p><?php echo e($error); ?></p><?php endforeach; ?></div><?php endif; ?>

<div class="panel">
    <h2 style="margin-top:0;">Account Details</h2>
    <p class="muted">Last login: <?php echo e((string) ($admin['last_login'] ?? 'never')); ?></p>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
        <div class="admin-form-grid">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input id="full_name" type="text" name="full_name" value="<?php echo e((string) ($_POST['full_name'] ?? $admin['full_name'])); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?php echo e((string) ($_POST['email'] ?? $admin['email'])); ?>" required>
            </div>
        </div>

        <h2>Change Password</h2>
        <p class="muted">Leave blank to keep your current password.</p>
        <div class="admin-form-grid">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input id="current_password" type="password" name="current_password" autocomplete="current-password">
            </div>
            <div class="form-group"></div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input id="new_password" type="password" name="new_password" autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input id="confirm_password" type="password" name="confirm_password" autocomplete="new-password">
            </div>
        </div>
        <button type="submit">Save Profile</button>
    </form>
</div>
<?php require __DIR__ . '/partials/layout_bottom.php'; ?>
