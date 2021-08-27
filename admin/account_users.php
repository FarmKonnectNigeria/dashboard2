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
$table = "admin_tbl";
$get_rows = $object->get_rows_from_one_table($table);
?>

<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name !=  'Super Administrator'){
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
              <h3 class="mb-0">This is a list of all Admin Account users</h3> 
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Surname</th>
                        <th scope="col">Other Names</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Date Added</th>
                        <th>Action</th>
                   

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                    //if($value['unique_id'] != $uid){
                    $get_admin_role = $object->get_one_row_from_one_table('admin_roles','unique_id',$value['role_right']);
                     ?>
                     <tr>
                        <td><?php echo $value['surname'];?></td>
                        <td><?php echo $value['other_names'];?></td>
                        <td><?php echo $value['email'];?></td>
                        <td><?php echo $get_admin_role['role_name'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td> 
                          <?php
                          if($value['access_level'] == 1){
                         ?>
                          <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#disable<?php echo $value['id']; ?>">Deactivate Account</small> 
                          <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#reset<?php echo $value['id']; ?>">Reset Password</small> 
                        <?php } else if($value['access_level'] == 0){?>
                          <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#enable<?php echo $value['id']; ?>">Activate Account</small> 
                        <?php } ?>
                        </td>

                      <div class="modal fade bd-example-modal-md" id="disable<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Deactivate Account</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body"> 
                                Are you sure you want to Deactivate this account?
                                </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger disable_admin" id="<?php echo $value['unique_id'] ;?>">Deactivate</button>
                                <form method="post" id="disable_admin_form<?php echo $value['unique_id'];?>">
                                  <input type="hidden" name="user_id" class="form-control" value="<?php echo $value['unique_id'];?>">
                                </form>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal fade bd-example-modal-md" id="enable<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Enable Account</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to enable this account?
                                </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success enable_admin" id="<?php echo $value['unique_id'] ;?>">Enable</button>
                                <form method="post" id="enable_admin_form<?php echo $value['unique_id'];?>">
                                  <input type="hidden" name="user_id" class="form-control" value="<?php echo $value['unique_id'];?>">
                                </form>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade bd-example-modal-md" id="reset<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="post" id="reset_admin_password_form<?php echo $value['unique_id'];?>">
                                  <div class="row">
                                    <label>New Password</label>
                                    <input type="password" name="new_pword" id="new_pword" class="form-control">
                                  </div><br>
                                  <div class="row">
                                    <label>Confirm New Password</label>
                                    <input type="password" name="confirm_pword" id="confirm_pword" class="form-control">
                                  </div>
                                  <input type="hidden" name="user_id" class="form-control" value="<?php echo $value['unique_id'];?>">
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success reset_admin_password" id="<?php echo $value['unique_id'] ;?>">Reset Password</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </tr>
                      <?php //} 
                      } 

                    } ?>

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