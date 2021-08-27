<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$get_rows = $object->get_rows_from_one_table('leads');
$get_category = $object->get_rows_from_one_table('package_category');
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
              <h3 class="mb-0">Payment Confirmation for Client </h3>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">
                      <form action="" method="post" id="confirm_payment_form"> 
                        <div class="row">
                        <div class="col-lg-10 select_client" id="">
                           <label class="form-control-label" for="input-first-name">Select Client</label>
                                  <select name="select_client" id="select_client" class="form-control">
                                      <option value="">select a client</option>
                                      <?php 
                                        foreach($get_rows as $value){
                                      ?>
                                    <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['fullname']; ?></option>
                                    <?php } ?>
                                  </select>
                          </div>
                          </div><br>
                          
                           <div class="row">
                            <div class="col-lg-10"> 
                              <label class="form-control-label" for="input-first-name">Package</label>
                                  <select name="package" id="package" class="form-control">
                                      <option value="">select a package</option>
                                      <?php 
                                        foreach($get_package as $value){
                                      ?>
                                    <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['package_name']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                         
                      </div><br>
                          <div class="row">
                            <div class="col-lg-10" id="quantity_input">
                                 <label class="form-control-label" for="input-first-name">Quantity</label>
                             <input name="quantity" id="quantity" type="number" class="form-control quantity">
                            </div>
                          </div><br>
                          <div class="row">
                            <div class="col-lg-10">
                              Amount expected to be paid: <span class="" id="total"></span>
                            </div>
                          </div><br>
                     
                      <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="confirm_payment" name="confirm_payment"  class="btn btn-sm btn-primary confirm_payment">Confirm Payment</button>  
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
    $('#quantity').on("keyup", function(){
      $.ajax({
        url:"calculate_amount",
        method:"POST",
        data:$('#confirm_payment_form').serialize(),
        success:function(data){
          var quantity = $("#quantity").val();
          var amount = data;
          var total_price = amount*quantity;
          $('#total').html(total_price);
        //alert(data);
        }
      });
    });
  });
</script>
