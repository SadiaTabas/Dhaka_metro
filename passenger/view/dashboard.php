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
         <option value="">Select From Station</option>
    <option value="Uttara North" <?= ($from=="Uttara North")?'selected':'' ?>>Uttara North</option>
    <option value="Agargaon" <?= ($from=="Agargaon")?'selected':'' ?>>Agargaon</option>
    <option value="Motijheel" <?= ($from=="Motijheel")?'selected':'' ?>>Motijheel</option>
    </select>

    <label>To</label>
    <select name="to" id="to">
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

    
    <option value="Uttara North" <?= ($to=="Uttara North")?'selected':'' ?>>Uttara North</option>
    <option value="Mirpur-10" <?= ($to=="Mirpur-10")?'selected':'' ?>>Mirpur-10</option>
    <option value="Farmgate" <?= ($to=="Farmgate")?'selected':'' ?>>Farmgate</option>
    <option value="Motijheel" <?= ($to=="Motijheel")?'selected':'' ?>>Motijheel</option>
    <option value="Kamalapur" <?= ($to=="Kamalapur")?'selected':'' ?>>Kamalapur</option>

    
    <option value="Uttara North" <?= ($to=="Uttara North")?'selected':'' ?>>Uttara North</option>
    <option value="Pallabi" <?= ($to=="Pallabi")?'selected':'' ?>>Pallabi</option>
    <option value="Agargaon" <?= ($to=="Agargaon")?'selected':'' ?>>Agargaon</option>
    <option value="Farmgate" <?= ($to=="Farmgate")?'selected':'' ?>>Farmgate</option>
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
