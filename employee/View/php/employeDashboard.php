<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/headerFooter.css">
    <link rel="stylesheet" href="../css/employDashboard.css">
</head>
<body>

    <!-- Header -->
    <?php require_once('header.php'); ?>

    <!-- Dashboard Wrapper -->
    <div class="dashboard-wrapper">
        <form class="dashboard">
            <h2>Employee Dashboard</h2>

            <div class="dashboard-links">
                <a href="ticketManagement.php">🎟 Ticket Management</a>
                <a href="passengerSupport.php">🧑 Passenger Support</a>
                <a href="paymentHandling.php">💳 Payment Handling</a>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <?php require_once('footer.php'); ?>

</body>
</html>
