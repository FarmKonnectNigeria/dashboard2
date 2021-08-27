<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    require_once('../../classes/algorithm_functions.php');
    $unique_id = $_POST['unique_id'];
    $BE_id = $_POST['BE_id'];
    $commission = $_POST['commission'];
    $object = new DbQueries();
    $get_be_email = $object-> get_one_row_from_one_table('admin_tbl','unique_id',$BE_id);
    $email = $get_be_email['email'];
    $subject = "Commission Claim - FarmKonnect";
    $content = "Your commission claim has been approved, please kindly wait for payment from the Cash Officer
    Thanks, Regards.
    ";
    $notification_type = 'alert';
    $notification_heading = 'Commission Claim';
    $notification = 'Hello, Your Commission Claim has been approved';
    $notification1 = "Hello, Business Executive ".$get_be_email['surname'].' '.$get_be_email['other_names']."'s Commission Claim of ".number_format($commission). " has been approved by the accountant";
    $approve_commission_claim = $object->approve_commission_claim($BE_id, $commission, $unique_id);
    $approve_commission_claim_decode = json_decode($approve_commission_claim, true);
    if($approve_commission_claim_decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved Commission Claim');
        $object->email_function($email, $subject, $content);
        insert_into_admin_notifications_tbl($notification_type, $BE_id, $notification_heading, $notification);
        $get_CO = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Cash Officer');
        $get_CO_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_CO['unique_id']);
        foreach ($get_CO_id as $value) {
            insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification1);
        }
    }
?>