<?php
$table = "";
$app_name = 'FARM KONNECT';
require_once("db_connect2.php");
//require_once('validations.php');
// require_once("../includes/config.php");
global $dbc;
$seckey = "FLWSECK-c0e8df77117baadceda4ec7df7ca5fb2-X"; 


//from flutterwave
function get_banks_and_codes(){
   // global $seckey;
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.flutterwave.com/v3/banks/NG',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer FLWSECK-c0e8df77117baadceda4ec7df7ca5fb2-X'
      )
      
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    
    return $response;

}

/////////above code needs cleanup
// verify a user account by flutterwave resovle bvn and account no
function get_user_verification_details($account_number,$account_bank){
  
      $url = 'https://api.flutterwave.com/v3/transfers';
            // Collection object
            $data = [
            'account_number' => $account_number,
             'account_bank' => $account_bank
            ];
    
            $curl = curl_init('https://api.flutterwave.com/v3/accounts/resolve');
            
            // Set the CURLOPT_RETURNTRANSFER option to true
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
            // Set the CURLOPT_POST option to true for POST request
            curl_setopt($curl, CURLOPT_POST, true);
            
            // Set the request data as JSON using json_encode function
            curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
            
            // Set custom headers for RapidAPI Auth and Content-Type header
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer FLWSECK-c0e8df77117baadceda4ec7df7ca5fb2-X',
            'Content-Type: application/json'
            ]);
            
            // Execute cURL request with all previous settings
            $response = curl_exec($curl);
            
            // Close cURL session
            curl_close($curl);
            
            return $response;
}



function secure_database($value){
    global $dbc;
    $new_value = mysqli_real_escape_string($dbc,$value);
    return $new_value;
}

function unique_id_generator($data){
     $data = secure_database($data);
     $newid = md5(uniqid().time().rand(11111,99999).rand(11111,99999).$data);
     return $newid;
}


function email_function($email, $subject, $content){
  $headers = "From: Farmkonnect\r\n";
  @$mail = mail($email, $subject, $content, $headers);
  return $mail;
}

function check_row_exists_by_one_param($table,$param,$value){
    global $dbc;
  $table = secure_database($table);
  $param = secure_database($param);
  $value = secure_database($value);
  $sql = "SELECT * FROM `$table` WHERE `$param` = '$value'" or die(mysqli_error($dbc));
  $query = mysqli_query($dbc, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0 ){
    return true;
  }else{
    return false;
  }
}

function get_rows_from_one_table($table){
        global $dbc;
        $table = secure_database($table);
          $sql = "SELECT * FROM `$table` ORDER BY date_created DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_wallet_balance($user_id){
      global $dbc;
      $user_id = secure_database($user_id);
      $sql = "SELECT * FROM `wallet_tbl` WHERE `user_id` = '$user_id'";
      $query = mysqli_query($dbc, $sql);
        
        if($query){
          $row = mysqli_fetch_array($query);
          $balance = $row['balance'];
            return json_encode(["status"=>"1", "msg"=>$balance]);
         }
        else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
}


function get_one_row_from_one_table($table,$param,$value){
        global $dbc;
        $table = secure_database($table);
        $param = secure_database($param);
        $value = secure_database($value);
        $sql = "SELECT * FROM `$table` WHERE `$param` = '$value'";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            $row = mysqli_fetch_array($query);
            return $row;
          }
          else{
             return null;
          }
}

function get_rows_from_one_table_by_id($table,$theid,$idvalue){
        global $dbc;
        $table = secure_database($table);
        $theid = secure_database($theid);
        $idvalue = secure_database($idvalue);
        $sql = "SELECT * FROM `$table` WHERE `$theid`='$idvalue'";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_one_row_from_one_table_by_two_params($table,$param,$value,$param2,$value2){
        global $dbc;
        $table = secure_database($table);
        $param = secure_database($param);
        $value = secure_database($value);
        $param2 = secure_database($param2);
        $value2 = secure_database($value2);
        $sql = "SELECT * FROM `$table` WHERE `$param` = '$value' AND `$param2` = '$value2'";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            $row = mysqli_fetch_array($query);
            return $row;
          }
          else{
             return null;
          }
}

function get_one_row_from_one_table_by_three_params($table,$param,$value,$param2,$value2,$param3,$value3){
        global $dbc;
        $table = secure_database($table);
        $param = secure_database($param);
        $value = secure_database($value);
        $param2 = secure_database($param2);
        $value2 = secure_database($value2);
         $param3 = secure_database($param3);
        $value3 = secure_database($value3);
        $sql = "SELECT * FROM `$table` WHERE `$param` = '$value' AND `$param2` = '$value2' AND `$param3` = '$value3'";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            $row = mysqli_fetch_array($query);
            return $row;
          }
          else{
             return null;
          }
}


//////functions above are replications from dbclass functions--- can be improved for better experience
function get_investments(){
        global $dbc;
        $sql = "SELECT * FROM `subscribed_packages`";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             while($row = mysqli_fetch_array($query)){
                $display[] = $row;
                //echo $row['package_id'].'<br>';
             }              
             return  json_encode(["status"=>"1", "msg"=>$display]);
          }
         else{
              return  json_encode(["status"=>"0", "msg"=>null]);
           }
}


///get total accrued profit per user
function get_all_accrued_profits_per_user($userid){
        global $dbc;
        $total_accrued_profit = 0;
        $sql = "SELECT * FROM `subscribed_packages` WHERE `user_id`='$userid'";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
        if($num > 0){
                
                while($row = mysqli_fetch_array($query)){
                    $investment_id = $row['unique_id'];
                    $getaccr = get_total_dropped_profits_per_running_investments($investment_id);
                    $getaccdec = json_decode($getaccr,true);
                    $current_accrued = $getaccdec['msg'];
                    $total_accrued_profit = $total_accrued_profit + $current_accrued;
                }
                
                 
                 return  json_encode(["status"=>"1", "msg"=>$total_accrued_profit]);
          }
         else{
                  return  json_encode(["status"=>"0", "msg"=>0]);
                  // echo "no investment found";
             
         }
        
    
}


///this is profit that drops by FT to wallet or manually pushed to wallet
function get_total_dropped_profits_per_running_investments($investment_id){
        global $dbc;
        $investment_id = secure_database($investment_id);
        $sql = "SELECT sum(profit_amount) as total FROM `added_profits_log_for_running_investments` WHERE `investment_id`='$investment_id'";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
                $row = mysqli_fetch_array($query);
                 $total = $row['total'];
                return  json_encode(["status"=>"1", "msg"=>$total]);
          }
         else{
              return  json_encode(["status"=>"0", "msg"=>0]);
           }
}


///money to be liquidated
function get_liquidated_amount($investment_id){
        global $dbc;
        $investment_id = secure_database($investment_id);
        $sql = "SELECT sum(amount_to_be_liquidated) as total FROM `liquidated_investments_tbl` WHERE `investment_id`='$investment_id'";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
                $row = mysqli_fetch_array($query);
                 $total = $row['total'];
                return  json_encode(["status"=>"1", "msg"=>$total]);
          }
         else{
              return  json_encode(["status"=>"0", "msg"=>0]);
           }
}


///send liquidation request for admins to act on
function send_liquidation_request($investment_id,$user_id,$amount_tobe_added,$days_so_far){
    global $dbc;
    $investment_id = secure_database($investment_id);
    $user_id = secure_database($user_id);
    $amount_tobe_added = secure_database($amount_tobe_added);
    $days_so_far = secure_database($days_so_far);
    
    $check_entry = check_row_exists_by_one_param('liquidated_investments_tbl','investment_id',$investment_id);
    if($check_entry){
        return  json_encode(["status"=>"0", "msg"=>"exists"]);
    }else{
        
                $sql = "INSERT INTO `liquidated_investments_tbl` SET
                `investment_id`='$investment_id',
                `user_id`='$user_id',
                `amount_to_be_liquidated`='$amount_tobe_added',
                `days_so_far`='$days_so_far',
                `date_created`=now()
                ";
                $qry = mysqli_query($dbc,$sql);
                
                //update subscribed packages
                $sqlupdate = "UPDATE `subscribed_packages` SET `liquidation_status`=1 WHERE  `unique_id`='$investment_id'";
                $qryupdate = mysqli_query($dbc,$sqlupdate);
                
                if($qry == true && $qryupdate == true ){
                return  json_encode(["status"=>"1", "msg"=>"success"]);
                }else{
                return  json_encode(["status"=>"0", "msg"=>"failed"]);
                }
        
    }
    
}
    
   ///details of a single liquidated investment    
   function get_single_liquidated_investment($investment_id){
       global $dbc;
        $investment_id = secure_database($investment_id);
        $sql = "SELECT * FROM `liquidated_investments_tbl` WHERE `investment_id`='$investment_id'";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num == 1){
                $row = mysqli_fetch_array($query);
                return  json_encode(["status"=>"1", "msg"=>$row]);
          }
         else{
              return  json_encode(["status"=>"0", "msg"=>null]);
           }
       
   } 
  
    
    
///this is the last function that runs to confirm liquidation of that investment
function confirm_liquidated_investment($amount_to_be_liquidated, $investment_id, $user_id){
  global $dbc;
  $investment_id = secure_database($investment_id);
  $user_id = secure_database($user_id);

  //update process status of `liquidated_investments_tbl` to 2-completed
  //
  //update user wallet +
  //get current user wallet balance $get_single_liquidated_investment = 
  $get_wallet_balance = json_decode(get_wallet_balance($user_id),true)['msg'];
  //$get_liquidated_amount = json_decode(get_liquidated_amount($investment_id),true)['msg'];
  $newbal = $get_wallet_balance + $amount_to_be_liquidated;
         
         
  $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE  `user_id`='$user_id'";
  $qryupdatew = mysqli_query($dbc,$sqlupdatew);

  $sqlupdate2 = "UPDATE `liquidated_investments_tbl` SET `process_status`=2,`amount_to_be_liquidated`='$amount_to_be_liquidated' WHERE  `investment_id`='$investment_id'";
  $qryupdate2 = mysqli_query($dbc,$sqlupdate2);

  if($qryupdatew == true && $qryupdate2 == true ){
    return  json_encode(["status"=>"1", "msg"=>"success"]);
  }
  else{
    return  json_encode(["status"=>"0", "msg"=>"failed"]);
  }
       
}

function confirm_liquidated_investment_new($amount_to_be_liquidated, $days_so_far, $investment_id, $user_id){
  global $dbc;
  $investment_id = secure_database($investment_id);
  $user_id = secure_database($user_id);

  //update process status of `liquidated_investments_tbl` to 2-completed
  //
  //update user wallet +
  //get current user wallet balance $get_single_liquidated_investment = 
  $get_wallet_balance = json_decode(get_wallet_balance($user_id),true)['msg'];
  //$get_liquidated_amount = json_decode(get_liquidated_amount($investment_id),true)['msg'];
  $newbal = $get_wallet_balance + $amount_to_be_liquidated;
         
         
  $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE  `user_id`='$user_id'";
  $qryupdatew = mysqli_query($dbc,$sqlupdatew);

  $sqlupdate2 = "UPDATE `liquidated_investments_tbl` SET `process_status`=2, `days_so_far` = '$days_so_far', `amount_to_be_liquidated` = '$amount_to_be_liquidated' WHERE  `investment_id`='$investment_id'";
  $qryupdate2 = mysqli_query($dbc,$sqlupdate2);

  if($qryupdatew == true && $qryupdate2 == true ){
    return  json_encode(["status"=>"1", "msg"=>"success"]);
  }
  else{
    return  json_encode(["status"=>"0", "msg"=>"failed"]);
  }
       
}
   
// checks if the investment is on i.e current date is >= invst start date
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


// checks if the investment is on i.e current date is >= invst start date
function check_if_investment_is_on_backdate($date_created,$moratorium){
      //now check if current date is greater than date_created + moratorium
         $current_date = date('Y-m-d');
        if($moratorium == 0){
         $day_investment_starts_to_count = date('Y-m-d',strtotime($date_created. ' + 1 days'));
        }
        else{
          $day_investment_starts_to_count = date('Y-m-d', strtotime($date_created. ' + '.$moratorium.' days'));    
        }
        
        ///the current date check to know if invst has started
        if( $day_investment_starts_to_count  > $current_date ){
            return false;
        }else{
            return true;
        }
}



// checks if the investment has not ended
 function check_end_date_status($tenure_of_product,$date_created,$moratorium){
       $current_date = date('Y-m-d');
        if($moratorium == 0){
         $day_investment_starts_to_count = date('Y-m-d',strtotime($date_created. ' + 1 days'));
        }
        else{
          $day_investment_starts_to_count = date('Y-m-d', strtotime($date_created. ' + '.$moratorium.' days'));    
        }
        
        if($tenure_of_product != "inf")
        {
            $end_date = date('Y-m-d', strtotime($day_investment_starts_to_count. ' + '.($tenure_of_product - 1).' days')) ;
            
            ///investment is still on
            if($current_date <= $end_date ){
                return true;
            }else{
                return false;
            }
            
        } else{
            //it means no enddate
            return true;
        }
        
}


///get the actual start date of the investment after moratoriuum(waiting period) is over
function get_investment_start_date($date_created,$moratorium){
        // $current_date = date('Y-m-d');
        if($moratorium == 0){
         $date_investment_starts_to_count = date('Y-m-d',strtotime($date_created. ' + 1 days'));
        }
        else{
          $date_investment_starts_to_count = date('Y-m-d', strtotime($date_created. ' + '.$moratorium.' days'));    
        }
        return $date_investment_starts_to_count;
}



//run it as a cron for fixed packages that are still running
function implement_fixed_float_time_profit_addition_TEST(){
        global $dbc;
         $current_date = date('Y-m-d');
        $sql = "SELECT * FROM `subscribed_packages` WHERE `liquidation_status`=0 AND `unique_id`='80a77dc09cbb7f25ce35f0e720bf0006'";
        $query = mysqli_query($dbc, $sql);
        while($getinvst = mysqli_fetch_array($query)){
            
                    //package details::
                    $package_details  =  get_one_row_from_one_table('package_definition','unique_id',$getinvst['package_id']);
                    $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$getinvst['user_id']);
            
                    // First Check if fixed or recurrent
                    if($getinvst['package_type'] == "1"){
                       $check_if_investment_is_on =  check_if_investment_is_on($getinvst['date_created'],$getinvst['moratorium']);
                       $check_end_date_status = check_end_date_status($getinvst['tenure_of_product'] , $getinvst['date_created'], $getinvst['moratorium'] );
                      
                    if($check_if_investment_is_on == true && $check_end_date_status == true){
                       //also check end date status
                       
                            $profit_per_day = $getinvst['package_unit_price'] * $getinvst['no_of_slots_bought'] * $getinvst['multiplying_factor'];
                            $investment_start_date = get_investment_start_date($getinvst['date_created'],$getinvst['moratorium']);
                            $current_float_date = date('Y-m-d', strtotime($investment_start_date. ' + '.$getinvst['float_time_incremental'].' days'));  
                           
                            
                            //this check if the current date is a ft date
                            // if($current_date == $current_float_date  ){
                            if($current_float_date == "2021-03-06"  ){
                                
                                ///check sum of previously added profits + this current one IF greater than expected profit for a finite investmen, DONT run
                            
                                
                                
                                //push profits to added_profits_log_for_running_investments
                                $investment_id = $getinvst['unique_id'];
                                $user_id = $getinvst['user_id'];
                                $flt = $getinvst['float_time'];
                                $profit_to_add = $profit_per_day * $flt;
                                $sql_add_profits = "INSERT INTO `added_profits_log_for_running_investments` SET 
                                  `investment_id`='$investment_id',
                                  `profit_amount`='$profit_to_add',
                                  `addition_type`=2,
                                  `date_added`=now()
                                ";
                                $qry_add_profits = mysqli_query($dbc,$sql_add_profits);
                                
                                
                                //also update wallet balance to current + $profit_to_add
                                $get_wallet_balance = json_decode(get_wallet_balance($user_id),true)['msg'];
                                $newbal = $get_wallet_balance + $profit_to_add;
                                $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE `user_id`='$user_id'";
                                $qryupdatew = mysqli_query($dbc,$sqlupdatew);
                                
                                //update ft to ft*2 in subscribed packageses tbl
                                $newft = $getinvst['float_time_incremental'] + $flt;
                                $sqlupdateft = "UPDATE `subscribed_packages` SET `float_time_incremental`='$newft' WHERE `unique_id`='$investment_id'";
                                $qryupdateft = mysqli_query($dbc,$sqlupdateft);
                                
                                echo "<br>SUCCESS: current date:".$current_date.'---current float date:'.$current_float_date.'----start date:'.$investment_start_date."<br>";
                                
                                $email = $investor_details['email'];
                                // $email2 = "oluwatosin.ogunleye@cloudware.ng";
                                $subject = "Float TIME for: ".$package_details['package_name'];
                                $content = "Congratulations, Float Time Working." ;
                                
                                //email_function($email, $subject, $content);
                                //email_function($email2, $subject, $content);
                                
                           }else{
                                echo "<br>FAIL222: current date:".$current_date.'---NEXT float date:'.$current_float_date.'----start date:'.$investment_start_date."<br>";
                           }
                                
                      
                        
                        
                    
                    
                    }
                    
                    else{
                       echo "<br>FAIL3333: current date:".$current_date.'---current float date:'.$current_float_date.'----start date:'.$investment_start_date."<br>";
                    }
                    
                    
                    
                    
                    }
                    
                 
            
        }
        
    //}
    
}



