<?php
 	require_once('../includes/instantiated_files3.php');
	$object = new DbQueries();
	$unique_id = $_POST['unique_id'];
	$table = 'document_tbl';
	$delete_document = $object->delete_a_row($table,'unique_id',$unique_id);
	if($delete_document){
	    $object->insert_users_logs($_SESSION['uid'], 'Deleted a document');
		echo "success";
	}
	else{
		echo "error";
	}
?>