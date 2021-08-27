<?php  include('../includes/instantiated_files.php');
		$cat_name = $_POST['cat_name'];
		$category_description = $_POST['package_description'];
		$cat_id = $_POST['cat_id'];
		$edit = $object->update_package_category($cat_name, $category_description, $cat_id);
		$edit_dec = json_decode($edit,true);
		
		if($edit_dec['msg'] == 'success'){
		$msg = "<div class='alert alert-success'>Category Update was successful</div>";
		echo 200;
		}

		if ($edit_dec['msg'] == 'empty_fields') {
		//$msg = "<div class='alert alert-danger'>Some fields are empty</div>";
        echo 300;
		}

		if ($edit_dec['msg'] == 'record_exists') {
		//$msg = "<div class='alert alert-danger'>Some fields are empty</div>";
        echo 400;
		}

		if ($edit_dec['msg'] == 'db_error') {
		//$msg = "<div class='alert alert-danger'>Server Error</div>";
		echo 500;
		}

?>