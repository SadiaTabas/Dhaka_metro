<?php
session_start();
include "../model/PaymentModel.php";

$userID = $_SESSION['UserID'] ?? 0;

$balance = getWalletBalance($userID);

echo json_encode(array("balance" => $balance));
?>
