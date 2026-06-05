<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';

$errors = [];
$email = '';
$attempts = new LoginAttemptModel();
$clientIp = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $token = $_POST['csrf_token'] ?? '';

    if (!verifyCsrfToken($token)) {
        $errors[] = 'Invalid session token.';
    }

    if ($attempts->isLockedOut($clientIp)) {
        $errors[] = 'Too many failed attempts. Please try again in '
            . $attempts->windowMinutes() . ' minutes.';
    }

    if (empty($errors) && (empty($email) || empty($password))) {
        $errors[] = 'Email and password are required.';
    }

    if (empty($errors)) {
        $adminModel = new AdminModel();
        $admin = $adminModel->getByEmail($email);

        if ($admin && password_verify($password, $admin['password'])) {
            $attempts->clearFailures($clientIp);
            $adminModel->updateLastLogin((int) $admin['id']);
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_email'] = $admin['email'];
            $_SESSION['admin_name'] = $admin['full_name'] ?? $admin['email'];
            header('Location: dashboard.php');
            exit;
        }

        $attempts->recordFailure($clientIp, $email);
        if ($attempts->isLockedOut($clientIp)) {
            $errors[] = 'Too many failed attempts. Please try again in '
                . $attempts->windowMinutes() . ' minutes.';
        } else {
            $errors[] = 'Invalid credentials. Please try again.';
        }
    }
}

$csrfToken = csrfToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Afterthink Studio</title>
    <link rel="stylesheet" href="<?php echo assetUrl('css/admin.css'); ?>">
</head>
<body>
<div class="admin-wrapper">
    <header class="admin-header">
        <h1>Afterthink Studio Admin</h1>
    </header>
    <main class="admin-content">
        <h2>Sign In</h2>

        <?php if (!empty($errors)) : ?>
            <div class="alert">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" novalidate>
            <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
            <div class="form-group">
                <label for="email">Email address</label>
                <input id="email" type="email" name="email" value="<?php echo e($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </main>
</div>
</body>
</html>
