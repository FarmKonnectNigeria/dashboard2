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
              <h3 class="mb-0">This is a the page where BEs are placed on or removed from probation</h3>
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
                        
                        <th scope="col">Rating</th>
                        <th scope="col">Sales Bar</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
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
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $get_be['surname']. ' '.$get_be['other_names'];?></td>
                        <td><?php echo "No rating"; ?></td>
                        <td>
                          <?php echo $get_be_sales['sales_made'] == null ? 'No Sales' : $get_be_sales['sales_made'];?> 
                        </td>
                        <td><?php echo $get_be['phone'];?></td>
                        <td><?php echo $get_be['email'];?></td>

                          <td> 
                            <?php
                            if($value['status'] == 0){
                          ?> 
                          <small class="badge badge-sm badge-danger">Sacked</small>
                          <?php
                            }else if($value['status'] == 1){
                          ?> 
                          <small class="badge badge-sm badge-success">Full time BE</small>

                          <?php } else if($value['status'] == 2){?>
                          <small class="badge badge-sm badge-warning">Suspended</small> 

                        <?php } else if($value['status'] == 3){?>
                          <small class="badge badge-sm badge-warning">Pending (Sacking)</small> 

                        <?php }  else if($value['status'] == 4){?>
                          <small class="badge badge-sm badge-warning">Pending (Suspension)</small>

                        <?php } else if($value['status'] == 5){?>
                          <small class="badge badge-sm badge-danger">Probation BE</small> 
                        <?php } ?>
                        </td>
                           <td> 
                           <?php
                            if($value['status'] == 1){
                          ?> 
                          <small class="btn btn-sm btn-warning" data-toggle="modal" data-target="#place_probation<?php echo $value['id']; ?>">Place on Probation</small>
                        <?php } 
                            else if($value['status'] == 5){
                          ?> 
                          <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#remove_probation<?php echo $value['id']; ?>">Remove Probation</small>
                        <?php } ?>
                        </td>


                          <div class="modal fade bd-example-modal-md" id="place_probation<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Place on Probation</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to place this Business Executive on probation?
                                </div>
                                <div class="modal-footer">
                                   <button type="button" class="btn btn-success place_probation" name="place_probation" id="<?php echo $value['unique_id']; ?>">Yes</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                  <form method="post" id="place_probation_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                </form>
                                  </form>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade bd-example-modal-md" id="remove_probation<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Remove from Probation</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to remove this Business Executive from probation?
                                </div>
                                <div class="modal-footer">
                                   <button type="button" class="btn btn-success remove_probation" name="remove_probation" id="<?php echo $value['unique_id']; ?>">Yes</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                  <form method="post" id="remove_probation_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                </form>
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