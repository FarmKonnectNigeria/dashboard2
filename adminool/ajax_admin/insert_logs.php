<?php 
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $description = "Logged in";
	$object = new DbQueries();
 	$object->insert_logs($_SESSION['adminid'], $description);
  	header("location:home");

 ?>