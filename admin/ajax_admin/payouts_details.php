<?php
ini_set('memory_limit', '-1');
  require_once('../includes/instantiated_files.php');
    include('../../classes/algorithm_functions.php');
 // $user_id = $_POST['user_id'];
 $start_date = $_POST['start_date'];
 $end_date = $_POST['end_date'];
 $get_payout = get_payout_details($start_date, $end_date);
 //$get_payout_decode = json_decode($get_payout, true);
 //print_r($get_payout_decode['msg']);
 ?>
 <div id="print_table" class="mt-5">
 <h4 class="text-center">Payout Details from <?php echo $start_date?> To <?php echo $end_date;?></h4>
 <div class="table-responsive p-3" >
<div class="float-right mb-2">
<!-- <button class="btn btn-primary btn-sm" onclick="printDiv();">Print Log</button>
<button id="download_table" class="btn btn-sm btn-success">Download Log as PDF</button> -->
</div>
  <table class="table align-items-center table-bordered " id="print_table">
    <thead class="thead-light">
     <?php if($get_payout == null){
            echo "<tr><td>No payouts for the chosen dates</td></tr>";
            $total_payout = 0;
          } else{ ?>
      <tr>
        <th scope="col">Client's Name</th>
        <th scope="col">Package Name</th>
        <th scope="col">Profit Per Day</th>
        <th scope="col">Float Time</th>
        <th scope="col">Expected Payout</th>
        <th scope="col">Next Payout Date</th>
      </tr>
    </thead>
    <tbody>
        
       <?php
       $total_payout = 0;
       foreach($get_payout as $value){
          $get_user = get_users_details('users_tbl','unique_id',$value['user_id']);
          $get_package_details = get_one_row_from_one_table('package_definition','unique_id',$value['package_id']);
         ?>
         <tr>
            <td><?php echo $get_user['surname'].' '.$get_user['other_names'];?></td>
            <td><?php echo $get_package_details['package_name'];?></td>
            <td>&#8358;<?php echo number_format($value['profit_per_day'], 2);?></td>
            <td><?php echo $value['float_time'].' day(s)';?></td>
            <td>&#8358;<?php echo number_format($value['total_profit'], 2);?></td>
            <td><?php echo $value['next_floating_date'];?></td>
          <?php  $total_payout+=$value['total_profit'];} ?>
          </tr>
    <?php } ?>
    </tbody>
  </table>
  <h3 class="mt-5">Estimated Payout from <?php echo $start_date?> To <?php echo $end_date;?> :&nbsp;&nbsp; &#8358;<?= number_format($total_payout, 2);?></h3>
</div>
</div>
<div class="m-3">
</div>


