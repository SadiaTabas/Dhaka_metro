<?php
session_start();
require_once('../Model/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_pass = $_POST['new_pass'] ?? '';
    $confirm_pass = $_POST['confirm_pass'] ?? '';
    $mobile = $_SESSION['reset_mobile'] ?? '';

    if (empty($new_pass) || $new_pass !== $confirm_pass) {
        $_SESSION['error'] = "Passwords do not match or empty!";
        header("Location: ../View/php/updatePass.php");
        exit();
    }

    
    $stmt = $conn->prepare("UPDATE users SET Password = ? WHERE Mobile = ?");
    $stmt->bind_param("ss", $new_pass, $mobile);

    if ($stmt->execute()) {
        unset($_SESSION['reset_mobile']); 
        header("Location: ../View/php/login.php?msg=PasswordUpdated");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update password. Please try again.";
        header("Location: ../View/php/updatePass.php");
        exit();
    }
}
?>