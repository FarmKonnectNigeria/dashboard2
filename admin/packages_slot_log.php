<?php 

session_start();
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

$get_rows = $object->get_rows_from_one_table('package_slot');
$get_package = $object->get_rows_from_one_table('package_tbl');

include('includes/header.php'); 

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
              <h3 class="mb-0">This is a log of slots added to a package <span><button type="button" class="btn btn-primary btn-sm float-right mb-3" data-toggle="modal" data-target="#add_slot_modal"><i class="fas fa-plus-circle"></i> Add Slot</button></span></h3> 
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Package name</th>
                        <th scope="col">Slot</th>
                        <th scope="col">Added By</th>
                        <th scope="col">Date Added</th>
                       <!-- <th>Action</th> -->
                   

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                       $getpackage = $object->get_one_row_from_one_table('package_tbl','unique_id',$value['package_id']);
                         $getuser = $object->get_one_row_from_one_table('admin_tbl','unique_id',$value['created_by']);

                     ?>
                     <tr>
                      
                       
                        <td><?php echo $getpackage['package_name'];?></td>
                        <td><?php echo $value['no_of_slots'];?></td>
                        <td><?php echo $getuser['surname'].' '.$getuser['other_names'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <!-- <td> <small class="btn btn-sm btn-success">View details</small> </td> -->

                      </tr>
                <?php } } ?>
                 
                 
                 
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


       <!-- Modal -->
            <div class="modal fade" id="add_slot_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Slot</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div> -->
                  <div class="modal-body">
                    <form  id="create_slot_form" method="post"> 
                        <!-- Default input -->
                        <h1 class="modal-title" id="exampleModalLabel">Add Slot</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button><br>

                        <div class="form-group">
                          <label for="formGroupExampleInput">Select Package</label>
                          <select class="form-control form-control-sm" id="package_id" name ="package_id">
                            <?php
                              if($get_package == null){
                              echo "error";
                            }else{
                              foreach ($get_package as $val) {
                              
                                        ?>
                              <option value="<?php echo $val['unique_id'];?>"><?php echo $val['package_name']; ?></option>
                               <?php
                                        }
                                    }
                                 ?>
                          </select>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-4">
                            <label for="formGroupExampleInput">Number of Slot</label>
                            <input type="number" class="form-control form-control-sm" id="no_of_slots" name="no_of_slots" value="1">
                          </div>
                        </div>
                     </form> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right btn-small" name="add_slot" id="add_slot">Add Slot</button>
                  </div>
                </div>
              </div>
            </div>

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>