//run it as a cron for fixed packages that are still running
function implement_fixed_float_time_profit_addition(){
        global $dbc;
        $current_date = date('Y-m-d');
        $start_time = date('Y-m-d H:i:s');
        $sql = "SELECT * FROM `subscribed_packages` WHERE `liquidation_status`=0";
        $query = mysqli_query($dbc, $sql);
        while($getinvst = mysqli_fetch_array($query)){
            
                    //package details::
                    $package_details  =  get_one_row_from_one_table('package_definition','unique_id',$getinvst['package_id']);
                    $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$getinvst['user_id']);
            
                    // First Check if fixed or recurrent
                    if($getinvst['package_type'] == "1"){
                       $check_if_investment_is_on =  check_if_investment_is_on($getinvst['date_created'],$getinvst['moratorium']);
                       $check_end_date_status = check_end_date_status($getinvst['tenure_of_product'] , $getinvst['date_created'], $getinvst['moratorium'] );
                      
                    if($check_if_investment_is_on == true && $check_end_date_status == true){
                       //also check end date status
                       
                            $profit_per_day = $getinvst['package_unit_price'] * $getinvst['no_of_slots_bought'] * $getinvst['multiplying_factor'];
                            $investment_start_date = get_investment_start_date($getinvst['date_created'],$getinvst['moratorium']);
                            $current_float_date = date('Y-m-d', strtotime($investment_start_date. ' + '.$getinvst['float_time_incremental'].' days'));  
                           
                            
                            //this check if the current date is a ft date
                            if($current_date == $current_float_date  ){
                                
                                  ///checking cron drop
                                  $cron_count++;


                                  $investment_id = $getinvst['unique_id'];
                                  $user_id = $getinvst['user_id'];

                                  $dcurrent_time = date('Y-m-d H:i:s');
                                  $cron_uniq = unique_id_generator('cron_unique_id');
                                  $sql_insert_cron = "INSERT INTO `cron_check_for_floating_profit` SET 
                                  `unique_id`='$cron_uniq',
                                  `investment_id`='$investment_id',
                                  `user_id`='$user_id',
                                  `status`='success',
                                  `cron_json`='$cron_json',
                                  `start_time`='$start_time',
                                  `dcurrent_time`='$dcurrent_time',
                                  `current_count`='$cron_count',
                                  `date_ran`=now()
                                  ";
                                  $qry_insert_cron = mysqli_query($dbc,$sql_insert_cron); 
                                  ///checking cron drop ends

                                
                                
                                ///check sum of previously added profits + this current one IF greater than expected profit for a finite investmen, DONT run
                                //push profits to added_profits_log_for_running_investments
                              
                                $flt = $getinvst['float_time'];
                                $profit_to_add = $profit_per_day * $flt;
                                $sql_add_profits = "INSERT INTO `added_profits_log_for_running_investments` SET 
                                  `investment_id`='$investment_id',
                                  `profit_amount`='$profit_to_add',
                                  `addition_type`=2,
                                  `date_added`=now()
                                ";
                                $qry_add_profits = mysqli_query($dbc,$sql_add_profits);
                                
                                
                                //also update wallet balance to current + $profit_to_add
                                $get_wallet_balance = json_decode(get_wallet_balance($user_id),true)['msg'];
                                $newbal = $get_wallet_balance + $profit_to_add;
                                $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE `user_id`='$user_id'";
                                $qryupdatew = mysqli_query($dbc,$sqlupdatew);
                                
                                //update ft to ft*2 in subscribed packageses tbl
                                $newft = $getinvst['float_time_incremental'] + $flt;
                                $sqlupdateft = "UPDATE `subscribed_packages` SET `float_time_incremental`='$newft' WHERE `unique_id`='$investment_id'";
                                $qryupdateft = mysqli_query($dbc,$sqlupdateft);
                                
                                echo "<br>SUCCESS: current date:".$current_date.'---current float date:'.$current_float_date.'----start date:'.$investment_start_date."<br>";
                                
                                $email = $investor_details['email'];
                                // $email2 = "oluwatosin.ogunleye@cloudware.ng";
                                $subject = "Float TIME for: ".$package_details['package_name'];
                                $content = "Congratulations, Float Time Working." ;
                                
                                //email_function($email, $subject, $content);
                                //email_function($email2, $subject, $content);



                                
                           }else{
                                echo "<br>FAIL222: current date:".$current_date.'---NEXT float date:'.$current_float_date.'----start date:'.$investment_start_date."<br>";
                           }
                                
                      
                        
                        
                    
                    
                    }
                    
                    else{
                       echo "<br>FAIL3333: current date:".$current_date.'---current float date:'.$current_float_date.'----start date:'.$investment_start_date."<br>";
                    }
                    
                    
                    
                    
                    }
                    
                 
            
        }


        //$end_time = date('Y-m-d H:i:s');
      
    //}
    
}




//run it as a cron for fixed packages that are still running
function implement_fixed_float_time_profit_addition_single($investment_id){
        global $dbc;
        $sql = "SELECT * FROM `subscribed_packages` WHERE `liquidation_status`=0 AND `unique_id`='$investment_id'";
        $query = mysqli_query($dbc, $sql);
        $getinvst = mysqli_fetch_array($query);
            
                    //package details::
                    $package_details  =  get_one_row_from_one_table('package_definition','unique_id',$getinvst['package_id']);
                    $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$getinvst['user_id']);
            
                    // First Check if fixed or recurrent
                    if($getinvst['package_type'] == "1"){
                       $check_if_investment_is_on =  check_if_investment_is_on($getinvst['date_created'],$getinvst['moratorium']);
                       $check_end_date_status = check_end_date_status($getinvst['tenure_of_product'] , $getinvst['date_created'], $getinvst['moratorium'] );
                      
                    if($check_if_investment_is_on == true && $check_end_date_status == true){
                       //also check end date status
                       
                            $profit_per_day = $getinvst['package_unit_price'] * $getinvst['no_of_slots_bought'] * $getinvst['multiplying_factor'];
                            $investment_start_date = get_investment_start_date($getinvst['date_created'],$getinvst['moratorium']);
                            $current_float_date = date('Y-m-d', strtotime($investment_start_date. ' + '.$getinvst['float_time_incremental'].' days'));  
                            $current_date = date('Y-m-d');
                            
                            //this check if the current date is a ft date
                            if($current_date == $current_float_date){
                                
                                ///check sum of previously added profits + this current one IF greater than expected profit for a finite investmen, DONT run
                                //push profits to added_profits_log_for_running_investments
                                $investment_id = $getinvst['unique_id'];
                                $user_id = $getinvst['user_id'];
                                $flt = $getinvst['float_time'];
                                $profit_to_add = $profit_per_day * $flt;
                                $sql_add_profits = "INSERT INTO `added_profits_log_for_running_investments` SET 
                                   `investment_id`='$investment_id',
                                   `profit_amount`='$profit_to_add',
                                   `addition_type`=2,
                                   `date_added`=now()
                                ";
                                $qry_add_profits = mysqli_query($dbc,$sql_add_profits);
                                
                                
                                //also update wallet balance to current + $profit_to_add
                                $get_wallet_balance = json_decode(get_wallet_balance($user_id),true)['msg'];
                                $newbal = $get_wallet_balance + $profit_to_add;
                                $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE `user_id`='$user_id'";
                                $qryupdatew = mysqli_query($dbc,$sqlupdatew);
                                
                                //update ft to ft*2 in subscribed packageses tbl
                                $newft = $getinvst['float_time_incremental'] + $flt;
                                $sqlupdateft = "UPDATE `subscribed_packages` SET `float_time_incremental`='$newft' WHERE `unique_id`='$investment_id'";
                                $qryupdateft = mysqli_query($dbc,$sqlupdateft);
                                
                                echo "<br>SUCCESS: current date:".$current_date.'---current float date:'.$current_float_date.'----start date:'.$investment_start_date;
                                
                                $email = $investor_details['email'];
                                // $email2 = "oluwatosin.ogunleye@cloudware.ng";
                                $subject = "Float TIME for: ".$package_details['package_name'];
                                $content = "Congratulations, Float Time Working." ;
                                
                                //email_function($email, $subject, $content);
                                //email_function($email2, $subject, $content);
                                
                           }else{
                                echo "<br>FAIL: current date:".$current_date.'---next float date:'.$current_float_date.'----start date:'.$investment_start_date;
                           }
                                
                      
                        
                        
                    
                    
                    }
                    
                    else{
                       echo "<br>FAIL: current date:".$current_date.'---current float date:'.$current_float_date.'----start date:'.$investment_start_date;
                    }
                    
                    
                    
                    
                    }
                    
                 
            
      
    
}



//run it as a cron for recurrent packages that are still running
function implement_recurrent_float_time_profit_addition(){
     global $dbc;
        //$daily_profit = $package_unit_price * $mf * $slots_bought;
        //if(check_if_investment_is_on == true && check_end_date_status == true){
        //get current ft for that investment from subscribedpackages
        //date investment starts + currentft(from db)
        //update new ft i.e ft*2
        $sql = "SELECT * FROM `subscribed_packages` WHERE `liquidation_status`=0";
        $query = mysqli_query($dbc, $sql);
        while($getinvst = mysqli_fetch_array($query)){
            
                    //package details::
                    $package_details  =  get_one_row_from_one_table('package_definition','unique_id',$getinvst['package_id']);
                    $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$getinvst['user_id']);
            
                    // First Check if fixed or recurrent
                    if($getinvst['package_type'] == "2"){
                    $check_if_investment_is_on =  check_if_investment_is_on($getinvst['date_created'],$getinvst['moratorium']);
                     $check_end_date_status = check_end_date_status($getinvst['tenure_of_product'] , $getinvst['date_created'], $getinvst['moratorium'] );
                     
                    //push profits to added_profits_log_for_running_investments
                    $investment_id = $getinvst['unique_id'];
                    $user_id = $getinvst['user_id'];
                      
                    if($check_if_investment_is_on == true && $check_end_date_status == true){
                       //also check end date status
                          
                            
                            $profit_to_add_sql = "SELECT sum(profit_today) as `profit_total` FROM `recurrent_investments_tbl` WHERE `investment_id`='$investment_id'  AND `to_wallet_status`=0";
                            $profit_to_add_qry = mysqli_query($dbc,$profit_to_add_sql);
                            $profit_to_add_row = mysqli_fetch_array($profit_to_add_qry);
                            $profit_to_add = $profit_to_add_row['profit_total'];
                            
                            $investment_start_date = get_investment_start_date($getinvst['date_created'],$getinvst['moratorium']);
                            $current_float_date = date('Y-m-d', strtotime($investment_start_date. ' + '.$getinvst['float_time_incremental'].' days'));  
                            $current_date = date('Y-m-d');
                            
                            //this check if the current date is a ft date
                            if($current_date == $current_float_date){
                                
                                ///check sum of previously added profits + this current one IF greater than expected profit for a finite investmen, DONT run
                                
                                // $profit_amount = $getinvst['profit_amount'];
                                $sql_add_profits = "INSERT INTO `added_profits_log_for_running_investments` SET 
                                   `investment_id`='$investment_id',
                                   `profit_amount`='$profit_to_add',
                                   `addition_type`=2,
                                   `date_added`=now()
                                ";
                                $qry_add_profits = mysqli_query($dbc,$sql_add_profits);
                                
                                
                              //also update wallet balance to current + $profit_to_add
                                $get_wallet_balance = json_decode(get_wallet_balance($user_id),true)['msg'];
                                $newbal = $get_wallet_balance + $profit_to_add;
                                $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE  `user_id`='$user_id'";
                                $qryupdatew = mysqli_query($dbc,$sqlupdatew);
                                
                                ////set transfered profit as 0, so next time, it comes as 0
                                $update_recurrent_invst = "UPDATE `recurrent_investments_tbl` SET `to_wallet_status`=1 WHERE `investment_id`='$investment_id'";
                                $update_recurrent_invst_qry = mysqli_query($dbc,$update_recurrent_invst);
                                
                                //update ft to ft*2 in subscribed packageses tbl
                                $newft = $getinvst['float_time_incremental'] + $getinvst['float_time'];
                                $sqlupdateft = "UPDATE `subscribed_packages` SET `float_time_incremental`='$newft' WHERE  `unique_id`='$investment_id'";
                                $qryupdateft = mysqli_query($dbc,$sqlupdateft);
                                
                                echo "<br>SUCCESS: current date:".$current_date.'---current float date:'.$current_float_date.'----start date:'.$investment_start_date;
                                
                                $email = $investor_details['email'];
                                // $email2 = "oluwatosin.ogunleye@cloudware.ng";
                                $subject = "Float TIME for: ".$package_details['package_name'];
                                $content = "Congratulations, Float Time Working." ;
                                
                                //email_function($email, $subject, $content);
                                //email_function($email2, $subject, $content);
                                
                           }else{
                                echo "<br>FAIL: current date:".$current_date.'---current float date:'.$current_float_date.'----start date:'.$investment_start_date;
                           }
                                
                      
                        
                        
                    
                    
                    }
                    
                    else{
                       echo "<br>FAIL: current date:".$current_date.'---current float date:'.$current_float_date.'----start date:'.$investment_start_date;
                    }
                    
                    
                    
                    
                    }
                    
                 
            
        }
        
    //}
    
}

//amount deducted for recurrent
function recurrent_amount_deducted_today($user_id,$amount_to_deduct_recurrently){
            global $dbc;
            $get_wallet_balance = json_decode(get_wallet_balance($user_id),true)['msg'];
            if($get_wallet_balance >= $amount_to_deduct_recurrently){
              $amount_deducted_today = $amount_to_deduct_recurrently;
              $new_wallbal = $get_wallet_balance - $amount_deducted_today;
            }else if(  ($get_wallet_balance < $amount_to_deduct_recurrently) && ($get_wallet_balance > 0)  ){
              $amount_deducted_today = $get_wallet_balance;
              $new_wallbal = 0;
            }else{
              $amount_deducted_today = 0;
              $new_wallbal = 0;
            } 
            
        //// UPDATE wallet balance
         $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$new_wallbal' WHERE  `user_id`='$user_id'";
         $qryupdatew = mysqli_query($dbc,$sqlupdatew);
         
         //now return amount deducted tdoay
         return $amount_deducted_today;
        
        
        
}


///all contributions per investment
function recurrent_sum_of_deductions_per_investment($investment_id){
      global $dbc;
      $investment_id = secure_database($investment_id);
      
      $check_row_exists_by_one_param = check_row_exists_by_one_param('recurrent_investments_tbl','investment_id',$investment_id);
      if($check_row_exists_by_one_param){
            $sql = "SELECT sum(unit_price_today) as `unit_price_today` FROM `recurrent_investments_tbl` WHERE `investment_id`='$investment_id'";
            $query = mysqli_query($dbc, $sql);
            $num = mysqli_num_rows($query);
            if($num > 0){
            $row = mysqli_fetch_array($query);
            $unit_price_today = $row['unit_price_today'];
            return  json_encode(["status"=>"1", "msg"=>$unit_price_today]);
            }
            else{
            return  json_encode(["status"=>"0", "msg"=>0]);
            }
      }else{
           return  json_encode(["status"=>"0", "msg"=>0]);
      }
      
      
}



///all cb per rec invst
function recurrent_sum_of_cb_per_investment($investment_id){
      global $dbc;
      $investment_id = secure_database($investment_id);
      
      $check_row_exists_by_one_param = check_row_exists_by_one_param('recurrent_investments_tbl','investment_id',$investment_id);
      if($check_row_exists_by_one_param){
            $sql = "SELECT sum(capital_balance_today) as `cb` FROM `recurrent_investments_tbl` WHERE `investment_id`='$investment_id'";
            $query = mysqli_query($dbc, $sql);
            $num = mysqli_num_rows($query);
            if($num > 0){
            $row = mysqli_fetch_array($query);
            $capital_balance_today = $row['cb'];
            return  json_encode(["status"=>"1", "msg"=>$capital_balance_today]);
            }
            else{
            return  json_encode(["status"=>"0", "msg"=>0]);
            }
      }else{
           return  json_encode(["status"=>"0", "msg"=>0]);
      }
      
      
}


///all profits per rec invst..more like floating becaise recurrent dont withdrawa till end
function recurrent_sum_of_profits_per_investment($investment_id){
      global $dbc;
      $investment_id = secure_database($investment_id);
      
      $check_row_exists_by_one_param = check_row_exists_by_one_param('recurrent_investments_tbl','investment_id',$investment_id);
      if($check_row_exists_by_one_param){
            $sql = "SELECT sum(profit_today) as `totalp` FROM `recurrent_investments_tbl` WHERE `investment_id`='$investment_id'";
            $query = mysqli_query($dbc, $sql);
            $num = mysqli_num_rows($query);
            if($num > 0){
            $row = mysqli_fetch_array($query);
            $totalp = $row['totalp'];
            return  json_encode(["status"=>"1", "msg"=>$totalp]);
            }
            else{
            return  json_encode(["status"=>"0", "msg"=>0]);
            }
      }else{
           return  json_encode(["status"=>"0", "msg"=>0]);
      }
      
      
}


function recurrent_details_per_investment($investment_id){
      global $dbc;
      $investment_id = secure_database($investment_id);
          
            $sql = "SELECT * FROM `recurrent_investments_tbl` WHERE `investment_id`='$investment_id'";
            $query = mysqli_query($dbc, $sql);
            $num = mysqli_num_rows($query);
            if($num > 0){
               while($row = mysqli_fetch_array($query)){
                $display[] = $row;
             }              
             return  $display;
            }
            else{
            return  null;
            }
      
      
      
}



////runs as cron:::
///daily,weekly,monthly
function recurrent_deduct_from_wallet_to_investment(){
        global $dbc;
        $sql = "SELECT * FROM `subscribed_packages` WHERE `liquidation_status`=0  AND `package_type`='2' ";
        $query = mysqli_query($dbc, $sql);
        while($getinvst = mysqli_fetch_array($query)){
            
                    ////packages and investors
                    $package_details  =  get_one_row_from_one_table('package_definition','unique_id',$getinvst['package_id']);
                    $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$getinvst['user_id']);
    
                     //check start date and also check end date status
                     $check_if_investment_is_on =  check_if_investment_is_on($getinvst['date_created'],$getinvst['moratorium']);
                     $check_end_date_status = check_end_date_status($getinvst['tenure_of_product'] , $getinvst['date_created'], $getinvst['moratorium'] );
                     $recurrence_count = $getinvst['recurrence_count'];
                     $recurrence_type = $getinvst['recurrence_type'];
                     $investment_id = $getinvst['unique_id'];
                     $user_id = $getinvst['user_id'];
               
                     
                    $investment_start_date = get_investment_start_date($getinvst['date_created'],$getinvst['moratorium']);
                    $current_recurrence_date = date('Y-m-d', strtotime($investment_start_date. ' + '.$recurrence_count.' days'));  
                    $current_date = date('Y-m-d');
                      
                    if($check_if_investment_is_on == true && $check_end_date_status == true){
                        
                            $amount_to_deduct_recurrently = $getinvst['package_unit_price'] * $getinvst['no_of_slots_bought'];
                            ///below function also updated wallet tbl with new bal
                            $recurrent_amount_deducted_today = recurrent_amount_deducted_today($user_id,$amount_to_deduct_recurrently);
                            ////today's profit: sum up all deductions, then add $recurrent_amount_deducted_today..this forms today's cb, then apply mf to  today's cb
                            $recurrent_sum_of_deductions_per_investment = json_decode(recurrent_sum_of_deductions_per_investment($investment_id) ,true)['msg']   +  $recurrent_amount_deducted_today;
                            
                            if($recurrent_amount_deducted_today == 0){
                            //if nothing was contributed, add no profit
                            $profit_to_add_today = 0;
                            }else{
                            $profit_to_add_today = $recurrent_sum_of_deductions_per_investment * $getinvst['multiplying_factor'];
                            }
                      
                            /////daily situation
                            if($recurrence_type == "daily"){
                                    $sql_recurrent_invst = "INSERT INTO `recurrent_investments_tbl` SET 
                                    `investment_id`='$investment_id',
                                    `unit_price_today`='$recurrent_amount_deducted_today',
                                    `capital_balance_today`='$recurrent_sum_of_deductions_per_investment',
                                    `profit_today`='$profit_to_add_today',
                                    `date_created`=now()
                                    ";
                                    $qry_add_profits = mysqli_query($dbc,$sql_recurrent_invst);
                                    
                                    $email = $investor_details['email'];
                                    //$email2 = "oluwatosin.ogunleye@cloudware.ng";
                                    $subject = "Voila, Daily Profit added to Package: ".$package_details['package_name'];
                                    $content = "Congratulations ". $investor_details['surname'].' '. $investor_details['other_names'].",
                                    Profit of N". $profit_to_add_today ." was just added today..Thank you for choosing FarmKonnect." ;
                                    
                                    //email_function($email, $subject, $content);
                                    //email_function($email2, $subject, $content);
                                    
                                    echo "SUCCESS-".$email."<br>";
                                
                            }
                            
                            
                            /////weekly situation
                            if($recurrence_type == "weekly"){
                                if($current_recurrence_date == $current_date){
                                        
                                        $sql_recurrent_invst = "INSERT INTO `recurrent_investments_tbl` SET 
                                        `investment_id`='$investment_id',
                                        `unit_price_today`='$recurrent_amount_deducted_today',
                                        `capital_balance_today`='$recurrent_sum_of_deductions_per_investment',
                                        `profit_today`='$profit_to_add_today',
                                        `date_created`=now()
                                        ";
                                        $qry_add_profits = mysqli_query($dbc,$sql_recurrent_invst);
                                        
                                        //update subscribed packages
                                        $new_rec_count = $recurrence_count + 7; ///next 7 days
                                        $sql_update_sp = "UPDATE `subscribed_packages` SET `recurrence_count`='$new_rec_count' WHERE `unique_id`='$investment_id'";
                                        $qry_update_sp = mysqli_query($dbc,$sql_update_sp);
                                        
                                        $email = $investor_details['email'];
                                        //$email2 = "oluwatosin.ogunleye@cloudware.ng";
                                        $subject = "Voila, Weekly Profit added to Package: ".$package_details['package_name'];
                                        $content = "Congratulations ". $investor_details['surname'].' '. $investor_details['other_names'].",
                                        Profit of N". $profit_to_add_today ." was just added today..Thank you for choosing FarmKonnect." ;
                                        
                                        //email_function($email, $subject, $content);
                                        //email_function($email2, $subject, $content);
                                        
                                        echo "SUCCESS-".$email."<br>";
                                       
                                    
                                    
                                    
                                }else{
                                    echo "FAIL<br>";
                                }

                                
                            }
                            
                            ////////monthly situation
                            if($recurrence_type == "monthly"){
                                if($current_recurrence_date == $current_date){
                                        
                                        $sql_recurrent_invst = "INSERT INTO `recurrent_investments_tbl` SET 
                                        `investment_id`='$investment_id',
                                        `unit_price_today`='$recurrent_amount_deducted_today',
                                        `capital_balance_today`='$recurrent_sum_of_deductions_per_investment',
                                        `profit_today`='$profit_to_add_today',
                                        `date_created`=now()
                                        ";
                                        $qry_add_profits = mysqli_query($dbc,$sql_recurrent_invst);
                                        
                                        //update subscribed packages for next deduction
                                        $new_rec_count = $recurrence_count + 30; ///next 30 days
                                        $sql_update_sp = "UPDATE `subscribed_packages` SET `recurrence_count`='$new_rec_count' WHERE `unique_id`='$investment_id'";
                                        $qry_update_sp = mysqli_query($dbc,$sql_update_sp);
                                        
                                        $email = $investor_details['email'];
                                        //$email2 = "oluwatosin.ogunleye@cloudware.ng";
                                        $subject = "Voila, Monthly Profit added to Package: ".$package_details['package_name'];
                                        $content = "Congratulations ". $investor_details['surname'].' '. $investor_details['other_names'].",
                                        Profit of N". $profit_to_add_today ." was just added today..Thank you for choosing FarmKonnect." ;
                                        
                                        //email_function($email, $subject, $content);
                                        //email_function($email2, $subject, $content);
                                        
                                        echo "SUCCESS-".$email."<br>";
                                       
                                    
                                    
                                    
                                }else{
                                    echo "FAIL<br>";
                                }

                                
                            }
                            
                            
                            
                         

                    
                    
                    }
                    
                    else{
                    echo "FAIL<br>";
                    }
                    
                    
                    
                    
                    
                    
                 
            
            
            
        }
        
    //}
    
}



