<?php include('includes/session.php');
   require_once('../classes/db_class.php');
   include('includes/config.php');
   
    if(!isset($_SESSION['adminid'])){
        header('location: login');
    }
    
  ///id seession
   $uid = $_SESSION['adminid'];
	 //class object
   $object = new DbQueries();
   $current_user_details = $object->get_current_user_info('admin_tbl',$uid);
  // $current_user_privilege = $current_user_details['role_id'];
   $surname = $current_user_details['surname'];
   $other_names = $current_user_details['other_names'];
   $fullname_user = $surname.' '.$other_names;



 ?>