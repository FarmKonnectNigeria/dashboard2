<?php  require_once("../classes/algorithm_functions.php");
        header('Content-Type: application/json');
       if(  isset($_POST['investment_id']) && $_POST['investment_id'] != "" &&
            isset($_POST['user_id']) && $_POST['user_id'] != "" &&
            isset($_POST['amount_tobe_liquidated']) && $_POST['amount_tobe_liquidated'] != "" &&
            isset($_POST['days_so_far']) && $_POST['days_so_far'] != "" ) {
            $investment_id = $_POST['investment_id'];
            $user_id = $_POST['user_id'];
            $amount_tobe_liquidated = $_POST['amount_tobe_liquidated'];
            $days_so_far = $_POST['days_so_far'];
            echo send_liquidation_request($investment_id,$user_id,$amount_tobe_liquidated,$days_so_far);
       }else{
           echo json_encode(["status"=>"110", "msg"=>"empty_field"]);
       }
      
       
?>