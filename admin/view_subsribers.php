<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$package_id = $_GET['packid'];
$get_package = $object->get_one_row_from_one_table('package_definition', 'unique_id', $package_id);
$get_rows = $object->get_rows_from_one_table_by_one_param('subscribed_packages','package_id',$package_id);

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
    if($role_name !=  'Super Administrator' && $role_name !=  'Investment Manager'){
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
              <h3 class="mb-0">This is a list of all investments under <?php echo $get_package['package_name']; ?> </h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    <th scope="col">Fullname</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Slots Purchased</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Investment Status</th>
                    <th scope="col">Date Subscribed</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                      $getuser = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                     ?>
                     <tr>
                        <td><?php echo $getuser['surname'].' '.$getuser['other_names'];?></td>
                        <td><?php echo $getuser['email'];?></td>
                        <td><?php echo $value['no_of_slots_bought'].' slot (s)';?></td>
                        <td>&#8358;<?php echo number_format($value['total_amount']);?></td>
                        <td>
                          <?php 
                          if($value['liquidation_status'] == 0){
                         echo '<div class="badge bage-sm badge-success">Not Liquidated</div>';
                        }else if($value['liquidation_status'] == 1){
                          echo '<div class="badge bage-sm badge-danger">Liquidated</div>';
                        }
                          ?>
                          </td>
                        <td><?php echo $value['date_created'];?></td>
                        <td>
                          <?php 
                          //f($value['liquidation_status'] == 0){?>
                          <!--<small class="btn btn-sm btn-success" data-toggle="modal" data-target="#undo<?php //echo $value['id']; ?>">Undo Package Subscription</small>-->
                        <?php //}?>
                        </td>
                      </tr>
                      <div class="modal fade bd-example-modal-md" id="undo<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Undo Package Subscription</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to proceed?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-success undo_package_sub" id="<?php echo $value['unique_id'] ;?>">Yes</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="undo_package_sub_form<?php echo $value['unique_id'] ;?>">
                                <input type="hidden" name="total_amount" value="<?php echo $value['total_amount'] ;?>">
                                <input type="hidden" name="no_of_slots_bought" value="<?php echo $value['no_of_slots_bought'] ;?>">
                                <input type="hidden" name="investment_id" value="<?php echo $value['unique_id'] ;?>">
                                <input type="hidden" name="user_id" value="<?php echo $value['user_id'] ;?>">
                                <input type="hidden" name="package_id" value="<?php echo $package_id;?>">
                              </form>
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