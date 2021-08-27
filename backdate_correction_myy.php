<?php     require_once('classes/algorithm_functions.php'); 
            
            if(isset($_POST['cmd_backdate'])){
                    $invtid = $_POST['invtid'];
                    $profit = $_POST['profit'];
                    $newfloat = $_POST['float_time'];
                    
                    repair_float_time($invtid,$profit,$newfloat);
                    echo "success";
            }
            
        

?>
<!DOCTYPE html>
<html>
<head>
  <title>correction</title>
</head>
<body>
     <h3>Backdate Update</h3>
     
         <?php 
                
            $backdate =     backdateoooo();
           // $backdate;
             $backdate_dec = json_decode($backdate,true);
             for($i = 0; $i < count($backdate_dec); $i++){
                 if($backdate_dec[$i]['yawa_status'] == 'yawa'){
                        
                    echo 'investmentid '. $backdate_dec[$i]['investmentid'].' <br>';
                    echo 'status '. $backdate_dec[$i]['yawa_status'].' <br>';
                     echo 'Backdate '. $backdate_dec[$i]['backdate'].' <br>';
                     
                      echo 'Date of backdate '. $backdate_dec[$i]['date_backdate_was_done'].' <br>';
                      echo 'Moratorium '. $backdate_dec[$i]['moratorium'].' <br>';
                     echo 'investment_start_date '. $backdate_dec[$i]['date_investment_starts'].' <br>';
                    echo 'floating_days_last_migration '. $backdate_dec[$i]['floating_days_last_migration'].' <br>';
                    echo 'accrued_days_last_migration '. $backdate_dec[$i]['accrued_days_last_migration'].' <br>';
                     echo 'total_days_last '. $backdate_dec[$i]['total_days_last'].' <br>';
                    echo 'days_lasttime_till_now '.  $backdate_dec[$i]['days_lasttime_till_now'].' <br>';
                    echo 'days_lasttime_till_now_accrued '.  $backdate_dec[$i]['days_lasttime_till_now_accrued'].' <br>';
                    echo 'days_lasttime_till_now_floating '.  $backdate_dec[$i]['days_lasttime_till_now_floating'].' <br>';
                    echo '<strong>total_current_float</strong> '. $backdate_dec[$i]['total_current_float'].' <br>';
                    echo '<strong>actual_float_time</strong> '.  $backdate_dec[$i]['float_time'].' <br>';
                     echo '<strong>current float_time_incremental</strong> '.  $backdate_dec[$i]['float_incremental'].' <br>';
                        echo '<strong>user id</strong> '.  $backdate_dec[$i]['user_id'].' <br>';
                         echo '<strong>wallet balance</strong> '.  $backdate_dec[$i]['wallet_balance'].' <br>';
                    
                    echo 'accrued_days_count '. $backdate_dec[$i]['accrued_days_count'].' <br>';
                    echo 'grand_total_days '.  $backdate_dec[$i]['grand_total_days'].' <br>';
                    echo 'grand_total_days_accrued '.  $backdate_dec[$i]['grand_total_days_accrued'].' <br>';
                    echo 'grand_total_days_floating '.  $backdate_dec[$i]['grand_total_days_floating'].' <br>';
                    echo 'profit_per_day for 1 float time '.  $backdate_dec[$i]['profit_per_day'].' <br>';   
                      echo 'total_amount '.  $backdate_dec[$i]['total_amount'].' <br>';   
                    
                   
                    echo $backdate_dec[$i]['msg'].' <br>';
                    
                    if(   $backdate_dec[$i]['floating_days_last_migration']   <= 10 && ( $backdate_dec[$i]['float_time'] == 30) && $backdate_dec[$i]['yawa_status'] == 'safe'){
                            echo "WATCH CAREFULLY";   
                    }
                    
                    $getdet = get_one_row_from_one_table('log_backdate_repair','investment_id',$backdate_dec[$i]['investmentid']);
                    if($getdet == null){
                    
                    ?>
                    <form method='post' action=''>
                        <label><strong>Update Added Profit Log:</strong> </label><br><br>
                        investmentid: <input type='text' name="invtid" ><br><br>
                        profit: <input type='text' name="profit"><br><br>
                        floattime incremental: <input type='text' name="float_time"><br><br>
                        <input type='submit' value='BACKDATE' name='cmd_backdate' id='cmd_backdate'>
                        
                    </form>
                    
                    <?php  } else{  echo "<strong>DONE</strong>"; } echo '<hr><hr>';
                        
                 }
             }
         ?>
        <!--<form>-->
              
                  
        <!--       <label>Investment ID</label>-->
        <!--        <input type='text' name='investment_id' id='investment_id'><br><br>-->
            
        <!--       <label>Backdate</label>-->
        <!--       <input type='text' name='backdate_date' id='backdate_date'><br><br>-->
               
        <!--       <label>Date Done</label>-->
        <!--       <input type='text' name='date_done' id='date_done'><br><br>-->
                
        <!--        <label>Today's Date:<input type='text' value='<?php echo date('d-m-y'); ?>' name='today' id='today'></label><br><hr>-->
        <!--        <input type='submit' value='compute' name='cmd_compute'>-->
        
        <!--</form>-->
 
     

</body>
</html>