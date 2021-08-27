<?php
 include('../includes/instantiated_files.php');
 if(isset($_POST['select_client'])){
 	$user_id = $_POST['select_client'];
 }else{
 	$user_id = '';
 }
 $get_user = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
 //echo $get_user['name_of_client'];
	$name_of_client = !empty($_POST['name_of_client']) ? $_POST['name_of_client'] : $get_user['name_of_client'];
	$email = !empty($_POST['email']) ? $_POST['email'] : $get_user['email'];
	$phone = !empty($_POST['phone']) ? $_POST['phone'] : $get_user['phone'];
	$home_address = !empty($_POST['home_address']) ? $_POST['home_address'] : $get_user['home_address'];;
	$package_bought = $_POST['package_bought'];
	$product_of_interest = $_POST['product_of_interest'];
	$special_consideration = $_POST['special_consideration'];
	$discount = !empty($_POST['discount']) ? $_POST['discount'] : '';
	$admin_id = $uid;
	$subject ="Draft Agreement - FarmKonnect";
	$link= "<a href='http://dashboard.farmkonnectng.com/draft_agreement.php'>Draft Agreement</a>";
    $content = "The Draft agreement for the product you bought on FarmKonnect is ready. Please click on the link below to download it"
    .$link.

    "Thanks, Regards"; 
	$insert_draft_agreement = $object->draft_agreement($user_id, $name_of_client, $package_bought, $product_of_interest, $special_consideration, $discount, $email, $phone, $home_address, $admin_id);
  $insert_draft_agreement_decode = json_decode($insert_draft_agreement, true);
	if($insert_draft_agreement_decode['status'] == 0){
		echo $insert_draft_agreement_decode['msg'];
	}else{
		echo "success";
		$description = "Saved a draft agreement";
		$object->insert_logs($uid, $description);
		$object->email_function($email, $subject, $content);

	}

?>