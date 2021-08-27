<?php  include('../includes/instantiated_files.php');
include('../../classes/algorithm_functions.php');
  $invst_id = $_POST['invst_id'];
  $userid = $_POST['userid'];
 $compute_liquidation = compute_liquidation_params_for_fixed($invst_id);
 $compute_liquidation_decode = json_decode($compute_liquidation, true);
 $get_package_details = $object->get_one_row_from_one_table('package_definition','unique_id',$compute_liquidation_decode['package_id']);
 $pk_det_name = $get_package_details['package_name'];
 $surcharge_status = $compute_liquidation_decode['surcharge_status'];
 $days_so_far = $compute_liquidation_decode['days_so_far'];
 $amount_to_be_surcharged = $compute_liquidation_decode['amount_to_be_surcharged'];
 $amount_sent_to_wallet = $compute_liquidation_decode['amount_sent_to_wallet'];
 $free_liquidation_period = $compute_liquidation_decode['free_liquidation_period'];
 $liquidation_surcharge = $compute_liquidation_decode['liquidation_surcharge'];
 $current_cap_bal = $compute_liquidation_decode['current_cap_bal'];
 $final_liquidation_amount = $compute_liquidation_decode['final_liquidation_amount'];
 $tenure_of_product = $compute_liquidation_decode['tenure_of_product'];
 $no_of_slot_bought = $compute_liquidation_decode['no_of_slot_bought'];
 $package_unit_price = $compute_liquidation_decode['package_unit_price'];
 $float_time = $compute_liquidation_decode['float_time'];
 $total_amount = $compute_liquidation_decode['total_amount'];
 $package_type = $compute_liquidation_decode['package_type'];

  if($tenure_of_product == "inf"){  $tenp = "INFINITY"; }else{ $tenp = $tenure_of_product;  }
  if( $days_so_far <  $free_liquidation_period){ 
    echo "There will be a ". $liquidation_surcharge.'% surcharge of the total package balance so far i.e &#8358;'. number_format($current_cap_bal).'<br>' ; 
  }

  $details = "Package Name: ".$pk_det_name.'<br>';
  $details .= "Package Type: <strong>".$package_type.'</strong><br>';
  $details .= "Tenure of Product(days): ".$tenure_of_product.'<br>';
  $details .= "Slot Bought: ".$no_of_slot_bought.'<br>';
  $details .= "Package Unit: &#8358;".$package_unit_price.'<br>';
  $details .= "Float Time: ".$float_time.' day(s)<br>';
  $details .= "Free Liquidation Period: ".$free_liquidation_period.' day(s) <br>';
  $details .= "Days So Far: ".$days_so_far.' day(s)<br>';
  $details .= " Amount to be surcharged: &#8358;".number_format($amount_to_be_surcharged).'<br>';
  $details .= "Profit Sent to Wallet Already: &#8358;".number_format($amount_sent_to_wallet).'<br>';
  $details .= "Amount to be paid to wallet: &#8358;".number_format($final_liquidation_amount).'<br>';
  $details .= "Total Amount: &#8358;".$total_amount.'<br><br><hr>';
  // $details .= "<div id='backdate_investment_details'></div>";
  echo $details;   


  $form1 = '<input type="hidden" name="investment_id" id="investment_id" value="'.$invst_id.'">';
  $form1 .= '<input type="hidden" name="days_so_far" id="days_so_far" value="'.$days_so_far.'">';
  $form1 .= '<input type="hidden" name="final_liquidation_amount" id="final_liquidation_amount" value="'.$final_liquidation_amount.'">';
  $form1 .= '<input type="hidden" name="user_id" id="user_id" value="'.$userid.'">';
  echo $form1;
  echo '<button type="button" class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#myModal">Initiate Liquidation</button>';
?>
<!-- <form method="post" name="" id="liquidate_investment_IM_form">
<input type="hidden" name="days_so_far" id="days_so_far" value="<?php// echo $days_used_in_investment; ?>">
<input type="hidden" name="investment_id" id="investment_id" value="<?php// echo $invst_id; ?>">
<input type="hidden" name="final_liquidation_amount" id="final_liquidation_amount" value="<?php //echo $final_liquidation_amount; ?>">
<input type="hidden" name="user_id" id="user_id" value="<?php //echo $userid; ?>">
</form> -->
<!-- <input type="submit" class="btn btn-sm btn-success" value="Yes, I want to liquidate my investment" id="cmd_liquidate" name="cmd_liquidate"> -->



