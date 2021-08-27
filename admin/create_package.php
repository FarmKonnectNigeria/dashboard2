<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_rows_cat = $object->get_rows_from_one_table('package_category');
 if(isset($_POST['create_package'])){
       
      
//$msg = $_FILES['file']['name'];
//echo $msg;
     if( $_POST['package_type'] == '1' ){

      $file_name = $_FILES['file']['name'];
      $size = $_FILES['file']['size'];
      $tmpName = $_FILES['file']['tmp_name'];
      $type = $_FILES['file']['type'];

          $create_package = $object->create_fixed_package(
            $_POST['package_name'],
            $_POST['package_category'],
            $_POST['package_description'],
            $_POST['package_type'],
            $_POST['package_unit_price'],
            $_POST['min_no_slots'],
            $_POST['moratorium'],
            $_POST['free_liquidation_period'],
            $_POST['liquidation_surcharge'],
            $_POST['tenure_of_product'],
            $_POST['float_time'],
            $_POST['multiplying_factor'],
            $_POST['capital_refund'],
            $_POST['backdatable'],
            $_POST['no_of_slots'],
            $_POST['visibility'],
            $_POST['package_commission'],
            $_POST['created_by'],
            $file_name, 
             $size,
             $tmpName,
             $type
           );
          $create_package_decode = json_decode($create_package, true);
          $msg = $create_package_decode['msg'];
          if($create_package_decode['status'] == '1'){ 
          echo "<script> alert('Fixed Package: ".$_POST['package_name']." was successfully created');
          window.location.href = 'view_packages';
          </script>";
          }else{
          echo "<script> alert(' ".$msg." ');
          </script>";
          }
    

     }   

     else if( $_POST['package_type'] == '2' ){

          $file_name = $_FILES['file']['name'];
          $size = $_FILES['file']['size'];
          $tmpName = $_FILES['file']['tmp_name'];
          $type = $_FILES['file']['type'];

          $create_package2 = $object->create_recurrent_package(
            $_POST['recurrence_value'],
            $_POST['contribution_period'],
            $_POST['incubation_period'],
            $_POST['recurrence_type'],
            $_POST['package_name'],
            $_POST['package_category'],
            $_POST['package_description'],
            $_POST['package_type'],
            $_POST['package_unit_price'],
            $_POST['min_no_slots'],
            $_POST['moratorium'],
            $_POST['free_liquidation_period'],
            $_POST['liquidation_surcharge'],
            $_POST['tenure_of_product'],
            $_POST['float_time'],
            $_POST['multiplying_factor'],
            $_POST['capital_refund'],
            $_POST['backdatable'],
            $_POST['no_of_slots'],
            $_POST['visibility'],
            $_POST['package_commission'],
            $_POST['created_by'],
            $file_name, 
             $size,
             $tmpName,
             $type
           );
          $create_package_decode2 = json_decode($create_package2, true);
          $msg = $create_package_decode2['msg'];
          if($create_package_decode2['status'] == '1'){ 
          echo "<script> alert('Recurrent Package: ".$_POST['package_name']." was successfully created');
          window.location.href = 'view_packages';
          </script>";
          }else{
          echo "<script> alert(' ".$msg." ');
          </script>";
          }
    

     }

    else{

        $msg = "error found...";
         echo "<script> alert(' ".$msg." ');
          </script>";
     }

  

 } ?>


<body class="">
  <?php include('includes/sidebar.php'); 
