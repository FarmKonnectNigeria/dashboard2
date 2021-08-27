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
 <style type="text/css">
    .facebook{
      background-color: #4267b2;
    }
    .twitter{
      background-color: #38A1F3;
    }
    .linkedin{
      background-color: #0077B5;
    }
  </style>

    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8"  >
     <div class="row"  style="">
          <div class="col-lg-7 col-md-10 ml-5">
            <h3 class="display-2 text-white"><span style="font-size: 30px;"><strong>Hello <?php echo $fullname_user; ?></strong></span></h3>
            <p class="text-white mt-0 mb-5">Your referral link is below, the link can be shared across Social Media Platforms</p>
          </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style=""> 
        <div class="col">

          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-2">Your referral link is:</h3>
            </div>
            <span class="h2 font-weight-bold mb-5 ml-4"><a href="signup?ref=<?php echo $email?>" style="font-size: 20px"><?php echo 'signup?ref='.$email?></a></span>
              <center><div class="col-auto mb-5">
                      <span class="mr-4 text-primary" style="font-size: 18px">
                        Share Link On: 
                      </span>
                      <div class="icon icon-shape text-white rounded-circle shadow mr-4 facebook">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=app.farmkonnectng.com/signup.php?ref=<?php echo $email?>" class = "text-white"><i class="fab fa-facebook-f"></i></a>
                      </div>
                      <div class="icon icon-shape text-white rounded-circle shadow mr-4 twitter"><a href="https://twitter.com/intent/tweet?text=app.farmkonnectng.com/signup.php?ref=<?php echo $email?>" class = "text-white"><i class="fab fa-twitter"></i></a>
                      </div>
                      <div class="icon icon-shape text-white rounded-circle shadow mr-4 linkedin"><a href="https://www.linkedin.com/shareArticle?mini=true&url=app.farmkonnectng.com/signup.php?ref='<?php echo $email?>'&title=Sign%20Up%20on%20FarmKonnect%20with%20my%20referral%20link&summary=&source=" class = "text-white"><i class="fab fa-linkedin"></i></a>
                      </div>
                    </div></center>
            </div>
            <div class="card-footer py-4">
              <!-- <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav> -->
            </div>
          </div>
        </div>
      </div>
      
          
      <br>
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>

  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
  </script>