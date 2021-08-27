<?php include('../includes/instantiated_files2.php');

    if(  $_GET['package_id'] == "no_select" ){
    	echo 0;
    }
    else if($_GET['package_id'] == "all_packages"){
    	    $profit = $object->get_profits1($uid);
    		$profit_decode = json_decode($profit,true);
    		echo $profit_decode['actual_withdrawable_profit'];
    }
    else{
    	$get_profits_per_package = $object->get_profits_per_package($_GET['package_id'],$uid);
        $get_profits_per_package_decode = json_decode($get_profits_per_package,true);
        echo $get_profits_per_package_decode['actual_withdrawable_profit'];
    }
      
     
?>

