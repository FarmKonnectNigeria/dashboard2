<?php include('includes/instantiated_files.php');

if(isset($_post['create_packages_cat'])){
            $filename =  $_FILES['file']['name'];
            $created_by = $uid;
            $size =  $_FILES['file']['size'];
            $type =  $_FILES['file']['type'];
            $table = 'package_category';
            $name = $_POST['name'];
            $description = $_POST['description'];
            $tmpName  = $_FILES['file']['tmp_name'];
            $create_package_category = $object->insert_package_category($table, $name, $description,$created_by, $filename, $size, $tmpName, $type);
             $create_package_category_decode = json_decode($create_package_category, true);
     // $msg = $create_package_decode['msg'];
    if($create_package_category_decode['status'] == '1'){ 
      echo "<script> alert('Package category successfully created');
      window.location.href = 'view_packages_category';
      </script>";
   }else{
      echo "<script> alert('Error in creating package category');
      </script>";
   }
 // echo "teeeeear";
 } 

include('includes/header.php'); 


?>


<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-default pb-8 pt-5 pt-md-8"  >
     
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">This is creation of a package category</h3>
            </div>
              <form enctype="multipart/form-data" action="" method="post"> 
              <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Category Name</label>
                        <input type="text" name="name" id="name"  class="form-control form-control-sm">
                     

                      </div>
                    </div>
                    <div class="col-lg-3"></div>
              </div>

              <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                      <div class="form-group">
                          <label for="exampleFormControlTextarea1">Description</label>
                          <textarea class="form-control ckeditor" id="description" name="description" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
              </div>

              <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                      <div class="form-group">
                      
                        <input type="file" value="" id="file" name="file"  class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-3"></div>
              </div>
              <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                      <div class="form-group">
                     
                        <input type="submit" value="Create Package Category" id="create_packages_cat" name="create_packages_cat"  class="btn btn-sm btn-primary">
                      </div>
                    </div>
                    <div class="col-lg-3"></div>
              </div>
              </form>

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
     <hr/><br>

         

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php //include('includes/scripts.php'); ?>