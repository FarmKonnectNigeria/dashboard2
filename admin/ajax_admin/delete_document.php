<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
	$object = new DBQueries();
	$unique_id = $_POST['unique_id'];
	$table = 'admin_document_tbl';
	$delete_document = $object->delete_a_row($table,'unique_id',$unique_id);
	if($delete_document){
		echo "success";
		$object->insert_logs($_SESSION['adminid'], 'Deleted a document');
	}
	else{
		echo "error";
	}
?>