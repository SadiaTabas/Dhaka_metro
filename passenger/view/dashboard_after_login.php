<?php
session_start();
include "../model/Database.php";

 
if (!isset($_SESSION['UserID'])) {
    header("/employee/View/php/login.php");
    exit();
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
        <option value="Uttara North">Uttara North</option>
        <option value="Uttara Center">Uttara Center</option>
        <option value="Uttara South">Uttara South</option>
        <option value="Pallabi">Pallabi</option>
        <option value="Mirpur 10">Mirpur 10</option>
        <option value="Kazipara">Kazipara</option>
        <option value="Farmgate">Farmgate</option>
        <option value="Karwan Bazar">Karwan Bazar</option>
        <option value="Shahbagh">Shahbagh</option>
        <option value="Motijheel">Motijheel</option>
    </select>

    <label>To</label>
    <select name="to" id="to">
        <option value="">Select To Station</option>
        <option value="Uttara North">Uttara North</option>
        <option value="Uttara Center">Uttara Center</option>
        <option value="Uttara South">Uttara South</option>
        <option value="Pallabi">Pallabi</option>
        <option value="Mirpur 10">Mirpur 10</option>
        <option value="Kazipara">Kazipara</option>
        <option value="Farmgate">Farmgate</option>
        <option value="Karwan Bazar">Karwan Bazar</option>
        <option value="Shahbagh">Shahbagh</option>
        <option value="Motijheel">Motijheel</option>
    </select>

    <label>Date of Journey</label>
    <input type="date" name="journey_date" id="journey_date">

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
