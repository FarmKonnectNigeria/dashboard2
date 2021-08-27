<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_rows = $object->get_rows_from_one_table('package_category');
 
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
              <h3 class="mb-0">This is addition of a lead </h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form enctype="multipart/form-data" action="" method="post" id="add_leads_form"> 
                      <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Full Name</label>
                             <input type="text" name="fullname" id="fullname"  class="form-control">
                            </div>
                      </div><br>
                      <div class="row">
                          <div class="col-lg-6">
                                 <label class="form-control-label" for="input-first-name">Email</label>
                                <input type="email" name="email" id="email"  class="form-control">
                            </div>
                            <div class="col-lg-6">
                                 <label class="form-control-label" for="input-first-name">Phone</label>
                                <input type="number" name="phone" id="phone"  class="form-control">
                            </div>

                      </div><br>
                      <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Location and Source of Lead</label>
                                  <select name="location_source" class="form-control select-2" id="location_source">
                                    <option value="select option"> Select Option</option>
                                    <option value="Twitter">Twitter</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                    <option value="FB">Facebook</option>
                                    <option value="Referrals">Referrals</option>
                                    <option value="Uber">Uber</option>
                                    <option value="Taxify">Taxify</option>
                                    <option value="Direct Marketing">Direct Marketing</option>
                                    <option value="Others">Others (specify)</option>  
                                  </select>
                                  <br><br>
                                  <div class="row">
                                    <div id="others" class="col-lg-6" style="display: none;">
                                      <input type="text" name="other_location" class="form-control" placeholder="Please Specify">
                                    </div>
                                  </div>
                            </div></div><br>
                            <div class="row">
                            <div class="col-lg-12">
                                  <label class="form-control-label" for="input-first-name">Classification of leads </label><br>
                                  <select name="classification" class="form-control select-2">
                                    <option value="select option"> Select Option</option>
                                    <option value="raw lead">Raw Lead</option>
                                    <option value="lead">Lead</option>
                                    <option value="prospect">Prospect</option>
                                    <option value="client">Client</option>
                                  </select>
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-12">
                                  <label class="form-control-label" for="input-first-name">Interest Level </label><br>
                                  <select name="interest_level" class="form-control select-2">
                                    <option value="select option"> Select Option</option>
                                    <option value="1">One Star</option>
                                    <option value="2">Two Stars</option>
                                    <option value="3">Three Stars</option>
                                    <option value="4">Four Stars</option>
                                    <option value="5">Five Stars</option>

                                  </select>
                            </div>
                      </div><br>
                      <button class="btn btn-sm btn-primary" type="button" id="add_lead">Add Lead</button>
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
      <!-- Dark table -->
    <!--  <hr/><br> -->

         

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("select#location_source").change(function(){
        var location = $(this).children("option:selected").val();
        if(location == 'Others'){
        $('#others').css("display", "block");
      }
    });
});
</script>