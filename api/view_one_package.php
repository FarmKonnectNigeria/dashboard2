<?php 
session_start();
require_once("../classes/db_class.php");
require_once('db_connect.php');
include("../includes/config.php");
header('Content-Type: application/json');
$object = new DbQueries;
$data = [];
$uid = $_GET['uid'];
$getpack = $object->get_one_row_from_one_table('package_definition','unique_id',$uid); 
 $cid = $getpack['package_category'];
 $getcat = $object->get_one_row_from_one_table('package_category','unique_id',$cid);
 if($getpack['tenure_of_product'] != 'inf'){
    $tenure_of_product_years =intval($getpack['tenure_of_product'] / 365).' year(s)';
    //$tenure_of_product_month = intval(($getpack['tenure_of_product'] % 365) / 30).' month(s)';
    $tenure_of_product_days = intval($getpack['tenure_of_product'] % 365) .' day(s)';
    $tenure_of_product =$tenure_of_product_years.' '.$tenure_of_product_days;
    $expected_amount = number_format(  ($getpack['package_unit_price'] * 1) 
    
                     + ($getpack['package_unit_price']  * $getpack['multiplying_factor'] * $getpack['tenure_of_product']) 
                     
                     );
    }else{
        $tenure_of_product = "Infinity";
        $expected_amount = "This is based on the number of days your investment is left to run";
    }

     if($getpack['package_type']  == 1){
         $product_type = "Fixed";
      }
     else {
        $product_type = "Recurrent";
      }
      $package_description = $getpack['package_description'];
		$package=["unique_id"=>$getpack['unique_id'],
	"package_category"=>$getcat['name'],
	"package_name"=>$getpack['package_name'],
	"package_type"=>$product_type,
	"package_description"=>$package_description,
	"available_slot"=>$getpack['no_of_slots'],
	"minimum_slot_to_buy"=>$getpack['min_no_slots'],
	"package_unit_price"=>number_format($getpack['package_unit_price']),
	"tenure_of_product"=>$tenure_of_product,
	"expected_amount_after_investment"=>$expected_amount

];
//array_push($data, $package);
echo json_encode(["status"=>"1", "msg"=>$package]);  

?>