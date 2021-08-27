<?php session_start();
   require_once('../../classes/db_class.php');
   include('../../includes/config.php');
   
    if(!isset($_SESSION['adminid'])){
        header('location: login');
    } 
  ///id seession
   $uid = $_SESSION['adminid'];
   //class object
   $object = new DbQueries();
   $current_admin_details = $object->get_current_user_info('admin_tbl',$uid);
   $surname = $current_admin_details['surname'];
   $other_names = $current_admin_details['other_names'];
   $fullname_user = $surname.' '.$other_names;

?>