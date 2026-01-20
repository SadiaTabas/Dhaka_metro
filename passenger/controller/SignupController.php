<?php
include "../model/UserModel.php";

$fullname = trim($_POST['fullname']);
$mobile   = trim($_POST['mobile']);
$nid      = trim($_POST['nid']);
$dob      = $_POST['dob'];
$gender   = $_POST['gender'];
$password = $_POST['password'];
$confirm  = $_POST['confirm_password'];

 
if (
    empty($fullname) || empty($mobile) || empty($nid) ||
    empty($dob) || empty($gender) ||
    empty($password) || empty($confirm)
) {
    die("All fields are required");
}

if (!is_numeric($mobile) || strlen($mobile) != 11) {
    die("Mobile must be 11 digits");
}

if (!is_numeric($nid) || strlen($nid) != 13) {
    die("NID must be 13 digits");
}

if ($password !== $confirm) {
    die("Passwords do not match");
}

 
$name = explode(" ", $fullname, 2);
$firstName = $name[0];
$lastName  = $name[1] ?? "";

 
$result = createUser(
    $firstName,
    $lastName,
    $mobile,
    $nid,
    $dob,
    $gender,
    $password
);

if ($result) {
    header("Location: /employee/View/php/login.php");
    exit();
} else {
    echo "Signup failed";
}

?>
