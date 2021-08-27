<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$get_rows = $object->get_rows_from_one_table_by_one_param('target_bonus_commission','set_by',$uid);
$get_probation_target = $object->get_rows_from_one_table_by_one_param('probation_target','set_by',$uid);
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
              <h3 class="mb-0">This is a list of Regular/Individual Target</h3>
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
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Monthly Target</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                      $get_be = $object->get_one_row_from_one_table('admin_tbl','unique_id', $value['set_for']); 
                      $get_be_status = $object->get_one_row_from_one_table('business_executive_tbl','unique_id', $value['set_for']);  
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $get_be['surname']. ' '.$get_be['other_names'];?></td>
                        <td><?php echo $get_be['phone'];?></td>
                        <td><?php echo $get_be['email'];?></td>
                        <td>&#8358;<?php echo number_format($value['monthly_target']);?></td>
                        <td> 
                           <?php
                            if($get_be_status['status'] == 0){
                          ?> 
                          <small class="badge badge-sm badge-danger">Sacked</small>
                          <?php
                            }else if($get_be_status['status'] == 1){
                          ?> 
                          <small class="badge badge-sm badge-success">Active</small>

                          <?php } else if($get_be_status['status'] == 2){?>
                          <small class="badge badge-sm badge-warning">Suspended</small> 

                        <?php } else if($get_be_status['status'] == 3){?>
                          <small class="badge badge-sm badge-warning">Pending (Sacking)</small> 

                        <?php }  else if($get_be_status['status'] == 4){?>
                          <small class="badge badge-sm badge-warning">Pending (Suspension)</small>

                        <?php } else if($get_be_status['status'] == 5){?>
                          <small class="badge badge-sm badge-danger">On Probation</small> 
                        <?php } ?>
                        </td>
                        <td> 
                          <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?php echo $value['id']; ?>">Edit</small>
                        </td>

                      <div class="modal fade bd-example-modal-md" id="edit<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Monthly Target</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <label>Monthly Target</label>
                                      <form method="post" id="edit_individual_target_form<?php echo $value['unique_id']; ?>">
                                        <input type="text" class="form-control" value="<?php echo $value['monthly_target']; ?>" name="monthly_target" id="monthly_target">
                                        <input type="hidden" name="BE_id" value="<?php echo $value['set_for']; ?>" id="BE_id">
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success edit_individual_target" id="<?php echo $value['unique_id']; ?>">Edit</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                          </div>
                        </div>
                      </tr>
                <?php } } ?>
                 
                 
                 
                </tbody>
              </table>
            </div>

            <div class="card-header border-0">
              <h3 class="mb-0">This is the Probation Target</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ 
                        ?>
                  <tr>
                        <th scope="col">Probation Target</th>
                        <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_probation_target as $value){   
                     ?>
                     <tr>
                        <td>&#8358;<?php echo number_format($value['monthly_target']);?></td>
                        <td> 
                          <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_probation_target<?php echo $value['id']; ?>">Edit</small>
                        </td>

                      <div class="modal fade bd-example-modal-md" id="edit_probation_target<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Probation Target</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <label>Probation Target</label>
                                      <form method="post" id="edit_probation_target_form<?php echo $value['unique_id'];?>">
                                        <input type="text" class="form-control" value="<?php echo $value['monthly_target']; ?>" name="monthly_target" id="monthly_target">
                                        <input type="hidden" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']; ?>">
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success edit_probation_target" id="<?php echo $value['unique_id']; ?>">Edit</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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