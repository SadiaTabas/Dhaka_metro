<?php
session_start();
require_once('../Model/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mobile = trim($_POST['mobile'] ?? '');

    if ($mobile === '') {
        $_SESSION['msg'] = "Mobile number is required.";
        header("Location: ../View/php/unblockCard.php");
        exit();
    }

    // 1️⃣ Find User by Mobile
    $userQuery = $conn->prepare("SELECT UserID FROM users WHERE Mobile = ?");
    $userQuery->bind_param("s", $mobile);
    $userQuery->execute();
    $userResult = $userQuery->get_result();

    if ($userResult->num_rows === 0) {
        $_SESSION['msg'] = "Mobile number not registered.";
        header("Location: ../View/php/unblockCard.php");
        exit();
    }

    $userData = $userResult->fetch_assoc();
    $userID = $userData['UserID'];

    // 2️⃣ Get latest ticket
    $ticketQuery = $conn->prepare(
        "SELECT TicketID, Status 
         FROM tickets 
         WHERE UserID = ? 
         ORDER BY TicketID DESC 
         LIMIT 1"
    );
    $ticketQuery->bind_param("i", $userID);
    $ticketQuery->execute();
    $ticketResult = $ticketQuery->get_result();

    if ($ticketResult->num_rows === 0) {
        $_SESSION['msg'] = "No ticket found for this user.";
        header("Location: ../View/php/unblockCard.php");
        exit();
    }

    $ticketData = $ticketResult->fetch_assoc();
    $ticketID = $ticketData['TicketID'];

    if ($ticketData['Status'] === 'Confirmed') {
        $_SESSION['msg'] = "Card is already confirmed.";
        header("Location: ../View/php/unblockCard.php");
        exit();
    }

    // 3️⃣ Check Wallet Balance
    $walletQuery = $conn->prepare("SELECT Balance FROM wallet WHERE UserID = ?");
    $walletQuery->bind_param("i", $userID);
    $walletQuery->execute();
    $walletResult = $walletQuery->get_result();

    if ($walletResult->num_rows === 0) {
        $_SESSION['msg'] = "Wallet not found for this user.";
        header("Location: ../View/php/unblockCard.php");
        exit();
    }

    $walletData = $walletResult->fetch_assoc();

    if ($walletData['Balance'] <= 0) {
        $_SESSION['msg'] = "Please add balance first to unblock this card.";
        header("Location: ../View/php/unblockCard.php");
        exit();
    }

    // 4️⃣ Update Ticket Status
    $update = $conn->prepare(
        "UPDATE tickets SET Status = 'Confirmed' WHERE TicketID = ?"
    );
    $update->bind_param("i", $ticketID);

    if ($update->execute()) {
        $_SESSION['msg'] = "Card successfully unblocked!";
    } else {
        $_SESSION['msg'] = "System error! Could not update card.";
    }

    $conn->close();
    header("Location: ../View/php/unblockCard.php");
    exit();
}
