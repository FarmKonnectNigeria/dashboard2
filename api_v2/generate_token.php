<?php 
session_start();
require_once("../classes/db_class.php");
//require_once('db_connect.php');
//include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$email = $_POST['email'];
$password = $_POST['password'];
$generate_token = $object->generate_token($email, $password);
//$generate_token_decode = json_decode($generate_token);
echo $generate_token;

?>