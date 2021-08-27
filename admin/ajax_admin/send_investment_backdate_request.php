<?php  include('../includes/instantiated_files.php');
       include('../../classes/algorithm_functions.php');
     
       $user_id = $_POST['user_id'];
       $invst_id = $_POST['invst_id'];
       $back_date = $_POST['back_date'];
       $accrued_profit = $_POST['accrued_profit'];
       
       $adminid =  $_SESSION['adminid'];
       
       $send_backdate_investment_request = send_backdate_investment_request($invst_id,$back_date,$accrued_profit,$adminid);
       $decode = json_decode($send_backdate_investment_request,true);
       
       echo $decode['msg'];

     
    
?>
