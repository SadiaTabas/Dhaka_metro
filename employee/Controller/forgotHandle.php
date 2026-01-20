<?php
session_start();
require_once('../Model/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = trim($_POST['phone'] ?? '');

    if (empty($phone)) {
        $_SESSION['error'] = "Phone number is required.";
        header("Location: ../View/php/forgot_password.php");
        exit();
    }

    // Database check
    $stmt = $conn->prepare("SELECT UserID FROM users WHERE Mobile = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['reset_mobile'] = $phone;
        header("Location: ../View/php/updatePass.php");
        exit();
    } else {
        $_SESSION['error'] = "Phone number does not match in our records.";
        header("Location: ../View/php/forgot_password.php");
        exit();
    }
}
?>