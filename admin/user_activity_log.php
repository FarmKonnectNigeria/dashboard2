<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_rows = $object->get_rows_from_one_table('users_logs_tbl');


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
              <h3 class="mb-0">This is the activity log of Investors</h3>
            </div>
            <div class="table-responsive">
              <!-- <table class="table align-items-center table-flush"> -->
                <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                    <th scope="col">S/N</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Location</th>
                    <th scope="col">Activity Done</th>
                    <th scope="col">Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 1;
                  foreach($get_rows as $value){
                    $get_user_info = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                    // $get_admin_role = $object->get_one_row_from_one_table('admin_roles','unique_id',$get_user_info['role_right']);
                    ?>
                     <tr>
                        <td><?php echo $count;?></td>
                        <td><?php echo $get_user_info['surname'].' '.$get_user_info['other_names'];?></td>
                        <td><?php echo $get_user_info['email'];?></td>
                        <td><?php echo $get_user_info['home_address'];?></td>
                        <td><?php echo $value['description'];?></td>
                        <td><?php echo $object->formatted_date($value['date_created']); ?></td>
                      </tr>
                <?php $count++; } } ?> 
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
  $(document).ready(function () {
$('#datatable-basic').DataTable();
//$('.dataTables_length').addClass('bs-select');
});
</script>