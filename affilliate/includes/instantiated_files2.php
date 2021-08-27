<?php session_start();
   require_once('../classes/db_class.php');
   include('../includes/config.php');
   
    if(!isset($_SESSION['affiliate_id'])){
        header('location: login');
    } 
  ///id seession
   $uid = $_SESSION['affiliate_id'];
   //class object
   $object = new DbQueries();
   

   $current_affiliate_details = $object->get_current_user_info('affilliate_tbl',$uid);
   $surname = $current_affiliate_details['surname'];
   $other_names = $current_affiliate_details['other_names'];
   $fullname_user = $surname.' '.$other_names;
   $affilliate_id = $current_affiliate_details['affilliate_level'];

   
    $affilliate_id = $current_affiliate_details['affilliate_level'];

   $affiliate_level = $object->get_one_row_from_one_table('affilliate_type','unique_id',$affilliate_id);
   $get_affiliate_level = $affiliate_level['affiliate_name'];


?>