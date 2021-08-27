<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
 $admin_id = $_POST['admin_id'];
 $unique_id = $_POST['unique_id'];
 $amount = $_POST['amount'];
  $notification_type = 'alert';
$notification_heading = 'Cash Request';
$notification = 'Hello, your cash request of '.number_format($amount).' has been approved and your wallet has been credited with the amount';
 $allocate_cash = allocate_cash($admin_id, $amount, $unique_id);
    $allocate_cash_decode = json_decode($allocate_cash, true);
    if($allocate_cash_decode['status'] == 0){
    	echo $allocate_cash_decode['msg'];
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Allocated cash to Accountant');
        $get_accountant = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Accountant');
        $get_accountant_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_accountant['unique_id']);
        foreach ($get_accountant_id as $value) {
            insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification);
        }
    }
?>