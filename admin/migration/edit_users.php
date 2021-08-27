<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table('users_tbl');
if(isset($_POST['cmd_edit_user'])){
    $msg = '';
    $table = 'users_tbl';
    $user_id = $_POST['unique_id'];
    $other_names = $_POST['other_names'];
    $gender = $_POST['gender'];
    $surname = $_POST['surname'];
    // $password = $_POST['password'];
    //$confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $home_address = $_POST['home_address'];
    $bank_name = $_POST['bank_name'];
    $account_name = $_POST['account_name'];
    $account_number = $_POST['account_number'];
    $bvn = $_POST['bvn'];
    $account_type = $_POST['account_type'];
    $unique_id = $object->unique_id_generator($other_names.$email.$surname);
    $add_users = $object->edit_migrated_users($table, $other_names, $gender, $surname, $phone , $email, $dob, $home_address, $bank_name, $account_name, $account_number, $bvn, $account_type, $user_id);
    $add_users_decode = json_decode($add_users, true);
    $msg = $add_users_decode['msg'];

  }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</head><br><br>
<body>
	<div class="row">
			<div class="col-md-3"> </div>
			<div class="col-md-6">
				 <?php if(!empty($msg)){
			 	if($msg == 'success'){
		            echo "<div class='alert alert-success'>User's Detail has been edited successfully, you will be rediredted shortly</div>";
		            $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
		                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
		          //$insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Edited User's Details ");
		          echo '<meta http-equiv="refresh" content="2; URL=edit_users" />';

		            // echo "naaahhhh";
		          }
		          else if($msg == 'empty_fields'){
            		echo "<div style='color: red; font-size:17px;'><strong>Some fields are empty</strong></div>";
		          }
		          else{
		            echo "<div style='color: red; font-size:17px;'><strong>Error!</strong></div>";
		          }


		          } ?>  
				<a href="index.php">Back to Home</a> | <a href="add_users.php">Add Customers</a>  
				<h3><strong>Edit Users' Details</strong> </h3>
				<form method="post" id="user_edit_form">
				<label>Client Name</label><br>
				<select required="" class="form-control form-control-sm js-example-basic-single" id="user_id" name="user_id">
					<option value="select_an_option">Select a User</option>
				<?php foreach($get_rows as $client){?>
				<option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].' - '.$client['other_names'].' ('.$client['email'].') '; ?></option>
				<?php } ?>
				</select></br><br>

				<!-- <button class="btn btn-success" id="edit_user" type="button">Edit User</button> -->
				<!-- <input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="Edit User" name="cmd_submit"> -->
				</form>
				
				<div class="col-md-3"> </div>
				<div class="edit_user_form">
					
			</div>
		


<script type="text/javascript">
		// In your Javascript (external .js resource or <script> tag)
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
		$("select#user_id").change(function(){

			$.ajax({
			  url:"edit.php",
			  method:"POST",
			  data:$('#user_edit_form').serialize(),
			  success:function(data){
			  	$(".edit_user_form").html(data);
			  }
			});
		// 	if($(this).children("option:selected").val() == 'select_an_option'){
		// 	$(".edit_user_form").empty();
		// }
		});
		// $("select#user_id").change(function(){
		// 	var selected_option = $(this).children("option:selected").val();
		// 	$("#surname").val(selected_option);
		// })
	});  
</script>		
</body>
</html>