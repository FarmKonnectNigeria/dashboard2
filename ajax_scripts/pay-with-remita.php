<?php
include('../includes/instantiated_files2.php');


$user_id = $_POST['user_id'];
$txn_id = $_POST['txn_id'];
$txn_ref = $_POST['txn_ref'];
$amount = $_POST['amount'];
$status = $_POST['status'];


$log_payment = $object->remita_payment($user_id, $txn_id, $txn_ref, $amount, $status);

exit($log_payment);