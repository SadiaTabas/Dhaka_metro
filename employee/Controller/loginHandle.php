<?php
session_start();
require_once('../Model/db.php');

/* -------- Get Inputs -------- */
$mobile   = trim($_POST['userid'] ?? '');
$password = trim($_POST['password'] ?? '');

$userIdError = $passwordError = "";

/* -------- Mobile Validation -------- */
if (empty($mobile)) {
    $userIdError = "Mobile number is required.";
} elseif (!preg_match('/^01[3-9]\d{8}$/', $mobile)) {
    $userIdError = "Invalid mobile number.";
}

/* -------- Password Validation -------- */
if (empty($password)) {
    $passwordError = "Password is required.";
}

/* -------- Redirect Back If Error -------- */
if ($userIdError || $passwordError) {
    $_SESSION['userIdError'] = $userIdError;
    $_SESSION['passwordError'] = $passwordError;
    $_SESSION['userIdValue'] = $mobile;
    header("Location: ../View/php/login.php");
    exit();
}

/* -------- Database Query -------- */
$stmt = $conn->prepare("
    SELECT UserID, RoleID, Mobile, Password, Status
    FROM users
    WHERE Mobile = ?
");

$stmt->bind_param("s", $mobile);
$stmt->execute();
$stmt->store_result();

/* -------- Mobile Not Found -------- */
if ($stmt->num_rows !== 1) {
    $_SESSION['userIdError'] = "Mobile number not found.";
    header("Location: ../View/php/login.php");
    exit();
}

$stmt->bind_result($userID, $roleID, $dbMobile, $dbPassword, $status);
$stmt->fetch();

/* -------- Blocked Account Check -------- */
if ($status === 'Blocked') {
    $_SESSION['userIdError'] = "Your account is blocked.";
    header("Location: ../View/php/login.php");
    exit();
}

/* -------- Password Match (NO HASH) -------- */
if ($password !== $dbPassword) {
    $_SESSION['passwordError'] = "Password does not match.";
    $_SESSION['userIdValue'] = $mobile;
    header("Location: ../View/php/login.php");
    exit();
}

/* -------- Login Success -------- */
$_SESSION['logged_in'] = true;
$_SESSION['UserID'] = $userID;
$_SESSION['Mobile'] = $dbMobile;
$_SESSION['RoleID'] = $roleID;

/* -------- Role Based Redirect -------- */
if ($roleID == 1) {
    header("Location: /Dhaka_metro/admin/view/admindashboard.php");
} elseif ($roleID == 3) {
    header("Location: /Dhaka_metro/passenger/view/dashboard.php");
} elseif ($roleID == 2) {
    header("Location: ../View/php/employeDashboard.php");
} else {
    header("Location: ../View/php/login.php");
}

exit();

$stmt->close();
$conn->close();
