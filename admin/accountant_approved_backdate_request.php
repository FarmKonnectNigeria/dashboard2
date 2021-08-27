<?php include('includes/instantiated_files2.php');
include('includes/header.php');
 

// $table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_request = $object->get_rows_from_one_table_by_id('backdate_investment_maker_checker','status', 3); 

?>


<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name != 'Accountant'){
    echo '<meta http-equiv="refresh" content="0; URL=no_access" />';
  }
  ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <!-- <div class="header bg-gradient-default pb-8 pt-5 pt-md-8"  >
     
    </div> -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">This is a list of Backdate requests</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_request == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Investor's Fullname</th> 
                        <th scope="col">Email Address</th>
                        <th scope="col">Current Accrued Profit</th>
                        <th>Backdate Date</th>
                        <th>Added By</th>
                        <th scope="col">Status</th>
                        <?php //if($found > 0){?>
                           <th>Action</th>
                        <?php //} ?>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_request as $value){
                     $get_investment = $object->get_one_row_from_one_table('subscribed_packages','unique_id',$value['investment_id']);
                    $get_package = $object->get_one_row_from_one_table('package_definition','unique_id',$get_investment['package_id']);
                    $get_investor = $object->get_one_row_from_one_table('users_tbl','unique_id',$get_investment['user_id']);
                    $get_added_by = $object->get_one_row_from_one_table('admin_tbl','unique_id',$value['added_by']);
                         
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $get_investor['surname'].' '.$get_investor['other_names'];?></td>
                        <td><?php echo $get_investor['email'];?></td>
                        <td>&#8358;<?php echo number_format($value['current_accrued_profit']);?></td>
                        <td><?php echo $value['backdate_date'];?></td>
                        <td><?php echo $get_added_by['surname'].' '.$get_added_by['other_names'];?></td>
                        <td> 
                          <?php
                          if($value['status'] == 0){
                            echo '<small class="badge badge-primary">Pending MM Approval</small>';
                          }
                          if($value['status'] == 1){
                            echo '<small class="badge badge-success">Approved by MM</small>';
                          }
                          else if($value['status'] == 2){
                            echo '<small class="badge badge-primary">Pending</small>';
                          } 
                          else if($value['status'] == 3){
                            echo '<small class="badge badge-success">Processed</small>';
                          } 
                        ?>
                        </td>
                        <td> 
                          <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view<?php echo $value['id']; ?>">View Details</small>
                          <?php 
                          if($value['status'] == 2){
                        //if($found > 0){?>
                          <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Approve</small>
                          <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject<?php echo $value['id']; ?>">Reject</small>
                        </td>
                        <?php }
                        if($value['status'] == 3){
                        //if($found > 0){?>
                          <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#undo<?php echo $value['id']; ?>">Undo Backdate</small>
                        </td>
                        <?php } ?>
                        <div class="modal fade bd-example-modal-lg" id="view<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Investment Details</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div><strong>Package Name: &nbsp &nbsp</strong> <?php
                                    echo $get_package['package_name'];
                                    ?>
                                  </div><br>
                                  <div><strong>Slot: &nbsp &nbsp</strong> <?php
                                    echo $get_investment['no_of_slots_bought']." slot(s)";
                                    ?>
                                  </div><br>
                                  <div><strong>Tenure of Product: &nbsp &nbsp</strong> <?php
                                    echo $get_investment['tenure_of_product'].' day(s)';
                                    ?>
                                  </div><br>
                                  <div><strong>Total Amount: &nbsp &nbsp</strong>&#8358;<?php
                                    echo number_format($get_investment['total_amount']);
                                    ?>
                                  </div><br>
                                  <div><strong>Liquidation Surcharge: &nbsp &nbsp</strong> <?php
                                    echo $get_investment['liquidation_surcharge'].'%';
                                    ?>
                                  </div><br>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                        <div class="modal fade bd-example-modal-md" id="approve<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Approve Request</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to approve this request?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-danger accountant_approve_backdate" name="accountant_approve_backdate" id="<?php echo $value['unique_id']; ?>">Approve</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="accountant_approve_backdate_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                    <input type="hidden" class="form-control" id="investment_id" name="investment_id" value="<?php echo $value['investment_id']?>">
                                </form>
                            </div>
                          </div>
                        </div>
                        <div class="modal fade bd-example-modal-md" id="undo<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Undo Backdate</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to undo this backdate?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-success accountant_undo_backdate" name="accountant_undo_backdate" id="<?php echo $value['unique_id']; ?>">Undo</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="accountant_undo_backdate_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                    <input type="hidden" class="form-control" id="investment_id" name="investment_id" value="<?php echo $value['investment_id']?>">
                                    <input type="hidden" class="form-control" id="accrued_profit" name="accrued_profit" value="<?php echo $value['current_accrued_profit']?>">
                                </form>
                            </div>
                          </div>
                        </div>
                        <div class="modal fade bd-example-modal-md" id="reject<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Reject Request</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to reject this request?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-success accountant_reject_backdate" name="accountant_reject_backdate" id="<?php echo $value['unique_id']; ?>">Reject</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="accountant_reject_backdate_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                    <input type="hidden" class="form-control" id="investment_id" name="investment_id" value="<?php echo $value['investment_id']?>">
                                </form>
                            </div>
                          </div>
                        </div>
                      </tr>
                <?php } } ?> 
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
             <!--  <nav aria-label="...">
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


         

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>