<?php
include "Database.php";

function getUserProfile($userId) {
    global $conn;

    $sql = "SELECT 
                UserID,
                FirstName,
                LastName,
                NID,
                DateOfBirth,
                Gender,
                Mobile
            FROM users
            WHERE UserID = $userId";

    return mysqli_query($conn, $sql);
}

function updateUserProfile($userId, $firstName, $lastName, $dob, $gender) {
    global $conn;

    $userId    = (int)$userId;
    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName  = mysqli_real_escape_string($conn, $lastName);
    $dob       = mysqli_real_escape_string($conn, $dob);
    $gender    = mysqli_real_escape_string($conn, $gender);

    $sql = "UPDATE users SET
                FirstName = '$firstName',
                LastName = '$lastName',
                DateOfBirth = '$dob',
                Gender = '$gender'
            WHERE UserID = $userId";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error updating profile: " . mysqli_error($conn));
    }

    return $result;
}

?>