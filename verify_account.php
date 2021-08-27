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
  
          
           

      <div class="container align-items-center">
        <div class="row"  style="margin-top: -20px;">
          <div class="col-lg-7 col-md-10">
            <h1 align="center" class="display-2 text-white" >Account Status: <?php 


            if($verification_status == 0){
                echo '<small style="color:red;">Not Verified</small>';
              
                $msg = '   <br><span align="center" style="font-size: 15px;" class="display-2 text-white pl-3 ">Kindly send the required documents to FarmKonnect to have your account verified.</span>';
            }else{
                echo '<small style="color:green;">Verified</small>';
                $msg = '   <br><span align="center" style="font-size: 15px;" class="display-2 text-white pl-3 ">Nice, your account has been verified.</span>';
            }

            if(!empty($msg)){
                echo $msg;
            }

              ?>

             
                <hr>
               

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


      </div>
     
       <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
 <script>

</script>
</body>