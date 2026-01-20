<?php
session_start();


// Check if user is logged in AND is an Admin (RoleID 1)
if (!isset($_SESSION['UserID']) || $_SESSION['RoleID'] != 1) {
    // If not admin, redirect to login immediately
    header("Location: login.php");
    exit();
}


include "../model/AdminModel.php";

// FETCH DATA 
$totalStaff = getTotalStaff();
$totalRoutes = getTotalRoutes();
$totalPassengers = getTotalPassengers();

$routes = getAllRoutes();
$staff  = getAllStaff();

include "adminheader.php"; 
?>

<link rel="stylesheet" href="admindashboard.css">
<link rel="stylesheet" href="dashboard.css">

<div class="admindashboard">
    <section class="section">
        <h2>System Overview</h2>
        <div class="overview">
            <div class="card">
                <h3>Total Staff Members</h3>
                <p><?= $totalStaff ?></p>
            </div>
            <div class="card">
                <h3>Total Routes</h3>
                <p><?= $totalRoutes ?></p>
            </div>
            <div class="card">
                <h3>Total Passengers</h3>
                <p><?= $totalPassengers ?></p>
            </div>
        </div>
    </section>

    <section class="section">
        <h2>Fare Management</h2>
        <table>
            <thead>
                <tr>
                    <th>Route ID</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Fare</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($r = mysqli_fetch_assoc($routes)) { ?>
                <tr>
                    <td><?= $r['RouteID'] ?></td>
                    <td><?= $r['FromStation'] ?></td>
                    <td><?= $r['ToStation'] ?></td>
                    <td><?= number_format($r['Fare'], 2) ?></td>
                    <td>
                        <form method="post" action="../controller/admincontroller.php">
                            <input type="hidden" name="delete_route_id" value="<?= $r['RouteID'] ?>">
                            <button type="submit" class="btn-delete" onclick="return confirm('Delete this route?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <h3>Add New Route</h3>
        <form id="addRouteForm" method="post" action="../controller/admincontroller.php">
            <input type="text" name="from_station" placeholder="From Station">
            <input type="text" name="to_station" placeholder="To Station">
            <input type="number" name="fare" placeholder="Fare" step="10">
            <button type="submit" name="add_route" class="btn-add">Add Route</button>
        </form>
    </section>

    <section class="section">
        <h2>Staff Management</h2>
        <table>
            <thead>
                <tr>
                    <th>Mobile</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($s = mysqli_fetch_assoc($staff)) { ?>
                <tr>
                    <td><?= $s['Mobile'] ?></td>
                    <td><?= $s['FirstName'] . " " . $s['LastName'] ?></td>
                    <td>
                        <form method="post" action="../controller/admincontroller.php">
                            <input type="hidden" name="delete_staff_mobile" value="<?= $s['Mobile'] ?>">
                            <button type="submit" class="btn-delete" onclick="return confirm('Delete staff?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <h3>Add New Staff</h3>
        <form id="addStaffForm" method="post" action="../controller/admincontroller.php">
            <input type="text" name="first_name" placeholder="First Name">
            <input type="text" name="last_name" placeholder="Last Name">
            <input type="text" name="mobile" placeholder="Mobile">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="add_staff" class="btn-add">Add Staff</button>
        </form>
    </section>
</div>

<script src="admindashboard.js"></script>
<?php include "footer.php"; ?>