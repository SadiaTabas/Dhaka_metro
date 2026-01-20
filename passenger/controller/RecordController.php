<?php
include "../model/RecordModel.php";

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    // PHP validation
    if (!is_numeric($id)) {
        die("Invalid request");
    }

    deletePayment($id);

    header("Location: ../view/payment_record_page.php?type=payments");
    exit();
}
