<?php
session_start();
unset($_SESSION['affiliate_id']);
unset($_SESSION['login_status']);
header('Location:login');
?>