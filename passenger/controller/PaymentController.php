<?php
session_start();

include "../model/Database.php";
include "../model/PaymentModel.php";

 
if (!isset($_SESSION['UserID'])) {
    header("Location:/employee/View/php/login.php");
    exit();
}

$userID = $_SESSION['UserID'];

 
if (isset($_POST['submit'])) {

    $amount  = trim($_POST['amount']);
    $method  = $_POST['payment_method'] ?? "";
    $routeID = $_POST['route_id'] ?? 0;

    
    $walletBalance = getWalletBalance($userID);

     
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

         
        $ticketID = createTicket($userID, $routeID);

        if ($ticketID > 0) {

            
            deductWalletBalance($userID, $amount);

           
            addTransaction($userID, $amount, "Debit", $method);

             
            addPayment($ticketID, $amount);

             
            markTicketPaid($ticketID);

            $_SESSION['alert'] = "Payment successful! BDT $amount deducted.";
        } else {
            $_SESSION['alert'] = "Failed to create ticket. Please try again.";
        }
    }

     
    header("Location: ../view/payment.php?route_id=$routeID");
    exit();
}
