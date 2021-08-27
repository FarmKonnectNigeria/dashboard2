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
     <a  href="#" >
        <img style="width: 140px; height: 130px;" src="../assets/img/brand/farmkonnect.jpeg"   alt="...">
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
            <!--<a href="./examples/profile.html" class="dropdown-item">-->
            <!--  <i class="ni ni-settings-gear-65"></i>-->
            <!--  <span>Report Generation</span>-->
            <!--</a>-->
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
             
             if($role_name =='Super Administrator'){
          ?>

        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="home">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>My Dashboard</b></span>
              </a>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#investors" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="investors">
              <i class="fa fa-eye text-warning"></i>
              <span class="navbar-heading text-muted"><b>Investors</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="investors">
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                    <a class="nav-link" href="verify_users">
                      <i class="fa fa-eye text-primary"></i> Verify Users
                    </a>
                  </li>
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
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="view_investments">
                       <i class="ni ni-money-coins text-primary"></i> View Investments
                    </a>
                  </li> -->
                </ul>
              </div>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#pending_approvals" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="pending_approvals">
              <i class="ni ni-money-coins text-primary"></i>
              <span class="navbar-heading text-muted"><b>Pending Approvals</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="pending_approvals">
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                  <a class="nav-link" href="package_creation_requests">
                    <i class="ni ni-money-coins text-primary"></i> Package Creation
                  </a>
                  </li>
                   <li class="nav-item">
                  <a class="nav-link" href="package_category_requests">
                    <i class="ni ni-money-coins text-primary"></i> Package Category Creation
                  </a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="pending_transfers">
                    <i class="ni ni-money-coins text-primary"></i> Wallet Transfers
                  </a>
                  </li>
                  
                  <li class="nav-item">
                  <a class="nav-link" href="pending_military_package">
                    <i class="ni ni-money-coins text-primary"></i> Military Packages
                  </a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" href="withdrawal_request">
                      <i class="ni ni-money-coins text-purple"></i> Withdrawal Requests
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="funds_transfer_request">
                      <i class="ni ni-money-coins text-warning"></i> Funds Transfer Activation
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="access_card_request">
                      <i class="ni ni-credit-card text-success"></i> Access Card Request 
                    </a>
                  </li>
                    </li>
                  <li class="nav-item">
                    <a class="nav-link" href="bonus_request">
                      <i class="ni ni-credit-card text-success"></i> Set Bonus Request
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="commission_request">
                      <i class="ni ni-credit-card text-success"></i> Set Commission Request
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" href="sack_be_request">
                      <i class="ni ni-credit-card text-success"></i> Sack BE Request
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="suspend_be_request">
                      <i class="ni ni-credit-card text-success"></i> Suspend BE Request
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="target_adjustment_request">
                      <i class="ni ni-credit-card text-success"></i> Target Adjustment Request
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="edit_user_information_sa">
                      <i class="fa fa-eye text-info"></i> Edit User's Information Request
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="edit_bank_details_request_sa">
                      <i class="fa fa-eye text-info"></i> Edit User's Bank Details Request
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="liquidation_request">
                      <i class="ni ni-credit-card text-success"></i> Liquidation Request
                    </a>
                  </li>
                    <li class="nav-item">
                    <a class="nav-link" href="backdate_requests">
                      <i class="fa fa-eye text-primary"></i> Backdate Requests
                    </a>
                  </li>
                  
                   <li class="nav-item">
                    <a class="nav-link" href="transfer_investment_ownership_request">
                      <i class="ni ni-credit-card text-success"></i> Transfer of Investment Ownership
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="undo_package_request">
                      <i class="ni ni-credit-card text-success"></i> Undo Package Subscription
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#packages" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="packages">
              <i class="ni ni-app text-purple"></i>
              <span class="navbar-heading text-muted"><b>Packages</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="packages">
                <ul class="navbar-nav mb-md-3">
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
                    <a class="nav-link" href="update_package_image">
                      <i class="ni ni-app text-purple"></i> Update Package Image
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="package_term_condition">
                      <i class="ni ni-app text-purple"></i> Terms and Conditions
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="update_package_term_condition">
                      <i class="ni ni-app text-purple"></i> Update Terms and Conditions
                    </a>
                  </li>
                 <!--  <li class="nav-item">
                    <a class="nav-link" href="packages_slot_log">
                      <i class="ni ni-app text-red"></i> Packages Slot Log
                    </a>
                  </li> -->
                </ul>
              </div>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#roles_privileges" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="roles_privileges">
              <i class="ni ni-money-coins text-info"></i>
              <span class="navbar-heading text-muted"><b>Roles and Privileges</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="roles_privileges">
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
                    <a class="nav-link" href="account_users">
                      <i class="ni ni-money-coins text-primary"></i> View Account Users
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                      <i class="ni ni-credit-card text-orange"></i> Page role right
                    </a>
                  </li>

                 <li class="nav-item">
                    <a class="nav-link" href="#">
                      <i class="ni ni-credit-card text-orange"></i> Functions role right
                    </a>
                  </li> -->

                </ul>
              </div>
            </li>
         <!--    <li class="nav-item mb-md-3">
              <a class="nav-link" href="#referrals" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="referrals">
              <i class="ni ni-circle-08 text-success"></i>
              <span class="navbar-heading text-muted"><b>Referrals</b></span>            
              </a>
              
              <div class="collapse ml-4" id="referrals">
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
              </div>
            </li> -->
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#managers" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="managers">
              <i class="ni ni-circle-08 text-yellow"></i>
              <span class="navbar-heading text-muted"><b>Managers</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="managers">
                <ul class="navbar-nav mb-md-3">
                  <!--<li class="nav-item">-->
                  <!--  <a class="nav-link" href="#">-->
                  <!--    <i class="ni ni-circle-08 text-primary"></i> Assign Managers-->
                  <!--  </a>-->
                  <!--</li>-->
                  <li class="nav-item">
                    <a class="nav-link" href="rate_mm">
                      <i class="ni ni-circle-08 text-orange"></i> Rate MM
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="allocate_cash">
                      <i class="ni ni-circle-08 text-orange"></i> Allocate Cash to Accountant
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            
              <li class="nav-item mb-md-3">
              <a class="nav-link" href="#CCTV" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="CCTV">
              <i class="ni ni-circle-08 text-yellow"></i>
              <span class="navbar-heading text-muted"><b>CCTV</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="CCTV">
                <ul class="navbar-nav mb-md-3">
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                      <i class="ni ni-circle-08 text-primary"></i> Assign Managers
                    </a>
                  </li> -->
                  <li class="nav-item">
                    <a class="nav-link" href="add_area">
                      <i class="ni ni-circle-08 text-orange"></i> Add Area
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="add_unit">
                      <i class="ni ni-circle-08 text-orange"></i> Add Unit
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="assign_users_unit">
                      <i class="ni ni-circle-08 text-orange"></i> Assign Users to Unit
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="profile">
              <i class="ni ni-single-02 text-warning"></i>
              <span class="navbar-heading text-muted"><b>Profile</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="profile">
                <ul class="navbar-nav mb-md-3">
                   <li class="nav-item">
                    <a class="nav-link" href="my_profile">
                      <i class="ni ni-single-02 text-primary"></i> Basic Info
                    </a>
                  </li>
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
                  <!-- <li class="nav-item">
                    <a class="nav-link " href="logout">
                      <i class="ni ni-pin-3 text-orange"></i> Logout
                    </a>
                  </li> -->
                </ul>
              </div>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="#others" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="others">
              <i class="ni ni-settings-gear-65 text-danger"></i>
              <span class="navbar-heading text-muted"><b>Others</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="others">
                <ul class="navbar-nav mb-md-3">
                   <li class="nav-item">
                    <a class="nav-link" href="terms_conditions">
                      <i class="ni ni-settings-gear-65 text-primary"></i> Add Terms and Conditions
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="update_terms_condition">
                      <i class="ni ni-settings-gear-65 text-primary"></i> Update Terms and Conditions
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="bank_accounts">
                      <i class="ni ni-credit-card text-info"></i> Add/Edit Bank Account (s)
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="admin_activities">
                      <i class="ni ni-credit-card text-info"></i> View Admin Activities
                    </a>
                  </li>
                </ul>
                <li class="nav-item mb-md-3">
              <a class="nav-link" href="logout">
                <i class="ni ni-pin-3 text-orange"></i> 
                  <span class="navbar-heading text-muted"><b>Logout</b></span>
              </a>
            </li>
              </div>
            </li>


          </ul>
      </div>

      <?php } 
             else if($role_name == 'Lead Officer'){
          ?>

      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="lead_officer_home">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>My Dashboard</b></span>
              </a>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#leads" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="leads">
              <i class="fa fa-eye text-warning"></i>
              <span class="navbar-heading text-muted"><b>Leads</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="leads">
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
              </div>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="profile">
              <i class="ni ni-single-02 text-success"></i>
              <span class="navbar-heading text-muted"><b>Profile</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="profile">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="my_profile">
                      <i class="ni ni-single-02 text-primary"></i> Basic Info
                    </a>
                  </li>
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
                </ul>
                <li class="nav-item mb-md-3">
              <a class="nav-link" href="logout">
                <i class="ni ni-pin-3 text-orange"></i> 
                  <span class="navbar-heading text-muted"><b>Logout</b></span>
              </a>
            </li>
              </div>
            </li>

          </ul>
        </div>
      <?php }
             else if($role_name == 'Feedback Officer'){
          ?>
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="feedback_officer_home">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>My Dashboard</b></span>
              </a>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#complaints" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="complaints">
              <i class="fa fa-eye text-yellow"></i>
              <span class="navbar-heading text-muted"><b>Complaints</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="complaints">
                <ul class="navbar-nav mb-md-3">
                   <li class="nav-item">
                    <a class="nav-link" href="view_complaints">
                      <i class="fa fa-eye text-primary"></i> View/Edit Complaints
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#requests" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="requests">
              <i class="ni ni-money-coins text-success"></i>
              <span class="navbar-heading text-muted"><b>Requests</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="requests">
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
              </div>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#feedbacks" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="feedbacks">
              <i class="ni ni-money-coins text-warning"></i>
              <span class="navbar-heading text-muted"><b>Feedbacks</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="feedbacks">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="view_feedback">
                      <i class="fa fa-eye text-primary"></i> View/Edit Feedbacks
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="profile">
              <i class="ni ni-single-02 text-info"></i>
              <span class="navbar-heading text-muted"><b>Profile</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="profile">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="my_profile">
                      <i class="ni ni-single-02 text-primary"></i> Basic Info
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="change_password">
                      <i class="ni ni-single-02 text-primary"></i> Change Password
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link " href="logout">
                      <i class="ni ni-pin-3 text-orange"></i> Logout
                    </a>
                  </li> -->
                </ul>
                <li class="nav-item mb-md-3">
              <a class="nav-link" href="logout">
                <i class="ni ni-pin-3 text-orange"></i> 
                  <span class="navbar-heading text-muted"><b>Logout</b></span>
              </a>
            </li>
              </div>
            </li>
          </ul>
        </div>

      <?php }
             else if($role_name == 'Business Executive'){
          ?>
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="BE_home">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>My Dashboard</b></span>
              </a>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#client_management" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="client_management">
              <i class="fa fa-eye text-success"></i>
              <span class="navbar-heading text-muted"><b>Client Management</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="client_management">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="lead_pool">
                      <i class="fa fa-eye text-primary"></i> Lead Pool
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="add_leads">
                      <i class="fa fa-eye text-primary"></i> Add Lead
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="my_leads">
                      <i class="fa fa-eye text-primary"></i> My Leads
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="my_prospects">
                      <i class="fa fa-eye text-primary"></i> My Prospects
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="my_clients">
                      <i class="fa fa-eye text-primary"></i> My Clients
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#sales_management" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sales_management">
              <i class="ni ni-money-coins text-warning"></i>
              <span class="navbar-heading text-muted"><b>Sales Management</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="sales_management">
                <ul class="navbar-nav mb-md-3">
                   <li class="nav-item">
                    <a class="nav-link" href="my_target">
                      <i class="ni ni-money-coins text-primary"></i> My Target
                    </a> 
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="register_sales">
                      <i class="ni ni-money-coins text-primary"></i> Register Sales
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="my_bonus">
                      <i class="ni ni-money-coins text-primary"></i>My Bonus
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="my_commission">
                      <i class="ni ni-money-coins text-primary"></i>My Commission
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#requests_complaints" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="requests_complaints">
              <i class="fa fa-eye text-purple"></i>
              <span class="navbar-heading text-muted"><b>Requests, Complaints and Feedbacks</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="requests_complaints">
                <ul class="navbar-nav mb-md-3">
                   <li class="nav-item">
                    <a class="nav-link" href="BE_request_complaint">
                      <i class="fa fa-eye text-primary"></i> View/Edit Request/Complaints
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="BE_feedback">
                      <i class="fa fa-eye text-primary"></i> View/Edit Feedbacks
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#documents" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="documents">
              <i class="fa fa-file text-yellow"></i>
              <span class="navbar-heading text-muted"><b>Documents</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="documents">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="share_document">
                      <i class="fa fa-file text-primary"></i> Share Documents
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="draft_agreement ">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Draft Agreement</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#transfer_client" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="documents">
              <i class="fa fa-file text-yellow"></i>
              <span class="navbar-heading text-muted"><b>Transfer Client</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="transfer_client">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="permanent_transfer">
                      <i class="fa fa-file text-primary"></i> Permanent Transfer
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="temporary_transfer_client">
                      <i class="fa fa-file text-primary"></i> Temporary Transfer
                    </a>
                  </li>
                </ul>
              </div>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="#invoice" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="documents">
              <i class="fa fa-file text-info"></i>
              <span class="navbar-heading text-muted"><b>Client Invoice</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="invoice">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="request_invoice">
                      <i class="fa fa-file text-success"></i> Invoice Request
                    </a>
                  </li>
                </ul>
              </div>
            </li>

           <li class="nav-item mb-md-3">
              <a class="nav-link" href="action_reminder">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Action Reminder</b></span>
              </a>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="my_closures">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>My Closure</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="payment_reminder">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Payment Reminder</b></span>
              </a>
            </li>


            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#confirm_payment" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="documents">
              <i class="fa fa-file text-info"></i>
              <span class="navbar-heading text-muted"><b>Confirm Payment</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="confirm_payment">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="confirm_payment">
                      <i class="fa fa-file text-success"></i> Confirm Payment
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="confirmation_list">
                      <i class="fa fa-file text-success"></i> Confirmation List
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="payment_log">
                      <i class="fa fa-file text-success"></i> Payment Log
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#approvals_be" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="documents">
              <i class="fa fa-file text-info"></i>
              <span class="navbar-heading text-muted"><b>Approvals</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="approvals_be">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="edit_user_information_request">
                      <i class="ni ni-credit-card text-success"></i> Edit User's information Request
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="edit_user_bank_details_request">
                      <i class="ni ni-credit-card text-success"></i> Edit User's Bank Details Request
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="profile">
              <i class="fa fa-user text-danger"></i>
              <span class="navbar-heading text-muted"><b>Profile</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="profile">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="my_profile">
                      <i class="ni ni-single-02 text-primary"></i> My Profile
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="change_password">
                      <i class="ni ni-single-02 text-primary"></i> Change Password
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link " href="logout">
                      <i class="ni ni-pin-3 text-orange"></i> Logout
                    </a>
                  </li> -->
                </ul>
                <li class="nav-item mb-md-3">
              <a class="nav-link" href="logout">
                <i class="ni ni-pin-3 text-orange"></i> 
                  <span class="navbar-heading text-muted"><b>Logout</b></span>
              </a>
            </li>
              </div>
            </li>



          </ul>
        </div>

      <?php }
             else if($role_name == 'Marketing Manager'){
          ?>

      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="MM_home">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>My Dashboard</b></span>
              </a>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#team_management" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="team_management">
              <i class="fa fa-eye text-warning"></i>
              <span class="navbar-heading text-muted"><b>Team Management</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="team_management">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="recruit_be">
                      <i class="fa fa-eye text-muted"></i> Recruit a Business Executive
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="my_be">
                      <i class="fa fa-eye text-primary"></i> My Business Executive
                    </a>
                  </li>
                  <!--<li class="nav-item">-->
                  <!--  <a class="nav-link" href="#">-->
                  <!--    <i class="fa fa-eye text-primary"></i> Assign Account Officers-->
                  <!--  </a>-->
                  <!--</li>-->
                  <li class="nav-item">
                    <a class="nav-link" href="transfer_be">
                      <i class="fa fa-eye text-primary"></i> Transfer BE
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="probation">
                      <i class="fa fa-eye text-primary"></i> Probation
                    </a>
                  </li>
                  
                  
                  
                  
                </ul>
              </div>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#client_management" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="client_management">
              <i class="fa fa-eye text-muted"></i>
              <span class="navbar-heading text-muted"><b>Client Management</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="client_management">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="lead_pool_MM">
                      <i class="fa fa-eye text-primary"></i> Lead Pool
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="prospect_list">
                      <i class="fa fa-eye text-primary"></i> Prospect List
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="client_list">
                      <i class="fa fa-eye text-primary"></i> Client List
                    </a>
                  </li>
                  <!--<li class="nav-item">-->
                  <!--  <a class="nav-link" href="#">-->
                  <!--    <i class="fa fa-eye text-primary"></i> Change Account Officer-->
                  <!--  </a>-->
                  <!--</li>-->
                </ul>
              </div>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#sales_management" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sales_management">
              <i class="fa fa-eye text-yellow"></i>
              <span class="navbar-heading text-muted"><b>Sales Management</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="sales_management">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="set_target">
                      <i class="fa fa-eye text-primary"></i> Set Target
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="probation_target">
                      <i class="fa fa-eye text-primary"></i> Probation Target
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="adjust_target">
                      <i class="fa fa-eye text-primary"></i> Adjust Target
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="set_bonus_commission">
                      <i class="fa fa-eye text-primary"></i> Set Bonus/Commission
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="sales_progress">
                      <i class="fa fa-eye text-primary"></i> View Sales Progress
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#approvals" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="approvals">
              <i class="fa fa-eye text-success"></i>
              <span class="navbar-heading text-muted"><b>Approvals</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="approvals">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="sales_approval">
                      <i class="fa fa-eye text-primary"></i> Sales Approval
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="client_transfer_approval">
                      <i class="fa fa-eye text-primary"></i> Client Transfer Approval
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="edit_user_information_request_MM">
                      <i class="ni ni-credit-card text-success"></i> Edit User's information Request
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="edit_user_bank_details_request_MM">
                      <i class="ni ni-credit-card text-success"></i> Edit User's Bank Detail Request
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="backdate_requests_MM">
                      <i class="fa fa-eye text-primary"></i> Backdate Requests
                    </a>
                  </li>
                  
                </ul>
              </div>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#product_management" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="product_management">
              <i class="fa fa-eye text-purple"></i>
              <span class="navbar-heading text-muted"><b>Product Management</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="product_management">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="view_packages">
                      <i class="fa fa-eye text-primary"></i> View Products
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#conflict_management" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="conflict_management">
              <i class="fa fa-eye text-info"></i>
              <span class="navbar-heading text-muted"><b>Conflict Management</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="conflict_management">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="view_complaints">
                      <i class="fa fa-eye text-orange"></i> View Complaints and Requests
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="view_feedback">
                      <i class="fa fa-eye text-purple"></i> View Feedbacks
                    </a>
                  </li>
                  <!--<li class="nav-item">-->
                  <!--  <a class="nav-link" href="view_feedback">-->
                  <!--    <i class="fa fa-eye text-info"></i> View BE Ratings-->
                  <!--  </a>-->
                  <!--</li>-->
                </ul>
              </div>
            </li>

            <!-- <li class="nav-item mb-md-3">-->
            <!--  <a class="nav-link" href="MM_home">-->
            <!--    <i class="ni ni-tv-2 text-orange"></i> -->
            <!--      <span class="navbar-heading text-muted"><b>Recruit an MM</b></span>-->
            <!--  </a>-->
            <!--</li>-->
            <!--<li class="nav-item mb-md-3">-->
            <!--  <a class="nav-link" href="MM_home">-->
            <!--    <i class="ni ni-tv-2 text-success"></i> -->
            <!--      <span class="navbar-heading text-muted"><b>Suspend an MM</b></span>-->
            <!--  </a>-->
            <!--</li>-->
            <!--<li class="nav-item mb-md-3">-->
            <!--  <a class="nav-link" href="MM_home">-->
            <!--    <i class="ni ni-tv-2 text-primary"></i> -->
            <!--      <span class="navbar-heading text-muted"><b>Transfer BEs</b></span>-->
            <!--  </a>-->
            <!--</li>-->


            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="profile">
              <i class="ni ni-single-02 text-success"></i>
              <span class="navbar-heading text-muted"><b>Profile</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="profile">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="change_password">
                      <i class="ni ni-single-02 text-primary"></i> Change Password
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="documents">
                      <i class="ni ni-calendar-grid-58 text-yellow"></i> Documents
                    </a>
                  </li>

                   <li class="nav-item">
                    <a class="nav-link" href="my_profile">
                      <i class="ni ni-calendar-grid-58 text-purple"></i> My Profile
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link " href="logout">
                      <i class="ni ni-pin-3 text-orange"></i> Logout
                    </a>
                  </li> -->
                </ul>
                <li class="nav-item mb-md-3">
              <a class="nav-link" href="logout">
                <i class="ni ni-pin-3 text-orange"></i> 
                  <span class="navbar-heading text-muted"><b>Logout</b></span>
              </a>
            </li>
              </div>
            </li>

          </ul>
        </div>
      <?php }
             else if($role_name == 'Accountant'){
          ?>

      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="accountant_home">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>My Dashboard</b></span>
              </a>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="accountant_wallet">
                <i class="ni ni-tv-2 text-success"></i> 
                  <span class="navbar-heading text-muted"><b>Wallet</b></span>
              </a>
            </li>

            <!-- <li class="nav-item mb-md-3">
              <a class="nav-link" href="invoice">
                <i class="ni ni-tv-2 text-info"></i> 
                  <span class="navbar-heading text-muted"><b>Invoicing</b></span>
              </a>
            </li> -->

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="online_payments">
                <i class="ni ni-tv-2 text-orange"></i> 
                  <span class="navbar-heading text-muted"><b>Online Payment</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="accountant_payment_log">
                <i class="ni ni-tv-2 text-yellow"></i> 
                  <span class="navbar-heading text-muted"><b>Payment Log</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="credit_user_wallet">
                <i class="ni ni-money-coins text-purple"></i> 
                  <span class="navbar-heading text-muted"><b>Credit User Wallet</b></span>
              </a>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="credit_user_wallet_log">
                <i class="ni ni-money-coins text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Error Credit</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="deactivate_wallet2">
                <i class="ni ni-money-coins text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Deactivate Wallet</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="request_funds">
                <i class="ni ni-money-coins text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Request for Funds</b></span>
              </a>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="expense_log">
                <i class="ni ni-money-coins text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Expense Log</b></span>
              </a>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#approvals" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="approvals">
              <i class="fa fa-eye text-info"></i>
              <span class="navbar-heading text-muted"><b>Approvals</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="approvals">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="bonus_claim">
                      <i class="fa fa-eye text-orange"></i> Bonus Claim
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="commission_claim">
                      <i class="fa fa-eye text-orange"></i> Commission Claim
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="sales_claim">
                      <i class="fa fa-eye text-purple"></i> Sales Claim
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="credit_wallet_history">
                      <i class="ni ni-credit-card text-orange"></i> Pending Deposits
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#requests" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="requests">
              <i class="fa fa-eye text-info"></i>
              <span class="navbar-heading text-muted"><b>Requests</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="requests">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="invoice_request">
                      <i class="fa fa-eye text-orange"></i> Invoice Request
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="accountant_withdrawal_request">
                      <i class="fa fa-eye text-info"></i> Withdrawal Request
                    </a>
                  </li>
                 <li class="nav-item">
                    <a class="nav-link" href="accountant_liquidation_request">
                      <i class="fa fa-eye text-info"></i> Liquidation Request
                    </a>
                  </li>
                   </li>
                   <li class="nav-item">
                    <a class="nav-link" href="accountant_backdate_requests">
                      <i class="fa fa-eye text-primary"></i> Backdate Requests (Fixed)
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="acct_approve_backdated_rec">
                      <i class="fa fa-eye text-primary"></i>Backdate Requests (Reccurent)
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#account_users" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="account_users">
              <i class="ni ni-single-02 text-success"></i>
              <span class="navbar-heading text-muted"><b>Account Users</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="account_users">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="view_users_details">
                      <i class="ni ni-single-02 text-primary"></i> View Personal/Investment Details
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="accountant_approved_backdate_request">
                <i class="ni ni-money-coins text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>View Approved Backdate Request</b></span>
              </a>
            </li>
            
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="view_floating_profit_details">
                <i class="ni ni-money-coins text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>View Users Floating Profit</b></span>
              </a>
            </li>
            
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="view_payout">
                <i class="ni ni-money-coins text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>View Payouts</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="profile">
              <i class="ni ni-single-02 text-success"></i>
              <span class="navbar-heading text-muted"><b>Profile</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="profile">
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
                    <a class="nav-link" href="my_profile">
                      <i class="ni ni-calendar-grid-58 text-success"></i> My Profile
                    </a>
                  </li>
                 <!--  <li class="nav-item">
                    <a class="nav-link " href="logout">
                      <i class="ni ni-pin-3 text-orange"></i> Logout
                    </a>
                  </li> -->
                </ul>
                <li class="nav-item mb-md-3">
              <a class="nav-link" href="logout">
                <i class="ni ni-pin-3 text-orange"></i> 
                  <span class="navbar-heading text-muted"><b>Logout</b></span>
              </a>
            </li>
              </div>
            </li>
          </ul>
        </div>
      <?php }else if($role_name == "Cash Officer"){?>
         <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="cash_officer_home">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>My Dashboard</b></span>
              </a>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="cash_withdrawal_request">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Withdrawal Requests</b></span>
              </a>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="liquidation_request_log">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Liquidation Requests</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="log_payment">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Log Payment</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="payment_confirmation">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Payment Confirmation</b></span>
              </a>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="debit_account">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Debit Account</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="approve_be_sales">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Approve BE Sales</b></span>
              </a>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="error_debit">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Error Debit</b></span>
              </a>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="cash_officer_payment_log">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>View Payment Log</b></span>
              </a>
            </li>
            
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#account_users" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="account_users">
              <i class="ni ni-single-02 text-success"></i>
              <span class="navbar-heading text-muted"><b>Account Users</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="account_users">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="view_users_details">
                      <i class="ni ni-single-02 text-primary"></i> View Personal/Investment Details
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="profile">
              <i class="ni ni-single-02 text-success"></i>
              <span class="navbar-heading text-muted"><b>Profile</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="profile">
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
                </ul>
                <li class="nav-item mb-md-3">
              <a class="nav-link" href="logout">
                <i class="ni ni-pin-3 text-orange"></i> 
                  <span class="navbar-heading text-muted"><b>Logout</b></span>
              </a>
            </li>
              </div>
            </li>

          </ul>
        </div>
      <?php }else if($role_name == "Investment Manager"){?>
          <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="IM_home">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>My Dashboard</b></span>
              </a>
            </li>
             <li class="nav-item mb-md-3">
              <a class="nav-link" href="create_package_category">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Create Investment Category</b></span>
              </a>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="create_package">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Create New Package</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="update_package_image">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Update Package Image</b></span>
              </a>
            </li>
            
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="update_category_image">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Update Category Image</b></span>
              </a>
            </li>

              <li class="nav-item mb-md-3">
              <a class="nav-link" href="#view" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="view">
              <i class="ni ni-single-02 text-success"></i>
              <span class="navbar-heading text-muted"><b>View</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="view">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="view_categories">
                      <i class="ni ni-single-02 text-primary"></i> View Category
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="view_packages">
                      <i class="ni ni-calendar-grid-58 text-success"></i> View Packages
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            
            

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="#account_users" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="account_users">
              <i class="ni ni-single-02 text-success"></i>
              <span class="navbar-heading text-muted"><b>Account Users</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="account_users">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="view_users_details">
                      <i class="ni ni-single-02 text-primary"></i> View Personal/Investment Details
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="view_user_deposit">
                      <i class="ni ni-tv-2 text-primary"></i> 
                        View Users Deposits
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="view_user_withdrawal">
                      <i class="ni ni-tv-2 text-primary"></i> 
                        View Users Withdrawal
                    </a>
                  </li>
                </ul>
              </div>
            </li>
             <li class="nav-item mb-md-3">
              <a class="nav-link" href="broadcast_message">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Broadcast Message</b></span>
              </a>
            </li>
              <li class="nav-item mb-md-3">
              <a class="nav-link" href="edit_sensitive_details">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Edit Investor's Sensitive Details</b></span>
              </a>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="edit_user_bank_details">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Edit Investor's Bank Details</b></span>
              </a>
            </li>
             <li class="nav-item mb-md-3">
              <a class="nav-link" href="create_third_party_account">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Set Up Third Party Account</b></span>
              </a>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="buy_package">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Buy Package</b></span>
              </a>
            </li>
            
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="withdraw_for_client">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Request Withdrawal for Client</b></span>
              </a>
            </li>
            
             <li class="nav-item mb-md-3">
              <a class="nav-link" href="#view" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="view">
              <i class="ni ni-tv-2 text-success"></i>
              <span class="navbar-heading text-muted"><b>Backdate Investment</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="view">
                <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <a class="nav-link" href="backdate_investment">
                      <i class="ni ni-single-02 text-primary"></i> Backdate Fixed Investment
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="backdate_investment_rec">
                      <i class="ni ni-calendar-grid-58 text-muted"></i> Backdate Recurrent Investment
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            
            <!-- <li class="nav-item mb-md-3">-->
            <!--  <a class="nav-link" href="backdate_investment">-->
            <!--    <i class="ni ni-pin-3 text-success"></i> -->
            <!--      <span class="navbar-heading text-muted"><b>Backdate Investment</b></span>-->
            <!--  </a>-->
            <!--</li>-->
            
             <li class="nav-item mb-md-3">
              <a class="nav-link" href="initiate_liquidation">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Initiate Liquidation</b></span>
              </a>
            </li>
              <li class="nav-item mb-md-3">
              <a class="nav-link" href="transfer_package_ownership">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Transfer Package Ownership</b></span>
              </a>
            </li>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="query_account">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Query Accounts (forensics)</b></span>
              </a>
            </li>
             <li class="nav-item mb-md-3">
              <a class="nav-link" href="disable_account2">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Disable/Enable Account</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="profile">
              <i class="ni ni-single-02 text-success"></i>
              <span class="navbar-heading text-muted"><b>Profile</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="profile">
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
                </ul>
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="logout">
                <i class="ni ni-pin-3 text-orange"></i> 
                  <span class="navbar-heading text-muted"><b>Logout</b></span>
              </a>
            </li>
            
              </div>
            </li>

          </ul>
        </div>
         <?php }else if($role_name == "CRM"){?>
         <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="crm_home">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>My Dashboard</b></span>
              </a>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="withdrawal_request_crm">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Withdrawal Requests</b></span>
              </a>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="pending_transfers">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Wallet-to-Wallet Transfer</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="liquidation_request_log">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Liquidation Request Log</b></span>
              </a>
            </li>

            <li class="nav-item mb-md-3">
              <a class="nav-link" href="view_users_details">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>View Users</b></span>
              </a>
            </li>

             <li class="nav-item mb-md-3">
              <a class="nav-link" href="users_deposit">
                <i class="ni ni-tv-2 text-primary"></i> 
                  <span class="navbar-heading text-muted"><b>Deposits</b></span>
              </a>
            </li>
            
            <li class="nav-item mb-md-3">
              <a class="nav-link" href="#profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="profile">
              <i class="ni ni-single-02 text-success"></i>
              <span class="navbar-heading text-muted"><b>Profile</b></span>            
              </a>
              <!-- Navigation -->
              <div class="collapse ml-4" id="profile">
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
                </ul>
                <li class="nav-item mb-md-3">
              <a class="nav-link" href="logout">
                <i class="ni ni-pin-3 text-orange"></i> 
                  <span class="navbar-heading text-muted"><b>Logout</b></span>
              </a>
            </li>
              </div>
            </li>

          </ul>
        </div>
      <?php }?>
      </div>
    </div>
  </nav>