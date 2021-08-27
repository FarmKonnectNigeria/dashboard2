<?php session_start();
      require_once('../classes/db_class.php');
      if(!isset($_SESSION['affiliate_id'])){
        header('location: login');
      } 

       ///id seession
   $uid = $_SESSION['affiliate_id'];
   //class object
   $object = new DbQueries();

   $current_affiliate_details = $object->get_current_aff_info('affilliate_tbl',$uid);
   $surname = $current_affiliate_details['surname'];
   $other_names = $current_affiliate_details['other_names'];
   $fullname_user = $surname.' '.$other_names;

    $affilliate_id = $current_affiliate_details['affilliate_level'];

   $affiliate_level = $object->get_one_row_from_one_table('affilliate_type','unique_id',$affilliate_id);
   $get_affiliate_level = $affiliate_level['affiliate_name'];


  $get_num_users = $object->get_number_of_rows('users_tbl');
  $get_num_packages = $object->get_number_of_rows('package_tbl');
  $get_num_investments = $object->get_number_of_rows('subscribed_user_tbl');


include('includes/header.php'); ?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
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
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Prospects</h5>
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
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Referrals</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_investments; ?></span>
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
              </div>
            </div>

          </div>

          <br>

            <div class="row">
                     <div class="col-xl-4 col-lg-6">
                      <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                          <div class="row">
                            <div class="col">
                              <h5 class="card-title text-uppercase text-muted mb-0">Total Bonus</h5>
                              <span class="h2 font-weight-bold mb-0">&#8358;56,000</span>
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

            </div>

          


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