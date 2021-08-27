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
	<h2>Deposits for <?php echo $get_user_details['surname'].' '.$get_user_details['other_names'];?></h2>
	<div class="table-responsive">
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
	<?php
		$get_deposit = $object->get_rows_from_one_table_by_id('credit_wallet_tbl', 'user_id', $user_id);
		if($get_deposit == null){
			echo "No Deposits yet";
		}
		else{ ?>
			<tr>
				<th>S/N</th>
				<th>Amount</th>
				<th>Description</th>
				<th>Payment Type</th>
				<th>Date Deposited</th>
			</tr>
			</thead>
			<tbody>
			<?php
            	$count = 1;
			foreach ($get_deposit as $deposit) {
				?>
				<tr>
					<td><?php echo $count;?></td>
					<td>&#8358;<?php echo number_format($deposit['amount']);?></td>
					<td><?php echo $deposit['description'];?></td>
					<td><?php echo $deposit['payment_type'];?></td>
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
