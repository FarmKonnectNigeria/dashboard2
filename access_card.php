<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
$get_card_access = $object->get_one_row_from_one_table('access_card_tbl','user_id',$uid);
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
              if($get_card_access['card_status'] == 0){


              ?>
            <h1 class="display-2 text-white" >Access Card
            <span style="font-size: 17px;" class="display-2 text-white pl-3 ">FarmKonnect requires Investors to submit a request for an access card. Click on the below button to request for an access card</span>
            <span style="font-size: 17px;" class="display-2 text-white pl-3 ">This may take up to 48hrs for processing
            </span><hr>
            <button type="button" class="btn btn-secondary" id="submit_request">Submit Access Card Request</button>
          <?php } ?>
          <?php
          if($get_card_access['card_status'] == 1){

          ?>
          <h1 class="display-2 text-white" >Access Card
          <span style="font-size: 17px;" class="display-2 text-white pl-3 ">FarmKonnect requires Investors to submit a request for an access card. Click on the below button to request for an access card</span>
            <span style="font-size: 17px;" class="display-2 text-white pl-3 ">Your card is being processed, this may take up to 48 hours
            </span><hr>
            <button type="button" class="btn btn-primary" disabled>
              Processing...
            </button>
            <span style="font-size: 17px;" class="display-2 text-white">Access Card Status: Processing</span>

          <?php } if($get_card_access['card_status'] == 3){

          ?>

          <h1 class="display-2 text-white" >Access Card
          <span style="font-size: 17px;" class="display-2 text-white pl-3 ">FarmKonnect requires Investors to submit a request for an access card. Click on the below button to request for an access card</span>
            <span style="font-size: 17px;" class="display-2 text-white pl-3 ">You request for an Access Card has been rejected, please contact FarmKonnect for more information
            </span><hr>
            <button type="button" class="btn btn-danger" disabled>
              Rejected
            </button>
            <span style="font-size: 17px;" class="display-2 text-white">Access Card Status: Rejected</span>
          <?php } ?>

          </div>
        </div>

          <?php
          if($get_card_access['card_status'] == 2){

          ?>
            <span style="font-size: 17px;" class="display-2 text-white">Access Card Status: Printed</span>
            <div class="row d-flex justify-content-center" style="margin-top: 70px;">
                  <div class="col-lg-8 col-md-11">
                    <div class="card bg-secondary shadow">
                      <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                          <div class="col-8">
                            <h3 class="mb-0">Access Card Status: &nbsp &nbsp <span class="text-success">Printed</span></h3>
                          </div>
                        </div>
                      </div>
                      <div class="card-body"> 
                          <div class="pl-lg-4">
                          <div class="row">
                          <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body text-center">
                                <img src="assets/img/theme/team-4.jpg" class="img-fluid z-depth-1 rounded-circle" alt="Responsive image">
                                <p class="text-center mt-4"><?php echo $fullname_user?><br><small class="text-center"><?php echo $email?> <br><?php echo $phone_number?></small></p>
                                <p class="text-center mt-4"><?php echo $home_address?></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <p>Your Access Card has been printed and Delivered to you.<br>You can deactivate the card from your portal by clicking on the button below</p>
                            <button class="btn btn-danger mt-4" data-toggle="modal" data-target="#exampleModalScrollable">Deactivate Card</button>
                          </div>
                        </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
          <?php } ?>

          <?php
          if($get_card_access['card_status'] == 4){

          ?>
            <span style="font-size: 17px;" class="display-2 text-white">Access Card Status: Printed</span>
            <div class="row d-flex justify-content-center" style="margin-top: 70px;">
                  <div class="col-lg-8 col-md-11">
                    <div class="card bg-secondary shadow">
                      <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                          <div class="col-8">
                            <h3 class="mb-0">Access Card Status: &nbsp &nbsp <span class="text-danger">Deactivated</span></h3>
                          </div>
                        </div>
                      </div>
                      <div class="card-body"> 
                          <div class="pl-lg-4">
                          <div class="row">
                          <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body text-center">
                                <img src="assets/img/theme/team-4.jpg" class="img-fluid z-depth-1 rounded-circle" alt="<?php echo $fullname_user?>">
                                <p class="text-center mt-4"><?php echo $fullname_user?><br><small class="text-center"><?php echo $email?> <br><?php echo $phone_number?></small></p>
                                <p class="text-center mt-4"><?php echo $home_address?></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <p>Your Access Card has been deactivated<br>You can reactivate your card by clicking on the button below</p>
                            <button class="btn btn-success mt-4" data-toggle="modal" data-target="#reactivate">Reactivate Card</button>
                          </div>
                        </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
          <?php } ?>
              <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalScrollableTitle">Deactivate Access Card</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to deactivate your access card?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" id="deactivate_card">Yes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                  </div>
                </div>
              </div>
              <div class="modal fade" id="reactivate" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalScrollableTitle">Reactivate Access Card</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to reactivate your access card?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" id="reactivate_card">Yes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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