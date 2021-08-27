<?php include('includes/instantiated_files2.php');
include('includes/header.php');

$military_requests = $object->get_rows_from_one_table_by_id('military_package_maker_checker','approval_status',0);

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
              <h3 class="mb-0">Pending Requests to  Subscribe to Military Packages</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush" style="padding: 8px;">
                <thead class="thead-light">
                 <?php if($military_requests == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Client Name</th>
                        <th scope="col">Package</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Slots Bought</th>
                         <th scope="col">Action</th> 
                        <!-- <th scope="col">Action</th> -->

                  </tr>
                </thead>
                <tbody>
                   <?php
                       


                      foreach($military_requests as $value){
                          $appr_status = $value['approval_status'];
                    
                          $getpackage = $object->get_one_row_from_one_table('package_definition','unique_id',$value['package_id']);
                          
                          $getuserdet = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                    
                          $get_others = $object->get_one_row_from_one_table_by_two_params('subscribed_user_tbl','user_id',$value['user_id'], 'package_id',$value['package_id']);
                          
                        
                      ?>
                     <tr>
                      
                        <td><?php echo $getuserdet['other_names'].' '.$getuserdet['surname'];?></td>
                        <td><?php echo $getpackage['package_name'];?></td>
                        <td><?php echo '&#8358;'.number_format($value['total_amount']);?></td>
                         <td><?php echo $value['no_of_slots_bought'];?></td>
                         <td><?php 
                             
                               echo  "<span id='approve_military_modal".$value['unique_id']."'><a href='#' class='btn btn-sm btn-success' data-toggle='modal' data-target='#approve".$value['id']."'>approve</a><span> | <span id='disapprove_military_modal".$value['unique_id']."'><a href='#' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#disapprove".$value['id']."'>disapprove</a></span>";
                           ?>
                          </td>

                           <div class="modal fade bd-example-modal-md approve_modal" id="approve<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Approve Military Subscription Request</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to approve this military request?
                                  </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-success approve_military" name="approve_military" id="<?php echo $value['unique_id']; ?>">Approve</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <div class="modal fade bd-example-modal-md disapprove_modal" id="disapprove<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Dispprove Military Subscription Request</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to disapprove this military request?
                                  </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger disapprove_military" name="disapprove_military" id="<?php echo $value['unique_id']; ?>">Disapprove</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                         
                        
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