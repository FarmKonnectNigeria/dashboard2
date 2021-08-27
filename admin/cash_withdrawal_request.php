<?php include('includes/instantiated_files2.php');
require_once('../classes/algorithm_functions.php');
include('includes/header.php'); 

$table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_withdrawal = $object->get_withdrawal_requests();

 // if(isset($_POST['upload_document'])){
 //           
$msg = '';
 if(isset($_POST['process_request'])){
    $name_of_bank = $_POST['name_of_bank'];
    $method_of_transfer = $_POST['method_of_transfer'];
    $reference_number = isset($_POST['reference_number']) ? $_POST['reference_number'] : '';
    $teller_number = isset($_POST['teller_number']) ? $_POST['teller_number'] : '';
     $amount_withdrawn = isset($_POST['amount_withdrawn']) ? $_POST['amount_withdrawn'] : '';
      $request_id = isset($_POST['request_id']) ? $_POST['request_id'] : '';
      $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
      $created_by = $_SESSION['adminid'];
      $filename =  $_FILES['file']['name'];
      $size =  $_FILES['file']['size'];
      $type =  $_FILES['file']['type'];
      $tmpName  = $_FILES['file']['tmp_name'];
      $get_username = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
      $fullname_user = $get_username['surname'].' '.$get_username['other_names'];
      $notification_type = 'alert';
      $notification_heading = 'Withdrawal Request';
      $notification = 'Your withdrawal request of '.$amount_withdrawn. ' has been processed successfully';
      $notification1 = 'A withdrawal request of '.$amount_withdrawn. ' placed by '.$fullname_user.' has been processed by the Cash Officer';
  
    $process_request = $object->process_withdrawal_request($name_of_bank, $method_of_transfer, $reference_number, $teller_number, $created_by, $amount_withdrawn, $request_id, $filename, $size, $tmpName, $type, $user_id);
    $process_request_decode = json_decode($process_request, true);
    $msg = $process_request_decode['msg'];

    if($msg == "success"){
      $object->insert_logs($uid, 'Processed a withdrawal request');
      $object->insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification);
      $get_SA = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Super Administrator');
        $get_SA_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_SA['unique_id']);
        foreach ($get_SA_id as $value) {
          insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification1);
        }
        $get_acc = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Accountant');
        $get_acc_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_acc['unique_id']);
        foreach ($get_acc_id as $value) {
            insert_into_admin_notifications_tbl($notification_type, $value['unique_id'], $notification_heading, $notification1);
        }
    }

 }
?>


