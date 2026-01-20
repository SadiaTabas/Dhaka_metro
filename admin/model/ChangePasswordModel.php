    
<?php
require_once __DIR__ . '/Database.php';

function getPasswordByMobile($mobile) {
    global $conn;
    $safeMobile = mysqli_real_escape_string($conn, $mobile);
    $sql = "SELECT Password FROM users WHERE Mobile = '$safeMobile'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function updatePasswordByMobile($mobile, $newPassword) {
    global $conn;
    $safeMobile = mysqli_real_escape_string($conn, $mobile);
    $safePass   = mysqli_real_escape_string($conn, $newPassword);

    $sql = "UPDATE users SET Password = '$safePass' WHERE Mobile = '$safeMobile'";
    return mysqli_query($conn, $sql);
}
?>
