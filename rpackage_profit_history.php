<?php include('includes/instantiated_files.php');
include('classes/algorithm_functions.php');
include('includes/header.php'); 
$created_by = $_SESSION['uid'];
if( isset($_GET['unid']) ){
   $unid = $_GET['unid'];
   $user_package = $object->get_one_row_from_one_table('subscribed_packages','unique_id',$unid);
   $pid = $user_package['package_id'];
   $usid = $user_package['user_id'];
   $package_details  =  $object->get_one_row_from_one_table('package_definition','unique_id',$pid);
   $moratorium = $user_package['moratorium']; 
   //$day_investment_starts_to_count = date('Y-m-d', strtotime($user_package['date_created']. ' + '.$moratorium.' days'));
    
    if($moratorium == 0){
    $day_investment_starts_to_count = date('Y-m-d',strtotime($user_package['date_created']. ' + 1 days'));
    }
    else{
    $day_investment_starts_to_count = date('Y-m-d', strtotime($user_package['date_created']. ' + '.$moratorium.' days'));    
    }
    
    $current_date = date('Y-m-d');
    $date_created = date('Y-m-d',strtotime($user_package['date_created']));
    $dateused = strtotime($current_date) - strtotime($date_created);
    $daysused = round($dateused / (60 * 60 * 24));
    $days_remaining = $moratorium - $daysused;
    
    ///if there is no moratorium, investment starsts the next day
    if($days_remaining == 0){
        $days_remaining = 1;
    }
    ///if there is no moratorium, investment starsts the next day ends here
    
    $date_used_in_investment = strtotime($current_date) - strtotime($day_investment_starts_to_count);
    //$days_used_in_investment = round($date_used_in_investment / (60 * 60 * 24));
    $days_used_in_investment = round($date_used_in_investment / (60 * 60 * 24)) + 1; ///you can verify this line very well later

   
}else{
    $msg = "You are not supposed to be here...";
}


$get_documents = $object->get_rows_from_table_by_user_id('document_tbl','user_id',$created_by);
$get_admin_documents = $object->get_rows_from_one_table_by_id('admin_document_tbl', 'shared_status', 1);


