<?php include('includes/instantiated_files2.php');
include('includes/header.php');
 

// $table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_request = $object->get_rows_from_one_table_by_one_param('bonus_commission_request','bonus_status',1);


?>

<div class="table-responsive">
  <table class="table align-items-center table-flush">
  <thead class="thead-light">
   <?php if($get_request == null){
          echo "<tr><td>No record found...</td></tr>";
        } else{ ?>
    <tr>
      
          <th scope="col">Set For</th>
          <th scope="col">Bonus Amount</th>
          <th scope="col">Date</th>

    </tr>
  </thead>
  <tbody>
     <?php

     foreach($get_request as $value){

      $get_user = $object->get_one_row_from_one_table('admin_tbl','unique_id',$value['set_for']);
           
       ?>
       <tr>
        
         
          <td><?php echo $get_user['surname'].' '.$get_user['other_names'];?></td>
          <td>&#8358;<?php echo number_format($value['bonus']);?></td>
          <td><?php echo $value['date_created'];?></td>
        </tr>
  <?php } } ?>
   
   
   
  </tbody>
  </table>
</div>
  <!--   Core   -->