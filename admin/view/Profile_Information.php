<?php
session_start();

if (!isset($_SESSION['UserID'], $_SESSION['RoleID'])) {
    header("Location: /employee/View/php/login.php");
    exit();
}

include "../model/Profile_Information.php";


$userId = $_SESSION['UserID'];
$roleID = $_SESSION['RoleID'];
if ($roleID == 1) {
    include "adminheader.php";
} elseif ($roleID == 2) {
    include "employeeheader.php";
} elseif ($roleID == 3) {
    include "userheader.php";
} else {
    header("Location:  /employee/View/php/login.php");
    exit();
}

$result  = getUserProfile($userId);
$profile = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Information</title>
    <link rel="stylesheet" href="Profile_Information.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="pro-box">
    <form method="post"
      action="../controller/Profile_Information_Controller.php"
      onsubmit="return validateForm()">


        <fieldset>
            <legend>Profile Information</legend>

            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'updated') { ?>
                <p style="color: green;">Profile updated successfully</p>
            <?php } ?>

            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'empty') { ?>
                <p style="color: red;">First name is required</p>
            <?php } ?>

            <table>
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name"
       value="<?php echo htmlspecialchars($profile['FirstName'].' '.$profile['LastName']); ?>">

                    </td>
                </tr>

                <tr>
                    <td>NID:</td>
                    <td>
                        <input type="text" value="<?php echo $profile['NID']; ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td>Date of Birth:</td>
                    <td>
                        <input type="date" name="dob"
                               value="<?php echo $profile['DateOfBirth']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Gender:</td>
                    <td>
                        <select name="gender">
                            <option value="Male"   <?php if ($profile['Gender']=="Male") echo "selected"; ?>>Male</option>
                            <option value="Female" <?php if ($profile['Gender']=="Female") echo "selected"; ?>>Female</option>
                            <option value="Other"  <?php if ($profile['Gender']=="Other") echo "selected"; ?>>Other</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Phone:</td>
                    <td>
                        <input type="text" value="<?php echo $profile['Mobile']; ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Update">

                        <button type="button"
                                onclick="window.location.href='changepassword.php'">
                            Change Password
                        </button>
                    </td>
                </tr>
            </table>

        </fieldset>
    </form>
</div>

<?php include "footer.php"; ?>
<script src="Profile_Information.js"></script>
</body>
</html>
