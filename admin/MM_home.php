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


  @$get_num_BE = $object->get_number_of_rows_one_param('business_executive_tbl','assigned_to',$uid);
  @$get_num_leads = $object->get_number_of_rows_one_param('leads','classification','lead');
  @$get_num_prospects = $object->get_number_of_rows_one_param('users_tbl','investment_status',0);
  @$get_num_clients = $object->get_number_of_rows_one_param('users_tbl','investment_status',1);

  @$get_num_sales_approval = $object->get_number_of_rows_one_param('be_sales','sales_status',0);
  @$get_num_client_transfer_approval = $object->get_number_of_rows_one_param('transfer_client_log','time_frame','permanent');



include('includes/header.php'); ?>
<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name !=  'Marketing Manager'){
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
                  <a href="my_be">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of your Business Executives</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_BE; ?></span>
                    </div>
                    <!-- <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div> -->
                  </div>
                  </a>
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
                  <a href="lead_pool_MM">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of Leads</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_leads; ?></span>
                    </div>
                 <!--    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div> -->
                  </div>
                  </a>
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
                  <a href="prospect_list">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of Prospects</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo number_format($get_num_prospects); ?></span>
                    </div>
                   <!--  <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div> -->
                  </div>
                  </a>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <!-- <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span> -->
                    <!-- <span class="text-nowrap">Since yesterday</span> -->
                  </p>
                </div>
              </div>
            </div>



          </div>

            <hr>
  

            <div class="row">


              <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <a href="client_list">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of Clients</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_clients; ?></span>
                    </div>
                 <!--    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div> -->
                  </div>
                  </a>
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
                          <a href="sales_approval">
                          <div class="row">
                            <div class="col">
                              <h5 class="card-title text-uppercase text-muted mb-0">Pending Sales Approval</h5>
                              <span class="h2 font-weight-bold mb-0"><?php echo $get_num_sales_approval; ?></span>
                            </div>
                            <!-- <div class="col-auto">
                              <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                <i class="fas fa-chart-bar"></i>
                              </div>
                            </div> -->
                          </div>
                          </a>
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
                          <a href="client_transfer_approval">
                          <div class="row">
                            <div class="col">
                              <h5 class="card-title text-uppercase text-muted mb-0">Pending Client Transfer Approval</h5>
                              <span class="h2 font-weight-bold mb-0"><?php echo $get_num_client_transfer_approval?></span>
                            </div>
                            <!-- <div class="col-auto">
                              <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                <i class="fas fa-chart-bar"></i>
                              </div>
                            </div> -->
                          </div>
                          </a>
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