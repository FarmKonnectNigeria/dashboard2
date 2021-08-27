<?php
//session_start();
	require_once("../classes/db_class.php");
	if(!isset($_SESSION['secret_key'])){
		echo json_encode(["status"=>105, "msg"=>"Please regenerate token"]);
		exit();
	}
	else{
		$now = time();
		if ($now > $_SESSION['expire']) {
            session_destroy();
            echo json_encode(["status"=>107, "msg"=>"Token expired, please regenerate token"]);
            exit();
        }
        else{
        	$secret_key = isset($_SERVER['HTTP_KEY']) ? $_SERVER['HTTP_KEY'] : '';
			// $email = isset($_SERVER['HTTP_EMAIL']) ? $_SERVER['HTTP_EMAIL'] : '';
			// $password = isset($_SERVER['HTTP_PASSWORD']) ? $_SERVER['HTTP_PASSWORD'] : '';
			$object = new DbQueries;
			$check_token_exists = $object->check_token_exists($secret_key);
			if($check_token_exists == false){
				echo json_encode(["status"=>109, "msg"=>"Invalid API Key"]);
				exit();
			}
        }
	}
?>