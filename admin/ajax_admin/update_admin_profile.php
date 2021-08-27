<?php 
   include('../includes/instantiated_files.php');
 	
if( $_POST['surname'] != "" && $_POST['other_names'] != "" && $_POST['phone'] != "" && $_POST['address'] != ""
&& $_POST['email'] != "" && $_POST['gender'] != ""
){
    $param = 'unique_id';
	$data = ['other_names', 'surname' , 'phone', 'address', 'email', 'gender'];

	$update_data =  $object->update_data('admin_tbl',$data,$param,$uid);
	$update_decode = json_decode($update_data,true);
	if($update_decode['status'] === '0'){
		echo 500;
	}else{ 
     	echo 200;
		$description = "Updated basic profile";
		$object->insert_logs($uid, $description);	
	}

 } else{
 	  echo 500;
 }
    
?>