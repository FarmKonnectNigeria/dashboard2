<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table_by_one_param('users_tbl','access_level',1);

if(isset($_POST['cmd_submit'])){

	$user_id = $_POST['user_id'];
	$amount = $_POST['amount'];
	 
	
	//get current wallet balance
	$get_row = $object->get_one_row_from_one_table('wallet_tbl','user_id',$user_id);
		if($get_row == null){
		  $oldw = 0;
		}else{
		  $oldw =   $get_row['balance'];
		}
	
	
	$update = $object->insert_wallet_bal($user_id,$amount);
	$get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
	$user_name = $get_user['surname']." ".$get_user['other_names'];
	if($update){
          $msg = '<meta http-equiv="refresh" content="8000; URL=withdrawals.php" /><div class="alert alert-success"><strong>Success! </strong>Wallet Balance Update was successful. </div>'; 
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
          			$fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, " Updated the Wallet Balance of ".$user_name." from ".$oldw." to ".$amount);

	}else{
          $msg = '<meta http-equiv="refresh" content="8000; URL=withdrawals.php" /><div class="alert alert-danger"><strong>Oops! </strong>Wallet Balance Update was NOT successful.</div>'; 

	}
}

 ?>
<!DOCTYPE html>
<html>
<head>

	<title>Update Wallet Balance</title>
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
				<a href="index.php">Back to Home</a> |  
				<h3 style="color:red"><strong>Update wallet balance of a client(TAKE EXTREME CAUTION)</strong></h3>
				<form method="post">
				<label>Client Name</label><br>
				<select required="" class="form-control form-control-sm js-example-basic-single" id="user_id" name="user_id">
				<option value="">select a user</option>
				<?php foreach($get_rows as $client){?>
				<option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].' - '.$client['other_names'].' ('.$client['email'].')'; ?></option>
				<?php } ?>
				</select></br><br>
				<div id="wallet_bal">
					
				</div><br><br>

				<label>New Wallet Balance:</label><br>
				<input required="" class="form-control form-control-sm" type="number" name="amount" id="amount"><br><br>
				
				<input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="Update Wallet Balance" name="cmd_submit">
				</form>
		
			</div>
			<div class="col-md-2"> </div>
		</div>
			

	</div>
 

<script type="text/javascript">
		// In your Javascript (external .js resource or <script> tag)
		$(document).ready(function() {
		    $('.js-example-basic-single').select2();

		    $('#user_id').change(function(){
		    	   var user_id = $(this).val();

		    		$.ajax({
						url:"ajax_migration/wallet_bal.php",
						method:"GET",
						data:{user_id:user_id},
						success:function(data){
				
                		$('#wallet_bal').html(data);


						}
						});
		    });

		});  
</script>
</body>
</html>