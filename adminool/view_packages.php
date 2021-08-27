<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$get_rows = $object->get_rows_from_one_table('package_tbl');

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
                        
                        <th scope="col">Slot</th>
                        <th scope="col">Fixed Amount</th>
                        <th scope="col">Interest Rate</th>
                        <th scope="col">Visibility</th>
                       <th>Action</th>
                        <th></th>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                      
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $value['package_name'];?></td>
                        <td><?php echo $value['slot'];?></td>
                        <td><?php echo $value['fixed_amount'];?></td>
                        <td><?php echo $value['interest_rate'];?></td>
                        <td><?php

                         if($value['visibility'] == 1){
                            echo "<small style='color: green;'>visible</small>";
                         }else{
                            echo "<small style='color: green;'>hidden</small>";
                         }


                         ?></td>
                        <td> <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#view<?php echo $value['id']; ?>">View details</small> </td>
                        <td> <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?php echo $value['id']; ?>">Edit</small> </td>
  

                        <div class="modal fade bd-example-modal-md" id="view<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel"><?php echo $value['package_name'];?> : <?php echo $value['package_category'];?></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div><strong>Package Description:</strong></div><textarea  readonly cols="40" rows="10"><?php echo $value['package_description'];?></textarea><br><br>
                                  <div><strong>Package Category: </strong><?php echo $value['package_category'];?></div><br>
                                  <div><strong>Interest Withdrawable every </strong><?php echo $value['withdrawable_month'].' month(s)';?></div><br>
                                  <div><strong>Min Number of Months for Investment: </strong><?php echo $value['no_of_month'];?></div><br>
                                  <div><strong>Max Number of Months for Investment: </strong><?php echo $value['max_no_of_months'];?></div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                      </tr>

                       <div class="modal fade" id="edit<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                    <textarea class="form-control rounded-0" id="package_description<?php echo $value['unique_id'];  ?>" name ="package_description<?php echo $value['unique_id'];  ?>" rows="10" ><?php echo $value['package_description']?></textarea>
                                  </div>
                                  <div class="row">
                                    <div class="form-group col-md-4">
                                      <label for="formGroupExampleInput">Number of Slot</label>
                                      <input type="text" class="form-control" id="slot<?php echo $value['unique_id'];  ?>" name="slot<?php echo $value['unique_id'];  ?>" value="<?php echo $value['slot']?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="formGroupExampleInput">Amount per slot</label>
                                      <input type="text" class="form-control" id="amount_per_slot<?php echo $value['unique_id'];  ?>" name="amount_per_slot<?php echo $value['unique_id'];  ?>" value="<?php echo $value['fixed_amount']?>" value="&#8358;">
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="formGroupExampleInput">Interest rate</label>
                                      <input type="text" class="form-control" id="interest_rate<?php echo $value['unique_id'];  ?>" name="interest_rate<?php echo $value['unique_id'];  ?>" value="<?php echo $value['interest_rate']?>" value="%">
                                    </div>
                                  </div>
                                  <div class="row">
                                   <div class="form-group col-md-6">
                                    <label for="formGroupExampleInput">Number of Month</label>
                                    <input type="text" class="form-control" id="no_of_month<?php echo $value['unique_id'];  ?>" name="no_of_month<?php echo $value['unique_id'];  ?>" value="<?php echo $value['no_of_month']?>">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="formGroupExampleInput">Maximum Number of Month</label>
                                    <input type="text" class="form-control" id="max_no_of_months<?php echo $value['unique_id'];  ?>" name="max_no_of_months<?php echo $value['unique_id'];  ?>" value="<?php echo $value['max_no_of_months']?>">
                                  </div>
                                  <!-- Default unchecked -->
                                  <!-- Default unchecked -->
                                  <div class="custom-control form-group custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="visibility<?php echo $value['unique_id'];  ?>" name="visibility<?php echo $value['unique_id'];  ?>" <?php echo ($value['visibility']==1 ? '' : 'checked');?>>
                                      <label class="custom-control-label" for="visibility<?php echo $value['unique_id'];  ?>">Hide Visibility</label>
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