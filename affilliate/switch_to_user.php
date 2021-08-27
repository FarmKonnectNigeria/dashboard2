<?php
	session_start();
	if(isset($_SESSION['uid'])){
         header("location:home");
	}else{
         header("location:login");

	}



?>