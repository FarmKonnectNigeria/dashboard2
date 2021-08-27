<?php 
 include('includes/instantiated_files.php');
 require_once("classes/algorithm_functions.php");
 $total_investment = $object->get_total_investment($uid);
 $total_investment_decode = json_decode($total_investment,true);
 
 $accrued_profit = get_all_accrued_profits_per_user($uid);
 $accr_dec = json_decode($accrued_profit,true);

 $wallet_balance = $object->get_one_row_from_one_table('wallet_tbl','user_id',$uid);
 
 $my_latest_withdrawal = $object->my_latest_withdrawal($uid);
 $my_latest_withdrawal_decode = json_decode($my_latest_withdrawal,true);

 $my_latest_deposit = $object->my_latest_deposit($uid);
 $my_latest_deposit_decode = json_decode($my_latest_deposit,true);

 $my_total_deposit = $object->my_total_deposit($uid);
 $my_total_deposit_decode = json_decode($my_total_deposit,true);

 $my_total_withdrawal = $object->my_total_withdrawal($uid);
 $my_total_withdrawal_decode = json_decode($my_total_withdrawal,true);

 $referral_link = "https://$_SERVER[HTTP_HOST]"."/signup?ref=".$email;

 

include('includes/header.php'); ?>
<body class="">
  <style type="text/css">
    .facebook{
      background-color: #4267b2;
    }
    .twitter{
      background-color: #38A1F3;
    }
    .linkedin{
      background-color: #0077B5;
    }
    .whatsapp{
      background-color: #25D366;
    }
  </style>
    <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MBQLSJB"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

  <!-- Facebook Pixel Code -->
  <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '888713411536097');
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=888713411536097&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Facebook Pixel Code -->
  <!-- End Google Tag Manager (noscript) -->
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
          <!--<div class="row"> -->
          <!--  <div class="col-xl-12 col-lg-12">-->
          <!--    <div class="card card-stats mb-4 mb-xl-0">-->
          <!--      <div class="card-body">-->
          <!--        <a href="refer_someone">-->
          <!--        <div class="row">-->
          <!--          <div class="col-md-6">-->
          <!--            <h5 class="card-title text-uppercase text-muted mb-0">Referral Link</h5>-->
          <!--            <span class="h2 font-weight-bold mb-0"><a href="signup?ref=<?php //echo $email?>" style="font-size: 20px"><?php //echo $referral_link?></a></span>-->
          <!--          </div>-->
          <!--          <div class="col-md-6">-->
          <!--            <span class="mr-4 text-primary" style="font-size: 18px">-->
          <!--              Share Link On: -->
          <!--            </span>-->
          <!--            <div class="icon icon-shape text-white rounded-circle shadow mr-4 facebook">-->
          <!--              <a href="https://www.facebook.com/sharer/sharer.php?u=<?php //echo $referral_link;?>" class = "text-white"><i class="fab fa-facebook-f"></i></a>-->
          <!--            </div>-->
          <!--            <div class="icon icon-shape text-white rounded-circle shadow mr-4 twitter"><a href="https://twitter.com/intent/tweet?text=<?php //echo $referral_link;?>" class = "text-white"><i class="fab fa-twitter"></i></a>-->
          <!--            </div>-->
          <!--            <div class="icon icon-shape text-white rounded-circle shadow mr-4 linkedin"><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php //echo $referral_link;?>'&title=Sign%20Up%20on%20FarmKonnect%20with%20my%20referral%20link&summary=&source=" class = "text-white"><i class="fab fa-linkedin"></i></a>-->
          <!--            </div>-->
          <!--             <div class="icon icon-shape text-white rounded-circle shadow mr-4 whatsapp"><a href="whatsapp://send?text=<?php //echo $referral_link;?>" class = "text-white" data-action="share/whatsapp/share"><i class="fab fa-whatsapp"></i></a>-->
          <!--            </div>-->
          <!--          </div>-->
          <!--        </div>-->
          <!--      </a>-->
          <!--        <p class="mt-3 mb-0 text-muted text-sm">-->
                    <!-- <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span> -->
                    <!-- <span class="text-nowrap">Since yesterday</span> -->
          <!--        </p>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
          <!--<hr>-->

          <div class="row">
           
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                   <a href="wallet">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Wallet Balance</h5>
                      <span class="h2 font-weight-bold mb-0">&#8358;<?php echo number_format($wallet_balance['balance']); ?></span>
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
                   <a href="mypackages">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0"><!-- Sponsorships -->Total Subscription </h5>
                      <span class="h2 font-weight-bold mb-0">&#8358;<?php echo number_format($total_investment_decode['msg']); ?></span>
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

          
            <div class="col-xl-4 col-lg-6" >
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <a href="#">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Profit Accrued</h5>
                      <span class="h2 font-weight-bold mb-0">&#8358;<?php echo number_format($accr_dec['msg']);//number_format($profit_decode['total_profit']); ?></span>
                    </div>
                    <!-- <div class="col-auto">
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

                <hr>

           <div class="row">
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <a href="withdrawal_requests">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Recent Withdrawal</h5>
                      <span class="h2 font-weight-bold mb-0">&#8358;<?php echo number_format($my_latest_withdrawal_decode['msg']); ?></span>
                    </div>
                   <!--  <div class="col-auto">
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
                  <a href="transaction_history">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Recent Deposit</h5>
                      <span class="h2 font-weight-bold mb-0">&#8358;<?php echo number_format($my_latest_deposit_decode['msg']); ?>
                      </span>
                    </div>
                   <!--  <div class="col-auto">
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
                  <a href="withdrawal_requests">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Withdrawal</h5>
                      <span class="h2 font-weight-bold mb-0">&#8358;<?php echo  number_format($my_total_withdrawal_decode['msg']); ?></span>
                    </div>
                  <!--   <div class="col-auto">
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
                  <a href="transaction_history">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Deposit</h5>
                      <span class="h2 font-weight-bold mb-0">&#8358;<?php echo number_format($my_total_deposit_decode['msg']); ?></span>
                    </div>
                  <!--   <div class="col-auto">
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

             <div class="col-xl-4 col-lg-6">
              <a href="packages">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                 
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0"><a href="packages" class="btn btn-success btn-bg">Activate A Package</a></h5>
                     
                    </div>
                  <!--   <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div> -->
                  </div>

                 
                </div>
              </div>
            </a>
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