<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$get_rows = $object->get_rows_from_one_table('leads');
$get_package = $object->get_rows_from_one_table('package_definition');

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
              <h3 class="mb-0">Invoice Request for Client </h3>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">
                      <form action="" method="post" id="request_invoice_form"> 
                       <div class="row">
                        <div class="col-lg-10">
                           <label class="form-control-label" for="input-first-name">Select Option</label>
                                  <select name="select_option" id="select_option" class="form-control">
                                      <option value="">select an option</option>
                                      <option value="existing">Existing Recipient</option>
                                      <option value="new">New Recipient</option>
                                  </select>
                          </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-10 select_client" id="">
                           <label class="form-control-label" for="input-first-name">Select Client</label>
                                  <select name="select_client" id="select_client" class="form-control">
                                      <option value="">select a client</option>
                                      <?php 
                                        foreach($get_rows as $value){
                                      ?>
                                    <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['fullname'].' ('.$value['email'].')'; ?></option>
                                    <?php } ?>
                                  </select>
                          </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Fullname</label>
                             <input type="text" name="fullname" id="fullname"  class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-10" id="address_input">
                                 <label class="form-control-label" for="input-first-name">Address</label>
                             <textarea name="address" id="address" class="form-control" rows="10" cols="10"></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-10" id="package_bought_input">
                                 <label class="form-control-label" for="input-first-name">Package Purchased</label>
                                 <select name="package_bought" id="package_bought" class="form-control">
                                      <option value="">select a package</option>
                                      <?php 
                                        foreach($get_package as $value){
                                      ?>
                                    <option value="<?php echo $value['package_name']; ?>"><?php echo $value['package_name']; ?></option>
                                    <?php } ?>
                                  </select>
                             <!-- <input type="text" name="package_bought" id="package_bought"  class="form-control"> -->
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-10" id="quantity_input">
                                 <label class="form-control-label" for="input-first-name">Slot</label>
                             <input type="number" name="quantity" id="quantity"  class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-10" id="email_input">
                                 <label class="form-control-label" for="input-first-name">Email Address</label>
                             <input type="email" name="email" id="email"  class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-10" id="phone_input">
                                 <label class="form-control-label" for="input-first-name">Mobile Phone</label>
                             <input type="number" name="phone" id="phone"  class="form-control">
                            </div>
                      </div><br>
                     
                      <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="request_invoice" name="request_invoice"  class="btn btn-sm btn-primary request_invoice">Request Invoice</button>  
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
    $('.select_client').hide();
    $('#fullname_input').hide();
    $('#address_input').hide();
    $('#package_bought_input').hide();
    $('#quantity_input').hide();
    $('#email_input').hide();
    $('#phone_input').hide();

    $("select#select_option").change(function(){
        var selected_option = $(this).children("option:selected").val();
        if(selected_option == 'existing'){
          $('.select_client').show();
          $('#fullname_input').hide();
          $('#address_input').show();
          $('#package_bought_input').show();
          $('#quantity_input').show();
          $('#email_input').hide();
          $('#phone_input').hide();
      }
      else if(selected_option == 'new'){
        $('.select_client').hide();
          $('#fullname_input').show();
          $('#address_input').show();
          $('#package_bought_input').show();
          $('#quantity_input').show();
          $('#email_input').show();
          $('#phone_input').show();
      }
      else if(selected_option == ''){
        $('.select_client').hide();
          $('#fullname_input').hide();
          $('#address_input').hide();
          $('#package_bought_input').hide();
          $('#quantity_input').hide();
          $('#email_input').hide();
          $('#phone_input').hide();
      }
    });
});
</script>