<?php
	session_start();
	if(isset($_GET['uid'])){
		$uid = $_GET['uid'];
        $_SESSION['affiliate_id'] = $uid;
         header("location:affilliate/home");
         

	}



?>