<?php 
include('includes/header.php'); 

  include('includes/instantiated_files2.php');
$get_rows = $object->get_rows_from_one_table_by_id('debit_account_log', 'admin_id', $uid);
//print_r($get_rows);

?>

<body class="">
  <?php include('includes/sidebar.php'); 
      if($role_name !=  'Cash Officer'){
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
              <h3 class="mb-0">This is a list of all Debit log</h3> 
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
                    <th scope="col">Amount</th>
                    <th scope="col">Remark</th>
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
                        <td><?php echo $get_user['surname'].' '.$get_user['other_names'];?></td>
                        <td><?php echo $get_user['email'];?></td>
                        <td>&#8358;<?php echo number_format($value['amount']);?></td>
                        <td><?php echo $value['remarks'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td>
                        <?php
                          if($value['status'] == 1){
                        ?> 
                        <small class="badge badge-success">Successful</small>
                      <?php } else if($value['status'] == 2){
                        ?>
                        <small class="badge badge-danger">Reversed</small>
                        <?php
                      }
                        ?>
                      </td>
                      <td>
                        <?php
                          if($value['status'] == 1){
                        ?>
                        <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reverse<?php echo $value['id']; ?>">Error Debit</small>
                      <?php }?>
                      </td>
                      </tr>

                 <div class="modal fade" id="reverse<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Error Debit</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to reverse this debit?
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-danger error_debit" name="error_debit" id="<?php echo $value['unique_id']; ?>">Yes</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                  <form method="post" id="error_debit_form<?php echo $value['unique_id'];?>">
                                    <input type="hidden" name="unique_id" id="unique_id" value="<?php echo $value['unique_id']; ?>" >
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $value['user_id']; ?>" >
                                    <input type="hidden" name="amount" id="amount" value="<?php echo $value['amount']; ?>" >
                                  </form>
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