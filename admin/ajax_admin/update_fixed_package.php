<?php  include('../includes/instantiated_files.php');
		
		$package_name =  $_POST['package_name'];
		$package_category =  $_POST['package_category'];
		$package_description =  $_POST['package_description'];
		$package_type =  $_POST['package_type'];
		$package_unit_price =  str_replace(',','',$_POST['package_unit_price']);
		$min_no_slots =  str_replace(',','',$_POST['min_no_slots']);
		$moratorium = str_replace(',','',$_POST['moratorium']);
		$free_liquidation_period = str_replace(',','',$_POST['free_liquidation_period']);
		$liquidation_surcharge = str_replace(',','',$_POST['liquidation_surcharge']);
		$tenure_of_product = str_replace(',','',$_POST['tenure_of_product']);
		$float_time = str_replace(',','',$_POST['float_time']);
		$multiplying_factor = $_POST['multiplying_factor'];
		$capital_refund = $_POST['capital_refund'];
		$backdatable = $_POST['backdatable'];
		$no_of_slots = str_replace(',','',$_POST['no_of_slots']);
		$visibility = $_POST['visibility'];
		$package_commission =  str_replace(',','',$_POST['package_commission']);

		$package_id =  $_POST['package_id'];
            


		$create = $object->update_fixed_package($package_id,$package_name,$package_category,$package_description,$package_type,$package_unit_price,$min_no_slots,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$capital_refund_days,$backdatable,$no_of_slots,$visibility,$package_commission,$uid);
		
		$create_dec = json_decode($create,true);

		
	if($create_dec['msg'] == 'success'){
		//$msg = "<div class='alert alert-success'>Category Creation was successful</div>";
		echo 200;
		}

		else if ($create_dec['msg'] == 'empty_fields') {
		//$msg = "<div class='alert alert-danger'>Some fields are empty</div>";
        echo 300;
		}

		else if ($create_dec['msg'] == 'record_exists') {
		//$msg = "<div class='alert alert-danger'>Server Error</div>";
		echo 400;
		}

		else  {
		//$msg = "<div class='alert alert-danger'>Server Error</div>";
		echo 500;
		}
?>