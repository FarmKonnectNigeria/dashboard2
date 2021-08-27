<?php include('includes/instantiated_files.php');
include('includes/header.php'); 

$table = 'credit_wallet_tbl';
$param1 = 'user_id';
$get_rows = $object->get_rows_from_table_by_user_id($table,$param1,$uid);

?>


<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
   
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">This is a history of your wallet credit actions</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                   <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Transaction Description</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Payment Type</th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                      foreach($get_rows as $value){
                        if($value['payment_status'] == 1){
                          $payment_status = "successful"; }
                          else{
                          $payment_status = "failed"; }
                        
                      ?>
                     <tr>
                      
                        <td><?php echo '&#8358;'.number_format($value['amount']);?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td><?php echo $value['description'];?></td>
                        <td><?php echo $payment_status;?></td>
                        <td><?php echo $value['payment_type'];?></td>
                      </tr>
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
    <br>  
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>