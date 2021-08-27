<?php 
include('includes/header.php'); 

  include('includes/instantiated_files2.php');
$get_rows = $object->get_rows_from_one_table_by_id('be_sales','sales_status', 1);
// foreach ($get_rows as $value) {
 
// }
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
              <h3 class="mb-0">This is a list of Sales made by Business Executives</h3>
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Full Name</th>
                        <th scope="col">Transaction</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Product</th>
                        <th scope="col">Sales Date</th>
                        <th>Status</th>
                        <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                    
                    $get_be = $object->get_one_row_from_one_table('business_executive_tbl','unique_id', $value['added_by']);
                    $get_be_name = $object->get_one_row_from_one_table('admin_tbl','unique_id', $value['added_by']);
                     ?>
                     <tr>
                        <td><?php echo $get_be_name['surname'].' '.$get_be_name['other_names'];?></td>
                        <td><?php echo $value['transaction'];?></td>
                        <td>&#8358;<?php echo number_format($value['amount']);?></td>
                        <td><?php echo $value['product'];?></td>
                        <td><?php echo $value['sales_date'];?></td>
                        <td>
                        <?php
                          if($value['sales_status'] == 1){
                        ?> 
                        <small class="badge badge-primary">Pending</small>
                      <?php } 
                        ?>
                      </td>
                      <td>
                        <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Approve</button>
                      </td>
                      </tr>

                      <div class="modal fade bd-example-modal-md" id="approve<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Approve Sale</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to approve this Sale?
                                      <form method="post" id="sales_claim_form<?php echo $value['unique_id']; ?>">
                                        <input type="hidden" name="unique_id" value="<?php echo $value['unique_id']; ?>" id="unique_id">
                                        <input type="hidden" name="BE_id" value="<?php echo $value['added_by']; ?>" id="BE_id">
                                        <input type="hidden" name="amount" value="<?php echo $value['amount']; ?>" id="amount">
                                      </form>
                                    </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success sales_claim" id="<?php echo $value['unique_id']; ?>">Approve</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                          </div>
                        </div>
                      <?php   } }?>

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