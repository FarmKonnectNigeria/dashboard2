<?php

	require_once 'vendor/autoload.php';

	// Create new PDF instance
	$mpdf = new \Mpdf\Mpdf();
	$ticket_code = $_SESSION['ticket_code'];
    $transaction_id = $_SESSION['transaction_id'];
    $full_name = $_SESSION['full_name'];
    $start_date = $_SESSION['start_date'];
    $total = $_SESSION['total'];
	$departure_location = $_SESSION['departure_location'];
    $start_time = $_SESSION['start_time'];

	// CReate our PDF
	$data='';
	$data= '<div class="clearfix"></div>

    <div class="not-print" style="margin-top: 20px">
        <div class="text4 blue-text-center">Safe. Comfortable. Affordable. Perfect</div>
    </div><br>

    <div class="round-way-header not-print">
        <div class="payment-review-header">Receipt</div>
    </div><br>';
	$data.= '<center><div class="blue-thanks not-print">
	        <div class="text-center thank-order">
	            Thank you for your order!
	        </div>
	        <div class="text-center thank-print">
	            Please print a copy for your records
	        </div>
	    </div></center> <br><br>';
	 $data.= '<span style="font-size: 16px">Ticket Code: &nbsp;&nbsp;&nbsp;'. $ticket_code .'</span><br><br>';
	 $data.= '<span style="font-size: 16px">Reference Number: &nbsp;&nbsp;&nbsp;'. $transaction_id .'</span><br><br>';
	 $data.= '<div style="font-size: 20px">Traveler(s) Information</div>';
	 $data.= ' <table class="table" style="text-align: center; margin-left: -10px">
                <thead>
                <tr>
                    <th class="text-left">Traveler(s) Name</th>
                    <th>Departure Location</th>
                    <th>Departure Date</th>
                    <th>Departure Time</th>
                    <th>Amount Paid</th>
                </tr>
                </thead>
                <tbody>
                	<tr>
                		<td class="text-left">'. $full_name .'</td>
                		<td>'. $departure_location .'</td>
                		<td class="text-left">'. $start_date .'</td>
                		<td>'. $start_time .'</td>
                		<td class="text-left">&#8358;&nbsp;'. $total .'
                	</tr>
                </tbody>
            </table> <br><br>';

      $data.='<div class="clearfix"></div>
            <b><span>*</span> All sales are final and non-refundable.</b>';
	// $data .= '<h1>Your Details</h1>';

	// // Add data
	// $data .= '<strong>First Name</strong> ' . $fname . '<br>';
	// $data .= '<strong>Last Name</strong> ' . $lname . '<br>';
	// $data .= '<strong>Email</strong> ' . $email . '<br>';
	// $data .= '<strong>Phone</strong> ' . $phone . '<br>';

	// if ($message) {
	// 	$data .= '<br><strong>Message</strong><br>' . $message;
	// }

	// Write PDF
	$mpdf->WriteHTML($data);

	// Output to browser
	$mpdf->Output('receipt.pdf', 'D');


?>