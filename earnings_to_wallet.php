<?php include('includes/instantiated_files.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$param2 = 'purpose';
$get_rows = $object->get_rows_from_one_table_by_two_params($table,$param1,$uid,$param2,4);

$get_my_packages = $object->get_rows_from_one_table_by_id('subscribed_user_tbl','user_id',$uid);

$profit = $object->get_profits1($uid);
$profit_decode = json_decode($profit,true);

$total_withdrawn = $object->total_withdrawn($uid);
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
              <h3 class="mb-0">This is a history of transfers of earnings to your Wallet<br><span>&nbsp;&nbsp;<small style="color:green;">Total Transfers to Wallet: &#8358;<?php echo number_format($total_withdrawn_decode['msg']); ?></small>&nbsp;&nbsp;&nbsp;

              <?php   if($profit_decode['actual_withdrawable_profit']  > 0 ){ ?>

                  <button type="button" class="btn btn-success btn-sm float-right mb-3" data-toggle="modal" data-target="#add_earnings_modal"><i class="fas fa-plus-circle"></i>Transfer to Wallet: &#8358;<?php echo number_format($profit_decode['actual_withdrawable_profit']);
                  ?></button>

              <?php }else{  ?>

                 <button type="button" class="btn btn-danger btn-sm float-right mb-3" data-toggle="modal" data-target="#"><i class="fas fa-plus-circle"></i>Your withdrawable profit balance is: &#8358;0</button>


              <?php } ?>
               



              </span></h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Amount</th>
                        
                        <th scope="col">Tranfer  Status</th>
                        <th scope="col">Transaction Type</th>
                       <!--  <th scope="col">Package Name</th> -->
                        <th scope="col">Date Transferred</th>
                        <!-- <th scope="col">Date</th> -->
                        <!-- <th scope="col">Action</th> -->

                  </tr>
                </thead>
                <tbody>
                   <?php


                      foreach($get_rows as $value){
                          $transaction_type = "<span class='badge badge-primary'>earnings to wallet</span>";
                          $getpackage = $object->get_one_row_from_one_table('package_tbl','unique_id',$value['package_id']);
                          $get_others = $object->get_one_row_from_one_table_by_two_params('subscribed_user_tbl','user_id',$value['user_id'], 'package_id',$value['package_id']);
                          
                        
                      ?>
                     <tr>
                      
                        <td><?php echo '&#8358;'.number_format($value['amount_withdrawn']);?></td>
                        <td><?php echo "<span class='badge badge-success'>completed</span>";  ?></td>
                        <td><?php echo $transaction_type; ?></td>
                       <!--  <td><?php //echo $getpackage['package_name'];?></td> -->
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
            <div class="modal fade" id="add_earnings_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form  id="earnings_to_wallet_form" method="post"> 
                        <!-- Default input -->
                        <h2 class="modal-title" id="exampleModalLabel">Transfer Earnings to Wallet</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button><br>

                        <div class="form-group">
                          <input type="hidden" name="total_earnings" id="total_earnings" value="<?php echo $profit_decode['actual_withdrawable_profit']; ?>">
                          <label for="formGroupExampleInput">Confirm Transfer of earnings to wallet::: &#8358;<strong><?php echo number_format($profit_decode['actual_withdrawable_profit']); ?></strong></label><hr>

                           <button class="btn btn-primary float-right btn-small" name="transfer_earnings_to_wallet" id="transfer_earnings_to_wallet">Transfer to Wallet</button>

                        </div>

                      <!--   <div id="show_profit">
                            
                        </div> -->
                 
                     </form> 
                  </div>
                <!--   <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   
                  </div> -->
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