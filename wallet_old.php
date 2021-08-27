<?php include('includes/instantiated_files.php');
include('includes/header.php'); 

$payment_response = "<a href='wallet' style='font-size: 12px;'>Refresh Page</a>";

$payment_ref = 'trans_'.md5($object->unique_id_generator($uid.$fullname_userp.$email));
//$payment_ref = md5($object->unique_id_generator($uid.$fullname_userp.$email));


$getbalance = $object->get_one_row_from_one_table('wallet_tbl','user_id', $uid);
//var_dump($getbalance);


$get_term = $object->get_one_row_from_one_table('terms_n_conditions','conditions_for_what','bank_transfer');

$get_account_details = $object->get_rows_from_one_table('bank_accounts');

$total_investment = $object->get_total_investment($uid);

$expense_decode = json_decode($total_investment,true);

$count = 0;


 
if(  isset($_GET['status'])  && isset($_GET['tx_ref'])  && isset($_GET['transaction_id'])  ){
     
     ///avoid duplicate
     //session_start();
     //$_SESSION['count'] = 1; 

    //check if that txn_ref exists
    //check success
    $payment_method = "flutter_rave";
    $deposit_date = date('Y-m-d H:i:s');
    $purpose = 11;
    $description = "Credited using flutterwave Rave";
    $status = $_GET['status'];
    $txn_ref = $_GET['tx_ref'];
    
    //this is the actual transaction id
    $transaction_id = $_GET['transaction_id'];
    
    if( $status == "cancelled" ){
        $payment_response = "<small style='color:red;'>Transaction was cancelled...You will be redirected in a moment...<br>You can also click here to refresh<br><a href='wallet'>Refresh here</a></small>";
        $payment_response .= '<meta http-equiv="refresh" content="3; url=wallet">';
    }
    else if($status == 'successful'){
        
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/".$transaction_id."/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer $seckey"
            ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            $payment_response_amount = json_decode($response,true)['data']['amount'];
            
            $resp_stat = json_decode($response,true)['status'];
            
            ///check if txn id exists
            $check_txn_id = $object->check_row_exists_by_one_param('credit_wallet_tbl','txn_ref',$txn_ref);
            
            if($check_txn_id){
            
                        $payment_response = "<small style='color:red;'>Duplicate payment detected...You will be redirected in a moment...<br>You can also click here to refresh<br><a href='wallet'>Refresh here</a></small>";
                        $payment_response .= '<meta http-equiv="refresh" content="3; url=wallet">';
                         
            
            }else{
                
                
                if($resp_stat == 'error'){
                     //malicious move...
                    $payment_response = "<small style='color:red;'>Payment was NOT Successful...You will be redirected in a moment...<br>You can also click here to refresh<br><a href='wallet'>Refresh here</a></small>";
                     $payment_response .= '<meta http-equiv="refresh" content="3; url=wallet">';
                }else{
                    
                    $insert_payment = $object->credit_wallet_online($uid,$payment_response_amount,$payment_method,$deposit_date,$purpose, $description,$txn_ref,$transaction_id);
                    $insert_payment_decode = json_decode($insert_payment, true);
                    echo json_encode(["status"=>$insert_payment_decode['status'], "msg"=>$insert_payment_decode['msg']]);
                    if($insert_request_decode['msg'] == 'success'){
                    $object->email_function($email, $subject, $content);
                    $object->insert_into_notifications_tbl($notification_type, $uid, $notification_heading, $notification);
                    $object->insert_users_logs($uid, 'Credited Wallet using Flutterwave Rave');
                    }
                    
                    $payment_response = "<small style='color:green;'>Payment was Successful...You will be redirected in a moment...<br>You can also click here to refresh<br><a href='wallet'>Refresh here</a></small>";
                    $payment_response .= '<meta http-equiv="refresh" content="3; url=wallet">';
                    
                    
                    
                }
                
                
                
                
            }
           
            

    }else{
           
           $payment_response = "<small style='color:red;'>Oops! Payment was NOT successful......You will be redirected in a moment...<br>You can also click here to refresh<br><a href='wallet'>Refresh here</a></small>";
            $payment_response .= '<meta http-equiv="refresh" content="3; url=wallet">';
    
        
    }



 
    
}

  


