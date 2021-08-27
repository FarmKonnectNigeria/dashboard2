<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$get_rows = $object->get_rows_from_one_table_by_one_param('business_executive_tbl','assigned_to',$uid);

?>


<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name !=  'Marketing Manager'){
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
              <h3 class="mb-0">This is a list of all you business executives</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ 
                        ?>
                  <tr>
                    
                        <th scope="col">Fullname</th>
                        
                        <!--<th scope="col">Rating</th>-->
                        <th scope="col">Sales Bar</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Number of Clients</th>
                        <th scope="col">Status</th>
                        <?php //if($found > 0){?>
                           <th>Action</th>
                        <?php //} ?>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                      $get_be = $object->get_one_row_from_one_table('admin_tbl','unique_id', $value['unique_id']); 
                      $get_be_sales = $object->get_one_row_from_one_table('be_target','BE_id', $value['unique_id']);  
                      $get_no_client = $object->get_number_of_rows_one_param('leads','assigned_to', $value['unique_id']);
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $get_be['surname']. ' '.$get_be['other_names'];?></td>
                        <!--<td></td>-->
                        <td>
                          <?php echo ($get_be_sales == null || $get_be_sales['sales_made'] == '') ? 'No Sales' : number_format($get_be_sales['sales_made'], 2);?> 
                        </td>
                        <td><?php echo $get_be['phone'];?></td>
                        <td><?php echo $get_be['email'];?></td>
                        <td><?php echo $get_no_client;?></td>

                          <td> 
                           <?php
                            if($value['status'] == 0){
                          ?> 
                          <small class="badge badge-sm badge-danger">Sacked</small>
                          <?php
                            }else if($value['status'] == 1){
                          ?> 
                          <small class="badge badge-sm badge-success">Active</small>

                          <?php } else if($value['status'] == 2){?>
                          <small class="badge badge-sm badge-warning">Suspended</small> 

                        <?php } else if($value['status'] == 3){?>
                          <small class="badge badge-sm badge-warning">Pending (Sacking)</small> 

                        <?php }  else if($value['status'] == 4){?>
                          <small class="badge badge-sm badge-warning">Pending (Suspension)</small>

                        <?php } else if($value['status'] == 5){?>
                          <small class="badge badge-sm badge-danger">On Probation</small> 
                        <?php } ?>
                        </td>


                        <td> 
                          <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view_be<?php echo $value['id']; ?>">View Details</small>

                           <?php
                            if($value['status'] == 1){
                          ?> 
                          <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#sack<?php echo $value['id']; ?>">Sack BE</small>

                          <small class="btn btn-sm btn-warning" data-toggle="modal" data-target="#suspend_be<?php echo $value['id']; ?>">Suspend BE</small>

                          <?php } else if($value['status'] == 2){?>
                          <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#reactivate<?php echo $value['id']; ?>">Reactivate BE</small> 
                        <?php } ?>
                        </td>

                      <div class="modal fade bd-example-modal-md" id="view_be<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Business Executive's Details</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                <div class="col-md-6">
                                  <label>Surname</label>
                                  <input type="text" class="form-control form-control-sm" value="<?php echo $get_be['surname']; ?>" name="surname" id="surname" readonly>
                                  </div>
                                  <div class="col-md-6">
                                  <label>Other Names</label>
                                  <input type="text" class="form-control form-control-sm"  value="<?php echo $get_be['other_names']; ?>" name="other_names" id="other_names" readonly>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                  <label>Phone</label>
                                  <input class="form-control form-control-sm" type="text" value="<?php echo $get_be['phone']; ?>" id="phone" name="phone" readonly>
                                  </div>
                                  <div class="col-md-6">
                                  <label>Home Address</label>
                                  <input class="form-control form-control-sm" type="text" value="<?php echo $get_be['address']; ?>" id="address" name="address" readonly>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <label>Email Address</label>
                                  <input class="form-control form-control-sm" type="text" value="<?php echo $get_be['email']; ?>" id="email" name="email" readonly>
                                  </div>
                                  <div class="col-md-6">
                                    <label>Gender</label>
                                    <input class="form-control form-control-sm" type="text" value="<?php echo $get_be['gender']; ?>" id="gender" name="gender" readonly>
                                  </div>
                              </div><br>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade bd-example-modal-md" id="sack<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Sack BE</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                Are you sure you want to sack this Business Executive?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success sack_be" name="sack_be" id="<?php echo $value['unique_id']; ?>" > Sack </button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                  <form method="post" id="sack_be_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                </form>
                                </div>
                            </div>
                          </div>
                        </div>
  
                          <div class="modal fade bd-example-modal-md" id="suspend_be<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Suspend BE</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form method="post" id="suspend_be_form<?php echo $value['unique_id']; ?>">
                                    <div class="col-md-12">
                                    <label>Time Frame (in days)</label>
                                    <input type="text" class="form-control" name="time_frame" id="time_frame">
                                    </div>
                                    <input type="hidden" class="form-control" id="BE_id" name="BE_id" value="<?php echo $value['unique_id']?>">
                                  </form>
                                </div>
                                <div class="modal-footer">
                                   <button type="button" class="btn btn-success suspend_be" name="suspend_be" id="<?php echo $value['unique_id']; ?>">Suspend</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                          </div>
                        </div>


                          <div class="modal fade bd-example-modal-md" id="reactivate<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Reactivate BE</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to reactivate this Business Executive?
                                </div>
                                <div class="modal-footer">
                                   <button type="button" class="btn btn-success reactivate_be" name="reactivate_be" id="<?php echo $value['unique_id']; ?>">Reactivate</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                  <form method="post" id="reactivate_be_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                  </form>
                                </div>
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