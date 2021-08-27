<?php 
//session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$user_id = $_POST['uid'];
$slots_to_buy = $_POST['slots_to_buy'];
$package_id = "5517d1e6ed4bac32424af3b5e83a3e1e";


 // print_r($_POST);
    $getdetails = $object->get_one_row_from_one_table('package_definition','unique_id',$package_id);
    $package_unit_price = $getdetails['package_unit_price'];
    $capital_refund = $getdetails['capital_refund'];
    $moratorium = $getdetails['moratorium'];
    $free_liquidation_period = $getdetails['free_liquidation_period'];
    $liquidation_surcharge = $getdetails['liquidation_surcharge'];
    $tenure_of_product = $getdetails['tenure_of_product'];
    $float_time = $getdetails['float_time'];
    $multiplying_factor = $getdetails['multiplying_factor'];
    $available_slots = $getdetails['no_of_slots'];
    $slots_to_buy = $_POST['slots_to_buy'];
    $min_slots = $_POST['min_slots'];
    $package_type = intval($_POST['package_type']);
    $package_category = $_POST['package_category'];
    $package_commission = floatval($_POST['package_commission']);
    $notification_type = 'alert';
    $notification_heading = 'Military Package Subscription Request';
    $notification = 'You sent subscription request to buy military package: '.$getdetails['package_name'];

    //$getdetails);
    //foreach($getdetails as $value){ echo $value.'<br>';}
    
    
    if($getdetails == null){
       echo "package id is not correct"; 
    }else{
            if ( $_POST['slots_to_buy'] == '' ) {
             
              echo json_encode(["status"=>"5", "msg"=>"empty_field(s)"]);
         
            }
            
            else if ( $_POST['slots_to_buy'] <= 0  ) {
             
              echo json_encode(["status"=>"13", "msg"=>"enter_slot_at_least_one"]);
         
            }

            else if($available_slots  <  $slots_to_buy ){
                
                echo json_encode(["status"=>"3", "msg"=>"slot_more_than_available"]);

            }

            else if($min_slots  >  $slots_to_buy ){
             
                echo json_encode(["status"=>"4", "msg"=>"slot_less_than_available"]);

            }

            else{
                 $terms_conditions = 1;
                $sub =  $object->send_subscription_request_military($package_type,$package_category,$package_commission,$user_id,$package_id,$package_unit_price,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$slots_to_buy,$available_slots);
                     $subdec = json_decode($sub,true);
                     $msg = $subdec['msg'];
                     //echo $subdec['msg'].'ooo';
                    //echo $subdec['status'];
                    if($msg == 'db_error'){
                             echo json_encode(["status"=>"7", "msg"=>"db_error"]);
                    }
                    
                    if($msg == 'exists'){
                             echo json_encode(["status"=>"10", "msg"=>"request_sent_already"]);
                    }
                    
                    if($msg == 'success'){
                        
                        echo json_encode(["status"=>"1", "msg"=>"successful_request_sent"]);
                        $notification_type = "Military Subscription Request";
                        $notification_heading = "Sending Military Subscription Request";
                        $notification = "Military subscription request was successfully sent";
                        $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
                        // echo  "insufficient_wallet_balance";
                       $object->insert_users_logs($user_id, 'Sent subscription request for military Package');
                    
                        
                    } 
                   


            }
            
            
    }
    
?>