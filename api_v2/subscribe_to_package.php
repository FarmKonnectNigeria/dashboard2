<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$user_id = $_POST['uid'];
$package_id = $_POST['package_id'];
$slots_to_buy = $_POST['slots_to_buy'];
   
    // print_r($_POST);
    $getdetails = $object->get_one_row_from_one_table('package_definition','unique_id',$package_id);
    $notification_type = 'alert';
    $notification_heading = 'Package Subscription';
    $notification = 'You subscribed to '.$getdetails['package_name'];
    $package_unit_price = $getdetails['package_unit_price'];
    $capital_refund = $getdetails['capital_refund'];
    $moratorium = $getdetails['moratorium'];
    $free_liquidation_period = $getdetails['free_liquidation_period'];
    $liquidation_surcharge = $getdetails['liquidation_surcharge'];
    $tenure_of_product = $getdetails['tenure_of_product'];
    $float_time = $getdetails['float_time'];
    $multiplying_factor = $getdetails['multiplying_factor'];
    $available_slots = $getdetails['no_of_slots'];
     $min_slots = $getdetails['min_no_slots'];
     $package_type = $getdetails['package_type'];
       $package_category = $getdetails['package_category'];
        $package_commission = $getdetails['package_commission'];

    if($getdetails === null){
       echo "package id is not correct"; 
    }else{
      if ( $_POST['slots_to_buy'] == '' ) {
              echo json_encode(["status"=>"0", "msg"=>"empty_field(s)"]);
       // echo "slots field can not be empty(var)";
      }

      // else if ( !isset($_POST['terms_conditions'])  ) {
      //  $terms_conditions = 0;
   //               echo json_encode(["status"=>"2", "msg"=>"agree_to_terms_conditions"]);
      
      //  // echo "please agree to terms and conditions";
      
      // }

      else if($available_slots  <  $slots_to_buy ){
                echo json_encode(["status"=>"3", "msg"=>"slot_more_than_available"]);
           // echo  "you cannot buy more than available slots";

      }

            else if($min_slots  >  $slots_to_buy ){
                 echo json_encode(["status"=>"4", "msg"=>"slot_less_than_available"]);
                 // echo  "You cannot buy less than the minimum slot";

            }

      else{
                 $terms_conditions = 1;
                 //echo $code = 600;
                 // echo "you are about to make a purchage of ". $_POST['slots_to_buy']*$getdetails['package_unit_price'] . "<br>Please <a href=''>Verify</a> OR <a href=''>Cancel</a>";
                 if($getdetails['package_type'] == '1'){
                        $sub =  $object->subscribe_to_fixed_package($package_type,$package_category,$package_commission,$user_id,$package_id,$package_unit_price,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$slots_to_buy,$available_slots);
                        

                 }
                  if($getdetails['package_type'] == '2'){
                       $incubation_period = $getdetails['incubation_period'];
                       $recurrence_value = $getdetails['recurrence_value'];
                       $contribution_period = $getdetails['contribution_period'];
                       $recurrence_type = $getdetails['recurrence_type'];
                        $sub =  $object->subscribe_to_recurrent_package($package_type,$package_category,$package_commission,$user_id,$package_id,$package_unit_price,$incubation_period,$recurrence_value,$contribution_period,$recurrence_type,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$slots_to_buy,$available_slots);
                 

                 }
                   $subdec = json_decode($sub,true);


                 if($subdec['msg'] == 'insufficient_wallet_balance'){
                     echo json_encode(["status"=>"5", "msg"=>"insufficient_balance"]);
                 // echo  "insufficient_wallet_balance";
                 }



                  if($subdec['msg'] == 'insert_debit_wallet_tbl_error'){
                      echo json_encode(["status"=>"6", "msg"=>"insert_debit_wallet_tbl_error"]);
                 // echo  "insert_debit_wallet_tbl_error";
                 }

                if($subdec['msg'] == 'wallet_deactivated'){
                   echo json_encode(["status"=>"9", "msg"=>"wallet_deactivated"]);
                 }

                  if($subdec['msg'] == 'db_error'){
                      echo json_encode(["status"=>"7", "msg"=>"db_error"]);
                 // echo  "db_error";
                 }




                  if($subdec['msg'] == 'successful_susbscription'){
                      echo json_encode(["status"=>"1", "msg"=>"successful_susbscription"]);
                      $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
                     $object->insert_users_logs($user_id, 'Subscribed to a Package');
                 // echo  "insufficient_wallet_balance";
                 }


      }
    }

?>