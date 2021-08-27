<?php
    require_once('../classes/db_class.php');
    require_once('../includes/config.php');

    $unique_id = $_POST['unique_id'];
    $table = 'users_tbl';
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $object = new DbQueries;
    $reset_password = $object->reset_password($table, $unique_id, $password, $confirm_password);
    $reset_decode = json_decode($reset_password, true);
    echo $reset_decode['msg'];
    if($reset_decode['msg'] == 'success'){
        //$object->insert_users_logs($_SESSION['uid'], 'Reset Password');
    }
?>