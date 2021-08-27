<?php
 include('../includes/instantiated_files.php');
 require_once('../../classes/algorithm_functions.php');
 $rating = $_POST['rating'];
$admin_id = $_POST['admin_id'];
 $submit_rating = submit_rating($admin_id, $rating);
    $submit_rating_decode = json_decode($submit_rating, true);
    if($submit_rating_decode['status'] == 0){
    	echo $submit_rating_decode['msg'];
    }else{
    	echo "success";
        $object->insert_logs($_SESSION['adminid'], 'Rated MM');
    }
?>