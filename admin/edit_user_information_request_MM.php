<?php include('includes/instantiated_files2.php');
include('includes/header.php');
 

// $table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_request = $object->get_rows_from_one_table_by_one_param('edit_sensitive_details_log','status', 1);

?>


<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name != 'Marketing Manager'){
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
              <h3 class="mb-0">This is a list Change of Details Request</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_request == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Investor's Fullname</th>
                        <th scope="col">Details</th>
                        <th scope="col">Status</th>

                  </tr>
                </thead>
                <tbody>
                  <?php

                   foreach($get_request as $value){

                    $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                    $get_assigned_BE = $object->get_one_row_from_one_table('leads','email',$get_user['email']);
                    $assigned_BE = $get_assigned_BE['assigned_to'];
                    $get_assigned_MM = $object->get_one_row_from_one_table('business_executive_tbl','unique_id', $assigned_BE);
                    if($get_assigned_MM['assigned_to'] == $uid){
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $get_user['surname'].' '.$get_user['other_names'];?></td>
                        <td>
                          <ul>
                            <li>
                              <strong>Old Email:</strong> <?php echo $get_user['email'];?>
                            </li>
                             <li>
                              <strong>New Email:</strong> <?php echo $value['new_email'] !=='' ? $value['new_email'] : 'Nil';?>
                            </li>
                            <li>
                              <strong>Old Phone Number:</strong><?php echo $get_user['phone'];?>
                            </li>
                            <li>
                              <strong>New Phone Number:</strong> <?php echo $value['new_phone'] !== '' ? $value['new_phone'] : 'Nil';?>
                            </li>
                          </ul>
                          
                          </td>
                        <td>
                          <small class="badge badge-sm badge-success">Approved</small>
                        </td>
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


         

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>