<?php
 include('../includes/instantiated_files.php');
 //require_once('../../classes/algorithm_functions.php');
 $unique_id = $_POST['unique_id'];
 $get_package_details = $object->get_one_row_from_one_table('package_definition_request', 'unique_id', $unique_id);
$recurrence_value = $get_package_details['recurrence_value'];
$contribution_period = $get_package_details['contribution_period'];
$incubation_period = $get_package_details['incubation_period'];
$recurrence_type = $get_package_details['recurrence_type'];
$package_name = $get_package_details['package_name'];
$package_category = $get_package_details['package_category'];
$package_description = $get_package_details['package_description'];
$package_type = $get_package_details['package_type'];
$package_unit_price = $get_package_details['package_unit_price'];
$min_no_slots = $get_package_details['min_no_slots'];
$moratorium = $get_package_details['moratorium'];
$free_liquidation_period = $get_package_details['free_liquidation_period'];
$liquidation_surcharge = $get_package_details['liquidation_surcharge'];
$tenure_of_product = $get_package_details['tenure_of_product'];
$float_time = $get_package_details['float_time'];
$multiplying_factor = $get_package_details['multiplying_factor'];
$capital_refund = $get_package_details['capital_refund'];
$backdatable = $get_package_details['backdatable'];
$no_of_slots = $get_package_details['no_of_slots'];
$visibility = $get_package_details['visibility'];
$package_commission = $get_package_details['package_commission'];
$created_by =$get_package_details['created_by'];

if($package_type == 1){
	$approve_package_creation = $object->create_fixed_package($package_name,$package_category,$package_description,$package_type,$package_unit_price,$min_no_slots,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$backdatable,$no_of_slots,$visibility,$package_commission,$created_by);
}
else if($package_type == 2){
 $approve_package_creation = $object->create_recurrent_package($recurrence_value,$contribution_period,$incubation_period,$recurrence_type,$package_name,$package_category,$package_description,$package_type,$package_unit_price,$min_no_slots,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$backdatable,$no_of_slots,$visibility,$package_commission,$created_by);
}
    $approve_package_creation_decode = json_decode($approve_package_creation, true);
    if($approve_package_creation_decode['status'] == 0){
    	echo $approve_package_creation_decode['msg'];
    }else{
    	$update_approval_status = $object->update_with_one_param('package_definition_request','unique_id',$unique_id,'approval_status', 1);
    	$update_approval_status_decode = json_decode($update_approval_status, true);
    	if($update_approval_status_decode['status'] == 1){
	    	echo "success";
	        $object->insert_logs($_SESSION['adminid'], 'Approved Package Creation');
    	}
    }
?>