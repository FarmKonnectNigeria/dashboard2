<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
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
                    <div class="container-fluid mt--7">
              <div class="row d-flex justify-content-center" style="margin-top: 70px;">
                  <div class="col-lg-7 col-md-10">
                    <div class="card bg-secondary shadow">
                      <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                          <div class="col-8">
                            <h3 class="mb-0">Change Inter-Wallet Transfer Pin</h3>
                          </div>
                        </div>
                      </div>
                      <div class="card-body"> 
                          <div class="pl-lg-4">
                            <div style="font-size: 13px; color: red;"><b>Please note that your tranfer pin has to be a 4-digit number</b></div><br>
                            <form method="POST" id="change_transfer_pin_form">
                              <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Old Pin</label>
                                <input type="password" name="old_pin" class="form-control form-control-alternative" id=old_pin>
                              </div>
                              <div class="form-group">
                                <label class="form-control-label" for="">New Pin</label>
                                <input type="password" value=""  class="form-control form-control-alternative" name="new_pin" id="new_pin">
                              </div>
                              <div class="form-group">
                                <label class="form-control-label" for="">Confirm New Pin</label>
                                <input type="password" value=""  class="form-control form-control-alternative" name="confirm_new_pin" id="confirm_new_pin">
                              </div>
                            </form>
                            <button class="btn btn-success" id="change_transfer_pin">Change Pin</button>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
        </div>
       
    </div>
<?php include('includes/footer.php'); ?>
</div>
 

 <?php include('includes/scripts.php'); ?>
</body>