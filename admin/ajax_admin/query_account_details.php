<?php
ini_set('memory_limit', '-1');
  require_once('../includes/instantiated_files.php');
    include('../../classes/algorithm_functions.php');
 $user_id = $_POST['user_id'];
 $start_date = $_POST['start_date'];
 $end_date = $_POST['end_date'];
 $query_account = query_account($user_id, $start_date, $end_date);
 $get_user_name = get_users_details('users_tbl','unique_id',$user_id);
 // if($query_account !== null){
 // 	echo "success";
 // }
 // $query_account_decode = json_decode($query_account, true);
 // echo $query_account_decode['msg'];
 ?>
 <div id="print_table">
 <h4 class="text-center"><?php echo $get_user_name['surname'].' '.$get_user_name['other_names']."'s Activity Log"?></h4>
 <div class="table-responsive p-3" >
<div class="float-right mb-2">
<button class="btn btn-primary btn-sm" onclick="printDiv();">Print Log</button>
<button id="download_table" class="btn btn-sm btn-success">Download Log as PDF</button>
</div>
  <table class="table align-items-center table-bordered " id="print_table">
    <thead class="thead-light">
     <?php if($query_account == null){
            echo "<tr><td>No record found...</td></tr>";
          } else{ ?>
      <tr>
        <th scope="col">Full Name</th>
        <th scope="col">Email Address</th>
        <th scope="col">Activity</th>
        <th scope="col">Date</th>
      </tr>
    </thead>
    <tbody>
        
       <?php

       foreach($query_account as $value){
          $get_user = get_users_details('users_tbl','unique_id',$value['user_id']);
         ?>
         <tr>
            <td><?php echo $get_user['surname'].' '.$get_user['other_names'];?></td>
            <td><?php echo $get_user['email'];?></td>
            <td><?php echo $value['description'];?></td>
            <td><?php echo $value['date_created'];?></td>
          <?php  } ?>
          </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
</div>
<div class="m-3">
</div>


