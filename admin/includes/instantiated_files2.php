<?php session_start();
   require_once('../classes/db_class.php');
   include('../includes/config.php');
   
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
   $email = $current_admin_details['email'];
   $gender = $current_admin_details['gender'];
   $phone = $current_admin_details['phone'];
   $address = $current_admin_details['address'];
   $role_id = $current_admin_details['role_right'];
   $seckey = "FLWSECK-c0e8df77117baadceda4ec7df7ca5fb2-X"; 
   

   $get_role_name = $object->get_one_row_from_one_table('admin_roles','unique_id',$role_id);
    $role_name = $get_role_name['role_name'];

   ///current page
   //function for page access
   // $page_access_check = $object->get_page_access($role_id);
   // if($page_access_check['status'] == 0){
   //      header('location: no_access');

   // }



?>