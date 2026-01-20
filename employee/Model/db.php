<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";      // your DB password
$dbname = "mydb";    // your DB name

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
