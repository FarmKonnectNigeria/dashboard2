<?php require_once('../../../classes/db_class.php');
       require_once('../../../includes/config.php');
        $object = new DbQueries();
		$user_id = $_GET['user_id'];
		$get_row = $object->get_one_row_from_one_table('wallet_tbl','user_id',$user_id);
		if($get_row == null){
		echo 'Current Balance is 0';
		}else{
		echo 'Current Balance is: &#8358;'.number_format($get_row['balance']);
		}

?>