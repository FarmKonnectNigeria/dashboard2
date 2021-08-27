<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
//$get_rows = $object->get_rows_from_one_table('package_category');
 ?>


<body class="">
  <?php include('includes/sidebar.php'); ?>
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
              <h3 class="mb-0">This allows you to send a referral request LEAD</h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form enctype="multipart/form-data" action="" method="post"> 
                    
                      
                        <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Message to Send</label>
                              <textarea class="form-control" id="" name="" rows="10"></textarea>
                            </div>
                         
                      </div><hr>
                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Add up emails of lead(s)<br><strong>Note:</strong>(use a comma or new line)</label>
                              <textarea class="form-control ckeditor" id="package_description" name="package_description" rows="10"></textarea>
                            </div>
                         
                      </div><br>
                       <div class="row">
                            <div class="col-lg-4"> 
                              
                              <input class="btn btn-sm btn-primary" id="cmd_send_to_lead" name="cmd_send_to_lead" value="Send to Lead(s)" rows="10" />
                            </div>
                         
                      </div><br>
                      
                     
                
                       </form>
                    </div>
                    <div class="col-lg-2"></div>
              </div>

                  <hr>
             

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
      <!-- Dark table -->
    <!--  <hr/><br> -->

         

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>