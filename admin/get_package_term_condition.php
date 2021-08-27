<?php
 include('includes/instantiated_files2.php');
//include('includes/header.php'); 

	if(isset($_POST['package_id'])){
	$get_terms_condition = $object->get_one_row_from_one_table('package_term_condition','package_id',$_POST['package_id']);
	echo $get_terms_condition['description'];
}
 //echo $_POST['des'];

?>

