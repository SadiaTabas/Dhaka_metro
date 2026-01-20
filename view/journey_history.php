<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    die("Please login first");
}

 

include "../model/JourneyModel.php";
include "header.php";

 

$userId = $_SESSION['UserID'];
 
$userId = $_SESSION['UserID'] ?? 0;

$passenger = mysqli_fetch_assoc(getPassenger($userId));
$total = mysqli_fetch_assoc(getTotalTicket($userId));
$journeys = getJourneyHistory($userId);
?>

<link rel="stylesheet" href="journey_history.css">
 

<div class="dashboard-content">
 
    <h2 class="page-title">Dhaka Metro  – Journey History</h2>

    <p><strong>Passenger:</strong>
        <?php echo $passenger['FirstName']." ".$passenger['LastName']; ?>
    </p>

    <p><strong>Total Ticket Booking:</strong>
        <?php echo $total['total']; ?>
    </p>

    <?php if (isset($_GET['msg'])) { ?>
        <p class="success-msg">Selected journey history deleted</p>
    <?php } ?>

    <form method="post"
          action="../controller/JourneyController.php"
          onsubmit="return validateDelete();">

        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($journeys)) {
        ?>
            <table class="history-table">
                <tr>
                    <td><strong>No</strong></td>
                    <td><?php echo $no++; ?></td>
                </tr>
                <tr>
                    <td><strong>From</strong></td>
                    <td><?php echo $row['FromStation']; ?></td>
                </tr>
                <tr>
                    <td><strong>To</strong></td>
                    <td><?php echo $row['ToStation']; ?></td>
                </tr>
                <tr>
                    <td><strong>Date</strong></td>
                    <td><?php echo $row['JourneyDate']; ?></td>
                </tr>
                <tr>
                    <td><strong>Select</strong></td>
                    <td>
                        <input type="checkbox"
                               name="ticket_id[]"
                               value="<?php echo $row['TicketID']; ?>">
                    </td>
                </tr>
            </table>
            <br>
        <?php } ?>

        <button type="submit" class="danger-btn">Delete</button>
        
        <button type="button"class="danger-btn" onclick="window.location.href='payment_record_page.php '">
   Back
</button>
    </form>
     
</div>


<script src="journey.js"></script>

<?php include "footer.php"; ?>