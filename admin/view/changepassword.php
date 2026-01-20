<?php
session_start();

include "adminheader.php";
if (isset($_SESSION['userid'])) {
    $_SESSION['Mobile'] = $_SESSION['userid'];
}

if (!isset($_SESSION['Mobile'])) {
    die("Unauthorized access");
}

$mobile = trim($_SESSION['Mobile']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="changepassword.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="box">
<form name="changePasswordForm"
      method="post"
      action="../controller/ChangePasswordController.php"
      onsubmit="return validateForm()">

    <fieldset>
        <legend>Change Password</legend>

        <?php
        if (isset($_GET['msg'])) {
            switch ($_GET['msg']) {
                case 'wrong':
                    echo "<p class='error'>Current password is incorrect</p>";
                    break;
                case 'nomatch':
                    echo "<p class='error'>Passwords do not match</p>";
                    break;
                case 'success':
                    echo "<p class='success'>Password updated successfully</p>";
                    break;
                case 'empty':
                    echo "<p class='error'>All fields are required</p>";
                    break;
                case 'usernotfound':
                    echo "<p class='error'>User not found</p>";
                    break;
                case 'error':
                    echo "<p class='error'>Something went wrong</p>";
                    break;
            }
        }
        ?>

        <table>
            <tr>
                <td>Current Password</td>
                <td><input type="password" name="current_password"></td>
            </tr>

            <tr>
                <td>New Password</td>
                <td><input type="password" name="new_password"></td>
            </tr>

            <tr>
                <td>Confirm Password</td>
                <td><input type="password" name="confirm_password"></td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Save">
                    <button type="button" onclick="window.location.href='dashboard.php'">Cancel</button>
                </td>
            </tr>
        </table>
    </fieldset>
</form>
</div>

<script src="changepassword.js"></script>
<?php include "footer.php"; ?>
</body>
</html>
