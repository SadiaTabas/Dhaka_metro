<?php
include "Database.php";

 
function getPassenger($userId) {
    global $conn;

    $sql = "SELECT FirstName, LastName 
            FROM users 
            WHERE UserID = $userId";

    return mysqli_query($conn, $sql);
}

 
function getTotalTicket($userId) {
    global $conn;

    $sql = "SELECT COUNT(*) AS total 
            FROM tickets 
            WHERE UserID = $userId";

    return mysqli_query($conn, $sql);
}

 
function getJourneyHistory($userId) {
    global $conn;

    $sql = "SELECT 
                t.TicketID,
                r.FromStation,
                r.ToStation,
                t.JourneyDate
            FROM tickets t
            JOIN routes r ON t.RouteID = r.RouteID
            WHERE t.UserID = $userId
            ORDER BY t.CreatedAt DESC";

    return mysqli_query($conn, $sql);
}

 
function deleteJourney($ticketID, $userID) {
    global $conn;

    mysqli_begin_transaction($conn);

    try {
        mysqli_query($conn, "DELETE FROM payments WHERE TicketID = $ticketID");
        mysqli_query($conn, "DELETE FROM tickets WHERE TicketID = $ticketID AND UserID = $userID");

        mysqli_commit($conn);
        return true;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        return false;
    }
}

?>