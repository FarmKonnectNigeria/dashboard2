<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    //$package_category = $_POST['package_category'];
    $object = new DbQueries();
    $package = $_POST['package_plan'];
    $get_category = $object->get_one_row_from_one_table('package_definition', 'unique_id', $package);
    $package_category = $get_category['package_category'];
   // $email = isset($_POST['clients'] ) ? $_POST['clients'] : "";
    $recipient = isset($_POST['clients'] ) ? implode(',', $_POST['clients']) : "";
    $document_url = $_POST['document'];
    $link = "https://$_SERVER[HTTP_HOST]"."/admin/".$document_url;
    $document_link = "<a href=$link>$link</a>";
    $subject = "Document - FarmKonnect";
    $content = "A document has been shared with you from FarmKonnect, find the link below<br>".$document_link."<br> Thanks, Regards";
    
    //print_r($_POST);
    if($package == "" || $package_category == "" || $recipient == "" || $document_url == ""){
        echo "empty_field";
    }else{
    $share_document = $object->email_function($recipient, $subject, $content);
    //$share_document_decode = json_decode($share_document, true);
    if($share_document === false){
    echo "error";
    }else{
    	echo "success";
        $update_shared_document = $object->update_with_one_param('admin_document_tbl','image_url',$document_url,'shared_status',1);
    	$description = "Shared Documents to Client (s)";
		$object->insert_logs($assigned_by, $description);
    }
}
 ?>