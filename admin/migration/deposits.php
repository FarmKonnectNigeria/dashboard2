<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_table_by_user_id('users_tbl', 'access_level', 1);

if(isset($_POST['cmd_submit'])){
	$deposit_date = $_POST['deposit_date'];
	$user_id = $_POST['user_id'];
	$payment_method = $_POST['payment_method'];
	$description = $_POST['description'];

	$amount = $_POST['amount'];
	$insert = $object->insert_deposits($user_id,$amount,$payment_method,$deposit_date,'11', $description);
	$get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
	$user_name = $get_user['surname']." ".$get_user['other_names'];

	if($insert){
          $msg = '<meta http-equiv="refresh" content="8000; URL=deposits.php" /><div class="alert alert-success"><strong>Success! </strong>Deposit Entry was successful. </div>';
          			$get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
          			$fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
                    $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Added Deposits for ".$user_name);

	}else{
          $msg = '<meta http-equiv="refresh" content="8000; URL=deposits.php" /><div class="alert alert-danger"><strong>Oops! </strong> Deposit Entry was NOT successful. </div>'; 

	}
}

 ?>
<!DOCTYPE html>
<html>
<head>

	<title>Deposits</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

</head>

<body>
	<div class="container">
		    <br>
		    <br>
		     <?php if(!empty($msg)){

		     		echo $msg;

		      } ?>	
			<br>
		<div class="row">
			<div class="col-md-3"> </div>
			<div class="col-md-6"> 
				<h3>ADD DEPOSIT FOR ACTIVATED USERS</h3>
				<a href="index.php">Back to Home</a> | <a href="view_deposits.php">View Client's Deposits</a> |  <a href="deposits_unactivated.php">Add deposit for unactivated users</a> 
				<h3><strong>Deposits(From Client's Bank Account to Wallet)</strong> </h3>
				<form method="post">
				<label>Client Name</label><br>
				<select required="" class="form-control form-control-sm js-example-basic-single" id="user_id" name="user_id">
				<option value="">select a user</option>
				<?php foreach($get_rows as $client){?>
				<option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].'  '.$client['other_names'].' '.$client['email']; ?></option>
				<?php } ?>
				</select></br><br>

				<label>Payment Method</label><br>
				<select required="" class="form-control" id="payment_method" name="payment_method">
				
				<option value="">select a payment method</option>
				<option value="pactpay">Pactpay</option>
				<option value="paystack">Paystack</option>
				<option value="bank_transfer">Bank Transfer</option>
				<option value="cash_deposit">Cash Deposit</option>
				<option value="conversion">Conversion</option>
				
				</select></br>

				<label>Amount:</label><br>
				<input required="" class="form-control form-control-sm" type="number" name="amount" id="amount"><br><br>
				<label>Payment Description:</label><br>
				<textarea name="description" class="form-control" rows="10" cols="50" id="description"></textarea><br><br>
				<label>Deposit Date:</label><br>
				<input required="" class="form-control form-control-sm"  type="date" name="deposit_date" id="deposit_date"><br>
				<input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="Add Deposits" name="cmd_submit">
				</form>
		
			</div>
			<div class="col-md-3"> </div>
		</div>
			

	</div>
 

<script type="text/javascript">
		// In your Javascript (external .js resource or <script> tag)
		$(document).ready(function() {
		$('.js-example-basic-single').select2();
		});  
</script>
</body>
</html>			