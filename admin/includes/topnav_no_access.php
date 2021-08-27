 <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="home">
          <?php if(basename($_SERVER['PHP_SELF'])  == 'home.php'  || basename($_SERVER['PHP_SELF'])  == 'home' ){ echo "Admin Dashboard"; }
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

                 if(basename($_SERVER['PHP_SELF'])  == 'withdrawal_request.php' || basename($_SERVER['PHP_SELF'])  == 'withdrawal_request'){ echo "Pending Withdrawal Request"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'documents.php' || basename($_SERVER['PHP_SELF'])  == 'documents'){ echo "documents"; }
               


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
       
        </ul>
      </div>
    </nav>

     <div class="header bg-gradient-success pb-8 pt-5 pt-md-8"  >
     
    </div>