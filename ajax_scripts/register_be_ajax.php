<?php
 require_once('../classes/db_class.php');
    require_once('../includes/config.php');
    $other_names = $_POST['other_names'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $role_id = $_POST['role_id'];
    $def = $_POST['def'];
    $referral = $_POST['referral'];
    //print_r($_POST);
    $object = new DbQueries();
    
    $register_be = $object->add_admin_to_role($other_names, $surname, $username, $password, $confirm_password, $phone , $email, $role_id, $address, $gender, $def);
    $register_be_decode = json_decode($register_be, true);
    if($register_be_decode['status'] == 0){
    echo $register_be_decode['msg'];
    }else{
        $update_be_table = $object->update_with_one_param('business_executive_tbl', 'unique_id', $def,'assigned_to',$referral);
        $insert_target = $object->insert_be_target($referral, $def);
        $update_be_table_decode = json_decode($update_be_table, true);
        $insert_target_decode = json_decode($insert_target, true);
        if($update_be_table_decode['status'] == 1 AND $insert_target_decode['status'] == 1){
            echo "success";
        }
        else{
            echo "error";
        }
    }
 ?>