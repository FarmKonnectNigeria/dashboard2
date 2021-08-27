<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$data = [];
$getpack = $object->get_rows_from_one_table('package_definition');
foreach($getpack as $pack){ 
    $package=["unique_id"=>$pack['unique_id'],
	"package_name"=>$pack['package_name'],
	"image_url"=>"admin/".$pack['image_url'],
];

array_push($data, $package);
}
echo json_encode(["status"=>"1", "msg"=>$data]);  
?>