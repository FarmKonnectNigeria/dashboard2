<?php $sms_sender_id = 'Farmkonnect';//values in this script should be changed by app configureation
$app_domain = $_SERVER['HTTP_HOST'];
$app_name = 'Farmkonnect & ';
//$app_slug = '';
$app_link = $_SERVER['HTTP_HOST'];
$app_domain_root= $_SERVER['HTTP_HOST'];
date_default_timezone_set('Africa/Lagos');
//set timezone
$report_dir = "report/";
$report_pre_fix = 'report';


////
$callback = 'https://dashboard.farmkonnectng.com/flutterpay_verify.php';

define("HOST", "localhost");
define("USER", "f42v5vy0h3bw_app2_farmkonnect");
define("PASSWORD", "f42v5vy0h3bw_app2_farmkonnect");
define("DB_NAME", "f42v5vy0h3bw_app2_farmkonnect");


//flutterkeys
$public_key = 'FLWPUBK-52f1a8646ee161743e2a919c16611c41-X';
$secret_key = 'FLWSECK-c0e8df77117baadceda4ec7df7ca5fb2-X';
$encryption_key = 'c0e8df77117bda4861594570';




//NB: Expiry date is in days
$expiry_date = "60";

//Country code: NB: Should be a string
$country_code = "234";



?>
