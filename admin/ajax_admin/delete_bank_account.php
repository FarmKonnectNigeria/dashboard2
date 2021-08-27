<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
	$object = new DbQueries();
	$unique_id = $_POST['unique_id'];
	$table = 'bank_accounts';
	$delete_bank_account = $object->delete_a_row($table,'unique_id',$unique_id);
	if($delete_bank_account){
		echo "success";
		$object->insert_logs($_SESSION['adminid'], 'Deleted bank account details');
	}
	else{
		echo "error";
	}
?>