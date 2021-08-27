<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="home">
          <?php 

          if(basename($_SERVER['PHP_SELF'])  == 'view_leads.php' || basename($_SERVER['PHP_SELF'])  == 'view_leads'){ echo "My Leads"; }

          if(basename($_SERVER['PHP_SELF'])  == 'view_prospects.php' || basename($_SERVER['PHP_SELF'])  == 'view_prospects'){ echo "My Prospects"; }

           if(basename($_SERVER['PHP_SELF'])  == 'view_referrals.php' || basename($_SERVER['PHP_SELF'])  == 'view_referrals'){ echo "My Referrals"; }


          if(basename($_SERVER['PHP_SELF'])  == 'home.php'  || basename($_SERVER['PHP_SELF'])  == 'home' ){ echo "Affiliate Dashboard"; }
                if(basename($_SERVER['PHP_SELF'])  == 'profile.php' || basename($_SERVER['PHP_SELF'])  == 'profile'){ echo "My Profile"; }
                 if(basename($_SERVER['PHP_SELF'])  == 'packages.php' || basename($_SERVER['PHP_SELF'])  == 'packages'){ echo "All Packages"; }

               if(basename($_SERVER['PHP_SELF'])  == 'mypackages.php' || basename($_SERVER['PHP_SELF'])  == 'mypackages'){ echo "My Subscribed Packages"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'wallet.php' || basename($_SERVER['PHP_SELF'])  == 'wallet'){ echo "Wallet Page"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'credit_wallet_history.php' || basename($_SERVER['PHP_SELF'])  == 'credit_wallet_history'){ echo "Wallet Credit History"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'expense_history.php' || basename($_SERVER['PHP_SELF'])  == 'expense_history'){ echo "Expenses History"; }


                 if(basename($_SERVER['PHP_SELF'])  == 'withdrawal_history.php' || basename($_SERVER['PHP_SELF'])  == 'withdrawal_history'){ echo "Withdrawal History"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'transaction_log.php' || basename($_SERVER['PHP_SELF'])  == 'transaction_log'){ echo "Transactions History"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'earnings_log.php' || basename($_SERVER['PHP_SELF'])  == 'wallet'){ echo "Earnings History"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'view_users.php' || basename($_SERVER['PHP_SELF'])  == 'view_users'){ echo "All Active Users"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'view_investors.php' || basename($_SERVER['PHP_SELF'])  == 'view_investors'){ echo "All Active Investors"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'view_investments.php' || basename($_SERVER['PHP_SELF'])  == 'view_investments'){ echo "All Investments"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'view_packages.php' || basename($_SERVER['PHP_SELF'])  == 'view_packages'){ echo "All Packages"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'view_categories.php' || basename($_SERVER['PHP_SELF'])  == 'view_categories'){ echo "All Packages Categories"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'create_package_category.php' || basename($_SERVER['PHP_SELF'])  == 'create_package_category'){ echo "Create Package Categories"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'create_package.php' || basename($_SERVER['PHP_SELF'])  == 'create_package'){ echo "Create Package"; }
                 if(basename($_SERVER['PHP_SELF'])  == 'packages_slot_log.php' || basename($_SERVER['PHP_SELF'])  == 'packages_slot_log'){ echo "Packages Slot Log"; }


               


            ?>
               

         </a>
        
        <!-- Form -->
        <!-- <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto"> -->
        <!--   <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form> -->
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src=".././assets/img/theme/team-4-800x800.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $fullname_user; ?>(<?php echo $get_affiliate_level; ?>)</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="#" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Profile</span>
              </a>
              <a href="#" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Help</span>
              </a>
              <a href="#" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>My Files</span>
              </a>
              <a href="#" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Transfer Money</span>
              </a>
               <a href="#" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Withdraw Money</span>
              </a>
               <a href="#" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Credit Wallet</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

     <div class="header bg-gradient-success pb-8 pt-5 pt-md-8"  >
     
    </div>