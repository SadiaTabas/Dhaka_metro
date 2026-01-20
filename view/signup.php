<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>

<h1 class="main-heading"><img src="signuplogo.png" class="logo">
    Dhaka Metro </h1>

<div class="signup-box">
    <h2>Create Account</h2>

    <form method="post"
          action="../controller/SignupController.php"
          onsubmit="return validateForm();">

        <input type="text" name="fullname" placeholder="Full Name">
        <input type="text" name="mobile" placeholder="Mobile Number">
        <input type="text" name="nid" placeholder="NID Number">

        <input type="date" name="dob">

        <select name="gender">
            <option value="">Select Gender</option>
            <option>Male</option>
            <option>Female</option>
           
        </select>

        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">

        <button type="submit">Sign Up</button>
    </form>
<div class="login-link">
    Already Registered? <a href="/employee/View/php/login.php">Login</a>
</div>

</div>
 
<?php include "footer.php"; ?>
</body>
 
</html>
