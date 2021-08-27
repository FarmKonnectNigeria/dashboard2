<?php 
    include('../includes/instantiated_files2.php');
    $user_id = $_SESSION['uid'];
     $package_id = $_POST['unique_id'];
   
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
    $package_type = $_POST['package_type'];
    $package_category = $_POST['package_category'];
    $package_commission = $_POST['package_commission'];
    $notification_type = 'alert';
    $notification_heading = 'Military Package Subscription Request';
    $notification = 'You sent subscription request to buy military package: '.$getdetails['package_name'];

    //$getdetails);
    //foreach($getdetails as $value){ echo $value.'<br>';}
    
    
    if($getdetails == null){
       echo "package id is not correct"; 
    }else{
            if ( $_POST['slots_to_buy'] == '' ) {
              echo $code = 300;
             // echo "slots field can not be empty(var)";
            }

            else if ( !isset($_POST['terms_conditions'])  ) {
             $terms_conditions = 0;
                 echo $code = 400;

             // echo "please agree to terms and conditions";
            
            }

            else if($available_slots  <  $slots_to_buy ){
                echo $code = 500;
                 // echo  "you cannot buy more than available slots";

            }

            else if($min_slots  >  $slots_to_buy ){
                echo $code = 600;
                 // echo  "You cannot buy less than the minimum slot";

            }

            else{
                 $terms_conditions = 1;
                $sub =  $object->send_subscription_request_military($package_type,$package_category,$package_commission,$user_id,$package_id,$package_unit_price,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$slots_to_buy,$available_slots);
                     $subdec = json_decode($sub,true);
                     $msg = $subdec['msg'];
                     //echo $subdec['msg'].'ooo';
                    //echo $subdec['status'];
                    if($msg == 'db_error'){
                    echo $code = 900;
                    // echo  "db_error";
                    }
                    
                    if($msg == 'exists'){
                    echo $code = 1000;
                    // echo  "exist";
                    }
                    
                    if($msg == 'success'){
                    echo $code = 200;
                    $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);
                    // echo  "insufficient_wallet_balance";
                    $object->insert_users_logs($_SESSION['uid'], 'Sent subscription request for military Package');
                    } 
                   


            }
            
            
    }
    
?>