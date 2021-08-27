<?php include('includes/instantiated_files.php');
include('includes/header.php'); 

$my_withdrawal_requests = $object->my_withdrawal_requests($uid);


$wallet_balance = $object->get_one_row_from_one_table('wallet_tbl','user_id',$uid);

$my_docs_count = $object->get_number_of_rows_one_param('document_tbl','user_id',$uid);

 $my_total_withdrawal = $object->my_total_withdrawal($uid);
 $my_total_withdrawal_decode = json_decode($my_total_withdrawal,true);


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
              <h3 class="mb-0">This is a history of your withdrawals to your bank account:<span>&nbsp;&nbsp;<small style="color:green;">Total Withdrawn: &#8358;<?php echo number_format($my_total_withdrawal_decode['msg']); ?></small>&nbsp;&nbsp;&nbsp;</span></h3>
            
              <?php if($surname == "Please update" || $home_address == "Please update" || $contact_address == "Please update"    || $nok_surname == "Please update"   || $nok_name == "Please update"   || $nok_phone == "Please update"   || $nok_email == "Please update"  || $relationship == "Please update"   || $bank_name == "Please update"   || $account_name == "Please update"   || $account_number == "Please update"   || $account_type == "Please update"   || $nok_fullname == "Please update"  ){ ?> 
               <div class="row">
                      <div class="col-md-12">
                             <h4><small style="color: red;">NB: To make withdrawals, simply fill your profile completely including your Bank and Next of kin Details<br>&nbsp;&nbsp;<a href="profile">Click Here</a></small></h4><hr>
                      </div>
               </div>

             <?php } else{?>

              <div class="row">
                      <div class="col-md-12">
                              <button type="button" class="btn btn-primary btn-sm  mb-3" data-toggle="modal" data-target="#add_slot_modal"><i class="fas fa-plus-circle"></i>Request a Withdrawal</button>
                      </div>
               </div>
              
             
  
             <?php } ?>




            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush" style="padding: 8px;">
                <thead class="thead-light">
                 <?php if($my_withdrawal_requests == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Amount Requested</th>
                        <th scope="col">Withdrawal Status</th>
                        <th scope="col">Date Requested</th>
                        <!-- <th scope="col">Date</th> -->
                        <!-- <th scope="col">Action</th> -->

                  </tr>
                </thead>
                <tbody>
                   <?php
                       


                      foreach($my_withdrawal_requests as $value){
                        if($value['purpose'] == 7){
                          $withdrawal_status = "<small class='badge badge-sm badge-success'>processed</small>"; }
                         elseif($value['purpose'] == 5) {
                           $withdrawal_status = "<small class='badge badge-sm badge-primary'>pending</small>"; 
                          }elseif($value['purpose'] == 6) {
                           $withdrawal_status = "<small class='badge badge-sm badge-danger'>declined</small>"; 
                          }elseif($value['purpose'] == 8) {
                           $withdrawal_status = "<small class='badge badge-sm badge-default'>cancelled</small>"; 
                          }elseif($value['purpose'] == 9) {
                           $withdrawal_status = "<small class='badge badge-sm badge-success'>approved</small>"; 
                          }else{
                           $withdrawal_status = "<small class='badge badge-sm badge-primary'>pendinggg</small>"; 
                             
                          }

                          $getpackage = $object->get_one_row_from_one_table('package_definition','unique_id',$value['package_id']);
                          $get_others = $object->get_one_row_from_one_table_by_two_params('subscribed_user_tbl','user_id',$value['user_id'], 'package_id',$value['package_id']);
                          
                        
                      ?>
                     <tr>
                      
                        <td><?php echo '&#8358;'.number_format($value['amount_withdrawn']);?></td>
                        <td><?php echo $withdrawal_status;?></td>
                        <td><?php echo $object->formatted_date($value['date_created']); ?></td>
                      
                       <!--  <td><?php //echo $value['date_created'];?></td> -->
                   <!--  <td><a href="#" data-target="#view_earnings<?php //echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm btn-primary">view earnings</a></td> -->


                    <!-- view history here -->


                      </tr>
                <?php } } ?>
                 
                 
                 
                </tbody>
              </table>
            </div>
            
            
            <div class="card-footer py-4">
              <!--<nav aria-label="...">-->
              <!--  <ul class="pagination justify-content-end mb-0">-->
              <!--    <li class="page-item disabled">-->
              <!--      <a class="page-link" href="#" tabindex="-1">-->
              <!--        <i class="fas fa-angle-left"></i>-->
              <!--        <span class="sr-only">Previous</span>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--    <li class="page-item active">-->
              <!--      <a class="page-link" href="#">1</a>-->
              <!--    </li>-->
              <!--    <li class="page-item">-->
              <!--      <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>-->
              <!--    </li>-->
              <!--    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
              <!--    <li class="page-item">-->
              <!--      <a class="page-link" href="#">-->
              <!--        <i class="fas fa-angle-right"></i>-->
              <!--        <span class="sr-only">Next</span>-->
              <!--      </a>-->
              <!--    </li>-->
              <!--  </ul>-->
              <!--</nav>-->
              
            </div>
           
            
          </div>
        </div>
      </div>
      <!-- Dark table -->


         
 <!-- Modal -->
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

                  <?php if( $my_docs_count < 2){?>
                     <div class="modal-body">
                         <h4 style="color:red;">You cannot make withdrawals except you have atleast 2 of your documents uploaded</h4>
                       </div>
                        <div class="modal-footer">

                           <a href="documents" class="btn btn-primary float-right btn-small" name="wallet_withdraw" id="wallet_withdraw">Upload more documents</a>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   
                        </div>
                    <?php } else{?>
                         <div class="modal-body">
                    <form  id="wallet_withdrawal_form" method="post"> 
                        <!-- Default input -->
                        <h2 class="modal-title" id="exampleModalLabel">Request a Withdrawal from Wallet</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button><br>

                        <div class="form-group">
                          <label for="formGroupExampleInput">Wallet Balance: &#8358;<?php echo number_format($wallet_balance['balance']); ?></label>
                          <input type="hidden" value="<?php echo $wallet_balance['balance']; ?>" name="wallet_balance" id="wallet_balance">
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
                    <button class="btn btn-primary float-right btn-small" name="wallet_withdraw" id="wallet_withdraw">Request a  Withdrawal Now</button>
                  </div>
                    <?php } ?>
                </div>
              </div>
            </div>



      
      <!-- Footer -->
      <br>
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>