<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 
$get_rows = $object->get_rows_from_one_table_by_id('admin_roles','status',1);
?>


<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Super Administrator'){
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
              <h3 class="mb-0">Add User to role</h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form enctype="multipart/form-data" action="" method="post" id="user_to_role_form"> 
                      <div class="row">
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Surname</label>
                                  <input type="text" name="surname" id="surname" class="form-control">
                            </div>
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Other Names</label>
                                  <input type="text" name="other_names" id="other_names" class="form-control">
                            </div>
                         
                      </div><br>
                     <div class="row">
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Username</label>
                                  <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Email Address</label>
                                  <input type="text" name="email" id="email" class="form-control">
                            </div>
                         
                      </div><br>
                       <div class="row">
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Default Password</label>
                                  <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="col-lg-6"> 
                              <label class="form-control-label" for="input-first-name">Confirm Password</label>
                                  <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                            </div>
                         
                      </div><br>
                      <div class="row">
                            <div class="col"> 
                              <label class="form-control-label" for="input-first-name">Gender</label><br>
                                  <select name="gender" id="gender" class="form-control">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                  </select>
                            </div>
                         
                      </div><br>

                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Home Address</label>
                              <textarea class="form-control " id="address" name="address" rows="10"></textarea>
                            </div>
                         
                      </div><br>
                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Phone Number</label>
                              <input type="number" name="phone" id="phone" class="form-control">
                            </div>
                         
                      </div><br>
                       <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Role</label>
                              <select name="role_id" id="role_id" class="form-control select-2">
                                      <option value="">Select a role</option>
                                      <?php 
                                        foreach($get_rows as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['role_name']; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                         
                      </div><br>
                      
                      <div class="row">
                            <div class="col-lg-6">
                                <input type="submit" value="Add User" id="add_user_to_role" name="add_user_to_role"  class="btn btn-sm btn-primary">
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