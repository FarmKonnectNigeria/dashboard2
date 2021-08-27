<?php 
  if(isset($_POST['sbm'])){
       echo "<script> alert('Error in creating package category')</script>";
  }
include('includes/header.php'); ?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
  <?php //include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
     
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->
 
      <!-- Dark table -->
      <div class="row mt-5">
         <div class="col-md-12">
               <form action="" method="post">
              <input type="text" name="fullname">
              <input type="submit" name="sbm" id="">
           </form>

         </div>
          
      </div>
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>