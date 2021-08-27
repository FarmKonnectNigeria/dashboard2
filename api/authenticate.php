<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
      $email_or_phone = isset($_POST['email_or_phone']) ? $_POST['email_or_phone'] : '';
   	$password = isset($_POST['password']) ? $_POST['password'] : '';
   	if($email_or_phone == '' || $password == ''){
            echo  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
	$object = new DbQueries();
	$check_user_login =  $object->check_user_login($email_or_phone,$password);
	if($check_user_login === null){
        echo json_encode(["status"=>"0", "msg"=>"Incorect email or password"]);
	}else{
	    
	    $getud = $object->get_one_row_from_one_table('users_tbl','email',$email_or_phone);
	    $surn = $getud['surname'];
	    $other_names = $getud['other_names'];
	    $phone = $getud['phone'];

		          echo json_encode(["status"=>"1", "msg"=>$check_user_login['unique_id'],"fname"=> $other_names,"fname"=> $other_names,"surname"=> $surn, "phone"=>$phone  ]   );
	
	    
	    
	}
   
?>