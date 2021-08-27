<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_users = $object->get_rows_from_one_table('users_tbl');
$get_rows = $object->get_rows_from_one_table('package_category');
$get_packages = $object->get_rows_from_one_table('package_definition');
// $get_document = $object->get_rows_from_one_table('admin_document_tbl');
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
              <h3 class="mb-0">Broadcast Message </h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
                <small class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#view22">View all users email</small>
            </div>

            <div class="modal fade" id="view22" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">All Users email</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <button class="btn btn-sm btn-primary" id="copy_button" onclick="myFunction()">Copy All</button>
                    <div class="mt-3">
                      <textarea class="form-control" rows="50" id="copy_email">
                        <?php $object->view_user_email();?>
                      </textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form enctype="multipart/form-data" action="" method="post" id="broadcast_message_form"> 
                        <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Recipient</label><br>
                             <select class="form-control select-2 col-lg-12 " name="recipient" id="recipient">
                                      <option value="">Select Receipient</option>
                                    <option value="all_users">All Users</option>
                                    <option value="select_from_package">Filter By Package</option>
                                    <option value="select_from_category">Filter By Package Category</option>
                                    <option value="specific_recipients">Specific Recipient</option>
                                  </select>
                            </div>
                      </div><br>
                       <div class="row" id="show_package" style="">
                            <div class="col-lg-12" >
                                 <label class="form-control-label" for="input-first-name">Package</label><br>
                             <select class="js-example-basic-multiple form-control" name="package_id[]" id="package_id" multiple="multiple">
                                      <option value="">Select a package</option>
                                      <?php 
                                        foreach($get_packages as $value){
                                      ?>
                                    <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['package_name']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                      </div>
                      

                      <div class="row" id="show_category" style="">
                            <div class="col-lg-12" > 
                              <label class="form-control-label" for="input-first-name">Category</label><br>
                                  <select class="form-control select-2 col-lg-12 " name="package_category" id="package_category">
                                      <option value="">Select a package category</option>
                                      <?php 
                                        foreach($get_rows as $value){
                                      ?>
                                    <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                         
                      </div>
                     
                      <div class="row" id="show_users"  style="">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Users</label><br>
                                  <select class="js-example-basic-multiple form-control " name="users[]" id="users" multiple="multiple" >
                                      <option value="">Select User(s)</option>
                                      <?php 
                                        foreach($get_users as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['surname'].$value['other_names'].' ('.$value['email'].')'; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                      </div>
                      <br><div class="row">
                        <div class="col-lg-12">
                          <label class="form-control-label" for="input-first-name">Subject</label><br>
                          <input type="text" name="subject" class="form-control">
                        </div>
                      </div>

                      <br><div class="row">
                        <div class="col-lg-12">
                          <label class="form-control-label" for="input-first-name">Message</label><br>
                          <textarea class="form-control ckeditor" id="editor1" name="editor1" rows="10"></textarea><br>
                        </div>
                      </div>
                     
                      <br><div class="row">
                        <div class="col-lg-6">
                            <button type="button" id="broadcast_message" name="broadcast_message"  class="btn btn-sm btn-primary">Broadcast Message
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
  $(document).ready(function () {
//$('.dataTables_length').addClass('bs-select');
 $('div#show_package').hide()
    $('div#show_category').hide();
    $('div#show_users').hide();
$("select#recipient").change(function(){
  var selected_option = $("select#recipient").children("option:selected").val();
  if(selected_option == 'select_from_package'){
    $('div#show_package').show();
    $('div#show_category').hide();
    $('div#show_users').hide();
  }else if(selected_option == 'select_from_category'){
    $('div#show_package').hide();
    $('div#show_category').show();
    $('div#show_users').hide();
  }else if(selected_option == 'specific_recipients'){
    $('div#show_package').hide();
    $('div#show_category').hide();
    $('div#show_users').show();
  }else if(selected_option == 'all_users'){
    $('div#show_package').hide()
    $('div#show_category').hide();
    $('div#show_users').hide();
  }
  //alert("what naahhh");
});
});

function myFunction() {
  var copyText = document.getElementById("copy_email");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied!");
}
</script>
