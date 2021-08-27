<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table_by_one_param('users_tbl','access_level',1);
$view = "";
$msg2 = "";
if(isset($_POST['cmd_submit'])){
	$user_id = $_POST['user_id'];
	$view = $object->get_rows_from_one_table_by_two_params("debit_wallet_tbl",'user_id',$user_id,'purpose','7');
  $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
  $user_name = $get_user['surname']." ".$get_user['other_names'];
	if($view != null){

          $msg = 'not_empty'; 
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Viewed Withdrawal of ".$user_name);
		

	}else{
          $msg = 'empty'; 
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Viewed Withdrawal of ".$user_name);

	}
}


if(isset($_GET['del'])){
		$delid = $_GET['del'];
     	$delete = $object-> delete_a_row('debit_wallet_tbl','unique_id',$delid);
      $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
      $user_name = $get_user['surname']." ".$get_user['other_names'];
        if($delete){
        	 $msg2 = '<meta http-equiv="refresh" content="5; URL=view_withdrawals.php" /><div class="alert alert-success"><strong>Success! </strong>Withdrawal entry was deleted successfully. </div>';
           $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Deleted Withdrawal of ".$user_name); 
        }else{
        	 $msg2 = '<meta http-equiv="refresh" content="5; URL=view_withdrawals.php" /><div class="alert alert-danger"><strong>Success! </strong>Withdrawal deletion was NOT successfull. </div>'; 
        }
     
}

 ?>
<!DOCTYPE html>
<html>
<head>

	<title>Withdrawals</title>
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
				<a href="index.php">Back to Home</a> | <a href="old_platform_withdrawal.php">Add Withdrawals</a>  
				<h3><strong>Withdrawals(From Wallet to Bank Account)</strong> </h3>
				<form method="post">
				<label>Client Name</label><br>
				<select required="" class="form-control form-control-sm js-example-basic-single" id="user_id" name="user_id">
				<?php foreach($get_rows as $client){?>
				<option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].' - '.$client['other_names']. ' ('.$client['email'].')'; ?></option>
				<?php } ?>
				</select></br><br>

				
				<input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="View Withdrawals" name="cmd_submit">
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
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Fullname(email)</th>
                        <th scope="col">Amount Requested</th>
                        <th scope="col">Purpose</th>
                        <th scope="col">Withdrawal Status</th>
                        <th scope="col">Withdrawal date</th>
                        <th scope="col"></th>
                        <!-- <th scope="col">Date</th> -->
                        <!-- <th scope="col">Action</th> -->

                  </tr>
                </thead>
                <tbody>
                   <?php
                       


                      foreach($view as $value){
                        if($value['purpose'] == 7){
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
                          
                        
                      ?>
                     <tr>
                        <td><?php echo $getuser['other_names'].' '.$getuser['surname'].' ('.$getuser['email'].')';?></td>
                        <td><?php echo '&#8358;'.number_format($value['amount_withdrawn']);?></td>
                        <td><?php echo $value['description']; ?></td>
                        <td><?php echo $withdrawal_status;?></td>
                        <td><?php echo $object->formatted_date($value['date_created']); ?></td>
                        <td><a style="color:red; font-size: 12px;" href="view_withdrawals.php?del=<?php echo $value['unique_id']; ?>" ><strong>delete</strong></a></td>
                      
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
 

<script type="text/javascript">
		// In your Javascript (external .js resource or <script> tag)
		$(document).ready(function() {
		$('.js-example-basic-single').select2();
		});  
</script>
</body>
</html>