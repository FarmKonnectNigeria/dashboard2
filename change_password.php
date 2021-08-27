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
                            <h3 class="mb-0">Change Password</h3>
                          </div>
                        </div>
                      </div>
                      <div class="card-body"> 
                          <div class="pl-lg-4">
                            <form method="POST" id="change_password_user_form">
                              <div class="form-group">
                                <label class="form-control-label email" for="input-first-name">Old Password</label>
                                <input type="password" name="old_password" class="form-control form-control-alternative" id=password>
                              </div>
                              <div class="form-group">
                                <label class="form-control-label email" for="input-first-name">New Password</label>
                                <input type="password" name="password" class="form-control form-control-alternative" id=password>
                              </div>
                              <div class="form-group">
                                <label class="form-control-label" for="">Confirm Password</label>
                                <input type="password" value=""  class="form-control form-control-alternative" name="confirm_password" id="confirm_password">
                              </div>
                            </form>
                            <button class="btn btn-primary" id="change_password_user">Change Password</button>
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