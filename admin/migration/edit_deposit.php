<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $_GET['usid']);
$get_details = $object->get_one_row_from_one_table('credit_wallet_tbl', 'unique_id', $_GET['uid']);

if(isset($_POST['cmd_submit'])){
	$user_id = $_GET['usid'];
	$unique_id = $_GET['uid'];
	$description = $_POST['description'];
	$update_deposit = $object->update_with_one_param('credit_wallet_tbl', 'unique_id', $unique_id, 'description', $description);
	$update_deposit_decode = json_decode($update_deposit, true);
	$get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
  	$user_name = $get_user['surname']." ".$get_user['other_names'];

	if($update_deposit_decode['status'] == 1){
          $msg = '<div class="alert alert-success"><strong>Success! </strong>Deposit has been editied successfully.You will be redirected shortly </div><meta http-equiv="refresh" content="5; URL=view_deposits.php" />';
          			$get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
          			$fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
                    $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Edited Deposit for ".$user_name);

	}else{
          $msg = '<meta http-equiv="refresh" content="5000; URL=deposits.php" /><div class="alert alert-danger"><strong>Oops! </strong> Error in editing deposit. </div>'; 

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
				<a href="index.php">Back to Home</a> | <a href="view_deposits.php">View Client's Deposits</a>  
				<h3><strong>Edit Deposit</strong> </h3><br>
				<h4>Name: <?php echo $get_rows['surname'].' '.$get_rows['other_names'];?></h4>
				<h4>Amount: &#8358;<?php echo number_format($get_details['amount'])?></h4>
				<h4>Date Deposited: <?php echo $get_details['date_created']?></h4><br>
				<form method="post">
				<label>Payment Description:</label><br>
					<textarea name="description" class="form-control" rows="10" cols="50" id="description"><?php echo $get_details['description'];?></textarea><br><br>
					<input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="Edit Deposit" name="cmd_submit">
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