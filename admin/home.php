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


  $get_num_users = $object->get_number_of_rows('users_tbl');
  $get_num_packages = $object->get_number_of_rows('package_definition');
  $get_num_category = $object->get_number_of_rows('package_category');
  $get_num_investments = $object->get_number_of_rows('subscribed_packages');
  $get_num_pending_withdrawal = $object->get_number_of_rows('subscribed_user_tbl');
  $get_no_archived_role = $object->get_number_of_rows_one_param('admin_roles','status', 0);


  ///pending withdrawal
  $get_pending_withdrawals = $object->count_pending_withdrawn();
  $get_pending_withdrawals_decode = json_decode($get_pending_withdrawals,true);
  

  $total_pending_withdrawn = $object->total_pending_withdrawn();
  $total_pending_withdrawn_decode = json_decode($total_pending_withdrawn,true);



  //completed withdrawal
  $get_complete_withdrawals = $object->count_complete_withdrawn();
  $get_complete_withdrawals_decode = json_decode($get_complete_withdrawals,true);

  $total_completed_withdrawn = $object->total_completed_withdrawn();
  $total_completed_withdrawn_decode = json_decode($total_completed_withdrawn,true);

  $get_num_admin_role = $object->get_number_of_rows('admin_roles');
  $get_num_admin_user_role = $object->get_number_of_rows('admin_tbl');


include('includes/header.php'); ?>
<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Super Administrator'){
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
                <a href="view_users">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of Account Users</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_users; ?></span>
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
              </a>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="manage_roles">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of Roles </h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_admin_role;?></span>
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
                </a>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="account_users">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of Users of Roles</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_admin_user_role;?></span>
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
                </a>
              </div>
            </div>

          


          </div>

            <hr>
  

            <div class="row">
                <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="view_categories">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Investment Categories</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_category; ?></span>
                    </div>
                   <!--  <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div> -->
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <!-- <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span> -->
                    <!-- <span class="text-nowrap">Since yesterday</span> -->
                  </p>
                </div>
                </a>
              </div>
            </div>



              <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="view_packages">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Investment Packages</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_packages; ?></span>
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
                        <a href="manage_roles">
                        <div class="card-body">
                          <div class="row">
                            <div class="col">
                              <h5 class="card-title text-uppercase text-muted mb-0">Deleted Roles</h5>
                              <span class="h2 font-weight-bold mb-0"><?php echo $get_no_archived_role;?></span>
                            </div>
                            <!-- <div class="col-auto">
                              <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                <i class="fas fa-chart-bar"></i>
                              </div>
                            </div> -->
                          </div>
                          <p class="mt-3 mb-0 text-muted text-sm">
                             
                          </p>
                        </div>
                      </a>
                      </div>
                  </div>
            </div>
            <hr>
            <div class="row">
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

            <!-- <div class="row">
              

             <div class="col-xl-4 col-lg-6">
                      <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                          <div class="row">
                            <div class="col">
                              <h5 class="card-title text-uppercase text-muted mb-0">Referrals</h5>
                              <span class="h2 font-weight-bold mb-0">6</span>
                            </div>
                            <div class="col-auto">
                              <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                <i class="fas fa-chart-bar"></i>
                              </div>
                            </div>
                          </div>
                          <p class="mt-3 mb-0 text-muted text-sm">
                           <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                   -->          <!-- <span class="text-nowrap">Since last month</span>
                          </p>
                        </div>
                      </div>
                  </div>

            </div> -->



           

          


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