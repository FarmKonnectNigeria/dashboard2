<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
 
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
              <h3 class="mb-0">This is Sales Registration </h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form enctype="multipart/form-data" action="" method="post" id="register_sales_form"> 
                      <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Transaction</label>
                             <input type="text" name="transaction" id="transaction"  class="form-control">
                            </div>
                      </div><br>
                       <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Product</label>
                             <input type="text" name="product" id="product"  class="form-control">
                            </div>
                      </div><br>
                       <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Amount</label>
                             <input type="number" name="amount" id="amount"  class="form-control">
                            </div>
                      </div><br> 
                      <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Date of Sales</label>
                             <input type="date" name="sales_date" id="sales_date"  class="form-control">
                            </div>
                      </div><br>
                      <button class="btn btn-sm btn-primary" type="button" id="register_sales">Register Sale</button>
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
    $("select#location_source").change(function(){
        var location = $(this).children("option:selected").val();
        if(location == 'Others'){
        $('#others').css("display", "block");
      }
    });
});
</script>