////runs as cron:::weekly...
///weekly
function recurrent_weekly_deduct_from_wallet_to_investment(){
        global $dbc;
        $sql = "SELECT * FROM `subscribed_packages` WHERE `liquidation_status`=0  AND `package_type`='2' AND ``='week' ";
        $query = mysqli_query($dbc, $sql);
        while($getinvst = mysqli_fetch_array($query)){
            
                    ////packages and investors
                    $package_details  =  get_one_row_from_one_table('package_definition','unique_id',$getinvst['package_id']);
                    $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$getinvst['user_id']);
    
                     //check start date and also check end date status
                    $check_if_investment_is_on =  check_if_investment_is_on($getinvst['date_created'],$getinvst['moratorium']);
                     $check_end_date_status = check_end_date_status($getinvst['tenure_of_product'] , $getinvst['date_created'], $getinvst['moratorium'] );
                      
                    if($check_if_investment_is_on == true && $check_end_date_status == true){
                      
                      
                            $amount_to_deduct_recurrently = $getinvst['package_unit_price'] * $getinvst['no_of_slots_bought'];
                            $investment_id = $getinvst['unique_id'];
                            $user_id = $getinvst['user_id'];
                            
                            ///below function also updated wallet tbl with new bal
                            $recurrent_amount_deducted_today = recurrent_amount_deducted_today($user_id,$amount_to_deduct_recurrently);
                            
                            ////today's profit: sum up all deductions, then add $recurrent_amount_deducted_today..this forms today's cb, then apply mf to  today's cb
                            $recurrent_sum_of_deductions_per_investment = json_decode(recurrent_sum_of_deductions_per_investment($investment_id) ,true)['msg']   +  $recurrent_amount_deducted_today;
                            
                            if($recurrent_amount_deducted_today == 0){
                                //if nothing was contributed, add no profit
                                $profit_to_add_today = 0;
                            }else{
                                 $profit_to_add_today = $recurrent_sum_of_deductions_per_investment * $getinvst['multiplying_factor'];
                            }
                           
                            
                                
                               
                                $sql_recurrent_invst = "INSERT INTO `recurrent_investments_tbl` SET 
                                   `investment_id`='$investment_id',
                                   `unit_price_today`='$recurrent_amount_deducted_today',
                                   `capital_balance_today`='$recurrent_sum_of_deductions_per_investment',
                                   `profit_today`='$profit_to_add_today',
                                   `date_created`=now()
                                ";
                                $qry_add_profits = mysqli_query($dbc,$sql_recurrent_invst);
                                
                                $email = $investor_details['email'];
                                //$email2 = "oluwatosin.ogunleye@cloudware.ng";
                                $subject = "Voila, Profit added to Package: ".$package_details['package_name'];
                                $content = "Congratulations ". $investor_details['surname'].' '. $investor_details['other_names'].",
                                Profit of N". $profit_to_add_today ." was just added today..Thank you for choosing FarmKonnect." ;
                                
                               
                                
                                 //email_function($email, $subject, $content);
                                 //email_function($email2, $subject, $content);
                                
                                 echo "SUCCESS-".$email."<br>";
                                
                              
                               
                                
                           
                                
                      
                        
                        
                    
                    
                    }
                    
                    else{
                    echo "FAIL<br>";
                    }
                    
                    
                    
                    
                    
                    
                 
            
            
            
        }
        
    //}
    
}

///getting details of all your expected recurrent fininte investments--NOT really needed now
function recurrent_total_expected_investment_details_finite(){
        global $dbc;
        $sql = "SELECT * FROM `subscribed_packages` WHERE `liquidation_status`=0  AND `package_type`='2' ";
        $query = mysqli_query($dbc, $sql);
        while($getinvst = mysqli_fetch_array($query)){
            
                    ////packages and investors
                    $package_details  =  get_one_row_from_one_table('package_definition','unique_id',$getinvst['package_id']);
                    $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$getinvst['user_id']);
    
                     //check start date and also check end date status
                    $check_if_investment_is_on =  check_if_investment_is_on($getinvst['date_created'],$getinvst['moratorium']);
                     $check_end_date_status = check_end_date_status($getinvst['tenure_of_product'] , $getinvst['date_created'], $getinvst['moratorium'] );
                     $tenure_of_product = $getinvst['tenure_of_product'];
                     $multiplying_factor = $getinvst['multiplying_factor'];
                     $package_name = $package_details['package_name'];
                      
                    if($check_if_investment_is_on == true && $check_end_date_status == true){
                           
                           //for finite recurrent investments
                           if($getinvst['tenure_of_product'] != 'inf'  ){
                                   $j = $k - 1; 
                                    $output  = '';
                                    
                                    $amount_to_deduct_recurrently = $getinvst['package_unit_price'] * $getinvst['no_of_slots_bought'];    
                                    $totalcb = 0;
                                    $profit_so_far = 0;
                                    for($i =1; $i <=  $tenure_of_product; $i++){
                                        $totalcb = $totalcb + $amount_to_deduct_recurrently; 
                                        $profit_today = $totalcb * $multiplying_factor;
                                        $profit_so_far = $profit_so_far + $profit_today;
                                    
                                  
                                      
                                      $output .= 'tenure: '.$tenure_of_product.'package:'.$package_name.':  '.$amount_to_deduct_recurrently.'::::::::CB Today:'.$totalcb.' Profit today: '.$profit_today.'  Profit So Far: '.$profit_so_far.'<br><br><br>';
                              
                                    }
                                    
                                    $output .= "ANOTHER INVESTMENT STARTS<hr><hr>";
                                    $totalcb = 0;
                                    $profit_so_far = 0;
                                    
                                    
                                    echo $output;
                           }
                           
                           
                            
                         
                                
               
                    
                    }
                    
                    else{
                    echo "FAIL<br>";
                    }
                    
        
            
        }
        
    //}
    
}



function recurrent_total_expected_investment_details_per_investment_finite($investment_id){
        global $dbc;
        $sql = "SELECT * FROM `subscribed_packages` WHERE `liquidation_status`=0  AND `package_type`='2' AND `unique_id`='$investment_id'";
        $query = mysqli_query($dbc, $sql);
        $getinvst = mysqli_fetch_array($query);
     
            
                    ////packages and investors
                    $package_details  =  get_one_row_from_one_table('package_definition','unique_id',$getinvst['package_id']);
                    $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$getinvst['user_id']);
    
                     //check start date and also check end date status
                    $check_if_investment_is_on =  check_if_investment_is_on($getinvst['date_created'],$getinvst['moratorium']);
                     $check_end_date_status = check_end_date_status($getinvst['tenure_of_product'] , $getinvst['date_created'], $getinvst['moratorium'] );
                     $tenure_of_product = $getinvst['tenure_of_product'];
                     $multiplying_factor = $getinvst['multiplying_factor'];
                     $package_name = $package_details['package_name'];
                      
                    if($check_if_investment_is_on == true && $check_end_date_status == true){
                           
                           //for finite recurrent investments
                           if($getinvst['tenure_of_product'] != 'inf'  ){
                                   $j = $k - 1; 
                                    $output  = '';
                                    
                                    $amount_to_deduct_recurrently = $getinvst['package_unit_price'] * $getinvst['no_of_slots_bought'];    
                                    $totalcb = 0;
                                    $profit_so_far = 0;
                                    for($i =1; $i <=  $tenure_of_product; $i++){
                                        $totalcb = $totalcb + $amount_to_deduct_recurrently; 
                                        $profit_today = $totalcb * $multiplying_factor;
                                        $profit_so_far = $profit_so_far + $profit_today;
                                    
                                  
                                      
                                      //$output .= 'tenure: '.$tenure_of_product.'package:'.$package_name.':  '.$amount_to_deduct_recurrently.'::::::::CB Today:'.$totalcb.' Profit today: '.$profit_today.'  Profit So Far: '.$profit_so_far.'<br><br><br>';
                              
                                    }
                                    
                                 return json_encode([ "status"=>"1", "tenure"=>$tenure_of_product, "package"=>$package_name, "contribution_every_day"=>$amount_to_deduct_recurrently, "total_cb"=>$totalcb, "profit_today"=>$profit_today, "total_profit"=>$profit_so_far]);
                    
                           }else{
                                  
                                   return json_encode([ "status"=>"0","msg"=>"Infinite"]); ///should not run for any reason
                    
                           }
                           
                         
                            
                         
                                
               
                    
                    }
                    
                    else{
                    return json_encode([ "status"=>"0","msg"=>"Sorry your investment is either yet to start or over"]); ///should not run for any reason
                    }
                    
        
            
      
    
}

////infinte--just display profit details so far
function recurrent_total_expected_investment_details_per_investment_infinite($investment_id){
        global $dbc;
        $sql = "SELECT * FROM `subscribed_packages` WHERE `liquidation_status`=0  AND `package_type`='2' AND `unique_id`='$investment_id'";
        $query = mysqli_query($dbc, $sql);
        $getinvst = mysqli_fetch_array($query);
     
            
                    ////packages and investors
                    $package_details  =  get_one_row_from_one_table('package_definition','unique_id',$getinvst['package_id']);
                    $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$getinvst['user_id']);
    
                     //check start date and also check end date status
                    $check_if_investment_is_on =  check_if_investment_is_on($getinvst['date_created'],$getinvst['moratorium']);
                     $check_end_date_status = check_end_date_status($getinvst['tenure_of_product'] , $getinvst['date_created'], $getinvst['moratorium'] );
                     $tenure_of_product = $getinvst['tenure_of_product'];
                     $multiplying_factor = $getinvst['multiplying_factor'];
                     $package_name = $package_details['package_name'];
                      
                    if($check_if_investment_is_on == true && $check_end_date_status == true){
                           
                           //for finite recurrent investments
                           if($getinvst['tenure_of_product'] == 'inf'  ){
                                   $j = $k - 1; 
                                   
                                        ///get from db
                                        $amount_to_deduct_recurrently = $getinvst['package_unit_price'] * $getinvst['no_of_slots_bought'];    
                                        $totalcb = 0;
                                        $profit_so_far = 0;
                                   
                                        $totalcb = $totalcb + $amount_to_deduct_recurrently; 
                                        $profit_today = $totalcb * $multiplying_factor;
                                        $profit_so_far = $profit_so_far + $profit_today;
                                   
                                        return json_encode([ "status"=>"1", "tenure"=>$tenure_of_product, "package"=>$package_name, "contribution_every_day"=>$amount_to_deduct_recurrently, "total_cb"=>$totalcb, "profit_today"=>$profit_today, "total_profit"=>$profit_so_far]);
                    
                           }else{
                                  
                                   return json_encode([ "status"=>"0","msg"=>"finite"]); ///should not run for any reason
                    
                           }
                           
                         
                            
                         
                                
               
                    
                    }
                    
                    else{
                    return json_encode([ "status"=>"0","msg"=>"Sorry your investment is either yet to start or over"]); ///should not run for any reason
                    }
                    
        
            
      
    
}





//for fixed packages for now
function get_details_for_a_running_investment($investment_id){
    global $dbc;
    $sql = "SELECT * FROM `subscribed_packages` WHERE `unique_id`='$investment_id' AND `liquidation_status`=0";
    $qry = mysqli_query($dbc,$sql);
    $getdet = mysqli_fetch_array($qry);
    //$getpackdet  =  get_one_row_from_one_table('package_definition','unique_id',$investment_id);
    $liquid_stat = $getdet['liquidation_status'];
    $packtype = $getdet['package_type'];
    $pack_unitp = $getdet['package_unit_price'];
    $no_of_slots_bought = $getdet['no_of_slots_bought'];
    $moratorium = $getdet['moratorium'];
    $multiplying_factor = $getdet['multiplying_factor'];
    $total_amount = $getdet['total_amount'];
    $float_time = $getdet['float_time']; //in days
    $packtype = $getdet['package_type'];
    $date_created = $getdet['date_created'];
    $tenure_of_product = $getdet['tenure_of_product'];
    
    //$getpackdet  =  get_one_row_from_one_table('package_definition','unique_id',$investment_id);
    //$package_name = $getpackdet['package_name'];
    
    $current_date = date('Y-m-d');
    $date_created =  date('Y-m-d',strtotime($date_created));
    
    if($current_date < $date_created) {
    return json_encode([ "status"=>"0","msg"=>"Backdate cannot be greater than current date"]); 
    } 
   
    // else if($packtype == '2'){
    
    // return json_encode([ "status"=>"0","msg"=>"Backdate is not allowed for Recurrent Packages currently"]); 
   
    // }
    
    else{
        
        
                     $check_if_investment_is_on =  check_if_investment_is_on($date_created,$moratorium);
                     $check_end_date_status = check_end_date_status($tenure_of_product,$date_created,$moratorium);
   
                     //investment is still within running confines
                    if($check_if_investment_is_on == true   && $check_end_date_status == true) {
                        $profit_per_day = $total_amount * $multiplying_factor;
                        $date_investment_starts =  get_investment_start_date($date_created,$moratorium);    ///////this is after moratorium has been applied
                      
                        $date_so_far = strtotime($current_date) - strtotime($date_investment_starts);
                        $days_so_far = round($date_so_far / (60 * 60 * 24));  //////verify wwheter to add 1 or not
                        $total_profit_so_far = $profit_per_day * $days_so_far;
                        $floating_days = $days_so_far % $float_time; 
                        $floating_profit = $profit_per_day * $floating_days;
                        $accrued_days = $days_so_far - $floating_days; 
                        $accrued_profit = $profit_per_day * $accrued_days;
                        
                        
                       return json_encode([ "status"=>"1",
                                        "msg"=>"success",
                                        "profit_per_day"=>$profit_per_day,
                                        "days_so_far"=>$days_so_far,
                                        "total_profit_so_far"=>$total_profit_so_far,
                                        "floating_days"=>$floating_days,
                                        "floating_profit"=>$floating_profit,
                                        "accrued_days"=>$accrued_days,
                                        "accrued_profit"=>$accrued_profit,
                                        "date_investment_starts"=>$date_investment_starts,
                                        "withdrawal"=>"0"
                                        ]);
                        
                        
                        
                        
                        
                    }else{
                      
                          return json_encode([ "status"=>"0","msg"=>"Sorry, Investment has either not started or has ended"]); 
                    }
        
        
    }
}


///we were not sure if the above of this has been used somewhere before
function get_details_for_a_running_investment2($investment_id){
    global $dbc;
    // $sql = "SELECT * FROM `subscribed_packages` WHERE `unique_id`='$investment_id' AND `liquidation_status`=0";
    // $qry = mysqli_query($dbc,$sql);
    // $getdet = mysqli_fetch_array($qry);
    $getdet  =  get_one_row_from_one_table('subscribed_packages','unique_id',$investment_id);
    $liquid_stat = $getdet['liquidation_status'];
    $packtype = $getdet['package_type'];
    $pack_unitp = $getdet['package_unit_price'];
    $no_of_slots_bought = $getdet['no_of_slots_bought'];
    $moratorium = $getdet['moratorium'];
    $multiplying_factor = $getdet['multiplying_factor'];
    $total_amount = $getdet['total_amount'];
    $float_time = $getdet['float_time']; //in days
    $packtype = $getdet['package_type'];
    $date_created = $getdet['date_created'];
    $tenure_of_product = $getdet['tenure_of_product'];
    
    //$getpackdet  =  get_one_row_from_one_table('package_definition','unique_id',$investment_id);
    //$package_name = $getpackdet['package_name'];
    
    $current_date = date('Y-m-d');
    $date_created =  date('Y-m-d',strtotime($date_created));
    
    // if($current_date < $backdate) {
    // return json_encode([ "status"=>"0","msg"=>"Backdate cannot be greater than current date"]); 
    // } 
   
    // else if($packtype == '2'){
    
    // return json_encode([ "status"=>"0","msg"=>"Backdate is not allowed for Recurrent Packages currently"]); 
   
    // }
    
   // else{
        
        
                     $check_if_investment_is_on =  check_if_investment_is_on($date_created,$moratorium);
                     $check_end_date_status = check_end_date_status($tenure_of_product,$date_created,$moratorium);
   
                     //investment is still within running confines
                    if($check_if_investment_is_on == true   && $check_end_date_status == true) {
                        $profit_per_day = $total_amount * $multiplying_factor;
                        $date_investment_starts =  get_investment_start_date($date_created,$moratorium);    ///////this is after moratorium has been applied
                      
                        $date_so_far = strtotime($current_date) - strtotime($date_investment_starts);
                        $days_so_far = round($date_so_far / (60 * 60 * 24));  //////verify wwheter to add 1 or not
                        $total_profit_so_far = $profit_per_day * $days_so_far;
                        $floating_days = $days_so_far % $float_time; 
                        $floating_profit = $profit_per_day * $floating_days;
                        $accrued_days = $days_so_far - $floating_days; 
                        $accrued_profit = $profit_per_day * $accrued_days;
                        
                        
                       return json_encode([ "status"=>"1",
                                        "msg"=>"success",
                                        "profit_per_day"=>$profit_per_day,
                                        "days_so_far"=>$days_so_far,
                                        "total_profit_so_far"=>$total_profit_so_far,
                                        "floating_days"=>$floating_days,
                                        "floating_profit"=>$floating_profit,
                                        "accrued_days"=>$accrued_days,
                                        "accrued_profit"=>$accrued_profit,
                                        "date_investment_starts"=>$date_investment_starts,
                                        "withdrawal"=>"0"
                                        ]);
                        
                        
                        
                        
                        
                    }else{
                      
                          return json_encode([ "status"=>"0","msg"=>"Sorry, Investment has either not started or has ended"]); 
                    }
        
        
    //}
}


