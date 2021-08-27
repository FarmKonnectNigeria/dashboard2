<?php 
	require_once('../classes/db_class.php');
    require_once('../includes/config.php');
	$email = 'testing';
	$object = new DbQueries();
    $unique_id = $object->unique_id_generator($email);

     echo $unique_id;
?>