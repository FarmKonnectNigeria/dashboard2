<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');

 $user_id = $_POST['userid'];
 $wallet_balance = $object->get_one_row_from_one_table('wallet_tbl','user_id',$user_id); 
 echo $wallet_balance['balance'];
?>