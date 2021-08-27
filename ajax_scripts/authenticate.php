<?php session_start();
    require_once('../classes/db_class.php');
    require_once('../includes/config.php');
    $email_or_phone = $_POST['email_or_phone'];
	$password = $_POST['password'];
	$object = new DbQueries();
	$check_user_login =  $object->check_user_login($email_or_phone,$password);
	if($check_user_login === null){
	//echo "incorrect_email_or_password";
	if (isset($_SESSION['login_status'])) { 
  			$_SESSION['login_status']++;
  			if($_SESSION['login_status'] >= 3){
  				$object->update_access_level('users_tbl',$email_or_phone);
  				echo "login_failed";

  			}else{
  				echo "incorrect_email_or_password";
  			}
		}
		else { 
		  $_SESSION['login_status'] = 1;
		  echo "incorrect_email_or_password";
		}
	}else{
		$_SESSION['uid'] = $check_user_login['unique_id'];
		echo "success";	
		unset($_SESSION['login_status']);
		$object->insert_users_logs($_SESSION['uid'], 'Logged in');
	}
   
?>