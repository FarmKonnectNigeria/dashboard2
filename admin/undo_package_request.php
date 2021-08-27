<?php include('includes/instantiated_files2.php');
include('includes/header.php');
 

// $table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_request = $object->get_rows_from_one_table_by_one_param('undo_package_sub_request','status', 0);

?>


<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name != 'Super Administrator'){
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
              <h3 class="mb-0">This is a list of pending Undo-Package Subscription requests</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_request == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                        <th scope="col">Investor's Name</th>
                        <th scope="col">Package Name</th>
                        
                        <th scope="col">Reason</th>
                        <th scope="col">Submitted By</th>
                        <th scope="col">Date Created</th>
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
                    $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$get_investment['user_id']);  

                    $get_admin = $object->get_one_row_from_one_table('admin_tbl','unique_id',$value['admin_id']);
                     ?>
                     <tr>
                        <td><?php echo $get_user['surname'].' '.$get_user['other_names'];?></td>
                        <td><?php echo $get_package['package_name'];?></td>
                        <td><?php echo $value['description'];?></td>
                        <td><?php echo $get_admin['surname'].' '.$get_admin['other_names'] ;?></td>
                        <td><?php echo $value['date_created'];?></td>


                        <?php //if($found > 0){?>
                        <td> 
                          <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view<?php echo $value['id']; ?>">View Details</small>
                          <span id="approve_pac_undo_modal<?php echo $value['unique_id']; ?>"><small class="btn btn-sm btn-success" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Approve</small></span>
                          <span id="reject_pac_undo_modal<?php echo $value['unique_id']; ?>"><small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject<?php echo $value['id']; ?>">Reject</small></span> </td>
                        <?php //} ?>

                        <div class="modal fade bd-example-modal-md approve_modal" id="approve<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                   <button type="button" class="btn btn-success undo_package_sub" name="undo_package_sub" id="<?php echo $value['unique_id']; ?>">Approve</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="undo_package_sub_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="idd" name="idd" value="<?php echo $value['investment_id']?>">
                                </form>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade bd-example-modal-md reject_modal" id="reject<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                   <button type="button" class="btn btn-danger reject_card_request" name="reject_card_request" id="<?php echo $value['unique_id']; ?>">Reject</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="reject_card_request_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                </form>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="view<?php echo $value['id']; ?>"  role="dialog" aria-labelledby="myLargeModalLabel"  aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                      <div class="modal-content ">
                        <div class="modal-header">
                          <h2 class="modal-title" id="exampleModalLabel">Investment Details</h2>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                 <div>Product Type: <strong><?php echo ($get_investment['package_type'] == 1 ? 'Fixed' : 'Reccurent'); ?></strong></div>
                            
                                <br>

                                <div>Liquidation Status: <strong><?php echo ($get_investment['package_type'] == 0 ? 'Not Liquidated' : 'Liquidated'); ?></strong></div>
                            
                                <br>

                                <div>Total Amount Paid: <strong><?php echo '&#8358;'.number_format($get_investment['total_amount']); ?></strong> </div>
                                
                                <br>
                                  <div>Moratorium: <strong><?php echo $get_investment['moratorium']; ?></strong> </div><br>
                                    <div>Number of Slots Bought: <strong><?php echo $get_investment['no_of_slots_bought']; ?></strong> </div><br>

                                      <div>Package Commission: <strong><?php echo $get_investment['package_commission']; ?></strong> </div><br>
                                      <div>Incubation Period: <strong><?php if($get_investment['incubation_period'] == NUll){echo "Not Applicable"; }else{ echo $get_investment['incubation_period'].' day(s)';} ?></strong> </div>
                              
                                <br>
                                <div>Recurrence Value: <strong><?php if($get_investment['recurrence_value'] == NULL){echo "Not Applicable"; }else{ echo $get_investment['recurrence_value'];} ?></strong> </div>
                              
                                <br>  
                                <div>Recurrence Type: <strong><?php if($get_investment['recurrence_type'] == NULL){echo "Not Applicable"; }else{ echo $get_investment['recurrence_type'];} ?></strong> </div>
                              
                                <br>
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