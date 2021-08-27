<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 

?>


<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name != 'Investment Manager'){
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
              <h3 class="mb-0">Edit Investor's Sensitive Details</h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form action="" method="post" id="edit_sensitive_details_form"> 
                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Investor</label><br>
                                  <select class="form-control select-2 col-lg-12 col-md-10" name="user_id" id="user_id">
                                      <option value="">Select Investor</option>
                                      <?php 
                                      $get_users = $object->get_rows_from_one_table('users_tbl');
                                        foreach($get_users as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['surname'].' '.$value['other_names'].' ('.$value['email'].')' ; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                      </div><br>
                        <div class="row" class="inforamtion">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Information to Edit</label><br>
                             <select name="information_to_edit" id="information_to_edit" class="form-control select-2 col-lg-12 col-md-10">
                                <option value="">Select an Options</option>
                                <option value="email">Email Address</option>
                                <option value="phone">Phone Number</option>
                                <option value="both">Both Phone Number and Email</option>
                              </select>
                            </div>
                      </div><br>    
                      <div class="row" id="email_info">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Email Address</label><br>
                             <input type="text" name="email" id="email" class="form-control">
                            </div>
                      </div>   
                      <div class="row" id="phone_info">
                            <div class="col-lg-12">
                              <label class="form-control-label" for="input-first-name">Phone Number</label><br>
                              <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                      </div>                    
                      <br><div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="edit_sensitive_details" class="btn btn-sm btn-primary">Edit
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
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>

<script type="text/javascript"> 
  $(document).ready(function(){
    $("div#email_info").hide();
    $("div#phone_info").hide();
    $("select#information_to_edit").change(function(){
      var selected_option = $("select#information_to_edit").children("option:selected").val();
      if(selected_option == ''){
        $("div#email_info").hide();
        $("div#phone_info").hide();
      }else if(selected_option == 'email'){
        $("div#email_info").show();
        $("div#phone_info").hide();
      }else if(selected_option == 'phone'){
        $("div#email_info").hide();
        $("div#phone_info").show();
      }else if(selected_option == 'both'){
        $("div#email_info").show();
        $("div#phone_info").show();
      }
  });
  });
</script>