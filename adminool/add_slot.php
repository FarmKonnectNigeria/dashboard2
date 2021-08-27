<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
if(isset($_POST['create_packages_cat'])){
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
          $msg = $create_package_category_decode['msg'];
          //echo $msg;
          if($create_package_category_decode['status'] == '1'){ 
          echo "<script> alert('Package category successfully created');
          window.location.href = 'view_categories';
          </script>";
          }else{
           echo "<script> alert(' ".$msg." ');
           </script>";
            
           // echo   '$.alert({ title: theme: 'light',animation: 'zoom', closeAnimation: 'left',content: "Your Profile has been updated Successfully" })';

           }


 } ?>


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
              <h3 class="mb-0">This is creation of a package category</h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                      <form enctype="multipart/form-data" action="" method="post"> 
                      <!-- <div class="form-group"> -->
                      
                        <label class="form-control-label" for="input-first-name">Category Name</label>
                        <input type="text" name="name" id="namehh"  class="form-control">
                        <br>
                         <textarea class="form-control ckeditor" id="descriptionhh" name="description" rows="10"></textarea>
                         <br>
                          <input type="file" value="" id="filehh" name="file"  class="form-control">
                          <br>
                           <input type="submit" value="Create Package Category" id="create_packages_cathh" name="create_packages_cat"  class="btn btn-sm btn-primary">


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