<?php
session_start();

include "../model/RecordModel.php";
include "header.php";

 
if (!isset($_SESSION['UserID'])) {
    header("/employee/View/php/login.php");
    exit();
}

$userID = $_SESSION['UserID'];

 
$user = mysqli_fetch_assoc(getUserName($userID));

$type = $_GET['type'] ?? "";
?>


<link rel="stylesheet" href="payment_record_page.css">

<div class="user-info"> Welcome, <strong><?php echo $user['FirstName'] . " " . $user['LastName']; ?></strong> </div>
<div class="dashboard-box">

    
    <div class="button-area">
        <div class="button-row">
            <a href="/admin/view/Profile_Information.php" class="btn">Update Profile</a>
            <a href="journey_history.php" class="btn">Journey History</a>
        </div>
        <div class="button-row">
            <a href="?type=tickets" class="btn">View Ticket History</a>
            <a href="?type=payments" class="btn">Payment History</a>
        </div>
         
    </div>

    
    <div id="resultArea">

         
        <?php if ($type === "tickets"): ?>
            <h3>Ticket History</h3>

            <table>
                <tr>
                    <th>ID</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>

                <?php
                $tickets = getTicketHistory($userID);
                while ($row = mysqli_fetch_assoc($tickets)):
                ?>
                <tr>
                    <td><?= $row['TicketID'] ?></td>
                    <td><?= $row['FromStation'] ?></td>
                    <td><?= $row['ToStation'] ?></td>
                    <td><?= $row['JourneyDate'] ?></td>
                    <td><?= $row['Status'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>

        <?php endif; ?>

         
        <?php if ($type === "payments"): ?>
            <h3>Payment History</h3>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php
                $payments = getPaymentHistory($userID);
                while ($row = mysqli_fetch_assoc($payments)):
                ?>
                <tr>
                    <td><?= $row['PaymentID'] ?></td>
                    <td><?= $row['Amount'] ?> ৳</td>
                    <td><?= $row['PaymentDate'] ?></td>
                    <td><?= $row['Status'] ?></td>
                    <td>
                        <a href="../controller/RecordController.php?delete=<?= $row['PaymentID'] ?>"
                           class="action-btn"
                           onclick="return confirmDelete();">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>

        <?php endif; ?>

    </div>
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this payment?");
}
</script>

<?php include "footer.php"; ?>
