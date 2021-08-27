<?php session_start();
      require_once('../classes/db_class.php');
      if(!isset($_SESSION['adminid'])){
        header('location: login');
      } 

       ///id seession
   $uid = $_SESSION['adminid'];
   //class object
   $object = new DbQueries();
    @$object->transfer_back_client($uid);
   $current_admin_details = $object->get_current_user_info('admin_tbl',$uid);
   $surname = $current_admin_details['surname'];
   $other_names = $current_admin_details['other_names'];
   $fullname_user = $surname.' '.$other_names;


  $get_num_leads = $object->get_number_of_rows('leads');
  $get_num_sales = $object->get_number_of_rows_two_params('be_sales','added_by', $uid, 'sales_status', 3);
  $get_num_complaints = $object->get_number_of_rows('contact_us_tbl');
  $get_num_feedback = $object->get_number_of_rows('feedback_tbl');


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


include('includes/header.php'); ?>
<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name !=  'Business Executive'){
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
                  <a href="lead_pool">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of Leads/Prospects/Client</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_leads; ?></span>
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
                  <a href="my_closures">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of Approved Sales</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_sales; ?></span>
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
                </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <a href="BE_request_complaint">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of Complaints</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_complaints; ?></span>
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
                  <a href="BE_feedback">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Number of Feedbacks</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $get_num_feedback; ?></span>
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