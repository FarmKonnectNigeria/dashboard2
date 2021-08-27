<?php
session_start();
require_once('../../classes/db_class.php');
require_once('../../includes/config.php');

// $form .="<h3>Package Details</h3>";
$form = '<label>Number of Available Slots</label>: <input type="text" style ="width:25%; margin-bottom:2px;"><br>';
$form .= '<label>Multiplying Factor(MF)</label>: <input type="number" style ="width:25%; margin-bottom:10px;"><br>';
$form .= '<label>Monthly Contribution Per Slot </label>: <input type="number" style ="width:25%; margin-bottom:10px;"><br>';
$form .= '<label>Minimum Tenure Days</label>: <input type="number" style ="width:25%; margin-bottom:10px;"><br>';
$form .= '<label>Standard/Maximum Tenure Days</label>: <input type="number" style ="width:25%; margin-bottom:10px;"><br>';
$form .= '<label>Liquidation Percent</label>: <input type="number" style ="width:25%; margin-bottom:10px;"><br>';



echo $form;

 ?>