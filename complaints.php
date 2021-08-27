<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
@$data = $_POST['issue'].$_POST['comment'];
@$unique_id = $object->unique_id_generator($data);
?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
   <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(./assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-success opacity-8"></span>
                    <div class="container-fluid mt--7">
              <div class="row d-flex justify-content-center" style="margin-top: 70px;">
                  <div class="col-lg-7 col-md-10">
                    <div class="card bg-secondary shadow">
                      <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                          <div class="col-8">
                            <h3 class="mb-0">Complaints</h3>
                          </div>
                        </div>
                      </div>
                      <div class="card-body"> 
                          <div class="pl-lg-4">
                        <form class="" method="post" id="send_complaint_form">
                        <div class="form-group">
                          <label>Issues</label>
                          <select class="browser-default custom-select" name="issues">
                            <option value="Affliate Issues">Please choose the kind of issue you have</option>
                            <option value="Affliate Issues">Affliate Issues</option>
                            <option value="Finance Related Issues">Finance Related Issues</option>
                            <option value="General Issues">General Issues</option>
                            <option value="Operation Related Issues">Operation Related Issues</option>
                            <option value="Portfolio Related Issues">Portfolio Related Issues</option>
                            <option value="Sales and Supply">Sales and Supply</option>
                            <option value="Others">Others</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Comment</label>
                          <textarea class="form-control rounded-0" rows="10" name="comment"></textarea>
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['uid'];?>">
                        <input type="hidden" name="unique_id" value="<?php echo $unique_id;?>">
                        <button class="btn btn-primary mt-2 float-right" id="send_complaint">Send</button>
                    </form>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
        </div>
       
    </div>
<?php include('includes/footer.php'); ?>
</div>
 

 <?php include('includes/scripts.php'); ?>
</body>