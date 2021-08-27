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
    <h3>Wallet Balance: <strong>&#8358;<?php echo number_format($get_wallet_balance['balance'],2);?></strong></h3>
    <h3>Floating Profit: <strong>&#8358;<?php echo number_format($total_fp_decode['msg'],2);?></strong></h3>
    <h3>Total Investment: <strong>&#8358;<?php echo number_format($total_investment_decode['msg'],2);?></strong></h3>
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
				<th>PACKAGE TYPE</th>
				<th>PACKAGE NAME</th>
				<th>SLOT</th>
				<th>DURATION</th>
				<th>AMOUNT PAID So Far</th>
				<th>FLOATING PROFIT</th>
				<th>LIQUIDATION STATUS</th>
				<th> Date Subscribed</th>
				<th> Action</th>
			</tr>
			</thead>
			<tbody>
			<?php
            $count = 1;
            $total_fp = 0;
			foreach ($get_investment_details as $investment_details) {
				$getpackage = $object->get_one_row_from_one_table('package_definition','unique_id',$investment_details['package_id']);
				$investmentid = $investment_details['unique_id'];
			
				
				//packagetype total contributed
				if($investment_details['package_type'] == '1'){
				    $package_type = "Fixed";
                    $get_floating_profit = get_details_for_a_running_investment($investmentid);
                    $get_floating_profit_dec = json_decode($get_floating_profit,true);
                    $total_amount = $investment_details['total_amount'];
                    $floating_profit = $get_floating_profit_dec['floating_profit'];
                    
				}else{
				    $package_type = "Recurrent";
                    $get_total_amount = recurrent_sum_of_deductions_per_investment($investmentid);
                    $get_total_amount_dec = json_decode($get_total_amount,true);
                    $total_amount = $get_total_amount_dec['msg'] ;
                    
                    
                    $get_floating_profit = recurrent_sum_of_profits_per_investment($investmentid);
                    $get_floating_profit_dec = json_decode($get_floating_profit,true);
                    $floating_profit = $get_floating_profit_dec['msg'];
				    
				}
				
				//floatingp
			    
				?>
				<tr>
					<td><?php echo $count;?></td>
					<td><?php echo $package_type;?></td>
					<td><?php echo $getpackage['package_name'];?></td>
					<td><?php echo $investment_details['no_of_slots_bought'];?></td>
					<td><?php echo $investment_details['tenure_of_product'].' day(s)';?></td>
					<td> &#8358;<?php echo number_format($total_amount);?></td>
					<td> &#8358;<?php  
					    if($floating_profit == NULL){
					        echo "0.00";
					    }else{
					        echo number_format($floating_profit,2);
					    }
					
					
					;?></td>
					<td>
						<?php
							if($investment_details['liquidation_status'] == 0){
								echo '<small class="badge badge-sm badge-warning">Not Liquidated</small>';
							}
							else{
							  $get_liquidation_details = $object->get_one_row_from_one_table('liquidated_investments_tbl', 'investment_id', $investment_details['unique_id']);
							    
							  if($get_liquidation_details['process_status'] == 2){
							         	echo '<small class="badge badge-sm badge-success">Liquidated: APPROVED</small>';
							         } 
						       else if($get_liquidation_details['process_status'] == 3){
							         	echo '<small class="badge badge-sm badge-danger">Liquidated: REJECTED</small>';
						        	}
						       else{
							         	//
						           	}
							    
							}
							
						
						?>
					</td>
					<td><?php echo $investment_details['date_created'];?></td>
					<td>
						<?php
						if($role_name == 'Investment Manager'){
							if($investment_details['liquidation_status'] == 0){
						?>
						<small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#undo<?php echo $investment_details['id']; ?>">Undo Package Subscription</small>
						<?php }else{
							echo '<small class="badge badge-sm badge-success">Cannot Undo</small>';
						} } ?>
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
                          Are you sure you want to proceed?
                      </div>
                      <div class="modal-footer">
                      	<button type="button" class="btn btn-danger unbuy_package" id="<?php echo $investment_details['unique_id'] ;?>">Yes</button>
		                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      </div>

                        <form method="post" id="unbuy_package_form<?php echo $investment_details['unique_id'] ;?>">
                        <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $investment_details['total_amount'] ;?>">
                        <input type="hidden" name="no_of_slots_bought" id="no_of_slots_bought" value="<?php echo $investment_details['no_of_slots_bought'] ;?>">
                        <input type="hidden" name="investment_id" id="investment_id" value="<?php echo $investment_details['unique_id'] ;?>">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $investment_details['user_id'] ;?>">
                        <input type="hidden" name="package_id" id="package_id" value="<?php echo $investment_details['package_id'];?>">
                      </form>
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
</div><hr>
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
</div><hr>

<script type="text/javascript">
	$(document).ready(function(){
		$('.unbuy_package').click(function(e){
			e.preventDefault();
			let idd = $(this).attr('id');
			//alert(idd);
			$.ajax({
			  url:"ajax_admin/unbuy_package.php",
			  method:"POST",
			  // data:$('#unbuy_package_form'+id).serialize(),
			  data:{idd:idd},
			  success:function(data){
				 //alert(data);
				 if(data == "success"){
				 		$.alert({
						title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
						closeAnimation: 'left',content: "Package Subscription has been undone successfully"
					});
				 	setTimeout( function(){ window.location.href = "view_users_details";}, 4000);
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
	});
</script>