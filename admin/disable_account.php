<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_rows = $object->get_rows_from_one_table('users_tbl');


////view function access
  // $found = 0;
  //     $user_role_function = $object->get_rows_from_table_by_user_id('function_role_rights','role_id','4');
  //     foreach ($user_role_function as $key => $value) {
  //           $each_function_slug = $object->get_one_row_from_one_table('site_functions','id',$value['function_id']);
  //           $each_function_slug = $each_function_slug['function_slug'];
        
  //           if($each_function_slug == 'view_investors'){
  //           $found++;
  //           }
  //     }

?>

<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Investment Manager'){
    echo '<meta http-equiv="refresh" content="0; URL=no_access" />';
  }
  ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
   <!--  <div class="header bg-gradient-default pb-8 pt-5 pt-md-8"  >
     
    </div> -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">This is a list of all FarmKonnect Users</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Fullname</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th>Status</th>
                       
                        <?php //if($found > 0){?>
                        
                        <th>Action</th>

                        <?php //} ?>

                   

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                     ?>
                     <tr>
                        <td><?php echo $value['surname'].' '.$value['other_names'];?></td>
                        <td><?php echo $value['phone'];?></td>
                        <td><?php echo $value['email'];?></td>
                        <td>
                          <?php
                            if($value['access_level'] == 1){
                              echo '<small class = "badge badge-success">Active</small>';
                            }else if($value['access_level'] == 0){
                              echo '<small class = "badge badge-danger">Disabled</small>';
                            }else{
                              echo '<small class = "badge badge-primary">Status Unknown</small>';
                            }
                          ?>
                        </td>
                       
                        <?php //if($found > 0){?>

                        <td> 
                          <?php
                          if($value['access_level'] == 1){
                         ?>
                          <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#disable<?php echo $value['id']; ?>">Disable Account</small> 
                        <?php } else if($value['access_level'] == 0){?>
                          <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#enable<?php echo $value['id']; ?>">Enable Account</small> 
                        <?php } ?>
                        </td>

                        <?php //} ?>
                        

                      </tr>
                     
                      <div class="modal fade bd-example-modal-md" id="disable<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Disable Account</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body"> 
                                  Are you sure you want to disable this account?
                                  </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger disable_account" id="<?php echo $value['unique_id'] ;?>">Disable</button>
                                  <form method="post" id="disable_account_form<?php echo $value['unique_id'];?>">
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
                                  <button type="button" class="btn btn-success enable_account" id="<?php echo $value['unique_id'] ;?>">Enable</button>
                                  <form method="post" id="enable_account_form<?php echo $value['unique_id'];?>">
                                    <input type="hidden" name="user_id" class="form-control" value="<?php echo $value['unique_id'];?>">
                                  </form>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                <?php } }?>
                 
                 
                 
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