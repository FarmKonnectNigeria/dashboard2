<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
require_once("../classes/algorithm_functions.php");

$get_rows = $object->get_rows_from_one_table('be_target');

?>


<body class="">
  <?php include('includes/sidebar.php'); 
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
              <h3 class="mb-0">This is the Sales Progress of your Business Executives</h3><br>
              <div><em><b>Average Overall Sales by all your Business Executives:</em> &#8358;<?php calculate_average_sales_progress($uid); ?></b></div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record available...</td></tr>";
                      } else{ ?>
                  <tr>
                    <th scope="col">Fullname</th>
                    <th scope="col">Target Set</th>
                    <th scope="col">Sales made</th>
                    <th scope="col">Balance</th>
                  </tr>
                </thead>
                <tbody>
                   <?php
                   foreach($get_rows as $value){
                    $get_be = $object->get_one_row_from_one_table('business_executive_tbl', 'unique_id', $value['BE_id']);
                    $get_be_details = $object->get_one_row_from_one_table('admin_tbl', 'unique_id', $value['BE_id']);
                    if($get_be['assigned_to'] == $uid){
                     ?>
                      <tr>
                        <td><?php echo $get_be_details['surname'].' '.$get_be_details['other_names'];?></td>
                        <td>&#8358;<?php echo number_format($value['target_set']);?></td>
                        <td>&#8358;<?php echo number_format($value['sales_made']);?></td>
                        <td>&#8358;<?php echo number_format($value['balance']);?></td>
                      </tr>
                <?php } } }?>
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


         

      <br>
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>