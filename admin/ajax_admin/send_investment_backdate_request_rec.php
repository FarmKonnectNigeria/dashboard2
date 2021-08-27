<?php  include('../includes/instantiated_files.php');
       include('../../classes/algorithm_functions.php');
     
       $user_id = $_POST['user_id'];
       $invst_id = $_POST['invst_id'];
       $back_date = $_POST['back_date'];
       $total_profit = $_POST['total_profit'];
       $contributory_days = $_POST['no_of_days_of_investment'];
       $total_contributions = $_POST['total_contributions'];
       
       $adminid =  $_SESSION['adminid'];
       
       $send_backdate_investment_request = send_backdate_investment_request_rec($invst_id,$back_date,$total_profit,$adminid,$contributory_days,$total_contributions);
       $decode = json_decode($send_backdate_investment_request,true);
       
       echo $decode['msg'];
       //foreach($_POST as $key=>$value){
        //echo $key."---".$value.'<br>';   
       //}
        
     
    
?>
