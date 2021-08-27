<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
?>


<body class="">
  <?php include('includes/sidebar.php'); 
      if($role_name != 'Investment Manager'){
    echo '<meta http-equiv="refresh" content="0; URL=no_access" />';
  }
  ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
   <!--  <div class="header bg-gradient-default pb-8 pt-5 pt-md-8"  >
     
    </div> -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">SetUp Third Party Account</h3>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">
                      <form action="" method="post" id="create_third_party_account_form"> 
                       <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Surname</label>
                             <input type="text" name="surname" id="surname"  class="form-control form-control-sm">
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Other Names</label>
                             <input type="text" name="other_names" id="other_names"  class="form-control form-control-sm">
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Email Address</label>
                             <input type="text" name="email" id="email"  class="form-control form-control-sm">
                            </div>
                      </div><br>
                      <div class="row">
                        <div class="col-lg-10" id="fullname_input">
                          <label class="form-control-label" for="input-first-name">Phone Number</label>
                          <input type="text" name="phone" id="phone"  class="form-control form-control-sm">
                        </div>
                      </div><br>                    
                      <div class="row">
                        <div class="col-lg-6">
                            <button type="button" id="create_third_party_account" name="create_third_party_account"  class="btn btn-sm btn-primary">SetUp Account</button>  
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                
                       </form>
                    </div>
                    <div class="col-lg-2"></div>
              </div>


             

               <div class="card-footer py-4">
              <nav aria-label="...">
               <!--  <ul class="pagination justify-content-end mb-0">
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
                </ul> -->
              </nav>


          </div>
        </div>
      </div>
      <br>
         <br>
         <br>
      <!-- Dark table -->
    <!--  <hr/><br> -->

         

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>