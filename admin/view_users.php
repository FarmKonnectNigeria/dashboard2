<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$get_rows = $object->get_rows_from_one_table_by_one_param('users_tbl','access_level',1);


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
              <h3 class="mb-0">This is a list of all active users</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">First name</th>
                        
                        <th scope="col">Last name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <?php //if($found > 0){?>
                           <th>Action</th>
                        <?php //} ?>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                    $get_no_document = $object->get_number_of_rows_one_param('document_tbl','user_id',$value['unique_id']);   
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $value['surname'];?></td>
                        <td><?php echo $value['other_names'];?></td>
                        <td><?php echo $value['phone'];?></td>
                        <td><?php echo $value['email'];?></td>


                        <?php //if($found > 0){
                          
                          ?>

                        <td> 
                          <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#view<?php echo $value['id']; ?>">View detail</small>
                          <?php
                            if($value['verification_status'] == 0){
                          ?> 
                          <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#verify_user<?php echo $value['id']; ?>">Verify User</small>
                          <?php } else if($value['verification_status'] == 1){?>
                          <small class="badge badge-success">Verified</small> 
                        <?php } ?>
                        </td>
                        <?php //} ?>

                        <div class="modal fade bd-example-modal-md" id="view<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">User's Details</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div><strong>Home Address:</strong> <?php
                                    if($value['home_address'] == null || $value['home_address'] == "Please update"){
                                      echo "Nil";
                                    }else echo $value['home_address'];
                                    ?>
                                  </div><br>
                                  <div><strong>Social Media Handle:</strong> <?php
                                    if($value['social_media_handle'] == null || $value['social_media_handle'] == "Please update"){
                                      echo "Nil";
                                    }else echo $value['social_media_handle'];
                                    ?>
                                  </div><br>
                                  <div><strong>Next of Kin Surname:</strong> <?php
                                    if($value['nok_surname'] == null || $value['nok_surname'] == "Please update"){
                                      echo "Nil";
                                    }else echo $value['nok_surname'];
                                    ?>
                                  </div><br>
                                  <div><strong>Next of Kin Othername:</strong> <?php
                                    if($value['nok_name'] == null || $value['nok_name'] == "Please update"){
                                      echo "Nil";
                                    }else echo $value['nok_name'];
                                    ?>
                                  </div><br>
                                  <div><strong>Next of Kin Phone Number:</strong> <?php
                                    if($value['nok_phone'] == null || $value['nok_phone'] == "Please update"){
                                      echo "Nil";
                                    }else echo $value['nok_phone'];
                                    ?>
                                  </div><br>
                                  <div><strong>Contact Address:</strong> <?php
                                    if($value['contact_address'] == null || $value['contact_address'] == "Please update"){
                                      echo "Nil";
                                    }else echo $value['contact_address'];
                                    ?>
                                  </div><br>
                                  <div><strong>Relationship:</strong> <?php
                                    if($value['relationship'] == null || $value['relationship'] == "Please update"){
                                      echo "Nil";
                                    }else echo $value['relationship'];
                                    ?>
                                  </div><br>
                                  <div><strong>Bank Name:</strong> <?php
                                    if($value['bank_name'] == null || $value['bank_name'] == "Please update"){
                                      echo "Nil";
                                    }else echo $value['bank_name'];
                                    ?>
                                  </div><br>
                                  <div><strong>Account Name:</strong> <?php
                                    if($value['account_name'] == null || $value['account_name'] == "Please update"){
                                      echo "Nil";
                                    }else echo $value['account_name'];
                                    ?>
                                  </div><br>
                                  <div><strong>Account Number:</strong> <?php
                                    if($value['account_number'] == null || $value['account_number'] == "Please update"){
                                      echo "Nil";
                                    }else echo $value['account_number'];
                                    ?>
                                  </div><br>
                                  <div><strong>Account Type:</strong> <?php
                                    if($value['account_type'] == null || $value['account_type'] == "Please update"){
                                      echo "Nil";
                                    }else echo $value['account_type'];
                                    ?>
                                  </div><br>
                                  <div><strong>Number of submitted documents:</strong> <?php
                                    echo $get_no_document;
                                    ?>
                                  </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
  
                          <div class="modal fade bd-example-modal-md" id="verify_user<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">User's Details</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to verify this user?
                                </div>
                                <div class="modal-footer">
                                   <button type="button" class="btn btn-success verify_user" name="verify_user" id="<?php echo $value['unique_id']; ?>">Verify</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="verify_user_form<?php echo $value['unique_id']; ?>">
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