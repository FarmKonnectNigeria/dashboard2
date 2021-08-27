<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
  $other_names = $_POST['other_names'];
  $surname = $_POST['surname'];
  $gender = $_POST['gender'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $table = 'users_tbl';
  $param = 'email';
  $unique_id = $object->unique_id_generator($email);
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate.php?id=".$unique_id;
  $subject = "User Registration Activation Email";
  $content = "Click this link to activate your account. <a href='".$actual_link."'>".$actual_link. "</a";
  $link_message = $object->email_function($email, $subject, $content);
  $insert_users =  $object->insert_users_without_referral($table, $other_names, $gender, $surname, $password, $confirm_password, $phone , $email, $param, $unique_id);
  $insert_decode = json_decode($insert_users,true);
  echo json_encode(["status"=>$insert_decode['status'], "msg"=>$insert_decode['msg']]) ;
   
?>