<?php 
   include('../includes/instantiated_files2.php');
 	
if( $_POST['surname'] != "" && $_POST['other_names'] != "" && $_POST['phone'] != "" && $_POST['alternate_phone'] != ""
&& $_POST['home_address'] != "" && $_POST['dob'] != "" && $_POST['gender'] != ""
){
    $param = 'unique_id';
	$data = ['other_names', 'surname' , 'phone', 'alternate_phone', 'dob', 'social_media_handle', 'home_address', 'gender'];
	$notification_type = 'alert';
    $notification_heading = 'Profile Update';
    $notification = 'You updated your profile';
	$update_data =  $object->update_data('users_tbl',$data,$param,$uid);
	$update_decode = json_decode($update_data,true);
	if($update_decode['status'] === '0'){
		echo 500;
	}else{ 
     	echo 200;
     	$object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);	
     	$object->insert_users_logs($_SESSION['uid'], 'Updated Basic Profile');
	}

 } else{
 	  echo 600;
 }
    
?>