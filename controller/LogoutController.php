<?php
session_start();

$_SESSION = [];
session_destroy();

header("Location: /employee/View/php/login.php");
exit();
?>
