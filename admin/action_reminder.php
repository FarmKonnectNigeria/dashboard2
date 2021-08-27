<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 


$object->action_reminder($uid);
$get_rows = $object->get_rows_from_one_table('leads');

?>


<body class="">
  <?php include('includes/sidebar.php'); 
      if($role_name != 'Business Executive'){
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
              <h3 class="mb-0">Set Reminder </h3>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">
                      <form action="" method="post" id="set_reminder_form"> 
                       <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Date and Time</label>
                             <input type="datetime-local" name="date_of_reminder" id="date_of_reminder"  class="form-control">
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Item to be reminded about</label>
                             <input type="text" name="item" id="item"  class="form-control">
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Frequency</label>
                             <input type="text" name="frequency" id="frequency"  class="form-control">
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                              <label class="form-control-label" for="input-first-name">Email Reminder</label>
                              <select name="email_reminder" id="email_reminder" class="form-control">
                                      <option value="">Select an option</option>
                                      <option value="yes">Yes</option>
                                      <option value="no">No</option>
                                  </select>
                            </div>
                      </div><br>
                     
                      <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="action_reminder" name="action_reminder"  class="btn btn-sm btn-primary action_reminder">Set Reminder</button>  
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