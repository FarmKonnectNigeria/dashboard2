<?php
	include('../includes/instantiated_files.php');
	include('../../classes/algorithm_functions.php');
	$package_id = $_POST['package_id'];
	$get_investments = $object->get_rows_from_one_table_by_id('subscribed_packages', 'package_id', $package_id);
	
?>
<br><hr>
<div class="row">
	<div class="col-md-1"></div>
<div class="col-md-12">
	<div class="table-responsive">
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
	<?php
		if($get_investments == null){
			echo "No Investment yet";
		}
		else{ ?>
			<tr>
				<th>S/N</th>
				<th>Client's Name</th>
				<th>PACKAGE TYPE</th>
				<th>PACKAGE NAME</th>
				<th>TOTAL AMOUNT</th>
				<th>PROFIT ADDED</th>
				<th> Date Added</th>
				<th> Status</th>
				<th> Action</th>
			</tr>
			</thead>
			<tbody>
			<?php
            $count = 1;
			foreach ($get_investments as $investment_details) {
				$get_profit = $object->get_one_row_from_one_table('added_profits_log_for_running_investments_for_processing','investment_id',$investment_details['unique_id']);
				//$investmentid = $investment_details['unique_id'];
				$get_user_details = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $investment_details['user_id']);
				$get_package_details = $object->get_one_row_from_one_table('package_definition', 'unique_id', $investment_details['package_id']);
				//floatingp
			    if($get_profit != null){
			    	$client_name = $get_user_details['surname'].' '.$get_user_details['other_names'];
			    	$package_type = $get_package_details['package_type'] == 1 ? 'Fixed' : 'Reccurrent';
			    	$package_name = $get_package_details['package_name'];
			    	$total_amount = number_format($investment_details['total_amount']);
			    	$profit_added = number_format($get_profit['profit_amount']);
			    	$date_added = $get_profit['date_added']; 
				?>
				<tr>
					<td><?php echo $count;?></td>
					<td><?php echo $client_name;?></td>
					<td><?php echo $package_type;?></td>
					<td><?php echo $package_name;?></td>
					<td>&#8358;<?php echo $total_amount;?></td>
					<td>&#8358;<?php echo $profit_added;?></td>
					<td><?php echo $date_added;?></td>
					<td>
						<?php
							if($get_profit['processing_status'] == 0){
								echo '<span id="mark_profit_modal1'.$investment_details['unique_id'].'"><small class="badge badge-sm badge-primary">Not Processed</small><span>';
							}else{
								echo '<small class="badge badge-sm badge-success">Processed</small>';
							}
						?>
					</td>
					<td>
						<?php
							if($get_profit['processing_status'] == 0){
						?>
						<span id="mark_profit_modal<?php echo $investment_details['unique_id']; ?>"><small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#mark<?php echo $investment_details['unique_id']; ?>">Mark as Processed</small></span>
						<?php }else{
							echo '<small class="badge badge-sm badge-danger">No action</small>';
						} ?>
					</td>
				</tr>
				<div class="modal fade mark_modal" id="mark<?php echo $investment_details['unique_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalScrollableTitle">Mark Profit as Processed</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to mark this profit as processed?
                    </div>
                    <form id="mark_profit_as_processed<?php echo $investment_details['unique_id']; ?>">
                    	<input type="hidden" name="unique_id" value="<?php $get_profit['investment_id']?>">
                    </form>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success mark_profit_as_processed" id="<?php echo $investment_details['unique_id']; ?>">Yes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                  </div>
                </div>
              </div>
				<?php
				$count++;
			} 
			?>
		<?php }
		}
	?>
			</tbody>
		</table>
	</div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.mark_profit_as_processed').click(function(e){
			e.preventDefault();
			let investment_id = $(this).attr('id');
			//alert(idd);
			$.ajax({
			  url:"ajax_admin/mark_profit_as_processed.php",
			  method:"POST",
			  // data:$('#unbuy_package_form'+id).serialize(),
			  data:{investment_id:investment_id},
			  success:function(data){
				 //alert(data);
				 if(data == "success"){
			 		$.alert({
						title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
						closeAnimation: 'left',content: "Profit has been marked successfully"
					});
					$('.mark_modal').modal("hide");
					$('#mark_profit_modal1'+investment_id).html("<small class='badge badge-success'>Processed</small>");
					$('#mark_profit_modal'+investment_id).html("<small class='badge badge-danger'>No action</small>");
			 		//setTimeout( function(){ window.location.href = "view_floating_profit_details";}, 4000);
				 }	

				 else{
				 	$.alert({
						title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
						closeAnimation: 'left',content: "Error in marking profit!"
					});
				 }
					
			  }
	  		});
		});
	});
</script>