<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
$get_benefiaries = $object->get_rows_from_one_table_by_id('transfer_log','sender_id', $uid);
foreach ($get_benefiaries as $value) {
	$get_user_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['beneficiary_id']);
	echo $get_user_email['email'];
}
?>