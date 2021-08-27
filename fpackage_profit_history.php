<?php include('includes/instantiated_files.php');
include('classes/algorithm_functions.php');
include('includes/header.php'); 

$created_by = $_SESSION['uid'];

///quick functions for package logic
// function liquidate_investment($investment_id,$user_id,$amount_tobe_added,$days_so_far,){
    
// }

///quick functions for package logic ends here

if( isset($_GET['pid'])  && isset($_GET['usid']) && isset($_GET['unid']) ){
   $pid = $_GET['pid'];
   $usid = $_GET['usid'];
   $unid = $_GET['unid'];
   
   $compute_liquidation = compute_liquidation_params_for_fixed($unid);
 $compute_liquidation_decode = json_decode($compute_liquidation, true);
 $get_package_details = $object->get_one_row_from_one_table('package_definition','unique_id',$compute_liquidation_decode['package_id']);
 $pk_det_name = $get_package_details['package_name'];
 $surcharge_status = $compute_liquidation_decode['surcharge_status'];
 $days_so_far = $compute_liquidation_decode['days_so_far'];
 $amount_to_be_surcharged = $compute_liquidation_decode['amount_to_be_surcharged'];
 $amount_sent_to_wallet = $compute_liquidation_decode['amount_sent_to_wallet'];
 $free_liquidation_period = $compute_liquidation_decode['free_liquidation_period'];
 $liquidation_surcharge = $compute_liquidation_decode['liquidation_surcharge'];
 $current_cap_bal = $compute_liquidation_decode['current_cap_bal'];
 $final_liquidation_amount = $compute_liquidation_decode['final_liquidation_amount'];
 $tenure_of_product = $compute_liquidation_decode['tenure_of_product'];
 $no_of_slot_bought = $compute_liquidation_decode['no_of_slot_bought'];
 $package_unit_price = $compute_liquidation_decode['package_unit_price'];
 $float_time = $compute_liquidation_decode['float_time'];
 $total_amount = $compute_liquidation_decode['total_amount'];
 $days_remaining = $compute_liquidation_decode['days_remaining'];
 $day_investment_starts_to_count = $compute_liquidation_decode['day_investment_starts_to_count'];
 $days_used_in_investment = $compute_liquidation_decode['days_used_in_investment'];
 $prof_made_so_far = $compute_liquidation_decode['prof_made_so_far'];
 $current_date = date('Y-m-d');

   
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
         
              <h3 class="mb-0"><a href="mypackages" style="font-size:12px;">back</a> | <?php if(!empty($msg)){echo $msg; }else{ ?>Profit History for selected package: <?php echo $pk_det_name; } ?></h3></h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if(!empty($msg)){
                        echo "<tr><td><?php echo $msg; ?></td></tr>";
                      } 
                      
                      else if($tenure_of_product == 'inf'){ 
                      
                        if(   $day_investment_starts_to_count > $current_date && $days_remaining >= 0 ){
                            echo "<tr><td>Your investment is still in the waiting period...It starts counting in ".$days_remaining." day(s)</td></tr>";
                        }else{
                        //
                      ?>
                         <!--//FOR INFINITE PACKAGE-->
                         <div class="row"><div class="col-md-2"></div><div class="col-md-8"><span style="color:green;"><strong>Tenure Type: INFINITE<br> Check below for your profit details as at today: <?php echo $object->format_date(date('Y-m-d')); ?></span></div></div></div><br>
                         <tr><td>Package Amount: <?php echo '&#8358;'.number_format(  $total_amount  );?></td></tr>
                         <tr><td>Days of Investment so far: <?php echo $days_used_in_investment; ?> days</td></tr>
                         <tr><td>Profit per day: <?php echo '&#8358;'.number_format($get_package_details['package_unit_price'] * $get_package_details['multiplying_factor'] * $get_package_details['no_of_slots_bought']); ?></td></tr>
                         <tr><td>Profit sent to wallet already: <?php echo "&#8358;". number_format($amount_sent_to_wallet);   ?></td></tr>
                          <tr><td>Total Profit so far: <?php echo  '&#8358;'.number_format($prof_made_so_far); ?></td></tr>
                          <!--<tr><td>Capital Balance so far: <?php // echo  '&#8358;'.  number_format( $current_cap_bal  ) ; ?></td></tr>-->
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
                                        To liquidate your investment, kindly take note of the following:<br>
                                        Free Liquidation Period: After <?php echo $free_liquidation_period ?> days <br>
                                        Days so far:  <?php echo $days_used_in_investment; ?> days<br>
                                        <?php if( $days_used_in_investment <  $free_liquidation_period){ 
                                        echo "There will be a ". $liquidation_surcharge.'% surcharge of your total capital balance so far i.e &#8358;'. number_format($current_cap_bal) ; 
                                        }  ?><br>
                                        
                                        <?php 
                                             //check if there is any money sent to wallet, if not, amount_sent_to_wallet = 0;
                                             //$check_profit_so_far = $prof_made_so_far - $amount_sent_to_wallet;
                                           if($amount_sent_to_wallet <= $prof_made_so_far){?>
                                            Amount to be surcharged: <?php echo "&#8358;". number_format($amount_to_be_surcharged);   ?><br>
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
                                        <!-- end of view Modal -->
                          
                     <?php
                     
                        }//ends the case of a running investment
                            
                        }
                      
                      else{
                      
                       if(   $day_investment_starts_to_count > $current_date && $days_remaining >= 0){
                            echo "<tr><td>Your investment is still in the waiting period...It starts counting in ".$days_remaining." day(s)</td></tr>";
                        }else{ 
                            
                            //$packageam = $get_package_details['package_unit_price'] * $no_of_slot_bought;
                            $profperday = $package_unit_price * $get_package_details['multiplying_factor'] * $no_of_slot_bought;
                            $prof_after_invst = $package_unit_price * $get_package_details['multiplying_factor'] * $no_of_slot_bought * $tenure_of_product;
                      ?>
                  <div class="row"><div class="col-md-2"></div><div class="col-md-8"><span style="color:green;"><strong>Tenure Type: FINITE | Start Date: <?php echo $object->format_date($day_investment_starts_to_count); ?><br> </span></div></div></div><br>
                         <tr><td>Package Amount: <?php echo '&#8358;'.number_format(  $total_amount  );?></td></tr>
                         <tr><td>Tenure of Product: <?php echo number_format($tenure_of_product); ?> days</td></tr>
                         <tr><td>Days of Investment so far: <?php echo number_format($days_used_in_investment); ?> days</td></tr>
                         <tr><td>Profit per day: <?php echo '&#8358;'.number_format($profperday); ?></td></tr>
                         <tr><td>Profit sent to wallet already: <?php echo "&#8358;". number_format($amount_sent_to_wallet);   ?></td></tr>
                         <tr><td>Total Profit at the end of investment: <?php echo  '&#8358;'.number_format($prof_after_invst); ?></td></tr>
                         <tr><td>Total Profit so far: <?php echo  '&#8358;'.number_format($prof_made_so_far); ?></td></tr>
                         <tr><td>Total Profit in subsequent days: <?php echo  '&#8358;'.number_format($prof_after_invst - $prof_made_so_far); ?></td></tr>
                         <tr><td>Remaining Days: <?php  echo number_format($tenure_of_product - $days_used_in_investment); ?> days</td></tr>
                         <!--<tr><td>Capital Balance at the end of Investment: <?php //echo  '&#8358;'.number_format($total_amount + $prof_after_invst); ?></td></tr>-->
                         <tr><td><a class="btn btn-sm btn-success" href="fpackage_profit_history2?unid=<?php echo $unid; ?>&pid=<?php echo $pid; ?>&usid=<?php echo $usid; ?>">View Profit Breakdown</a></td></tr>
                         
                         <tr><td><a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirm_investment" href="#" id="liquidate_invst">Liquidate Investment</a></td></tr>
                                        
                                        <!-- View Modal-->
                                        <div class="modal fade" id="confirm_investment"  role="dialog" aria-labelledby="myLargeModalLabel"  aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content modal-lg ">
                                        <div class="modal-header">
                                        <h2 class="modal-title" id="exampleModalLabel"> Liquidating Package: <?php echo $pk_det_name;?></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <!-- <table class="table align-items-center table-flush"> -->
                                        <div id="confirm_liquidate" style="color:green; font-size: 12px;">
                                        To liquidate your investment, kindly take note of the following:<br>
                                        Free Liquidation Period: After <?php echo $free_liquidation_period; ?> days <br>
                                        Days so far:  <?php echo $days_used_in_investment; ?> days<br>
                                        <?php if( $days_used_in_investment <  $free_liquidation_period){ 
                                        echo "There will be a ". $liquidation_surcharge.'% surcharge of your total capital balance so far i.e &#8358;'. number_format($current_cap_bal) ; 
                                        }  ?><br>
                                            
                                            Amount to be surcharged: <?php echo "&#8358;". number_format($amount_to_be_surcharged);   ?><br>
                                            Profit sent to wallet already: <?php echo "&#8358;". number_format($amount_sent_to_wallet);   ?><br>
                                            
                                         <?php 
                                             //check if there is any money sent to wallet, if not, amount_sent_to_wallet = 0; 
                                             //$check_profit_so_far = $prof_made_so_far - $amount_sent_to_wallet;
                                         if($amount_sent_to_wallet <= $prof_made_so_far){?>
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