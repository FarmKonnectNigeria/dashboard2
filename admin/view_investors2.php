<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$get_rows = $object->get_rows_from_one_table_group_by('subscribed_packages','user_id');

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
    if($role_name !=  'Super Administrator'){
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
              <h3 class="mb-0">This is a list of all investors  </h3>
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
                         $getuser = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $getuser['surname'];?></td>
                        <td><?php echo $getuser['other_names'];?></td>
                        <td><?php echo $getuser['phone'];?></td>
                        <td><?php echo $getuser['email'];?></td>
                       
                        <?php //if($found > 0){?>
                       
                        <td> <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#view<?php echo $value['id']; ?>">View details</small> </td>

                        <?php //} ?>
                        

                      </tr>
                      <div class="modal fade bd-example-modal-md" id="view<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Investment Details</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div><strong>Home Address:</strong> <?php
                                    if($getuser['home_address'] == null || $getuser['home_address'] == "Please update"){
                                      echo "Nil";
                                    }else echo $getuser['home_address'];
                                    ?>
                                  </div><br>
                                  <div><strong>Social Media Handle:</strong> <?php
                                    if($getuser['social_media_handle'] == null || $getuser['social_media_handle'] == "Please update"){
                                      echo "Nil";
                                    }else echo $getuser['social_media_handle'];
                                    ?>
                                  </div><br>
                                  <div><strong>Next of Kin Surname:</strong> <?php
                                    if($getuser['nok_surname'] == null || $getuser['nok_surname'] == "Please update"){
                                      echo "Nil";
                                    }else echo $getuser['nok_surname'];
                                    ?>
                                  </div><br>
                                  <div><strong>Next of Kin Othername:</strong> <?php
                                    if($getuser['nok_name'] == null || $getuser['nok_name'] == "Please update"){
                                      echo "Nil";
                                    }else echo $getuser['nok_name'];
                                    ?>
                                  </div><br>
                                  <div><strong>Next of Kin Phone Number:</strong> <?php
                                    if($getuser['nok_phone'] == null || $getuser['nok_phone'] == "Please update"){
                                      echo "Nil";
                                    }else echo $getuser['nok_phone'];
                                    ?>
                                  </div><br>
                                  <div><strong>Contact Address:</strong> <?php
                                    if($getuser['contact_address'] == null || $getuser['contact_address'] == "Please update"){
                                      echo "Nil";
                                    }else echo $getuser['contact_address'];
                                    ?>
                                  </div><br>
                                  <div><strong>Relationship:</strong> <?php
                                    if($getuser['relationship'] == null || $getuser['relationship'] == "Please update"){
                                      echo "Nil";
                                    }else echo $getuser['relationship'];
                                    ?>
                                  </div><br>
                                  <div><strong>Bank Name:</strong> <?php
                                    if($getuser['bank_name'] == null || $getuser['bank_name'] == "Please update"){
                                      echo "Nil";
                                    }else echo $getuser['bank_name'];
                                    ?>
                                  </div><br>
                                  <div><strong>Account Name:</strong> <?php
                                    if($getuser['account_name'] == null || $getuser['account_name'] == "Please update"){
                                      echo "Nil";
                                    }else echo $getuser['account_name'];
                                    ?>
                                  </div><br>
                                  <div><strong>Account Number:</strong> <?php
                                    if($getuser['account_number'] == null || $getuser['account_number'] == "Please update"){
                                      echo "Nil";
                                    }else echo $getuser['account_number'];
                                    ?>
                                  </div><br>
                                  <div><strong>Account Type:</strong> <?php
                                    if($getuser['account_type'] == null || $getuser['account_type'] == "Please update"){
                                      echo "Nil";
                                    }else echo $getuser['account_type'];
                                    ?>
                                  </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
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


         

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>