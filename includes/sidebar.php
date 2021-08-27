<?php 
//   $check_if_an_affiliate = $object->get_one_row_from_one_table('affilliate_tbl','user_id',$uid);


?>
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand class="navbar-brand pt-0"-->
      <a  href="#" >
        <img style="width: 140px; height: 130px;" src="assets/img/brand/farmkonnect.jpeg"   alt="...">
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
                <img alt="Image placeholder" src="<?php echo $profile_image;?>">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="profile" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Profile</span>
              </a>
              <a href="#" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Help</span>
              </a>
              <a href="documents" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>My Files</span>
              </a>
              <a href="transfer_funds" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Transfer Money</span>
              </a>
               <a href="wallet_withdrawal" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Withdraw Money from Wallet</span>
              </a>
              <a href="earnings_withdrawal" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Withdraw Money from Profit</span>
              </a>
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
                <img src="./assets/img/brand/farmkonnect.png">
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
       <!--  <ul class="navbar-nav">
           <li class="nav-item  class="active">
          <a class=" nav-link active " href=" ./index.html"> <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="ni ni-ungroup text-orange"></i>
                <span class="nav-link-text">Profile</span>
              </a>
              <div class="collapse" id="navbar-examples">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="profile" class="nav-link">Basic Info</a>
                  </li>
                  <li class="nav-item">
                    <a href="documents" class="nav-link">Documents</a>
                  </li>
                  
                </ul>
              </div>
            </li>
          <li class="nav-item  class="active">
          <a class=" nav-link active " href=" ./index.html"> <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./examples/icons.html">
              <i class="ni ni-planet text-blue"></i> Icons
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./examples/maps.html">
              <i class="ni ni-pin-3 text-orange"></i> Maps
            </a>
          </li>
         
        </ul> -->


        <!-- Heading -->
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
        <a class="nav-link" href="#my_wallet" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="my_wallet">
          <i class="ni ni-briefcase-24 text-warning"></i>
            <span class="navbar-heading text-muted"><b>My Wallet</b></span>            
        </a>
        <!-- Navigation -->
        <div class="collapse ml-4" id="my_wallet">
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="wallet">
              <i class="ni ni-briefcase-24 text-primary"></i> My Wallet
            </a>
          </li>
          <!--<li class="nav-item">-->
          <!--  <a class="nav-link" id="" href="wallet">-->
          <!--    <i class="ni ni-briefcase-24 text-yellow"></i> Credit  Wallet-->
          <!--  </a>-->
          <!--</li>-->
          <li class="nav-item">
            <a class="nav-link" href="withdrawal_requests">
              <i class="ni ni-briefcase-24 text-primary"></i> Withdrawal Requests
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transaction_history">
              <i class="ni ni-briefcase-24 text-yellow"></i> Transaction History
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-briefcase-24 text-primary"></i> My Commissions
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-briefcase-24 text-yellow"></i> My Bonuses
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transfer_funds">
              <i class="ni ni-briefcase-24 text-yellow"></i> Transfer Funds
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="change_transfer_pin">
              <i class="ni ni-briefcase-24 text-yellow"></i> Change Transfer Pin
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="funds_transfer_history">
              <i class="ni ni-briefcase-24 text-yellow"></i> Transfer History
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="upload_payment_proof">
              <i class="ni ni-briefcase-24 text-primary"></i> Upload Payment Proof
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="set_auto_withdrawal">
              <i class="ni ni-briefcase-24 text-yellow"></i> Set Automatic Withdrawal
            </a>
          </li>
         <!--     <li class="nav-item">
            <a class="nav-link" href="transfer_funds">
              <i class="ni ni-briefcase-24 text-yellow"></i> Deactivate Funds Transfer
            </a>
          </li> -->
           <!-- <li class="nav-item">
            <a class="nav-link" href="wallet">
              <i class="ni ni-spaceship"></i> Credit Wallet
            </a>
          </li> -->
        <!--   <li class="nav-item">
            <a class="nav-link" href="earnings_to_wallet">
              <i class="ni ni-money-coins text-orange"></i> Profits to Wallet
            </a>
          </li> -->
          

       <!--    <li class="nav-item">
            <a class="nav-link" href="credit_wallet_history">
              <i class="ni ni-credit-card text-red"></i> Credit Wallet History
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="expense_history">
              <i class="ni ni-collection text-muted"></i> Expense  History
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="funds_transfer_history">
              <i class="ni ni-credit-card text-red"></i>Transfer History
            </a>
          </li> -->
        <!--  <li class="nav-item">
            <a class="nav-link" href="#">    transaction_log 
              <i class="ni ni-collection text-primary"></i> Transaction Log 
            </a>
          </li> -->

          <!-- <li class="nav-item">
            <a class="nav-link" href="earnings_log">
              <i class="ni ni-spaceship"></i> Earnings Log 
            </a>
          </li> -->

          
        </ul>
      </div>
    </li>
        <li class="nav-item mb-md-3">
        <a class="nav-link" href="#my_profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="my_profile">
          <i class="ni ni-single-02 text-yellow"></i>
            <span class="navbar-heading text-muted"><b>My Profile</b></span>            
        </a>
        <!-- Navigation -->
        <div class="collapse ml-4" id="my_profile">
         <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="profile">
              <i class="ni ni-single-02 text-success"></i>See My Profile
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="documents">
              <i class="ni ni-folder-17 text-success"></i> My Documents
            </a>
          </li>
             <li class="nav-item">
            <a class="nav-link" href="documents">
              <i class="ni ni-folder-17 text-warning"></i> Upload Documents
            </a>
          </li>
          <!--  <li class="nav-item">-->
          <!--  <a class="nav-link" href="verify_account">-->
          <!--    <i class="ni ni-folder-17 text-success"></i> Verify Account-->
          <!--  </a>-->
          <!--</li>-->
          <!--  <li class="nav-item">-->
          <!--  <a class="nav-link" href="refer_someone">-->
          <!--    <i class="ni ni-folder-17 text-warning"></i> Refer Someone-->
          <!--  </a>-->
          <!--</li>-->
            <li class="nav-item">
            <a class="nav-link" href="access_card">
              <i class="ni ni-folder-17 text-success"></i> Access Card
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="change_password">
              <i class="ni ni-single-02 text-primary"></i> Change Password
            </a>
          </li>
        </ul>
    </div>
  </li>
  
  <li class="nav-item mb-md-3">
          <a class="nav-link" href="my_unit">
            <i class="ni ni-app text-purple"></i> 
              <span class="navbar-heading text-muted"><b>My Farm(s)</b></span>
          </a>
      </li>
  
 


    <li class="nav-item mb-md-3">
        <a class="nav-link" href="#packages" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="packages">
          <i class="ni ni-app text-success"></i>
            <span class="navbar-heading text-muted"><b>Packages</b></span>            
        </a>
        <!-- Navigation -->
        <div class="collapse ml-4" id="packages">
          <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
            <a class="nav-link" href="packages">
              <i class="ni ni-app text-success"></i> View All Packages
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="mypackages">
              <i class="ni ni-app text-purple"></i> My Packages
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="military_packages">
              <i class="ni ni-app text-purple"></i> Pending Approvals
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-app text-red"></i> Liquidate a Package
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-app text-purple"></i> Request transfer of ownership
            </a>
          </li> -->
        <!--   <li class="nav-item">
            <a class="nav-link" href="profile">
              <i class="ni ni-app text-purple"></i> Subscribe a Package
            </a>
          </li> -->
        </ul>
        </div>
      </li>
       <li class="nav-item mb-md-3">
        <a class="nav-link" href="#others" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="others">
          <i class="ni ni-paper-diploma text-purple"></i>
            <span class="navbar-heading text-muted"><b>Others</b></span>            
        </a>
        <!-- Navigation -->
        <div class="collapse ml-4" id="others">
          <ul class="navbar-nav mb-md-3">
            <!-- <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-folder-17 text-success"></i> Join an Investment Group
            </a>
          </li> -->
          
          <?php 

        //   if($check_if_an_affiliate === null){

        //         echo '<li class="nav-item">
        //         <a class="nav-link" href="affilliate/signup?uid='.$uid.'">
        //         <i class="ni ni-paper-diploma text-yellow"></i> Become an Affliate
        //         </a>
        //         </li>';
                             

        //     }else{
        //         //go to a page where you can handle sessions before redirecting to affil home

        //          //echo  '<li class="nav-item">
        //       //  <a class="nav-link" href="./switch_to_affiliate?email='.$email.'&password='.$password.'">
        //       //  <i class="ni ni-palette text-info"></i> My Affliate Dashboard
        //       //  </a>
        //       //  </li>';
        //       echo  '<li class="nav-item">
        //         <a class="nav-link" href="./switch_to_affiliate?uid='.$uid.'">
        //         <i class="ni ni-palette text-info"></i> My Affliate Dashboard
        //         </a>
        //         </li>';
 


        //       }

          ?>
          <li class="nav-item">
            <a class="nav-link" href="notifications">
              <i class="ni ni-folder-17 text-success"></i>Notifications
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="https://wa.link/sjyryn">
              <i class="ni ni-folder-17 text-purple"></i>Chat with us
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="complaints">
              <i class="ni ni-folder-17 text-success"></i>Contact us
            </a>
          </li>

          <!-- <li class="nav-item">
            <a class="nav-link" href="complaints">
              <i class="ni ni-palette text-red"></i>Send complaint(s)
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="feedback">
              <i class="ni ni-palette text-success"></i>Send Feedback
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view_feedback_complaints">
              <i class="ni ni-palette text-success"></i>View Feedback/Complaints
            </a>
          </li>
          </ul>
        </div>
      </li>
       <li class="nav-item mb-md-3">
          <a class="nav-link" href="logout">
            <i class="ni ni-pin-3 text-info"></i> 
              <span class="navbar-heading text-muted"><b>Logout</b></span>
          </a>
      </li>

      
  </ul>
</div>



      </div>
    </div>
  </nav>