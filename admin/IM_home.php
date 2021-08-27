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
   $get_pending_withdrawals = $object->count_pending_withdrawn();
  $get_pending_withdrawals_decode = json_decode($get_pending_withdrawals,true);

$total_pending_withdrawn = $object->total_pending_withdrawn();
  $total_pending_withdrawn_decode = json_decode($total_pending_withdrawn,true);

  $get_total_investment = $object->get_number_of_rows('subscribed_packages');
  $get_total_investment_amount = $object->total_investment('subscribed_packages', 'total_amount');
  $get_total_investment_amount_decode = json_decode($get_total_investment_amount, true);
  
  $get_total_wallet_balance = $object->total_investment('wallet_tbl', 'balance');
  $get_total_wallet_balance_decode = json_decode($get_total_wallet_balance, true);

  $get_liquidation_requests = $object->get_number_of_rows('liquidated_investments_tbl');

  $get_number_packages = $object->get_number_of_rows('package_definition');
  $get_number_visible_packages = $object->get_number_of_rows_one_param('package_definition','visibility', 1);

  $get_investments = $object->get_rows_from_one_table('subscribed_packages');
  $get_biggest_investment = array_column($get_investments, 'total_amount');
  $biggest_investment = max($get_biggest_investment);

  $get_id_biggest_investment = $object->get_one_row_from_one_table('subscribed_packages', 'total_amount', $biggest_investment);

  $get_biggest_client = $object->get_one_row_from_one_table('users_tbl', 'unique_id',$get_id_biggest_investment['user_id']);
  $get_hottest_product_id = $object->get_hottest_product('subscribed_packages', 'package_id');
  $hottest_product_decode = json_decode($get_hottest_product_id, true);
  $get_hottest_product = $object->get_one_row_from_one_table('package_definition', 'unique_id', $hottest_product_decode['msg']);
 //print_r($get_hottest_product);
  //var_dump($get_hottest_client);

include('includes/header.php'); ?>
<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Investment Manager'){
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
                <!-- <a href="view_users"> -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Investment(<strong><?php echo $get_total_investment; ?></strong>)</h5>
                      <span class="h2 font-weight-bold mb-0">&#8358;<?php echo number_format($get_total_investment_amount_decode['msg']); ?></span>
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
              <!-- </a> -->
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <!-- <a href="manage_roles"> -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Wallet Balance</h5>
                      <span class="h2 font-weight-bold mb-0">&#8358;<?php echo number_format($get_total_wallet_balance_decode['msg']); ?></span>
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
                <!-- </a> -->
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <!-- <a href="account_users"> -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Liquidation Requests</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_liquidation_requests;?></span>
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
                <!-- </a> -->
              </div>
            </div>

          


          </div>

            <hr>
  

            <div class="row">
                <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <!-- <a href="view_categories"> -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Withdrawal Requests<strong>(<?php echo $get_pending_withdrawals_decode['msg']; ?>)</strong></h5>
                              <span class="h2 font-weight-bold mb-0"> &#8358;<?php echo number_format($total_pending_withdrawn_decode['msg']); ?></span>
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
                <!-- </a> -->
              </div>
            </div>



              <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <!-- <a href="view_investments"> -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of Investment Packages</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_number_packages; ?></span>
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
                <!-- </a> -->
              </div>
            </div>
                  <div class="col-xl-4 col-lg-6">
                      <div class="card card-stats mb-4 mb-xl-0">
                        <!-- <a href="manage_roles"> -->
                        <div class="card-body">
                          <div class="row">
                            <div class="col">
                              <h5 class="card-title text-uppercase text-muted mb-0">Number of Investment Packages Displaying</h5>
                              <span class="h2 font-weight-bold mb-0"><?php echo $get_number_visible_packages;?></span>
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
                      <!-- </a> -->
                      </div>
                  </div>
            </div>
            <hr>
            <div class="row">
               <div class="col-xl-4 col-lg-6">
                      <div class="card card-stats mb-4 mb-xl-0">
                        <!-- <a href="withdrawal_request"> -->
                        <div class="card-body">
                          <div class="row">
                            <div class="col">
                              <h5 class="card-title text-uppercase text-muted mb-0">Biggest Investment</h5>
                              <span class="h2 font-weight-bold mb-0"> &#8358;<?php echo number_format($biggest_investment);?></span>
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
                        <!-- </a> -->
                      </div>
                  </div>
                  <div class="col-xl-4 col-lg-6">
                      <div class="card card-stats mb-4 mb-xl-0">
                        <!-- <a href="withdrawal_request"> -->
                        <div class="card-body">
                          <div class="row">
                            <div class="col">
                              <h5 class="card-title text-uppercase text-muted mb-0">Biggest Client</h5>
                              <span class="h3 font-weight-bold mb-0"> <small><?php echo $get_biggest_client['surname'].' '.$get_biggest_client['other_names'];?></small></span>
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
                        <!-- </a> -->
                      </div>
                  </div>

                  <div class="col-xl-4 col-lg-6">
                      <div class="card card-stats mb-4 mb-xl-0">
                        <!-- <a href="withdrawal_request"> -->
                        <div class="card-body">
                          <div class="row">
                            <div class="col">
                              <h5 class="card-title text-uppercase text-muted mb-0">Hottest Product</h5>
                              <span class="h3 font-weight-bold mb-0"><small><?php echo $get_hottest_product['package_name'];?></small></span>
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
                        <!-- </a> -->
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