<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$getbalance = $object->get_one_row_from_one_table('accountant_wallet_tbl','admin_id', $uid);
$getuser = $object->get_rows_from_one_table('users_tbl');
//var_dump($getbalance);


//$get_term = $object->get_one_row_from_one_table('terms_n_conditions','conditions_for_what','bank_transfer');

//$get_account_details = $object->get_rows_from_one_table('bank_accounts');


?>
<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name != 'Accountant'){
    echo '<meta http-equiv="refresh" content="0; URL=no_access" />';
  }
  ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
   <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(./assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-success opacity-8"></span>
      <!-- Header container -->
      <div class="container align-items-center">
        <div class="row"  style="margin-top: -20px;">
          <div class="col-lg-7 col-md-10">
            <h1 align="center" class="display-2 text-white" >Wallet Balance<span>&#8358;<?php 
            if($getbalance != null){

                  echo number_format($getbalance['balance']) ; 

            }else{
                 echo '0'; 
            }


            ?>&nbsp;&nbsp;
              <hr>
              <button align="center" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
                Credit Investor's Wallet
                </button>

            </h1>

            <br>
           <!--  <span style="font-size: 20px;" class="display-2 text-white pl-3 ">Total income: &#8358;<?php //echo number_format($getbalance['balance']); ?></span><hr> -->
            <!-- Button trigger modal <hr>
 -->

<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Credit User's Wallet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="credit_investor_wallet_form">
          <div id="credit_wallet" class="credit_wallet">
              <select name="user_id" id="user_id" class="form-control" style="width: 100%;">
                  <option value="select_a_BE">Select a User</option>
                  <?php
                    foreach($getuser as $value){
                  ?>
                  <option value="<?php echo $value['unique_id']?>">
                    <?php echo $value['surname'].' '. $value['other_names'].' ('.$value['email'].')';?>
                  </option>
                  <?php } ?>
                </select><hr>
            <input type="text" name="amount" placeholder="enter amount" class="form-control"><br>
          <button type="button" class="btn btn-success" id="credit_investor_wallet">Credit Wallet</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>

    </div>
  </div>
</div>
          </div>
        </div>
      </div>
   
    </div>
    <!-- Page content -->
    <?php include('includes/footer.php'); ?>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
<!-- <script type="text/javascript">
  $(document).ready(function(){
    $("select#method_of_payment").change(function(){
        var method_of_payment = $(this).children("option:selected").val();
        if(method_of_payment == 'select_method'){
          $('.bank_transfer').css("display", "none");
        $('.credit_wallet').css("display", "none");
      }
        else if(method_of_payment == 'online_payment'){
          $('.bank_transfer').css("display", "none");
        $('.credit_wallet').css("display", "block");
      }
    });
});
</script> -->
<script type="text/javascript">
//   $(document).ready(function() {
//     $('.js-example-basic-single').select2();
// });
$(document).ready(function() {
  $("#user_id").select2({
    dropdownParent: $("#exampleModalScrollable")
  });
});
</script>