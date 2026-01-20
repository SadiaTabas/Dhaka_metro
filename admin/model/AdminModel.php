<?php
include "Database.php";

// System Overview Counts 
function getTotalStaff() {
    global $conn;
    $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE RoleID = 2");
    return mysqli_fetch_assoc($res)['total'];
}

function getTotalRoutes() {
    global $conn;
    $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM routes");
    return mysqli_fetch_assoc($res)['total'];
}

function getTotalPassengers() {
    global $conn;
    $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE RoleID = 3");
    return mysqli_fetch_assoc($res)['total'];
}


function getAllRoutes() {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM routes ORDER BY RouteID ASC");
}

function deleteRoute($routeId) {
    global $conn;
    $sql = "DELETE FROM routes WHERE RouteID = $routeId";
    mysqli_query($conn, $sql);
}

function addRoute($from, $to, $fare) {
    global $conn;
    $sql = "INSERT INTO routes (FromStation, ToStation, Fare)
            VALUES ('$from', '$to', $fare)";
    mysqli_query($conn, $sql);
}


function getAllStaff() {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM users WHERE RoleID = 2 ORDER BY Mobile ASC");
}

function deleteStaff($mobile) {
    global $conn;
    $sql = "DELETE FROM users WHERE Mobile = '$mobile' AND RoleID = 2";
    mysqli_query($conn, $sql);
}


function addStaff($firstName, $lastName, $mobile, $password, $roleId) {
    global $conn;

    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users
            (RoleID, FirstName, LastName, Mobile, Password)
            VALUES
            ($roleId, '$firstName', '$lastName', '$mobile', '$hashedPass')";

    mysqli_query($conn, $sql);
}
?>
