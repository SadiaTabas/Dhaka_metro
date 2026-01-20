<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dhaka Metro</title>
    <link rel="stylesheet" href="dashboard.css">
     
</head>
<body>

 <?php include "dashboardbeforeheader.php"; ?>
 
 
 
<div class="dashboard-box">
 
 
    <div class="form-side">
        <h2>Book Your Journey</h2>

        <form method="post" action="../controller/SaveJourneyTemp.php">


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
