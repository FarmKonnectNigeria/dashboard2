<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table_by_one_param('users_tbl','access_level',1);
$get_rows2 = $object->get_rows_from_one_table_by_one_param('users_tbl','access_level',1);

if(isset($_POST['cmd_submit'])){
	$transfer_date = $_POST['transfer_date'];
	$senderid = $_POST['sender_id'];
	$beneficiary_id = $_POST['beneficiary_id'];
	$amount = $_POST['amount'];

	$get_sender = $object->get_one_row_from_one_table('users_tbl','unique_id',$senderid);
	$sender = $get_user['surname']." ".$get_user['other_names'];

	$get_beneficiary = $object->get_one_row_from_one_table('users_tbl','unique_id',$beneficiary_id);
	$beneficiary = $get_user['surname']." ".$get_user['other_names'];

	
	$insert = $object->insert_tranfers($senderid,$beneficiary_id,$amount,$transfer_date);
	if($insert){
          $msg = '<meta http-equiv="refresh" content="8000; URL=tranfers.php" /><div class="alert alert-success"><strong>Success! </strong>Transfer Entry was successful. </div>'; 
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
          			$fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Made Transfer from ".$sender. " to ".$beneficiary);

	}else{
          $msg = '<meta http-equiv="refresh" content="8000; URL=tranfers.php" /><div class="alert alert-danger"><strong>Oops! </strong> Transfer Entry was NOT successful. </div>'; 

	}
}

 ?>
<!DOCTYPE html>
<html>
<head>

	<title>Tranfers</title>
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
				<a href="index.php">Back to Home</a> | <a href="view_transfers.php">View Client's Transfers</a>  
				<h3><strong>Transfers(Client-to-Client Wallet Transfer)</strong> </h3>
				<form method="post">
				<label>Sender Client</label><br>
				<select required="" class="form-control form-control-sm js-example-basic-single2" id="sender_id" name="sender_id">
				<option value="">select a user</option>
				<?php foreach($get_rows as $client){?>
				<option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].' - '.$client['other_names']; ?></option>
				<?php } ?>
				</select></br><br>

				<label>Beneficiary Client</label><br>
				<select required="" class="form-control form-control-sm js-example-basic-single" id="beneficiary_id" name="beneficiary_id">
				<option value="">select a user</option>
				<?php foreach($get_rows2 as $client2){?>
				<option value="<?php echo $client2['unique_id']; ?>"><?php echo $client2['surname'].' - '.$client2['other_names']; ?></option>
				<?php } ?>
				</select></br></br>
				<label>Amount:</label><br>
				<input required="" class="form-control form-control-sm" type="number" name="amount" id="amount"><br><br>
				<label>Transfer Date:</label><br>
				<input required="" class="form-control form-control-sm"  type="date" name="transfer_date" id="transfer_date"><br>
				<input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="Add Tranfers" name="cmd_submit">
				</form>
		
			</div>
			<div class="col-md-3"> </div>
		</div>
			

	</div>
 

<script type="text/javascript">
		// In your Javascript (external .js resource or <script> tag)
		$(document).ready(function() {
		$('.js-example-basic-single').select2();
		$('.js-example-basic-single2').select2();
		});  
</script>
</body>
</html>