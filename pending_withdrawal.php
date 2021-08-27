<?php include('includes/instantiated_files.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$param2 = 'purpose';
$get_rows = $object->get_my_pending_withrawals($uid);

$get_my_packages = $object->get_rows_from_one_table_by_id('subscribed_user_tbl','user_id',$uid);

$profit = $object->get_profits1($uid);
$profit_decode = json_decode($profit,true);

$total_withdrawn = $object->my_total_pending_withdrawn($uid);
$total_withdrawn_decode = json_decode($total_withdrawn,true);

?>


<body class="">
 <!--  <style type="text/css">
        #show_profit{
           display: none;
        }
  </style> -->
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
              <h3 class="mb-0">This is a history of all your pending withdrawals to your bank account<br><span>&nbsp;&nbsp;<small style="color:green;">Total Pending: &#8358;<?php echo number_format($total_withdrawn_decode['msg']); ?></small></span></h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Amount</th>
                        
                        <th scope="col">Withdrawal Type</th>
                         <th scope="col">Transaction Status</th>
                       <!--  <th scope="col">Payment Status</th> -->
                        <th scope="col">Source</th>
                  
                        <th scope="col">Date Requested</th>
                        <!-- <th scope="col">Date</th> -->
                        <!-- <th scope="col">Action</th> -->

                  </tr>
                </thead>
                <tbody>
                   <?php


                      foreach($get_rows as $value){
                        if($value['purpose'] == 2){
                          $payment_status = "<span class='badge badge-primary'>profits</span>"; }
                        if($value['purpose'] == 5){
                          $payment_status = "<span class='badge badge-success'>wallet</span>"; 
                        }

                          $getpackage = $object->get_one_row_from_one_table('package_tbl','unique_id',$value['package_id']);
                          $get_others = $object->get_one_row_from_one_table_by_two_params('subscribed_user_tbl','user_id',$value['user_id'], 'package_id',$value['package_id']);
                          
                        
                      ?>
                     <tr>
                      
                        <td><?php echo '&#8358;'.number_format($value['amount_withdrawn']);?></td>
                        <td><?php echo $payment_status;?></td>
                        <td><?php echo "pending"; ?></td> 
                        <td><?php 
                            if($value['purpose'] == 5){
                            echo "<span class='btn btn-sm btn-success'>from Wallet</span>";

                            }else{
                            echo  "<span class='btn btn-sm btn-primary'>".$getpackage['package_name']."</span>";

                              }

                        ?></td>
                     
                        <td><?php echo date('Y-m-d',strtotime($value['date_created'])); ?></td>
                       <!--  <td><?php //echo $value['date_created'];?></td> -->
                   <!--  <td><a href="#" data-target="#view_earnings<?php //echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm btn-primary">view earnings</a></td> -->


                    <!-- view history here -->


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


         
 <!-- Modal -->
            <div class="modal fade" id="add_slot_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Slot</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div> -->
                  <div class="modal-body">
                    <form  id="withdrawal_form" method="post"> 
                        <!-- Default input -->
                        <h1 class="modal-title" id="exampleModalLabel">Place a Withdrawal Request</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button><br>

                        <div class="form-group">
                          <label for="formGroupExampleInput">Select Package</label>
                          <select class="form-control form-control-sm" id="get_withdrawable_profit" name ="get_withdrawable_profit">
                            <option value="no_select">Choose an option</option>;
                            <?php
                              if($get_my_packages == null){
                              echo "error";
                            }else{


                              foreach ($get_my_packages as $val) {
                                      $getpackage = $object->get_one_row_from_one_table('package_tbl','unique_id',$val['package_id']);
                                        ?>
                              <option value="<?php echo $val['package_id'];?>"><?php echo $getpackage['package_name']; ?></option>
                               <?php
                                        }
                                    }
                                 ?>
                          </select>
                        </div>

                        <div id="show_profit">
                            
                        </div>
                     
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="formGroupExampleInput">Withdrawal Amount</label>
                            <input type="number" class="form-control form-control-sm" id="amount_to_withdraw" name="amount_to_withdraw" value="1">
                          </div>
                        </div>
                     </form> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right btn-small" name="withdraw" id="withdraw">Place Withdrawal</button>
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