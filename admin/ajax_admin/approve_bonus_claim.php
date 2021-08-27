<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    require_once('../../classes/algorithm_functions.php');
    $unique_id = $_POST['unique_id'];
    $BE_id = $_POST['BE_id'];
    $bonus = $_POST['bonus'];
    $object = new DbQueries();
    $get_be_email = $object-> get_one_row_from_one_table('admin_tbl','unique_id', $BE_id);
    $email = $get_be_email['email'];
    $subject = "Bonus Claim - FarmKonnect";
    $content = "Your bonus claim has been approved, please kindly wait for payment from the Cash Officer
    Thanks, Regards.
    ";
    $notification_type = 'alert';
    $notification_heading = 'Bonus Claim';
    $notification = 'Hello, Your Bonus Claim has been approved';
    $notification1 = "Hello, Business Executive ".$get_be_email['surname'].' '.$get_be_email['other_names']."'s Bonus Claim of ".number_format($bonus). " has been approved by the accountant";
    $approve_bonus_claim = $object->approve_bonus_claim($BE_id, $bonus, $unique_id);
    $approve_bonus_claim_decode = json_decode($approve_bonus_claim, true);
    if($approve_bonus_claim_decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Approved Bonus Claim');
        $object->email_function($email, $subject, $content);
        insert_into_admin_notifications_tbl($notification_type, $BE_id, $notification_heading, $notification);
        $get_CO = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Cash Officer');
        $get_CO_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_CO['unique_id']);
        foreach ($get_CO_id as $value) {
            insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification1);
        }
    }
?>