 <?php
session_start();
include "../model/Database.php";

 
$redirectPage = isset($_SESSION['UserID'])
    ? "../view/dashboard_after_login.php"
    : "../view/dashboard.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $from = trim($_POST['from'] ?? '');
    $to   = trim($_POST['to'] ?? '');
    $date = trim($_POST['journey_date'] ?? '');

    if ($from === "" || $to === "" || $date === "") {
        $_SESSION['error'] = "All fields are required!";
        header("Location: $redirectPage");
        exit();
    }

    if ($from === $to) {
        $_SESSION['error'] = "From and To station cannot be the same!";
        header("Location: $redirectPage");
        exit();
    }

    $sql = "SELECT RouteID FROM routes WHERE FromStation = ? AND ToStation = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $from, $to);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['error'] = "No route found for selected stations!";
        header("Location: $redirectPage");
        exit();
    }

    $route = $result->fetch_assoc();
    $routeID = $route['RouteID'];

     
    header("Location: ../view/payment.php?route_id=$routeID&journey_date=$date");
    exit();

} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location: $redirectPage");
    exit();
}
