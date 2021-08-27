<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table_by_one_param('users_tbl','access_level',1);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Withdrawals</title>
</head>

<body>
   <h3><strong>Withdrawals(From Wallet to Bank Account)</strong> </h3>
   <form method="post">
	   <label>Client Name</label><br>
	   <select id="user_id">
	   	  <?php foreach($get_rows as $client){?>
	   	   	<option value="<?php echo $client['']; ?>">UserName</option>
	   	  <?php } ?>
  	   </select></br><br>

   	   <label>Amount:</label><br>
   	   <input type="text" name="amount"><br><br>
   	   <label>Withdrawal Date:</label><br>
   	   <input type="date" name=""><br><br>
   	   <input type="submit" id="cmd_submit" name="cmd_submit">
   </form>
</body>
</html>