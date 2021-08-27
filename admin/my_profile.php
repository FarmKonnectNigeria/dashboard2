<?php include('includes/instantiated_files2.php');
include('includes/header.php'); ?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <?php include('includes/profile_dashboard.php'); ?>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row" style="margin-top: -300px;">
        <div class="col-xl-2"></div>

        <div class="col-xl-8 order-xl-1" >
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My Profile</h3>
                </div>
               <!--  <div class="col-4 text-right">
                  <a href="#" data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-sm btn-primary">Update Profile</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
              <form method="POST" id="teeeeest"> 
                <h6 class="heading-small text-muted mb-4">Basic Details
               
                 &nbsp;&nbsp;<span><a href="#" data-toggle="modal" data-target="#basic_det" class="btn btn-sm btn-success">Edit</a></span>

               </h6>
                <div class="pl-lg-4">
                 
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input type="text" value="<?php echo $other_names; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text" value="<?php echo $surname; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                  </div>
           <!--       </div> -->

                   <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Phone</label>
                        <input type="text" value="<?php echo $phone; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Home Address</label>
                        <input type="text" value="<?php echo $address; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label class="form-control-label">Email Address</label>
                      <input type="text" value="<?php echo $email; ?>" readonly class="form-control form-control-alternative">
                    </div>
                    <div class="col-md-6">
                      <label class="form-control-label">Gender</label>
                      <input type="text" value="<?php echo $gender; ?>" readonly class="form-control form-control-alternative">
                    </div>
                  </div><br>
               
              </form>
            </div>


                     </div>
                 </div>

          </div>
        </div>
      </div>
      <hr>
      <!-- Footer -->

       

       <!-- update basic profile modal starts here -->
        <div class="modal fade" id="basic_det" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Update Basic Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            
        <form method="POST" class="form" id="update_admin_profile_form">
          <div class="row">
              <div class="col-md-6">
              <label>Surname</label>
              <input type="text" class="form-control form-control-sm" value="<?php echo $surname; ?>" name="surname" id="surname">
              <!-- <input type="hidden" class="form-control form-control-sm" value="<?php echo 'update'; ?>" name="social_media_handle" id="social_media_handle"> -->
              </div>
              <div class="col-md-6">
              <label>Other Names</label>
              <input type="text" class="form-control form-control-sm"  value="<?php echo $other_names; ?>" name="other_names" id="other_names">
              </div>
          </div>
            <div class="row">
              <div class="col-md-6">
              <label>Phone</label>
              <input class="form-control form-control-sm" type="text" value="<?php echo $phone; ?>" id="phone" name="phone">
              </div>
              <div class="col-md-6">
              <label>Home Address</label>
              <input class="form-control form-control-sm" type="text" value="<?php echo $address; ?>" id="address" name="address">
              </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>Email Address</label>
              <input class="form-control form-control-sm" type="text" value="<?php echo $email; ?>" id="email" name="email">
              </div>
              <div class="col-md-6">
                <label>Gender</label>
                <select class="form-control form-control-sm" id="gender" name="gender">
                  <option value="select option">Select an Option</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
          </div><br>
          <button class="btn btn-sm btn-success"  id="update_admin_profile" type="button">Update now</a>
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success update_basic_profile">Update Now</button>
         --></div>
      </div>
        </div>
        </div>
       <!-- update basic profile modal ends here -->
   <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>