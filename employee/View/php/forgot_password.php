<?php
session_start();
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <!-- Header/Footer CSS first -->
    <link rel="stylesheet" href="../css/headerFooter.css">
    <!-- Page-specific CSS last -->
    <link rel="stylesheet" href="../css/forgot.css">
</head>
<body>

    <!-- Header -->
    <?php require_once('header.php'); ?>

    <!-- Forgot Password Wrapper -->
    <div class="forgot-wrapper">
        <form method="post" action="../../Controller/forgotHandle.php" onsubmit="return validateForgot()">
            <h2>Forgot Password</h2>

            <?php if ($error): ?>
                <p class="error-msg"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <div class="row">
                <label>Phone Number</label>
                <input type="text" id="phone" name="phone" placeholder="01XXXXXXXXX">
                <span id="phoneError"></span>
            </div>

            <button type="submit">Reset</button>

            <div class="back-login">
                <a href="login.php">← Back to Login</a>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <?php require_once('footer.php'); ?>

    <script src="../js/forgot.js"></script>
</body>
</html>
