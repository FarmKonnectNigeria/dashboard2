<?php 
include('includes/header.php'); 

  include('includes/instantiated_files2.php');
$get_rows = $object->get_rows_from_one_table('client_payment_log');
//print_r($get_rows);

?>

<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Business Executive'){
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
              <h3 class="mb-0">This is a list of all the Payment Confirmation Request</h3> 
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Client</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Package Category</th>
                        <th scope="col">Package</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date Submitted</th>
                        <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                    $get_client = $object->get_one_row_from_one_table('leads','unique_id',$value['client_id']);
                    $get_package = $object->get_one_row_from_one_table('package_tbl','unique_id',$value['package_id']);
                    $get_package_category = $object->get_one_row_from_one_table('package_category','unique_id',$value['package_category_id']);
                     ?>
                     <tr>
                        <td><?php echo $get_client['fullname'];?></td>
                        <td><?php echo $get_client['email'];?></td>
                        <td><?php echo $get_package_category['name'];?></td>
                        <td><?php echo $get_package['package_name'];?></td>
                        <td><?php echo $value['quantity'];?></td>
                        <td><?php echo $value['amount'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td>
                        <?php
                          if($value['payment_status'] == 1){
                        ?> 
                        <small class="badge badge-primary">Pending</small>
                      <?php } else if($value['payment_status'] == 2){
                        ?>
                        <small class="badge badge-success">Confirmed</small>
                        <?php
                      }else if($value['payment_status'] == 3){
                        ?>
                        <small class="badge badge-danger">Not Received</small>
                        <?php
                      }
                        ?>
                      </td>
                      </tr>
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