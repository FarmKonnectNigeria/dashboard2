<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
$user_id = $_SESSION['uid'];
 if(isset($_POST['upload_payment_proof'])){
  $filename =  $_FILES['file']['name'];
  $size =  $_FILES['file']['size'];
  $type =  $_FILES['file']['type'];
  $tmpName  = $_FILES['file']['tmp_name'];
  $description = $_POST['description'];
  $amount = $_POST['amount'];
  $bank_name = $_POST['bank_name'];
  $account_name = $_POST['account_name'];
  $account_number = $_POST['account_number'];
  $upload_payment_proof = $object->upload_payment_proof($description, $amount, $user_id, $bank_name, $account_name, $account_number, $filename, $size, $tmpName, $type);
  $upload_payment_proof_decode = json_decode($upload_payment_proof, true);
  //$msg = $upload_payment_proof_decode['msg'];
  if($upload_payment_proof_decode['status'] == '1'){ 
    $object->insert_users_logs($_SESSION['uid'], 'Uploaded a payment proof');
    echo "<script> alert('Payment proof uploaded successfully');
    window.location.href = '';
    </script>";
  }else{
    echo "<script> alert('Error in uploading payment proof');
    </script>";
  }
 }
 $get_documents = $object->get_rows_from_table_by_user_id('bank_transfer_tbl','user_id',$user_id);
?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->


    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8"  >
     
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->

      <div class="row" style="margin-top: -160px;">

        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
                        <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#add_slot_modal"><i class="fas fa-plus-circle"></i> 
            Upload Payment Proof
          </button>

            <!-- Modal -->
            <div class="modal fade" id="add_slot_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Payment Proof</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="" enctype="multipart/form-data">
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-10">
                        <div class="form-group">
                          <label for="">Amount Paid</label>
                          <input type="number" name="amount" class="form-control" placeholder="Amount Paid" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-10">
                        <div class="form-group">
                          <label for="">Amount Number</label>
                          <input type="number" name="account_number" class="form-control" placeholder="Account number you paid to" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-10">
                        <div class="form-group">
                          <label for="">Account Name</label>
                          <input type="text" name="account_name" class="form-control" placeholder="Account name" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-10">
                        <div class="form-group">
                          <label for="">Bank Name</label>
                          <input type="text" name="bank_name" class="form-control" placeholder="Bank you paid to" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-10">
                        <div class="form-group">
                          <label for="">Description</label>
                          <textarea name="description" placeholder="Payment Description" class="form-control" required=""></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-10">
                        <div class="form-group">
                          <label for="">Payment Proof</label>
                          <input type="file" class="form-control" id="" name="file" required="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-success mt-2" type="submit" name="upload_payment_proof">Upload Payment Proof</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </form >
                  </div>
                </div>
              </div>
            </div>
              <h3 class="mb-0">These are the documents you uploaded</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_documents == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Amount Paid</th>                        
                        <th scope="col">Bank Name</th>
                        <th scope="col">Account Number</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Payment Proof</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Date Uploaded</th>

                  </tr>
                </thead>
                <?php
                $count = 1;
                  foreach ($get_documents as $value) {
                    $image_url = 'payment_proof'.$count;
                ?>
                <tbody>
                  <tr>
                    <td>&#8358;<?php echo $value['amount']?></td>
                    <td><?php echo $value['bank_name']?></td>
                    <td><?php echo $value['account_number']?></td>
                    <td><?php echo $value['account_name']?></td>
                    <td><?php echo $value['description']?></td>
                    <td><a href="<?php echo $value['payment_proof']?>" class="thumbnail fancybox" rel="ligthbox"><?php echo $image_url."<small>(click to view)</small>"?></a></td>
                    <td>
                      <?php
                        if($value['payment_status'] == 0){
                          echo "<small class='badge badge-primary'>Pending</small>";
                        }else if($value['payment_status'] == 1){
                          echo "<small class='badge badge-success'>Approved</small>";
                        }else if($value['payment_status'] == 2){
                          echo "<small class='badge badge-danger'>Rejected</small>";
                        }else{
                          echo "<small class='badge badge-danger'>No status</small>";
                        }
                      ?>
                    </td>
                    <td><?php echo $value['date_created']?></td>
                  </tr>
                </tbody>
                     
                      <?php $count++;} }?>
              </table><br><br>
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
      
          
      <br>
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