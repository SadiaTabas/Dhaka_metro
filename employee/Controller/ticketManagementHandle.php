<?php
session_start();
require_once('../Model/db.php'); // Make sure this path is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobileNumber = trim($_POST['mobile_number'] ?? '');
    $action       = $_POST['action'] ?? '';

    // Validate input
    if (empty($mobileNumber)) {
        $_SESSION['msg'] = "Mobile number is required.";
        header("Location: ../View/php/ticketManagement.php");
        exit();
    }

    if (empty($action)) {
        $_SESSION['msg'] = "Please select an action.";
        header("Location: ../View/php/ticketManagement.php");
        exit();
    }

    // Step 1: Check if mobile number exists in users table
    $stmt = $conn->prepare("SELECT UserID FROM users WHERE mobile = ?"); // <-- change 'mobile' to your column name
    if (!$stmt) {
        $_SESSION['msg'] = "Database error: " . $conn->error;
        header("Location: ../View/php/ticketManagement.php");
        exit();
    }

    $stmt->bind_param("s", $mobileNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userID = $user['UserID'];

        // Step 2: Update ticket status for this user
        $updateStmt = $conn->prepare("UPDATE tickets SET Status = ? WHERE UserID = ?");
        if (!$updateStmt) {
            $_SESSION['msg'] = "Database error: " . $conn->error;
            header("Location: ../View/php/ticketManagement.php");
            exit();
        }

        $updateStmt->bind_param("si", $action, $userID);

        if ($updateStmt->execute()) {
            if ($action === "Confirmed") {
                $_SESSION['msg'] = "Ticket confirmed successfully.";
            } elseif ($action === "Cancelled") {
                $_SESSION['msg'] = "Ticket cancelled successfully.";
            } else {
                $_SESSION['msg'] = "Ticket status updated.";
            }
        } else {
            $_SESSION['msg'] = "Error updating ticket status.";
        }

        $updateStmt->close();
    } else {
        $_SESSION['msg'] = "Mobile number not found.";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to form page
    header("Location: ../View/php/ticketManagement.php");
    exit();
}
?>
