<?php include('includes/instantiated_files2.php');
 include('includes/header.php'); 
 $get_rows = $object->get_rows_from_one_table('package_category');

if(isset($_POST['cmd_update'])){
      $file_name = $_FILES['package_image']['name'];
      $size = $_FILES['package_image']['size'];
      $tmpName = $_FILES['package_image']['tmp_name'];
      $type = $_FILES['package_image']['type'];
      $package_id = $_POST['category_name_img'];


     $img_create = $object->update_category_image($package_id,$file_name, $size, $tmpName, $type);
     $img_dec = json_decode($img_create,true);

      if($img_dec['status'] == 1){
     $msg = "<div style='color:green;'>Image Update was successful&nbsp;&nbsp;<a href='view_categories'>Return to Categories</a></div>&nbsp;&nbsp;";
          
      }else{
        
        $msg = "<div style='color:red;'>".$img_dec['msg']."</div>&nbsp;&nbsp;";

      }
}

 ?>


<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <!-- <div class="header bg-gradient-default pb-8 pt-5 pt-md-8"  >
     
    </div> -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Update Category Image</h3>
              <?php 
                 if(!empty($msg)){
                    echo $msg;
                 }?>
            </div>
           
              
              <div class="row">

                    <div class="col-lg-2"> </div>
                    <div class="col-lg-8">
                      <form  enctype="multipart/form-data" action="" method="post" id="category_img_form"> 
                      <!-- <div class="form-group"> -->
                      
                        <label class="form-control-label" for="input-first-name">Select Category</label>
                        <!-- <input type="text" name="cat_name" id="cat_name"  class="form-control"> -->
                        <select class="form-control" name="category_name_img" id="category_name_img">
                            <option value="">Please select a category</option>
                            <?php  foreach($get_rows as $pack){?>
                             <option value="<?php echo $pack['unique_id']; ?>"><?php echo $pack['name']; ?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <div id="display_current_image_pack">
                          
                        </div>
                       <!--  <label class="form-control-label" for="input-first-name">Change Package Image:</label>
                        <input type="file"  id="package_image" value="<?php //echo explode("/",$pack['image_url'])[0]; ?>" name="package_image"  class="btn btn-sm btn-primary"> -->
                        <!-- <input type="submit" value="Create Package Category" id="cmd_create_cat" name="cmd_create_cat"  class="btn btn-sm btn-primary"> -->


                      <!-- </div> -->
                       </form>
                    </div>
                    <div class="col-lg-3"></div>
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