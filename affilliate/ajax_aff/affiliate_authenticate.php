<?php session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $email_or_phone = $_POST['email_or_phone'];
	$password = $_POST['password'];
	$object = new DbQueries();
	$check_affiliate_login =  $object->check_aff_login($email_or_phone,$password);
	if($check_affiliate_login === null){
	if (isset($_SESSION['login_status'])){ 
  			$_SESSION['login_status']++;
  			if($_SESSION['login_status'] == 3){
  				$object->update_access_level('affilliate_tbl',$email_or_phone);
  				echo "login_failed";

  			}
		}
		else { 
		  $_SESSION['login_status'] = 1;
		}
	}else{
		$_SESSION['affiliate_id'] = $check_affiliate_login['user_id'];
		echo "success";	
	}
   
?>