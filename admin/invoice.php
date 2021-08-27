<?php 
include('includes/header.php'); 

  include('includes/instantiated_files2.php');
$get_rows = $object->get_rows_from_one_table('client_invoice');
//print_r($get_rows);

?>

<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Accountant'){
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
              <h3 class="mb-0">This is a list of your Business Executive Client Transfer Request</h3> 
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Transfered From</th>
                        <th scope="col">Transfered to</th>
                        <th scope="col">Clients to be transfered</th>
                        <th scope="col">Time Frame</th>
                        <th scope="col">Date Submitted</th>
                        <th>Status</th>
                        <th>Action</th>
                   

                  </tr>
                </thead>
                <tbody>
                   <?php
                   $count = 1;
                   foreach($get_rows as $value){
                    $get_be = $object->get_one_row_from_one_table('business_executive_tbl','unique_id', $value['transferred_from']);
                    $get_transferred_from = $object->get_one_row_from_one_table('admin_tbl','unique_id', $value['transferred_from']);
                    $get_transferred_to = $object->get_one_row_from_one_table('admin_tbl','unique_id', $value['transferred_to']);
                    $client_id = json_decode($value['clients_id']);
                    
                    if($get_be['assigned_to'] == $uid){
                     ?>
                     <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $get_transferred_from['surname'].' '.$get_transferred_from['other_names'];?></td>
                        <td><?php echo $get_transferred_to['surname'].' '.$get_transferred_to['other_names'];?></td>
                        <td>
                          <?php 
                          foreach ($client_id as $clients) {
                          $get_client_name = $object->get_one_row_from_one_table('leads','unique_id', $clients);
                          echo $get_client_name['fullname'].'<br>';
                        }
                          ?>
                            
                          </td>
                        <td style="text-transform: capitalize;"><?php echo $value['time_frame'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td>
                        <?php
                          if($value['status'] == 0){
                        ?> 
                        <small class="badge badge-primary">Pending</small>
                      <?php } else if($value['status'] == 1){
                        ?>
                        <small class="badge badge-success">Approved</small>
                        <?php
                      }else if($value['status'] == 2){
                        ?>
                        <small class="badge badge-danger">Rejected</small>
                        <?php
                      }
                        ?>
                      </td>
                      <td>
                        <?php
                          if($value['status'] == 0){
                        ?>
                        <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Approve</small>
                        <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject<?php echo $value['id']; ?>">Reject</small>
                      <?php }?>
                      </td>
                      </tr>

                 <div class="modal fade" id="approve<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Approve Transfer</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                Are you sure you want to approve the transfer? 
                               <form method="post" id="approve_transfer_client_request_form<?php echo $value['unique_id']; ?>" action="">
                                  <input type="hidden" name="unique_id" value="<?php echo $value['unique_id']?>">
                                </form>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-success approve_transfer_client_request" name="approve_transfer_client_request" id="<?php echo $value['unique_id']; ?>">Approve</button>
                                  </form>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                              </div>

                            </div>
                          </div>

                          <div class="modal fade" id="reject<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Reject Transfer</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                Are you sure you want to reject this transfer? 
                               <form method="post" id="reject_transfer_client_request_form<?php echo $value['unique_id']; ?>" action="">
                                  <input type="hidden" name="unique_id" value="<?php echo $value['unique_id']?>">
                                </form>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-danger reject_transfer_client_request" name="reject_transfer_client_request" id="<?php echo $value['unique_id']; ?>">Reject</button>
                                  </form>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                              </div>

                            </div>
                          </div>
                      <?php $count++;}  } }?>

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