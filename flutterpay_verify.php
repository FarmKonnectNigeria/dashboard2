<?php include('includes/session.php');
   require_once('classes/db_class.php');
   include('includes/header.php');
     //class object
   $object = new DbQueries();


// && isset($_GET['transaction_id'])
if(  isset($_GET['status']) ) {

    $status = $_GET['status'];
    $txn_ref = $_GET['tx_ref'];
    // $user_id = $_GET['user_id'];

    if($status == "cancelled"){
              $payment_response = "<small style='color:red;'>Payment was Cancelled...Please try again...<br>You can also click here to refresh<br><a href='wallet'>Click here</a></small>";
              $payment_response .= '<meta http-equiv="refresh" content="12; url=wallet">';
    }else if($status == "successful"){
       $transaction_id = $_GET['transaction_id'];
       $process_status = 2;
       $sub = $object->submit_flutter_payment($process_status,$transaction_id,$txn_ref);
       $sub_dec = json_decode($sub,true);
       if($sub_dec['status'] == 1){
           $payment_response = "<small style='color:green;'>Payment was successfully submitted and being processed...Your wallet will be updated shortly.</small>";
              $payment_response .= '<meta http-equiv="refresh" content="12; url=wallet">';
       }else{
           $payment_response = "<small style='color:red;'>".$sub_dec['msg']."</small>";
            $payment_response .= '<meta http-equiv="refresh" content="12; url=wallet">';
       }
             
    }else{
              $payment_response = "<small style='color:red;'>Payment cound not be completed...Please try again...<br>You can click here to refresh<br><a href='wallet'>Refresh here</a></small>";
              $payment_response .= '<meta http-equiv="refresh" content="12; url=wallet">';
    }

   

  
    }else{
          $payment_response = "<a href='wallet'  style='color:red;'>Oops! Return to Wallet Page</a>";
            
    }
   
  


?>

<body class="">
    <?php include('includes/sidebar.php'); ?>
    <div class="main-content">
        <!-- Navbar -->
        <?php //include('includes/topnav2.php'); ?>
        <!-- End Navbar -->
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(./assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <!--<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">-->
        <span class="mask bg-gradient-success opacity-8"></span>
            <div class="container-fluid">
             

                <!--//payment notification-->


                <div class="header-body">
                    


                    <div style="border-radius: 25px;background-color:white; padding:15px;" class="bank_transfer opacity-8">

                     

                        <div class="row">
                            <div class="col-md-12 pr-5">
                                <a href="wallet" style="font-size: 11px;">Return to Wallet Page</a>
                                <h2>Flutterwave Payment Status:</h2><br>
                                <span>
                                <?php if (!empty($payment_response)) {
                                         echo $payment_response;
                                         //$response
                                          } ?>
                                          
                                </span>
                            </div>
                        </div>



                    </div>







                </div>

            </div>
        </div>
        <hr>
        <div class="container-fluid mt--7">
            <!-- Table -->

        </div>

    </div>
    <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    <!--   Core   -->

  

   
    <?php include('includes/scripts.php'); ?>