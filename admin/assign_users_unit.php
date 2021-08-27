<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 

$get_area = $object->get_rows_from_one_table('cctv_area');
//$get_rows = $object->get_rows_from_one_table('package_category');
//$get_rows = $object->get_rows_from_one_table('package_category');
?>


<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name != 'Super Administrator'){
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
              <h3 class="mb-0">Assign Users to Unit </h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form action="" method="post" id="assign_users_unit_form"> 
                          <div class="row" class="show_area">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Area</label><br>
                             <select name="area_id" id="area_id" class="form-control select-2 col-lg-12 ">
                                      <option value="">Select an Area</option>
                                      <?php 
                                        foreach($get_area as $value){
                                      ?>
                                    <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['area_name']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                          </div><br>
                          <div id="spinner_class" class="text-center"></div>
                            <div class="row" class="show_unit">
                              <div class="col-lg-12"> 
                                <label class="form-control-label" for="input-first-name">Unit</label><br>
                                <select name="unit_id" id="unit_id" class="form-control select-2 col-lg-12 ">
                                  <option value="">Select a Unit</option>
                                </select>
                              </div>
                            </div><br>
                          <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Investor(s)</label><br>
                                  <select class="js-example-basic-multiple col-lg-12" name="user_id[]" multiple="multiple">
                                      <option value="Select Functions">Select Investor(s)</option>
                                       <?php 
                                      $get_users = $object->get_rows_from_one_table('users_tbl');
                                        foreach($get_users as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['surname'].' '.$value['other_names'].' ('.$value['email'].')' ; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                         
                      </div><br>
                    <div  id="display">
                      

                    </div>

                     
                      <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="assign_users_unit" name="assign_users_unit"  class="btn btn-sm btn-primary">Assign Users</button>
                                <button type="button" id="unassign_users_unit" name="assign_users_unit"  class="btn btn-sm btn-danger">Unassign Users</button>
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

<script type="text/javascript"> 
  $(document).ready(function(){
    $("select#area_id").change(function(){
      if($("select#area_id").children("option:selected").val() == ''){
        alert("Please select an area");
         $("#unit_id").empty();
      }
      else{
      $.ajax({
        url:"get_area_unit.php",
        method:"POST",
        data:$('#assign_users_unit_form').serialize(),
        beforeSend: function(){
        $("#spinner_class").html('Loading... <div class="spinner-border" role="status"></div>');
      },
        success:function(data){
          $("#spinner_class").empty();
          $("#unit_id").empty();
          $("#unit_id").html(data);
        }
      });
    }
//}
    });
});
</script>