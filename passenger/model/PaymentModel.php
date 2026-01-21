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

 
function addPayment($ticketID, $amount) {
    global $conn;
    $sql = "INSERT INTO payments (TicketID, Amount, Status)
            VALUES ($ticketID, $amount, 'Success')";
    return mysqli_query($conn, $sql);
}

 
function getRouteFare($routeID) {
    global $conn;

    $sql = "SELECT Fare FROM routes WHERE RouteID=$routeID";
    $result = mysqli_query($conn, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        return 0;
    }

    $row = mysqli_fetch_assoc($result);
    return $row['Fare'];
}


function createTicket($userID, $routeID, $journeyDate) {
    global $conn;
    $sql = "INSERT INTO tickets (UserID, RouteID, JourneyDate, Status)
            VALUES ($userID, $routeID, '$journeyDate', 'Confirmed')";
    mysqli_query($conn, $sql);
    return mysqli_insert_id($conn);
}


 

?>
