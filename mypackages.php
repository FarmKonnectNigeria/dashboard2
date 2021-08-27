<?php include('includes/instantiated_files.php');
include('classes/algorithm_functions.php');
include('includes/header.php'); 
// $getpack = $object->get_rows_from_one_table_by_id('subscribed_user_tbl','user_id',$uid);
$getpack = $object->get_rows_from_one_table_by_id('subscribed_packages','user_id',$uid);

?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
       

            
             
             <?php
             
             if($getpack == null){
                 
                 echo "You have not subscribed to any package";
                 
             }else{
             
              $count = 1;
              //print_r($getpack);
              foreach($getpack as $pack){ 
                     $package_details  =  $object->get_one_row_from_one_table('package_definition','unique_id',$pack['package_id']);
                     $getcat = $object->get_one_row_from_one_table('package_category','unique_id',$package_details['package_category']);


                if($count%3 === 1){
                    echo '<div class="row">';
                   }
               ?>

                  <div class="col-xl-4 col-md-4 col-lg-6">
                  <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                  <div class="row">
                  <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $package_details['package_name']; ?></h5>
                  <br>
                  <img class="card-img-top" style="max-height:150px;"  src="admin/<?php echo $package_details['image_url'];?>" alt="Package Image"><hr>
                  <!-- <a href="#" class="btn btn-sm btn-primary">view details</a> -->
                  
                  <?php if($pack['liquidation_status'] == 0){ ?>
                        <button type="button" class="btn btn-sm btn-success"  data-toggle="modal" data-target="#view<?php echo $pack['unique_id']; ?>">View package details</button><!--  | <a class="btn btn-sm btn-success" href="#">investment details</a> -->
                   <?php } else{ 
                      $liquidated_details = json_decode(get_single_liquidated_investment($pack['unique_id']),true)['msg'];
                      if($liquidated_details['process_status'] == 0 ){ $status = "<small style='color:blue;'>Pending</small>| <a href='#' style='color:green;font-size:11px;'>UNDO LIQUIDATION PROCESS</a>";} 
                      if($liquidated_details['process_status'] == 1 ){ $status = "<small style='color:blue;'>In Progress</small> | <a href='#'>UNDO LIQUIDATION PROCESS</a>";}
                      if($liquidated_details['process_status'] == 2 ){ $status = "<small style='color:green;'>Completed</small>";}
                      if($liquidated_details['process_status'] == 3 ){ $status = "<small style='color:red;'>Rejected</small>";}
                   ?>
                        <div class="btn btn-sm btn-danger">Liquidated Package</div><br>
                        Liquidated Amount: (<?php echo  '&#8358;'.number_format($liquidated_details['amount_to_be_liquidated']); ?>)<br>
                        <br> (<?php echo  $status; ?>)
                        
                <?php } ?>
                  
                                    
                  
                  </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                  <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> Bought <?php echo $pack['no_of_slots_bought']; ?> slots</span>
                  <!-- <span class="text-nowrap">Since last week</span> -->
                  </p>
                  </div>
                  </div>
                  </div>



                       <!-- View Modal-->
                  <div class="modal fade" id="view<?php echo $pack['unique_id']; ?>"  role="dialog" aria-labelledby="myLargeModalLabel"  aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-scrollable modal-lg" role="document">
                      <div class="modal-content modal-lg ">
                        <div class="modal-header">
                          <h2 class="modal-title" id="exampleModalLabel"> Details for the package: <?php echo $package_details['package_name'];?></h2>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                             <!-- <table class="table align-items-center table-flush"> -->
                              <table class="table  table-striped">   
                                  
                                  <?php 
                                        $investmentid = $pack['unique_id'];
                                        if( $pack['package_type'] == '1'  ){
                                                        $type = "Fixed Package";
                                                        $balance_title = "Total Amount Invested";
                                                        $total_amount = $pack['total_amount'];
                                                        $get_floating_profit = get_details_for_a_running_investment($investmentid);
                                                        $get_floating_profit_dec = json_decode($get_floating_profit,true);
                                                        $floating_profit = $get_floating_profit_dec['floating_profit'];
                    
                    
                                        }else{
                                                        $type = "Recurrent Package";
                                                        $balance_title = "Total Amount Invested";
                                                        
                                                        $get_total_amount = recurrent_sum_of_deductions_per_investment($investmentid);
                                                        $get_total_amount_dec = json_decode($get_total_amount,true);
                                                        $total_amount = $get_total_amount_dec['msg'];
                                                        
                                                        $get_floating_profit = recurrent_sum_of_profits_per_investment($investmentid);
                                                        $get_floating_profit_dec = json_decode($get_floating_profit,true);
                                                        $floating_profit = $get_floating_profit_dec['msg'];
                                            
                                                        //$incubation_period = $pack['incubation_period'];
                                                        //$recurrence_type = $pack['recurrence_type'];
                                                        //$contribution_period = $pack['contribution_period'];
                                                        
                                        }
                                      $moratorium = $pack['moratorium'];
                                    if($moratorium == 0){
                                    $day_investment_starts_to_count = date('Y-m-d',strtotime($pack['date_created']. ' + 1 days'));
                                    }
                                    else{
                                    $day_investment_starts_to_count = date('Y-m-d', strtotime($pack['date_created']. ' + '.$moratorium.' days'));    
                                    }
                                      //$day_investment_starts_to_count = date('Y-m-d', strtotime($pack['date_created']. ' + '.$moratorium.' days'));
                                      $current_date = date('Y-m-d');
                                      $date_created = date('Y-m-d',strtotime($pack['date_created']));
                                      $dateused = strtotime($current_date) - strtotime($date_created);
                                      $daysused = round($dateused / (60 * 60 * 24));
                                      $days_remaining = $moratorium - $daysused;
                                      
                                  
                                
                                if( strtotime($current_date) >= strtotime($date_created)  && $days_remaining >= 0){
                                      
                                 ?>
                                  
                                  <tr>
                                      <td><span style="color:green;"><strong>Your Investment begins in <?php if($days_remaining == 0){echo '1'; }else{echo $days_remaining;} ?> day(s): <br>Exact Date: <?php echo $object->format_date($day_investment_starts_to_count); ?></strong></span></td>
                                      
                                  </tr>
                                  
                                  <?php } ?>
                                 <tr>
                                      <td><strong>Package Type:</strong></td>
                                      <td><?php 
                                                   
                                                 echo $type;
                                                    
                                                    
                                                    ?></td>
                                  </tr>
                                
                                 <tr>
                                      <td><strong>Package Category:</strong></td>
                                      <td><?php echo $getcat['name']; ?></td>
                                  </tr>
                                  
                                 
                                  
                                  
                                  <tr>
                                      <td><strong>Moratorium:</strong></td>
                                      <td><?php echo $pack['moratorium'].' day(s)'; ?></td>
                                  </tr>
                                  
                                  
                                  <tr>
                                      <td><strong>Package Unit Price:</strong></td>
                                      <td><?php echo '&#8358;'.number_format($pack['package_unit_price']);?></td>
                                  </tr>
                                     <tr>
                                      <td><strong>No of Purchased Slot:</strong></td>
                                      <td><?php echo $pack['no_of_slots_bought'].' slot(s)'; ?></td>
                                  </tr>
                                  <tr>
                                      <td><strong><?php echo $balance_title; ?>:</strong></td>
                                      <td><?php echo '&#8358;'.number_format($total_amount);?></td>
                                  </tr>
                                  
                                  <tr>
                                     <td><strong>Floating Profit:</strong></td>
                                      <td><?php echo '&#8358;'.number_format($floating_profit);?></td>
                                  </tr>
                          
    
                                   <tr>
                                      <td><strong>Date of Subscription:</strong></td>
                                      <td><?php echo $object->format_date($pack['date_created']);?></td>
                                  </tr>
                                  
                                  
                                  <?php    if( $pack['package_type'] == "2"  ){ ?>
                                    <tr>
                                      <td><strong>Incubation Period:</strong></td>
                                      <td><?php echo $pack['incubation_period'] .' day(s)';?></td>
                                  </tr>
                                  
                                    <tr>
                                      <td><strong>Recurrence Type:</strong></td>
                                      <td><?php echo $pack['recurrence_type'];?></td>
                                  </tr>
                                  
                                    <tr>
                                      <td><strong>Contribution Period:</strong></td>
                                      <td><?php echo $pack['contribution_period'] .' day(s)';?></td>
                                  </tr>
                                  
                                  <?php } ?>

                                    <tr>
                                      <td><strong>Tenure of Product:</strong></td>
                                      <td><?php  if( $pack['tenure_of_product'] == "inf"  ){ echo "INFINITE"; }else{ echo $pack['tenure_of_product'].' days';} ?></td>
                                     
                                  </tr>
                                  
                                   <tr>
                                      <td><strong>Actual Start Date:</strong></td>
                                   
                                      <td><?php echo $object->format_date($day_investment_starts_to_count); ?></td>
                                  </tr>

                                   <tr>
                                      <td><strong>Actual End Date:</strong></td>
                                   
                                      <td><?php if( $pack['tenure_of_product'] == "inf"  ){ echo "INFINITE"; }else{echo $object->format_date( date('Y-m-d', strtotime($day_investment_starts_to_count. ' + '.($pack['tenure_of_product'] - 1).' days')) );} ?></td>
                                  </tr>
                                  
                                   <?php    if( $pack['package_type'] == "1"  ){ 
                                   
                                                if( $pack['tenure_of_product'] != "inf"  ){
                                   ?>
                                        <tr>
                                        <td><strong>Expected Amount after Investment:</strong></td>
                                        <td><?php echo number_format(  ($pack['package_unit_price'] * $pack['no_of_slots_bought'])  + ($pack['package_unit_price'] * $pack['no_of_slots_bought'] * $pack['multiplying_factor'] * $pack['tenure_of_product']) ); ?></td>
                                        </tr>
                                        <?php   } else {  ?>
                                 
                                        <td><strong>Expected Amount after Investment:</strong></td>
                                        <td><?php echo "This is based on the number of days your investment is left to run"; ?></td>

                                            
                                        <?php }     ?>  
                                        
                                          <tr>
                                              <td><a href="fpackage_profit_history?unid=<?php echo $pack['unique_id']; ?>&pid=<?php echo $pack['package_id']; ?>&usid=<?php echo $pack['user_id']; ?>" class="btn btn-sm btn-success">View Profit History</a></td>
                                         </tr>
                                         
                                       

                                   <?php }    if( $pack['package_type'] == "2"  ){ ?>
                                            <tr>
                                              <td><a href="rpackage_profit_history?unid=<?php echo $pack['unique_id']; ?>" class="btn btn-sm btn-success">View Profit History</a></td>
                                            </tr>

                                   <?php } ?>
                                   
                                     <tr>
                                               <?php 
                                                $get_terms_condition = $object->get_one_row_from_one_table('package_term_condition','package_id',$pack['package_id']);
                                               ?>
                                                <a class="text-primary font-weight-bold" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Click to view Terms and Conditions
                                                </a><br>
                                                <div class="collapse" id="collapseExample">
                                                <div class="card card-body">
                                                <?php 
                                                if($get_terms_condition['description'] == null){
                                                echo "No Terms and Conditions yet";
                                                }else{
                                                echo $get_terms_condition['description'];
                                                }
                                                ?>
                                                </div>
                                                </div><hr>
                                             
                                         </tr>
                                  

                             </table>

                              <!-- <span><strong>Subscribe Below:</strong></span> -->
                               <form method="POST" id="subscribe_form<?php echo $pack['unique_id']; ?>">
                              
                              </form>
                        
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <!-- end of view Modal -->



              <?php
                if($count%3 === 0){
                    echo "</div><hr>";
                }

               $count++; }


             }
                
                
                ?>

        </div>
      </div>
    </div>
    <hr>
    <div class="container-fluid mt--7">
      <!-- Table -->
    
    




    </div>

  </div>
    <!-- Footer -->
      <?php include('includes/footer.php'); ?>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>