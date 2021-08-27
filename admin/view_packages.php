<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
// $get_rows = $object->get_rows_from_one_table('package_tbl');
$get_rows = $object->get_rows_from_one_table('package_definition');



?>

<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <!-- <div class="header bg-gradient-default pb-8 pt-5 pt-md-8"  >
     
    </div> -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">This is a list of all packages</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Package name</th> 
                        <th scope="col">No of Slots</th>
                        <th scope="col">Package Unit Price</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Moratorium</th>
                        <th scope="col">MF</th>
                        <th scope="col">Visibility</th>
                       <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                   foreach($get_rows as $value){
                     $cid = $value['package_category'];
                     $getcat = $object->get_one_row_from_one_table('package_category','unique_id',$cid);
                      if($value['package_type']  == 1){
                         $product_type = "Fixed";
                      }
                     else {
                        $product_type = "Recurrent";
                      }

                      if($value['capital_refund'] == '1'){
                      $capital_refund2 = "No Refund";

                      }
                      else if($value['capital_refund'] == '2'){
                      $capital_refund2 = "End of Tenure";
                      }
                      else if($value['capital_refund'] == '3'){
                      $capital_refund2 = "Spread Monthly";
                      }
                      else if($value['capital_refund'] == '4'){
                      $capital_refund2 = "Spread Quarterly";
                      }
                      else if($value['capital_refund'] == '5'){
                      $capital_refund2 = "Spread Yearly";
                      }else{
                          $capital_refund2 = $value['capital_refund'];
                      }
                  ?>
                     <tr>
                      
                        <td><?php echo $value['package_name'];?></td>
                        <td><?php echo $value['no_of_slots'];?></td>
                        <td><?php echo $value['package_unit_price'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td><?php echo $value['moratorium'];?></td>
                        <td><?php echo $value['multiplying_factor'];?></td>
                        <td><?php

                     

                         if($value['visibility'] == 1){
                            echo "<small style='color: green;'>visible</small>";
                         }else{
                            echo "<small style='color: green;'>hidden</small>";
                         }


                     
                         ?></td>
                        <td> <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#view<?php echo $value['id']; ?>">View details</small>
                        
                        <?php
                           if($role_name == 'Super Administrator' || $role_name == 'Investment Manager'){
                        ?>
                        <!-- data-toggle="modal" data-target="#edit<?php //echo $value['id']; ?>"  -->
                        <a class="btn btn-sm btn-info" href="view_subsribers.php?packid=<?php echo $value['unique_id']; ?>">View subscribers</a>
                          <a class="btn btn-sm btn-primary" href="edit_package.php?packid=<?php echo $value['unique_id']; ?>">Edit</a> </td>
                      
                          <?php } ?>
  

                        <div class="modal fade bd-example-modal-md" id="view<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Package Name: <?php echo strtoupper($value['package_name']); ?>  <br/>Product Type: <?php echo $product_type; ?></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div><img class="rounded-circle " style="padding-left: 20%;" height="180px" width="320px" src="<?php echo $value['image_url'];?>"></div><br>
                                  <div><strong>Package Description:</strong></div><textarea class="form-control ckeditor" id="package_description" name="package_description" rows="10"><?php echo $value['package_description'];?></textarea><br><br>
                                  <div><strong>Package Category: </strong><?php echo $getcat['name'];?></div><br>
                                  <div><strong>Package Unit Price: </strong><?php echo '&#8358;'.$value['package_unit_price'];?></div><br>
                                  
                                  <div><strong>Minimum No of Slots: </strong><?php echo $value['min_no_slots']; ?></div><br>
                                  <div><strong>Moratorium: </strong><?php echo $value['moratorium']; ?></div><br>
                                  <div><strong>Free Liquidation Period: </strong><?php echo $value['free_liquidation_period'].' days'; ?></div><br>
                                  <div><strong>Liquidation Surcharge: </strong><?php echo $value['liquidation_surcharge'].'%'; ?></div><br>
                                  <div><strong>Tenure of Product: </strong><?php echo $value['tenure_of_product'].' days'; ?></div><br>
                                  <div><strong>Float Time: </strong><?php echo $value['float_time'].' days'; ?></div><br>
                                  <div><strong>Multiplying Factor: </strong><?php echo $value['multiplying_factor']; ?></div><br>
                                  <div><strong>Capital Refund: </strong><?php echo $capital_refund2; ?></div><br>
                                  
                                  <div><strong>Capital Refund(Days): </strong><?php echo $value['capital_refund_days']; ?></div><br>
                                  
                                  <div><strong>Backdatable?: </strong><?php if($value['backdatable'] == "1"){ echo "Yes"; }else{ echo "No"; } ?></div><br>
                                  <div><strong>Available Slots: </strong><?php echo $value['no_of_slots']; ?></div><br>
                               
                               </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                      </tr>

                       <div class="modal fade" id="editooo<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Package</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                 <form class="mt-4" id="update_package_form<?php echo $value['unique_id']; ?>"  method="post"> 
                                  <div class="form-group">
                                    <label for="formGroupExampleInput">Package Name</label>
                                    <input type="text" class="form-control" id="package_name<?php echo $value['unique_id'];  ?>" name="package_name<?php echo $value['unique_id'];  ?>" value="<?php echo $value['package_name']?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control rounded-0" id="package_description<?php echo $value['unique_id'];  ?>" name ="package_description<?php echo $value['unique_id'];  ?>" rows="10" ><?php echo $getcat['name']; ?></textarea>
                                  </div>
                                  <div class="row">
                                    <div class="form-group col-md-4">
                                      <label for="formGroupExampleInput">Number of Slot</label>
                                      <input type="text" class="form-control" id="slot<?php echo $value['unique_id'];  ?>" name="slot<?php echo $value['unique_id'];  ?>" value="<?php echo $value['no_of_slots']?>">
                                    </div>
                                 
                                </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-success get_package_id" name="update_packages" id="<?php echo $value['unique_id']; ?>">Update</button>
                                  </form>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                            </div>
                <?php } } ?>
                 
                 

                 
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
             <!--  <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
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
                </ul>
              </nav> -->
            </div>
          </div>
        </div>
      </div>
      <!-- Dark table -->


         
 
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>