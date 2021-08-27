<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

// $table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_rows = $object->get_rows_from_one_table_by_one_param('bank_transfer_tbl', 'payment_status', 0);

?>


<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name !=  'Accountant'){
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
              <h3 class="mb-0">This is the List of Pending Bank Deposits of users</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                    <th scope="col">Amount Paid</th>                        
                    <th scope="col">Bank Name</th>
                    <th scope="col">Account Number</th>
                    <th scope="col">Account Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Payment Proof</th>
                    <th scope="col">Date Uploaded</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                    $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                         
                     ?>
                     <tr>
                    <td>&#8358;<?php echo $value['amount']?></td>
                    <td><?php echo $value['bank_name']?></td>
                    <td><?php echo $value['account_number']?></td>
                    <td><?php echo $value['account_name']?></td>
                    <td><?php echo $value['description']?></td>
                    <td><a href="<?php echo '../'.$value['payment_proof']?>" class="thumbnail fancybox" rel="ligthbox"><?php echo "Payment proof<small>(click to view)</small>"?></a></td>
                     <td><?php echo $value['date_created']?></td>
                        <?php if($value['payment_status'] == 0){ ?>
                          <td> <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Approve</small>
                          <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject<?php echo $value['id']; ?>">Reject</small> </td>
                        <?php }else if($value['payment_status'] == 1){ ?>
                          <td><small class="badge badge-success">Approved</small></td>
                        <?php }else if($value['payment_status'] == 2){?>
                           <td><small class="badge badge-danger">Rejected</small></td>
                         <?php }?>
                      </tr>
                        <div class="modal fade bd-example-modal-md" id="approve<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Approve Request</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                   <form method="post" id="credit_wallet_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $value['user_id']?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                    <input type="hidden" class="form-control" id="amount" name="amount" value="<?php echo $value['amount']?>">
                                  </form>
                                  Are you sure you want to approve this request?
                                  </div>
                                <div class="modal-footer">
                                   <button type="button" class="btn btn-success approve_credit_wallet" name="approve_credit_wallet" id="<?php echo $value['unique_id']; ?>">Approve</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="modal fade bd-example-modal-md" id="reject<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Reject Request</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                   <form method="post" id="credit_wallet_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $value['user_id']?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                    <input type="hidden" class="form-control" id="amount" name="amount" value="<?php echo $value['amount']?>">
                                  </form>
                                  Are you sure you want to reject this request?
                                  </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger reject_credit_wallet" name="reject_credit_wallet" id="<?php echo $value['unique_id']; ?>">Reject</button>
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
<script type="text/javascript">
    $(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
  </script>