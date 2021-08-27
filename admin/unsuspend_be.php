<?php     require_once('../classes/db_class.php'); 
include('includes/instantiated_files2.php');

  // $key = "codemaster@cwt";
   
   

?>
<!DOCTYPE html>
<html>
<head>
	<title>CRON for unsuspending Business Executive</title>
</head>
<body>
   <?php  
   // if(isset($_GET['key'])){
     //   $getkey = $_GET['key']; 
       //   if($getkey != $key){
              
           //   echo "Ole ni e";
         // }
          //else{
            
            $object->unsuspend_be();
            $object->email_function('ogunleyeoluwatosin2014@gmail.com', 'Farmkonnect', 'just testing my cron');

          //}
   //}else{
     //       echo "You are not authorized";         
   //}
   ?>
</body>
</html>
