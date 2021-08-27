<?php 
   include('../includes/instantiated_files.php');
    $bank_name = $_POST['bank_name'];
    $description = $_POST['description'];
    $account_number = $_POST['account_number'];
    $account_name = $_POST['account_name'];
    $account_type = $_POST['account_type'];
    $unique_id = $_POST['unique_id'];
    $update_bank_account =  $object->update_bank_account($unique_id, $bank_name, $description, $account_number, $account_name, $account_type);
    $update_decode = json_decode($update_bank_account,true);
    if($update_decode['status'] === '0'){
        echo $update_decode['msg'];
    }else{ 
        echo "success"; 
        $object->insert_logs($_SESSION['adminid'], 'Updated bank account details');  
    }

    
?>