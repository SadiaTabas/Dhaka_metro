<?php
session_start();
require_once('../Model/db.php'); // Uses your existing $conn connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticketID = trim($_POST['ticket_id'] ?? '');
    $nextStation = $_POST['next_station'] ?? '';

    if (empty($ticketID) || empty($nextStation)) {
        $_SESSION['msg'] = "Please provide both Ticket ID and Station.";
        header("Location: ../View/php/extendTicket.php");
        exit();
    }

    // 1. Verify if Ticket ID exists in 'tickets' table
    $stmt = $conn->prepare("SELECT TicketID FROM tickets WHERE TicketID = ?");
    $stmt->bind_param("i", $ticketID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 2. Ticket found - proceed to update the RouteID based on Next Station
        $updateStmt = $conn->prepare("UPDATE tickets SET RouteID = (SELECT RouteID FROM routes WHERE ToStation = ? LIMIT 1) WHERE TicketID = ?");
        $updateStmt->bind_param("si", $nextStation, $ticketID);

        if ($updateStmt->execute()) {
            $_SESSION['msg'] = "ticket extended";
        } else {
            $_SESSION['msg'] = "Error extending ticket.";
        }
        $updateStmt->close();
    } else {
        // 3. Ticket NOT found
        $_SESSION['msg'] = "ticket not found";
    }

    $stmt->close();
    $conn->close();
    header("Location: ../View/php/extendTicket.php");
    exit();
}
?>