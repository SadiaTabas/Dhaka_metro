<?php
session_start();
include "../model/PaymentModel.php";
include "header.php";
 
$userID = $_SESSION['UserID'] ?? 0;


$routeID  = $_GET['route_id'] ?? 1;

$balance  = getWalletBalance($userID);
$fare     = getRouteFare($routeID);

$alertMessage = $_SESSION['alert'] ?? "";
unset($_SESSION['alert']);
?>

<link rel="stylesheet" href="payment.css">

<div class="payment-box">
    <div class="payment-form">

        <h2>Payment Page</h2>
 
        <p class="balance">
           Available Balance: <span id="balanceSpan"><?php echo $balance; ?> BDT</span>

        </p>

       
        <p>
            Fare: <span class="fare-amount"><?php echo $fare; ?> BDT</span>
        </p>

        <form id="paymentForm" method="POST" action="../controller/PaymentController.php">

            <input type="hidden" name="route_id" value="<?php echo $routeID; ?>">

            <label>Payment Method</label>
            <select name="payment_method" id="payment_method">
                <option value="">Select Payment Method</option>
                <option value="Rocket">Rocket</option>
                <option value="Bkash">Bkash</option>
                <option value="Card">Card</option>
            </select>

            <label>Amount (BDT)</label>
            <input type="text" name="amount" id="amount">

            <p class="disclaimer">
                Service charge & SMS charge are non-refundable.<br>
                By clicking Process Payment you agree to Metro Rail Terms & Conditions.
            </p>

            <button type="submit" name="submit">Process Payment</button>
            <button type="reset">Reset</button>

        </form>
    </div>
</div>

<?php include "footer.php"; ?>

<script src="payment.js"></script>

<?php if ($alertMessage != ""): ?>
<script>
    alert("<?php echo $alertMessage; ?>");
</script>
<?php endif; ?>
