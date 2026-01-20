<?php
session_start();

$userIdError   = $_SESSION['userIdError'] ?? '';
$passwordError = $_SESSION['passwordError'] ?? '';
$userIdValue   = $_SESSION['userIdValue'] ?? '';

unset($_SESSION['userIdError'], $_SESSION['passwordError'], $_SESSION['userIdValue']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Header/Footer CSS first -->
    <link rel="stylesheet" href="../css/headerFooter.css">

    <!-- Page-specific CSS last -->
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<!-- Header -->
<?php require_once('header.php'); ?>

<!-- Login Form Wrapper -->
<div class="login-wrapper">
    <form method="post" action="../../Controller/loginHandle.php" onsubmit="return validateForm()">
        <h2>Login</h2>

        <div class="row">
            <label>Mobile Number</label>
            <input
                type="text"
                id="phone"
                name="userid"
                placeholder="01xxxxxxxxx"
                value="<?php echo htmlspecialchars($userIdValue); ?>">
            <span id="phoneError"><?php echo $userIdError; ?></span>
        </div>

        <div class="row">
            <label>Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter password">
            <span id="passwordError"><?php echo $passwordError; ?></span>
        </div>

        <button type="submit">Login</button>

        <div class="forgot-password">
            <a href="forgot_password.php">Forgot Password?</a>
        </div>
    </form>
</div>

<!-- Footer -->
<?php require_once('footer.php'); ?>

<script src="../js/loginHandle.js"></script>
</body>
</html>
