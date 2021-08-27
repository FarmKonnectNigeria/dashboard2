<?php 
include("includes/session.php");
  require_once("classes/db_class.php");
  include("includes/config.php");
  $object = new DbQueries();
  $get_unique_id = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Business Executive');
  @$def = $_GET['id'];
  @$referral = $_GET['referral_id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Farmkonnect
  </title>
  <!-- Favicon -->
  <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
</head>

<body class="bg-success">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="#">
   <!--        <img src="assets/img/brand/farmkonnect.png" class="fa-2x"> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="#">
                  <img src="assets/img/brand/farmkonnect.jpeg">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <h1>Business Executives' Registration Page</h1>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-white py-7 py-lg-8">
      <!-- <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Welcome!</h1>
              <p class="text-lead text-light">Use these awesome forms to login or create new account in your project for free.</p>
            </div>
          </div>
        </div>
      </div> -->
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-success" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8">
          <div class="card bg-secondary shadow border-3">
            <div class=" bg-transparent  pt-3">
              <div class="text-muted text-center "><img src="assets/img/brand/farmkonnect.jpeg" class="w-25"></div>
              <!-- <div class="btn-wrapper text-center">
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../assets/img/icons/common/github.svg"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../assets/img/icons/common/google.svg"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div> -->
            </div>
            <div class="card-body px-lg-3 py-lg-5">
              <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                      <form enctype="multipart/form-data" action="" method="post" id="register_be_form"> 
                      <div class="row">
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Surname</label>
                                  <input type="text" name="surname" id="surname" class="form-control">
                            </div>
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Other Names</label>
                                  <input type="text" name="other_names" id="other_names" class="form-control">
                            </div>
                         
                      </div><br>
                     <div class="row">
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Username</label>
                                  <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Email Address</label>
                                  <input type="text" name="email" id="email" class="form-control">
                            </div>
                         
                      </div><br>
                       <div class="row">
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Password</label>
                                  <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Confirm Password</label>
                                  <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                            </div>
                         
                      </div><br>
                      <div class="row">
                            <div class="col"> 
                              <label class="form-control-label" for="input-first-name">Gender</label><br>
                                  <select name="gender" id="gender" class="form-control">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                  </select>
                            </div>
                         
                      </div><br>

                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Home Address</label>
                              <textarea class="form-control " id="address" name="address" rows="10"></textarea>
                            </div>
                         
                      </div><br>
                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Phone Number</label>
                              <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                         <input type="hidden" name="role_id" id="role_id" value="<?php echo $get_unique_id['unique_id'];?>">
                          <input type="hidden" name="def" id="def" value="<?php echo $def;?>">
                           <input type="hidden" name="referral" id="referral" value="<?php echo $referral;?>">
                      </div><br>
                      
                      <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="register_be" name="register_be"  class="btn btn-sm btn-primary">Register</button>
                            </div>
                    </div>
                
                       </form>
                    </div>
                    <div class="col-lg-2"></div>
              </div>
            </div>
          </div>
          </div>
      </div>
    </div>
    <footer class="py-5">
      <div class="container">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              © 2019 <a href="#" class="font-weight-bold ml-1 text-light" >FarmKonnect</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core   -->
  <script src="assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="assets/js/argon-dashboard.min.js?v=1.1.0"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
  <script src="js/scripts.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>