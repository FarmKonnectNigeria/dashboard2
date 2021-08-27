<?php 
include('includes/instantiated_files2.php');
include('includes/header.php'); 

  
$get_rows = $object->get_rows_from_one_table_by_id('credit_user_wallet_log', 'admin_id', $uid);
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
              <h3 class="mb-0">This is your Credit Users' Wallet Log</h3> 
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Name of Client</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th>Status</th>
                        <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                    $get_client = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                    // $get_package = $object->get_one_row_from_one_table('package_tbl','unique_id',$value['package_id']);
                    // $get_package_category = $object->get_one_row_from_one_table('package_category','unique_id',$value['package_category_id']);
                     ?>
                     <tr>
                        <td><?php echo $get_client['surname'].' '.$get_client['other_names'];?></td>
                        <td><?php echo $get_client['email'];?></td>
                        <td><?php echo $get_client['phone'];?></td>
                        <td>&#8358;<?php echo number_format($value['amount'], 2);?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td>
                        <?php
                        if($value['status'] == 1){
                        ?>
                        <small class="badge badge-success">Successful</small>
                      <?php }else if($value['status'] == 2){?>
                        <small class="badge badge-danger">Reversed</small>
                        <?php }?>
                      </td>
                      
                      <td>
                          <?php
                        if($value['status'] == 1){
                      ?>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#error<?php echo $value['id']; ?>">Mark as Error</button>
                    </td>
                      </tr>
                      <div class="modal fade bd-example-modal-md" id="error<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Mark as Error</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to mark this  credit as error? The payment will be reversed
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-success error_credit" name="error_credit" id="<?php echo $value['unique_id']; ?>">Yes</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="error_credit_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                    <input type="hidden" class="form-control" id="amount" name="amount" value="<?php echo $value['amount']?>">
                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $value['user_id']?>">
                                </form>
                            </div>
                          </div>
                        </div>
                      <?php }  } }?>

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