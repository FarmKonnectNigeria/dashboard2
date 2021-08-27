<?php
 include('../includes/instantiated_files.php');
 $BE_to_transfer = $_POST['BE_id'];
 $transfer_to = $_POST['transfer_to'];
 $method_of_transfer = $_POST['method_of_transfer'];
 $transfer_clients_to = isset($_POST['transfer_clients_to']) ? $_POST['transfer_clients_to'] : '';

 if($BE_to_transfer == ''  || $transfer_to == '' || $method_of_transfer == ''){
 	echo "empty_fields";
 }else{
 	if($method_of_transfer == 'transfer_without_clients'){
 		if($BE_to_transfer == $transfer_clients_to){
 			echo "not_possible";
 		}else{
	 		$update_be_tbl = $object->update_with_one_param('business_executive_tbl','unique_id', $BE_to_transfer, 'assigned_to', $transfer_to);
	 		$update_be_tbl_decode = json_decode($update_be_tbl, true);
	 		$get_clients = $object->get_rows_from_one_table_by_id('leads', 'assigned_to', $BE_to_transfer);
	 		foreach ($get_clients as $value) {
	 			$update_assigned_to = $object->update_with_one_param('leads','unique_id',$value['unique_id'], 'assigned_to', $transfer_clients_to);
	 			$update_assigned_to_decode = json_decode($update_assigned_to, true);
	 			$get_num_leads1 = $object->get_number_of_rows_one_param('leads','assigned_to', $BE_to_transfer);
	 			$get_num_leads2 = $object->get_number_of_rows_one_param('leads','assigned_to', $transfer_clients_to);
				$update_num_leads1 = $object->update_with_one_param('business_executive_tbl', 'unique_id', $BE_to_transfer, 'no_of_assigned_lead', $get_num_leads1);
				$update_num_leads2 = $object->update_with_one_param('business_executive_tbl', 'unique_id', $transfer_clients_to, 'no_of_assigned_lead', $get_num_leads2);
				$update_num_leads_decode1 = json_decode($update_num_leads1, true);
				$update_num_leads_decode2 = json_decode($update_num_leads2, true);
	 		}
	 		if($update_be_tbl_decode['status'] == 1 AND $update_assigned_to_decode['status'] == 1 AND $update_num_leads_decode1['status'] == 1 AND $update_num_leads_decode2['status'] == 1){
	 			echo "success";
	 		}else{
	 			echo "error";
	 		}
 		}
 	}else if($method_of_transfer == 'transfer_with_clients'){
 		$update_be_tbl = $object->update_with_one_param('business_executive_tbl','unique_id', $BE_to_transfer, 'assigned_to', $transfer_to);
 		$update_be_tbl_decode = json_decode($update_be_tbl, true);
 		if ($update_be_tbl_decode['status'] == 1) {
 			echo "success";
 		}else{
 			echo "error";
 		}
 	}
 }
 ?>