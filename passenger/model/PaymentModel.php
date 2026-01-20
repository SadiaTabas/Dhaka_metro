<?php
include "Database.php";

 
function getWalletBalance($userID) {
    global $conn;
    $sql = "SELECT Balance FROM wallet WHERE UserID=$userID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['Balance'] ?? 0;
}

 
function deductWalletBalance($userID, $amount) {
    global $conn;
    $sql = "UPDATE wallet SET Balance = Balance - $amount WHERE UserID=$userID";
    return mysqli_query($conn, $sql);
}

 
function addTransaction($userID, $amount, $type, $ref) {
    global $conn;
    $sql = "INSERT INTO transactions (UserID, Amount, Type, Reference)
            VALUES ($userID, $amount, '$type', '$ref')";
    return mysqli_query($conn, $sql);
}

 
function addPayment($routeID, $amount) {
    global $conn;
    $sql = "INSERT INTO payments (TicketID, Amount, Status)
            VALUES ($routeID, $amount, 'Success')";
    return mysqli_query($conn, $sql);
}

 
function getRouteFare($routeID) {
    global $conn;
    $sql = "SELECT Fare FROM routes WHERE RouteID=$routeID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['Fare'] ?? 0;
}
 
function createTicket($userID, $routeID) {
    global $conn;

    $sql = "INSERT INTO tickets (UserID, RouteID, Status)
            VALUES ($userID, $routeID, 'Pending')";

    mysqli_query($conn, $sql);
    return mysqli_insert_id($conn);  
}
function markTicketPaid($ticketID) {
    global $conn;
    $sql = "UPDATE tickets SET Status='Paid' WHERE TicketID=$ticketID";
    return mysqli_query($conn, $sql);
}