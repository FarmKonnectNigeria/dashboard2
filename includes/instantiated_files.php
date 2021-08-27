<?php include('includes/session.php');
   require_once('classes/db_class.php');
   include('classes/algorithm_functions.php');
   include('includes/config.php');
   $seckey = "FLWSECK-c0e8df77117baadceda4ec7df7ca5fb2-X"; 
   //$seckey = "FLWSECK_TEST-9bf59baac6ee8fd8968c8ef3249a09d4-X";
   
   
   
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
   $fullname_userp = $surname.'-'.$other_names;
   $gender = $current_user_details['gender'];
   $bvn = $current_user_details['bvn'];
   $verification_status = $current_user_details['verification_status'];
   $profile_image = $current_user_details['imageurl'];

//// Added by Abraham
   $email = $current_user_details['email'];
   $password = $current_user_details['password'];
   $phone_number = $current_user_details['phone'];

   // Not Default
   $alternate_phone = $current_user_details['alternate_phone'];
   
   if($alternate_phone === null){
       $alternate_phone = "Please update";
   }
    if($bvn === null){
       $bvn = "Please update";
   }
   $dob = $current_user_details['dob'];
   if($dob === null){
       $dob = "Please update";
   }
   $home_address = $current_user_details['home_address'];
   if($home_address === null){
       $home_address = "Please update";
   }
   $social_media_handle = $current_user_details['social_media_handle'];
   if($social_media_handle === null){
       $social_media_handle = "Please update";
   }
   $nok_surname = $current_user_details['nok_surname'];
   if($nok_surname === null){
       $nok_surname = "Please update";
   }
   $nok_name = $current_user_details['nok_name'];
   if($nok_name === null){
       $nok_name = "Please update";
   }
   $nok_phone = $current_user_details['nok_phone'];
   if($nok_phone === null){
       $nok_phone = "Please update";
   }
   $nok_email = $current_user_details['nok_email'];
   if($nok_email === null){
       $nok_email = "Please update";
   }
   $contact_address = $current_user_details['contact_address'];
   if($contact_address === null){
       $contact_address = "Please update";
   }
   $relationship = $current_user_details['relationship'];
   if($relationship === null){
       $relationship = "Please update";
   }
   $bank_name = $current_user_details['bank_name'];
   if($bank_name === null){
       $bank_name = "Please update";
   }
   $account_name = $current_user_details['account_name'];
   if($account_name === null){
       $account_name = "Please update";
   }
   $account_number = $current_user_details['account_number'];
   if($account_number === null){
       $account_number = "Please update";
   }
   $account_type = $current_user_details['account_type'];
   if($account_type === null){
       $account_type = "Please update";
   }
   $nok_fullname = $nok_surname.' '.$nok_name;
   if($nok_fullname === null){
       $nok_fullname = "Please update";
   }
   



 ?>