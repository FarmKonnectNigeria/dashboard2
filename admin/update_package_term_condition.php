<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_packages = $object->get_rows_from_one_table('package_definition');

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
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Update Packages Terms and conditions</h3>
            </div>
              
              <div class="row">
                    <!-- <div class="col-lg-2"></div> -->
                    <div class="col-lg-12">
                      <form method="post" id="update_package_term_condition_form"> 
                       <div class="row">
                            <div class="col-lg-12 pl-5 pr-5">
                                 <label class="form-control-label" for="input-first-name">Select Package</label>
                                     <select name="package_id" id="package_id" class="form-control select-2 col-lg-12 ">
                                      <option value="">Select a package</option>
                                      <?php 
                                        foreach($get_packages as $value){
                                      ?>
                                    <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['package_name']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                      </div><br>
                      <div id="spinner_class" class="text-center">
                        
                      </div>
                     
                      <div class="row">
                            <div class="col-lg-12 pl-5 pr-5"> 
                              <label class="form-control-label" for="input-first-name">Description</label>
                              <textarea class="form-control ckeditor" id="description" name="description" rows="10"></textarea>
                            </div>
                         
                      </div><br>
                      <div class="row">
                            <div class="col-lg-6 pl-5 pr-5">
                                <button name="" type="button" id="update_package_term_condition" class="btn btn-primary btn-sm" >Update</button>
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

<script type="text/javascript">
    // In your Javascript (external .js resource or <script> tag)
  $(document).ready(function() {
    //$('.js-example-basic-single').select2();
    $("select#package_id").change(function(){
      $.ajax({
        url:"get_package_term_condition.php",
        method:"POST",
        data:$('#update_package_term_condition_form').serialize(),
        beforeSend: function(){
        $("#spinner_class").html('Loading... <div class="spinner-border" role="status"></div>');
      },
        success:function(data){
          //$("#description").html(data);
       //    for ( instance in CKEDITOR.instances )
       // CKEDITOR.instances[instance].updateElement();
          //$("textarea#description").val(data);
          CKEDITOR.instances.description.setData(data);
          $("#spinner_class").empty();
          //CKEDITOR.instances['description'].setData(data);
        }
      });
    });
  });  
</script> 