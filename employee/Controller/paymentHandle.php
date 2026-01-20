<?php
session_start();
require_once('../Model/db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = trim($_POST['mobile'] ?? '');
    $amount = floatval($_POST['amount'] ?? 0);

    if (empty($mobile) || $amount <= 0) {
        $_SESSION['msg'] = "Invalid mobile or amount.";
        header("Location: ../View/php/paymentHandling.php");
        exit();
    }

    // 1. Verify user exists via Mobile
    $stmt = $conn->prepare("SELECT UserID FROM users WHERE Mobile = ?");
    $stmt->bind_param("s", $mobile);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userID = $user['UserID'];

        // 2. Check if wallet exists
        $walletCheck = $conn->prepare("SELECT UserID FROM wallet WHERE UserID = ?");
        $walletCheck->bind_param("i", $userID);
        $walletCheck->execute();
        
        if ($walletCheck->get_result()->num_rows > 0) {
            // Update existing
            $update = $conn->prepare("UPDATE wallet SET Balance = Balance + ? WHERE UserID = ?");
            $update->bind_param("di", $amount, $userID);
            $update->execute();
        } else {
            // Create new record for users like UserID 4
            $insert = $conn->prepare("INSERT INTO wallet (UserID, Balance) VALUES (?, ?)");
            $insert->bind_param("id", $userID, $amount);
            $insert->execute();
        }

        $_SESSION['msg'] = "payment verified and balance updated";
        $_SESSION['last_paid_user'] = $userID; 
    } else {
        $_SESSION['msg'] = "mobile number not found";
    }

    $conn->close();
    header("Location: ../View/php/paymentHandling.php");
    exit();
}