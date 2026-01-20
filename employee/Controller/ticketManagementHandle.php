<?php
session_start();
require_once('../Model/db.php'); // Adjust path if needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticketID = trim($_POST['ticket_id'] ?? '');
    $action   = $_POST['action'] ?? '';

    if (empty($ticketID)) {
        $_SESSION['msg'] = "Ticket ID is required.";
        header("Location: ../View/php/ticketManagement.php");
        exit();
    }

    // Check if ticket exists
    $stmt = $conn->prepare("SELECT TicketID FROM tickets WHERE TicketID = ?");
    $stmt->bind_param("i", $ticketID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ticket exists → update status
        $updateStmt = $conn->prepare("UPDATE tickets SET Status = ? WHERE TicketID = ?");
        $updateStmt->bind_param("si", $action, $ticketID);

        if ($updateStmt->execute()) {
            if ($action === "Confirmed") {
                $_SESSION['msg'] = "ticket confirm";
            } elseif ($action === "Cancelled") {
                $_SESSION['msg'] = "ticket cancle";
            }
        } else {
            $_SESSION['msg'] = "Error updating ticket status.";
        }
        $updateStmt->close();
    } else {
        // Ticket not found
        $_SESSION['msg'] = "ticket not found";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the same page to show message
    header("Location: ../View/php/ticketManagement.php");
    exit();
}
?>

