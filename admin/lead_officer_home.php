<?php session_start();
      require_once('../classes/db_class.php');
      if(!isset($_SESSION['adminid'])){
        header('location: login');
      } 

       ///id seession
   $uid = $_SESSION['adminid'];
   //class object
   $object = new DbQueries();

   $current_admin_details = $object->get_current_user_info('admin_tbl',$uid);
   $surname = $current_admin_details['surname'];
   $other_names = $current_admin_details['other_names'];
   $fullname_user = $surname.' '.$other_names;
   $get_role_name = $object->get_one_row_from_one_table('admin_roles','unique_id', $current_admin_details['role_right']);
   $role_name = $get_role_name['role_name'];

   $get_num_leads = $object->get_number_of_rows_one_param('leads','classification','lead');
   $get_num_clients = $object->get_number_of_rows_one_param('leads','classification','client');
   $get_num_prospect = $object->get_number_of_rows_one_param('leads','classification','prospect');
   $get_num_archived_leads = $object->get_number_of_rows_one_param('leads','status',0);
  // $get_num_users = $object->get_number_of_rows('users_tbl');
  // $get_num_package_categories = $object->get_number_of_rows('package_category');
  // $get_num_packages = $object->get_number_of_rows('package_tbl');
  // $get_num_investments = $object->get_number_of_rows('subscribed_user_tbl');
  // $get_num_pending_withdrawal = $object->get_number_of_rows('subscribed_user_tbl');


include('includes/header.php'); ?>
<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Lead Officer'){
    echo '<meta http-equiv="refresh" content="0; URL=no_access" />';
  }
  ?>
  <div class="main-content">
    <!-- Navbar -->
     <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Leads</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_leads?></span>
                    </div>
                    <!-- <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div> -->
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                    <!-- <span class="text-nowrap">Since last month</span> -->
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Lead - Prospects</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_prospect?></span>
                    </div>
                    <!-- <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div> -->
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                    <!-- <span class="text-nowrap">Since last month</span> -->
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Lead - Client</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_clients?></span>
                    </div>
                    <!-- <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div> -->
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                    <!-- <span class="text-nowrap">Since last month</span> -->
                  </p>
                </div>
              </div>
            </div>
          </div><br>

            <div class="row">
              <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Archived Leads</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $get_num_archived_leads;?></span>
                      </div>
                   <!--    <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="fas fa-chart-pie"></i>
                        </div>
                      </div> -->
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span> -->
                      <!-- <span class="text-nowrap">Since last week</span> -->
                    </p>
                  </div>
                </div>
              </div>
            </div>

            </div>
            <hr>


        </div>

      </div>
       <?php include('includes/footer.php'); ?>

    </div>

    <div class="container-fluid mt--7">
     
      
      <!-- Footer -->
     
    </div>

  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>