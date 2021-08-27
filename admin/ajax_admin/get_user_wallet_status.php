<?php 
include('../includes/instantiated_files.php');
include('../includes/header.php');
$user_id = $_POST['userid'];
$get_user_wallet = $object->get_one_row_from_one_table('wallet_tbl', 'user_id', $user_id);

if($get_user_wallet['wallet_status'] == null){
	echo '<div class="mb-3">Wallet Status: <small class = "badge badge-warning">No wallet</small> </div>';
}
else if($get_user_wallet['wallet_status'] == 1){
  echo '<div class="mb-3">Wallet Status: <small class = "badge badge-success">Activated</small> </div>';
  echo '<div>Action: <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deactivate_wallet">Deactivate Wallet</small></div>';
}else if($get_user_wallet['wallet_status'] == 0){
  echo '<div class="mb-3">Status: <small class = "badge badge-danger">Deactivated</small></div>';
  echo '<div>Action: <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#reactivate_wallet">Reactivate Wallet</small> </small></div>';
}
?>

<div class="modal fade bd-example-modal-md" id="deactivate_wallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
		    <div class="modal-header">
		      <h5 class="modal-title" id="exampleModalLabel">Deactivate Wallet</h5>
		      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        <span aria-hidden="true">&times;</span>
		      </button>
		    </div>
		    <div class="modal-body">
		      Are you sure you want to deactivate user's wallet?
		    </div>
		    <div class="modal-footer">
		       <button type="button" class="btn btn-danger deactivate_wallet" name="deactivate_wallet" id="deactivate_wallet">Deactivate</button>
		      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		    </div>
		    <form method="post" id="deactivate_wallet_form">
		        <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $user_id?>">
		    </form>
		</div>
	</div>
</div>


<div class="modal fade bd-example-modal-md" id="reactivate_wallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
		    <div class="modal-header">
		      <h5 class="modal-title" id="exampleModalLabel">Reactivate Wallet</h5>
		      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        <span aria-hidden="true">&times;</span>
		      </button>
		    </div>
		    <div class="modal-body">
		      Are you sure you want to reactivate user's wallet?
		    </div>
		    <div class="modal-footer">
		       <button type="button" class="btn btn-success reactivate_wallet" name="reactivate_wallet" id="reactivate_wallet">Reactivate</button>
		      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		    </div>
		    <form method="post" id="reactivate_wallet_form">
		        <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $user_id;?>">
		    </form>
		</div>
	</div>
</div>

  <script type="">
$(document).ready(function(){
	$('#deactivate_wallet').click(function(e){
	e.preventDefault();
	let id = $(this).attr('id');
	$.ajax({
	  url:"ajax_admin/deactivate_wallet.php",
	  method:"POST",
	  data:$('#deactivate_wallet_form').serialize(),
	  success:function(data){
		 if(data == "success"){
		 		$.alert({
				title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "User's wallet has been deactivated successfully"
			});
		 	setTimeout( function(){ window.location.href = "deactivate_wallet2";}, 4000);
		 }	
		 
		 else{

		 	$.alert({
				title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "Error in deactivating user's wallet!"
			});
		 }
			
	  }
	  });
	});

	//01-05-2020
	$('#reactivate_wallet').click(function(e){
	e.preventDefault();
	let id = $(this).attr('id');
	$.ajax({
	  url:"ajax_admin/reactivate_wallet.php",
	  method:"POST",
	  data:$('#reactivate_wallet_form').serialize(),
	  success:function(data){
		 if(data == "success"){
		 		$.alert({
				title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "User's wallet has been reactivated successfully"
			});
		 	setTimeout( function(){ window.location.href = "deactivate_wallet2";}, 4000);
		 }	
		 
		 else{

		 	$.alert({
				title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "Error in reactivating user's wallet!"
			});
		 }
			
	  }
	  });
	});
});
  </script>