// else{
    
//     $payment_response = "<small style='color:red;'>Oops! Payment was NOT Successful...<br>Kindly refresh. <a href='wallet'>Refresh here</a></small>";

    
// }



?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
                 <h1 align="center" class="display-2 text-white" >Wallet Balance:  <span>&#8358;<?php 

            if($getbalance != null){
               
                  echo number_format($getbalance['balance']) ; 

            }else{
                 echo '0'; 
            }


            ?>
            <!--&nbsp;&nbsp;<span align="center"  style="font-size: 15px;" ><a style="color:white;" href="#">Total Income(Profits, Bonuses etc): &#8358;-->
            <?php //echo number_format(250088); ?>
            <!--</a></span> <span align="center"  style="font-size: 15px;" ><a href="#" style="color:white;">Total Expenses(Package Subscriptions etc): &#8358;-->
            <?php //echo number_format(700088); ?></a></span>
             
              <!--<button align="center" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollableCre">-->
              <!--       credit wallet-->
              <!--  </button>-->

            </h1>
            
            <!--//payment notification-->
               
             
             <div class="header-body">
                          
                        <div style="border-radius: 25px;background-color:white; padding:15px;" class="bank_transfer">
                            
                            <h3>
                            <?php if(!empty($payment_response)){ echo $payment_response;
                                //$response
                            }?>
                            </h3>
                           
                           <div class="row">
                               <div class="col-md-4 pr-5">
                                <h2>Pay Online</h2> 
                                
                                <form method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay"><br>
                                <input type="hidden" name="public_key" value="FLWPUBK-52f1a8646ee161743e2a919c16611c41-X" />
                                 <!--<input type="hidden" name="public_key" value=" <input type="hidden" name="public_key" value="FLWPUBK_TEST-089a69405c7e887073afb009c6909133-X" />-->
                                <label>Enter Amount:</label><br>
                                <input type="hidden" placeholder="email here" name="customer[email]" value="<?php echo $email; ?>" />
                                <input type="hidden" placeholder="name here" name="customer[name]" value="<?php echo $fullname_user; ?>" />
                                <input type="hidden" placeholder="ref here" name="tx_ref" value="<?php echo $payment_ref; ?>" />
                                <input type="number" class='form-control form-control-sm' required='' placeholder="amount here" min="10" name="amount" value="" /><br>
                                <input type="hidden" placeholder="currency here" name="currency" value="NGN" />
                                <!-- <input type="text" placeholder="token" name="meta[token]" value="54" /><br> -->
                                <input type="hidden" name="redirect_url" value="<?php echo $callback; ?>" />
                                
                                <input type="submit" name="cmd_submit" class="btn btn-sm btn-success" value="Credit Wallet"> 
                                </form>
                                
                                <br>
                                
                                
                                
                                
                               </div>
                               
                               
                               
                               <div class="col-md-8">
                                       
                                    <h2>Payment Via Bank Transfer</h2>
                                    <b><?php echo $get_term['description']; ?></b><br><br>
                                    You can also make payment by using the following methods:
                                    <?php
                                    if($get_account_details == null){
                                    echo "No Bank Account available, please contact FarmKonnect for more details";
                                    }else{
                                    foreach ($get_account_details as $value) {
                                    ?>
                                    <br>
                                    <b>Bank Name:</b> <?php echo $value['bank_name']; ?><br>
                                    <b>Account No:</b> <?php echo $value['account_number']; ?><br> 
                                    <b>Account name:</b>  <?php echo $value['account_name']; ?> <br>
                                    <b>Account Type:</b>  <?php echo $value['account_type']; ?><br>
                                    <?php } }?>
                                    <br>
                                    You can also pay using USSD.
                                       
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