///this function gets all the required details to help IM backdate a recurrent investment///////for RECURRENT
function get_details_for_backdate_rec($backdated_date,$investment_id,$contribut_days){
    global $dbc;
    $sql = "SELECT * FROM `subscribed_packages` WHERE `unique_id`='$investment_id'";
    $qry = mysqli_query($dbc,$sql);
    $getdet = mysqli_fetch_array($qry);
    
    $liquid_stat = $getdet['liquidation_status'];
    $packtype = $getdet['package_type'];
    
    $pack_unitp = $getdet['package_unit_price'];
    $no_of_slots_bought = $getdet['no_of_slots_bought'];
    $moratorium = $getdet['moratorium'];
    $multiplying_factor = $getdet['multiplying_factor'];
    $per_contribution_amount = $pack_unitp * $no_of_slots_bought; //per day contribution
    $float_time = $getdet['float_time']; //in days
    $packtype = $getdet['package_type'];
    $tenure_of_product = $getdet['tenure_of_product'];
    
    $current_date = date('Y-m-d');
    $backdate =  date('Y-m-d',strtotime($backdated_date));
    
   
    
    if($liquid_stat == '1'){
    return json_encode([ "status"=>"0","msg"=>"Has been liquidated"]);
    }
    
    else if($current_date < $backdate) {
    return json_encode([ "status"=>"0","msg"=>"Backdate cannot be greater than current date"]); 
    } 
   
    // else if($packtype == '2'){
    
    // return json_encode([ "status"=>"0","msg"=>"Backdate is not allowed for Recurrent Packages currently"]); 
   
    // }
    
    else{
        
        
                     $check_if_investment_is_on =  check_if_investment_is_on_backdate($backdate,$moratorium);
                     $check_end_date_status = check_end_date_status($tenure_of_product,$backdate,$moratorium);
   
                     //investment is still within running confines
                    if($check_if_investment_is_on == true   && $check_end_date_status == true) {
                        
                       
                      
                        //$date_so_far = strtotime($current_date) - strtotime($date_investment_starts);
                        //$days_so_far = round($date_so_far / (60 * 60 * 24));  //////verify wwheter to add 1 or not
                        //$total_profit_so_far = $profit_per_day * $days_so_far;
                        //$floating_days = $days_so_far % $float_time;  total_profit
                        // $floating_profit = $profit_per_day * $floating_days;
                        // $accrued_days = $days_so_far - $floating_days; 
                        // $accrued_profit = $profit_per_day * $accrued_days;
                       
                       
                      $date_investment_starts =  get_investment_start_date($backdate,$moratorium);    ///////this is after moratorium has been applied 
                             
                          
                           
                            $profit = 0;
                            $total_profit = 0;
                            for ($i=0; $i < $contribut_days ; $i++) {
                            $profit = $profit + ($per_contribution_amount * $multiplying_factor);
                            $total_profit = $total_profit + $profit;
                            }
                            //echo round($total_profit);
                        
                       return json_encode([ "status"=>"1",
                                        "contributory_days"=>$contribut_days,
                                        "total_profit"=>round($total_profit),
                                        "contribution_per_day"=>$per_contribution_amount,
                                        "total_contributions"=>$per_contribution_amount * $contribut_days,
                                        "date_investment_starts"=>$date_investment_starts,
                                        "withdrawal"=>"0"
                                        ]);
                        
                        
                        
                        
                        
                    }else{
                      
                          return json_encode([ "status"=>"0","msg"=>"Sorry, Investment has either not started or has ended"]); 
                    }
        
        
    }
}



///this function gets all the required details to help IM backdate an investment///////for FIXED
function get_details_for_backdate($backdated_date,$investment_id){
    global $dbc;
    $sql = "SELECT * FROM `subscribed_packages` WHERE `unique_id`='$investment_id'";
    $qry = mysqli_query($dbc,$sql);
    $getdet = mysqli_fetch_array($qry);
    
    $liquid_stat = $getdet['liquidation_status'];
    $packtype = $getdet['package_type'];
    
    $pack_unitp = $getdet['package_unit_price'];
    $no_of_slots_bought = $getdet['no_of_slots_bought'];
    $moratorium = $getdet['moratorium'];
    $multiplying_factor = $getdet['multiplying_factor'];
    $total_amount = $getdet['total_amount'];
    $float_time = $getdet['float_time']; //in days
    $packtype = $getdet['package_type'];
    $tenure_of_product = $getdet['tenure_of_product'];
    
    $current_date = date('Y-m-d');
    $backdate =  date('Y-m-d',strtotime($backdated_date));
    
   
    
    if($liquid_stat == '1'){
    return json_encode([ "status"=>"0","msg"=>"Has been liquidated"]);
    }
    else if($current_date < $backdate) {
    return json_encode([ "status"=>"0","msg"=>"Backdate cannot be greater than current date"]); 
    } 
   
    // else if($packtype == '2'){
    
    // return json_encode([ "status"=>"0","msg"=>"Backdate is not allowed for Recurrent Packages currently"]); 
   
    // }
    
    else{
        
        
                     $check_if_investment_is_on =  check_if_investment_is_on_backdate($backdate,$moratorium);
                     $check_end_date_status = check_end_date_status($tenure_of_product,$backdate,$moratorium);
   
                     //investment is still within running confines
                    if($check_if_investment_is_on == true   && $check_end_date_status == true) {
                        $profit_per_day = $total_amount * $multiplying_factor;
                        $date_investment_starts =  get_investment_start_date($backdate,$moratorium);    ///////this is after moratorium has been applied
                      
                        $date_so_far = strtotime($current_date) - strtotime($date_investment_starts);
                        $days_so_far = round($date_so_far / (60 * 60 * 24));  //////verify wwheter to add 1 or not
                        $total_profit_so_far = $profit_per_day * $days_so_far;
                        $floating_days = $days_so_far % $float_time; 
                        $floating_profit = $profit_per_day * $floating_days;
                        $accrued_days = $days_so_far - $floating_days; 
                        $accrued_profit = $profit_per_day * $accrued_days;
                        
                        
                       return json_encode([ "status"=>"1",
                                        "profit_per_day"=>$profit_per_day,
                                        "days_so_far"=>$days_so_far,
                                        "total_profit_so_far"=>$total_profit_so_far,
                                        "floating_days"=>$floating_days,
                                        "floating_profit"=>$floating_profit,
                                        "accrued_days"=>$accrued_days,
                                        "accrued_profit"=>$accrued_profit,
                                        "date_investment_starts"=>$date_investment_starts,
                                        "withdrawal"=>"0"
                                        ]);
                        
                        
                        
                        
                        
                    }else{
                      
                          return json_encode([ "status"=>"0","msg"=>"Sorry, Investment has either not started or has ended"]); 
                    }
        
        
    }
}





//for recurrent
function send_backdate_investment_request_rec($invst_id,$back_date,$total_profit,$adminid,$contributory_days,$total_contributions){
       global $dbc;
       $check = check_row_exists_by_one_param("backdate_investment_maker_checker","investment_id",$invst_id);
       if($check){
           return json_encode([ "status"=>"0","msg"=>"exists"]); 
       }else{
           
            $unique_id = unique_id_generator($invst_id.$adminid);
            $unique_id2 = unique_id_generator($total_contributions.$adminid);
           
            $sql = "INSERT INTO `backdate_investment_maker_checker` SET
                `unique_id`='$unique_id',
                `investment_id`='$invst_id',
                `backdate_date`='$back_date',
                `current_accrued_profit`='0',
                `added_by`='$adminid',
                `status`=2,
                `contributory_days`='$contributory_days',
                `date_created`=now()
                ";
                $qry = mysqli_query($dbc,$sql) or die(mysqli_error($dbc));
                
                
             $sql_recurrent = "INSERT INTO `recurrent_investments_tbl` SET
            
                `investment_id`='$invst_id',
                `unit_price_today`='$total_contributions',
                `capital_balance_today`='$total_contributions',
                `profit_today`='$total_profit',
                `to_wallet_status`=0,
                `date_created`=now()
                ";
             $qry_rec = mysqli_query($dbc,$sql_recurrent) ;
                
            //or die(mysqli_error($dbc))
                
             if($qry_rec == true  ){
                     return json_encode([ "status"=>"1","msg"=>"success"]); 
                }else{
                    return json_encode([ "status"=>"0","msg"=>"server_error"]); 
                }    
                
       }
}


//for fixed
function send_backdate_investment_request($invst_id,$back_date,$current_accrued_profit,$adminid){
       global $dbc;
       $check = check_row_exists_by_one_param("backdate_investment_maker_checker","investment_id",$invst_id);
       $check_added_profit = check_row_exists_by_one_param(" added_profits_log_for_running_investments","investment_id",$invst_id);
       if($check){
           return json_encode([ "status"=>"0","msg"=>"exists"]); 
       }
       
       else if($check_added_profit){
           return json_encode([ "status"=>"0","msg"=>"exists"]); 
       }
       
       else{
            $unique_id = unique_id_generator($invst_id,$adminid);
            $sql = "INSERT INTO `backdate_investment_maker_checker` SET
                `unique_id`='$unique_id',
                `investment_id`='$invst_id',
                `backdate_date`='$back_date',
                `current_accrued_profit`='$current_accrued_profit',
                `added_by`='$adminid',
                `status`=2,
               `date_created`=now()
                ";
                $qry = mysqli_query($dbc,$sql);
                
                if($qry){
                     return json_encode([ "status"=>"1","msg"=>"success"]); 
                }else{
                    return json_encode([ "status"=>"0","msg"=>"server_error"]); 
                }
       }
}

// function send_backdate_investment_request_production($invst_id,$back_date,$current_accrued_profit,$adminid){
//       global $dbc;
//       $check = check_row_exists_by_one_param("backdate_investment_maker_checker","investment_id",$invst_id);
//       if($check){
//           return json_encode([ "status"=>"0","msg"=>"exists"]); 
//       }else{
//             $unique_id = unique_id_generator($invst_id,$adminid);
//             $sql = "INSERT INTO `backdate_investment_maker_checker` SET
//                 `unique_id`='$unique_id',
//                 `investment_id`='$invst_id',
//                 `backdate_date`='$back_date',
//                 `current_accrued_profit`='$current_accrued_profit',
//                 `added_by`='$adminid',
//                 `status`=0,
//                 `date_created`=now()
//                 ";
//                 $qry = mysqli_query($dbc,$sql);
                
//                 if($qry){
//                      return json_encode([ "status"=>"1","msg"=>"success"]); 
//                 }else{
//                     return json_encode([ "status"=>"0","msg"=>"server_error"]); 
//                 }
//       }
// }

////////final action to be performaed by accoutnat to effect backdate
///THESE BACKDATE TOOL WORKS MAJORLY FOR FIXED PACKAGES as at 09-07-2020
function complete_backdate_action($invst_id,$admin_id){
    global $dbc;
    $sql = "SELECT * FROM `backdate_investment_maker_checker` WHERE `investment_id`='$invst_id'";
    $qry = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($qry);
    if($count <= 0){
        
        return json_encode([ "status"=>"0","msg"=>"not_found"]); 
        
    }else{
        
        $row = mysqli_fetch_array($qry);
        $back_date = $row['backdate_date'];
      
        
            $get_details_for_backdate = get_details_for_backdate($back_date,$invst_id);
            $get_details_for_backdate_dec = json_decode($get_details_for_backdate,true);
            if(   $get_details_for_backdate_dec['status'] == '0' ){
                return json_encode([ "status"=>"0","msg"=>$get_details_for_backdate_dec['msg']  ]); 
            }else{
                
                 ///add current accrued profits to wallet
                  $getuserid  =  get_one_row_from_one_table('subscribed_packages','unique_id',$invst_id);
                  $investor_id = $getuserid['user_id'];
                  $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$investor_id);
                  $fname = $investor_details['other_names'];
                  $surname = $investor_details['surname'];
                 
                 //get current accrued profit: the system recomputs accrued profit based on current date...
                  $new_accrued_profit = $get_details_for_backdate_dec['accrued_profit'];  
                  $new_accrued_days = $get_details_for_backdate_dec['accrued_days']; 
                  $newfttime = $new_accrued_days + $getuserid['float_time']; 
                  
                  
                 
                 
                 //update wallet to new wallet balance
                 //get current wallet bal
                  $get_curr_wallet_balance = json_decode(get_wallet_balance($investor_id),true)['msg'];
                  $newwallbal = $get_curr_wallet_balance + $new_accrued_profit;
                  $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$newwallbal' WHERE `user_id`='$investor_id'";
                  $qryupdatew = mysqli_query($dbc,$sqlupdatew) ;
                 
                  
                  
                  ///update maker checker to 3--finallllll
                  $sqlupdate_maker_checker = "UPDATE `backdate_investment_maker_checker` SET `status`=3 WHERE `investment_id`='$invst_id'";
                  $qryupdate_maker_checker = mysqli_query($dbc,$sqlupdate_maker_checker) ;
                  
                  
                  
                  ///update date created to backdated_date -which is a day before the actual date for 0 moratorium
                  $sqlupdate_subscribed_pack = "UPDATE `subscribed_packages` SET `date_created`='$back_date',`float_time_incremental`='$newfttime' WHERE `unique_id`='$invst_id'";
                  $qryupdate_subscribed_pack = mysqli_query($dbc,$sqlupdate_subscribed_pack) ;
                  
                  
                  //push profits to added_profits_log_for_running_investments
                   $sql_add_profits = "INSERT INTO `added_profits_log_for_running_investments` SET 
                    `investment_id`='$invst_id',
                    `profit_amount`='$new_accrued_profit',
                    `addition_type`=1,
                    `added_by`='$admin_id',
                    `date_added`=now()
                    ";
                    $qry_add_profits = mysqli_query($dbc,$sql_add_profits) ;
                    
                    
                    if($qryupdatew == false ||  $qryupdate_maker_checker == false ||  $qryupdate_subscribed_pack == false ||  $qry_add_profits == false ){
                         return json_encode([ "status"=>"0","msg"=>"error_some_where"]); 
                    }else{
                           //////success mesg
                           return json_encode([ "status"=>"1","msg"=>"success"]); 
                    }
                    
                    
                 
                    
          
                 
            }
        
    }

    
}

/////////for fixed
 function undo_backdate_investment_migration($invstid,$accrued_profit){
    global $dbc;
    
    ///delete backdate inv maker checher
    $delmc = "DELETE FROM `backdate_investment_maker_checker` WHERE `investment_id`='$invstid'";
    $qrymc = mysqli_query($dbc,$delmc);
     
    ///deduct accrued profi from wallet
    //update wallet to new wallet balance
    //get current wallet bal
    $getuserid  =  get_one_row_from_one_table('subscribed_packages','unique_id',$invstid);
    $investor_id = $getuserid['user_id'];
    $float_time = $getuserid['float_time'];
    $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$investor_id);
    $fname = $investor_details['other_names'];
    $surname = $investor_details['surname'];
    $get_curr_wallet_balance = json_decode(get_wallet_balance($investor_id),true)['msg'];
    $newwallbal = $get_curr_wallet_balance - $accrued_profit;
    $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$newwallbal' WHERE `user_id`='$investor_id'";
    $qryupdatew = mysqli_query($dbc,$sqlupdatew);
     
    ///delete added profits for that investment id
    $deladdprof = "DELETE FROM `added_profits_log_for_running_investments` WHERE `investment_id`='$invstid'";
    $qryaddprof = mysqli_query($dbc,$deladdprof);
     
    ///return subscribed packages table back to now()
    $sqlupdate_subscribed_pack = "UPDATE `subscribed_packages` SET `date_created`= now(),`float_time_incremental`='$float_time' WHERE `unique_id`='$invstid'";
    $qryupdate_subscribed_pack = mysqli_query($dbc,$sqlupdate_subscribed_pack);
     
    if($qrymc == false ||  $qryupdatew == false ||  $qryaddprof == false ||  $qryupdate_subscribed_pack == false ){
            return json_encode([ "status"=>"0","msg"=>"error_some_where"]); 
    }else{
    //////success mesg
            return json_encode([ "status"=>"1","msg"=>"success"]); 
    }

 }




//by account. mm , sa for fixed
function reject_backdate_request($investmentid){
    global $dbc;
    $sql = "DELETE FROM `backdate_investment_maker_checker` WHERE `investment_id`='$investmentid'";
    $qry = mysqli_query($dbc,$sql);
    if($qry){
        return json_encode([ "status"=>"1","msg"=>"success"]);
    }else{
        return json_encode([ "status"=>"0","msg"=>"failed"]);
    }
}