?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->


    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8"  >
     
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->

      <div class="row" style="margin-top: -160px;">

        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
                        <!-- Button trigger modal -->
          <!--<button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#add_slot_modal"><i class="fas fa-plus-circle"></i> -->
          <!--  Upload Documents-->
          <!--</button>-->

            <!-- Modal -->
         
              <h3 class="mb-0"><a href="mypackages" style="font-size:12px;">back</a> | <?php  if(!empty($msg)){echo $msg; }else{ ?>Profit History for selected package: <?php echo $package_details['package_name']; } ?></h3></h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if(!empty($msg)){
                        echo "<tr><td><?php echo $msg; ?></td></tr>";
                      } 
                      
                      else if($user_package['tenure_of_product'] == 'inf'){ 
                      
                        if(   $day_investment_starts_to_count > $current_date && $days_remaining >= 0 ){
                            echo "<tr><td>Your investment is still in the waiting period...It starts counting in ".$days_remaining." day(s)</td></tr>";
                        }else{
                           
                                $slotss = $user_package['no_of_slots_bought'];
                                
                                //current profit state--this comes from db
                                $totalpsofar  = recurrent_sum_of_profits_per_investment($unid);
                                $totdec = json_decode($totalpsofar,true);
                                $totalpsofar2 = $totdec['msg'];
                                
                                
                                $deductsofar  = recurrent_sum_of_deductions_per_investment($unid);
                                $deductsofardec = json_decode($deductsofar,true);
                                $deductsofar2 = $deductsofardec['msg'];
                                
                                $contribtion_profit = $totalpsofar2 + $deductsofar2;
                           
                               $contribution_every_day = $slotss * $user_package['package_unit_price'];
                               $amount_sent_to_wallet = json_decode(get_total_dropped_profits_per_running_investments($unid),true)['msg'];
                           
                      ?>
                            <!--//FOR INFINITE PACKAGE-->
                         <div class="row"><div class="col-md-2"></div><div class="col-md-8"><span style="color:green;"><strong>Tenure Type: INFINITE<br> Check below for your profit details as at today: <?php echo $object->format_date(date('Y-m-d')); ?></span></div></div></div><br>
                            
                         <tr><td>  Slots Bought: <?php echo number_format($slotss); ?></td></tr>
                         <tr><td>  Package Unit Price: <?php echo '&#8358;'.number_format($user_package['package_unit_price']); ?></td></tr>
                         <tr><td>  Expected Daily Contribution: <?php echo '&#8358;'.number_format($contribution_every_day); ?></td></tr>
                        
                       
                         <tr><td><h2>Your investment details so far</h2></td></tr>
                        
                         <tr><td>Your Contribution So Far: <?php echo "&#8358;". number_format($deductsofar2);   ?></td></tr>
                          <tr><td>Profit Sent to Wallet Already: <?php echo "&#8358;". number_format($amount_sent_to_wallet);   ?></td></tr>
                         <tr><td>Your Profit So Far: <?php echo "&#8358;". number_format($totalpsofar2);   ?></td></tr>
                         <tr><td>Days So Far: <?php echo $days_used_in_investment;   ?></td></tr>
                         <tr><td>Your Contribtion + Profit So Far: <?php echo "&#8358;". number_format($contribtion_profit);   ?></td></tr>
                        
                         <tr><td><a class="btn btn-sm btn-success" href="rpackage_profit_history2?unid=<?php echo $unid; ?>">View Profit Breakdown</a></td></tr>
                         
                         <tr><td><a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirm_investment" href="#" id="liquidate_invst">Liquidate Investment</a></td></tr>
                                        
                           <!-- View Modal-->
                                        <div class="modal fade" id="confirm_investment"  role="dialog" aria-labelledby="myLargeModalLabel"  aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content modal-lg ">
                                        <div class="modal-header">
                                        <h2 class="modal-title" id="exampleModalLabel"> Liquidating Package: <?php echo $package_details['package_name'];?></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <!-- <table class="table align-items-center table-flush"> -->
                                        <div id="confirm_liquidate" style="color:red; font-size: 12px;">
                                        <?php   
                                             $surcharged_amount = 0;
                                            
                                             
                                        ?>
                                        To liquidate your investment, kindly take note of the following:<br>
                                        Free Liquidation Period: After <?php echo $flp = $user_package['free_liquidation_period']; ?> days <br>
                                        Days so far:  <?php echo $days_used_in_investment; ?> days<br>
                                        <?php if( $days_used_in_investment <  $flp){ 
                                        echo "There will be a ". $user_package['liquidation_surcharge'].'% surcharge of your total capital balance so far i.e &#8358;'. number_format($contribtion_profit) ; 
                                           $surcharged_amount = ($user_package['liquidation_surcharge']/100) * $contribtion_profit;
                                        }  ?><br>
                                        
                                        <?php 
                                             //check if there is any money sent to wallet, if not, amount_sent_to_wallet = 0;
                                             $final_liquidation_amount = $contribtion_profit - $surcharged_amount - $amount_sent_to_wallet; 
                                             //$check_profit_so_far = $prof_made_so_far - $amount_sent_to_wallet;
                                           if($amount_sent_to_wallet <= $totalpsofar2){?>
                                            Amount to be surcharged: <?php echo "&#8358;". number_format($surcharged_amount);   ?><br>
                                            Profit sent to wallet already: <?php echo "&#8358;". number_format($amount_sent_to_wallet);   ?><br>
                                            Amount to be paid to wallet: <?php echo "&#8358;". number_format($final_liquidation_amount);   ?><br>
                                            <span style="font-size:18px;">Are you sure you want to liquidate your investment? </span> <br>
                                            
                                            <form method="post" id="liquidate_form">
                                                <input type="hidden" name="investment_id" id="investment_id" value="<?php echo $unid; ?>">
                                                <input type="hidden" name="days_so_far" id="days_so_far" value="<?php echo $days_used_in_investment; ?>">
                                                <input type="hidden" name="final_liquidation_amount" id="final_liquidation_amount" value="<?php echo $final_liquidation_amount; ?>">
                                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $usid; ?>">
                                                <input type="submit" class="btn btn-sm btn-success" value="Yes, I want to liquidate my investment" id="cmd_liquidate" name="cmd_liquidate">
                                                
                                            </form>
                                            
                                            |  <a href="#" data-dismiss="modal">Cancel</a> 
                                      
                                        <?php } else{?>
                                           Sorry, you do not have any profit to be withdrawn at this point of liquidation....<br>
                                        <?php } ?>
                                          
                                          </div>
                                        </div>
                                        
                                        </div>
                                        </div>
                                        </div>
                                        <!-- end of view Modal for liquida -->
                          
                     <?php
                     
                        }//ends the case of a running investment
                            
                        }
                      
                      
                      //////FINTITE
                      else{
                      
                       if(   $day_investment_starts_to_count > $current_date && $days_remaining >= 0){
                            echo "<tr><td>Your investment is still in the waiting period...It starts counting in ".$days_remaining." day(s)</td></tr>";
                        }else{
                            
                            //expectations all conditions being equal
                            $investment_profit_details = recurrent_total_expected_investment_details_per_investment_finite($unid);
                            $investment_profit_details_decode = json_decode($investment_profit_details,true);
                            $contribution_every_day = $investment_profit_details_decode['contribution_every_day'];
                            $total_cb = $investment_profit_details_decode['total_cb'];
                            $total_profit = $investment_profit_details_decode['total_profit'];
                            $slotss = $user_package['no_of_slots_bought'];
                            
                            //current profit state--this comes from db
                            $totalpsofar  = recurrent_sum_of_profits_per_investment($unid);
                            $totdec = json_decode($totalpsofar,true);
                            $totalpsofar2 = $totdec['msg'];
                       
                            
                            $deductsofar  = recurrent_sum_of_deductions_per_investment($unid);
                            $deductsofardec = json_decode($deductsofar,true);
                            $deductsofar2 = $deductsofardec['msg'];
                            
                            $contribtion_profit = $totalpsofar2 + $deductsofar2;
                            
                            $amount_sent_to_wallet = json_decode(get_total_dropped_profits_per_running_investments($unid),true)['msg'];
                           
                            
                            
                      ?>
                  <div class="row"><div class="col-md-2"></div><div class="col-md-8"><span style="color:green;"><strong>Tenure Type: FINITE | Start Date: <?php echo $object->format_date($day_investment_starts_to_count); ?><br> </span></div></div></div><br>
                   
                         <tr><td>Tenure of Product: <?php echo number_format($user_package['tenure_of_product']); ?> days</td></tr>
                         <tr><td>  Slots Bought: <?php echo number_format($slotss); ?></td></tr>
                         <tr><td>  Package Unit Price: <?php echo '&#8358;'.number_format($user_package['package_unit_price']); ?></td></tr>
                         <tr><td>  Expected Daily Contribution: <?php echo '&#8358;'.number_format($contribution_every_day); ?></td></tr>
                          <tr><td> Total Expected Capital Balance: <?php echo '&#8358;'.number_format($total_cb); ?></td></tr>
                         <tr><td>Total Expected Profit: <?php echo "&#8358;". number_format($total_profit);   ?></td></tr>
                       
                         <tr><td><h2>Your investment details so far</h2></td></tr>
                        
                         <tr><td>Your Contribution So Far: <?php echo "&#8358;". number_format($deductsofar2);   ?></td></tr>
                          <tr><td>Profit sent to wallet already: <?php echo "&#8358;". number_format($amount_sent_to_wallet);   ?><br>
                         <tr><td>Your Profit So Far: <?php echo "&#8358;". number_format($totalpsofar2);   ?></td></tr>
                         <tr><td>Days So Far: <?php echo $days_used_in_investment;   ?></td></tr>
                         <tr><td>Your Contribtion + Profit So Far: <?php echo "&#8358;". number_format($contribtion_profit);   ?></td></tr>
                         
                        
                         <tr><td><a class="btn btn-sm btn-success" href="rpackage_profit_history2?unid=<?php echo $unid; ?>">View Profit Breakdown</a></td></tr>
                         
                         <tr><td><a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirm_investment" href="#" id="liquidate_invst">Liquidate Investment</a></td></tr>
                                        
                                        <!-- View Modal-->
                                        <div class="modal fade" id="confirm_investment"  role="dialog" aria-labelledby="myLargeModalLabel"  aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content modal-lg ">
                                        <div class="modal-header">
                                        <h2 class="modal-title" id="exampleModalLabel"> Liquidating Package: <?php echo $package_details['package_name'];?></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <!-- <table class="table align-items-center table-flush"> -->
                                        <div id="confirm_liquidate" style="color:green; font-size: 12px;">
                                        <?php   
                                            $surcharged_amount = 0;  
                                           
                                        ?>
                                        To liquidate your investment, kindly take note of the following:<br>
                                        Free Liquidation Period: After <?php echo $flp = $user_package['free_liquidation_period']; ?> days <br>
                                        Days so far:  <?php echo $days_used_in_investment; ?> days<br>
                                        <?php if( $days_used_in_investment <  $flp){ 
                                        echo "There will be a ". $user_package['liquidation_surcharge'].'% surcharge of your total capital balance so far i.e &#8358;'. number_format($contribtion_profit) ; 
                                        $surcharged_amount = ($user_package['liquidation_surcharge']/100) * $contribtion_profit;
                                        }  ?><br>
                                            
                                            Amount to be surcharged: <?php echo "&#8358;". number_format($surcharged_amount);   ?><br>
                                            Profit sent to wallet already: <?php echo "&#8358;". number_format($amount_sent_to_wallet);   ?><br>
                                            
                                         <?php 
                                             //check if there is any money sent to wallet, if not, amount_sent_to_wallet = 0;
                                             $final_liquidation_amount = $contribtion_profit - $surcharged_amount - $amount_sent_to_wallet; 
                                             //$check_profit_so_far = $prof_made_so_far - $amount_sent_to_wallet;
                                         if($amount_sent_to_wallet <= $totalpsofar2){?>
                                              Amount to be paid to wallet: <?php echo "&#8358;". number_format($final_liquidation_amount);   ?>
                                              <br>
                                            
                                            <form method="post" id="liquidate_form">
                                                <input type="hidden" name="investment_id" id="investment_id" value="<?php echo $unid; ?>">
                                                <input type="hidden" name="days_so_far" id="days_so_far" value="<?php echo $days_used_in_investment; ?>">
                                                <input type="hidden" name="final_liquidation_amount" id="final_liquidation_amount" value="<?php echo $final_liquidation_amount; ?>">
                                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $usid; ?>">
                                                <input type="submit" class="btn btn-sm btn-danger" value="Yes, I want to liquidate my investment" id="cmd_liquidate" name="cmd_liquidate">
                                               
                                            </form>
                                            |   &nbsp;&nbsp;&nbsp;  <a href="#" data-dismiss="modal">Cancel</a> 
                                      
                                        <?php } else{?>
                                           Sorry, you do not have any profit to be withdrawn at this point of liquidation....<br>
                                        <?php } ?>
                                         </div>
                                        </div>
                                        
                                        </div>
                                        </div>
                                        </div>
                                        <!-- end of view Modal -->
                </thead>
                <?php }   } ?>
              </table><br><br>
            </div>


            <div class="card-footer py-4">
              <!-- <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav> -->
            </div>
          </div>
        </div>
      </div>
      
          
      <br>
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>

  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        // $('#confirm_liquidate').hide();
        // $('#liquidate_invst').click(function(){
        //   $('#confirm_liquidate').fadeIn(); 
        // });
        
        
        
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
  </script>