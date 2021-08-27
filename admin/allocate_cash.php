<?php include('includes/instantiated_files2.php');
include('includes/header.php');
 

// $table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_request = $object->get_rows_from_one_table('cash_request_log');


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
              <h3 class="mb-0">This is a list of Cash Request from Accountant(s)</h3>
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
                        <th scope="col">Amount Requested for</th>
                        <th>Status</th>
                        <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_request as $value){

                    $get_admin = $object->get_one_row_from_one_table('admin_tbl','unique_id',$value['admin_id']);
                         
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $get_admin['surname'].' '.$get_admin['other_names'];?></td>
                        <td><?php echo $get_admin['email'];?></td>
                        <td>&#8358;<?php echo number_format($value['amount']);?></td>
                        <td>
                          <?php 
                            if($value['status'] == 0){
                              echo '<small class="badge badge-sm badge-primary">Pending</small>';
                            }
                            else if($value['status'] == 1){
                              echo '<small class="badge badge-sm badge-success">Approved</small>';
                            }
                            else if($value['status'] == 2){
                              echo '<small class="badge badge-sm badge-danger">Rejected</small>';
                            }
                            else{
                              echo '<small class="badge badge-sm badge-warning">No Status</small>';
                            }

                          ?>
                        </td>
                        <td> 
                            <?php if($value['status'] == 0){?>
                            <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Allocate Cash</small>
                              <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject<?php echo $value['id']; ?>">Reject</small> 
                            <?php }else{
                               echo '<small class="badge badge-sm badge-warning">No Action</small>';
                            }
                            ?>
                        </td>
                        <div class="modal fade bd-example-modal-md" id="approve<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Allocate Cash</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to allocate cash to accountant?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-success allocate_cash" name="allocate_cash" id="<?php echo $value['unique_id']; ?>">Allocate</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="allocate_cash_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                    <input type="hidden" class="form-control" id="admin_id" name="admin_id" value="<?php echo $value['admin_id']?>">
                                    <input type="hidden" class="form-control" id="amount" name="amount" value="<?php echo $value['amount']?>">
                                </form>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade bd-example-modal-md" id="reject<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Reject Cash Request</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to reject cash request?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-danger reject_cash_request" name="reject_cash_request" id="<?php echo $value['unique_id']; ?>">Reject</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="reject_cash_request_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
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