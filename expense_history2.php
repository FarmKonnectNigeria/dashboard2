<?php include('includes/instantiated_files.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$param2 = 'purpose';
$get_rows = $object->get_rows_from_one_table_by_two_params($table,$param1,$uid,$param2,1);

$profit = $object->get_profits1($uid);
$profit_decode = json_decode($profit,true);




?>


<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
   
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">This is a history of your package(s) subscriptions</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Amount</th>
                        
                        <th scope="col">Transaction Description</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Package Name</th>
                        <th scope="col">Slots</th>
                        <th scope="col">Duration</th>
                        <!-- <th scope="col">Date</th> -->
                        <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                   <?php
                      foreach($get_rows as $value){
                        // if($value['withdrawal_status'] == 1){
                        //   $payment_status = "successful"; }
                        //   else{
                        //   $payment_status = "failed"; }

                          $getpackage = $object->get_one_row_from_one_table('package_tbl','unique_id',$value['package_id']);
                          $get_others = $object->get_one_row_from_one_table_by_two_params('subscribed_user_tbl','user_id',$value['user_id'], 'package_id',$value['package_id']);
                          
                        
                      ?>
                     <tr>
                      
                        <td><?php echo '&#8358;'.number_format($value['amount_withdrawn']);?></td>
                        <td><?php 
                            
                                echo "Subscribed to a Package";

                        ?></td>
                        <td><?php echo $payment_status;?></td>
                        <td><?php echo $getpackage['package_name'];?></td>
                        <td><?php echo $get_others['slot']; ?></td>
                        <td><?php echo $get_others['duration']; ?></td>
                       <!--  <td><?php //echo $value['date_created'];?></td> -->
                    <td><a href="#" data-target="#view_earnings<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm btn-primary">view earnings</a></td>


                    <!-- view history here -->
        <div class="modal fade" id="view_earnings<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">View your earnings for the package:<?php echo $getpackage['package_name']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
             <?php
                  $invested_amount = $get_others['amount_paid'];
                  $duration = $get_others['duration'];
                  $interest = intval($getpackage['interest_rate']);
                  $invested_amount_plus_interest = $invested_amount + ($invested_amount * ($interest/100));
                  $total_roi = $invested_amount * ($interest/100);
                 
                  $interest_amount_per_month = ($total_roi)/$duration;
                 
                  $invested_amount_per_month = $invested_amount_plus_interest / $duration; 
                  $current_date = date('d-m-Y');
                  $added_profit = 0;
                  $withdrawable_profit = 0;


              ?>
             <div class="row">
                  <div class="col-md-12">
                       <span style="font-size: 15px;"><i class="fa fa-money-bill-alt text-success"></i></span> Total Investment: <?php echo '&#8358;'.number_format($invested_amount,2); ?><br>
                       <span style="font-size: 15px;"><i class="fa fa-money-check text-primary"></i></span> Total ROI: <?php echo '&#8358;'.number_format($total_roi,2); ?><br>
                       <span style="font-size: 15px;"><i class="fa fa-money-bill text-purple"></i></span> Total Investment Plus Interest: <?php echo '&#8358;'.number_format($invested_amount_plus_interest,2); 

                       //echo '<br>'.$interest_amount_per_month;

                       ?><br>
                      
                       <hr>

                       <?php //echo $getpackage['withdrawable_month']; ?>


                  </div>
             </div>
             <div class="row">
                  <div class="col-md-4">
                      Expected Date
                  </div>
                  <div class="col-md-5">
                     Summed Earnings
                  </div>
                  <div class="col-md-3">
                      Status
                  </div>
                  

             </div>

             <!-- algorithm for profit display is implemented here starts here -->
             <?php for($i = 1; $i <= $get_others['duration']; $i++){ 
                  $next_month_loop  = date('d-m-Y', strtotime('+'.$i.' month', strtotime($get_others['date_created'])));


                 $added_profit = $added_profit + $interest_amount_per_month;
                 
                 if( strtotime($next_month_loop) < strtotime($current_date) ){
                      if(   (number_format((strtotime($next_month_loop) - strtotime($get_others['date_created']))/(60*60*24*30),0))   % $getpackage['withdrawable_month'] == 0 ) { 
                      $withdrawable_profit = ($interest_amount_per_month*$getpackage['withdrawable_month']) + $withdrawable_profit;
                       }
                     $status = '<small class="badge badge-success badge-sm">added</small>';

                  } else{
                   
                    $status = '<small class="badge badge-default badge-sm">pending</small>';

                  }

       

              ?>
             <div  class="row">
                  
                  <div class="col-md-4">
                      <?php echo $next_month_loop; ?>
                  </div>
                  <div class="col-md-5">
                       <?php echo '&#8358;'.number_format($added_profit,2); ?>
                  </div> 
                  <div class="col-md-3">
                      <?php   //echo number_format((strtotime($next_month_loop) - strtotime($get_others['date_created']))/(60*60*24*30),0);    
                      echo $status; ?>
                  </div>               
             </div>
           <?php } 


            $get_profits_per_package = $object->get_profits_per_package($value['package_id'],$uid);
            $get_profits_per_package_decode = json_decode($get_profits_per_package,true);


         
           ?>
                <hr>
                <div class="row">
                        <div class="col-md-12">
                            <span data-toggle="tooltip" title="Ledger Profit means the total profit at the end the investment">Ledger Profit: &#8358;<strong><?php echo number_format($added_profit,2); ?></strong></span><br><br>
                            <span data-toggle="tooltip" title="Withdrawable Profit means profit due for withdrawal into your wallet">Withdrawable Profit: &#8358;<strong><?php echo number_format($withdrawable_profit,2); ?></strong><br><br>Profit Balance: &#8358;<strong><?php echo number_format($get_profits_per_package_decode['actual_withdrawable_profit']
,2); ?></strong><br>



                        </div>
                </div>

             <!-- algorithm for profit display is implemented here and ends here -->

            
          </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success update_basic_profile">Update Now</button>
         --></div>
      </div>
        </div>
        </div>
       <!-- update basic profile modal ends here -->

                      </tr>
                <?php } } ?>
                 
                 
                 
                </tbody>
              </table>
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
      <!-- Dark table -->


      <br>   

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>