<?php
include "Database.php";

 
function getUserName($userID) {
    global $conn;
    $sql = "SELECT FirstName, LastName 
            FROM users 
            WHERE UserID = $userID";
    return mysqli_query($conn, $sql);
}

 
function getTicketHistory($userID) {
    global $conn;
    $sql = "SELECT 
                t.TicketID,
                r.FromStation,
                r.ToStation,
                t.JourneyDate,
                t.Status
            FROM tickets t
            JOIN routes r ON t.RouteID = r.RouteID
            WHERE t.UserID = $userID
            ORDER BY t.CreatedAt DESC";
    return mysqli_query($conn, $sql);
}

 
function getPaymentHistory($userID) {
    global $conn;
    $sql = "SELECT 
                p.PaymentID,
                p.Amount,
                p.PaymentDate,
                p.Status
            FROM payments p
            JOIN tickets t ON p.TicketID = t.TicketID
            WHERE t.UserID = $userID
            ORDER BY p.PaymentDate DESC";
    return mysqli_query($conn, $sql);
}

 
function deletePayment($paymentID) {
    global $conn;
    $sql = "DELETE FROM payments WHERE PaymentID = $paymentID";
    return mysqli_query($conn, $sql);
}
