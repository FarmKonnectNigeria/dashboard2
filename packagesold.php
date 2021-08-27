<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
//$getpack = $object->get_rows_from_one_table('package_definition');
$getpack = $object->get_rows_from_one_table_by_id('package_definition','visibility',1);



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
                     $get_terms_condition = $object->get_one_row_from_one_table('package_term_condition','package_id',$pack['unique_id']);
                     if($pack['tenure_of_product'] !== 'inf'){
                        $tenure_of_product_years =intval($pack['tenure_of_product'] / 365).' year(s)';
                        //$tenure_of_product_month = intval(($pack['tenure_of_product'] % 365) / 30).' month(s)';
                        $tenure_of_product_days = intval($pack['tenure_of_product'] % 365) .' day(s)';
                      }

                         if($pack['package_type']  == 1){
                             $product_type = "Fixed";
                          }
                         else {
                            $product_type = "Recurrent";
                          }

                         // if($pack['visibility'] == 1){
                         //    $visibility =  "<small style='color: green;'>visible</small>";
                         // }else{
                         //    $visibility =  "<small style='color: green;'>hidden</small>";
                         // }


                          // if($pack['capital_refund'] == '1'){
                          // $capital_refund2 = "No Refund";

                          // }
                          // if($pack['capital_refund'] == '2'){
                          // $capital_refund2 = "End of Tenure";
                          // }
                          // if($pack['capital_refund'] == '3'){
                          // $capital_refund2 = "Spread Monthly";
                          // }
                          // if($pack['capital_refund'] == '4'){
                          // $capital_refund2 = "Spread Quarterly";
                          // }
                          // if($pack['capital_refund'] == '5'){
                          // $capital_refund2 = "Spread Yearly";
                          // }
               
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
                  <img class="card-img-top" style="max-height:150px;" src="admin/<?php echo $pack['image_url'];?>" alt="Card image cap">
                  <!-- <a href="#" class="btn btn-sm btn-primary">view details</a> &nbsp; | &nbsp;<hr> --><br><br>
                  <button type="button" class="btn btn-sm btn-success"  data-toggle="modal" data-target="#view<?php echo $pack['unique_id']; ?>"><span style="font-size: 16px;">subscribe</span></button><hr> <a href="packages?pid=<?php echo $pack['unique_id']; ?>" ><span style="font-size: 10px; color: green;">Category: <?php echo $getcat['name']; ?></span></a>
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
                          <h2 class="modal-title" id="exampleModalLabel">Subscribe to the Package: <?php echo $pack['package_name'];?></h2>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                             
                                  <div><strong>Package Description:</strong></div><textarea class="form-control ckeditor" id="editor1" readonly name="editor1" rows="10"><?php echo $pack['package_description'];?></textarea><br>
                                 <!--  -->
                                 <div>Product Type: <strong><?php echo $product_type; ?></strong></div>
                            
                                <br>
                                 <div>Available Slots: <strong><?php echo number_format($pack['no_of_slots']); ?></strong> </div>
                              
                                <br>

                                 <div>Minimum Slot You can buy: <strong><?php echo $pack['min_no_slots']; ?></strong> </div>
                              
                                <br>

                                <div>Package Unit Price: <strong><?php echo '&#8358;'.number_format($pack['package_unit_price']); ?></strong> </div>
                                
                                <br>
                                
                             
                                 <div>Tenure of Product: <strong><?php if($pack['tenure_of_product'] == 'inf'){echo "INFINITE"; }else{ echo $tenure_of_product_years.' '.$tenure_of_product_days;} ?></strong> </div>
                              
                                <br>
                                
                                <?php if($product_type == "Fixed"){?>
                            
                                <div>Expected Capital Balance After Investment for 1 slot:<br> <strong><?php if($pack['tenure_of_product'] == 'inf'){echo "Based on the number of days your investment is left to run"; }else{ echo '&#8358;'.number_format(   $pack['package_unit_price'] + ($pack['package_unit_price'] * $pack['multiplying_factor'] * $pack['tenure_of_product'])   ); } ?></strong> </div>
                                
                               <?php }
                                echo "<br>";
                                 ?>
                                
                                
                        
                                <form method="POST" id="subscribe_pack_form<?php echo $pack['unique_id']; ?>">
                                <div>No of slots to buy: <input type="number" size="6"  name="slots_to_buy" id="slots_to_buy" > </div>
                                

                                 <!-- required=""  -->
                               
                                   <input type="hidden"  name="no_of_slots" id="no_of_slots" value="<?php echo $pack['no_of_slots']; ?>">
                                   <input type="hidden"  name="min_slots" id="min_slots" value="<?php echo $pack['min_no_slots']; ?>">
                                   <input type="hidden" name="unique_id" id="unique_id" value="<?php echo $pack['unique_id']; ?>">
                                   <input type="hidden" name="package_type" id="package_type" value="<?php echo $pack['package_type']; ?>">
                                    <input type="hidden" name="package_category" id="package_category" value="<?php echo $pack['package_category']; ?>">
                                    <input type="hidden" name="package_commission" id="package_commission" value="<?php echo $pack['package_commission']; ?>">
                                    <hr>
                                    <a class="text-primary font-weight-bold" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                       Click to view Terms and Conditions
                                    </a><br>
                                    <div class="collapse" id="collapseExample">
                                      <div class="card card-body">
                                        <?php 
                                        if($get_terms_condition['description'] == null){
                                          echo "No Terms and Conditions yet";
                                        }else{
                                          echo $get_terms_condition['description'];
                                        }
                                        ?>
                                      </div>
                                    </div><hr>
                                 <input type="checkbox" name="terms_conditions"  id="terms_conditions"><span> Agree to terms and conditions</span>
                                 <br><br>

                                 <input  id="<?php echo $pack['unique_id']; ?>" type="submit" name="cmd_subscribe_pack"  value="Subscribe to Package" class="btn btn-lg btn-success cmd_subscribe_pack" >

                                 </form>
                                 <hr>
                                  <div class="display_results"  id="display_results<?php echo $pack['unique_id']; ?>">
                                    

                                  </div>
                                <br>

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
<?php include('includes/scripts2.php'); ?>