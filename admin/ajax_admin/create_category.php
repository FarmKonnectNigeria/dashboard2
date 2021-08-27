<?php  include('../includes/instantiated_files.php');
		$cat_name = $_POST['cat_name'];
		$category_description = $_POST['package_description'];
		$create = $object->insert_package_category($cat_name, $category_description,$uid);
		$create_dec = json_decode($create,true);
		
		if($create_dec['msg'] == 'success'){
		//$msg = "<div class='alert alert-success'>Category Creation was successful</div>";
		echo 200;
		}

		if ($create_dec['msg'] == 'empty_fields') {
		//$msg = "<div class='alert alert-danger'>Some fields are empty</div>";
        echo 300;
		}

		if ($create_dec['msg'] == 'record_exists') {
		//$msg = "<div class='alert alert-danger'>Some fields are empty</div>";
        echo 400;
		}

		if ($create_dec['msg'] == 'db_error') {
		//$msg = "<div class='alert alert-danger'>Server Error</div>";
		echo 500;
		}

?>