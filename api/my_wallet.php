<?php
include("../includes/session.php");
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
	$user_id = $_GET['uid'];
	if(empty($user_id)){
        echo json_encode(["status"=> "400", "msg"=>"All fields are reqired"]);
      }else{
      $sql = "SELECT * FROM `wallet_tbl` WHERE `user_id` = '$user_id'";
      $query = mysqli_query($con, $sql);
        if($query){
          $row = mysqli_fetch_array($query);
          $balance = $row['balance'];
            echo json_encode(["status"=>"1", "msg"=>number_format($balance)]);
         }
        else{
            echo json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
    }
?>