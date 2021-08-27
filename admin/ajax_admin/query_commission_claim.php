<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $unique_id = $_POST['unique_id'];
    $BE_id = $_POST['BE_id'];
    $object = new DbQueries();
    $table = 'be_sales';
    $param = 'unique_id';
    $value = $unique_id;
    $new_value_param = 'commission_status';
    $new_value = 4;
    $get_be_email = $object-> get_one_row_from_one_table('admin_tbl','unique_id',$BE_id);
    $email = $get_be_email['email'];
    $subject = "Commission Claim - FarmKonnect";
    $content = "Your commission claim has been queried, please contact the Account Office for more details
    Thanks, Regards.
    ";
    $query_bonus_claim = $object->update_with_one_param($table,$param,$value,$new_value_param,$new_value);
    $query_bonus_claim_decode = json_decode($query_bonus_claim, true);
    if($query_bonus_claim_decode['status'] == 0){
    	echo "error";
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Queried Commission Claim');
        $object->email_function($email, $subject, $content);
    }
?>