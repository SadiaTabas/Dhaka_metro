<?php
session_start();

include "../model/Database.php";
include "../model/PaymentModel.php";

/* Login check */
if (!isset($_SESSION['UserID'])) {
    header("Location:/employee/View/php/login.php");
    exit();
}

$userID = $_SESSION['UserID'];

/* Handle form submission */
if (isset($_POST['submit'])) {

    $amount  = trim($_POST['amount']);
    $method  = $_POST['payment_method'] ?? "";
    $routeID = $_POST['route_id'] ?? 0;

    /* Get wallet balance */
    $walletBalance = getWalletBalance($userID);

    /* Validation */
    if ($amount === "" || !is_numeric($amount) || $amount <= 0) {
        $_SESSION['alert'] = "Enter a valid amount.";
    }
    elseif ($method === "") {
        $_SESSION['alert'] = "Select a payment method.";
    }
    elseif ($amount > $walletBalance) {
        $_SESSION['alert'] = "Insufficient balance!";
    }
    else {

        /* 1️⃣ Create ticket first (IMPORTANT) */
        $ticketID = createTicket($userID, $routeID);

        if ($ticketID > 0) {

            /* 2️⃣ Deduct wallet balance */
            deductWalletBalance($userID, $amount);

            /* 3️⃣ Add transaction record */
            addTransaction($userID, $amount, "Debit", $method);

            /* 4️⃣ Add payment using TicketID */
            addPayment($ticketID, $amount);

            /* 5️⃣ Mark ticket as paid */
            markTicketPaid($ticketID);

            $_SESSION['alert'] = "Payment successful! BDT $amount deducted.";
        } else {
            $_SESSION['alert'] = "Failed to create ticket. Please try again.";
        }
    }

    /* Redirect back to payment page */
    header("Location: ../view/payment.php?route_id=$routeID");
    exit();
}
