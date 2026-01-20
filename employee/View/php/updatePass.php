<?php
session_start();
if (!isset($_SESSION['reset_mobile'])) {
    header("Location: forgot_password.php");
    exit();
}
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/headerFooter.css">
    <link rel="stylesheet" href="../css/updatepass.css">
</head>
<body>

    <!-- Header -->
    <?php require_once('header.php'); ?>

    <!-- Form Wrapper -->
    <div class="forgot-wrapper">
        <form action="../../Controller/updatePassHandle.php" method="post" onsubmit="return validatePassword()">
            <h2>Reset Password</h2>

            <?php if ($error): ?>
                <p class="error-msg"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <div class="row">
                <label>New Password</label>
                <input type="password" name="new_pass" id="new_pass" placeholder="Enter new password">
            </div>

            <div class="row">
                <label>Confirm Password</label>
                <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm new password">
                <span id="passError"></span>
            </div>

            <button type="submit">Continue</button>

            <div class="back-link">
                <a href="login.php">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <?php require_once('footer.php'); ?>

    <script src="../js/updatePass.js"></script>
</body>
</html>