///THESE BACKDATE TOOL WORKS MAJORLY FOR RECURRENT PACKAGES as at 30-07-2020
///this function gets all the required details to help IM backdate a recurrent investment///////for RECURRENT
function complete_backdate_action_rec($invst_id,$admin_id,$contribut_days){
    global $dbc;
    $sql = "SELECT * FROM `backdate_investment_maker_checker` WHERE `investment_id`='$invst_id'";
    $qry = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($qry);
    if($count <= 0){
        
        return json_encode([ "status"=>"0","msg"=>"not_found"]); 
        
    }else{
        
        $row = mysqli_fetch_array($qry);
        $back_date = $row['backdate_date'];
      
        
            $get_details_for_backdate =  get_details_for_backdate_rec($back_date,$invst_id,$contribut_days);
            $get_details_for_backdate_dec = json_decode($get_details_for_backdate,true);
            if(   $get_details_for_backdate_dec['status'] == '0' ){
                return json_encode([ "status"=>"0","msg"=>$get_details_for_backdate_dec['msg']  ]); 
            }else{
                
            ///add current accrued profits to wallet --- not needed for recurrent
            //   $getuserid  =  get_one_row_from_one_table('subscribed_packages','unique_id',$invst_id);
            //   $investor_id = $getuserid['user_id'];
            //   $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$investor_id);
            //   $fname = $investor_details['other_names'];
            //   $surname = $investor_details['surname'];
            
            //get current accrued profit: the system recomputs accrued profit based on current date...
            //$new_accrued_profit = $get_details_for_backdate_dec['accrued_profit'];
            //$new_accrued_profit = 0; //this is basal 
            
            //get all contribtions this investment
            $get_total_amount_to_deduct_from_wallet = recurrent_sum_of_deductions_per_investment($invst_id);
            $getta_dec = json_decode($get_total_amount_to_deduct_from_wallet,true);
            $amount_to_deduct = $getta_dec['msg'];
            
            
            //update wallet to new wallet balance
            //get current wallet bal
            $getuserid  =  get_one_row_from_one_table('subscribed_packages','unique_id',$invst_id);
            $investor_id = $getuserid['user_id'];
            $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$investor_id);
            $fname = $investor_details['other_names'];
            $surname = $investor_details['surname'];
            $get_curr_wallet_balance = json_decode(get_wallet_balance($investor_id),true)['msg'];
            $newwallbal = $get_curr_wallet_balance - $amount_to_deduct;
            
                if($newwallbal < 0){
                  return json_encode([ "status"=>"0","msg"=>"error_some_where"]);
                }else{
                    
                    $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$newwallbal' WHERE `user_id`='$investor_id'";
                    $qryupdatew = mysqli_query($dbc,$sqlupdatew);
                    
                    
                    
                    ///update maker checker to 3--finallllll
                    $sqlupdate_maker_checker = "UPDATE `backdate_investment_maker_checker` SET `status`=3 WHERE `investment_id`='$invst_id'";
                    $qryupdate_maker_checker = mysqli_query($dbc,$sqlupdate_maker_checker) ;
                    
                    
                    
                    ///update date created to backdated_date -which is a day before the actual date for 0 moratorium
                    $sqlupdate_subscribed_pack = "UPDATE `subscribed_packages` SET `date_created`='$back_date' WHERE `unique_id`='$invst_id'";
                    $qryupdate_subscribed_pack = mysqli_query($dbc,$sqlupdate_subscribed_pack) ;
                    
                    
                    
                    
                    //push profits to added_profits_log_for_running_investments - not needed for recurrent
                    //   $sql_add_profits = "INSERT INTO `added_profits_log_for_running_investments` SET 
                    //     `investment_id`='$invst_id',
                    //     `profit_amount`='$new_accrued_profit',
                    //     `addition_type`=1,
                    //     `added_by`='$admin_id',
                    //     `date_added`=now()
                    //     ";
                    //     $qry_add_profits = mysqli_query($dbc,$sql_add_profits) ;
                    
                    
                    if( $qryupdate_maker_checker == false ||  $qryupdate_subscribed_pack == false || $qryupdatew == false ){
                      return json_encode([ "status"=>"0","msg"=>"error_some_where"]); 
                    }else{
                    //////success mesg
                    return json_encode([ "status"=>"1","msg"=>"success"]); 
                    }
                    

                
                }
            
                                
                 
                    
          
                 
            }
        
    }

    
}



/////////for recurrent
 function undo_backdate_investment_migration_rec($invstid){
    global $dbc;
    
    //get all contribtions this investment
     $get_total_amount_to_return_to_wallet = recurrent_sum_of_deductions_per_investment($invstid);
     $getta_dec = json_decode($get_total_amount_to_return_to_wallet,true);
     $amount_to_return = $getta_dec['msg'];

     
    //update wallet to new wallet balance
    //get current wallet bal
    $getuserid  =  get_one_row_from_one_table('subscribed_packages','unique_id',$invstid);
    $investor_id = $getuserid['user_id'];
    $investor_details  =  get_one_row_from_one_table('users_tbl','unique_id',$investor_id);
    $fname = $investor_details['other_names'];
    $surname = $investor_details['surname'];
    $get_curr_wallet_balance = json_decode(get_wallet_balance($investor_id),true)['msg'];
    $newwallbal = $get_curr_wallet_balance + $amount_to_return;
    $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$newwallbal' WHERE `user_id`='$investor_id'";
    $qryupdatew = mysqli_query($dbc,$sqlupdatew);
     
    ///delete added profits for that investment id -- not need for recurrent for now
    // $deladdprof = "DELETE FROM `added_profits_log_for_running_investments` WHERE `investment_id`='$invstid'";
    // $qryaddprof = mysqli_query($dbc,$deladdprof);
     
    
    ///delete backdate inv maker checher
    $delmc = "DELETE FROM `backdate_investment_maker_checker` WHERE `investment_id`='$invstid'";
    $qrymc = mysqli_query($dbc,$delmc);
     
     
    ///delete from recurrent_investments_tbl
    $delri = "DELETE FROM `recurrent_investments_tbl` WHERE `investment_id`='$invstid'";
    $qryri= mysqli_query($dbc,$delri);
    

    ///return subscribed packages table back to now()
    $sqlupdate_subscribed_pack = "UPDATE `subscribed_packages` SET `date_created`= now() WHERE `unique_id`='$invstid'";
    $qryupdate_subscribed_pack = mysqli_query($dbc,$sqlupdate_subscribed_pack);
     
    if($qrymc == false  || $qryupdatew == false ||  $qryri == false ||  $qryupdate_subscribed_pack == false){
            return json_encode([ "status"=>"0","msg"=>"error_some_where"]); 
    }else{
    //////success mesg
            return json_encode([ "status"=>"1","msg"=>"success"]); 
    }

 }




//by account. mm , sa for recurrent
function reject_backdate_request_rec($investmentid){
    global $dbc;
    $sql = "DELETE FROM `backdate_investment_maker_checker` WHERE `investment_id`='$investmentid'";
    $qry = mysqli_query($dbc,$sql);
    
    ///delete from recurrent_investments_tbl
    $delri = "DELETE FROM `recurrent_investments_tbl` WHERE `investment_id`='$investmentid'";
    $qryri= mysqli_query($dbc,$delri);

    
    if($qry == true && $qryri == true){
        return json_encode([ "status"=>"1","msg"=>"success"]);
    }else{
        return json_encode([ "status"=>"0","msg"=>"failed"]);
    }
}




