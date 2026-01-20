<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $from = trim($_POST['from']);
    $to = trim($_POST['to']);
    $date = trim($_POST['journey_date']);

    if ($from == "" || $to == "" || $date == "") {
        $_SESSION['error'] = "All fields are required!";
        header("Location: ../view/dashboard.php");
        exit();
    }

    if ($from === $to) {
        $_SESSION['error'] = "From and To station cannot be the same!";
        header("Location: ../view/dashboard.php");
        exit();
    }

    header("Location:/employee/View/php/login.php");
    exit();

} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location: ../view/dashboard.php");
    exit();
}
?>
