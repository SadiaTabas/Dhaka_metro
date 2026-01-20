<?php
session_start();


$message = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Management - Dhaka Metro</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/headerFooter.css">
    <link rel="stylesheet" href="../css/ticketManagement.css">
</head>
<body>

    <!-- Header -->
    <?php require_once('header.php'); ?>

    <!-- Form Wrapper -->
    <div class="container">
        <form method="POST" action="../../Controller/ticketManagementHandle.php" id="ticketManagementForm">
            
            <h2 class="form-title">Ticket Management</h2>

            <!-- PHP status message -->
            <?php if ($message): ?>
                <div class="status-msg <?php echo $message === "ticket confirm" ? "status-confirm" : "status-cancel"; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <label>Ticket ID</label>
                <input type="text" name="ticket_id" placeholder="Enter Ticket ID">
            </div>

            <div class="row">
                <label>Action</label>
                <select name="action">
                    <option value="">-- Select Action --</option>
                    <option value="Confirmed">Confirm Booking</option>
                    <option value="Cancelled">Cancel Ticket</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Submit</button>

            <div class="footer-links">
                <a href="employeDashboard.php" class="back-link">← Back to Dashboard</a>
            </div>

            <div class="note">
                Make sure to verify the ticket ID and action before submitting
            </div>
        </form>
    </div>

    <!-- Footer -->
    <?php require_once('footer.php'); ?>

    <!-- JS Validation -->
    <script src="../js/ticketManagement.js"></script>

</body>
</html>
