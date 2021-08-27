<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_clients = $object->get_rows_from_one_table_by_id('leads','assigned_to', $uid);
$get_role_names = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Marketing Manager');
$role_right = $get_role_names['unique_id'] ; 
$get_MMs = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $role_right);
$get_BEs = $object->get_rows_from_one_table_by_id('business_executive_tbl', 'assigned_to', $uid);

?>


<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Marketing Manager'){
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
              <h3 class="mb-0">This is Transfer of a Client (s)</h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-9">
                      <form action="" method="post" id="transfer_be_form"> 
                      <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Business Executive to be transfered </label>
                             <select name="BE_id" id="BE_id" class="form_control col-lg-9 select-2">
                               <option value="">Select a Business Executive</option>
                               <?php
                                  foreach($get_BEs as $value){
                                  $get_be_details = $object->get_one_row_from_one_table('admin_tbl', 'unique_id', $value['unique_id']);
                               ?>
                               <option value="<?php echo $value['unique_id']?>">
                                <?php echo $get_be_details['surname'].' '. $get_be_details['other_names'];?></option>
                               <?php } ?>
                             </select>
                            </div>
                      </div><br>
                        <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Transfer To</label><br>
                                   <select name="transfer_to" id="transfer_to" class="form_control col-lg-9 select-2">
                                      <option value="">Select Marketing Manager to transfer to</option>
                                      <?php 
                                        foreach($get_MMs as $value){
                                          if($value['unique_id'] !== $uid){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['surname'].' '.$value['other_names']; ?></option>
                                    <?php } }?>

                                  </select>
                            </div>
                         
                      </div><br>
                       <div class="row">
                            <div class="col-lg-9"> 
                              <label class="form-control-label" for="input-first-name">Method of Transfer</label><br>
                                  <select class="form-control-sm col-lg-12" name="method_of_transfer" id="method_of_transfer">
                                      <option value="">Select method of transfer</option>
                                      <option value="transfer_with_clients">Transfer with Clients</option>
                                      <option value="transfer_without_clients">Transfer without Clients</option>
                                  </select>
                            </div>
                      </div><br>
                        <div class="row" id="show_this" style="">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Business Executive to transfer clients to </label>
                             <select name="transfer_clients_to" id="transfer_clients_to" class="form_control col-lg-9 select-2">
                               <option value="">Select a Business Executive to transfer Clients to</option>
                               <?php
                                  foreach($get_BEs as $value){
                                  $get_be_details = $object->get_one_row_from_one_table('admin_tbl', 'unique_id', $value['unique_id']);
                               ?>
                               <option value="<?php echo $value['unique_id']?>">
                                <?php echo $get_be_details['surname'].' '. $get_be_details['other_names'];?></option>
                               <?php } ?>
                             </select>
                            </div>
                      </div><br>

                      <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="transfer_be" name="transfer_be"  class="btn btn-sm btn-primary transfer_be">Transfer BE</button>
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

<script type="text/javascript">
  $(document).ready(function(){
    $('#show_this').hide();
    $("select#method_of_transfer").change(function(){
      var selected_option = $("select#method_of_transfer").children("option:selected").val();
      if(selected_option == 'transfer_without_clients'){
        $('#show_this').show();
      }else if(selected_option == 'transfer_with_clients'){
        $('#show_this').hide();
      }
    });
});
</script>
