<?php 
    include('../includes/instantiated_files.php');
    $user_id = $_POST['user_id'];
    
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
        // $notification_type = 'alert';
        // $notification_heading = 'Package Subscription';
        // $notification = 'You subscribed to '.$getdetails['package_name'];

    if($getdetails === null){
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
                     echo $code = 700;
                 // echo  "insufficient_wallet_balance";
                 }

                  if($subdec['msg'] == 'insert_debit_wallet_tbl_error'){
                     echo $code = 800;
                 // echo  "insert_debit_wallet_tbl_error";
                 }else if($subdec['msg'] == 'wallet_deactivated'){
                    echo $code = 1000;
                 }


                  if($subdec['msg'] == 'db_error'){
                     echo $code = 900;
                 // echo  "db_error";
                 }




                  if($subdec['msg'] == 'successful_susbscription'){
                     echo $code = 200;
                     $object->insert_logs($_SESSION['adminid'], 'Bought Package for a User');
                     // $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);
                 // echo  "insufficient_wallet_balance";
                 }


            }
    }
    
?>