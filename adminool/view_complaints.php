<?php 

session_start();
include('includes/header.php'); 
require_once("../classes/db_class.php");
include("../includes/config.php");

if(!isset($_SESSION['adminid'])){
    header('location: login');
}
    
  ///id seession
   $uid = $_SESSION['adminid'];
   //class object
   $object = new DbQueries();
    $current_user_details = $object->get_current_user_info('admin_tbl',$uid);
  // $current_user_privilege = $current_user_details['role_id'];
   $surname = $current_user_details['surname'];
   $other_names = $current_user_details['other_names'];
   $fullname_user = $surname.' '.$other_names;
$table = "contact_us_tbl";
$get_rows = $object->get_rows_from_one_table($table);

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
              <h3 class="mb-0">This is a list of complaints sent by Users</h3> 
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Sent By</th>
                        <th scope="col">Issue</th>
                        <th scope="col">Message</th>
                        <th scope="col">Date Submitted</th>
                        <th>Status</th>
                        <th>Action</th>
                   

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                    $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                     ?>
                     <tr>
                        <td><?php echo $get_user['surname']. ' '.$get_user['other_names'];?></td>
                        <td><?php echo $value['issues'];?></td>
                        <td><?php echo $value['comment'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td>
                        <?php
                          if($value['status'] == 0){
                        ?> 
                        <small class="badge badge-primary">New</small>
                      <?php } else if($value['status'] == 1){
                        ?>
                        <small class="badge badge-info">Escalated</small>
                        <?php
                      }else if($value['status'] == 2){
                        ?>
                        <small class="badge badge-success">Resolved</small>
                        <?php
                      }
                        ?>
                      </td>
                      <td>
                        <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?php echo $value['id']; ?>">Edit</small>
                      </td>
                      </tr>

                 <div class="modal fade" id="edit<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Complaint</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                            <div class="col-lg-12"> 
                               <form method="post" id="edit_complaints<?php echo $value['id']; ?>" action="">
                             <label class="form-control-label" for="input-first-name">Status of Complaint</label><br>
                                  <select class="col-lg-12 form-control" name="status">
                                      <option value="Select Complaint">Select status of Complaint</option>
                                      <option value="1">Escalate</option>
                                      <option value="2">Resolve</option>
                                  </select>
                                  <input type="hidden" name="complaint_id" value="<?php echo $value['unique_id']?>">
                                </form>
                            </div>
                      </div><br>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-success get_complaint_id" name="update_complaint" id="<?php echo $value['id']; ?>">Update</button>
                                  </form>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>

                              </div>

                            </div>
                          </div>
                      <?php }  } ?>

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