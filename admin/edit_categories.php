<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

if(isset($_GET['catid'])){
   $catid = $_GET['catid'];
   $cat_details = $object->get_one_row_from_one_table('package_category','unique_id',$catid);

   

 } ?>


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
              <h3 class="mb-0">Editing Category: <?php echo $cat_details['name'];?>  <a href="view_categories.php" style="font-size: 12px;">back</a></h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                       <form method="post" id="update_category_form">
               
                              <div>Category Name: <input value="<?php echo $cat_details['name']; ?>" type="text" class="form-control form-control-sm" name="cat_name" id="cat_name"><input type="hidden" id="cat_id" name="cat_id" value="<?php echo $cat_details['unique_id']; ?>" class="form-control form-control-sm" ></div><br>
                                      <div><strong>Category Description:</strong></div>

                                      <textarea  class="form-control ckeditor" id="package_description" name="package_description"  cols="40" rows="10"><?php echo $cat_details['description'];?></textarea> <br>
                                      <input type="submit" name="cmd_edit_cat" id="cmd_edit_cat" value="Update Package Category" class="btn btn-sm btn-success">  
                     
       
                   
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