<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table_by_one_param('users_tbl','access_level',1);
$get_packages = $object->get_rows_from_one_table('package_tbl');

if(isset($_POST['cmd_submit'])){
	$withdrawal_date = $_POST['withdrawal_date'];
	$user_id = $_POST['user_id'];
	$amount = $_POST['amount'];
	$insert = $object->insert_withdrawals($user_id,$amount,'7',$withdrawal_date);
	if($insert){
          $msg = '<meta http-equiv="refresh" content="8000; URL=withdrawals.php" /><div class="alert alert-success"><strong>Success! </strong>Withdrawal action was successful. </div>';
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
          			$fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
                    $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Inserted Withdrawal"); 

	}else{
          $msg = '<meta http-equiv="refresh" content="8000; URL=withdrawals.php" /><div class="alert alert-danger"><strong>Oops! </strong>Withdrawal action was NOT successful.</div>'; 

	}
}

 ?>
<!DOCTYPE html>
<html>
<head>

	<title>Computing Investments</title>
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
				<a href="index.php">Back to Home</a> | <a href="view_withdrawals.php">View Client Investment Details</a>  
				<h3><strong>Computing Standard/Fixed Plans</strong> </h3>
				<form method="post">
				<label>Client Name</label><br>
				<select required="" class="js-example-basic-single" id="user_id" name="user_id">
				<?php foreach($get_rows as $client){?>
				<option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].' - '.$client['other_names']; ?></option>
				<?php } ?>
				</select></br><br>
				
				<label>Unit Price of Package:</label><br>
				<input required=""  type="number" name="unit_price" id="unit_price"><br><br>

				<label>No of Slots:</label><br>
				<input required=""  type="number" value="1" name="slots_bought" id="slots_bought"><br><br>
				

				
				<label>Investment Start Date:</label><br>
				<input required=""   type="date" name="start_date" id="start_date"><br><br>

				<label>No of days for investment to run:</label><br>
				<input required=""   type="number" name="no_of_days" id="no_of_days"><br><br>

				<label>Multiplying Factor:</label><br>
				<input required=""   type="text" name="mf" id="mf"><br><br>

				<input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="Compute Investment" name="cmd_submit">
				</form>
		
			</div>
			<div class="col-md-3"> </div>
		</div>
			<br>
			<br>
		<hr>
			

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