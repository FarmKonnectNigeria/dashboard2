<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 

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
              <h3 class="mb-0">Buy Package for Investor </h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form action="" method="post" id="buy_package_form"> 
                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Investor</label><br>
                                  <select class="form-control select-2 col-lg-12 " name="user_id" id="user_id">
                                      <option value="">Select Investor</option>
                                      <?php 
                                      $get_users = $object->get_rows_from_one_table('users_tbl');
                                        foreach($get_users as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['surname'].' '.$value['other_names']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                      </div><br>
                            <div class="row" class="show_package">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Package</label><br>
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
                    <div  id="display">
                      

                    </div>

                     
                      <!-- <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="share_document" name="share_document"  class="btn btn-sm btn-primary">Buy Package
                            </div>
                    </div> -->
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

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Buy Package for User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to proceed? Please Confirm
      </div>
      <div class="modal-footer">
        <button class="btn btn-success buy_package_for_user" id="buy_package_for_user" type="button">Buy Package</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>

    </div>
  </div>
</div>


      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
    

<script type="text/javascript"> 
  $(document).ready(function(){
    let package_state = 0;
    $("select#user_id").change(function(){
      //$("#display").empty();
      if($("select#user_id").children("option:selected").val() == ''){
        $("#display").empty();
      }else{
      $.ajax({
      url:"get_package_details.php",
      method:"POST",
      data:$('#buy_package_form').serialize(),
      // beforeSend: function(){
      //   $("#display").html("loading...");
      // },
      success:function(data){
        $("#display").empty();
        $("#display").html(data);
        if(package_state === 0) {
          $("div#display").hide();
        }
        //$('#buy_package_form').reset();
      }
      });
    }
    });
    $("select#package_id").change(function(){
      if($("select#user_id").children("option:selected").val() == ''){
        alert("Please select an investor and reselect the package");
      }else if($("select#package_id").children("option:selected").val() == ''){
        $("#display").empty();
      }
      else{
      $.ajax({
        url:"get_package_details.php",
        method:"POST",
        data:$('#buy_package_form').serialize(),
        beforeSend: function(){
        $("#spinner_class").html('Loading... <div class="spinner-border" role="status"></div>');
      },
        success:function(data){
          $("#spinner_class").empty();
          $("#display").empty();
          $("#display").html(data);
          package_state = 1;
          $("div#display").show();
          //$('#buy_package_form').reset();
        }
      });
    }
//}
    });
});
</script>

  