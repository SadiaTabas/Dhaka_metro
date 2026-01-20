<?php
session_start();
include "../model/JourneyModel.php";

if (!isset($_SESSION['UserID'])) {
    die("Unauthorized access");
}

$userId = $_SESSION['UserID'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!isset($_POST['ticket_id'])) {
        die("No record selected");
    }

    $ticketIds = $_POST['ticket_id'];

    foreach ($ticketIds as $id) {
        deleteJourney((int)$id, $userId);
    }

    header("Location: ../view/journey_history.php?msg=deleted");
}
?>