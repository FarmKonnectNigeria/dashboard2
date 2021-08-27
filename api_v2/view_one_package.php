<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
include("api_auth.php");
header('Content-Type: application/json');
$object = new DbQueries;
$data = [];
$uid = $_GET['uid'];
$getpack = $object->get_one_row_from_one_table('package_definition','unique_id',$uid); 
 $cid = $getpack['package_category'];
 $getcat = $object->get_one_row_from_one_table('package_category','unique_id',$cid);

     if($getpack['package_type']  == 1){
         $product_type = "Fixed";
      }
     else {
        $product_type = "Recurrent";
      }
      $package_description = strip_tags(str_replace('&nbsp;', '', preg_replace('/\s\s+/', ' ', $getpack['package_description'])));
		$package=["unique_id"=>$getpack['unique_id'],
	"package_category"=>$getcat['name'],
	"package_name"=>$getpack['package_name'],
	"package_type"=>$product_type,
	"package_description"=>$package_description,
	"available_slot"=>$getpack['no_of_slots'],
	"minimum_slot_to_buy"=>$getpack['min_no_slots'],
	"package_unit_price"=>number_format($getpack['package_unit_price']),

];
array_push($data, $package);
echo json_encode(["status"=>"1", "msg"=>$data]);  

?>