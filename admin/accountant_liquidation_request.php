<?php include('includes/instantiated_files2.php');
include('includes/header.php');
include("../classes/algorithm_functions.php");

$get_request = $object->get_rows_from_one_table('liquidated_investments_tbl');


////view function access
  // $found = 0;
  //    //rewrite the next line
  //     $user_role_function = $object->get_rows_from_table_by_user_id('function_role_rights','role_id',$uid);
  //     foreach ($user_role_function as $key => $value) {
  //           $each_function_slug = $object->get_one_row_from_one_table('site_functions','id',$value['function_id']);
  //           $each_function_slug = $each_function_slug['function_slug'];
        
  //           if($each_function_slug == 'view_users'){
  //           $found++;
  //           }
  //     }


      

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
              <h3 class="mb-0">This is a list of Liquidation Requests</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_request == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Fullname</th>  
                        <th scope="col">Email Address</th>
                        <th scope="col">Days so far</th>
                        <th scope="col">Amount to be Liquidated</th>
                        <th>Date Requested</th>
                        <th>Status</th>
                        <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_request as $value){

                    $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id', $value['user_id']);
                    $get_investment = $object->get_one_row_from_one_table('subscribed_packages','unique_id',$value['investment_id']);
                    $get_package = $object->get_one_row_from_one_table('package_definition','unique_id',$get_investment['package_id']);
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $get_user['surname'].' '.$get_user['other_names'];?></td>
                        <td><?php echo $get_user['email'];?></td>
                        <td><?php echo $value['days_so_far']?></td>
                        <td>&#8358;<?php echo $value['amount_to_be_liquidated'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td>
                          <?php
                            if($value['process_status'] == 0){
                              echo '<small class="badge badge-primary">Pending SA Approval </small>';
                            }
                            else if($value['process_status'] == 1){
                              echo '<small class="badge badge-primary">Pending</small>';
                            }
                            else if($value['process_status'] == 2){
                              echo '<small class="badge badge-success">Processed</small>';
                            }
                            else if($value['process_status'] == 3){
                              echo '<small class="badge badge-danger">Rejected</small>';
                            }else{
                              echo "No status";
                            }
                          ?>
                          
                        </td>


                        <?php //if($found > 0){?>
                        <td> <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view<?php echo $value['id']; ?>">View Details</small>
                          <?php
                            if ($value['process_status'] == 1){
                          ?>
                          <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Approve</small>
                          <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject<?php echo $value['id']; ?>">Reject</small>
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
                                  <div><strong>Amount to be Liquidated: &nbsp &nbsp</strong>&#8358;<?php
                                    echo number_format($value['amount_to_be_liquidated']);
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
                                   <button type="button" class="btn btn-success approve_liquidation_acc" name="approve_liquidation_acc" id="<?php echo $value['investment_id']; ?>">Approve</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <?php
                                  $compute_liquidation = compute_liquidation_params_for_fixed_acc($value['investment_id']);
                                  $compute_liquidation_decode = json_decode($compute_liquidation, true);
                                  //var_dump($compute_liquidation);
                                ?>
                                <form method="post" id="approve_liquidation_acc_form<?php echo $value['investment_id']; ?>">
                                    <input type="hidden" class="form-control" id="investment_id" name="investment_id" value="<?php echo $value['investment_id']?>">
                                    <input type="hidden" class="form-control" id="amount_to_be_liquidated" name="amount_to_be_liquidated" value="<?php echo $compute_liquidation_decode['final_liquidation_amount']?>">
                                    <input type="hidden" class="form-control" id="days_so_far" name="days_so_far" value="<?php echo $compute_liquidation_decode['days_so_far']?>">
                                      <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $value['user_id']?>">
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
                                   <button type="button" class="btn btn-danger reject_liquidation_acc" name="reject_liquidation_acc" id="<?php echo $value['investment_id']; ?>">Reject</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="reject_liquidation_acc_form<?php echo $value['investment_id']; ?>">
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