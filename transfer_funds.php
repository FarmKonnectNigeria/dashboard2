<?php include('includes/instantiated_files.php');
include('includes/header.php');
$get_transfer_access = $object->get_one_row_from_one_table('wallet_tbl','user_id',$uid);
$terms_n_conditions = $object->get_one_row_from_one_table('terms_n_conditions','conditions_for_what','wallet_to_wallet_transfer');
$get_benefiaries = $object->get_rows_from_one_table_by_id('transfer_log','sender_id', $uid);
// foreach ($get_benefiaries as $value) {
//   $get_user_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['beneficiary_id']);
//    $get_user_email['email'];
//    // $email = array($get_user_email['email']);

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
      <!-- Mask -->
      <span class="mask bg-gradient-success opacity-8"></span>
      <!-- Header container -->
      <?php
            if($get_transfer_access){
              if($get_transfer_access['transfer_access'] == 0){

            ?>
      <div class="container align-items-center">
        <div class="row"  style="margin-top: -20px;">
          <div class="col-lg-7 col-md-10">
            <h1 align="center" class="display-2 text-white" >Transfer Status: Inactive

                <span align="center" style="font-size: 15px;" class="display-2 text-white pl-3 ">You have not activated wallet-to-wallet transfer, click on the button below to activate.</span>
                <hr>
                <!-- Button trigger modal -->
                <button align="center" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
                Activate Funds Transfer
                </button>

            </h1>

<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Terms and conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo $terms_n_conditions['description'];?>
      <hr>
        <form id="terms_and_conditions">
          <input type="checkbox" name="terms_conditions" value='0' id="terms_conditions" required> <span>Agree to terms and conditions</span>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="activate_transfer_fund">Activate</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>

    </div>


          <?php
            } else if($get_transfer_access['transfer_access'] == 1){ ?>

              <div class="container align-items-center">
              <div class="row"  style="margin-top: -20px;">
              <div class="col-lg-7 col-md-10">
              <h1 align="center" class="display-2 text-white" >Activation request pending

              <span align="center" style="font-size: 15px;" class="display-2 text-white pl-3 ">Your request to activate wallet-to-wallet transfer has been recieved and will be attended to as soon as possible</span>
              <hr>
              <!-- Button trigger modal -->
              <button align="center" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollableeee" disabled>
                Pending Status
                
              </button>
              </h1>
            </div>
          </div>
        </div>

         <?php
            } else if($get_transfer_access['transfer_access'] == 3){ ?>


            
              <div class="container align-items-center">
              <div class="row"  style="margin-top: -20px;">
              <div class="col-lg-7 col-md-10">
              <h1 align="center" class="display-2 text-white" >Activation request Rejected

              <span align="center" style="font-size: 15px;" class="display-2 text-white pl-3 ">Your request to activate wallet-to-wallet transfer has been rejected, please contact FarmKonnect to know why</span>
              <hr>
              <!-- Button trigger modal -->
              <button align="center" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalScrollableeee" disabled>
                Rejected
              </button>


              </h1>
            </div>
          </div>
        </div>

            <?php }
            else if ($get_transfer_access['transfer_access'] == 2) {
              ?>
              <div class="container-fluid mt--7">
              <div class="row d-flex justify-content-center" style="margin-top: 70px;">
                  <div class="col-lg-7 col-md-10">
                    <div class="card bg-secondary shadow">
                      <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                          <div class="col-8">
                            <h3 class="mb-0">Transfer Funds</h3>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                          <div class="pl-lg-4">
                            <div style="font-size: 13px; color: red;">Please note that your funds transfer will take 24hours if your account has not been verified</div><br>
                            <form method="POST" id="transfer_funds_form">
                              <div class="form-group">
                                <label class="form-control-label email" for="input-first-name">Email Address of Beneficiary</label>
                               <!--  <select name="beneficiary" id="beneficiary" class="form-control form-control-alternative select_beneficiary">
                                </select> -->
                                <input type="text" name="beneficiary" class="form-control form-control-alternative" id=beneficiary>
                              </div>
                              <div class="form-group">
                                <label class="form-control-label" for="">Amount</label>
                                <input type="number" value=""  class="form-control form-control-alternative" name="amount" id="amount">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label" for="">Transfer Pin</label>
                                <input type="number" value=""  class="form-control form-control-alternative" name="transfer_pin" id="transfer_pin">
                              </div>
                            </form>
                            <button class="btn btn-primary" id="transfer_funds">Transfer Fund</button><br>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
          </div>


              <?php
            }
          }
          ?>
      
      </div>
     
       <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
 <script>
$(document).ready(function() {
  <?php foreach ($get_benefiaries as $value) {
  $get_user_email = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['beneficiary_id']);
   $get_user_email['email'];

?>
  var data = <?php echo json_encode($get_user_email['email']); ?>;
  console.log(data);
    $("#beneficiary").autocomplete({
        source: [data],
        // select: function( event, ui ) {
        //     event.preventDefault();
        //     $("#beneficiary").val(ui.item.id);
        // }
    });
  <?php } ?>
});
</script>
</body>