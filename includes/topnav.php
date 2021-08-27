 <style type="text/css">
 .notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: white;
  color: red;
  font-weight: bold;
}
  </style>
 <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="home">
          <?php if(basename($_SERVER['PHP_SELF'])  == 'home.php'  || basename($_SERVER['PHP_SELF'])  == 'home' ){ echo " Dashboard"; }
                if(basename($_SERVER['PHP_SELF'])  == 'profile.php' || basename($_SERVER['PHP_SELF'])  == 'profile'){ echo "My Profile"; }
                 if(basename($_SERVER['PHP_SELF'])  == 'packages.php' || basename($_SERVER['PHP_SELF'])  == 'packages'){ echo "All Sponsorship Packages"; }

               if(basename($_SERVER['PHP_SELF'])  == 'mypackages.php' || basename($_SERVER['PHP_SELF'])  == 'mypackages'){ echo "My Subscribed Sponsorship Packages"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'wallet.php' || basename($_SERVER['PHP_SELF'])  == 'wallet'){ echo "Wallet Page"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'credit_wallet_history.php' || basename($_SERVER['PHP_SELF'])  == 'credit_wallet_history'){ echo "Wallet Credit History"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'expense_history.php' || basename($_SERVER['PHP_SELF'])  == 'expense_history'){ echo "Expenses History"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'categories.php' || basename($_SERVER['PHP_SELF'])  == 'categories'){ echo "All Categories"; }


                 if(basename($_SERVER['PHP_SELF'])  == 'withdrawal_history.php' || basename($_SERVER['PHP_SELF'])  == 'withdrawal_history'){ echo "Withdrawal History"; }

                    if(basename($_SERVER['PHP_SELF'])  == 'withdrawal_requests.php' || basename($_SERVER['PHP_SELF'])  == 'withdrawal_history'){ echo "Withdrawal Requests"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'transaction_history.php' || basename($_SERVER['PHP_SELF'])  == 'withdrawal_history'){ echo "Transactions History"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'transaction_log.php' || basename($_SERVER['PHP_SELF'])  == 'transaction_log'){ echo "Transactions History"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'earnings_log.php' || basename($_SERVER['PHP_SELF'])  == 'wallet'){ echo "Earnings History"; }

                 if(basename($_SERVER['PHP_SELF'])  == 'pending_withdrawal.php' || basename($_SERVER['PHP_SELF'])  == 'pending_withdrawal'){ echo "Pending Withdrawals"; }


                  if(basename($_SERVER['PHP_SELF'])  == 'earnings_to_wallet.php' || basename($_SERVER['PHP_SELF'])  == 'earnings_to_wallet'){ echo "Earnings to Wallet"; }


                   if(basename($_SERVER['PHP_SELF'])  == 'wallet_withdrawal.php' || basename($_SERVER['PHP_SELF'])  == 'wallet_withdrawal'){ echo "Wallet Withdrawals"; }

                   if(basename($_SERVER['PHP_SELF'])  == 'documents.php' || basename($_SERVER['PHP_SELF'])  == 'documents'){ echo "My Documents"; }

                   if(basename($_SERVER['PHP_SELF'])  == 'access_card.php' || basename($_SERVER['PHP_SELF'])  == 'access_card'){ echo "Access Card"; }

                   if(basename($_SERVER['PHP_SELF'])  == 'transfer_funds.php' || basename($_SERVER['PHP_SELF'])  == 'transfer_funds'){ echo "Wallet Transfer"; }
                   
                   if(basename($_SERVER['PHP_SELF'])  == 'funds_transfer_history.php' || basename($_SERVER['PHP_SELF'])  == 'funds_transfer_history'){ echo "Transfer History"; }

                    if(basename($_SERVER['PHP_SELF'])  == 'complaints.php' || basename($_SERVER['PHP_SELF'])  == 'complaints'){ echo "Send Complaint"; }
                    
                  if(basename($_SERVER['PHP_SELF'])  == 'feedback.php' || basename($_SERVER['PHP_SELF'])  == 'feedback'){ echo "Send Feedback"; }

               


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
            <li>
            <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
           <?php 

          $get_notifications_number = $object->get_number_of_rows_two_params('notifications_tbl','user_id',$uid,'status', 0);

           if($verification_status == 0){?>
             <small style=" font-size: 10px; background: white; color: red; padding: 5px; border-radius: 5px; text-transform: uppercase; "><strong>Account Not Verified</strong></small>
           <?php }?>&nbsp;&nbsp;
             
             <li> <a href="#" class="nav-link nav-link-icon notification" id="mark_as_read">
              <span class="fa-stack fa-1x">
              <i class="fa fa-circle fa-stack-2x" style="color: black;"></i>
              <i class="fa fa-bell fa-stack-1x fa-inverse"></i>
              <!-- <i class="ni ni-bell-55" style="font-size: 20px"></i> -->
              <?php
                if(!$get_notifications_number == 0){
              ?>
              <!-- <sub style="color: white; background-color: red; padding: 2px; border-radius: 50px"><?php //echo $get_notifications_number;?></sub></a> -->
              <span class="badge" style="" id="badge"><strong><?php echo $get_notifications_number;?></strong></span>
            
            <?php }else{
              ?>
              <span class="badge" style="display: none" id="badge"><strong></strong></span>
              <?php
            } ?>
            </span>
             </li>

          </a>

          </li>
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="./assets/img/theme/team-4-800x800.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $fullname_user; ?>(Investor)</span>
                </div>
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
              <a href="profile" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Upload Profile Picture</span>
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
                <span>Withdraw Money</span>
              </a>
               <a href="wallet" class="dropdown-item">
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