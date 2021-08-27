<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
$getpack = $object->get_rows_from_one_table('package_definition');

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
              //var_dump($getpack);
              foreach($getpack as $pack){ 
                     $cid = $pack['package_category'];
                     $getcat = $object->get_one_row_from_one_table('package_category','unique_id',$cid);

                         if($pack['package_type']  == 1){
                             $product_type = "Fixed";
                          }
                         else {
                            $product_type = "Recurrent";
                          }

                         if($pack['visibility'] == 1){
                            $visibility =  "<small style='color: green;'>visible</small>";
                         }else{
                            $visibility =  "<small style='color: green;'>hidden</small>";
                         }


                          if($pack['capital_refund'] == '1'){
                          $capital_refund2 = "No Refund";

                          }
                          if($pack['capital_refund'] == '2'){
                          $capital_refund2 = "End of Tenure";
                          }
                          if($pack['capital_refund'] == '3'){
                          $capital_refund2 = "Spread Monthly";
                          }
                          if($pack['capital_refund'] == '4'){
                          $capital_refund2 = "Spread Quarterly";
                          }
                          if($pack['capital_refund'] == '5'){
                          $capital_refund2 = "Spread Yearly";
                          }
               
                if($count%3 === 1){
                    echo '<div class="row">';
                   }
               ?>

                  <div class="col-xl-4 col-md-4 col-lg-6">
                  <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                  <div class="row">
                  <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $pack['package_name']; ?></h5>
                  <br>
                  <img class="card-img-top" src="admin/<?php echo $pack['image_url'];?>" alt="Card image cap"><hr>
                  <!-- <a href="#" class="btn btn-sm btn-primary">view details</a> -->
                  <button type="button" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#view<?php echo $pack['unique_id']; ?>">details</button> &nbsp; | &nbsp; <a href="packages?pid=<?php echo $pack['unique_id']; ?>" type="button" class="btn btn-sm btn-success">view packages</a>
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
                  <div class="modal fade" id="view<?php echo $pack['unique_id']; ?>"  role="dialog" aria-labelledby="myLargeModalLabel"  aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                      <div class="modal-content ">
                        <div class="modal-header">
                          <h2 class="modal-title" id="exampleModalLabel">Details for the Package: <?php echo $pack['package_name'];?></h2>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                  <div><strong>Package Description:</strong></div><textarea class="form-control ckeditor" id="editor1" readonly name="editor1" rows="10"><?php echo $pack['package_description'];?></textarea><br><br>
                                 <!--  -->
                                 <div>Available Slots: <?php echo $pack['package_description']; ?></div>

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