<?php include('includes/instantiated_files2.php');
//include('includes/header.php'); 
$package_id = $_POST['package'];
$get_amount = $object->get_one_row_from_one_table('package_definition', 'unique_id', $package_id);
$amount = $get_amount['package_unit_price'];
echo $amount;
?>