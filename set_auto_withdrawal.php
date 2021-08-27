<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
$get_auto_withdrawal_status = $object->get_one_row_from_one_table('users_tbl','unique_id',$uid);
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
        <div class="row"  style="margin-top: -100px;">
          <div class="col-lg-7 col-md-10">
              <?php
              if($get_auto_withdrawal_status['auto_withdrawal_status'] == 0){


              ?>
            <h1 class="display-2 text-white" >Automatic Withdrawal
            <span style="font-size: 17px;" class="display-2 text-white pl-3 ">Your profit will automatically be processed to your bank account if this feature is activated</span>
            <span style="font-size: 17px;" class="display-2 text-white pl-3 ">Click on the button below to activate
            </span><hr>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal1">Activate</button>
          <?php } ?>
          <?php
          if($get_auto_withdrawal_status['auto_withdrawal_status']){

          ?>
          <h1 class="display-2 text-white">Automatic Withdrawal
          <span style="font-size: 17px;" class="display-2 text-white pl-3 ">You have already activated this feature.</span>  
          <span style="font-size: 17px;" class="display-2 text-white pl-3 ">Click on the button below to deactivate
            </span><hr>
            <button class="btn btn-danger" data-toggle="modal" data-target="#modal2">Deactivate</button>       
        <?php } ?>
      </div>
      <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Activate Automatic Withdrawal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to activate automatic withdrawal?
              <form id="activate_auto_withdrawal_form">
                <input type="hidden" name="user_id" value="<?php echo $uid;?>">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="activate_auto_withdrawal">Yes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>
      <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Reactivate Automatic Card</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to deactivate automatic withdrawal?
              <form id="deactivate_auto_withdrawal_form">
                <input type="hidden" name="user_id" value="<?php echo $uid;?>">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="deactivate_auto_withdrawal">Yes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
  </div>
</div>
 <?php include('includes/footer.php'); ?>
</div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>