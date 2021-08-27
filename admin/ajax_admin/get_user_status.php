<?php 
include('../includes/instantiated_files.php');
include('../includes/header.php');
$user_id = $_POST['userid'];
$get_user = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
if($get_user['access_level'] == 1){
  echo '<div class="mb-3">Status: <small class = "badge badge-success">Active</small> </div>';
  echo '<div>Action: <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#disable">Disable Account</small></div>';
}else if($get_user['access_level'] == 0){
  echo '<div class="mb-3">Status: <small class = "badge badge-danger">Disabled</small></div>';
  echo '<div>Action: <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#enable">Enable Account</small> </small></div>';
}else{
  echo '<small class = "badge badge-primary">Status Unknown</small>';
}
?>

<div class="modal fade bd-example-modal-md" id="disable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Disable Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
      	<form method="post" id="disable_account_form">
	        <label class="form-control-label" for="input-first-name">Reason for disabling user</label><br>
		    <textarea class="form-control" rows="8" cols="10" name="description" id="description"></textarea>
	        <input type="hidden" name="user_id" class="form-control" value="<?php echo $user_id;?>">
        </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="disable_account">Disable</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade bd-example-modal-md" id="enable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enable Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to enable this account?
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="enable_account">Enable</button>
        <form method="post" id="enable_account_form">
          <input type="hidden" name="user_id" class="form-control" value="<?php echo $user_id;?>">
        </form>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>

  <script type="">
$(document).ready(function(){
	$('#disable_account').click(function(e){
	e.preventDefault();
	let id = $(this).attr('id');
	$.ajax({
	  url:"ajax_admin/disable_user_account.php",
	  method:"POST",
	  data:$('#disable_account_form').serialize(),
	  success:function(data){
		 if(data == "success"){
		 		$.alert({
				title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "User has been disabled successfully"
			});
		 	setTimeout( function(){ window.location.href = "disable_account2";}, 4000);
		 }	

		 else{
		 	$.alert({
				title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "Error in disabling user!"
			});
		 }
			
	  }
	  });
	});

	$('#enable_account').click(function(e){
	e.preventDefault();
	let id = $(this).attr('id');
	$.ajax({
	  url:"ajax_admin/enable_user_account.php",
	  method:"POST",
	  data:$('#enable_account_form').serialize(),
	  success:function(data){
		 if(data == "success"){
		 		$.alert({
				title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "User has been enabled successfully"
			});
		 	setTimeout( function(){ window.location.href = "disable_account2";}, 4000);
		 }	

		 else{
		 	$.alert({
				title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
				closeAnimation: 'left',content: "Error in enabling user!"
			});
		 }
			
	  }
	  });
	});
});
  </script>