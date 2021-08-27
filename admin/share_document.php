<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_leads = $object->get_rows_from_one_table_by_id('leads','assigned_to', $uid);
$get_rows = $object->get_rows_from_one_table('package_category');
$get_packages = $object->get_rows_from_one_table('package_definition');
$get_document = $object->get_rows_from_one_table('admin_document_tbl');
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
              <h3 class="mb-0">Share Document </h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form enctype="multipart/form-data" action="" method="post" id="share_document_form"> 
                       <div class="row">
                            <div class="col-lg-10">
                                 <label class="form-control-label" for="input-first-name">Package</label>
                             <select name="package_plan" id="package_plan" class="form-control">
                                      <option value="">Select a package</option>
                                      <?php 
                                        foreach($get_packages as $value){
                                      ?>
                                    <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['package_name']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                      </div><br>
                     
                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Client (s)</label><br>
                                  <select class="js-example-basic-multiple col-lg-9" name="clients[]" multiple="multiple">
                                      <option value="Select Functions">Select Client (s)</option>
                                      <?php 
                                        foreach($get_leads as $value){
                                      ?>
                                      <option value="<?php echo $value['email']; ?>"><?php echo $value['fullname']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                         
                      </div><br>
                      <div class="row">
                            <div class="col-lg-10"> 
                              <label class="form-control-label" for="input-first-name">Document</label><br>
                                  <select class="form-control" name="document">
                                      <option value="Select Document">Select Document</option>
                                      <?php 
                                        foreach($get_document as $value){
                                      ?>
                                      <option value="<?php echo $value['image_url']; ?>"><?php echo $value['document_name']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                         
                      </div><br>
                    <div  id="display">
                      

                    </div>
                     
                      <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="share_document" name="share_document"  class="btn btn-sm btn-primary">Share Document
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