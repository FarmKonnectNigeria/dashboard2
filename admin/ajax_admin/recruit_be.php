<?php
 include('../includes/instantiated_files.php');
 $email = $_POST['email'];
 $admin_id = $_SESSION['adminid'];
 $check_if_be_exists = $object->check_row_exists_by_one_param('admin_tbl','email',$email);
 if($email == ''){
 	echo "empty_fields";
 }
 else if($check_if_be_exists === true){
 	echo "record_exists";
 }else{
 	$id = $object->unique_id_generator(md5(rand()));
 	$link = "https://$_SERVER[HTTP_HOST]"."/register_be.php?id=".$id."&referral_id=".$admin_id;
 	$subject = "Business Executive Registration - FarmKonnect";
  	$content = "You have been recruited as a Business Executive for FarmKonnect.<br><br> Please Click <a href='".$link."'> here </a> to register your account or copy the link below and paste it on your browser<br> 
  <a href='".$link."'>".$link. "</a>";
  $send_email = $object->email_function($email, $subject, $content);
  if($send_email){
  	echo "success";
  	$object->insert_logs($_SESSION['adminid'], 'Recruited a Business Executive');
  }else{
  	echo "error";
  }
 }
?>