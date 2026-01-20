<?php
session_start();

 
$_SESSION['from'] = $_POST['from'];
$_SESSION['to'] = $_POST['to'];
$_SESSION['journey_date'] = $_POST['journey_date'];

 
header("Location: /employee/View/php/login.php");
exit();
