<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$get_rows = $object->get_rows_from_one_table_group_by('users_tbl','unique_id');


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
              <h3 class="mb-0">This is a list of all investors  </h3>
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
                        <th>Number of Investment</th>
                        <th>Total value of Investment</th>
                       
                        <?php //if($found > 0){?>
                        
                        <th>Action</th>

                        <?php //} ?>

                   

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                         //$getuser = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['un']);
                         $get_subscribers = $object->get_rows_from_one_table_by_one_param('users_tbl','investment_status',1);
                        $get_rows = $object->get_rows_from_one_table('subscribed_packages');
                        $get_num_investment = $object->get_number_of_rows_one_param('subscribed_packages','user_id',$value['unique_id']);
                        $get_total_investment = $object->total_investment_with_user_id('subscribed_packages', 'total_amount', 'user_id', $value['unique_id']);
                        $get_total_investment_decode = json_decode($get_total_investment, true);
                        // $get_investment = $object->get_one_row_from_one_table('subscribed_packages','user_id',$value['unique_id']);
                        // $get_package = $object->get_one_row_from_one_table('package_definition','unique_id',$get_investment['package_id']);
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $value['surname'].' '.$value['other_names'];?></td>
                        <td><?php echo $value['phone'];?></td>
                        <td><?php echo $value['email'];?></td>
                        <td>
                          <?php 
                          if($get_num_investment == 0){
                            echo "No investment";
                          }else{
                            echo $get_num_investment;
                          }
                          ?>
                        </td>
                        <td>&#8358;
                          <?php 
                          if($get_num_investment == 0){
                            echo 0;
                          }else{
                             
                            echo number_format($get_total_investment_decode['msg']);
                          }
                          ?>
                          </td>
                       
                        <?php //if($found > 0){?>
                       
                        <td> <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#view<?php echo $value['id']; ?>">View Personal details</small> 
                           <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#investment_details<?php echo $value['id']; ?>">View Investment details</small>
                        </td>

                        <?php //} ?>
                        

                      </tr>
                      <div class="modal fade bd-example-modal-md" id="view<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Personal Details</h5>
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
                                  </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                           <div class="modal fade bd-example-modal-lg" id="investment_details<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Investment Details</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                               <div class="modal-body">
                                <?php
                                $get_investment = $object->get_rows_from_one_table_by_one_param('subscribed_packages','user_id',$value['unique_id']);
                                  if($get_investment !== null){
                                ?>
                                  <div class="row" style="background-color: #ddd; padding: 11px;">
                                    <div class="col-md-1" style="font-weight: bold; font-size: 11px;">
                                      S/N
                                    </div>
                                    <div class="col-md-3" style="font-weight: bold; font-size: 11px;">
                                      PACKAGE NAME
                                    </div>
                                    <div class="col-md-2" style="font-weight: bold; font-size: 11px;">
                                      SLOT
                                    </div>
                                    <div class="col-md-2" style="font-weight: bold; font-size: 11px;">
                                      DURATION
                                    </div>
                                    <div class="col-md-2" style="font-weight: bold; font-size: 11px;">
                                      AMOUNT PAID
                                    </div>
                                    <div class="col-md-2" style="font-weight: bold; font-size: 11px;">
                                      LIQUIDATION STATUS
                                    </div>
                                  </div><br>
                                  <div class="row">
                                    <?php
                                      $count = 1;
                                        foreach ($get_investment as $investment_details) {
                                        $getpackage = $object->get_one_row_from_one_table('package_definition','unique_id',$investment_details['package_id']);
                                        ?>
                                        <?php 
                                        echo '<hr>';
                                        echo '<div class="col-md-1" style="font-size: 14px;">'.$count.'</div>';
                                        echo '<div class="col-md-3" style="font-size: 14px;">'.$getpackage['package_name'].'</div>';
                                         echo '<div class="col-md-2" style="font-size: 14px;">'.$investment_details['no_of_slots_bought'].' slot (s)</div>';
                                         echo '<div class="col-md-2" style="font-size: 14px;">'.$investment_details['tenure_of_product'].' day(s)</div>';
                                         echo '<div class="col-md-2" style="font-size: 14px;">&#8358;'.number_format($investment_details['total_amount']).'</div>';
                                         if($investment_details['liquidation_status'] == 0){
                                          echo '<div class="col-md-2" style="font-size: 13px; color: green;">Not Liquidated</div>';
                                         }else{
                                         echo'<div class="col-md-2" style="font-size: 13px; color: red;">Liquidated</div>';
                                       }
                                       $count++;}
                                       ?>
                                       </div>
                                       <?php
                                     }else{
                                      echo "<h3>No Investment yet</h3>";
                                     }
                                         ?>
                                     
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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