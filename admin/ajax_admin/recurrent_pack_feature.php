<?php
session_start();
require_once('../../classes/db_class.php');
require_once('../../includes/config.php');

// $form .="<h3>Package Details</h3>";
$form = "<hr><h3><b><u>Recurrent Package Type:</u></b></h3>";


$form .= '<input required="" id="recurrence_value" value="500" name="recurrence_value" class="form-control form-control-sm" type="hidden" style ="width:50%; margin-bottom:2px;"><br>';


$form .= '<label>Contribution Period(days)</label> : <input required="" id="contribution_period"  name="contribution_period" class="form-control form-control-sm" type="text" style ="width:50%; margin-bottom:2px;"><br>';



$form .= '<label>Incubation Period(days)</label> : <input required="" id="incubation_period" name="incubation_period" class="form-control form-control-sm" type="text" style ="width:50%; margin-bottom:2px;"><br>';

$form .= '<label>Recurrence Type</label> : <select required="" id="recurrence_type" name="recurrence_type" class="form-control form-control-sm"  style ="width:50%; margin-bottom:2px;"><option value="">Select</option><option value="daily">Daily</option><option value="weekly">Weekly</option><option value="monthly">Monthly</option></select><hr>';



echo $form;

 ?>