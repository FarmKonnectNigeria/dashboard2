<?php include('includes/instantiated_files.php');
   $packid = $_GET['packid'];
   $getpack_dec = $object->get_one_row_from_one_table('package_definition','unique_id',$packid);
   $descrip = $getpack_dec['package_description'];
   if($descrip != ""){
       $ddd = $descrip;
   }else{
       //$ddd = "No Description Found..";
       $ddd = "";
   }
   
   echo $ddd;
  
   
  
?>