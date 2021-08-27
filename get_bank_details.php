<?php
include('includes/instantiated_files.php');
include('includes/header.php');
$selected_bank = $_POST['selected_bank'];
$get_bank = $object->get_one_row_from_one_table('bank_accounts', 'bank_name', $selected_bank);
echo "<p><b>Bank Details</b></p> 
	<p><b>Description :</b>".$get_bank['description']."</p>
	<p><b>Bank Name :</b>".$get_bank['bank_name']."</p>
	<p><b>Account Number :</b>".$get_bank['account_number']."</p>
	<p><b>Account Name :</b>".$get_bank['account_name']."</p>
	<p><b>Account Type :</b>".$get_bank['account_type']."</p>";
?>