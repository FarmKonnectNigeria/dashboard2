<?php  require_once('../classes/db_class.php');
       require_once('../includes/config.php');
    $object = new DbQueries();
   
    if(!isset($_GET['uid'])){
         header("location:./home");


    }else{
       $uid = $_GET['uid'];
  
    }
  
       $get_affilliate_type = $object->get_rows_from_one_table('affilliate_type');
    $get_user_info = $object->get_one_row_from_one_table('users_tbl','unique_id',$uid);
    $surname = $get_user_info['surname'];
    $other_names = $get_user_info['other_names'];
    $phone = $get_user_info['phone'];
    $email = $get_user_info['email'];
    $password = $get_user_info['password'];
    $uid = $get_user_info['unique_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>farmkonnect
  </title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
</head>

<body class="bg-success">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="#">
   <!--        <img src="../assets/img/brand/farmkonnect.png" class="fa-2x"> -->
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
                  <img src="../assets/img/brand/farmkonnect.png">
                </a>
               <!--  <a  href="#" >
                <img style="width: 140px; height: 130px;" src="../../assets/img/brand/farmkonnect.jpeg"   alt="...">
                </a> -->
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
           <h1>Affiliates Portal</h1>
          
          <ul class="navbar-nav ml-auto">
           <!--  <li class="nav-item">
              <a class="nav-link nav-link-icon" href="#">
                <i class="ni ni-planet"></i>
                <span class="nav-link-inner--text">Dashboard</span>
              </a>
            </li> -->
            <!--  <li class="nav-item">
              <a class="nav-link nav-link-icon" href="signup.php">
                <i class="ni ni-circle-08"></i>
                <span class="nav-link-inner--text text-success">Register</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="login.php">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-inner--text text-success">Login</span>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link nav-link-icon" href="#">
                <i class="ni ni-single-02"></i>
                <span class="nav-link-inner--text">Profile</span>
              </a>
            </li> -->
          </ul>
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

 <!--    <a  href="#" >
                <img style="width: 140px; height: 130px;" src="../../assets/img/brand/farmkonnect.jpeg"   alt="...">
                </a> -->

    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-3">
            <div class=" bg-transparent  pt-3">
              <div class="text-muted text-center "><img src="../assets/img/brand/farmkonnect.jpeg" style="width: 250; height: 170px;" class="w-25"></div>
              <!-- <div class="btn-wrapper text-center">
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../../assets/img/icons/common/github.svg"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../../assets/img/icons/common/google.svg"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div> -->
            </div>
            <div class="card-body px-lg-3 py-lg-5">
              <!-- <div class="text-center text-muted mb-4">
                <small>Or sign in with credentials</small>
              </div> -->
              <form role="form" id="aff_register_form" method="post" action="">
                 <div class="form-group row mb-3">
                  <div class="col">
                     <input class="form-control form-control-sm" readonly id="surname" value="<?php echo $surname; ?>" name="surname" placeholder="Surname" type="hidden">
                      <input class="form-control form-control-sm" value="<?php echo $other_names; ?>" name="other_names"  readonly id="other_names" placeholder="Firstname" type="hidden">
                    <input class="form-control form-control-sm" id="email"  readonly  value="<?php echo $email; ?>"   name="email" placeholder="Email" type="hidden">
                    <input class="form-control form-control-sm" id="phone"   readonly  value="<?php echo $phone; ?>"  name="phone" placeholder="Phone" type="hidden">
                    <input class="form-control form-control-sm" id="password"   readonly  value="<?php echo $password; ?>"  name="password" placeholder="password" type="hidden">
                    <input class="form-control form-control-sm" id="uid"   readonly  value="<?php echo $uid; ?>"  name="uid" placeholder="uid" type="hidden">

                    <input class="form-control form-control-sm" id="confirm_password"   readonly  value="<?php echo $password; ?>"  name="confirm_password" placeholder="confirm_password" type="hidden">
                    <input class="form-control form-control-sm" id="affilliate_type"   readonly  value="113e1bc8d672e5a5c17291107c4b0ll2"  name="affilliate_type" placeholder="" type="hidden">

                  </div>
                 

                </div>


              


                <div class="text-center">
                  <input type='submit' class="btn btn-success btn-lg btn-block register_affilliate" value="Become An Affilliate"/>
                </div>
              </form>
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
              © 2019 <a href="#" class="font-weight-bold ml-1 text-light" >Cloudware</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
             <li class="nav-item">
                <a href="#" class="nav-link text-light" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link text-light" target="_blank">Blog</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core   -->
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="../assets/js/argon-dashboard.min.js?v=1.1.0"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
  <script src="../js/scripts.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>