<?php
session_start();
require_once('../../classes/db_class.php');
require_once('../../includes/config.php');

// $form .="<h3>Package Details</h3>";
$form = "<h3><b><u>Basal Monthly Plans</u></b></h3>";
$form .= '<label>Recurrence Value</label> : <input class="form-control form-control-sm"   type="number" style ="width:50%; margin-bottom:2px;"><br>';
$form .= '<label>Incubation Period</label> : <input class="form-control form-control-sm"  type="number" style ="width:50%; margin-bottom:2px;"><br>';
$form .= '<label>Unit Price of Package</label> : <input class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';
$form .= '<label>Minimum number of slot</label> : <input class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';
$form .= '<label>Moratorium(days)</label> : <input class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';
$form .= '<label>Free Liquidation Period(days)</label> : <input class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';
$form .= '<label>Liquidation Surcharge</label> : <input class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';
$form .= '<label>Tenure of Product(day of normal liquidation) in days</label> : <input class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';
$form .= '<label>Float Time(FT) in days</label> : <input class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';
$form .= '<label>Multiplying Factor(MF)</label> : <input class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';
$form .= '<label>Capital Refund</label> : <select class="form-control form-control-sm"  style ="width:50%; margin-bottom:2px;"><option value="">Select</option><option value="1">End of Tenure</option><option value="2">Spread</option></select><br>';
$form .= '<label>Backdatable?</label> : <select class="form-control form-control-sm"  style ="width:50%; margin-bottom:2px;"><option value="">Select</option><option value="1">Yes</option><option value="2">No</option></select><br>';
$form .= '<label>Make Public?</label> : <select class="form-control form-control-sm"  style ="width:50%; margin-bottom:2px;"><option value="">Select</option><option value="1">Yes</option><option value="2">No</option></select><br>';
$form .= '<label>Number of Slots</label> : <input class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';
$form .= '<label>Commission (In percent) </label> : <input class="form-control form-control-sm" type="number" style ="width:50%; margin-bottom:2px;"><br>';



echo $form;

 ?>