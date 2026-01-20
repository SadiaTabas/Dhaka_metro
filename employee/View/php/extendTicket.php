<?php
session_start();
$message = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Extend Ticket</title>

    <!-- Reuse login/forgot CSS -->
    <link rel="stylesheet" href="../css/headerFooter.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

    <!-- Header -->
    <?php require_once('header.php'); ?>

    <!-- Wrapper -->
    <div class="extend-wrapper">
        <form method="POST" action="../../Controller/extendTicketHandle.php" id="extendTicketForm">
            <h2>Extend Ticket</h2>

            <?php if ($message): ?>
                <p class="message"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>

            <div class="row">
                <label>Ticket ID</label>
                <input type="text" name="ticket_id" placeholder="Enter Ticket ID">
                <span class="error-msg" id="ticketIdError"></span>
            </div>

            <div class="row">
                <label>Next Station</label>
                <select name="next_station">
                    <option value="">-- Select Station --</option>
                    <option value="Uttara North">Uttara North</option>
                    <option value="Uttara Center">Uttara Center</option>
                    <option value="Uttara South">Uttara South</option>
                    <option value="Pallabi">Pallabi</option>
                    <option value="Mirpur 11">Mirpur 11</option>
                    <option value="Mirpur 10">Mirpur 10</option>
                    <option value="Kazipara">Kazipara</option>
                    <option value="Shewrapara">Shewrapara</option>
                    <option value="Agargaon">Agargaon</option>
                    <option value="Bijoy Sarani">Bijoy Sarani</option>
                    <option value="Farmgate">Farmgate</option>
                    <option value="Karwan Bazar">Karwan Bazar</option>
                    <option value="Shahbag">Shahbag</option>
                    <option value="Dhaka University">Dhaka University</option>
                    <option value="Bangladesh Secretariat">Bangladesh Secretariat</option>
                    <option value="Motijheel">Motijheel</option>
                </select>
                <span class="error-msg" id="nextStationError"></span>
            </div>

            <button type="submit">Extend Ticket</button>

            <div class="back-btn-wrapper">
                <a href="passengerSupport.php" class="back-btn">← Back</a>
            </div>

           
        </form>
    </div>

    <!-- Footer -->
    <?php require_once('footer.php'); ?>

    <!-- JS Validation -->
    <script src="../js/extendTicket.js"></script>
</body>
</html>