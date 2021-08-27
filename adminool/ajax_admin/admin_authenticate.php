<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $email_or_phone = $_POST['email_or_phone'];
	$password = $_POST['password'];
	$description = "Logged in";
	$object = new DbQueries();
	$check_admin_login =  $object->check_admin_login($email_or_phone,$password);
	//echo 
	if($check_admin_login === null){
	if (isset($_SESSION['login_status'])) { 
  			$_SESSION['login_status']++;
  			if($_SESSION['login_status'] == 3){
  				$object->update_access_level('admin_tbl',$email_or_phone);
  				echo "login_failed";

  			}
		}
		else { 
		  $_SESSION['login_status'] = 1;
		}
	}else{
		$_SESSION['adminid'] = $check_admin_login['unique_id'];
		$admin_role_id = $check_admin_login['role_right'];
		$get_role_name = $object->get_one_row_from_one_table('admin_roles','unique_id',$admin_role_id);
		$role_name = $get_role_name['role_name'];
		if(strcasecmp($role_name, 'Cash Officer') == 0){
			echo 1;
		}
		else if(strcasecmp($role_name, 'Lead Officer') == 0){
			echo 2;
		}
		else if(strcasecmp($role_name, 'Feedback Officer') == 0){
			echo 3;
		}

		else{
			echo "success";
		}	
		$object->insert_logs($_SESSION['adminid'], $description);
		

	}
   
?>