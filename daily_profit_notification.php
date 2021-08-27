<?php
   require_once('classes/db_class.php');
   include('includes/config.php');
   $object = new DbQueries();
   
   // $getpack = $object->get_rows_from_one_table_by_id('subscribed_user_tbl','user_id',$uid);
   $running_investments = $object->get_rows_from_one_table_by_id('subscribed_packages','liquidation_status',0);



// Quick Functions to for profit logic
function check_if_investment_is_on($date_created,$moratorium){
      //now check if current date is greater than date_created + moratorium
         $current_date = date('Y-m-d');
        if($moratorium == 0){
         $day_investment_starts_to_count = date('Y-m-d',strtotime($date_created. ' + 1 days'));
        }
        else{
          $day_investment_starts_to_count = date('Y-m-d', strtotime($date_created. ' + '.$moratorium.' days'));    
        }
        
        ///the current date check to know if invst has started
        if($current_date >= $day_investment_starts_to_count){
            return true;
        }else{
            return false;
        }
}
// Quick Functions to for profit logic ends here
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daily Profits Cron</title>
</head>
<body>
   <?php foreach($running_investments as $getinvst){
       //package details::
       $package_details  =  $object->get_one_row_from_one_table('package_definition','unique_id',$getinvst['package_id']);
        $investor_details  =  $object->get_one_row_from_one_table('users_tbl','unique_id',$getinvst['user_id']);
       
    //   echo $getinvst['unique_id'].'>>><br>';
    // First Check if fixed or recurrent
    if($getinvst['package_type'] == "1"){
        $check_if_investment_is_on =  check_if_investment_is_on($getinvst['date_created'],$getinvst['moratorium']);
        if($check_if_investment_is_on){
            echo $package_details['package_name']."-".$getinvst['unique_id']." FOR ".$investor_details['surname'].'-'.$investor_details['other_names']. ":::Fixed ON<br>";
              $daily_prof = $getinvst['package_unit_price'] * $getinvst['no_of_slots_bought'] * $getinvst['multiplying_factor'];
              $email = $investor_details['email'];
              $subject = "You just made a profit on Farmkonnect for the Package: ".$package_details['package_name'];
              $content = "Congratulations ". $investor_details['surname'].' '. $investor_details['other_names'].",
                      Profit of N".number_format($daily_prof)." was just added for your investment with Farmkonnect";
            
              $object->email_function($email, $subject, $content);
            
        }else{
            echo $package_details['package_name']."-".$getinvst['unique_id']." FOR ".$investor_details['surname'].'-'.$investor_details['other_names']. "::::Fixed OFF<br>";
        }
        
        
        
        
    }else{
        //echo "Recurrent Invst<br>";
         $check_if_investment_is_on =  check_if_investment_is_on($getinvst['date_created'],$getinvst['moratorium']);
        if($check_if_investment_is_on){
            echo $package_details['package_name']."-".$getinvst['unique_id']." FOR ".$investor_details['surname'].'-'.$investor_details['other_names']. ":::Rec ON<br>";
        }else{
            echo $package_details['package_name']."-".$getinvst['unique_id']." FOR ".$investor_details['surname'].'-'.$investor_details['other_names']. ":::::Rec OFF<br>";
        }
    }
            
   }?>
</body>
</html>
