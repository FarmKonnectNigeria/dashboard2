<?php
 include('../includes/instantiated_files.php');
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    $get_my_leads = $object->get_rows_from_one_table_by_id('leads_tbl','created_by',$uid);
    foreach($get_my_leads as $leads){
    		$leads_email = $leads['email'].'<br>';
    		$send_msgs_to_leads = $object->send_lead_msg($leads_email,$subject, $message,$email, $fullname_user);
           $send_msgs_to_leads_decode = json_decode($send_msgs_to_leads, true);
           echo $send_msgs_to_leads_decode['msg'];

    }
    //$send_msgs_to_leads = $object->send_msgs_to_leads($first_name, $surname, $phone,$email,'created_by');
    //$send_msgs_to_leads_decode = json_decode($create_lead, true);
	//if($add_slot_decode == '0'){
    //echo $_POST['generic'];
   // echo 'testset';
    //echo $send_msgs_to_leads_decode['msg'];
	// 	echo "error";
	// }else{
	// 	echo "success";
	// }

?>