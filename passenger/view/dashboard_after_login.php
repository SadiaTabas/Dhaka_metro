 <?php
session_start();
include "../model/Database.php";

 
if (!isset($_SESSION['UserID'])) {
    header("/employee/View/php/login.php");
    exit();
}
$from = $to = $date = '';

if (isset($_SESSION['temp_journey'])) {
    $from = $_SESSION['temp_journey']['from'] ?? '';
    $to   = $_SESSION['temp_journey']['to'] ?? '';
    $date = $_SESSION['temp_journey']['journey_date'] ?? '';
}

$userid = $_SESSION['UserID'];

 
$sql = "SELECT FirstName, LastName FROM users WHERE UserID = $userid";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $username = $user['FirstName'] . " " . $user['LastName'];
} else {
    $username = "User";
}

 
if (isset($_POST['logout'])) {
    session_destroy();
    header("/employee/View/php/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dhaka Metro Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
     
</head>
<body>

 
<?php include "header.php"; ?>

<div class="dashboard-box">
 
 
    <div class="form-side">
        <h2>Book Your Journey</h2>

        <form id="journeyForm" method="post" action="../controller/DashboardSubmit.php">

    <label>From</label>
  <select name="from" id="from">
     
   <option value="">Select From Station</option>
    <option value="Uttara North" <?= ($from=="Uttara North")?'selected':'' ?>>Uttara North</option>
    <option value="Agargaon" <?= ($from=="Agargaon")?'selected':'' ?>>Agargaon</option>
    <option value="Motijheel" <?= ($from=="Motijheel")?'selected':'' ?>>Motijheel</option>
</select>


    <label>To</label>
   <select name="to" id="to">
    <option value="">Select To Station</option>
 <option value="Uttara Center" <?= ($to=="Uttara Center")?'selected':'' ?>>Uttara Center</option>
    <option value="Uttara South" <?= ($to=="Uttara South")?'selected':'' ?>>Uttara South</option>
    <option value="Pallabi" <?= ($to=="Pallabi")?'selected':'' ?>>Pallabi</option>
    <option value="Mirpur-11" <?= ($to=="Mirpur-11")?'selected':'' ?>>Mirpur-11</option>
    <option value="Mirpur-10" <?= ($to=="Mirpur-10")?'selected':'' ?>>Mirpur-10</option>
    <option value="Kazipara" <?= ($to=="Kazipara")?'selected':'' ?>>Kazipara</option>
    <option value="Shewrapara" <?= ($to=="Shewrapara")?'selected':'' ?>>Shewrapara</option>
    <option value="Agargaon" <?= ($to=="Agargaon")?'selected':'' ?>>Agargaon</option>
    <option value="Bijoy Sarani" <?= ($to=="Bijoy Sarani")?'selected':'' ?>>Bijoy Sarani</option>
    <option value="Farmgate" <?= ($to=="Farmgate")?'selected':'' ?>>Farmgate</option>
    <option value="Karwan Bazar" <?= ($to=="Karwan Bazar")?'selected':'' ?>>Karwan Bazar</option>
    <option value="Shahbagh" <?= ($to=="Shahbagh")?'selected':'' ?>>Shahbagh</option>
    <option value="Dhaka University" <?= ($to=="Dhaka University")?'selected':'' ?>>Dhaka University</option>
    <option value="Secretariat" <?= ($to=="Secretariat")?'selected':'' ?>>Secretariat</option>
    <option value="Motijheel" <?= ($to=="Motijheel")?'selected':'' ?>>Motijheel</option>
    <option value="Kamalapur" <?= ($to=="Kamalapur")?'selected':'' ?>>Kamalapur</option>

    <!-- Agargaon Destinations -->
    <option value="Uttara North" <?= ($to=="Uttara North")?'selected':'' ?>>Uttara North</option>
    <option value="Mirpur-10" <?= ($to=="Mirpur-10")?'selected':'' ?>>Mirpur-10</option>
    <option value="Farmgate" <?= ($to=="Farmgate")?'selected':'' ?>>Farmgate</option>
    <option value="Motijheel" <?= ($to=="Motijheel")?'selected':'' ?>>Motijheel</option>
    <option value="Kamalapur" <?= ($to=="Kamalapur")?'selected':'' ?>>Kamalapur</option>

    <!-- Motijheel Destinations -->
    <option value="Uttara North" <?= ($to=="Uttara North")?'selected':'' ?>>Uttara North</option>
    <option value="Pallabi" <?= ($to=="Pallabi")?'selected':'' ?>>Pallabi</option>
    <option value="Agargaon" <?= ($to=="Agargaon")?'selected':'' ?>>Agargaon</option>
    <option value="Farmgate" <?= ($to=="Farmgate")?'selected':'' ?>>Farmgate</option>
</select>


    <label>Date of Journey</label>
   <input type="date" name="journey_date" id="journey_date" value="<?= htmlspecialchars($date) ?>">


   <button type="submit">Submit</button>
</form>
 
    </div>

    
    <div class="image-side">
        <img src="dashboard1.jpg" alt="Metro Train">
    </div>

</div>
<?php include "footer.php"; ?>
<script src="dashboard.js"></script>
</body>
</html>
