<?php include('includes/instantiated_files2.php');
include('includes/header.php');
 

// $table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_request = $object->get_rows_from_one_table_by_one_param('package_definition_request','approval_status',0);


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
              <h3 class="mb-0">This is a list of pending Package Creation requests</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_request == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Package Name</th>
                        
                        <th scope="col">Package Category</th>
                        <th scope="col">Package Type</th>
                        <th scope="col">Package Unit Price</th>
                        <?php //if($found > 0){?>
                           <th>Action</th>
                        <?php //} ?>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_request as $value){

                    $get_category = $object->get_one_row_from_one_table('package_category','unique_id',$value['package_category']);
                         
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $value['package_name'];?></td>
                        <td><?php echo $get_category['name'];?></td>
                        <td><?php echo ($value['package_type'] == 1 ? 'Fixed' : 'Reccurent');?></td>
                        <td>&#8358;<?php echo number_format($value['package_unit_price']);?></td>


                        <?php //if($found > 0){?>
                        <td> 
                          <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view<?php echo $value['id']; ?>">View Details</small>
                          <span id="approve_pac_modal<?php echo $value['unique_id']; ?>"><small class="btn btn-sm btn-success" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Approve</small></span>
                          <span id="reject_pac_modal<?php echo $value['unique_id']; ?>"><small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject<?php echo $value['id']; ?>">Reject</small></span> </td>
                        <?php //} ?>

                        <div class="modal fade bd-example-modal-md approval_modal" id="approve<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                   <button type="button" class="btn btn-success approve_package_creation" name="approve_package_creation" id="<?php echo $value['unique_id']; ?>">Approve</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="approve_package_creation_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
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
                                   <button type="button" class="btn btn-danger reject_package_creation" name="reject_package_creation" id="<?php echo $value['unique_id']; ?>">Reject</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="reject_package_creation_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                </form>
                            </div>
                          </div>
                        </div>


                        <div class="modal fade" id="view<?php echo $value['id']; ?>"  role="dialog" aria-labelledby="myLargeModalLabel"  aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                      <div class="modal-content ">
                        <div class="modal-header">
                          <h2 class="modal-title" id="exampleModalLabel">Package Details</h2>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                             
                                  <div><strong>Package Description:</strong></div><textarea class="form-control ckeditor" id="editor1" readonly name="editor1" rows="10"><?php echo $value['package_description'];?></textarea><br>
                                 <!--  -->
                                 <div>Product Type: <strong><?php echo ($value['package_type'] == 1 ? 'Fixed' : 'Reccurent'); ?></strong></div>
                            
                                <br>
                                 <div>Available Slots: <strong><?php echo number_format($value['no_of_slots']); ?></strong> </div>
                              
                                <br>

                                 <div>Minimum Slot You can buy: <strong><?php echo $value['min_no_slots']; ?></strong> </div>
                              
                                <br>

                                <div>Package Unit Price: <strong><?php echo '&#8358;'.number_format($value['package_unit_price']); ?></strong> </div>
                                
                                <br>
                                
                             
                                 
                                  <div>Moratorium: <strong><?php echo $value['moratorium']; ?></strong> </div><br>
                                  <div>Free Liquidation Period: <strong><?php echo $value['free_liquidation_period'].' day(s)'; ?></strong> </div><br>

                                   <div>Tenure of Product: <strong><?php if($value['tenure_of_product'] == 'inf'){echo "INFINITE"; }else{ echo $value['tenure_of_product'].' day(s)';} ?></strong> </div><br>

                                    <div>Float Time: <strong><?php echo $value['float_time']; ?></strong> </div><br>

                                     <div>Multiplying Factor: <strong><?php echo $value['multiplying_factor']; ?></strong> </div><br>

                                      <div>Package Commission: <strong><?php echo $value['package_commission']; ?></strong> </div><br>
                                      <div>Incubation Period: <strong><?php if($value['incubation_period'] == NUll){echo "Not Applicable"; }else{ echo $value['incubation_period'].' day(s)';} ?></strong> </div>
                              
                                <br>
                                <div>Recurrence Value: <strong><?php if($value['recurrence_value'] == NULL){echo "Not Applicable"; }else{ echo $value['recurrence_value'];} ?></strong> </div>
                              
                                <br>
                                <div>Contribution Period: <strong><?php if($value['contribution_period'] == NULL){echo "Not Applicable"; }else{ echo $value['contribution_period'].' day(s)';} ?></strong> </div>
                              
                                <br>
                                <div>Recurrence Type: <strong><?php if($value['recurrence_type'] == NULL){echo "Not Applicable"; }else{ echo $value['recurrence_type'];} ?></strong> </div>
                              
                                <br>
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