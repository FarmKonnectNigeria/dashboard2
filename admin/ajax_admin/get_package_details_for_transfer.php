<?php  
  ini_set('memory_limit', '-1');
include('../includes/instantiated_files.php');
include('../../classes/algorithm_functions.php');
  $invst_id = $_POST['invst_id'];
  $userid = $_POST['userid'];
  $get_subscribed_packages =  $object->get_one_row_from_one_table('subscribed_packages','unique_id',$invst_id);
  //$get_users = $object->get_rows_from_one_table('users_tbl');

  $packid = $get_subscribed_packages['package_id'];
  $get_package_details = $object->get_one_row_from_one_table('package_definition','unique_id',$packid);
  $pk_det_name = $get_package_details['package_name'];
  $ptype = $get_subscribed_packages['package_type'];
  $tenure_of_product = $get_subscribed_packages['tenure_of_product'];
  $slots = $get_subscribed_packages['no_of_slots_bought'];
  //$moratorium = $get_subscribed_packages['moratorium'];
  $package_unit_price = $get_subscribed_packages['package_unit_price'];
  //$free_liquidation_period = $get_subscribed_packages['free_liquidation_period'];
  $total_amount = $package_unit_price * $slots;


  if($ptype == '1'){
      $type = "Fixed";
  }

  if($ptype == '2'){
      $type = "Recurrent";
}

  if($tenure_of_product == "inf"){  $tenp = "INFINITY"; }else{ $tenp = $tenure_of_product;  }

  $details = "Package Name: ".$pk_det_name.'<br>';
  $details .= "Package Type: <strong>".$type.'</strong><br>';
  $details .= "Tenure of Product(days): ".$tenure_of_product.'<br>';
  $details .= "Slot Bought: ".$slots.'<br>';
  $details .= "Package Unit: &#8358;".$package_unit_price.'<br>';
  $details .= "Total Amount: &#8358;".$total_amount.'<br><hr>';
  // $details .= "<div id='backdate_investment_details'></div>";
  echo $details;

  echo '<button type="button" class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#myModal">Transfer Ownership</button>';
?>



