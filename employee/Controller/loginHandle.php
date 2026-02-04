 <?php
session_start();
require_once('../Model/db.php');

 
$mobile   = trim($_POST['userid'] ?? '');
$password = trim($_POST['password'] ?? '');

$userIdError = $passwordError = "";

 
if (empty($mobile)) {
    $userIdError = "Mobile number is required.";
} elseif (!preg_match('/^01[3-9]\d{8}$/', $mobile)) {
    $userIdError = "Invalid mobile number.";
}

 
if (empty($password)) {
    $passwordError = "Password is required.";
}

 
if ($userIdError || $passwordError) {
    $_SESSION['userIdError'] = $userIdError;
    $_SESSION['passwordError'] = $passwordError;
    $_SESSION['userIdValue'] = $mobile;
    header("Location: ../View/php/login.php");
    exit();
}

 
$stmt = $conn->prepare("
    SELECT UserID, RoleID, Mobile, Password, Status
    FROM users
    WHERE Mobile = ?
");

$stmt->bind_param("s", $mobile);
$stmt->execute();
$stmt->store_result();

 
if ($stmt->num_rows !== 1) {
    $_SESSION['userIdError'] = "Mobile number not found.";
    header("Location: ../View/php/login.php");
    exit();
}

$stmt->bind_result($userID, $roleID, $dbMobile, $dbPassword, $status);
$stmt->fetch();

 
if ($status === 'Blocked') {
    $_SESSION['userIdError'] = "Your account is blocked.";
    header("Location: ../View/php/login.php");
    exit();
}

 
if ($password !== $dbPassword) {
    $_SESSION['passwordError'] = "Password does not match.";
    $_SESSION['userIdValue'] = $mobile;
    header("Location: ../View/php/login.php");
    exit();
}

 
$_SESSION['logged_in'] = true;
$_SESSION['UserID'] = $userID;
$_SESSION['Mobile'] = $dbMobile;
$_SESSION['RoleID'] = $roleID;

 
if ($roleID == 1) {
    header("Location: /admin/view/admindashboard.php");
} elseif ($roleID == 3) {
      header("Location: /passenger/view/dashboard_after_login.php");
} elseif ($roleID == 2) {
    header("Location: ../View/php/employeDashboard.php");
} else {
    header("Location: ../View/php/login.php");
}

exit();

$stmt->close();
$conn->close();
