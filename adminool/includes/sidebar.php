<?php
  $uid = $_SESSION['adminid'];
             $current_admin_details = $object->get_current_user_info('admin_tbl',$uid);
             $surname = $current_admin_details['surname'];
             $other_names = $current_admin_details['other_names'];
             $fullname_user = $surname.' '.$other_names;
             $get_role_name = $object->get_one_row_from_one_table('admin_roles','unique_id', $current_admin_details['role_right']);
             $role_name = $get_role_name['role_name'];
?>


<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="#">
        <img src=".././assets/img/brand/farmkonnect.jpeg" class="navbar-brand-img" style="width: 100px; height: 350px;" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src=".././assets/img/theme/team-1-800x800.jpg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Notifications</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Report Generation</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>View Activity Log</span>
            </a>
            <!-- <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a> -->
            <div class="dropdown-divider"></div>
            <a href="logout" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <img src=".././assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
      

          <!-- Divider -->
        
        <!-- Heading -->
        <?php
             
             if(strcasecmp($role_name, 'Super Administrator') == 0){
          ?>
        <h6 class="navbar-heading text-muted">Dashboard</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="home">
              <i class="ni ni-spaceship"></i> Dashboard
            </a>
          </li>
        </ul>  

      <h6 class="navbar-heading text-muted">Investors</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
            <a class="nav-link" href="view_users">
              <i class="fa fa-eye text-primary"></i> View/Edit Users
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="view_investors">
              <i class="fa fa-eye-slash text-primary"></i> View/Edit Investors
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view_investments">
               <i class="ni ni-money-coins text-primary"></i> View Investments
            </a>
          </li>

<!--           <li class="nav-item">
            <a class="nav-link" href="view_investments">
               <i class="ni ni-money-coins text-primary"></i> Admin Pages:: 
               
            </a>
          </li> -->

        </ul>


                <!-- Heading -->
        <h6 class="navbar-heading text-muted">Packages</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
            <a class="nav-link" href="create_package">
              <i class="ni ni-app text-success"></i> Create Package
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view_packages">
              <i class="ni ni-app text-purple"></i> View/Edit Packages
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="packages_slot_log">
              <i class="ni ni-app text-red"></i> Packages Slot Log
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="create_package_category.php">
              <i class="ni ni-fat-add text-success"></i> Add Category
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view_categories">
              <i class="ni ni-glasses-2 text-purple"></i> View/Edit Categories
            </a>
          </li>
        </ul>


          <h6 class="navbar-heading text-muted">Transactions</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
            <a class="nav-link" href="pending_transfers">
              <i class="ni ni-money-coins text-primary"></i> Pending Transfers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="withdrawal_request">
              <i class="ni ni-money-coins text-primary"></i> Withdrawal Requests
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="credit_wallet_history">
              <i class="ni ni-credit-card text-orange"></i> Credit Wallet History
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-app text-success"></i> Profit Payments
            </a>
          </li>

        </ul>
      <!--  -->



          <h6 class="navbar-heading text-muted">Roles and Privileges</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
            <a class="nav-link" href="add_role">
              <i class="ni ni-money-coins text-primary"></i> Add Role
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="manage_roles">
              <i class="ni ni-money-coins text-primary"></i> Manage Roles
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user_to_role">
              <i class="ni ni-money-coins text-primary"></i> Add User to Role
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="ni ni-credit-card text-orange"></i> Page role right
            </a>
          </li>

         <li class="nav-item">
            <a class="nav-link" href="credit_wallet_history">
              <i class="ni ni-credit-card text-orange"></i> Functions role right
            </a>
          </li>

         

        </ul>
      <!--  -->


                    <!-- Divider -->
        <!-- <hr class="my-3"> -->
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Referrals</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-circle-08 text-primary"></i> Referral Setting
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-circle-08 text-orange"></i> View Referrals
            </a>
          </li>
        </ul>



           <!-- Divider -->
        <!-- <hr class="my-3"> -->
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Managers</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-circle-08 text-primary"></i> Assign Managers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-circle-08 text-orange"></i> Allocate Cash to Accountant
            </a>
          </li>
        </ul>



        <!-- Divider -->
        <!-- <hr class="my-3"> -->
        <h6 class="navbar-heading text-muted">Profile</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-single-02 text-primary"></i> Basic Info
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="documents">
              <i class="ni ni-calendar-grid-58 text-success"></i> Documents
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="logout">
              <i class="ni ni-pin-3 text-orange"></i> Logout
            </a>
          </li>
        </ul>
      <?php } 
             else if(strcasecmp($role_name, 'Lead Officer') == 0){
          ?>


       
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Dashboard</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="lead_officer_home">
              <i class="ni ni-spaceship"></i> Dashboard
            </a>
          </li>
        </ul>  

      <h6 class="navbar-heading text-muted">Leads</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="add_leads">
              <i class="fa fa-eye text-primary"></i> Add Leads
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="view_leads">
              <i class="fa fa-eye text-primary"></i> View/Edit Leads
            </a>
          </li>
        </ul>

        <!-- Divider -->
        <!-- <hr class="my-3"> -->
        <h6 class="navbar-heading text-muted">Profile</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="change_password">
              <i class="ni ni-single-02 text-primary"></i> Change Password
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="documents">
              <i class="ni ni-calendar-grid-58 text-success"></i> Documents
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="logout">
              <i class="ni ni-pin-3 text-orange"></i> Logout
            </a>
          </li>
        </ul>
      <?php }
             else if(strcasecmp($role_name, 'Feedback Officer') == 0){
          ?>


       
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Dashboard</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="feedback_officer_home">
              <i class="ni ni-spaceship"></i> Dashboard
            </a>
          </li>
        </ul>  

      <h6 class="navbar-heading text-muted">Complaints</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
            <a class="nav-link" href="view_complaints">
              <i class="fa fa-eye text-primary"></i> View/Edit Complaints
            </a>
          </li>
        </ul>

        <h6 class="navbar-heading text-muted">Requests</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
            <a class="nav-link" href="withdrawal_request">
              <i class="ni ni-money-coins text-primary"></i> Withdrawal Request
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pending_transfers">
              <i class="ni ni-money-coins text-primary"></i> Wallet to Wallet Transfer
            </a>
          </li>
        </ul>

        <h6 class="navbar-heading text-muted">Feedbacks</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
            <a class="nav-link" href="view_feedback">
              <i class="fa fa-eye text-primary"></i> View/Edit Feedbacks
            </a>
          </li>
        </ul>

        <!-- Divider -->
        <!-- <hr class="my-3"> -->
        <h6 class="navbar-heading text-muted"></h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="change_password">
              <i class="ni ni-single-02 text-primary"></i> Change Password
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="logout">
              <i class="ni ni-pin-3 text-orange"></i> Logout
            </a>
          </li>
        </ul>
      <?php }?>

      </div>
    </div>
  </nav>