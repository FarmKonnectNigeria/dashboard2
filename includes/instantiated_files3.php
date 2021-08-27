<?php include('session.php');
   require_once('../classes/db_class.php');
   include('config.php');
   
    if(!isset($_SESSION['uid'])){
        header('location: login');
    }
    
  ///id seession
  $uid = $_SESSION['uid'];
	 //class object
  $object = new DbQueries();
  $current_user_details = $object->get_current_user_info('users_tbl',$uid);
   $current_user_privilege = $current_user_details['role_id'];
   $surname = $current_user_details['surname'];
   $other_names = $current_user_details['other_names'];
   $fullname_user = $surname.' '.$other_names;
   $verification_status = $current_user_details['verification_status'];
   $profile_image = $current_user_details['imageurl'];
   

//// Added by Abraham
   $email = $current_user_details['email'];
   $phone_number = $current_user_details['phone'];




 ?>