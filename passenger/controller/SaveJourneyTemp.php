<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $from = trim($_POST['from'] ?? '');
    $to   = trim($_POST['to'] ?? '');
    $date = trim($_POST['journey_date'] ?? '');

    if ($from === "" || $to === "" || $date === "") {
        $_SESSION['error'] = "All fields are required!";
        header("Location:passenger/view/dashboard.php");
        exit();
    }

    if ($from === $to) {
        $_SESSION['error'] = "From and To cannot be same!";
        header("Location:passenger/view/dashboard.php");
        exit();
    }

    // ✅ SAVE GUEST DATA
    $_SESSION['temp_journey'] = [
        'from' => $from,
        'to' => $to,
        'journey_date' => $date
    ];

    // Redirect to login
    header("Location: /employee/View/php/login.php");
    exit();
}
