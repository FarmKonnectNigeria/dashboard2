<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
$getcat = $object->get_rows_from_one_table('package_category');

?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
       

        
             
              <?php 
              $count = 1;
              //print_r($getpack);
              foreach($getcat as $cat){ 
               
                if($count%3 === 1){
                    echo '<div class="row">';
                   }
               ?>

                  <div class="col-xl-4 col-md-4 col-lg-6">
                  <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                  <div class="row">
                  <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $cat['name']; ?></h5>
                  <br>
                  <img class="card-img-top" src="admin/<?php echo $cat['image_url'];?>" alt="Card image cap"><hr>
                  <!-- <a href="#" class="btn btn-sm btn-primary">view details</a> -->
                  <button type="button" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#view<?php echo $cat['unique_id']; ?>">details</button> &nbsp; | &nbsp; <a href="packages?pid=<?php echo $cat['unique_id']; ?>" type="button" class="btn btn-sm btn-success">view packages</a>
                  </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                  <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> <?php //echo $cat['slot']; ?> slots</span> -->
                  <!-- <span class="text-nowrap">Since last week</span> -->
                  </p>
                  </div>
                  </div>
                  </div>



                       <!-- View Modal-->
                  <div class="modal fade" id="view<?php echo $cat['unique_id']; ?>"  role="dialog" aria-labelledby="myLargeModalLabel"  aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                      <div class="modal-content ">
                        <div class="modal-header">
                          <h2 class="modal-title" id="exampleModalLabel">Category Details for: <?php echo $cat['name'];?></h2>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                             <!-- <table class="table align-items-center table-flush"> -->
                              <table class="table  table-striped">   

                                  <tr>
                                      <td><strong>Package Category:</strong></td>
                                      <td><?php echo $cat['name'];?></td>
                                  </tr>
                                  <tr>
                                      <td><strong>Description:</strong></td>
                                      <td><textarea class="form-control dess" id="dess" name="dess"><?php echo $cat['description'];?></textarea></td>
                                  </tr>
                                 
                                  

                             </table>

                              <!-- <span><strong>Subscribe Below:</strong></span> -->
                               
                        
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <!-- end of view Modal -->



              <?php
                if($count%3 === 0){
                    echo "</div><hr>";
                }

               $count++; }


                ?>

        </div>
      </div>
    </div>
    <hr>
    <div class="container-fluid mt--7">
      <!-- Table -->
    
    




    </div>

  </div>
    <!-- Footer -->
      <?php include('includes/footer.php'); ?>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>