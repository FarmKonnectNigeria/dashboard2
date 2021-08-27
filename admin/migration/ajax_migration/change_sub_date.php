<?php session_start();
     require_once('../../../classes/db_class.php');
    require_once('../../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $sub_date = date($_POST['sub_date']);
    $user_name = $_POST['user_name'];
    $package_name = $_POST['package_name'];
    $uid = $_SESSION['adminid'];
    if(empty($sub_date)){
        echo 400;
    }else{
        $object = new DbQueries();
        $change_sub_date = $object->update_with_one_param('subscribed_packages','unique_id',$unique_id, 'date_created',$sub_date);
        $change_sub_date_decode = json_decode($change_sub_date, true);
        if($change_sub_date_decode['status'] == 0){
        	echo 500;
        }else{
        	echo 200;
            $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
            $fullname = $get_fullname['surname'].' '.$get_fullname['other_names']; 
            $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Change Subscription Date of ".$user_name." for ".$package_name);
        }
}
?>