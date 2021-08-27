<?php
include('includes/instantiated_files.php');
include('includes/header.php');

$payment_response = "<a href='wallet' style='font-size: 12px;'>Refresh Page</a>";

$payment_ref = 'trans_' . md5($object->unique_id_generator($uid . $fullname_userp . $email));
//$payment_ref = md5($object->unique_id_generator($uid.$fullname_userp.$email));


$getbalance = $object->get_one_row_from_one_table('wallet_tbl', 'user_id', $uid);
//var_dump($getbalance);


$get_term = $object->get_one_row_from_one_table('terms_n_conditions', 'conditions_for_what', 'bank_transfer');

$get_account_details = $object->get_rows_from_one_table('bank_accounts');

$total_investment = $object->get_total_investment($uid);

$expense_decode = json_decode($total_investment, true);

$count = 0;



// && isset($_GET['transaction_id'])
if(  isset($_GET['status']) ) {

    $status = $_GET['status'];
    $txn_ref = $_GET['tx_ref'];
    // $user_id = $_GET['user_id'];

    if($status == "cancelled"){
              $payment_response = "<small style='color:red;'>Payment was Cancelled...Please try again...<br>You can also click here to refresh<br><a href='wallet'>Click here</a></small>";
              $payment_response .= '<meta http-equiv="refresh" content="3; url=wallet">';
    }else if($status == "successful"){
       $transaction_id = $_GET['transaction_id'];
       $process_status = 2;
       $sub = $object->submit_flutter_payment($uid,$process_status,$transaction_id,$txn_ref);
       $sub_dec = json_decode($sub,true);
       if($sub_dec['status'] == 1){
           $payment_response = "<small style='color:green;'>Payment was successfully submitted and being processed...Your wallet will be updated shortly.</small>";
              $payment_response .= '<meta http-equiv="refresh" content="3; url=wallet">';
       }else{
           $payment_response = "<small style='color:red;'>".$sub_dec['msg']."</small>";
            $payment_response .= '<meta http-equiv="refresh" content="3; url=wallet">';
       }
             
    }else{
              $payment_response = "<small style='color:red;'>Payment cound not be completed...Please try again...<br>You can click here to refresh<br><a href='wallet'>Refresh here</a></small>";
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
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(./assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <!--<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">-->
        <span class="mask bg-gradient-success opacity-8"></span>
            <div class="container-fluid">
                <h1 align="center" class="display-2 text-white opacity-8">Wallet Balance: <span>&#8358;
                <?php
                    if ($getbalance != null) {
                        echo number_format($getbalance['balance']);
                    } 
                    else {
                        echo '0';
                    }
                ?>
                        <!--&nbsp;&nbsp;<span align="center"  style="font-size: 15px;" ><a style="color:white;" href="#">Total Income(Profits, Bonuses etc): &#8358;-->
                        <?php //echo number_format(250088);
            ?>
                        <!--</a></span> <span align="center"  style="font-size: 15px;" ><a href="#" style="color:white;">Total Expenses(Package Subscriptions etc): &#8358;-->
                        <?php //echo number_format(700088);
            ?></a>
                    </span>

                    <!--<button align="center" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollableCre">-->
                    <!--       credit wallet-->
                    <!--  </button>-->

                </h1>

                <!--//payment notification-->


                <div class="header-body">
                    
                    <!-- Modal -->
<div class="modal fade" id="inactivity" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">We just want to be sure you are still here</h3>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
        <!--  <span aria-hidden="true">&times;</span>-->
        <!--</button>-->
      </div>
      <div class="modal-body">
       
        <center>
            <a href="wallet" class="btn btn-lg btn-danger">Please Refresh Page</a>
        </center>
        
                


      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->

      <!--</div>-->

    </div>
  </div>
</div>

                    <div style="border-radius: 25px;background-color:white; padding:15px;" class="bank_transfer opacity-8">

                        <h3>
                            <?php if (!empty($payment_response)) {
                echo $payment_response;
                //$response
              } ?>
                        </h3>

                        <div class="row">
                            <div class="col-md-4 pr-5">
                                <h2>Pay Online With Flutterwave</h2>

                                <!--<select id="payment-gateway" class="form-control">-->
                                <!--    <option value="" selected disabled>Select Payment Gateway</option>-->
                                <!--    <option value="1">Flutterwave</option>-->
                                    <!--<option value="2">Remita</option>-->
                                <!--</select>-->
<!--id="Flutterwave"-->
                                <form method="POST" 
                                    action="https://checkout.flutterwave.com/v3/hosted/pay"><br>
                                    <input type="hidden" name="public_key"
                                        value="FLWPUBK-52f1a8646ee161743e2a919c16611c41-X" />
                                    <!--<input type="hidden" name="public_key" value=" <input type="hidden" name="public_key" value="FLWPUBK_TEST-089a69405c7e887073afb009c6909133-X" />-->
                                    <label>Enter Amount:</label><br>
                                    <input type="hidden" placeholder="email here" name="customer[email]"
                                        value="<?php echo $email; ?>" />
                                        
                                        
                                        <input type="hidden" placeholder="userid here" name="meta[userid]"
                                        value="<?php echo $uid; ?>" />
                                    
                                    
                                    <input type="hidden" placeholder="name here" name="customer[name]"
                                        value="<?php echo $fullname_user; ?>" />
                                    <input type="hidden" placeholder="ref here" name="tx_ref"
                                        value="<?php echo $payment_ref; ?>" />
                                    <input type="number" class='form-control form-control-sm' required=''
                                        placeholder="amount here" min="10" name="amount" value="" /><br>
                                    <input type="hidden" placeholder="currency here" name="currency" value="NGN" />
                                    <!-- <input type="text" placeholder="token" name="meta[token]" value="54" /><br> -->
                                    <input type="hidden" name="redirect_url" value="<?php echo $callback; ?>" />

                                    <input type="submit" name="cmd_submit" class="btn btn-sm btn-success"
                                        value="Credit Wallet">
                                </form>

                                <!--<form id="remita">-->
                                <!--    <label>Enter Amount</label>-->
                                <!--    <input type="number" placeholder="Amount" class="form-control" step="5" id="remita-amount">-->
                                <!--    <button type="button" disabled="disabled" class="btn btn-primary btn-sm"-->
                                <!--        id="remita-payment"> Pay-->
                                <!--    </button>-->
                                <!--</form>-->
                                <br>




                            </div>



                            <div class="col-md-8">

                                <h2>Payment Via Bank Transfer</h2>
                                <b><?php echo $get_term['description']; ?></b><br><br>
                                You can also make payment to any of the banks below:
                                            <?php
                            if ($get_account_details == null) {
                              echo "No Bank Account available, please contact FarmKonnect for more details";
                            } else {
                            ?>
                            <select class="form-control" id="select_bank_details">
                                <option value="">Select bank</option>
                            <?php
                              foreach ($get_account_details as $value) {
                            ?>  
                                    <option value="<?php echo $value['bank_name'];?>"><?php echo $value['bank_name'];?></option>
                                <?php }
                             } ?>
                             </select><br>
                             <div id="bank_details"></div>

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

    <script src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js">
    </script>

    <script>
    
   $(document).ready(function() { 
            setInterval(function() {
                //window.location.reload();
                $('#inactivity').modal("show");
            }, 60000); 
   });  
//   216000000
    
    function makePayment(amount) {
        var paymentEngine = RmPaymentEngine.init({
            key: 'QzAwMDAyNTg1NjJ8Mjk5NzQwMHwxNmY5MWU2YTllNWYxYmNjOGIyODNkOTNlMDZjMTg1M2U2MWI0ZDRmYjQ1OTMxODhhZWI1NGMwNDVkNTFiOWQzMzBhZDZlNTI0MTBiOWY2NGM5MTk5ZTczYjAwZTU0MzA2ZDFkYTc4MjMzOGFjYjg5MWY0MmMxN2ViODRkNTAxMA==',
            customerId: "<?= @$_SESSION['uid']; ?>",
            firstName: "<?= @$fullname_user; ?>",
            lastName: " ",
            email: "<?= @$email; ?>",
            amount: amount,
            narration: 'Wallet Credit On Farmkonnect Investment Portal',
            onSuccess: function(response) {
                console.log('Callback Successful Response', response);

                const txn_ref = response.paymentReference;
                const txn_id = response.transactionId;
                const amount_paid = response.amount;
                const status = 1;

                if (amount_paid > amount) {

                    $.ajax({
                        url: "ajax_scripts/pay-with-remita.php",
                        method: "POST",
                        data: {
                            amount: amount,
                            user_id: '<?= @$_SESSION["uid"]; ?>',
                            txn_ref: txn_ref,
                            txn_id: txn_id,
                            status: status
                        },
                        success: function(data) {
                            console.log(data);
                            data = JSON.parse(data);

                            console.log(data);

                            var status = data.status;

                            if(status == '1') {
                                $.alert({
                                    title: '<span style="color:green;">Success!</span>',
                                    theme: 'light',
                                    animation: 'zoom',
                                    closeAnimation: 'left',
                                    content: data.msg
                                });
                                
                                setTimeout( 
                                    function(){ 
                                        window.location.reload();
                                    }, 3000);

                            } else {
                                $.alert({
                                    title: '<span style="color:red;">Success!</span>',
                                    theme: 'light',
                                    animation: 'zoom',
                                    closeAnimation: 'left',
                                    content: data.msg
                                });
                            }

                        }
                    });
                }
            },
            onError: function(response) {
                console.log('callback Error Response', response);

                const txn_ref = response.paymentReference;
                const txn_id = response.transactionId;
                const amount_paid = response.amount;
                const status = 2;

                if (amount_paid > amount) {

                    $.ajax({
                        url: "ajax_scripts/pay-with-remita.php",
                        method: "POST",
                        data: {
                            amount: amount,
                            user_id: '<?= @$_SESSION["uid"]; ?>',
                            txn_ref: txn_ref,
                            txn_id: txn_id,
                            status: status
                        },
                        success: function(data) {
                            console.log(data);
                            data = JSON.parse(data);

                            console.log(data);

                            var status = data.status;

                            if(status == '1') {
                                $.alert({
                                    title: '<span style="color:green;">Success!</span>',
                                    theme: 'light',
                                    animation: 'zoom',
                                    closeAnimation: 'left',
                                    content: data.msg
                                });
                                
                                setTimeout( 
                                    function(){ 
                                        window.location.reload();
                                    }, 3000);

                            } else {

                            }

                        }
                    });
                }
            },
            onClose: function() {
                console.log("closed");
            }
        });

        paymentEngine.showPaymentWidget();
    }
    $('document').ready(function() {


        $('#remita').hide();
        $('#Flutterwave').hide();


        $('#payment-gateway').change(function() {


            const gateway = $(this).val();

            if(gateway == 1) {

                $('#Flutterwave').show();
                $('#remita').hide();

            }

            if(gateway == 2) {
                $('#remita').show();
                $('#Flutterwave').hide();
            }

        });

        $('#remita-amount').keyup(function() {

            const amount = $(this).val();

            if (amount > '100') {
                $('#remita-payment').removeAttr('disabled');
            }

        });

        $('#remita-payment').click(function(e) {
            e.preventDefault();

            const amount = $('#remita-amount').val();

            if (amount == '') {

                return false;

            }

            makePayment(amount)


        });
        $("select#select_bank_details").change(function(){
            if($("select#select_bank_details").children("option:selected").val() == ''){
                $("#bank_details").empty();
                alert("Please select an option");
            }else{
                var selected_bank = $("select#select_bank_details").children("option:selected").val();
                $.ajax({
                url:"get_bank_details.php",
                method:"POST",
                data:{selected_bank: selected_bank},
                beforeSend: function(){
                $("#bank_details").html('Loading...');
              },
                success:function(data){
                  //$("#spinner_class").empty();
                  $("#bank_details").empty();
                  $("#bank_details").html(data);
                }
              });
            }
        })
    });
    </script>
    <?php include('includes/scripts.php'); ?>