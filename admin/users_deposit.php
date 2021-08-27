<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

// $table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_rows = $object->get_rows_from_one_table('bank_transfer_tbl');

?>


<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name !=  'CRM'){
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
              <h3 class="mb-0">This is the List of Bank Deposits of users</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                    <th scope="col">Amount Paid</th>                        
                    <th scope="col">Bank Name</th>
                    <th scope="col">Account Number</th>
                    <th scope="col">Account Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Payment Proof</th>
                    <th scope="col">Date Uploaded</th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                    $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                         
                     ?>
                     <tr>
                    <td>&#8358;<?php echo $value['amount']?></td>
                    <td><?php echo $value['bank_name']?></td>
                    <td><?php echo $value['account_number']?></td>
                    <td><?php echo $value['account_name']?></td>
                    <td><?php echo $value['description']?></td>
                    <td><a href="<?php echo '../'.$value['payment_proof']?>" class="thumbnail fancybox" rel="ligthbox"><?php echo "Payment proof<small>(click to view)</small>"?></a></td>
                     <td><?php echo $value['date_created']?></td>
                      </tr>
                <?php } } ?>
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


         

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
  </script>