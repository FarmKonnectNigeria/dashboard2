<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table('users_tbl');

if(isset($_POST['cmd_submit'])){
	$withdrawal_date = $_POST['withdrawal_date'];
	$user_id = $_POST['user_id'];
	$amount = $_POST['amount'];
	$desc = $_POST['desc'];
	$insert = $object->insert_withdrawals_and_net_from_wallet($user_id,$amount,'7',$withdrawal_date,$desc);
	$get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
	$user_name = $get_user['surname']." ".$get_user['other_names'];
	if($insert){
          $msg = '<meta http-equiv="refresh" content="8000; URL=withdrawals.php" /><div class="alert alert-success"><strong>Success! </strong>Withdrawal action was successful. </div>';
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
          			$fullname = $get_fullname['surname'].' '.$get_fullname['other_names']; 
    $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Added Withdrawal for ".$user_name);

	}else{
          $msg = '<meta http-equiv="refresh" content="8000; URL=withdrawals.php" /><div class="alert alert-danger"><strong>Oops! </strong>Withdrawal action was NOT successful.</div>'; 

	}
}

 ?>
<!DOCTYPE html>
<html>
<head>

	<title>Withdrawals--OLD PLATFORM</title>
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
			<div class="col-md-2"> </div>
			<div class="col-md-8"> 
				<a href="index.php">Back to Home</a> | <a href="view_withdrawals.php">View Client's Withdrawals-- OLD PLATFORM</a>  
				<h3 style="color:red;"><strong>Withdrawals  (OLD PLATFORM):<br> <span style="font-size: 14px;">This LOGS and NETS from the WALLET</span> </strong> </h3>
				<form method="post">
				<label>Client Name</label><br>
				<select required="" class="form-control form-control-sm js-example-basic-single" id="user_id" name="user_id">
				<?php foreach($get_rows as $client){?>
				<option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].'  '.$client['other_names']. '  '.$client['email'].'  '; ?></option>
				<?php } ?>
				</select></br><br>

				<label>Amount:</label><br>
				<input required="" class="form-control form-control-sm" type="number" name="amount" id="amount"><br><br>
				
				
				<label>Purpose:</label><br>
				<textarea name="desc" id="desc" class="form-control form-control-sm"></textarea>
		     	<br><br>
				
				<label>Withdrawal Date:</label><br>
				<input required="" class="form-control form-control-sm"  type="date" name="withdrawal_date" id="withdrawal_date"><br><br>
				<input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="Log Withdrawal" name="cmd_submit">
				</form>
		
			</div>
			<div class="col-md-2"> </div>
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