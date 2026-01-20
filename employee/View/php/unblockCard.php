<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unblock Card - Dhaka Metro</title>
     <link rel="stylesheet" href="../css/headerFooter.css">
    <link rel="stylesheet" href="../css/unblockCard.css">
   
</head>
<body>

<?php require_once('header.php'); ?>

<div class="container">
    <div class="card">
        <h2 class="title">Unblock Card</h2>

        <?php
        if (isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            $isSuccess = stripos($msg, 'success') !== false;
            $class = $isSuccess ? "status-success" : "status-error";
            echo '<div class="status-msg '.$class.'">'.htmlspecialchars($msg).'</div>';
            unset($_SESSION['msg']);
        }
        ?>

        <form action="../../Controller/unblockHandle.php" method="POST">
            <label>Mobile Number</label>
            <input type="text" name="mobile" placeholder="Enter Mobile Number" required>

            <button type="submit">Verify & Unblock</button>

            <a href="passengerSupport.php" class="back-btn">← Back</a>
        </form>
    </div>
</div>

<?php require_once('footer.php'); ?>

</body>
</html>
