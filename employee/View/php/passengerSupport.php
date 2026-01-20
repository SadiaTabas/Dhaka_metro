<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Passenger Support</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/headerFooter.css">
    <link rel="stylesheet" href="../css/passengerSupport.css">
</head>
<body>

    <!-- Header -->
    <?php require_once('header.php'); ?>

    <!-- Passenger Support Form/Card -->
    <form>
        <h2>Passenger Support</h2>

        <!-- Option Links -->
        <a href="extendTicket.php" class="option">
            🚆 Extend Ticket
        </a>

        <a href="unblockCard.php" class="option">
            💳 Resolve Blocked Card
        </a>

        <!-- Back Button -->
        <a href="employeDashboard.php" class="back-btn">← Back</a>

        <!-- Note -->
        <div class="note">
            Choose an option to get assistance
        </div>
    </form>

    <!-- Footer -->
    <?php require_once('footer.php'); ?>

</body>
</html>