<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Cash Officer' ){
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
              <h3 class="mb-0">This is a list of all Withdrawals</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush " id="datatable-basic">
                <thead class="thead-light">
                 <?php if($get_withdrawal == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">First name</th>
                        
                        <th scope="col">Last name</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Amount Requested</th>
                        <th scope="col">Bank Details</th>
                        <th scope="col">Withdrawal Type</th>
                        <th scope="col">Date Requested</th>
                        <th scope="col">Status</th>
                        <th>Action</th>
                   

                  </tr>
                </thead>
                <tbody>
                   <?php
                   $count = 1;
                   foreach($get_withdrawal as $value){
                    $getuser = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']); 
                     ?>
                     <tr>
                        <td><?php echo $count;?></td>
                        <td><?php echo $getuser['surname'];?></td>
                        <td><?php echo $getuser['other_names'];?></td>
                         <td><?php echo $getuser['email'];?></td>
                        <td> &#8358; <?php echo number_format($value['amount_withdrawn']);?></td>
                         <td>
                          <ul>
                            <li>
                              <strong>Bank Name:</strong> <?php echo $getuser['bank_name'] !=='' ? $getuser['bank_name'] : 'Nil';?>
                            </li>
                             <li>
                              <strong>Account Number:</strong> <?php echo $getuser['account_number'] !=='' ? $getuser['account_number'] : 'Nil';?>
                            </li>
                            <li>
                              <strong>Account Name:</strong> <?php echo $getuser['account_name'] !=='' ? $getuser['account_name'] : 'Nil';?>
                            </li>
                            <li>
                              <strong>BVN:</strong> <?php echo $getuser['bvn'] !== '' ? $getuser['bvn'] : 'Nil';?>
                            </li>
                            <li>
                              <strong>Account Type:</strong> <?php echo $getuser['account_type'] !== '' ? $getuser['account_type'] : 'Nil';?>
                            </li>
                          </ul>
                          
                          </td>
                        <td><?php echo "<span class='badge badge-success'>wallet</span>";?>
                        </td>
                        <td><?php echo $value['date_created'];?></td>
                        <td>
                          <?php
                            if($value['withdrawal_status'] == 2 ){
                          ?> 
                          <small class="badge badge-success">Approved by SA</small>
                        <?php } else if($value['withdrawal_status'] == 1){
                          ?>
                          <small class="badge badge-primary">Pending Approval by SA</small>
                          <?php
                        }else if($value['withdrawal_status'] == 4){
                          ?>
                          <small class="badge badge-success">Approved by Accountant</small>
                          <?php
                        }else if($value['withdrawal_status'] == 3){
                          ?>
                          <small class="badge badge-danger">Rejected by SA</small>
                          <?php
                        }else if($value['withdrawal_status'] == 5){
                          ?>
                          <small class="badge badge-danger">Rejected by Accountant</small>
                          <?php
                        }else if($value['withdrawal_status'] == 6){
                          ?>
                          <small class="badge badge-success">Processed</small>
                          <?php
                        }
                          ?>
                        </td>
                        <td>
                      <?php if($value['withdrawal_status'] == 4){
                          ?>
                        <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Process Request</small>
                        <?php
                          }
                        ?>
                        </td>
                        
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
                                  <form method="post" id="process_withdrawal_request_form<?php echo $value['unique_id']; ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label for="formGroupExampleInput">Name of Bank</label>
                                      <input type="text" name="name_of_bank" class="form-control">
                                    </div>
                                     <div class="form-group">
                                      <label for="formGroupExampleInput">Method of payment</label>
                                      <select class="form-control" name="method_of_transfer" id="method_of_transfer">
                                        <option value="select_an_option">Select method of payment</option>
                                        <option value="online_transfer">Online Transfer</option>
                                        <option value="offline_payment">Offline Payment</option>
                                      </select>
                                    </div>
                                    <div class="form-group" id="reference_number" style="display: none">
                                      <label for="formGroupExampleInput">Reference Number</label>
                                      <input type="text" name="reference_number" class="form-control">
                                    </div>
                                    <div class="form-group" id="teller_number" style="display: none">
                                      <label for="formGroupExampleInput">Teller Number</label>
                                      <input type="text" name="teller_number" class="form-control">
                                    </div>
                                    <div class="form-group" id="transfer_slip" style="display: none">
                                      <label for="formGroupExampleInput">Transfer Slip</label>
                                      <input type="file" name="file" class="form-control">
                                    </div>
                                    <input type="hidden" class="form-control" id="request_id" name="request_id" value="<?php echo $value['unique_id']?>">
                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $value['user_id']?>">
                                    <input type="hidden" class="form-control" id="amount_withdrawn" name="amount_withdrawn" value="<?php echo $value['amount_withdrawn']?>">

                                       <input type="submit" class="btn btn-success" value="Process" name="process_request" id="<?php echo $value['unique_id']; ?>">
                                    
                                </form>
                                  </div>
                                <div class="modal-footer">
                                 
                                  <!-- <button type="button" class="btn btn-success process_request" name="process_request" id="<?php //echo $value['unique_id']; ?>">Process</button> -->
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      </tr>
                <?php $count++;} } ?>
                 
                 
                 
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
  $(document).ready(function () {
$('#datatable-basic').DataTable();
//$('.dataTables_length').addClass('bs-select');
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("select#method_of_transfer").change(function(){
        var selected_option = $(this).children("option:selected").val();
        if(selected_option == 'select_an_option'){
           $("div#reference_number").css("display", "none");
          $("div#teller_number").css("display", "none");
          $("div#transfer_slip").css("display", "none");
      }
        else if(selected_option == 'online_transfer'){
          $("div#reference_number").css("display", "block");
          $("div#teller_number").css("display", "none");
          $("div#transfer_slip").css("display", "none");
         
      }
      else if(selected_option == 'offline_payment'){
        $("div#reference_number").css("display", "none");
         $("div#teller_number").css("display", "block");
          $("div#transfer_slip").css("display", "block");
      }
    });
<?php
if(!empty($msg)){
if($msg == "success"){
  ?>
      $.alert({
      title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "Withdrawal Request has been successfully processed"
    });
    setTimeout( function(){ window.location.href = "cash_withdrawal_request";}, 4000);
    <?php
   }
   else if($msg == "empty_fields"){
    ?>
      $.alert({
      title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "Empty field(s) found"
    });
   <?php }

   else if($msg == "record_exists"){
    ?>
      $.alert({
      title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "Withdrawal Request has already been processed"
    });
   <?php }
     else if($msg == "balance_less"){
      ?>
      $.alert({
      title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "Withdrawal Request could not be processed, user's wallet balance is less than the amount"
    });
   <?php }
   else{
    ?>
      $.alert({
      title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "Server Error"
    });
   <?php } }?>

});
</script>