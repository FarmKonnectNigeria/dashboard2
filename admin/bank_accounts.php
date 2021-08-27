<?php 
include('includes/instantiated_files2.php');
include('includes/header.php'); 

$get_rows = $object->get_rows_from_one_table('bank_accounts');

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
    <!-- <div class="header bg-gradient-default pb-8 pt-5 pt-md-8"  >
     
    </div> -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">This is a the list of Bank Accounts used by FarmKonnect <span><button type="button" class="btn btn-primary btn-sm float-right mb-3" data-toggle="modal" data-target="#add_account"><i class="fas fa-plus-circle"></i> Add Account</button></span></h3> 
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                        <th scope="col">Bank Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Account Number</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">Account Type</th>
                        <th scope="col">Date Added</th>
                       <th>Action</th>
                   

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                     ?>
                     <tr>
                       
                        <td><?php echo $value['bank_name'];?></td>
                         <td><?php echo $value['description'];?></td>
                        <td><?php echo $value['account_number'];?></td>
                        <td><?php echo $value['account_name'];?></td>
                        <td><?php echo $value['account_type'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                        <td> <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_account<?php echo $value['id']; ?>">Edit</small> <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_account">Delete</small> </td>
                      </tr>
            <div class="modal fade" id="edit_account<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Bank Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form  id="edit_bank_account_form<?php echo $value['id']; ?>" method="post"> 
                        <div class="form-group">
                          <label for="formGroupExampleInput">Bank Name</label>
                          <input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo $value['bank_name'];?>">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="<?php echo $value['description'];?>">
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Account Number</label>
                            <input type="number" class="form-control" id="account_number" name="account_number" value="<?php echo $value['account_number'];?>">
                          </div>
                        <div class="form-group">
                          <label for="formGroupExampleInput">Account Name</label>
                          <input type="text" name="account_name" id="account_name" class="form-control" value="<?php echo $value['account_name'];?>">
                        </div>
                        <div class="form-group">
                          <label for="formGroupExampleInput">Account Type</label>
                          <input type="text" name="account_type" id="account_type" class="form-control" value="<?php echo $value['account_type'];?>">
                          <input type="hidden" name="unique_id" value="<?php echo $value['unique_id'];?>">
                        </div>
                     </form> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right btn-small edit_bank_account" name="add_bank_account" id="<?php echo $value['id']; ?>">Edit Account</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="delete_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Bank Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to delete this bank account?
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-danger float-right btn-small delete_bank_account" name="delete_bank_account" id="<?php echo $value['id']; ?>">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form method="post" id="delete_bank_account_form">
                      <input type="hidden" name="unique_id" value="<?php echo $value['unique_id'];?>">
                    </form>
                  </div>
                </div>
              </div>
            </div>
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


       <!-- Modal -->
            <div class="modal fade" id="add_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Bank Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form  id="add_bank_account_form" method="post"> 
                        <div class="form-group">
                          <label for="formGroupExampleInput">Bank Name</label>
                          <input type="text" name="bank_name" id="bank_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Account Number</label>
                            <input type="number" class="form-control" id="account_number" name="account_number">
                          </div>
                        <div class="form-group">
                          <label for="formGroupExampleInput">Account Name</label>
                          <input type="text" name="account_name" id="account_name" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="formGroupExampleInput">Account Type</label>
                          <input type="text" name="account_type" id="account_type" class="form-control">
                        </div>
                     </form> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right btn-small" name="add_bank_account" id="add_bank_account">Add Account</button>
                  </div>
                </div>
              </div>
            </div>

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>