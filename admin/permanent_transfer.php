<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_leads = $object->get_rows_from_one_table_by_id('leads','assigned_to', $uid);
$get_role_names = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Business Executive');
$role_right = $get_role_names['unique_id'] ; 
$get_BEs = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $role_right);

?>


<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name !=  'Business Executive'){
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
              <h3 class="mb-0">Transfers of Client(s)</h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-9">
                      <form action="" method="post" id="permanent_transfer_client_form"> 
                      <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Name of Business Executive to transfer Client (s) to </label>
                             <select name="BE_name" id="BE_name" class="select-2 form_control col-lg-9">
                               <option value="select_a_BE">Select a Business Executive</option>
                               <?php
                                  foreach($get_BEs as $value){
                                    if($value['unique_id'] !== $uid){
                               ?>
                               <option value="<?php echo $value['unique_id']?>">
                                <?php echo $value['surname'].' '. $value['other_names'];?></option>
                               <?php } } ?>
                             </select>
                            </div>
                      </div><br>
                        <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Client (s)</label><br>
                                  <select class="js-example-basic-multiple col-lg-9" name="clients[]" multiple="multiple">
                                      <option value="Select Functions">Select Client (s)</option>
                                      <?php 
                                        foreach($get_leads as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['fullname'].' ('.$value['email'].')'; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                         
                      </div><br>

                      <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="permanent_transfer_client" name="permanent_transfer_client"  class="btn btn-sm btn-primary">Transfer Client</button>
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
