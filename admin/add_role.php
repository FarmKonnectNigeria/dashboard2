<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_rows = $object->get_rows_from_one_table('site_functions');
$get_pages = $object->get_rows_from_one_table('site_pages');
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
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">This is creation of a new role</h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form action="" method="post" id="add_role_form"> 
                      <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Role name </label>
                             <input type="text" name="role_name" id="role_name"  class="form-control">
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Role Description</label>
                              <textarea class="form-control ckeditor" id="role_description" name="role_description" rows="10"></textarea>
                            </div>
                         
                      </div><br>
                        <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Functions to be performed</label><br>
                                  <select class="js-example-basic-multiple col-lg-8" name="functions[]" multiple="multiple">
                                      <option value="Select Functions">Select Functions</option>
                                      <?php 
                                        foreach($get_rows as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['function_description']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                         
                      </div><br>
                        <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Pages that can be accessed</label><br>
                                  <select class="js-example-basic-multiple col-lg-8" name="pages[]" multiple="multiple">
                                      <option value="Select Pages">Select Pages</option>
                                      <?php 
                                        foreach($get_pages as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['page_name']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                      </div><br>

                      <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="add_role" name="add_role"  class="btn btn-sm btn-primary">Add Role</button>
                            </div>
                    </div>
                     
                
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
