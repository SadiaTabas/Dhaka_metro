<?php
session_start();
include "../model/Profile_Information.php";

if (!isset($_SESSION['UserID'], $_SESSION['RoleID'])) {
    header("Location: ../view/php/login.php");
    exit();
}

$userId = $_SESSION['UserID'];
$roleID = $_SESSION['RoleID'];

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $fullName = trim($_POST['full_name'] ?? '');
    $dob      = $_POST['dob'] ?? '';
    $gender   = $_POST['gender'] ?? '';

    if ($fullName === '') {
        header("Location: ../view/Profile_Information.php?msg=empty");
        exit();
    }

 
    $parts = explode(" ", $fullName);
    $firstName = $parts[0];
    $lastName = isset($parts[1]) ? $parts[1] : '';

    $updateResult = updateUserProfile($userId, $firstName, $lastName, $dob, $gender);

    if ($updateResult) {
        // ROLE WISE REDIRECT
        if ($roleID == 1) {
            header("Location: /admin/view/admindashboard.php");
        } elseif ($roleID == 3) {
            header("Location: /passenger/view/dashboard.php");
        } elseif ($roleID == 2) {
            header("Location: ../employee/View/php/employeDashboard.php");
        } else {
            header("Location: ../view/php/login.php");
        }
        exit();
    } else {
        header("Location: ../view/Profile_Information.php?msg=error");
        exit();
    }
}
?>
