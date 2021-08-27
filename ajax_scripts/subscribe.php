<?php 
    include('../includes/instantiated_files2.php');
    $user_id = $_SESSION['uid'];
    $package_id = $_POST['package_id'];

   if( !empty($_POST['slot'.$package_id])  && !empty($_POST['duration'.$package_id])  && !empty($_POST['package_amount'.$package_id]) ){
			$slot = $_POST['slot'.$package_id];
			$months = $_POST['duration'.$package_id];
			$unit_package_amount = $_POST['package_amount'.$package_id];
			$package_amount = $unit_package_amount * $slot;
			if(!isset($_POST['terms_conditions'.$package_id])  ){
      			  $terms_conditions = 0;
      			  echo 500;
				}
				else{ 
					$terms_conditions = 1;
					$subscribe =  $object->subscribe_to_a_package($user_id,$package_id,$slot,$months,$package_amount);
					$subscribe_decode = json_decode($subscribe,true);
					if($subscribe_decode['msg'] === 'successful insertion'){
					echo 200;
					}
					else if($subscribe_decode['msg'] === 'exists'){
						echo 250;
					}
					else if($subscribe_decode['msg'] === 'slot_less'){
						echo 300;
					}
					else if($subscribe_decode['msg'] === 'balance_less'){
						echo 350;
					}
					else if($subscribe_decode['msg'] === 'less_or_more'){
						echo 400;
					}
					else if($subscribe_decode['msg'] === 'getting_slot_balance_error'){
						echo 450;
					}
					else if($subscribe_decode['msg'] === 'insert_debit_wallet_tbl_error'){
						echo 550;
					}
			 	 	else{
			 	 	echo 500;	
			 	 	}
			 	 }
			 	 	// echo $subscribe_decode['msg'];	

    }else{
    	echo 500;
    }
	
   
?>