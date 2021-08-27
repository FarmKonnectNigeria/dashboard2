<?php 
include('includes/header.php'); 

  include('includes/instantiated_files2.php');


$get_rows = $object->get_rows_from_one_table_by_one_param('client_payment_log','payment_status', 2);
$get_online_payments = $object->get_rows_from_one_table('online_payments');
//print_r($get_rows);

?>

<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name != 'Accountant'){
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
              <h3 class="mb-0">This is a list of all Confirmed Payments</h3> 
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null && $get_online_payments == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Client's Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                    $get_client = $object->get_one_row_from_one_table('leads','unique_id',$value['client_id']);
                     ?>
                     <tr>
                        <td><?php echo $get_client['fullname'];?></td>
                        <td><?php echo $get_client['email'];?></td>
                        <td><?php echo $get_client['phone'];?></td>
                        <td><?php echo $value['amount'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td>
                        <small class="badge badge-success">Confirmed</small>
                      </td>
                      </tr>
                      <?php
                      foreach ($get_online_payments as $val) {
                          $get_client = $object->get_one_row_from_one_table('users_tbl','unique_id',$val['depositor_id']);
                        ?>
                      <tr>
                        <td><?php echo $get_client['surname'].' '.$get_client['other_names'];?></td>
                        <td><?php echo $get_client['email'];?></td>
                        <td><?php echo $get_client['phone'];?></td>
                        <td><?php echo $val['amount'];?></td>
                        <td><?php echo $val['date_created'];?></td>
                        <td>
                        <small class="badge badge-success">Confirmed</small>
                      </td>
                      </tr>
                      <?php }  } } ?>

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