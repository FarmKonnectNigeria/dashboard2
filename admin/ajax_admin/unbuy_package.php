<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/db_class.php');
 $investment_id = $_POST['idd'];
 //echo $investment_id;
 // $total_amount = $_POST['total_amount'];
 // $no_of_slots_bought = $_POST['no_of_slots_bought'];
 // $user_id = $_POST['user_id'];
 // $package_id = $_POST['package_id'];
	 $get_investment_details = $object->get_one_row_from_one_table('subscribed_packages', 'unique_id', $investment_id);
	 $total_amount = $get_investment_details['total_amount'];
	 $no_of_slots_bought = $get_investment_details['no_of_slots_bought'];
	 $user_id = $get_investment_details['user_id'];
	 $package_id = $get_investment_details['package_id'];
	$admin_id = $_SESSION['adminid'];
	$get_package_details = $object->get_one_row_from_one_table('package_definition', 'unique_id', $package_id);
	if($get_package_details['package_type'] == 1){
	 $undo_package_sub = $object->undo_package_sub($no_of_slots_bought, $user_id, $investment_id, $total_amount, $package_id);
	}else if ($get_package_details['package_type'] == 2){
		$undo_package_sub = $object->undo_package_sub_rec($no_of_slots_bought, $user_id, $investment_id, $package_id);
	}
	$undo_package_sub_decode = json_decode($undo_package_sub, true);
	if($undo_package_sub_decode['status'] == 0){
		echo $undo_package_sub_decode['msg'];
	}else{
		$update_undo_package_request = $object->update_with_one_param('undo_package_sub_request','investment_id',$investment_id,'status', 1);
		$update_undo_package_request = json_decode($update_undo_package_request, true);
		if($update_undo_package_request['status'] == 1){
			echo "success";
		    $object->insert_logs($_SESSION['adminid'], 'Deleted package subscription');
		}
	}
?>