//tosin's functions start here
//send liquidation request for admins to act on
function send_transfer_of_ownership_request($owner_id, $receiver_id, $investment_id, $added_by){
  global $dbc;
  $investment_id = secure_database($investment_id);
  $owner_id = secure_database($owner_id);
  $receiver_id = secure_database($receiver_id);
  $added_by = secure_database($added_by);
  $unique_id = unique_id_generator($owner_id.$receiver_id); 
  $check_entry = check_row_exists_by_one_param('transfer_package_ownership_request','investment_id',$investment_id);
  if($owner_id == '' || $receiver_id == '' || $investment_id == '' || $added_by == ''){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else{
    if($check_entry){
        return  json_encode(["status"=>"0", "msg"=>"exists"]);
    }else if($owner_id == $receiver_id){
      return  json_encode(["status"=>"0", "msg"=>"same_id_detected"]);
    }
    else{
      $sql = "INSERT INTO `transfer_package_ownership_request` SET
      `unique_id`='$unique_id',
      `investment_id`='$investment_id',
      `owner_id`='$owner_id',
      `receiver_id`='$receiver_id',
      `added_by`='$added_by',
      `date_created`=now()
      ";
      $qry = mysqli_query($dbc,$sql) or die(mysqli_error($dbc));

      if($qry == true){
      return  json_encode(["status"=>"1", "msg"=>"success"]);
      }else{
      return  json_encode(["status"=>"0", "msg"=>"failed"]);
      }
    } 
  }   
}

function confirm_transfer_of_investment_ownership($investment_id,$receiver_id){
  global $dbc;
  $investment_id = secure_database($investment_id);
  $receiver_id = secure_database($receiver_id);

  $update_subscribed_packages_sql = "UPDATE `subscribed_packages` SET `user_id`='$receiver_id' WHERE  `unique_id`='$investment_id'";
  $update_subscribed_packages_query = mysqli_query($dbc,$update_subscribed_packages_sql);

  $update_transfer_of_ownership_status = "UPDATE `transfer_package_ownership_request` SET `status`=1 WHERE  `investment_id`='$investment_id'";
  $update_transfer_of_ownership_status_query = mysqli_query($dbc,$update_transfer_of_ownership_status);

  if($update_subscribed_packages_query == true && $update_transfer_of_ownership_status_query == true ){
  return  json_encode(["status"=>"1", "msg"=>"success"]);
  }else{
  return  json_encode(["status"=>"0", "msg"=>"failed"]);
  }
       
}

function insert_wallet_balance(){
  global $dbc;
  $get_users = get_rows_from_one_table('users_tbl');
  if (is_array($get_users) || is_object($get_users))
{
  foreach ($get_users as $value) {
    $user_id = $value['unique_id'];
    $check_if_wallet_exist = check_row_exists_by_one_param('wallet_tbl','user_id',$value['unique_id']);
    if($check_if_wallet_exist === false){
         $data = rand().$user_id;
         $unique_id = unique_id_generator($data);
         $insert_wallet_sql = "INSERT INTO `wallet_tbl` SET `unique_id` = '$unique_id',`balance` = 0, `user_id`='$user_id', `date_created` = now()";
         $insert_wallet_query = mysqli_query($dbc,$insert_wallet_sql);
        if($insert_wallet_query){
               echo "success<br>";
        }else{
               echo "failed<br>";
        }

      }else{
        // return json_encode(["status"=>"0", "msg"=>"wallet_exists"]);
         
               echo "wallet exists<br>";


      }
  }
}else{
    echo "nothing in array";
}

}

function query_account($user_id, $start_date, $end_date){
  global $dbc;
  $user_id = secure_database($user_id);
  $start_date = secure_database($start_date);
  $end_date = secure_database($end_date);
  if($user_id == '' || $start_date == '' || $end_date == ''){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else{
    $sql = "SELECT * FROM `users_logs_tbl` WHERE `user_id` = '$user_id' AND cast(`date_created` as date) BETWEEN '$start_date' AND '$end_date'";
    $query = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
    $num = mysqli_num_rows($query);
    if($num > 0){
      while($row = mysqli_fetch_array($query)){
        $row_display[] = $row;
      }
      return $row_display;
    }
    else{
       return null;
    }
  }
}

function get_users_details($table,$param,$value){
  global $dbc;
  $table = secure_database($table);
  $param = secure_database($param);
  $value = secure_database($value);
  $sql = "SELECT `unique_id`, `email`, `phone`, `surname`, `other_names` FROM `$table` WHERE `$param` = '$value'";
  $query = mysqli_query($dbc, $sql);
  $num = mysqli_num_rows($query);
 if($num > 0){
      $row = mysqli_fetch_array($query);
      return $row;
    }
    else{
       return null;
    }
}

function unsuspend_be(){
  global $dbc;
  $sql = "SELECT * FROM `business_executive_tbl` WHERE `status` = 2";
  $query = mysqli_query($dbc, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0){
    while($row = mysqli_fetch_array($query)){
      $BE_id = $row['unique_id'];
      $get_be_suspension = get_one_row_from_one_table('be_suspension_tbl', 'BE_id', $row['unique_id']);
      if($get_be_suspension['status'] == 1){
        $time_frame = $get_be_suspension['time_frame'];
        $date_created = date_create($get_be_suspension['date_created']);
        //$today = date('Y-m-d');
        $today = '2020-05-05';
        $date_to_add = $time_frame.' days';
        $next_date = date_add($date_created, date_interval_create_from_date_string($date_to_add));
        if($today == date_format($next_date,"Y-m-d")){
          $unsuspend_be_sql = "UPDATE `business_executive_tbl` SET `status` = 1 WHERE  `unique_id`= '$BE_id'";
          $unsuspend_be_query = mysqli_query($dbc, $unsuspend_be_sql);
          if($unsuspend_be_query){
            echo "success";
          }
        }else{
          //echo "not yet time";
        }
      }
    }
  }
}

function calculate_average_sales_progress($uid){
  global $dbc;
  $uid = secure_database($uid);
  $sql = "SELECT * FROM `business_executive_tbl` WHERE `assigned_to` = '$uid'";
  $query = mysqli_query($dbc, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0){
    $total = 0;
    while($row = mysqli_fetch_array($query)){
      $BE_id = $row['unique_id'];
      $sql1 = "SELECT * FROM `be_target` WHERE `BE_id` = '$BE_id'";
      $query1 = mysqli_query($dbc, $sql1)or die(mysqli_error($dbc));
      $row1 = mysqli_fetch_array($query1);
      $row1['sales_made'];
      $total +=$row1['sales_made'];
    }
    //$num1 = mysqli_num_rows($query1);
    echo number_format($average = $total / $num);
    //return  json_encode(["status"=>"1", "msg"=>intval($total)]);
  }
}

function insert_into_admin_notifications_tbl($notification_type, $admin_id, $notification_heading, $notification){
  global $dbc;
  $admin_id = secure_database($admin_id);
  $notification_type = secure_database($notification_type);
  $notification_heading = secure_database($notification_heading);
  $notification = secure_database($notification);
  $data = md5($admin_id.$notification_type);
  $unique_id = unique_id_generator($data);
  //$check = $this->check_row_exists_by_one_param('access_card_tbl','user_id',$user_id);
  if($admin_id == "" || $notification_type == "" || $notification == "" || $notification_heading == ""){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else{
       $sql = "INSERT INTO `admin_notifications_tbl` SET `unique_id` = '$unique_id',`admin_id` = '$admin_id', `notification_type` = '$notification_type', `notification` = '$notification', `notification_heading` = '$notification_heading', `date_created` = now()";
          $query = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
}
}

function change_transfer_pin($user_id, $new_pin, $old_pin, $confirm_new_pin){
  global $dbc;
  $get_transfer_pin = get_one_row_from_one_table('wallet_tbl', 'user_id',$user_id);
  $transfer_pin = $get_transfer_pin['transfer_pin'];

  if($new_pin == '' || $old_pin == '' || $confirm_new_pin == ''){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if(! is_numeric($new_pin)){
    return json_encode(["status"=>"0", "msg"=>"not_number"]);
  }
  else if($transfer_pin == null || $transfer_pin == 0){
    return json_encode(["status"=>"0", "msg"=>"no_transfer_pin"]);
  }
  else if($transfer_pin !== $old_pin){
    return json_encode(["status"=>"0", "msg"=>"wrong_old_pin"]);
  }
  else if($new_pin !== $confirm_new_pin){
    return json_encode(["status"=>"0", "msg"=>"new_pins_mismatch"]);
  }else{
    if(strlen($new_pin) !== 4){
      return json_encode(["status"=>"0", "msg"=>"length_error"]);
    }else{
      $update_pin = "UPDATE `wallet_tbl` SET `transfer_pin`= '$new_pin' WHERE  `user_id`='$user_id'";
      $update_pin_query = mysqli_query($dbc, $update_pin);

      if($update_pin_query == true ){
        return  json_encode(["status"=>"1", "msg"=>"success"]);
      }else{
        return  json_encode(["status"=>"0", "msg"=>"failed"]);
      }   
    }
  } 
}

function allocate_cash($admin_id, $amount, $unique_id){
  global $dbc;
  $admin_id = secure_database($admin_id);
  $amount = secure_database($amount);
  $unique_id = secure_database($unique_id);
  $get_admin_wallet = get_one_row_from_one_table('accountant_wallet_tbl', 'admin_id', $admin_id);

  if($unique_id == '' || $amount == 0 || $admin_id == ''){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else{
    if($get_admin_wallet == null){
     $data = md5($admin_id.$amount);
     $new_unique_id = unique_id_generator($data);
     $insert_admin_wallet = "INSERT INTO `accountant_wallet_tbl` SET `unique_id` = '$new_unique_id',`balance` = '$amount', `admin_id`='$admin_id'";
     $insert_admin_wallet_query = mysqli_query($dbc, $insert_admin_wallet);
     if($insert_admin_wallet_query === false){
        return  json_encode(["status"=>"0", "msg"=>"error_creating_wallet"]);
     }else{
        $update_cash_request_log = "UPDATE `cash_request_log` SET `status`=1  WHERE  `unique_id`='$unique_id'";
        $update_cash_request_log_query = mysqli_query($dbc, $update_cash_request_log);

        if(mysqli_affected_rows($dbc) > 0){
        return  json_encode(["status"=>"1", "msg"=>"success"]);
        }else{
        return  json_encode(["status"=>"0", "msg"=>"error"]);
        }
     }
    }
    else{
      $wallet_balance = $get_admin_wallet['balance'];
      $new_wallet_balance =$get_admin_wallet['balance'] + $amount;
      $update_admin_wallet_sql = "UPDATE `accountant_wallet_tbl` SET `balance`='$new_wallet_balance' WHERE  `admin_id`='$admin_id'";
      $qryupdate = mysqli_query($dbc, $update_admin_wallet_sql);
      $update_cash_request_log = "UPDATE `cash_request_log` SET `status`=1  WHERE  `unique_id`='$unique_id'";
        $update_cash_request_log_query = mysqli_query($dbc, $update_cash_request_log);

      if($qryupdate &&  $update_cash_request_log){
      return  json_encode(["status"=>"1", "msg"=>"success"]);
      }else{
      return  json_encode(["status"=>"0", "msg"=>"error"]);
      } 
    }
  }

}

function submit_rating($admin_id, $rating){
  global $dbc;
  $admin_id = secure_database($admin_id);
  $rating = secure_database($rating);
  $unique_id = unique_id_generator(md5($admin_id.$rating));
  $check_mm_exist = get_one_row_from_one_table('mm_rating', 'admin_id', $admin_id);
  if($rating == '' || $admin_id == ''){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else{
    if($check_mm_exist == null){
      $insert_rating = "INSERT INTO `mm_rating` SET `unique_id` = '$unique_id', `rating` = '$rating', `admin_id`='$admin_id'";
     $insert_rating_query = mysqli_query($dbc, $insert_rating);
     if($insert_rating_query === false){
        return  json_encode(["status"=>"0", "msg"=>"error"]);
     }else{
      return  json_encode(["status"=>"0", "msg"=>"success"]);
     }
    }else{
      $update_rating = "UPDATE `mm_rating` SET `rating`='$rating'  WHERE  `admin_id`='$admin_id'";
        $update_rating_query = mysqli_query($dbc, $update_rating);

        if(mysqli_affected_rows($dbc) > 0){
        return  json_encode(["status"=>"1", "msg"=>"success"]);
        }else{
        return  json_encode(["status"=>"0", "msg"=>"error"]);
        }
    }
  }
}

function insert_package_terms_conditions($admin_id, $description, $package_id){
  global $dbc;
  $admin_id = secure_database($admin_id);
  $description = secure_database($description);
  $package_id = secure_database($package_id);
  $data = $admin_id.$description;
  $unique_id = unique_id_generator($data);
  $check = check_row_exists_by_one_param('package_term_condition','package_id', $package_id);
  
  if($admin_id == '' || $description == '' || $package_id == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

  if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
  else{
    $insert_terms_conditions_sql = "INSERT INTO `package_term_condition` SET `unique_id` = '$unique_id',`description` = '$description', `added_by`='$admin_id', `package_id`='$package_id', `date_created` = now()";
         $insert_terms_conditions_query = mysqli_query($dbc, $insert_terms_conditions_sql) or die(mysqli_error($dbc));
         if($insert_terms_conditions_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}


function add_cctv_area($admin_id, $area_name, $area_description){
  global $dbc;
  $admin_id = secure_database($admin_id);
  $area_name = secure_database($area_name);
  $area_description = secure_database($area_description);
  $data = $area_name.$area_description;
  $unique_id = unique_id_generator($data);
  $check = check_row_exists_by_one_param('cctv_area','area_name', $area_name);
  
  if($admin_id == '' || $area_name == '' || $area_description == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

  if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
  else{
    $insert_area_sql = "INSERT INTO `cctv_area` SET `unique_id` = '$unique_id',`area_description` = '$area_description', `admin_id`='$admin_id', `area_name`='$area_name', `date_created` = now()";
         $insert_area_query = mysqli_query($dbc, $insert_area_sql) or die(mysqli_error($dbc));
         if($insert_area_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}

function add_cctv_unit($admin_id, $unit_name, $unit_description, $area_id, $cctv_link){
  global $dbc;
  $admin_id = secure_database($admin_id);
  $unit_name = secure_database($unit_name);
  $unit_description = secure_database($unit_description);
  $area_id = secure_database($area_id);
  $cctv_link = secure_database($cctv_link);
  $data = $unit_name.$unit_description;
  $unique_id = unique_id_generator($data);
  $check = check_row_exists_by_one_param('cctv_unit','unit_name', $unit_name);
  $check1 = check_row_exists_by_one_param('cctv_unit','area_id', $area_id);
  
  if($admin_id == '' || $unit_name == '' || $unit_description == '' || $area_id == '' || $cctv_link == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

  if($check === true && $check1){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
  else{
    $insert_unit_sql = "INSERT INTO `cctv_unit` SET `unique_id` = '$unique_id',`unit_description` = '$unit_description', `admin_id`='$admin_id', `unit_name`='$unit_name', `area_id`='$area_id', `cctv_link`='$cctv_link', `date_created` = now()";
         $insert_unit_query = mysqli_query($dbc, $insert_unit_sql) or die(mysqli_error($dbc));
         if($insert_unit_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}
//ends here
function arrayExpression($a,$b)
{
    if ($a===$b)
    {
    return 0;
    }
    return ($a>$b)?1:-1;
    
}

function assign_user_to_unit($unit_id, $user_id, $admin_id){
  global $dbc;
  $admin_id = secure_database($admin_id);
  $unit_id = secure_database($unit_id);
  //$user_id = json_encode($user_id);
  $encoded_user_id = json_encode($user_id);
  $data = $unit_id.$encoded_user_id;
  $unique_id = unique_id_generator($data);

  if($admin_id == '' || $unit_id == '' || empty($user_id)){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else{
    $get_assigned_users = get_one_row_from_one_table('unit_to_user_assignment', 'unit_id', $unit_id);
      if($get_assigned_users == null){
        $insert_unit_assignment_sql = "INSERT INTO `unit_to_user_assignment` SET `unique_id` = '$unique_id',`unit_id` = '$unit_id', `assigned_by`='$admin_id', `user_id`='$encoded_user_id', `date_created` = now()";
         $insert_unit_assignment_query = mysqli_query($dbc, $insert_unit_assignment_sql) or die(mysqli_error($dbc));
         if($insert_unit_assignment_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);
         } 
      }else{
        $get_assigned_users_array = json_decode($get_assigned_users['user_id']);
        $different_values_array = array_udiff($user_id, $get_assigned_users_array, "arrayExpression"); 
        //print_r($different_values_array);
        if(count($different_values_array) > 0){
          // foreach ($different_values_array as $value) {
          //   $new_user_to_insert = array_push($get_assigned_users_array, $value);
          //   //print_r($new_user_to_insert);
          // }
            $new_users_to_insert = array_merge($get_assigned_users_array, $different_values_array);
            $encoded_new_users_to_insert = json_encode($new_users_to_insert);
            $update_db = "UPDATE `unit_to_user_assignment` SET `user_id`='$encoded_new_users_to_insert'  WHERE  `unit_id`='$unit_id'";
            $update_db_query = mysqli_query($dbc, $update_db);
            if(mysqli_affected_rows($dbc) > 0){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
            }else{
              return  json_encode(["status"=>"0", "msg"=>"error"]);
            }
          }else{
            echo  json_encode(["status"=>"0", "msg"=>"users_belong_to_unit"]);
          }

      }
  }

}

function unassign_user_to_unit($unit_id, $user_id){
  global $dbc;
  //$admin_id = secure_database($admin_id);
  $unit_id = secure_database($unit_id);
  //$data = $unit_id.$encoded_user_id;
  //$unique_id = unique_id_generator($data);

  if($unit_id == '' || empty($user_id)){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else{
    $get_assigned_users = get_one_row_from_one_table('unit_to_user_assignment', 'unit_id', $unit_id);
      if($get_assigned_users == null){
         return  json_encode(["status"=>"0", "msg"=>"unit_does_not_exist"]);
      }else{
        $get_assigned_users_array = json_decode($get_assigned_users['user_id']);
        //$different_values_array = array_udiff($user_id, $get_assigned_users_array, "arrayExpression"); 
        $same_values_array = array_intersect($user_id, $get_assigned_users_array);
        if(count($same_values_array) > 0){
          $new_users_to_insert = array_diff($get_assigned_users_array, $same_values_array);
          $encoded_new_users_to_insert = json_encode(array_values($new_users_to_insert));
        //   $encoded_new_users_to_insert = json_encode($new_users_to_insert);
          $update_db = "UPDATE `unit_to_user_assignment` SET `user_id`='$encoded_new_users_to_insert'  WHERE  `unit_id`='$unit_id'";
            $update_db_query = mysqli_query($dbc, $update_db);
            if(mysqli_affected_rows($dbc) > 0){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
            }else{
              return  json_encode(["status"=>"0", "msg"=>"error"]);
            }
        }
        else{
          return  json_encode(["status"=>"0", "msg"=>"users_not_in_unit"]);
        }

      }
  }

}


function get_fixed_backdated_investments($table){ 
  global $dbc;
  $table = secure_database($table);
    $sql = "SELECT * FROM `$table` WHERE `contributory_days` IS NULL ORDER BY date_created DESC";
  $query = mysqli_query($dbc, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
    else{
       return null;
    }
}

function get_recurrent_backdated_investments($table){ 
  global $dbc;
  $table = secure_database($table);
    $sql = "SELECT * FROM `$table` WHERE `contributory_days` IS NOT NULL ORDER BY date_created DESC";
  $query = mysqli_query($dbc, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
    else{
       return null;
    }
}



//ends here


///////sam starts here::: THIS FUNCTION HAS BEEN USED FOR ITS PURPOSE
function update_wallet_with_zero_balance(){
    global $dbc;
    $display = "";
    $get_users = "SELECT * FROM `users_tbl`";
    $qry = mysqli_query($dbc,$get_users);
    while($row = mysqli_fetch_array($qry)){
        $fname = $row['other_names'];
        $unid = $row['unique_id'];
        $surname = $row['surname'];
         //check if client has a package
         $sqlp = "SELECT * FROM `subscribed_packages` WHERE `user_id`='$unid'";
         $qryp = mysqli_query($dbc,$sqlp); 
         $countp = mysqli_num_rows($qryp);
        
        if($countp <= 0){
         $sqlpd = "SELECT SUM(amount_withdrawn) as amount_withdrawn FROM `debit_wallet_tbl` WHERE `user_id`='$unid' AND `purpose`=11";
         $qrypd = mysqli_query($dbc,$sqlpd) or die(mysqli_error($dbc)); 
         $row22 = mysqli_fetch_array($qrypd);
         $total_deposit = $row22['amount_withdrawn'];
        
         if($total_deposit > 0){
             
                //check if client has a wallet
                $sqlpw = "SELECT * FROM `wallet_tbl` WHERE `user_id`='$unid'";
                $qrypw = mysqli_query($dbc,$sqlpw); 
                $countpw = mysqli_num_rows($qrypw);
                
                if($countpw == 1){
                    $wall_stat = "one wallet - GOOD";
                }
                
                if($countpw > 1){
                    $wall_stat = "more than one wallet--BAD";
                }
                
                if($countpw == 0){
                    $unique_idd2 = unique_id_generator($fname.$surname);
                    $wall_stat = "no wallet";
                    // $updw = "INSERT INTO `wallet_tbl` SET `unique_id`='$unique_idd2',`user_id`='$unid',`balance`='$total_deposit',`date_created`=now() ";
                    // $qryw = mysqli_query($dbc,$updw);
                    // if($qryw){
                    //     $wall_stat .= "----success baba";
                    // }else{
                    //   $wall_stat .= "----failure baba";   
                    // }
                }
             
                $wb = get_wallet_balance($unid);
                $wb_dec = json_decode($wb,true);
                $wallet_bal = $wb_dec['msg'];
                
                $display .= "Fullname: ".$fname.' '.$surname.' '.$unid.' ( '.$countp.' )<br>';
                $display .= 'Investment Type should be zero: '.$countp.'<br>';
                $display .= 'Total Deposit: '.$total_deposit.'<br>';
                $display .= 'Wallet Balance: '.$wallet_bal.'<br>';
                 $display .= 'Wallet Status: '.$wall_stat.'<br><hr>';

             
         }

        }
        
    }
    echo $display;
}

///////sam ends here


///the below functions are for IMs to send request to create package
function create_fixed_package_IM($package_name,$package_category,$package_description,$package_type,$package_unit_price,$min_no_slots,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$backdatable,$no_of_slots,$visibility,$package_commission,$created_by){
  // ,$created_by,$filename,$size,$tmpName,$type
    global $dbc;
    $package_name = secure_database($package_name);
    $package_category = secure_database($package_category);
    $package_description = secure_database($package_description);
    $package_type = secure_database($package_type);
    $package_unit_price = secure_database($package_unit_price);
    $min_no_slots = secure_database($min_no_slots);
    $moratorium = secure_database($moratorium);
    $free_liquidation_period = secure_database($free_liquidation_period);
    $liquidation_surcharge = secure_database($liquidation_surcharge);
    $tenure_of_product = secure_database($tenure_of_product);
    $float_time = secure_database($float_time);
    $multiplying_factor = secure_database($multiplying_factor);
    $capital_refund = secure_database($capital_refund);
    $backdatable = secure_database($backdatable);
    $no_of_slots = secure_database($no_of_slots);
    $visibility = secure_database($visibility);
    $package_commission = secure_database($package_commission);
    $created_by = secure_database($created_by);
    $imageurl2 = "uploads/basal_daily.jpg";
    

    $data = $created_by.$moratorium.$package_name;
    $table = 'package_definition_request';
    $unique_id = unique_id_generator($data);
    //$image_url = image_upload($filename, $size, $tmpName, $type);
    $check = check_row_exists_by_one_param($table,'package_name',$package_name);

  if($package_name == "" || $package_category == "" || $package_type == "" || $package_unit_price == ""  || $min_no_slots == ""  || $moratorium == "" || $free_liquidation_period == "" || $liquidation_surcharge == "" || $tenure_of_product == "" || $float_time == "" || $multiplying_factor == "" || $capital_refund == "" || $backdatable == "" || $no_of_slots == "" || $visibility == "" || $package_commission == "" || $created_by == "" ){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }

  else{
        //$imageurl_decode = json_decode($image_url,true);
        //if($imageurl_decode['status'] == '1'){
          //    $imageurl2 ="";
              $sql = "INSERT INTO `package_definition_request` SET 
              `package_category` = '$package_category',
              `package_description` = '$package_description',
              `package_name` = '$package_name',
              `unique_id` = '$unique_id',
              `package_type` = '$package_type',
              `package_unit_price` = '$package_unit_price',
              `image_url` = '$imageurl2',
              `min_no_slots` = '$min_no_slots',
              `moratorium` = '$moratorium',
              `free_liquidation_period` = '$free_liquidation_period',
              `liquidation_surcharge` = '$liquidation_surcharge',
              `tenure_of_product` = '$tenure_of_product',
              `float_time` = '$float_time',
              `multiplying_factor`='$multiplying_factor',
              `capital_refund`='$capital_refund',
              `backdatable`='$backdatable',
              `no_of_slots`='$no_of_slots',
              `visibility`='$visibility',
              `package_commission`='$package_commission',
              `created_by`='$created_by',
              `approval_status`=0,
              `date_created` = now()";
              $query = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        //}else{
          //      return json_encode(["status"=>"0", "msg"=>$filename.$imageurl_decode['msg'] ]);
        //}
  }

 }


 function create_recurrent_package_IM($recurrence_value,$contribution_period,$incubation_period,$recurrence_type,$package_name,$package_category,$package_description,$package_type,$package_unit_price,$min_no_slots,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$backdatable,$no_of_slots,$visibility,$package_commission,$created_by){
   // ,$filename,$size,$tmpName,$type
  global $dbc;
    $recurrence_value = secure_database($recurrence_value);
    $contribution_period = secure_database($contribution_period);
    $incubation_period = secure_database($incubation_period);
    $recurrence_type = secure_database($recurrence_type);


    $package_name = secure_database($package_name);
    $package_category = secure_database($package_category);
    $package_description = secure_database($package_description);
    $package_type = secure_database($package_type);
    $package_unit_price = secure_database($package_unit_price);
    $min_no_slots = secure_database($min_no_slots);
    $moratorium = secure_database($moratorium);
    $free_liquidation_period = secure_database($free_liquidation_period);
    $liquidation_surcharge = secure_database($liquidation_surcharge);
    $tenure_of_product = secure_database($tenure_of_product);
    $float_time = secure_database($float_time);
    $multiplying_factor = secure_database($multiplying_factor);
    $capital_refund = secure_database($capital_refund);
    $backdatable = secure_database($backdatable);
    $no_of_slots = secure_database($no_of_slots);
    $visibility = secure_database($visibility);
    $package_commission = secure_database($package_commission);
    $created_by = secure_database($created_by);
    $imageurl2 = "uploads/basal_daily.jpg";


    $data = $package_category.$moratorium.$package_name;
    $table = 'package_definition_request';
    $unique_id = unique_id_generator($data);
    // $image_url = image_upload($filename, $size, $tmpName, $type);
    $check = check_row_exists_by_one_param($table,'package_name',$package_name);

  if( $recurrence_value == "" || $contribution_period == "" || $incubation_period == "" || $recurrence_type == "" ||   $package_name == "" || $package_category == "" || $package_type == "" || $package_unit_price == ""  || $min_no_slots == ""  || $moratorium == "" || $free_liquidation_period == "" || $liquidation_surcharge == "" || $tenure_of_product == "" || $float_time == "" || $multiplying_factor == "" || $capital_refund == "" || $backdatable == "" || $no_of_slots == "" || $visibility == ""|| $package_commission == "" || $created_by == "" ){
    // || $filename == ""|| $size == ""|| $tmpName == "" || $type == ""
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }

  else{
        //$imageurl_decode = json_decode($image_url,true);
        //if($imageurl_decode['status'] == '1'){
          //    $imageurl2 = $imageurl_decode['msg'];
              $sql = "INSERT INTO `package_definition_request` SET 
              `package_category` = '$package_category',
              `package_description` = '$package_description',
              `package_name` = '$package_name',
              `unique_id` = '$unique_id',
              `package_type` = '$package_type',
              `package_unit_price` = '$package_unit_price',
              `image_url` = '$imageurl2',
              `recurrence_value` = '$recurrence_value',
              `contribution_period` = '$contribution_period',
              `incubation_period` = '$incubation_period',
              `recurrence_type` = '$recurrence_type',
              `min_no_slots` = '$min_no_slots',
              `moratorium` = '$moratorium',
              `free_liquidation_period` = '$free_liquidation_period',
              `liquidation_surcharge` = '$liquidation_surcharge',
              `tenure_of_product` = '$tenure_of_product',
              `float_time` = '$float_time',
              `multiplying_factor`='$multiplying_factor',
              `capital_refund`='$capital_refund',
              `backdatable`='$backdatable',
              `no_of_slots`='$no_of_slots',
              `visibility`='$visibility',
              `package_commission`='$package_commission',
              `created_by`='$created_by',
              `approval_status`=0,
              `date_created` = now()";
              $query = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
    //    }else{
      //          return json_encode(["status"=>"0", "msg"=>$filename.$imageurl_decode['msg'] ]);
        //}


      
  }

 }  
//those functions end here

//this function is for the IM to send package category creation
function insert_package_category_IM($name, $description,$created_by){
    global $dbc;
    $name = secure_database($name);
    $created_by = secure_database($created_by);
    $data = $name.$created_by;
    $unique_id = unique_id_generator($data);
    $description = secure_database($description);
    $check = check_row_exists_by_one_param('package_category_request','name',$name);
    $imageurl2 = "uploads/basal_daily.jpg";
  
  if($name == "" || $unique_id == "" || $description == "" || $created_by == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{
       
              $sql = "INSERT INTO `package_category_request` SET `name` = '$name',`unique_id` = '$unique_id',`image_url` = '$imageurl2',  `description` = '$description',`created_by`='$created_by', `date_created` = now()";
              $query = mysqli_query($dbc, $sql) ;
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        }
       


      

}

function submit_undo_package_request($admin_id, $investment_id, $description){
  global $dbc;
  $admin_id = secure_database($admin_id);
  $investment_id = secure_database($investment_id);
  $description = secure_database($description);
  $data = $investment_id.$description;
  $unique_id = unique_id_generator($data);
  $check = check_row_exists_by_one_param('backdate_investment_maker_checker','investment_id', $investment_id);
  $check1 = check_row_exists_by_one_param('undo_package_sub_request','investment_id', $investment_id);
  
  if($admin_id == '' || $investment_id == '' || $description == ''){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }

  if($check){
    return  json_encode(["status"=>"0", "msg"=>"backdate_request_pending"]);
  }

  if($check1){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
  else{
    $insert_unit_sql = "INSERT INTO `undo_package_sub_request` SET `unique_id` = '$unique_id',`description` = '$description', `admin_id`='$admin_id', `investment_id`='$investment_id', `date_created` = now()";
         $insert_unit_query = mysqli_query($dbc, $insert_unit_sql) or die(mysqli_error($dbc));
         if($insert_unit_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}


///for both fixed and recurrent
function calculate_total_floating_profit($user_id){
  global $dbc;
  $total_fp = 0;
  $get_investment_details2 = get_rows_from_one_table_by_id('subscribed_packages', 'user_id', $user_id);
  if($get_investment_details2 !== null){
      foreach ($get_investment_details2 as $investment_details) {
        $getpackage = get_one_row_from_one_table('package_definition','unique_id',$investment_details['package_id']);
            
            //fixed
            if($investment_details['package_type'] == '1'){
                
                $dets_running_investment = get_details_for_a_running_investment($investment_details['unique_id']);
                $dets_running_investment_dec = json_decode($dets_running_investment,true);
                if($dets_running_investment_dec['status']  == 1){
                $floating_profit = $dets_running_investment_dec['floating_profit'];
                $format_floating_profit = number_format($dets_running_investment_dec['floating_profit']);
                $days_so_far = number_format($dets_running_investment_dec['days_so_far']);
                $total_fp = $total_fp + $floating_profit;
                }
                
            }else{
                //recurrent
                $get_floating_profit = recurrent_sum_of_profits_per_investment($investment_details['unique_id']);
                $get_floating_profit_dec = json_decode($get_floating_profit,true);
                $floating_profit = $get_floating_profit_dec['msg'];
                $total_fp = $total_fp + $floating_profit;
                
                
            }
            
          
    }
    
    return json_encode(["status"=>"1", "msg"=>$total_fp]);
  
      
  }else{
      return json_encode(["status"=>"1", "msg"=>0.00]);
  }
}



///////sam:
function get_all_withdrawals_migration(){
    global $dbc;
    $sql = "SELECT * FROM `debit_wallet_tbl` WHERE `purpose`='7' AND `user_id`!='8a38a07ee59c57209f48803de8d0c2bb'";
    $qry = mysqli_query($dbc,$sql);
    while($row = mysqli_fetch_array($qry)){
            $userid =  $row['user_id'];
            $withdrawals_amount = $row['amount_withdrawn'];
              $udetails  =  get_one_row_from_one_table('users_tbl','unique_id',$userid);
              $wdetails  =  get_one_row_from_one_table('wallet_tbl','user_id',$userid);
              $currentbal = $wdetails['balance'];
              
              $newbal = $currentbal - $withdrawals_amount;
              
             // $sqlupd = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE `user_id`='$userid'";
             // $qry33 = mysqli_query($dbc,$sqlupd);
              
            //  if($qry33){
                  echo $udetails['surname'].'--'.$udetails['other_names'].'---Withdrawal Amount: '.$withdrawals_amount.'---Wallet Balance: '.$currentbal.'<br>';
            // .'---- Balance after deduction::::'.$newbal.'<br>'  }else{
            //       echo "Failed<br>";
            //   }
              
              
             
             
        //$newbal = 0;
    }
}



//the function ends here

function backdateoooo(){
    global $dbc;
    $array = [];
    $array2 = [];
    $sql = "SELECT * FROM backdate_investment_maker_checker ORDER BY id";
    $qry = mysqli_query($dbc,$sql);
    while($row = mysqli_fetch_array($qry)){
            $investmentid = $row['investment_id'];
            $backdate = $row['backdate_date'];
            $date_backdate_was_done = $row['date_created'];
            
            $backdate = date('Y-m-d',strtotime($row['backdate_date']) );
            $date_backdate_was_done = date('Y-m-d',strtotime($row['date_created']) );
            
            $today = date('Y-m-d');
            
            $getdet = get_one_row_from_one_table('subscribed_packages','unique_id',$investmentid);
            $ptype = $getdet['package_type'];
            $tenure_of_product = $getdet['tenure_of_product'];
            $no_of_slots_bought = $getdet['no_of_slots_bought'];
            $package_unit_price = $getdet['package_unit_price'];
            $float_time = $getdet['float_time'];
            $moratorium = $getdet['moratorium'];
            $user_id33 = $getdet['user_id'];
            $multiplying_factor = $getdet['multiplying_factor'];
            $total_amount = $getdet['total_amount'];
             $float_incremental = $getdet['float_time_incremental'];
            $get_details_for_a_running_investment = get_details_for_a_running_investment($investmentid);
            $get_details_for_a_running_investment_dec = json_decode($get_details_for_a_running_investment,true);
            
            $investment_start_date = get_investment_start_date($getdet['date_created'],$getdet['moratorium']);
            
            $get_curr_wallet_balance = json_decode(get_wallet_balance($user_id33),true)['msg'];
            
            if($get_details_for_a_running_investment_dec['status'] == 0){
                $run_det = $get_details_for_a_running_investment_dec['msg'];
                $array = array(
                     "investmentid"=>$investmentid,
                      "msg"=>$run_det,
                    );
            }else{
                
                
                        $total_date_last = strtotime($date_backdate_was_done) - strtotime($backdate);
                        $total_days_last = round($total_date_last / (60 * 60 * 24));  //////verify wwheter to add 1 or not
                        $floating_days_last = $total_days_last % $float_time;
                        $accrued_last = $total_days_last - $floating_days_last;
                        
                        // $total_date_last = strtotime($date_backdate_was_done) - strtotime($investment_start_date);
                        // $total_days_last = round($total_date_last / (60 * 60 * 24));  //////verify wwheter to add 1 or not
                        // $floating_days_last = $total_days_last % $float_time;
                        // $accrued_last = $total_days_last - $floating_days_last;
                        
                        
                     
                     
                        //  $floating_days_last = $get_details_for_a_running_investment_dec['floating_days'];
                     
                        $date_lasttime_till_now = strtotime($today) - strtotime($date_backdate_was_done);
                        $days_lasttime_till_now = round($date_lasttime_till_now / (60 * 60 * 24));
                        
                        
                        
                        $total_current_float_days =  $floating_days_last + $days_lasttime_till_now;
                        $days_lasttime_till_now_floating = $total_current_float_days % $float_time;
                        $days_lasttime_till_now_accrued = $total_current_float_days - $days_lasttime_till_now_floating;
                        
                        ////get the number of accrued that can be generated from above
                        $no_of_accrued_for_update_sub =  $total_current_float_days % $float_time;
                        $no_of_accrued_for_update_real = ($total_current_float_days - $no_of_accrued_for_update_sub) / $float_time;
                        
                        $profit_per_day = $total_amount * $multiplying_factor * $float_time;
                        
                        
                        
                        
                        ///total investmment days from inception:::this will help to get current float time increment,then update
                        $grand_total_date = strtotime($today) - strtotime($backdate);
                        $grand_total_days = round($grand_total_date / (60 * 60 * 24));  //////verify wwheter to add 1 or not
                        $grand_total_days_floating = $grand_total_days % $float_time;
                        $grand_total_days_accrued = $grand_total_days - $grand_total_days_floating;
                        
                     
                        if(  ($total_current_float_days >= $float_time)   && ($accrued_last != 0) ){
                            $yawa_status = "yawa";
                        }else{
                            $yawa_status = "safe";
                        }
                        
            
             $run_det = $get_details_for_a_running_investment_dec['msg'];
             $array = array(  
                            "investmentid"=>$investmentid,
                            "yawa_status"=>$yawa_status,
                            "profit_per_day"=>$profit_per_day,
                            "grand_total_days"=>$grand_total_days,
                            "grand_total_days_floating"=>$grand_total_days_floating,
                            "grand_total_days_accrued"=>$grand_total_days_accrued,
                            "floating_days_last_migration"=>$floating_days_last,
                            "accrued_days_last_migration"=>$accrued_last,
                            "total_days_last"=>$total_days_last,
                            "days_lasttime_till_now"=>$days_lasttime_till_now,
                            "days_lasttime_till_now_accrued"=>$days_lasttime_till_now_accrued,
                            "days_lasttime_till_now_floating"=>$days_lasttime_till_now_floating,
                            "total_current_float"=>$total_current_float_days,
                            "msg"=>$run_det,
                            "date_investment_starts"=>$investment_start_date,
                            "accrued_days_count"=>$no_of_accrued_for_update_real,
                            "backdate"=>$backdate,
                            "date_backdate_was_done"=>$date_backdate_was_done,
                            "today"=>$today,
                            "package_type"=>$ptype,
                            "tenure_of_product"=>$tenure_of_product,
                            "no_of_slots_bought"=>$no_of_slots_bought,
                            "package_unit_price"=>$package_unit_price,
                            "float_time"=>$float_time,
                            "float_incremental"=>$float_incremental,
                            "user_id"=>$user_id33,
                            "wallet_balance"=>$get_curr_wallet_balance,
                            "moratorium"=>$moratorium,
                            "total_amount"=>$total_amount,
                            "profit_per_day"=>$profit_per_day,
                            "days_so_far"=>$days_so_far,
                            "total_profit_so_far"=>$total_profit_so_far,
                            "floating_profit"=>$floating_profit,
                            "accrued_days"=>$accrued_days,
                            "accrued_profit"=>$accrued_profit,
                            
                            "withdrawal"=>$withdrawal
                        ) 
                ;
            }

            array_push($array2,$array);
            
    }
    
     return json_encode($array2);
    
    
}



function backdateoooo_second(){
    global $dbc;
    $array = [];
    $array2 = [];
    $sql = "SELECT * FROM backdate_investment_maker_checker ORDER BY id";
    $qry = mysqli_query($dbc,$sql);
    while($row = mysqli_fetch_array($qry)){
            $investmentid = $row['investment_id'];
            $backdate = $row['backdate_date'];
            $date_backdate_was_done = $row['date_created'];
            
            $backdate = date('Y-m-d',strtotime($row['backdate_date']) );
            $date_backdate_was_done = date('Y-m-d',strtotime($row['date_created']) );
            
            $today = date('Y-m-d');
            
            $getdet = get_one_row_from_one_table('subscribed_packages','unique_id',$investmentid);
            $ptype = $getdet['package_type'];
            $tenure_of_product = $getdet['tenure_of_product'];
            $no_of_slots_bought = $getdet['no_of_slots_bought'];
            $package_unit_price = $getdet['package_unit_price'];
            $float_time = $getdet['float_time'];
            $moratorium = $getdet['moratorium'];
            $user_id33 = $getdet['user_id'];
            $multiplying_factor = $getdet['multiplying_factor'];
            $total_amount = $getdet['total_amount'];
             $float_incremental = $getdet['float_time_incremental'];
            $get_details_for_a_running_investment = get_details_for_a_running_investment($investmentid);
            $get_details_for_a_running_investment_dec = json_decode($get_details_for_a_running_investment,true);
            
            $investment_start_date = get_investment_start_date($getdet['date_created'],$getdet['moratorium']);
            
            $get_curr_wallet_balance = json_decode(get_wallet_balance($user_id33),true)['msg'];
            
            if($get_details_for_a_running_investment_dec['status'] == 0){
                $run_det = $get_details_for_a_running_investment_dec['msg'];
                $array = array(
                     "investmentid"=>$investmentid,
                      "msg"=>$run_det,
                    );
            }else{
                
                
                        // $total_date_last = strtotime($date_backdate_was_done) - strtotime($backdate);
                        // $total_days_last = round($total_date_last / (60 * 60 * 24));  //////verify wwheter to add 1 or not
                        // $floating_days_last = $total_days_last % $float_time;
                        // $accrued_last = $total_days_last - $floating_days_last;
                        
                        $total_date_last = strtotime($date_backdate_was_done) - strtotime($investment_start_date);
                        $total_days_last = round($total_date_last / (60 * 60 * 24));  //////verify wwheter to add 1 or not
                        $floating_days_last = $total_days_last % $float_time;
                        $accrued_last = $total_days_last - $floating_days_last;
                        
                        
                     
                     
                        //  $floating_days_last = $get_details_for_a_running_investment_dec['floating_days'];
                     
                        $date_lasttime_till_now = strtotime($today) - strtotime($date_backdate_was_done);
                        $days_lasttime_till_now = round($date_lasttime_till_now / (60 * 60 * 24));
                        
                        
                        
                        $total_current_float_days =  $floating_days_last + $days_lasttime_till_now;
                        $days_lasttime_till_now_floating = $total_current_float_days % $float_time;
                        $days_lasttime_till_now_accrued = $total_current_float_days - $days_lasttime_till_now_floating;
                        
                        ////get the number of accrued that can be generated from above
                        $no_of_accrued_for_update_sub =  $total_current_float_days % $float_time;
                        $no_of_accrued_for_update_real = ($total_current_float_days - $no_of_accrued_for_update_sub) / $float_time;
                        
                        $profit_per_day = $total_amount * $multiplying_factor * $float_time;
                        
                        
                        
                        
                        ///total investmment days from inception:::this will help to get current float time increment,then update
                        $grand_total_date = strtotime($today) - strtotime($investment_start_date);
                        $grand_total_days = round($grand_total_date / (60 * 60 * 24));  //////verify wwheter to add 1 or not
                        $grand_total_days_floating = $grand_total_days % $float_time;
                        $grand_total_days_accrued = $grand_total_days - $grand_total_days_floating;
                        
                     
                        if(  ($total_current_float_days >= $float_time)   && ($accrued_last != 0) ){
                            $yawa_status = "yawa";
                        }else{
                            $yawa_status = "safe";
                        }
                        
            
             $run_det = $get_details_for_a_running_investment_dec['msg'];
             $array = array(  
                            "investmentid"=>$investmentid,
                            "yawa_status"=>$yawa_status,
                            "profit_per_day"=>$profit_per_day,
                            "grand_total_days"=>$grand_total_days,
                            "grand_total_days_floating"=>$grand_total_days_floating,
                            "grand_total_days_accrued"=>$grand_total_days_accrued,
                            "floating_days_last_migration"=>$floating_days_last,
                            "accrued_days_last_migration"=>$accrued_last,
                            "total_days_last"=>$total_days_last,
                            "days_lasttime_till_now"=>$days_lasttime_till_now,
                            "days_lasttime_till_now_accrued"=>$days_lasttime_till_now_accrued,
                            "days_lasttime_till_now_floating"=>$days_lasttime_till_now_floating,
                            "total_current_float"=>$total_current_float_days,
                            "msg"=>$run_det,
                            "date_investment_starts"=>$investment_start_date,
                            "accrued_days_count"=>$no_of_accrued_for_update_real,
                            "backdate"=>$backdate,
                            "date_backdate_was_done"=>$date_backdate_was_done,
                            "today"=>$today,
                            "package_type"=>$ptype,
                            "tenure_of_product"=>$tenure_of_product,
                            "no_of_slots_bought"=>$no_of_slots_bought,
                            "package_unit_price"=>$package_unit_price,
                            "float_time"=>$float_time,
                            "float_incremental"=>$float_incremental,
                            "user_id"=>$user_id33,
                            "wallet_balance"=>$get_curr_wallet_balance,
                            "moratorium"=>$moratorium,
                            "total_amount"=>$total_amount,
                            "profit_per_day"=>$profit_per_day,
                            "days_so_far"=>$days_so_far,
                            "total_profit_so_far"=>$total_profit_so_far,
                            "floating_profit"=>$floating_profit,
                            "accrued_days"=>$accrued_days,
                            "accrued_profit"=>$accrued_profit,
                            
                            "withdrawal"=>$withdrawal
                        ) 
                ;
            }

            array_push($array2,$array);
            
    }
    
     return json_encode($array2);
    
    
}


function repair_float_time($invtid,$profit,$newfloat){
    global $dbc;
    
    $getdet = get_one_row_from_one_table('subscribed_packages','unique_id',$invtid);
    $user_id = $getdet['user_id'];
    
    $sql = "INSERT INTO `added_profits_log_for_running_investments` SET `investment_id`='$invtid',`profit_amount`='$profit',`addition_type`='3',`date_added`= now() ";
    $qrry = mysqli_query($dbc,$sql) or die(mysqli_error());
    
     //update wallet to new wallet balance
    //get current wallet bal
    $get_curr_wallet_balance = json_decode(get_wallet_balance($user_id),true)['msg'];
    $newwallbal = $get_curr_wallet_balance + $profit;
    $sqlupdatew = "UPDATE `wallet_tbl` SET `balance`='$newwallbal' WHERE `user_id`='$user_id'";
    $qryupdatew = mysqli_query($dbc,$sqlupdatew) ;
    
    $sqlupdatesub = "UPDATE `subscribed_packages` SET `float_time_incremental`='$newfloat' WHERE `unique_id`='$invtid'";
    $qryupdatesub = mysqli_query($dbc,$sqlupdatesub);
    
    $sqllogrep = "INSERT INTO `log_backdate_repair` SET `investment_id`='$invtid',`date_done`=now() ";
    $qrrylogrep = mysqli_query($dbc,$sqllogrep);
    
    
    
}

/////////new functions dec 1 2020
  function compute_liquidation_params_for_fixedOLD($investment_id){
        //getinvestment start date
      global $dbc;
      $sql = "SELECT * FROM `subscribed_packages` WHERE `package_type` = '1' AND `unique_id`='$investment_id' AND `liquidation_status`=0";
      $qry = mysqli_query($dbc,$sql);
      $getdet = mysqli_fetch_array($qry);
      //$getpackdet  =  get_one_row_from_one_table('package_definition','unique_id',$investment_id);
      $liquid_stat = $getdet['liquidation_status'];
      $packtype = $getdet['package_type'];
      $pack_unitp = $getdet['package_unit_price'];
      $no_of_slots_bought = $getdet['no_of_slots_bought'];
      $moratorium = $getdet['moratorium'];
      $multiplying_factor = $getdet['multiplying_factor'];
      $total_amount = $getdet['total_amount'];
      $float_time = $getdet['float_time']; //in days
      $packtype = $getdet['package_type'];
      $date_created = $getdet['date_created'];
      $tenure_of_product = $getdet['tenure_of_product'];
      $flp = $getdet['free_liquidation_period'];
      $liquidation_surcharge = $getdet['liquidation_surcharge'];
      $user_id = $getdet['user_id'];

      $surcharged_amount = 0;

      $current_date = date('Y-m-d');
      $date_created =  date('Y-m-d',strtotime($date_created));

      if($moratorium == 0){
      $day_investment_starts_to_count = date('Y-m-d',strtotime($date_created. ' + 1 days'));
      }
      else{
      $day_investment_starts_to_count = date('Y-m-d', strtotime($date_created. ' + '.$moratorium.' days'));    
      }


      $date_used_in_investment = strtotime($current_date) - strtotime($day_investment_starts_to_count);
      $days_used_in_investment = round($date_used_in_investment / (60 * 60 * 24)) + 1; ///you can verify this line very well later


      $check_if_investment_is_on =  check_if_investment_is_on($date_created,$moratorium);
      $check_end_date_status = check_end_date_status($tenure_of_product,$date_created,$moratorium);


      if($packtype == '1'){
        if($check_if_investment_is_on == false){
        ///this investment is yet to start
        return  json_encode(["status"=>"107", "msg"=>'this investment has not started']);

        }else{
        ///investment has started but also check below if invst has ended or not

        ///meaning the investment has ended
        if($check_end_date_status == false){ $timeframe = "investment has ended"; }else{
          $timeframe = "investment has not ended";
         }






         ////////the reall logic flow
         $packageam = $getdet['package_unit_price'] * $getdet['no_of_slots_bought'];
         $prof_made_so_far = $getdet['package_unit_price'] * $getdet['multiplying_factor'] * $user_package['no_of_slots_bought'] * $days_used_in_investment;

         $current_cap_bal = ($packageam) + $getdet['package_unit_price'] * $getdet['multiplying_factor'] * $getdet['no_of_slots_bought'] * $days_used_in_investment ;
        
         $amount_sent_to_wallet = json_decode(get_total_dropped_profits_per_running_investments($investment_id),true)['msg']; 




         if( $days_used_in_investment <  $flp){ 
                          $surcharged_amount = ($getdet['liquidation_surcharge']/100) * $current_cap_bal;
                    }

                  $final_liquidation_amount = $current_cap_bal - $surcharged_amount - $amount_sent_to_wallet; 

                  if($free_liquidation_period > $days_used_in_investment){
                      $surcharge_status = "true";
                  }else{
                      $surcharge_status = "false";                      
                  }

          if($amount_sent_to_wallet <= $prof_made_so_far){
            ///the main the main
                    //                 $msg = '<br>User ID: '.$user_id.'<br>';
                    //                  $msg .= 'investment  ID: '.$investment_id.'<br>';
                    //                 $msg .= 'Surcharge Status: '.$surcharge_status.'<br>';
                    //                 $msg .= 'End Status: '.$timeframe.'<br>';
                    //                 $msg .= 'Days so far: '.number_format($days_used_in_investment).'<br>';
                    //                 $msg .= 'Amount to be surcharged: '.number_format($surcharged_amount).'<br>';
                    //                 $msg .= 'Profit sent to wallet already: '.number_format($amount_sent_to_wallet).'<br>';
                    //                 $msg .= 'Free liquidation period: '.number_format($flp).'<br>';
                    //                 $msg .= 'Liquidation surcharge: '.number_format($liquidation_surcharge).'%<br>';
                    //                 $msg .= 'Capital balance: '.number_format($current_cap_bal).'<br>';
                    //                 $msg .= 'AMOUNT TO BE PAID TO WALLET: '.number_format($final_liquidation_amount).'<br>';
                    //    return  json_encode(["status"=>"111", "msg"=>$msg]).'<br>';
          
            return json_encode([ "status"=>"111",
                              "msg"=>"success",
                                        "user_id"=>$user_id,
                                        "investment_id"=>$investment_id,
                                        "surcharge_status"=>$surcharge_status,
                                        "end_date_status"=>$timeframe,
                                        "days_so_far"=>$days_used_in_investment,
                                        "amount_to_be_surcharged"=>$surcharged_amount,
                                        "amount_sent_to_wallet"=>$amount_sent_to_wallet,
                                        "free_liquidation_period"=>$flp,
                                        "liquidation_surcharge"=>$liquidation_surcharge,
                                        "current_cap_bal"=>$current_cap_bal,
                                        "final_liquidation_amount"=>"$final_liquidation_amount"
                                        ]);

          } else{
            ///
          return  json_encode(["status"=>"107", "msg"=>'you do not have any profit at the moment']);

          }


        
        }

      }else{
        return  json_encode(["status"=>"107", "msg"=>'liquidation is available only for fixed investment']);
      }


  } 
  
function compute_liquidation_params_for_fixed($investment_id){
      //getinvestment start date
      global $dbc;
      $sql = "SELECT * FROM `subscribed_packages` WHERE `package_type` = '1' AND `unique_id`='$investment_id' AND `liquidation_status`=0";
      $qry = mysqli_query($dbc,$sql);
      $getdet = mysqli_fetch_array($qry);
      //$getpackdet  =  get_one_row_from_one_table('package_definition','unique_id',$investment_id);
      $liquid_stat = $getdet['liquidation_status'];
      $package_id = $getdet['package_id'];
      $packtype = $getdet['package_type'];
      $pack_unitp = $getdet['package_unit_price'];
      $no_of_slots_bought = $getdet['no_of_slots_bought'];
      $moratorium = $getdet['moratorium'];
      $multiplying_factor = $getdet['multiplying_factor'];
      $total_amount = $getdet['total_amount'];
      $float_time = $getdet['float_time']; //in days
      //$packtype = $getdet['package_type'];
      $date_created = $getdet['date_created'];
      $tenure_of_product = $getdet['tenure_of_product'];
      $flp = $getdet['free_liquidation_period'];
      $liquidation_surcharge = $getdet['liquidation_surcharge'];
      $user_id = $getdet['user_id'];
      $tenure_of_product = $getdet['tenure_of_product'];

      $surcharged_amount = 0;

      $current_date = date('Y-m-d');
      $date_created =  date('Y-m-d',strtotime($date_created));
      $dateused = strtotime($current_date) - strtotime($date_created);
    $daysused = round($dateused / (60 * 60 * 24));
    $days_remaining = $moratorium - $daysused;
    
    ///if there is no moratorium, investment starsts the next day
    if($days_remaining == 0){
        $days_remaining = 1;
    }
      if($moratorium == 0){
      $day_investment_starts_to_count = date('Y-m-d',strtotime($date_created. ' + 1 days'));
      }
      else{
      $day_investment_starts_to_count = date('Y-m-d', strtotime($date_created. ' + '.$moratorium.' days'));    
      }

      $date_used_in_investment = strtotime($current_date) - strtotime($day_investment_starts_to_count);
      $days_used_in_investment = round($date_used_in_investment / (60 * 60 * 24)) + 1; ///you can verify this line very well later


      $check_if_investment_is_on =  check_if_investment_is_on($date_created,$moratorium);
      $check_end_date_status = check_end_date_status($tenure_of_product,$date_created,$moratorium);


      if($packtype == '1'){
        if($check_if_investment_is_on == false){
        ///this investment is yet to start
        return  json_encode(["status"=>"113", "msg"=>'this investment has not started']);

        }else{
        ///investment has started but also check below if invst has ended or not

                $packageam = $getdet['package_unit_price'] * $getdet['no_of_slots_bought'];
        ///meaning the investment has ended
        if($check_end_date_status == false){ 
          $timeframe = "investment_has_ended"; 
          $prof_made_so_far = $getdet['package_unit_price'] * $getdet['multiplying_factor'] * $getdet['no_of_slots_bought'] * $tenure_of_product;
           $current_cap_bal = ($packageam) + $getdet['package_unit_price'] * $getdet['multiplying_factor'] * $getdet['no_of_slots_bought'] * $tenure_of_product ;
           $days_used_in_investment = $tenure_of_product;

        }else{
           $timeframe = "investment_has_not_ended";
           $prof_made_so_far = $getdet['package_unit_price'] * $getdet['multiplying_factor'] * $no_of_slots_bought * $days_used_in_investment;
           $current_cap_bal = ($packageam) + $getdet['package_unit_price'] * $getdet['multiplying_factor'] * $getdet['no_of_slots_bought'] * $days_used_in_investment ;
         }


         ////////the reall logic flow
         
        
        
         $amount_sent_to_wallet = json_decode(get_total_dropped_profits_per_running_investments($investment_id),true)['msg']; 



         $surcharge_status = "false";
         if( $days_used_in_investment <  $flp){ 
                          $surcharged_amount = ($getdet['liquidation_surcharge']/100) * $current_cap_bal;
                           $surcharge_status = "true";
                    }

                  $final_liquidation_amount = $current_cap_bal - $surcharged_amount - $amount_sent_to_wallet; 







         // if($amount_sent_to_wallet <= $prof_made_so_far){
            ///the main the main
    //                 $msg = '<br>User ID: '.$user_id.'<br>';
    //                  $msg .= '<br>investment  ID: '.$investment_id.'<br>';
    //                 $msg .= 'Surcharge Status: '.$surcharge_status.'<br>';
    //                 $msg .= 'End Status: '.$timeframe.'<br>';
    //                 $msg .= 'Days so far: '.number_format($days_used_in_investment).'<br>';
    //                 $msg .= 'Amount to be surcharged: '.number_format($surcharged_amount).'<br>';
    //                 $msg .= 'Profit sent to wallet already: '.number_format($amount_sent_to_wallet).'<br>';
    //                 $msg .= 'Free liquidation period: '.number_format($flp).'<br>';
    //                 $msg .= 'Liquidation surcharge: '.number_format($liquidation_surcharge).'%<br>';
    //                 $msg .= 'Capital balance: '.number_format($current_cap_bal).'<br>';
    //                 $msg .= 'AMOUNT TO BE PAID TO WALLET: '.number_format($final_liquidation_amount).'<br>';
       //   return  json_encode(["status"=>"111", "msg"=>$msg]).'<br>';
       
                return json_encode([ "status"=>"111",
                              "msg"=>"success",
                              "user_id"=>$user_id,
                              "investment_id"=>$investment_id,
                              "package_id" => $package_id,
                              "surcharge_status"=>$surcharge_status,
                              "end_date_status"=>$timeframe,
                              "days_so_far"=>intval($days_used_in_investment),
                              "amount_to_be_surcharged"=>intval($surcharged_amount),
                              "amount_sent_to_wallet"=>intval($amount_sent_to_wallet),
                              "free_liquidation_period"=>$flp,
                              "liquidation_surcharge"=>intval($liquidation_surcharge),
                              "current_cap_bal"=>$current_cap_bal,
                              "final_liquidation_amount"=>"$final_liquidation_amount",
                              "tenure_of_product" =>$tenure_of_product,
                              "no_of_slot_bought" => $no_of_slots_bought,
                              "package_unit_price" => $pack_unitp,
                              "float_time" =>$float_time,
                              "package_type" => $packtype,
                              "total_amount" => $total_amount,
                              "days_remaining" => $days_remaining,
                              "day_investment_starts_to_count" => $day_investment_starts_to_count,
                              "days_used_in_investment" => $days_used_in_investment,
                              "prof_made_so_far" => $prof_made_so_far
                              ]);

       

         // } 
          
         // else{
            ///
        //  return  json_encode(["status"=>"114", "msg"=>'you do not have any profit at the moment']);

        //  }


      
        }

      }else{
        return  json_encode(["status"=>"115", "msg"=>'liquidation is available only for fixed investment or investment not already liquidated']);
      }

  
  }
  
  ///this is for the accountant to compute
  function compute_liquidation_params_for_fixed_acc($investment_id){
      //getinvestment start date
      global $dbc;
      $sql = "SELECT * FROM `subscribed_packages` WHERE `package_type` = '1' AND `unique_id`='$investment_id' AND `liquidation_status`=1";
      $qry = mysqli_query($dbc,$sql);
      $getdet = mysqli_fetch_array($qry);
      //$getpackdet  =  get_one_row_from_one_table('package_definition','unique_id',$investment_id);
      $liquid_stat = $getdet['liquidation_status'];
      $package_id = $getdet['package_id'];
      $packtype = $getdet['package_type'];
      $pack_unitp = $getdet['package_unit_price'];
      $no_of_slots_bought = $getdet['no_of_slots_bought'];
      $moratorium = $getdet['moratorium'];
      $multiplying_factor = $getdet['multiplying_factor'];
      $total_amount = $getdet['total_amount'];
      $float_time = $getdet['float_time']; //in days
      //$packtype = $getdet['package_type'];
      $date_created = $getdet['date_created'];
      $tenure_of_product = $getdet['tenure_of_product'];
      $flp = $getdet['free_liquidation_period'];
      $liquidation_surcharge = $getdet['liquidation_surcharge'];
      $user_id = $getdet['user_id'];
      $tenure_of_product = $getdet['tenure_of_product'];

      $surcharged_amount = 0;

      $current_date = date('Y-m-d');
      $date_created =  date('Y-m-d',strtotime($date_created));
      $dateused = strtotime($current_date) - strtotime($date_created);
    $daysused = round($dateused / (60 * 60 * 24));
    $days_remaining = $moratorium - $daysused;
    
    ///if there is no moratorium, investment starsts the next day
    if($days_remaining == 0){
        $days_remaining = 1;
    }
      if($moratorium == 0){
      $day_investment_starts_to_count = date('Y-m-d',strtotime($date_created. ' + 1 days'));
      }
      else{
      $day_investment_starts_to_count = date('Y-m-d', strtotime($date_created. ' + '.$moratorium.' days'));    
      }

      $date_used_in_investment = strtotime($current_date) - strtotime($day_investment_starts_to_count);
      $days_used_in_investment = round($date_used_in_investment / (60 * 60 * 24)) + 1; ///you can verify this line very well later


      $check_if_investment_is_on =  check_if_investment_is_on($date_created,$moratorium);
      $check_end_date_status = check_end_date_status($tenure_of_product,$date_created,$moratorium);

     $sql_status_in_liquidat = "SELECT * FROM `liquidated_investments_tbl` WHERE `investment_id`='$investment_id' AND `process_status`=1";
      $qry_status_in_liquidat = mysqli_query($dbc,$sql_status_in_liquidat);
      $count_liqui = mysqli_num_rows($qry_status_in_liquidat);


      if(  ($packtype == '1') && ($count_liqui == 1)  ){
        if($check_if_investment_is_on == false){
        ///this investment is yet to start
        return  json_encode(["status"=>"113", "msg"=>'this investment has not started']);

        }else{
        ///investment has started but also check below if invst has ended or not

                $packageam = $getdet['package_unit_price'] * $getdet['no_of_slots_bought'];
        ///meaning the investment has ended
        if($check_end_date_status == false){ 
          $timeframe = "investment_has_ended"; 
          $prof_made_so_far = $getdet['package_unit_price'] * $getdet['multiplying_factor'] * $getdet['no_of_slots_bought'] * $tenure_of_product;
           $current_cap_bal = ($packageam) + $getdet['package_unit_price'] * $getdet['multiplying_factor'] * $getdet['no_of_slots_bought'] * $tenure_of_product ;
           $days_used_in_investment = $tenure_of_product;

        }else{
           $timeframe = "investment_has_not_ended";
           $prof_made_so_far = $getdet['package_unit_price'] * $getdet['multiplying_factor'] * $no_of_slots_bought * $days_used_in_investment;
           $current_cap_bal = ($packageam) + $getdet['package_unit_price'] * $getdet['multiplying_factor'] * $getdet['no_of_slots_bought'] * $days_used_in_investment ;
         }


         ////////the reall logic flow
         
        
        
         $amount_sent_to_wallet = json_decode(get_total_dropped_profits_per_running_investments($investment_id),true)['msg']; 



         $surcharge_status = "false";
         if( $days_used_in_investment <  $flp){ 
                          $surcharged_amount = ($getdet['liquidation_surcharge']/100) * $current_cap_bal;
                           $surcharge_status = "true";
                    }

                  $final_liquidation_amount = $current_cap_bal - $surcharged_amount - $amount_sent_to_wallet; 


       
                return json_encode([ "status"=>"111",
                              "msg"=>"success",
                              "user_id"=>$user_id,
                              "investment_id"=>$investment_id,
                              "package_id" => $package_id,
                              "surcharge_status"=>$surcharge_status,
                              "end_date_status"=>$timeframe,
                              "days_so_far"=>intval($days_used_in_investment),
                              "amount_to_be_surcharged"=>intval($surcharged_amount),
                              "amount_sent_to_wallet"=>intval($amount_sent_to_wallet),
                              "free_liquidation_period"=>$flp,
                              "liquidation_surcharge"=>intval($liquidation_surcharge),
                              "current_cap_bal"=>$current_cap_bal,
                              "final_liquidation_amount"=>"$final_liquidation_amount",
                              "tenure_of_product" =>$tenure_of_product,
                              "no_of_slot_bought" => $no_of_slots_bought,
                              "package_unit_price" => $pack_unitp,
                              "float_time" =>$float_time,
                              "package_type" => $packtype,
                              "total_amount" => $total_amount,
                              "days_remaining" => $days_remaining,
                              "day_investment_starts_to_count" => $day_investment_starts_to_count,
                              "days_used_in_investment" => $days_used_in_investment,
                              "prof_made_so_far" => $prof_made_so_far
                              ]);
      
        }

      }else{
        return  json_encode(["status"=>"115", "msg"=>'liquidation is available only for fixed investment or investment not already liquidated']);
      }

  
  }

  
  function get_total_recurrent_investments($investment_id){
        global $dbc;
        $total_invested_sql = "SELECT sum(unit_price_today) as `unit_price_today` FROM `recurrent_investments_tbl` WHERE `investment_id`='$investment_id'";
        $total_invested_qry = mysqli_query($dbc,$total_invested_sql);
        $num = mysqli_num_rows($total_invested_qry);
        
        if($num > 0){
             $total_invested_array = mysqli_fetch_array($total_invested_qry);
             $total_invested_value = $total_invested_array['unit_price_today'];
             return $total_invested_value;
        }else{
             $get_investment_details2 = get_one_row_from_one_table('subscribed_packages','unique_id', $investment_id);
             $total_invested_value = $get_investment_details2['total_amount'];
             return $total_invested_value;
        }
    }
    
  function get_payout_details($start_date, $end_date){
    $get_investments = get_rows_from_one_table('subscribed_packages');
    // $count_beneficiaries = 0;
    $row_display = null;
    foreach ($get_investments as $investment_details) {
      $date_created = $investment_details['date_created'];
      $moratorium = $investment_details['moratorium'];
      $investment_start_date = get_investment_start_date($date_created,$moratorium);
      $date=date_create($investment_start_date);
      $float_time_incremental = $investment_details['float_time_incremental'];
      $float_time = $investment_details['float_time'];
      date_add($date, date_interval_create_from_date_string($float_time_incremental." days"));
      $next_floating_date = date_format($date,"Y-m-d");
     if($next_floating_date >= $start_date && $next_floating_date <= $end_date && $investment_details['package_type'] == 1){
     
        $profit_per_day = $investment_details['total_amount'] * $investment_details['multiplying_factor'];
        $payouts = [
          "user_id" => $investment_details['user_id'],
          "package_id" => $investment_details['package_id'],
          "total_amount" => $investment_details['total_amount'],
          "multiplying_factor" => $investment_details['multiplying_factor'],
          "profit_per_day" => $profit_per_day,
          "total_profit" => $profit_per_day * $float_time,
          "next_floating_date" => $next_floating_date,
          "float_time" => $float_time
        ];
        $row_display[] = $payouts;
        //return $payouts;
      }
    }
    return $row_display;
  }


   function get_floating_payout_count($start_date, $end_date){
    $get_investments = get_rows_from_one_table('subscribed_packages');
    $count_beneficiaries = 0;
    $row_display = null;
    foreach ($get_investments as $investment_details) {
      $date_created = $investment_details['date_created'];
      $moratorium = $investment_details['moratorium'];
      $investment_start_date = get_investment_start_date($date_created,$moratorium);
      $date=date_create($investment_start_date);
      $float_time_incremental = $investment_details['float_time_incremental'];
      $float_time = $investment_details['float_time'];
      date_add($date, date_interval_create_from_date_string($float_time_incremental." days"));
      $next_floating_date = date_format($date,"Y-m-d");
     if($next_floating_date >= $start_date && $next_floating_date <= $end_date && $investment_details['package_type'] == 1){
        $count_beneficiaries++;
        $profit_per_day = $investment_details['total_amount'] * $investment_details['multiplying_factor'];
        $payouts = [
          "user_id" => $investment_details['user_id'],
          "package_id" => $investment_details['package_id'],
          "total_amount" => $investment_details['total_amount'],
          "multiplying_factor" => $investment_details['multiplying_factor'],
          "profit_per_day" => $profit_per_day,
          "total_profit" => $profit_per_day * $float_time,
          "next_floating_date" => $next_floating_date,
          "float_time" => $float_time
        ];
        $row_display[] = $payouts;
        //return $payouts;
      }
    }
    // return $row_display;
        return  json_encode(["status"=>"111", "count_ben"=>$count_beneficiaries, "display"=>$row_display ]);

  }
  
  function get_payout_details_for_package($start_date, $end_date, $package_id){
    $get_investments = get_rows_from_one_table_by_id('subscribed_packages', 'package_id', $package_id);
    $row_display = null;
    if($get_investments != null){
      foreach ($get_investments as $investment_details) {
        $date_created = $investment_details['date_created'];
        $moratorium = $investment_details['moratorium'];
        $investment_start_date = get_investment_start_date($date_created,$moratorium);
        $date=date_create($investment_start_date);
        $float_time_incremental = $investment_details['float_time_incremental'];
        $float_time = $investment_details['float_time'];
        date_add($date, date_interval_create_from_date_string($float_time_incremental." days"));
        $next_floating_date = date_format($date,"Y-m-d");
       if($next_floating_date >= $start_date && $next_floating_date <= $end_date && $investment_details['package_type'] == 1){
          $profit_per_day = $investment_details['total_amount'] * $investment_details['multiplying_factor'];
          $payouts = [
            "user_id" => $investment_details['user_id'],
            "package_id" => $investment_details['package_id'],
            "total_amount" => $investment_details['total_amount'],
            "multiplying_factor" => $investment_details['multiplying_factor'],
            "profit_per_day" => $profit_per_day,
            "total_profit" => $profit_per_day * $float_time,
            "next_floating_date" => $next_floating_date,
            "float_time" => $float_time
          ];
          $row_display[] = $payouts;
          //return $payouts;
        }
      }
    }
    return $row_display;
  }
  
  function check_users_without_wallets_and_update(){
      global $dbc;
      $sql = "SELECT * FROM `users_tbl` WHERE `access_level`=1";
      $qry = mysqli_query($dbc,$sql);
      $num = mysqli_num_rows($qry);
      $countt = 0;
      if($num > 0){
        while($row = mysqli_fetch_array($qry) ){
            $check_wallet = get_one_row_from_one_table('wallet_tbl','user_id',$row['unique_id']);
            
            if($check_wallet == null){
                $countt++;
                echo " ".$row['unique_id'].'--'.$row['other_names'].'---'.$row['surname'].":::NO WALLET<br>";   
                $user_id = $row['unique_id'];
                $unique_id = unique_id_generator($row['surname'].$user_id);
                    
                    $creat_wallet = "INSERT INTO `wallet_tbl` SET
                    `unique_id`='$unique_id',
                    `user_id`='$user_id',
                    `balance`=0,
                    `date_created`=now()
                    ";
                    $creat_qry = mysqli_query($dbc,$creat_wallet);
            }
          
       
       }  
       echo $countt.' results';  
      }else{
        echo "No record found";   
      }
      
  }
  
/////////new functions dec 1 2020 ends  
  



?>