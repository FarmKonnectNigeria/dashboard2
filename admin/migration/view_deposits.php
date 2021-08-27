<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table('users_tbl');
$view = "";
$msg2 = "";
if(isset($_POST['cmd_submit'])){
  $user_id = $_POST['user_id'];
  $view = $object->get_rows_from_one_table_by_two_params("debit_wallet_tbl",'user_id',$user_id,'purpose','11');
  $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
  $user_name = $get_user['surname']." ".$get_user['other_names'];

  if($view != null){

          $msg = 'not_empty';
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names']; 
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Viewed Deposits of ".$user_name);
    

  }else{
          $msg = 'empty'; 
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names']; 
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Viewed Deposits of ".$user_name);

  }
}


if(  isset($_GET['del'])  && isset($_GET['usid']) && isset($_GET['amount'])    ){
    $delid = $_GET['del'];
    $user_id = $_GET['usid'];
        $current_wallbal = $object->get_wallet_balance($user_id);
        $cwlldec = json_decode($current_wallbal,true);
        $wlbbb = $cwlldec['msg'];
        
        
        
        $amount = $_GET['amount'];
        $new_wall_bal = $wlbbb - $amount;
        $user_id = $_GET['usid'];
        
        
        ////update wallet balance
        $update_wallet_balance = $object->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_wall_bal);
        $uwdec = json_decode($update_wallet_balance,true);
        if($uwdec['status'] == '0'){
              $msg2 = '<meta http-equiv="refresh" content="5; URL=view_deposits.php" /><div class="alert alert-danger"><strong>Success! </strong>Deposit deletion was NOT successfull. </div>'; 
        }else{
            $delete = $object-> delete_a_row('debit_wallet_tbl','unique_id',$delid);
            $delete2 = $object-> delete_a_row('credit_wallet_tbl','unique_id',$delid);
            $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
            $user_name = $get_user['surname']." ".$get_user['other_names'];
            if(   ($delete === true)   &&  ($delete2 === true) ){
            $msg2 = '<meta http-equiv="refresh" content="5; URL=view_deposits.php" /><div class="alert alert-success"><strong>Success! </strong>Deposit entry was deleted successfully. </div>'; 
            $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
            $fullname = $get_fullname['surname'].' '.$get_fullname['other_names']; 
            $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Deleted Deposits of ".$user_name);
            }else{
            $msg2 = '<meta http-equiv="refresh" content="5; URL=view_deposits.php" /><div class="alert alert-danger"><strong>Success! </strong>Deposit deletion was NOT successfull. </div>'; 
            }
        }
        
       
     
}

 ?>
<!DOCTYPE html>
<html>
<head>

  <title>Deposits</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

</head>

<body>
  <div class="container">
         <br>
        <br>
         <?php if(!empty($msg2)){

            echo $msg2;

          } ?>  
      <br>
        
    <div class="row">
      <div class="col-md-3"> </div>
      <div class="col-md-6"> 
        <a href="index.php">Back to Home</a> | <a href="deposits.php">Add Deposits</a>  
        <h3><strong>Deposit(From Bank Account to Wallet)</strong> </h3>
        <form method="post">
        <label>Client Name</label><br>
        <select required="" class="form-control form-control-sm js-example-basic-single" id="user_id" name="user_id">
        <?php foreach($get_rows as $client){?>
        <option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].' - '.$client['other_names']. ' ('.$client['email'].')'; ?></option>
        <?php } ?>
        </select></br><br>

        
        <input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="View Deposits" name="cmd_submit">
        </form>
    
      </div>
      <div class="col-md-3"> </div>
    </div>
    
    <br>
    <br>
         <?php if(!empty($msg)){ ?>
          <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($view == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ 
                      
                      $current_wallbal2 = $object->get_wallet_balance($user_id);
        $cwlldec2 = json_decode($current_wallbal2,true);
        $wlbbb2 = $cwlldec2['msg'];
                      
                      ?>
                      
                      <h4>Current Wallet Balance:<strong>N<?php echo number_format($wlbbb2); ?></strong></h4>
                      
                  <tr>
                    
                        <th scope="col">Fullname & Email</th>
                        <th scope="col">Amount Deposited</th>
                        <th scope="col">Deposit Description</th>
                        <th scope="col">Deposit Status</th>
                        <th scope="col">Deposit date</th>
                        <th scope="col"></th>
                        <!-- <th scope="col">Date</th> -->
                        <!-- <th scope="col">Action</th> -->

                  </tr>
                </thead>
                <tbody>
                   <?php
                       


                      foreach($view as $value){
                        if($value['purpose'] == 11){
                          $withdrawal_status = "<small style='color:white;background:green;' class='badge badge-sm badge-success'>processed</small>"; }
                         elseif($value['purpose'] == 5) {
                           $withdrawal_status = "<small class='badge badge-sm badge-primary'>pending</small>"; 
                          }elseif($value['purpose'] == 6) {
                           $withdrawal_status = "<small class='badge badge-sm badge-danger'>declined</small>"; 
                          }elseif($value['purpose'] == 8) {
                           $withdrawal_status = "<small class='badge badge-sm badge-default'>cancelled</small>"; 
                          }elseif($value['purpose'] == 9) {
                           $withdrawal_status = "<small class='badge badge-sm badge-success'>approved</small>"; 
                          }else{
                           $withdrawal_status = "<small class='badge badge-sm badge-primary'>pendinggg</small>"; 
                             
                          }

                          $getpackage = $object->get_one_row_from_one_table('package_tbl','unique_id',$value['package_id']);
                          $getuser = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                          $get_others = $object->get_one_row_from_one_table_by_two_params('subscribed_user_tbl','user_id',$value['user_id'], 'package_id',$value['package_id']);
                          $get_details = $object->get_one_row_from_one_table('credit_wallet_tbl', 'unique_id', $value['unique_id']);
                          
                        
                      ?>
                     <tr>
                      
                        <td><?php echo $getuser['other_names'].' '.$getuser['surname'].' ('.$getuser['email'].') <===>'. $getuser['unique_id'];?></td>
                        <td><?php echo '&#8358;'.number_format($value['amount_withdrawn']);?></td>
                        <td><?php echo $get_details['description'];?></td>
                        <td><?php echo $withdrawal_status;?></td>
                        <td><?php echo $object->formatted_date($value['date_created']); ?></td>
                        <td><a class="text-success" href="edit_deposit.php?usid=<?php echo $value['user_id']; ?>&uid=<?php echo $value['unique_id']; ?>" ><strong>edit</strong></a></td>
                        <td><a class="text-danger" style = "font-size: 12px;" href="view_deposits.php?del=<?php echo $value['unique_id']; ?>&usid=<?php echo $value['user_id']; ?>&amount=<?php echo $value['amount_withdrawn']; ?>" ><strong>delete</strong></a></td>
                      
                       <!--  <td><?php //echo $value['date_created'];?></td> -->
                   <!--  <td><a href="#" data-target="#view_earnings<?php //echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm btn-primary">view earnings</a></td> -->


                    <!-- view history here -->


                      </tr>
                <?php } } ?>
                 
                 
                 
                </tbody>
              </table>
          </div>
          

         <?php  } ?>  
      <br>  

  </div>
  
  
  
  <hr>
    <div class="container-fluid mt--7">
      <!-- Table -->
    
    




    </div>
 

<script type="text/javascript">
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
    });  
</script>
</body>
</html>