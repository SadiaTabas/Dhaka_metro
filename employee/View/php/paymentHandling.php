<?php
session_start();
require_once('../../Model/db.php'); 

// Status message
$message = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);

// Last paid user info for history
$lastUserID = $_SESSION['last_paid_user'] ?? null;
$history = null;

if ($lastUserID) {
    $query = "SELECT u.Mobile, w.Balance FROM users u JOIN wallet w ON u.UserID = w.UserID WHERE u.UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $lastUserID);
    $stmt->execute();
    $history = $stmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Handling</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/headerFooter.css">
    <link rel="stylesheet" href="../css/paymentHandling.css">
</head>
<body>

    <!-- Header -->
    <?php require_once('header.php'); ?>

    <div class="container">
        <!-- Payment Card -->
        <div class="card">
            <h2 class="title">Payment Handling</h2>

            <!-- Status Message -->
            <?php if ($message): ?>
                <div class="status-msg <?php echo ($message === "Payment successful") ? "status-success" : "status-error"; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <!-- Payment Form -->
            <form action="../../Controller/paymentHandle.php" method="POST">
                <div class="input-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" placeholder="Enter Mobile" required>

                    <label>Amount (BDT)</label>
                    <input type="number" name="amount" placeholder="Enter Amount" step="0.01" required>

                    <button type="submit" class="submit-btn">Verify & Pay</button>
                    <a href="employeDashboard.php" class="back-link">← Back</a>
                </div>
            </form>
        </div>

        <!-- Recent Transaction -->
        <?php if ($history): ?>
        <div class="card history-card">
            <h3>Recent Transaction</h3>
            <table>
                <thead>
                    <tr>
                        <th>Mobile</th>
                        <th>Balance</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($history['Mobile']); ?></td>
                        <td><?php echo htmlspecialchars($history['Balance']); ?> BDT</td>
                        <td class="status-paid">Paid</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php require_once('footer.php'); ?>

</body>
</html>
