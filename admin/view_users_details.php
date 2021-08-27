<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 
?>


<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name != 'Investment Manager' && $role_name != 'CRM' && $role_name != 'Cash officer' && $role_name != 'Accountant'){
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
              <h3 class="mb-0"> View User's Details</h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form action="" method="post" id="view_users_details_form"> 
                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Investor</label><br>
                                  <select class="form-control select-2 col-lg-12 " name="user_id" id="user_id">
                                      <option value="">Select Investor</option>
                                      <?php 
                                      $get_users = $object->get_rows_from_one_table('users_tbl');
                                        foreach($get_users as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['surname'].' '.$value['other_names'].' '.$value['email'].' '.$value['phone'] ; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                      </div><br>
                    </form>
                  </div>
                  </div>
                  <div class="col-lg-2"></div>
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
                    
<div class="modal fade bd-example-modal-md" id="undo<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Undo Package Subscription</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Are you sure you want to proceed?
                      </div>
                      <div class="modal-footer">
                       <button type="button" class="btn btn-success undo_package_sub" id="<?php echo $value['unique_id'] ;?>">Yes</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      </div>
                        <form method="post" id="undo_package_sub_form<?php echo $value['unique_id'] ;?>">
                        <input type="hidden" name="total_amount" value="<?php echo $value['total_amount'] ;?>">
                        <input type="hidden" name="no_of_slots_bought" value="<?php echo $value['no_of_slots_bought'] ;?>">
                        <input type="hidden" name="investment_id" value="<?php echo $value['unique_id'] ;?>">
                        <input type="hidden" name="user_id" value="<?php echo $value['user_id'] ;?>">
                        <input type="hidden" name="package_id" value="<?php echo $package_id;?>">
                      </form>
                    </div>
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
      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>

<script type="text/javascript"> 
  $(document).ready(function(){
    $("select#user_id").change(function(){
      $.ajax({
        url:"ajax_admin/get_user_details.php",
        method:"POST",
        data:$('#view_users_details_form').serialize(),
        beforeSend: function(){
        $("#spinner_class").html('Loading... <div class="spinner-border" role="status"></div>');
      },
        success:function(data){
          $("#spinner_class").empty();
          $("#display").empty();
          $("#display").html(data);
          package_state = 1;
          $("div#display").show();
          //$('#view_users_details_form').reset();
        }
      });
//}
    });
});
</script>