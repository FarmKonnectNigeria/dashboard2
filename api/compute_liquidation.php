<?php  require_once("../classes/algorithm_functions.php");
        header('Content-Type: application/json');
       if(  isset($_POST['investment_id']) ) {
            $investment_id = $_POST['investment_id'];
            echo compute_liquidation_params_for_fixed($investment_id);
       }else{
           echo json_encode(["status"=>"117", "msg"=>"empty_field"]);
       }
      
       
?>