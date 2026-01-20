<?php
include "Database.php";

function createUser($firstName, $lastName, $mobile, $nid, $dob, $gender, $password) {
    global $conn;

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users
            (RoleID, FirstName, LastName, Mobile, NID, DateOfBirth, Gender, Password)
            VALUES
            (3, '$firstName', '$lastName', '$mobile', '$nid', '$dob', '$gender', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "MySQL Error: " . mysqli_error($conn);
        return false;
    }
}
?>
