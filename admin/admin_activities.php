<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

?>


<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name !=  'Super Administrator' && $role_name !=  'Feedback Officer' && $role_name != 'CRM'){
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
              <h3 class="mb-0">This Page lists the logs of all Admin Users</h3>
            </div>
            <div class="table-responsive">
              <!--<table id="admin_logs" class="table align-items-center table-flush">-->
                  <table class="table table-bordered example" id="admin_logs" width="100%" cellspacing="0">
                  <thead>
                    <!--<th>ID</th>-->
                    <th>Action Done By</th>
                    <th>Description</th>
                    <th>Date Created</th>
                  </thead>
                  <tfoot>           
                    <!--<th>ID</th>-->
                    <th>Fullname</th>
                    <th>Description</th>
                    <th>Date Created</th>
                  </tfoot>
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