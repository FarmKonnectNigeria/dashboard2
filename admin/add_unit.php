<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_rows = $object->get_rows_from_one_table('cctv_area');
 ?>


<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Super Administrator'){
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
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Add Unit</h3>
            </div>
              
              <div class="row">
                    <!-- <div class="col-lg-2"></div> -->
                    <div class="col-lg-12">
                      <form method="post" id="add_unit_form">
                      <div class="row">
                            <div class="col-lg-12 pl-5 pr-5"> 
                              <label class="form-control-label" for="input-first-name">Unit Area</label><br>
                                  <select class="form-control select-2 col-lg-12 " name="area_id" id="area_id">
                                      <option value="">Select Area</option>
                                      <?php 
                                        foreach($get_rows as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['area_name']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                      </div><br> 
                       <div class="row">
                        <div class="col-lg-12 pl-5 pr-5">
                        <label class="form-control-label" for="input-first-name">Unit Name</label>
                           <input type="text" name="unit_name" class="form-control">
                         </div>
                      </div><br>

                       <div class="row">
                        <div class="col-lg-12 pl-5 pr-5">
                        <label class="form-control-label" for="input-first-name">CCTV Link</label>
                           <input type="text" name="cctv_link" class="form-control">
                         </div>
                      </div><br>
                     
                      <div class="row">
                            <div class="col-lg-12 pl-5 pr-5"> 
                              <label class="form-control-label" for="input-first-name">Unit Description</label>
                              <textarea class="form-control ckeditor" id="unit_description" name="unit_description" rows="10"></textarea>
                            </div>
                         
                      </div><br>
                      <div class="row">
                            <div class="col-lg-6 pl-5 pr-5">
                                <button name="" type="button" id="add_unit" class="btn btn-primary btn-sm" >Add Unit</button>
                            </div>
                    </div>
                
                       </form>
                    </div>
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

         

      <br>
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>