<?php
session_start();
include "../model/AdminModel.php";

// Only admin
if (!isset($_SESSION['UserID']) || $_SESSION['RoleID'] != 1) {
    die("Unauthorized access");
}

// Handle POST 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Delete Route
    if (isset($_POST['delete_route_id'])) {
        $routeId = (int)$_POST['delete_route_id'];
        deleteRoute($routeId);

        // redirect to dashboard 
        header("Location: ../view/admindashboard.php?msg=route_deleted");
        exit;
    }

    // Delete Staff (groupmate-style)
    if (isset($_POST['delete_staff_mobile'])) {
        $mobile = $_POST['delete_staff_mobile'];
        deleteStaff($mobile);

        header("Location: ../view/admindashboard.php?msg=staff_deleted");
        exit;
    }

    // Add Route
    if (isset($_POST['add_route'])) {
        $from = $_POST['from_station'];
        $to = $_POST['to_station'];
        $fare = $_POST['fare'];
        addRoute($from, $to, $fare);

        header("Location: ../view/admindashboard.php?msg=route_added");
        exit;
    }

    // Add Staff
    if (isset($_POST['add_staff'])) {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        $roleId = 2; // staff role
        addStaff($firstName, $lastName, $mobile, $password, $roleId);

        header("Location: ../view/admindashboard.php?msg=staff_added");
        exit;
    }
}
?>
