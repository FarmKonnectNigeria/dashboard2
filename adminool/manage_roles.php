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
$table = "admin_roles";
$get_rows = $object->get_rows_from_one_table($table);
$get_functions = $object->get_rows_from_one_table('site_functions');
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
              <h3 class="mb-0">This is a list of available roles</h3> 
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Role name</th>
                        <th scope="col">Added By</th>
                        <th scope="col">Date Added</th>
                        <th>Action</th>
                   

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){

                     ?>
                     <tr>
                      
                       
                        <td><?php echo $value['role_name'];?></td>
                        <td><?php echo $fullname_user;?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <?php
                          if($value['added_by'] == $uid){
                        ?>
                        <td>
                        <?php
                          if($value['status'] == 0){
                        ?> 
                        <small class="badge badge-danger">Archived</small>
                      <?php } else{?>
                          <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit<?php echo $value['id']; ?>">Edit Role</small>
                          <small class="btn btn-sm btn-danger"data-toggle="modal" data-target="#archive<?php echo $value['id']; ?>">Archive Role</small>
                        </td>
                        <?php } ?>
                      </tr>

                 <div class="modal fade" id="edit<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                            <div class="col-lg-12"> 
                               <form method="post" id="edit_role_form<?php echo $value['id']; ?>" action="">
                             <label class="form-control-label" for="input-first-name">Functions to be performed</label><br>
                                  <select class="col-lg-12" name="functions[]" multiple="multiple">
                                      <!-- <option value="Select Functions">Select Functions</option> -->
                                      <?php 
                                        foreach($get_functions as $val){
                                      ?>
                                      <option value="<?php echo $val['unique_id']; ?>"><?php echo $val['function_description']; ?></option>
                                    <?php } ?>

                                  </select>
                                  <input type="hidden" name="role_id" value="<?php echo $value['unique_id']?>">
                                </form>
                            </div>
                         
                      </div><br>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-success get_role_id" name="update_roles" id="<?php echo $value['id']; ?>">Update</button>
                                  </form>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>

                              </div>

                            </div>
                          </div>
                          <div class="modal fade" id="archive<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Archive Role</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to archive this role?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                  <form method="post" id="archive_role_form<?php echo $value['id']; ?>">
                                    <button class="btn btn-danger archive_role" name="archive_role" id="<?php echo $value['id']; ?>">Archive</button>
                                    <input type="hidden" name="role_id" value="<?php echo $value['unique_id']?>">
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>

                      <?php } } } ?>

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