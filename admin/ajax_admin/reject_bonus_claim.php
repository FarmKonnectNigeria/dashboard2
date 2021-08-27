<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    require_once('../../classes/algorithm_functions.php');
    $unique_id = $_POST['unique_id'];
    $BE_id = $_POST['BE_id'];
    $object = new DbQueries();
    $table = 'target_bonus_commission';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'bonus_status';
    $new_value = 3;
    $get_be_email = $object-> get_one_row_from_one_table('admin_tbl','unique_id',$BE_id);
    $email = $get_be_email['email'];
    $subject = "Bonus Claim - FarmKonnect";
    $content = "Your bonus claim has been rejected, please contact the Account Office for more details
    Thanks, Regards.
    ";
    $notification_type = 'alert';
    $notification_heading = 'Bonus Claim';
    $notification = 'Your bonus claim was rejected';
    $reject_bonus_claim = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $update_bonus = $object->update_with_one_param('target_bonus_commission','unique_id',$unique_id, 'bonus', 0);
    $reject_bonus_claim_decode = json_decode($reject_bonus_claim, true);
    if($reject_bonus_claim_decode['status'] == 0){
        echo "error";
    }else{
        echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Rejected Bonus Claim');
        $object->email_function($email, $subject, $content);
        insert_into_admin_notifications_tbl($notification_type, $BE_id, $notification_heading, $notification);
    }
?>