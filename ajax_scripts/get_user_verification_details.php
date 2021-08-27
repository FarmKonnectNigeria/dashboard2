<?php
    require_once('../classes/algorithm_functions.php');
    $account_bank = $_POST['bank_name'];
    $account_number = $_POST['account_number'];
    
     $get_user_verification_details = get_user_verification_details($account_number,$account_bank);

     $get_user_verification_details_dec = json_decode($get_user_verification_details,true);
     $get_user_verification_details_status = $get_user_verification_details_dec['status'];
     
     if($get_user_verification_details_status == "success"){
            $get_user_verification_details_data = $get_user_verification_details_dec['data'];
            $verified_name =  $get_user_verification_details_data['account_name'];
            
            $verified_account_number =  $get_user_verification_details_data['account_number'];
            
            echo '<span style="color:black;">Verified Account Number: '.$verified_account_number.'<br>';
            echo 'Verified Account Name: '.$verified_name.'<hr>';
            echo '<a href="#" class="btn btn-lg btn-success">Confirm Update and Verification</a></span>';
     }else{
         
        $get_user_verification_details_message = $get_user_verification_details_dec['message'];
      
        
        echo '<span style="color:red;">'.$get_user_verification_details_message.'</span>';
         
     }
     
    
     
?>
     