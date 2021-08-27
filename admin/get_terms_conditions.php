<?php
 include('includes/instantiated_files2.php');
//include('includes/header.php'); 

	if(isset($_POST['conditions_for_what'])){
	$get_terms_condition = $object->get_one_row_from_one_table('terms_n_conditions','conditions_for_what',$_POST['conditions_for_what']);
	echo $get_terms_condition['description'];
}
 //echo $_POST['des'];

?>

