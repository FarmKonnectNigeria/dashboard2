<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;

if(  !isset($_POST['uid'])  || !isset($_POST['amount']) || $_POST['amount'] == '' || $_POST['uid'] == '' || !isset($_POST['flutter_id']) || $_POST['flutter_id'] == '' ){
    
	echo json_encode(["status"=>"0", "msg"=>"empty_field"]);
}
else{
    
    $uid = $_POST['uid'];
	$amount = $_POST['amount'];
	$flutter_id = $_POST['flutter_id'];
    
    $submit_flutter_mobile = $object->submit_flutter_payment_mobile($uid,$flutter_id,$amount);
    echo $submit_flutter_mobile;
    

/////OOOOLD METHOD
// 	$payment_method = "flutter_rave";
// 	$deposit_date = date('Y-m-d H:i:s');
// 	$purpose = 11;
// 	$description = "Credited using flutterwave Rave";
// 	$get_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$uid);
// 	$email = $get_email['email'];
//     $subject = "Access Card Request - FarmKonnect";
//     $content = "Congratulations, you just credited your wallet with ".$amount.". Thanks for choosing FarmKonnect";
//     $notification_type = 'alert';
//     $notification_heading = 'Credit Wallet';
//     $notification = 'You just credited your wallet with N'.number_format($amount);
    
//     ///check if txn id exists
//     $check_txn_id = $object->check_row_exists_by_one_param('credit_wallet_tbl','txn_ref',$ref_id);
    
//     if($check_txn_id){
        
//         echo json_encode(["status"=>'0', "msg"=>"duplicate payment detected"]);
        
//     }else{
    
//             $insert_payment = $object->credit_wallet_online($uid,$amount,$payment_method,$deposit_date,$purpose, $description,$ref_id,$flutter_id);
//             $insert_payment_decode = json_decode($insert_payment, true);
//             echo json_encode(["status"=>'1', "msg"=>$insert_payment_decode['msg']]);
//             if($insert_request_decode['msg'] == 'success'){
//             $object->email_function($email, $subject, $content);
//             $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);
//             $object->insert_users_logs($uid, 'Credited Wallet using Flutterwave Rave');
//             }
        
//     }
    
    
    
    
}
?>