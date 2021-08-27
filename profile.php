<?php 
include('includes/instantiated_files.php');
if(isset($_POST['update_profile_image'])){
    $msg= "";
    $filename =  $_FILES['profile_image']['name'];
    $size =  $_FILES['profile_image']['size'];
    $type =  $_FILES['profile_image']['type'];
    $tmpName  = $_FILES['profile_image']['tmp_name'];
    $update_profile_image = $object->update_profile_image($filename, $size, $tmpName, $type, $uid);
    $update_profile_image_decode = json_decode($update_profile_image, true);
    $msg = $update_profile_image_decode['msg'];
   //  if($update_profile_image_decode['status'] == '1'){ 
   //    echo "<script> alert('Document uploaded successfully');
   //    </script>";
   // }else{
   //    echo "<script> alert('Error in uploading document');
   //    </script>";
   // }
 }
 

 
 $get_banks_and_codes = get_banks_and_codes();
 $get_banks_and_codes_dec = json_decode($get_banks_and_codes,true);
 $get_banks_and_codes_data = $get_banks_and_codes_dec['data'];
 
 
//  $get_user_verification_details = get_user_verification_details($account_number,$account_bank);



?>
<body class="">
  <?php 
  include('includes/header.php'); 
  include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <?php include('includes/profile_dashboard.php'); ?>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row" style="margin-top: -300px;">

  <!-- 
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="assets/img/theme/team-4-800x800.jpg" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4" >
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading">22</span>
                      <span class="description">Referrals</span>
                    </div>
                    <div>
                      <span class="heading">10</span>
                      <span class="description">Photos</span>
                    </div>
                    <div>
                      <span class="heading">89</span>
                      <span class="description">Comments</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  Jessica Jones<span class="font-weight-light">, 27</span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>Bucharest, Romania
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>University of Computer Science
                </div>
                <hr class="my-4" />
                <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
                <a href="#">Show more</a>
              </div>
            </div>
          </div>
        </div> -->

        <div class="col-xl-2"></div>

        <div class="col-xl-8 order-xl-1" >
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>

               <!--  <div class="col-4 text-right">
                  <a href="#" data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-sm btn-primary">Update Profile</a>
                </div> -->
              </div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                  <small>Click on the image below to upload a new image</small>
                </div>
              </div><br>
               <div class="row justify-content-center">
                <div class="col-md-3">
                  <a href="#" data-toggle="modal" data-target="#image_upload">
                    <img src="<?php echo $profile_image;?>" class="rounded-circle img-responsive img-fluid">
                  </a>
                  </div>
                </div>
              <form method="POST" id="teeeeest"> 
                <h6 class="heading-small text-muted mb-4">Basic Details
               
                 &nbsp;&nbsp;<span><a href="#" data-toggle="modal" data-target="#basic_det" class="btn btn-sm btn-success">Edit</a></span>

               </h6>
                <div class="pl-lg-4">
                 
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">First name <?php echo  $get_codes_dec['data']; ?></label>
                        <input type="text" value="<?php echo $other_names; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text" value="<?php echo $surname; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                  </div>
           <!--       </div> -->

                   <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Phone</label>
                        <input type="text" value="<?php echo $phone_number; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Alternate Number</label>
                        <input type="text" value="<?php echo $alternate_phone; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                  </div>
              

                   <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Date of Birth</label>
                        <input type="text" value="<?php echo $dob; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Home Address</label>
                        <input type="text" value="<?php echo $home_address; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                  </div>
                  <div class="row">
              <div class="col-md-6">
              <label>Gender</label>
              <input type="text" value="<?php echo $gender; ?>" readonly class="form-control form-control-alternative">
              </div>
          </div><br>

                <hr class="my-4" />
                <!-- Address -->    
                    <?php if($verification_status == 0){?>
                      <h6 class="heading-small text-muted mb-1">Bank Details </h6> &nbsp;&nbsp;
                    <span>
                        <a href="#" data-toggle="modal" data-target="#bank_det" class="btn btn-sm btn-success">Edit</a>
                    </span>
                    
                    <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Bank Name</label>
                        <input type="text" value="<?php echo $bank_name; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label  class="form-control-label" for="input-city">Account Name</label>
                        <input type="text" value="<?php echo $account_name; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Account No</label>
                        <input type="text" value="<?php echo $account_number; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Account Type</label>
                        <input type="text" value="<?php echo $account_type; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-6">
                    <label>BVN</label>
                    <input type="text"  value="<?php echo $bvn; ?>" readonly class="form-control form-control-alternative">
                    </div>
                </div><br>
                </div>
                    
                    <?php } 
                    else{ ?>
                      <h6 class="heading-small text-muted mb-1">Bank Details </h6>
                      Status: <span style="color:green"><strong>VERIFIED</strong></span>
                      
                      <div class="row">
                      <div class="col-md-6">
                      <label>Bank Name: <strong><?php echo $bank_name; ?></strong></label>
                      
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-md-6">
                      <label>Account Name: <strong><?php echo $bank_name; ?></strong></label>
                     
                      </div>
                      </div>


                      <div class="row">
                      <div class="col-md-6">
                      <label>Account No: <strong><?php echo $account_number; ?></strong></label>             
                      </div>
                      </div>

                       <div class="row">
                      <div class="col-md-6">
                      <label>Account Type: <strong><?php echo $account_type; ?></strong></label>             
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-md-6">
                      <label>BVN: <strong><?php echo $bvn; ?></strong></label>                 
                      </div>
                      </div>

                      <br>            
                 <?php }  ?>

                    <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Next of Kin Details (NOK)
                  &nbsp;&nbsp;<span><a href="#" data-toggle="modal" data-target="#nok_det" class="btn btn-sm btn-success">Edit</a></span>


                </h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">NOK Surname </label>
                        <input type="text" value="<?php echo $nok_surname; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">NOK Other names</label>
                        <input type="text" value="<?php echo $nok_name; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">NOK Phone</label>
                        <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" value="<?php echo $nok_phone; ?>" readonly>
                      </div>
                    </div>

                     <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">NOK Email</label>
                        <input type="text" value="<?php echo $nok_email; ?>" readonly class="form-control form-control-alternative">
                      </div>
                    </div>


                  </div>

                   <div class="row">
                   
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">NOK Address</label>
                        <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" value="<?php echo $contact_address; ?>" readonly>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">NOK Relationship</label>
                        <input type="text" id="input-coutnry" value="<?php echo $relationship; ?>" class="form-control form-control-alternative" placeholder="Country" readonly>
                      </div>
                    </div>


                  </div>

                 

                </div>
               
              </form>
            </div>


                     </div>
                 </div>

          </div>
        </div>
      </div>
      <hr>
      <!-- Footer -->

        <!-- update profile image -->
        <div class="modal fade" id="image_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Update Profile Picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <form method="POST" id="update_profile_image" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                <input class="form-control" type="file" name="profile_image" id="profile_image">
                </div>
                <div class="col-md-6">
                <input type="submit" name="update_profile_image" id="update_profile_image" class="btn btn-success" value="Upload">
                </div>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
       

       <!-- update basic profile modal starts here -->
        <div class="modal fade" id="basic_det" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Update Basic Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            
        <form method="POST" class="form" id="update_basic_form">
          <div class="row">
              <div class="col-md-6">
              <label>Surname</label>
              <input type="text" class="form-control form-control-sm" value="<?php echo $surname; ?>" name="surname" id="surname" readonly>
              <input type="hidden" class="form-control form-control-sm" value="<?php echo 'update'; ?>" name="social_media_handle" id="social_media_handle">
              </div>
              <div class="col-md-6">
              <label>Other Names</label>
              <input type="text" class="form-control form-control-sm"  value="<?php echo $other_names; ?>" name="other_names" id="other_names" readonly>
              </div>
          </div>
            <div class="row">
              <div class="col-md-6 mt-3">
              <label>Phone</label><br>
              <input class="form-control form-control-sm" type="text" value="<?php echo $phone_number; ?>" id="phone" name="phone">
              </div>
              <div class="col-md-6 mt-3">
              <label>Alternate No</label>
              <input class="form-control form-control-sm" type="text" value="<?php echo $alternate_phone; ?>" id="alternate_phone" name="alternate_phone">
              </div>
          </div>
            <div class="row">
              <div class="col-md-6 mt-3">
              <label>Date of Birth</label>
              <input type="date" class="form-control form-control-sm" value="<?php echo $dob; ?>" id="dob" name="dob">
              </div>
              <div class="col-md-6 mt-3">
              <label>Home Address</label>
              <input class="form-control form-control-sm" type="text" id="home_address" name="home_address" value="<?php echo $home_address; ?>" >
              </div>
          </div><br>
          <div class="row">
              <div class="col-md-6">
              <label>Gender</label>
              <select class="form-control form-control-sm" id="gender" name="gender">
                <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                <?php if($gender == 'male' || $gender == 'Male'){?>
                   <option value="female">Female</option>
                 <?php } else{?>
                  <option value="male">Male</option>
                <?php } ?>
              </select>
              </div>
          </div><br>
          <a href="" class="btn btn-sm btn-success"  id="update_basic_profile">Update now</a>
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success update_basic_profile">Update Now</button>
         --></div>
      </div>
        </div>
        </div>
       <!-- update basic profile modal ends here -->


        <?php if($verification_status == 0){?>
           <!-- update basic profile modal starts here -->
        <div class="modal fade" id="bank_det" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Update Bank Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
                    <form method="POST" id="update_bank_form">
                    <div class="row">
                        <div class="col-md-6">
                        <label>Bank Name</label>
                        
                          <select class="form-control form-control-sm js-example-basic-single" name="bank_name" id="bank_name"   >
                          <option value=" "><?php echo $bank_name; ?></option>
                          <?php foreach($get_banks_and_codes_data as $bank_codes){
                              // $data_dec = json_decode($data,true);
                           ?>
                          <option value="<?php echo $bank_codes['code']; ?>"><?php echo $bank_codes['name']; ?></option>
                          <?php } ?>
                          

                        </select>
                        </div>
                        <div class="col-md-6">
                        <label>Account Name</label>
                        <input class="form-control form-control-sm" type="text" value="<?php echo $account_name; ?>" name="account_name" id="account_name">
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-md-6 mt-3">
                        <label>Account No</label>
                        <input class="form-control form-control-sm" type="number" value="<?php echo $account_number; ?>" id="account_number" name="account_number">
                        </div>
                        <div class="col-md-6 mt-3">
                        <label>Account Type</label>
                        <input class="form-control form-control-sm" type="text" value="<?php echo $account_type; ?>" id="account_type" name="account_type">
                        </div>
                          <div class="col-md-6 mt-3">
                          <label>BVN</label>
                          <input type="text" placeholder="Please input your bvn" value="<?php echo $bvn; ?>"  class="form-control form-control-sm" name="bvn" id="bvn">
                          </div>
                      </div><br>
                    <!--<a href="#" class="btn btn-sm btn-success" name="update_bank_profile" id="update_bank_profile">Update now</a>-->
                    
                    <a href="#" class="btn btn-sm btn-primary" name="verify_account" id="verify_account">Verify Your Account</a>
                    
                  
                  

            </form>
            
              <div id="display_details"></div>

        </div>
        

        <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Update Now</button>
        </div> -->
        </div>
        </div>
        </div>
      </div>
       <!-- update basic profile modal ends here -->
      <?php } ?>

              <!-- update basic profile modal starts here -->
        <div class="modal fade" id="nok_det" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Update Next of Kin Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        

         <div class="modal-body">
                    <form method="POST" id="update_nok_form">
                    <div class="row">
                        <div class="col-md-6">
                        <label>Nok Surname</label>
                        <input class="form-control form-control-sm" type="text" value="<?php echo $nok_surname; ?>" name="nok_surname" id="nok_surname">
                        </div>
                        <div class="col-md-6">
                        <label>Nok Other names</label>
                        <input class="form-control form-control-sm" type="text" value="<?php echo $nok_name; ?>" name="nok_name" id="nok_name">
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-md-6 mt-3">
                        <label>Nok Phone</label>
                        <input class="form-control form-control-sm" type="number" value="<?php echo $nok_phone; ?>" id="nok_phone" name="nok_phone">
                        </div>
                        <div class="col-md-6 mt-3">
                        <label>Nok Email</label>
                        <input class="form-control form-control-sm" type="text" value="<?php echo $nok_email; ?>" id="nok_email" name="nok_email">
                        </div>
                    </div>

                       <div class="row">
                        <div class="col-md-6 mt-3">
                        <label>Nok Contact Address</label>
                        <input class="form-control form-control-sm" type="text" value="<?php echo $contact_address; ?>" id="contact_address" name="contact_address">
                        </div>
                        <div class="col-md-6 mt-3">
                        <label>Nok Relationship</label>
                        <input class="form-control form-control-sm" type="text" value="<?php echo $relationship; ?>" id="relationship" name="relationship">
                        </div>
                    </div><br/>
                    <a href="#" class="btn btn-sm btn-success" name="update_nok_profile" id="update_nok_profile">Update now</a>

                  

            </form>

        </div>
        
        

        <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Update Now</button> -->
        </div>
        </div>
        </div>
        </div>
       <!-- update basic profile modal ends here -->



   <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
<script type="text/javascript">
  $(document).ready(function () {
  <?php
if(!empty($msg)){
if($msg == "success"){
  ?>
      $.alert({
      title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "Your profile image has been updated successfully"
    });
    setTimeout( function(){ window.location.href = "profile";}, 4000);
    <?php
   }
   else if($msg == "This file extension is not allowed. Please upload a JPEG or PNG file"){
    ?>
      $.alert({
      title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "This file extension is not allowed. Please upload a JPEG or PNG file"
    });
   <?php }

   else if($msg == "File size is more than 2MB"){
    ?>
      $.alert({
      title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "File size is more than 2MB"
    });
   <?php }
   else{
    ?>
      $.alert({
      title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "Server Error"
    });
   <?php } }?>

});
</script>