<?php 
include('includes/header.php'); 

  include('includes/instantiated_files2.php');
$get_rows = $object->get_rows_from_one_table_by_id('client_payment_log', 'payment_status', 1);
//print_r($get_rows);

?>

<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name != 'Cash Officer'){
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
              <h3 class="mb-0">This is the Payment Request List</h3> 
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Name of Client</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th>Status</th>
                        <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                    $get_client = $object->get_one_row_from_one_table('leads','unique_id',$value['client_id']);
                    $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['client_id']);
                    // $get_package = $object->get_one_row_from_one_table('package_tbl','unique_id',$value['package_id']);
                    // $get_package_category = $object->get_one_row_from_one_table('package_category','unique_id',$value['package_category_id']);
                     ?>
                     <tr>
                        <td><?php 
                        if($get_client == null){
                          echo $get_user['surname'].' '.$get_user['other_names'];
                        }else{
                        echo $get_client['fullname'];
                        }
                        ?> 
                        </td>
                        <td><?php echo $get_client['email'];?></td>
                        <td><?php echo $get_client['phone'];?></td>
                        <td><?php echo $value['amount'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td>
                        <?php
                        if($value['payment_status'] == 2){
                        ?>
                        <small class="badge badge-success">Confirmed</small>
                      <?php }else if($value['payment_status'] == 1){?>
                        <small class="badge badge-primary">Pending</small>
                        <?php }else if($value['payment_status'] == 3){?>
                          <small class="badge badge-danger">Not Received</small>
                        <?php }?>
                      </td>
                      <?php
                        if($value['payment_status'] == 1){
                      ?>
                      <td><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#confirm<?php echo $value['id']; ?>">Confirm</button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reject<?php echo $value['id']; ?>">Reject</button></td>
                      </tr>
                      <div class="modal fade bd-example-modal-md" id="confirm<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Confirm Payment</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to confirm this payment?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-success approve_payment" name="approve_payment" id="<?php echo $value['unique_id']; ?>">Confirm</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="approve_payment_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                    <input type="hidden" class="form-control" id="admin_id" name="admin_id" value="<?php echo $value['admin_id']?>">
                                    <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $get_client['email']?>">
                                </form>
                            </div>
                          </div>
                        </div>
                      <div class="modal fade bd-example-modal-md" id="reject<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Reject Payment</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to reject this request?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-danger reject_payment" name="reject_payment" id="<?php echo $value['unique_id']; ?>">Reject</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="reject_payment_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                </form>
                            </div>
                          </div>
                        </div>
                      <?php }  } }?>

                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <!-- <nav aria-label="...">
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