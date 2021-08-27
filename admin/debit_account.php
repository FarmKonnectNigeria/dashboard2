<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 
 $get_rows = $object->get_rows_from_one_table('users_tbl');
 ?>


<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); 
      if($role_name !=  'Cash Officer'){
    echo '<meta http-equiv="refresh" content="0; URL=no_access" />';
  }
    ?>
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
              <h3 class="mb-0">This is the page for Debiting Account </h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form action="" method="post" id="debit_account_form">                       
                      <div class="row">
                        <div class="col-lg-10" id="">
                           <label class="form-control-label" for="input-first-name">Select Client</label><br>
                                  <select name="user_id" id="user_id" class="form-control form-control-sm js-example-basic-single">
                                      <option value="">Select a Client</option>
                                      <?php 
                                        foreach($get_rows as $value){
                                      ?>
                                    <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['surname'].' '.$value['other_names'].' ('.$value['email'].')'; ?></option>
                                    <?php } ?>
                                  </select>
                          </div>
                          </div><br>     
                       <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Amount</label>
                             <input type="number" name="amount" id="amount"  class="form-control" placeholder="Amount to be debited">
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Remark</label>
                             <textarea rows="10" cols="10" name="remarks" id="remarks" class="form-control"></textarea>
                            </div>
                      </div><br>
                      <button class="btn btn-sm btn-primary" type="button" id="debit_account">Debit</button>
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
