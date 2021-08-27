<?php
	include('../includes/instantiated_files.php');
	include('../../classes/algorithm_functions.php');
	$user_id = $_POST['user_id'];
	$get_user_details = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
	$get_wallet_balance = $object->get_one_row_from_one_table('wallet_tbl', 'user_id', $user_id);
	$total_fp = calculate_total_floating_profit($user_id);
	$total_fp_decode= json_decode($total_fp, true);
	$total_investment = $object->get_total_investment($user_id);
	$total_investment_decode = json_decode($total_investment, true);
	
?>
<br><hr>
<div class="row">
	<div class="col-md-1"></div>
<div class="col-md-10">
	<h2>Withdrawal for <?php echo $get_user_details['surname'].' '.$get_user_details['other_names'];?></h2>
	<div class="table-responsive">
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
	<?php
		$get_withdrawal = $object->get_withdrawal_requests_user($user_id);
		if($get_withdrawal == null){
			echo "No Withdrawal yet";
		}
		else{ ?>
			<tr>
				<th>S/N</th>
				<th>Amount</th>
				<th>Withdrawal Type</th>
				<th>Status</th>
				<th>Date</th>
			</tr>
			</thead>
			<tbody>
			<?php
            	$count = 1;
			foreach ($get_withdrawal as $deposit) {
				?>
				<tr>
					<td><?php echo $count;?></td>
					<td>&#8358;<?php echo number_format($deposit['amount_withdrawn']);?></td>
					<td><?php echo "<span class='badge badge-success'>wallet</span>";?>
					<td>
                        <?php
                            if($deposit['withdrawal_status'] == 2 ){
                        ?>
                          <small class="badge badge-success">Approved by SA</small>
                        <?php } else if($deposit['withdrawal_status'] == 1){
                          ?>
                          <small class="badge badge-primary">Pending</small>
                          <?php
                        }else if($deposit['withdrawal_status'] == 4){
                          ?>
                          <small class="badge badge-success">Approved by Accountant</small>
                          <?php
                        }else if($deposit['withdrawal_status'] == 3){
                          ?>
                          <small class="badge badge-danger">Rejected by SA</small>
                          <?php
                        }else if($deposit['withdrawal_status'] == 5){
                          ?>
                          <small class="badge badge-danger">Rejected by Accountant</small>
                          <?php
                        }else if($deposit['withdrawal_status'] == 6){
                          ?>
                          <small class="badge badge-success">Processed</small>
                          <?php
                        }
                          ?>
                        </td>
					<td><?php echo $deposit['date_created'];?></td>
				</tr>
				<?php
				$count++;
			}
		}
	?>
			</tbody>
		</table>
	</div>
</div>
</div>
