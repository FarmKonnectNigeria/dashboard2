<?php 
include('includes/instantiated_files2.php');
include('includes/header.php');

$area_id = $_POST['area_id'];
$get_unit = $object->get_rows_from_one_table_by_id('cctv_unit', 'area_id', $area_id);
?>
<option value="">Select a Unit</option>
<?php
foreach($get_unit as $value){
?>
	<option value="<?php echo $value['unique_id']; ?>"><?php echo $value['unit_name']; ?></option>
<?php } ?>


