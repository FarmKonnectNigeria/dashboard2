<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$get_reminder = $object->get_rows_from_one_table_by_id('payment_reminder','set_by', $uid);
foreach ($get_reminder as $value) {
  $date_to_commence = $value['date_to_commence'];
  $date_to_end = $value['date_to_end'];
  $message = $value['message'];
  $today = date('Y-m-d');
  $get_leads = $object->get_rows_from_one_table_by_id('leads', 'unique_id', $value['client_id']);
  foreach ($get_leads as $val) {
    $get_email = $val['email'];
    $subject = "Payment Reminder - FarmKonnect";
    $content = $message;
    if($today >= $date_to_commence && $today <= $date_to_end){
    $object->email_function($get_email, $subject, $content);
      //echo 'yesss';
    }
  }
}

$get_rows = $object->get_rows_from_one_table_by_id('leads', 'assigned_to', $uid);

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
              <h3 class="mb-0">Payment Reminder </h3>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">
                      <form action="" method="post" id="payment_reminder_form"> 
                      <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Select Leads, Client or Prospect</label>
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
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Message</label>
                             <textarea class="form-control" rows="10" cols="10" name="message" id="message"></textarea>
                            </div>
                      </div><br> 

                      <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Frequency</label>
                             <select name="frequency" id="frequency" class="form-control">
                                <option value="select_frequency">select a frequency</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                              </select>
                            </div>
                      </div><br>  
                      <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Date to Commence</label>
                             <input type="date" name="date_to_commence" id="date_to_commence"  class="form-control">
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Date to End</label>
                             <input type="date" name="date_to_end" id="date_to_end"  class="form-control">
                            </div>
                      </div><br>                   
                      <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="payment_reminder" name="payment_reminder"  class="btn btn-sm btn-primary payment_reminder">Set Reminder</button>  
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