<?php
session_start();
require_once('../../classes/db_class.php');
require_once('../../includes/config.php');

// $form .="<h3>Package Details</h3>";
$form = "<h3><b><u>Standard Packages</u></b></h3>";
// $form .= '<label>Recurrence Value</label> : <input class="form-control form-control-sm" id="pack_slug" name ="pack_slug"  value="standard_packages"  type="hidden"  style ="width:50%; margin-bottom:2px;"><br>';


// $form .= '<label>Incubation Period</label> : <input id="incubation_period" name="incubation_period" class="form-control form-control-sm"  type="number" style ="width:50%; margin-bottom:2px;"><br>';


$form .= '<label>Unit Price of Package</label> : <input id="package_unit_price" name="package_unit_price" class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';


$form .= '<label>Minimum number of slot</label> : <input id="min_no_slots" value="1" name="min_no_slots" class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';



$form .= '<label>Moratorium(days)</label> : <input id="moratorium" name="moratorium" class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';


$form .= '<label>Free Liquidation Period(days)</label> : <input id="free_liquidation_period" name="free_liquidation_period" class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';


$form .= '<label>Liquidation Surcharge</label> : <input id="liquidation_surcharge" name="liquidation_surcharge" class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';

$form .= '<label>Tenure of Product(day of normal liquidation) in days</label> : <input id="tenure_of_product" name="tenure_of_product" class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';

$form .= '<label>Float Time(FT) in days</label> : <input id="float_time" name="float_time" class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';

$form .= '<label>Multiplying Factor(MF)</label> : <input id="multiplying_factor" name="multiplying_factor" class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';

$form .= '<label>Capital Refund</label> : <select id="capital_refund_type" name="capital_refund_type" class="form-control form-control-sm"  style ="width:50%; margin-bottom:2px;"><option value="">Select</option><option value="1">End of Tenure</option><option value="2">Spread</option></select><br>'; 

$form .= '<label>Backdatable?</label> : <select id="backdatable" name="backdatable" class="form-control form-control-sm"  style ="width:50%; margin-bottom:2px;"><option value="">Select</option><option value="1">Yes</option><option value="0">No</option></select><br>';	

$form .= '<label>Make Public?</label> : <select id="visibility" name="visibility" class="form-control form-control-sm"  style ="width:50%; margin-bottom:2px;"><option value="">Select</option><option value="1">Yes</option><option value="0">No</option></select><br>';


$form .= '<label>Number of Slots</label> : <input id="no_of_slots" name="no_of_slots" class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';

$form .= '<label>Commission (In percent) </label> : <input id="package_commission" name="package_commission" class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';
















echo $form;

 ?>