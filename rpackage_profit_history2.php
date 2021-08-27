<?php include('includes/instantiated_files.php');
include('classes/algorithm_functions.php');
include('includes/header.php'); 
$created_by = $_SESSION['uid'];

if( isset($_GET['unid'])  ){
    $unid = $_GET['unid'];
   $user_package = $object->get_one_row_from_one_table('subscribed_packages','unique_id',$unid);
   $pid = $user_package['package_id'];
   $usid = $user_package['user_id'];
   
   $user_package = $object->get_one_row_from_one_table_by_three_params('subscribed_packages','unique_id',$unid,'package_id',$pid,'user_id',$usid);
   $package_details  =  $object->get_one_row_from_one_table('package_definition','unique_id',$user_package['package_id']);
   
  
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
    
    $date_used_in_investment = strtotime($current_date) - strtotime($day_investment_starts_to_count);
    $days_used_in_investment = round($date_used_in_investment / (60 * 60 * 24));

   
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
         
              <h3 class="mb-0"><a href="rpackage_profit_history?unid=<?php echo $unid; ?>" style="font-size:12px;">back</a> | <?if(!empty($msg)){echo $msg; }else{?>Profit Breakdown for selected package: <?php echo $package_details['package_name']; } ?></h3></h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if(!empty($msg)){
                        echo "<tr><td><?php echo $msg; ?></td></tr>";
                      } 
                      
                      else if($user_package['tenure_of_product'] == 'inf'){ 
                      
                        if(   $day_investment_starts_to_count > $current_date && $days_remaining >= 0){
                            echo "<tr><td>Your investment is still in the waiting period...It starts counting in ".$days_remaining." days</td></tr>";
                        }else{
                            $packageam = $user_package['package_unit_price'] * $user_package['no_of_slots_bought'];
                      ?>
                         <!--//FOR INFINITE PACKAGE-->
                         <div class="row"><div class="col-md-2"></div><div class="col-md-8"><span style="color:green;"><strong>Tenure Type: INFINITE<br> Check below for your profit details as at today: <?php echo $object->format_date(date('Y-m-d')); ?></span></div></div></div><br>
                         <tr><td>Package Amount: <?php echo '&#8358;'.number_format(  $packageam  );?></td></tr>
                         <tr><td>Days of Investment so far: <?php echo $days_used_in_investment; ?> days</td></tr>
                         <tr><td>Profit per day: <?php echo '&#8358;'.number_format($user_package['package_unit_price'] * $user_package['multiplying_factor'] * $user_package['no_of_slots_bought']); ?></td></tr>
                          <tr><td>Total Profit so far: <?php echo  '&#8358;'.number_format($user_package['package_unit_price'] * $user_package['multiplying_factor'] * $user_package['no_of_slots_bought'] * $days_used_in_investment); ?></td></tr>
                          <tr><td>Capital Balance so far: <?php echo  '&#8358;'.  number_format(  ($packageam) + $user_package['package_unit_price'] * $user_package['multiplying_factor'] * $user_package['no_of_slots_bought'] * $days_used_in_investment) ; ?></td></tr>
                          
                     <?php
                     
                        }//ends the case of a running investment
                            
                        }
                      
                      else{
                      
                       if(   $day_investment_starts_to_count > $current_date && $days_remaining >= 0){
                            echo "<tr><td>Your investment is still in the waiting period...It starts counting in ".$days_remaining." days</td></tr>";
                        }else{ 
                            
                            $packageam = $user_package['package_unit_price'] * $user_package['no_of_slots_bought'];
                            $profperday = $user_package['package_unit_price'] * $user_package['multiplying_factor'] * $user_package['no_of_slots_bought'];
                            $prof_after_invst = $user_package['package_unit_price'] * $user_package['multiplying_factor'] * $user_package['no_of_slots_bought'] * $user_package['tenure_of_product'];
                            $prof_so_far = $user_package['package_unit_price'] * $user_package['multiplying_factor'] * $user_package['no_of_slots_bought'] * $days_used_in_investment;
                      ?>
                  <div class="row"><div class="col-md-2"></div><div class="col-md-8"><span style="color:green;"><strong>Tenure Type: FINITE | Start Date: <?php echo $object->format_date($day_investment_starts_to_count); ?><br> </span></div></div></div><br>
                </thead>
                 
                    <tr>
                        <th>Date</th>
                        <th>Contribution</th>
                        <th>Profit Added</th>
                        <th>Portfolio Profit</th>
                        <th>Portfolio Contribution</th>
                        <th>Profit + Portfolio Contribution</th>
                        <th>status</th>
                    </tr>
                
                <?php 
                   $recurrent_details_per_investment = recurrent_details_per_investment($unid);
                  
                   $tot_prof =0;
                   foreach($recurrent_details_per_investment as $det){
                       $date_created = $det['date_created'];
                       $cont_today = $det['unit_price_today'];
                       $capital_balance_today = $det['capital_balance_today'];
                       $profit_today = $det['profit_today'];
                       $tot_prof = $tot_prof + $profit_today;
                       $profit_plus_portfolio_cont = $capital_balance_today + $tot_prof;
                       
                ?>
                       <tr>
                           <td><?php echo $date_created; ?></td>
                           <td><?php echo '&#8358;'.number_format($cont_today); ?></td>
                            <td><?php echo '&#8358;'.number_format($profit_today); ?></td>
                            <td><?php echo '&#8358;'.number_format($tot_prof); ?></td>
                           <td><?php echo '&#8358;'.number_format($capital_balance_today); ?></td>
                           <td><?php echo '&#8358;'.number_format($profit_plus_portfolio_cont); ?></td>
                           <td><?php if($current_date >= $date_so_far ){ echo "<small class='badge badge-success'>ADDED</small>"; } else{ echo "<small class='badge badge-danger'>NOT ADDED</small>"; } ?></td>
                       </tr>
                       
                        
                <?php   }  } } ?>
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
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
  </script>