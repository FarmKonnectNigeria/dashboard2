<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_rows = $object->get_rows_from_one_table('package_category');
 if(isset($_POST['create_package'])){
    $package_category_id = $_POST['category_id'];
    $filename =  $_FILES['file']['name'];
    $created_by = $uid;
    $table = 'package_category';
    $size =  $_FILES['file']['size'];
    $type =  $_FILES['file']['type'];
    $tmpName  = $_FILES['file']['tmp_name'];
    $package_name = $_POST['package_name'];
    $package_description = $_POST['package_description'];
    $slot = $_POST['slot'];
    $amount_per_slot = $_POST['amount_per_slot'];
    $interest_rate = $_POST['interest_rate'].'%';
    $no_of_month = $_POST['no_of_month'];
    $withdrawable_month = $_POST['withdrawable_month'];
    $max_no_of_month = $_POST['max_no_of_months'];
    $get_package_category = $object->get_one_row_from_one_table($table,'unique_id',$package_category_id);
    $package_category = $get_package_category['name'];
    $create_package = $object->insert_package($package_name, $withdrawable_month, $package_description, $package_category_id, $slot, $amount_per_slot, $interest_rate, $package_category, $no_of_month, $max_no_of_month, $created_by, $filename, $size, $tmpName, $type);
    $create_package_decode = json_decode($create_package, true);
    $msg = $create_package_decode['msg'];
    if($create_package_decode['status'] == '1'){ 
      echo "<script> alert('Package successfully created');
      window.location.href = 'view_packages';
      </script>";
   }else{
      echo "<script> alert(' ".$msg." ');
      </script>";
   }
 

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
              <h3 class="mb-0">This is creation of a package </h3>
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
                              <label class="form-control-label" for="input-first-name">Category</label>
                                  <select name="category_id" id="category_id" class="form-control">
                                      <option value="">select a package category</option>
                                      <?php 
                                        foreach($get_rows as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                         
                      </div><br>
                      <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Package Name</label>
                             <input type="text" name="package_name" id="package_name"  class="form-control">
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Description</label>
                              <textarea class="form-control ckeditor" id="package_description" name="package_description" rows="10"></textarea>
                            </div>
                         
                      </div><br>
                      <div class="row">
                            <div class="col-lg-6">
                                 <label class="form-control-label" for="input-first-name">No of Slot</label>
                                <input type="number" name="slot" id="slot"  class="form-control">
                            </div>
                            <div class="col-lg-6">
                                 <label class="form-control-label" for="input-first-name">Amount Per Slot</label>
                                  <input type="number" name="amount_per_slot" id="amount_per_slot"  class="form-control">

                            </div>

                      </div><br>
                      <div class="row">
                            <div class="col-lg-6">
                                 <label class="form-control-label" for="input-first-name">Interest Rate</label>
                                  <input type="number" name="interest_rate" id="interest_rate"  class="form-control">
                            </div>
                            <div class="col-lg-6">
                                  <label class="form-control-label" for="input-first-name">Min Number of Months</label>
                                 <input type="number" name="no_of_month" id="no_of_month"  class="form-control">
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-6">
                                   <label class="form-control-label" for="input-first-name">Max Number of Months</label>
                                    <input type="number" name="max_no_of_months" id="max_no_of_months"  class="form-control">
                            </div>

                            <div class="col-lg-6">
                                   <label class="form-control-label" for="input-first-name">Withdrawable Month</label>
                                    <input type="number" name="withdrawable_month" id="withdrawable_month"  class="form-control">
                            </div>

                            <div class="col-lg-6">
                                   <label class="form-control-label" for="input-first-name">Choose image</label>
                                    <input type="file" name="file" id="file"  class="form-control">

                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-6">
                                <input type="submit" value="Create Package" id="create_package" name="create_package"  class="btn btn-sm btn-primary">
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