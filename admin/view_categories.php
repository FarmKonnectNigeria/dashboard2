<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$get_rows = $object->get_rows_from_one_table('package_category');



?>


<body class="">
  <?php include('includes/sidebar.php'); ?>
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
              <h4 class="mb-0"><?php if(!empty($msg)){ echo $msg; } ?></h4>
              <h3 class="mb-0">This is a list of all package categories</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Package name</th>
                        <!-- <th scope="col">Image path</th> -->
                        <th scope="col">Created by</th>
                        <th scope="col">Creation date</th>
                        <th>Action</th>
                   

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                        $getuser = $object->get_one_row_from_one_table('admin_tbl','unique_id',$value['created_by']);
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $value['name'];?></td>
                        <!-- <td><?php //echo $value['image_url'];?></td> -->
                        <td><?php echo $getuser['surname'].' '.$getuser['other_names']; ?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td> <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#view<?php echo $value['id']; ?>">View details</small> | <a class="btn btn-sm btn-primary" href="edit_categories.php?catid=<?php echo $value['unique_id'];?>">Edit</a>  </td>
                       <!-- <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#view<?php //echo $value['id']; ?>">Update Image</small> -->

                        <div class="modal fade bd-example-modal-md" id="view<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Category View</h5> 
                                 
                                </div>
                                <div class="modal-body">
                                   <div><img height="180px" width="320px"  src="<?php echo $value['image_url']; ?>"></div><br>
                                  <div>Package Name: <?php echo $value['name']; ?></div><br>
                                  <div><strong>Package Description:</strong></div><textarea  class="form-control ckeditor" id="package_description" name="package_description"  readonly cols="40" rows="10"><?php echo $value['description'];?></textarea>                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>


                           <div class="modal fade bd-example-modal-md" id="update<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                   <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Category Update</h5> 
                               
                                </div>
                                <div class="modal-body">
                                   <div><img height="180px" width="320px"  src="<?php echo $value['image_url']; ?>"></div><br>
                                  <form method="post" id="update_category_form">
                                      <div>Category Name: <input value="<?php echo $value['name']; ?>" type="text" class="form-control form-control-sm" name="cat_name" id="cat_name"><input type="text" id="cat_id" name="cat_id" value="<?php echo $value['unique_id']; ?>" class="form-control form-control-sm" ></div><br>
                                      <div><strong>Category Description:</strong></div><textarea  class="form-control ckeditor" id="package_description" name="package_description"  cols="40" rows="10"><?php echo $value['description'];?></textarea> <br>
                                      <input type="submit" name="cmd_edit_cat" id="cmd_edit_cat" value="Update Package" class="btn btn-sm btn-success">  
                                  </form>
                                                                 
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
  

                      </tr>
                <?php } } ?>
                 
                 
                 
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <!-- <nav aria-label="...">
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