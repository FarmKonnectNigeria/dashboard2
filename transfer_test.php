<?php 
include('includes/instantiated_files.php');
function make_transfer(){
  //global $dbc;
  //global $secret_key;
  $callback_url = "https//dashboard2.farmkonnectng.com/wallet.php";
  $reference_id = "8393734293472983472821ttyii3are1";
 

  // $amount = secure_database($amount);
    
  $naration = "Withdrawal from Farmkonnect";
  $naration2 = "Payments from Farmkonnect";
  $fullname = "Adebunmi Olusola Samuel";
  $currency = "NGN";

   // $get_wallet_balance = get_wallet_balance($user_id);
   // $gwd = json_decode($get_wallet_balance,true);

  // if($gwd['msg'] < $amount){
  //         return json_encode(array( "status"=>102, "msg"=>"Sorry, Insufficient balance" ));
  // }
  
  // else if($amount == "" || $user_id == "" || $callback_url == "" || $reference_id == ""){
  //         return json_encode(array( "status"=>103, "msg"=>"Empty field(s) found" ));
    
  // }else{

    
            $url = 'https://api.flutterwave.com/v3/transfers';
            // Collection object
            $data = [
            'account_bank' => '011',
            'account_number' => '3069976671',
            'amount' => 500,
            'narration' => $naration2,
            'currency' => $currency,
            'beneficiary_name' => $fullname,
            'reference' => $reference_id,
            ];
            
            // Initializes a new cURL session
            $curl = curl_init($url);
            
            // Set the CURLOPT_RETURNTRANSFER option to true
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
            // Set the CURLOPT_POST option to true for POST request
            curl_setopt($curl, CURLOPT_POST, true);
            
            // Set the request data as JSON using json_encode function
            curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
            
            // Set custom headers for RapidAPI Auth and Content-Type header
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer FLWSECK-c0e8df77117baadceda4ec7df7ca5fb2-X',
            'Content-Type: application/json'
            ]);
            
            // Execute cURL request with all previous settings
            $response = curl_exec($curl);
            
            // Close cURL session
            curl_close($curl);
            
            return $response;

        //   $response_dec = json_decode($response,true);
        //   $response_status = $response_dec['status'];
        //   $response_message = $response_dec['message'];
        //   $transfer_id = $response_dec['data']['id'];

        //   if($response_status == 'error'){
        //          return json_encode(array( "status"=>103, "msg"=>$response_message ));
        //   }

        //   else{
        //         return json_encode(array( "status"=>111, "msg"=>"successful withdrawal request but pending" ));         
        //   }

     
  // }

  

}

echo make_transfer();
// echo 'testdd';
?>