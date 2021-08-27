<?php include('includes/session.php');
   require_once('classes/db_class.php');
   include('includes/config.php');
   
    if(!isset($_SESSION['uid'])){
        header('location: login');
    }
    
  ///id seession
   $uid = $_SESSION['uid'];
	 //class object
   $object = new DbQueries();
  





 ?>