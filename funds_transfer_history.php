<?php include('includes/instantiated_files.php');
include('includes/header.php'); 

$table = 'transfer_log';
$get_rows = $object->get_rows_from_one_table($table);

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
              <h3 class="mb-0">This is a history of your funds transfer</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                   <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                        <th scope="col">Sender</th>
                        <th scope="col">Beneficiary</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Transfer Status</th>
                        <th scope="col">Date Transfered</th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                      foreach($get_rows as $value){
                        if($value['sender_id'] == $uid || $value['beneficiary_id'] == $uid){
                          $get_sender = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['sender_id']);
                          $get_beneficiary = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['beneficiary_id']);
                      ?>
                     <tr>
                        <td><?php if($value['sender_id'] == $uid){
                          echo "You";
                        }else{
                          echo $get_sender['surname'].' '.$get_sender['other_names'];
                        }
                        
                        ?>
                        </td>
                        <td><?php if($value['beneficiary_id'] == $uid){
                          echo "You";
                        }else{
                          echo $get_beneficiary['surname'].' '.$get_beneficiary['other_names'];
                        }
                        ?>
                        </td>
                        <td><?php echo '&#8358;'.number_format($value['amount_sent']);?></td>
                         <td><?php if($value['transfer_status'] == 0){
                          echo "<span class='badge badge-primary'>Pending</span>";
                        }else if($value['transfer_status'] == 1){
                          echo "<span class='badge badge-success'>Approved</span>";
                        }else if($value['transfer_status'] == 2){
                          echo "<span class='badge badge-danger'>Rejected</span>";
                        }
                        ?>
                        </td>
                        <td><?php echo $value['date_created']?></td>
                      </tr>
                <?php } } }?>
                 
                 
                 
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