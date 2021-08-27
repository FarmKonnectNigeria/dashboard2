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

   $get_num_complaints = $object->get_number_of_rows('contact_us_tbl');
   $get_num_feedback = $object->get_number_of_rows('feedback_tbl');
  // $get_num_users = $object->get_number_of_rows('users_tbl');
  // $get_num_package_categories = $object->get_number_of_rows('package_category');
  // $get_num_packages = $object->get_number_of_rows('package_tbl');
  // $get_num_investments = $object->get_number_of_rows('subscribed_user_tbl');
   $get_pending_withdrawals = $object->count_pending_withdrawn();
  $get_pending_withdrawals_decode = json_decode($get_pending_withdrawals,true);

  $total_pending_withdrawn = $object->total_pending_withdrawn();
  $total_pending_withdrawn_decode = json_decode($total_pending_withdrawn,true);


include('includes/header.php'); ?>
<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name !=  'Feedback Officer'){
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
                <a href="view_complaints">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Complaints</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_complaints?></span>
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
              </a>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="view_feedback">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Feedback</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_feedback; ?></span>
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
              </a>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                      <div class="card card-stats mb-4 mb-xl-0">
                        <a href="withdrawal_request">
                        <div class="card-body">
                          <div class="row">
                            <div class="col">
                              <h5 class="card-title text-uppercase text-muted mb-0">Pending Withdrawals<strong>(<?php echo $get_pending_withdrawals_decode['msg']; ?>)</strong></h5>
                              <span class="h2 font-weight-bold mb-0"> &#8358;<?php echo number_format($total_pending_withdrawn_decode['msg']); ?></span>
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
                        </a>
                      </div>
                  </div>

          </div>

            <hr>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
     
      
      <!-- Footer -->
      <?php include('includes/footer.php'); ?>

    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>