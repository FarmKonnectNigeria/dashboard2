<?php
session_start();
include('includes/instantiated_files2.php');
$object->insert_logs($uid, 'Logged out');
unset($_SESSION['adminid']);
unset($_SESSION['login_status']);
header('Location:login');
?>