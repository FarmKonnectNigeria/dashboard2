<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

// $table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_pending_withdrawal = $object->get_pending_withdrawal_from_wallet_and_profit();

?>


<body class="">
  <?php include('includes/sidebar.php'); ?>
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
              <h3 class="mb-0">This is a list of all Pending Withdrawals</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_pending_withdrawal == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">First name</th>
                        
                        <th scope="col">Last name</th>
                        <th scope="col">Amount Requested</th>
                        <th scope="col">Withdrawal Type</th>
                        <th scope="col">Date Requested</th>
                        <?php
             
                          if(strcasecmp($role_name, 'Feedback Officer') == 0){
                          echo "<th>Status</th>";
                        }
                        ?>
                        <th>Action</th>
                   

                  </tr>
                </thead>
                <tbody>
                   <?php
                   $count = 1;
                   foreach($get_pending_withdrawal as $value){
                    $getuser = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']); 
                     ?>
                     <tr>
                        <td><?php echo $count;?></td>
                        <td><?php echo $getuser['surname'];?></td>
                        <td><?php echo $getuser['other_names'];?></td>
                        <td> &#8358; <?php echo number_format($value['amount_withdrawn']);?></td>
                        <td><?php if($value['purpose'] == 2){
                          echo "<span class='badge badge-primary'>profit</span>";
                        }else if($value['purpose'] == 5){
                          echo "<span class='badge badge-success'>wallet</span>";
                        }
                        ?>
                        </td>
                        <td><?php echo $value['date_created'];?></td>

                        <?php
             
                          if(strcasecmp($role_name, 'Super Administrator') == 0){
                        ?>
                        <td> <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Approve</small>
                        <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject<?php echo $value['id']; ?>">Reject</small>
                        <?php
                          }else if(strcasecmp($role_name, 'Feedback Officer') == 0){
                        ?>

                        <td>
                          <?php
                            if($value['processing_status'] == 0){
                          ?> 
                          <small class="badge badge-primary">New</small>
                        <?php } else if($value['processing_status'] == 1){
                          ?>
                          <small class="badge badge-info">Escalated</small>
                          <?php
                        }else if($value['processing_status'] == 2){
                          ?>
                          <small class="badge badge-success">Resolved</small>
                          <?php
                        }
                          ?>
                        </td>

                        <td>
                        <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?php echo $value['id']; ?>">Edit</small>
                      </td>
                      <?php } ?>
                        <form method="post" id="withdrawal_request_form<?php echo $value['unique_id']; ?>">
                          <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                          <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $value['user_id']?>">
                          <input type="hidden" class="form-control" id="amount_withdrawn" name="amount_withdrawn" value="<?php echo $value['amount_withdrawn']?>">
                        </form>
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
                                  <button type="button" class="btn btn-success approve_request" name="approve_request" id="<?php echo $value['unique_id']; ?>">Approve</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
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
                                  <button type="button" class="btn btn-success reject_request" name="reject_request" id="<?php echo $value['unique_id']; ?>">Reject</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>


                         <div class="modal fade" id="edit<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                            <div class="col-lg-12"> 
                               <form method="post" id="edit_withdrawal_request<?php echo $value['id']; ?>" action="">
                             <label class="form-control-label" for="input-first-name">Status of Request</label><br>
                                  <select class="col-lg-12 form-control" name="status">
                                      <option value="Select status of Request">Select status of Request</option>
                                      <option value="1">Escalate</option>
                                      <option value="2">Resolve</option>
                                  </select>
                                  <input type="hidden" name="request_id" value="<?php echo $value['unique_id']?>">
                                </form>
                            </div>
                          </div><br>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-success update_withdrawal_request" name="update_withdrawal_request" id="<?php echo $value['id']; ?>">Update</button>
                                  </form>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>

                              </div>

                            </div>
                          </div>
  

                      </tr>
                <?php $count++;} } ?>
                 
                 
                 
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