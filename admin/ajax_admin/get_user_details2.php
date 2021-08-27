<?php
	include('../includes/instantiated_files.php');
	include('../../classes/algorithm_functions.php');
	$user_id = $_POST['user_id'];
	$get_user_details = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
	$get_wallet_balance = $object->get_one_row_from_one_table('wallet_tbl', 'user_id', $user_id);
	$total_fp = calculate_total_floating_profit($user_id);
	$total_fp_decode= json_decode($total_fp, true);
?>
<br><hr>
<div class="row">
	<div class="col-md-1"></div>
<div class="col-md-10">
    <h3>Wallet Balance: <strong>&#8358;<?php echo number_format($get_wallet_balance['balance']);?></strong></h3>
    <h3>Floating Profit: <strong>&#8358;<?php echo number_format($total_fp_decode['msg']);?></strong></h3>
	<h2>Investment Details</h2>
	<div class="table-responsive">
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
	<?php
		$get_investment_details = $object->get_rows_from_one_table_by_id('subscribed_packages', 'user_id', $user_id);
		if($get_investment_details == null){
			echo "No Investment yet";
		}
		else{ ?>
			<tr>
				<th>S/N</th>
				<th>PACKAGE NAME</th>
				<th>SLOT</th>
				<th>DURATION</th>
				<th>AMOUNT PAID</th>
				<th> LIQUIDATION STATUS</th>
				<th> Date Subscribed</th>
				<th> Action</th>
			</tr>
			</thead>
			<tbody>
			<?php
            $count = 1;
			foreach ($get_investment_details as $investment_details) {
				 $getpackage = $object->get_one_row_from_one_table('package_definition','unique_id',$investment_details['package_id']);
				?>
				<tr>
					<td><?php echo $count;?></td>
					<td><?php echo $getpackage['package_name'];?></td>
					<td><?php echo $investment_details['no_of_slots_bought'];?></td>
					<td><?php echo $investment_details['tenure_of_product'].' day(s)';?></td>
					<td> &#8358;<?php echo number_format($investment_details['total_amount']);?></td>
					<td>
						<?php
							if($investment_details['liquidation_status'] == 0){
								echo '<small class="badge badge-sm badge-success">Not Liquidated</small>';
							}else{
								echo '<small class="badge badge-sm badge-danger">Liquidated</small>';
							}
						?>
					</td>
					<td><?php echo $investment_details['date_created'];?></td>
					<td>
						<?php
							if($investment_details['liquidation_status'] == 0){
						?>
						<small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#undo<?php echo $investment_details['id']; ?>">Undo Package Subscription</small>
						<?php }else{
							echo '<small class="badge badge-sm badge-success">Cannot Undo</small>';
						} ?>
					</td>
				</tr>
				<div class="modal fade bd-example-modal-md" id="undo<?php echo $investment_details['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Undo Package Subscription</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
	                    	<form method="post" id="undo_package_sub_request_form<?php echo $investment_details['unique_id'] ;?>">
	                          <label class="form-control-label" for="input-first-name">Reason for unsubscribing Package</label><br>
	                          <textarea class="form-control" rows="8" cols="10" name="description" id="description"></textarea>
	                          <input type="hidden" name="investment_id" id="investment_id" value="<?php echo $investment_details['unique_id'] ;?>">
	                      	</form>
                      </div>
                      <div class="modal-footer">
                      	<button type="button" class="btn btn-danger undo_package_sub_request" id="<?php echo $investment_details['unique_id'] ;?>">Submit Request</button>
		                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
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
<hr>
<div class="row">
	<div class="col-md-1"></div>
<div class="col-md-10">
	<h2>Personal Details</h2><br>
	<div><strong>Email Address:</strong> <?php
    if($get_user_details['email'] == null || $get_user_details['email'] == "Please update"){
      echo "Nil";
    }else echo $get_user_details['email'];
    ?>
  </div><br>
  <div><strong>Phone Number:</strong> <?php
    if($get_user_details['phone'] == null || $get_user_details['phone'] == "Please update"){
      echo "Nil";
    }else echo $get_user_details['phone'];
    ?>
  </div><br>
  <div><strong>Gender:</strong> <?php
    if($get_user_details['gender'] == null || $get_user_details['gender'] == "Please update"){
      echo "Nil";
    }else echo $get_user_details['gender'];
    ?>
  </div><br>
  <div><strong>Date of Birth:</strong> <?php
    if($get_user_details['dob'] == null || $get_user_details['dob'] == "Please update"){
      echo "Nil";
    }else echo $get_user_details['dob'];
    ?>
  </div><br>
	<div><strong>Home Address:</strong> <?php
    if($get_user_details['home_address'] == null || $get_user_details['home_address'] == "Please update"){
      echo "Nil";
    }else echo $get_user_details['home_address'];
    ?>
  </div><br>
  <div><strong>Next of Kin's Name:</strong> <?php
    if($get_user_details['nok_name'] == null || $get_user_details['nok_name'] == "Please update"){
      echo "Nil";
    }else echo $get_user_details['nok_name'];
    ?>
  </div><br>
  <div><strong>Next of Kin's Phone Number:</strong> <?php
    if($get_user_details['nok_phone'] == null || $get_user_details['nok_phone'] == "Please update"){
      echo "Nil";
    }else echo $get_user_details['nok_phone'];
    ?>
  </div><br>
  <div><strong>Relationship:</strong> <?php
    if($get_user_details['relationship'] == null || $get_user_details['relationship'] == "Please update"){
      echo "Nil";
    }else echo $get_user_details['relationship'];
    ?>
  </div><br>
</div>
</div>
<script>
	$('.undo_package_sub_request').click(function(e){
	e.preventDefault();
	let id = $(this).attr('id');
	let description = $("#description").val();
	$.ajax({
	  url:"ajax_admin/undo_package_sub_request.php",
	  method:"POST",
	  data:{id, description},
	  success:function(data){
		 if(data == "success"){
		 		$.alert({
				title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "Request to undo Package Subscription has been sent successfully"
			});
		 	setTimeout( function(){ window.location.href = "view_users_details";}, 4000);
		 }	

		 else if(data == "empty_fields"){
		 	$.alert({
				title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "Empty Field(s) found!"
			});
		 }

		 else if(data == "record_exists"){
		 	$.alert({
				title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "Request to undo this package subscription has already been sent!"
			});
		 }
		 
		  else if(data == "backdate_request_pending"){
		 	$.alert({
				title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "Backdate request has been sent for this investment, please undo backdate first!"
			});
		 }

		 else{
		 	$.alert({
				title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "Error!"
			});
		 }
			
	  }
	  });
	});

</script>