//      if($role_name != 'Super Administrator' && $role_name!= 'Investment Manager'){
//     echo '<meta http-equiv="refresh" content="0; URL=no_access" />';
//   }
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
              <h3 class="mb-0">Creation of a package </h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <!-- enctype="multipart/form-data" -->
                      <form  action="" method="post"> 
                       <div class="row">
                            <div class="col-lg-10">
                                 <label class="form-control-label" >Package Name:</label>
                             <input required="" type="text" name="package_name" id="package_name"  class="form-control form-control-sm">
                            

                            </div>
                      </div><br>

                       <div class="row">
                            <div class="col-lg-5">
                                 <label class="form-control-label" >Category:</label>
                                 <select required="" class="form-control form-control-sm" name="package_category" id="package_category">
                                      <option value="">select category</option>
                                       <?php foreach($get_rows_cat as $cat){?>
                                          <option value="<?php echo $cat['unique_id']; ?>"><?php echo $cat['name']; ?></option>
                                        <?php } ?>
                                 </select>

                            </div>

                            <div class="col-lg-5">
                                 <label class="form-control-label" >Product Type:</label>
                                 <select required="" class="form-control form-control-sm" name="package_type" id="package_type">
                                      <option value="">select product type</option>
                                      <option value="1">Fixed</option>
                                      <option value="2">Recurrent</option>
                                       
                                 </select>

                            </div>

                      </div><br>

                       <div id="display" >
                            
                       </div><br>

                      
                      <div class="row">
                            <div class="col-lg-10">
                                 <label class="form-control-label" >Package Unit Price:</label>
                                 <input required="" type="texttext" name="package_unit_price" id="package_unit_price"  class="form-control form-control-sm">
                            </div>
                        <!--     <div class="col-lg-5">
                                 <label class="form-control-label" >Incubation Period:</label>
                                 <input required="" type="number" name="incubation_period" id="incubation_period"  class="form-control form-control-sm">
                            </div>
                             -->
                            

                      </div><br>

                      <div class="row">
                            <div class="col-lg-5">
                                 <label class="form-control-label" >Minimum No of slots:</label>
                                 <input required="" type="text" name="min_no_slots" id="min_no_slots"  class="form-control form-control-sm">
                            </div>
                            
                            <div class="col-lg-5">
                                 <label class="form-control-label" >Moratorium(in days):</label>
                                 <input  required="" type="text" name="moratorium" id="moratorium"  class="form-control form-control-sm">
                            </div>

                      </div><br>

                         <div class="row">
                            <div class="col-lg-5">
                                 <label class="form-control-label" >Free Liquidation Period(in days):</label>
                                 <input required="" type="text" name="free_liquidation_period" id="free_liquidation_period"  class="form-control form-control-sm">
                            </div>
                            
                            <div class="col-lg-5">
                                 <label class="form-control-label" >Liquidation Surcharge(%):</label>
                                 <input required="" type="text" name="liquidation_surcharge" id="liquidation_surcharge"  class="form-control form-control-sm">
                            </div>

                      </div><br>

                        <div class="row">
                            <div class="col-lg-5">
                                 <label class="form-control-label" >Tenure of Product: <br>Note: For Infinity, enter (<strong>inf</strong>)</label>
                                 <input required="" type="text" name="tenure_of_product" id="tenure_of_product"  class="form-control form-control-sm">
                                 <!-- <select name="tenure_of_product" id="tenure_of_product">
                                      <option value="1">Specific</option>
                                      <option value="2">Infinite</option>
                                 </select> -->
                            </div>

                            <!--  <div class="col-lg-5">
                                 <label class="form-control-label" >
                                 <input required="" type="number" name="tenure_of_product" id="tenure_of_product"  class="form-control form-control-sm">
                              
                            </div> -->

                            
                            <div class="col-lg-5">
                                 <label required=""class="form-control-label" >Float Time(in days):<br></label>
                                 <input  required="" type="text" name="float_time" id="float_time"  class="form-control form-control-sm">
                            </div>

                      </div><br>
                      
                       <div class="row">
                            <div class="col-lg-10">
                                 <label class="form-control-label" >Multiplying Factor:</label>
                                 <input required="" type="text" step="any" min="0.00000001" max="100" name="multiplying_factor" id="multiplying_factor"  class="form-control form-control-sm">
                            </div>
                        </div><br>
                    
                        <div class="row">
                            
                            
                            <div class="col-lg-5">
                                 <label class="form-control-label" >Capital Refund Drop Interval(Days)</label>
                                 <input required="" type="text" step="any" min="0.00000001" max="100" name="capital_refund_days" id="capital_refund_days"  class="form-control form-control-sm">
                            </div>
                            
                              <div class="col-lg-5">
                                 <label class="form-control-label" >Capital Refund Amount</label>
                                 <input required="" type="text" step="any" min="0.00000001" max="100" name="capital_refund" id="capital_refund"  class="form-control form-control-sm">
                            </div>
                            
                            
                            <!--<div class="col-lg-5">-->
                            <!--     <label class="form-control-label" >Capital Refund Amount</label>-->
                            <!--     <select required="" class="form-control form-control-sm" name="capital_refund" id="capital_refund">-->
                            <!--          <option value="">select capital refund type</option>-->
                            <!--          <option value="1">No Refund</option>-->
                            <!--          <option value="1">End of Tenure</option>-->
                            <!--          <option value="3">Spread Monthly</option>-->
                            <!--          <option value="4">Spread Quarterly</option>-->
                            <!--          <option value="5">Spread Yearly</option>-->
                                       
                            <!--     </select>-->
                            <!--</div>-->

                      </div><br>
                      
                       <div class="row">
                            <div class="col-lg-5">
                                 <label class="form-control-label" >Backdatable?</label>
                                 <select required="" class="form-control form-control-sm" name="backdatable" id="backdatable">
                                      <option value="">select an option</option>
                                      <option value="0">No</option>
                                      <option value="1">Yes</option>
                                      
                                       
                                 </select>
                            </div>

                            <div class="col-lg-5">
                                 <label class="form-control-label" >Total No of Available Slots:</label>
                                 <input type="text" required="" name="no_of_slots" id="no_of_slots"  class="form-control form-control-sm">
                            </div>
                         </div><br>
                       <div class="row">

                            <div class="col-lg-5">
                                 <label class="form-control-label" >Visibility:</label>
                                <select class="form-control form-control-sm" name="visibility" id="visibility" required="">
                                      <option value="">select an option</option>
                                      <option value="1">Yes</option>
                                      <option value="0">No</option>
                                      
                                      
                                       
                                 </select>
                            </div>

                             <div class="col-lg-5">
                                 <label class="form-control-label" >Commission(%):</label>
                                 <input type="text" name="package_commission" id="package_commission"  class="form-control form-control-sm">
                            </div>

                      </div><br>

                       <div class="row">
                            <div class="col-lg-10"> 
                              <label class="form-control-label" for="input-first-name">Description</label>
                              <textarea class="form-control ckeditor" id="package_description" name="package_description" rows="10"></textarea>
                            </div>
                         
                      </div><br>

                       <!-- <div class="row">
                      
                      <div class="col-lg-10">
                                   <label class="form-control-label" for="input-first-name">Choose image</label>
                                    <input type="file" name="file" id="file"  class="form-control form-control-sm">

                      </div>
                      </div><br> -->

                  <!--      <div class="row">
                            <div class="col-lg-10">
                                 <label class="form-control-label" for="input-first-name">Package Type:</label>
                                  <select name="package_type"  id="package_type"  class="form-control form-control-sm">
                                       <option value="">select a type</option>
                                       <option value="fixed">Fixed</option>
                                       <option value="recurrent">Recurrent</option>
                                  </select>
                            </div>
                      </div><br>
 -->

                    <!--   <div class="row" >
                           <div class="col-lg-10" id="display_category" style="width:80%;">
                             
                           </div> 
                      </div> -->
                      

                 <!--    <div class="row" >
                     
                       <div class="col-lg-10" id="rec">
                       <select id='package_plan_rec' name='package_plan_rec' class='form-control form-control-sm'>
                          <option value=''>Select a category</option>
                           <option value='basal_daily'>Basal Daily Plans</option>
                           <option value='basal_monthly'>Basal Monthly Plans</option>
                      </select>
                      </div>

                       <div class="col-lg-10" id="fix">
                       <select id='package_plan_fix' name='package_plan_fix' class='form-control form-control-sm'>
                          <option value=''>Select a category</option>
                           <option value='standard_packages'>Standard Packages</option>
                           <option value='term_packages'>Term Packages</option>
                      </select>
                      </div>


                    </div> -->

                      
                      
                   
                    <br>
                     
                      <div class="row">
                            <div class="col-lg-6">
                                <input type="submit" value="Create Package" id="create_package" name="create_package"  class="btn btn-md btn-primary">
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