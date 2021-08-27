<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_withdrawal = $object->get_withdrawal_requests();

?>


<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name != 'CRM'){
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
              <h3 class="mb-0">This is a list of all Withdrawals</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush ">
                <thead class="thead-light">
                 <?php if($get_withdrawal == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Fullname</th>
                        
                        <th scope="col">Email Address</th>
                        <th scope="col">Amount Requested</th>
                        <th scope="col">Withdrawal Type</th>
                        <th scope="col">Date Requested</th>
                        <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                   <?php
                   $count = 1;
                   foreach($get_withdrawal as $value){
                    $getuser = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']); 
                     ?>
                     <tr>
                        <td><?php echo $count;?></td>
                        <td><?php echo $getuser['surname'].' '.$getuser['other_names'].'---'.$value['id'];?></td>
                        <td><?php echo $getuser['email'];?></td>
                        <td> &#8358; <?php echo number_format($value['amount_withdrawn']);?></td>
                        <td><?php echo "<span class='badge badge-success'>wallet</span>";?>
                        </td>
                        <td><?php echo $value['date_created'];?></td>
                        <td>
                        <?php
                            if($value['withdrawal_status'] == 2 ){
                        ?>
                          <small class="badge badge-success">Approved by SA</small>
                        <?php } else if($value['withdrawal_status'] == 1){
                          ?>
                          <small class="badge badge-primary">Pending</small>
                          <?php
                        }else if($value['withdrawal_status'] == 4){
                          ?>
                          <small class="badge badge-success">Approved by Accountant</small>
                          <?php
                        }else if($value['withdrawal_status'] == 3){
                          ?>
                          <small class="badge badge-danger">Rejected by SA</small>
                          <?php
                        }else if($value['withdrawal_status'] == 5){
                          ?>
                          <small class="badge badge-danger">Rejected by Accountant</small>
                          <?php
                        }else if($value['withdrawal_status'] == 6){
                          ?>
                          <small class="badge badge-success">Processed</small>
                          <?php
                        }
                          ?>
                        </td>
                      </tr>
                <?php $count++;} } ?>
                 
                 
                 
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
