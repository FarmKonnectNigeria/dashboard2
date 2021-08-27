<?php include('includes/instantiated_files.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$param2 = 'purpose';
$get_rows = $object->get_rows_from_one_table_by_two_params($table,$param1,$uid,$param2,7);

$get_my_packages = $object->get_rows_from_one_table_by_id('subscribed_user_tbl','user_id',$uid);

$wallet_balance = $object->get_one_row_from_one_table('wallet_tbl','user_id',$uid);

$total_withdrawn = $object->total_wallet_withdrawn($uid);
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
     <?php if($surname == "Please update"   || $home_address == "Please update"   || $nok_surname == "Please update"   || $nok_name == "Please update"   || $nok_phone == "Please update"   || $nok_email == "Please update"   || $contact_address == "Please update"   || $relationship == "Please update"   || $bank_name == "Please update"   || $account_name == "Please update"   || $account_number == "Please update"   || $account_type == "Please update"   || $nok_fullname == "Please update" ){ ?>
       <div class="row" style="padding-bottom: 20px;margin-top: -150px;">
              <div class="col-md-12">
                     <h4>Sorry, You need to fully update your profile information before you can make withdrawal... <br>&nbsp;&nbsp;<a href="profile">Click Here</a></h4><hr>
              </div>
       </div>

       

     <?php }  else{?>
      <!-- Dark table -->

      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">This is a history of your withdrawals from your wallet to your bank account<br><span>&nbsp;&nbsp;<small style="color:green;">Total Withdrawn: &#8358;<?php echo number_format($total_withdrawn_decode['msg']); ?></small>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary btn-sm float-right mb-3" data-toggle="modal" data-target="#add_slot_modal"><i class="fas fa-plus-circle"></i>Place a Withdrawal: &#8358;<?php echo number_format($wallet_balance['balance']); ?></button></span></h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Amount</th>
                        
                        <th scope="col">Transaction Status</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Package Name</th>
                        <th scope="col">Date Requested</th>
                        <!-- <th scope="col">Date</th> -->
                        <!-- <th scope="col">Action</th> -->

                  </tr>
                </thead>
                <tbody>
                   <?php


                      foreach($get_rows as $value){
                        if($value['withdrawal_status'] == 1){
                          $payment_status = "successful"; }
                          else{
                          $payment_status = "failed"; }

                          $getpackage = $object->get_one_row_from_one_table('package_tbl','unique_id',$value['package_id']);
                          $get_others = $object->get_one_row_from_one_table_by_two_params('subscribed_user_tbl','user_id',$value['user_id'], 'package_id',$value['package_id']);
                          
                        
                      ?>
                     <tr>
                      
                        <td><?php echo '&#8358;'.number_format($value['amount_withdrawn']);?></td>
                        <td><?php echo "Completed";?></td>
                        <td><?php echo $payment_status;?></td>
                        <td><?php echo $getpackage['package_name'];?></td>
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


    <?php } ?>
         
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
                    <form  id="wallet_withdrawal_form" method="post"> 
                        <!-- Default input -->
                        <h2 class="modal-title" id="exampleModalLabel">Place a Withdrawal from Wallet</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button><br>

                        <div class="form-group">
                          <label for="formGroupExampleInput">Wallet Balance: &#8358;<?php echo number_format($wallet_balance['balance']); ?></label>
                          <input type="hidden" value="<?php echo $wallet_balance['balance']; ?>" name="wallet_balance" id="wallet_balance">
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
                    <button class="btn btn-primary float-right btn-small" name="wallet_withdraw" id="wallet_withdraw">Place Withdrawal</button>
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