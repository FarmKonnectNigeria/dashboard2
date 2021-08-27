<?php
ini_set('memory_limit', '-1');
include('../includes/instantiated_files.php');
	if(isset($_POST['user_id'])){
	$get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$_POST['user_id']);
}


?>
		 
	<h3><strong>Edit User</strong> </h3>
	<form method="post" action="">
	<div class="row">
	<div class="col-md-6"> 
	<label>Surname</label><br>
	<input type="hidden" name="unique_id" value="<?php echo $_POST['user_id'];?>">
	<input type="text" name="surname" id="surname" class="form-control" value="<?php echo isset($get_user['surname']) ? $get_user['surname'] : '';?>"> 
	</div>  
	<div class="col-md-6">
	<label>Other Names</label><br>
	<input type="text" name="other_names" id="other_names" class="form-control" value="<?php echo isset($get_user['other_names']) ? $get_user['other_names'] : '';?>"> 
	</div>
	</div>   
	</br>
	<div class="row">
	</div>
	<label>Gender</label><br>
	<select name="gender" id="gender" class="form-control">
	  <option value="">Select an Option</option>
	  <?php
// 	  if(isset($get_user['gender'])){
	  	if($get_user['gender'] == 'male'){
	  	?>
	  	<option value="male" selected="selected">Male</option>
	  	<option value="female">Female</option>	
	  	<?php }else if($get_user['gender'] == 'female'){
	  		?>
	  	<option value="male">Male</option>
	  	<option value="female" selected="selected">Female</option>
	  	<?php }else if($get_user['gender'] == ''){
	  ?>
	  <option value="male">Male</option>
	  <option value="female">Female</option>
	<?php } else{//}?>
	 <option value="male">Male</option>
	  <option value="female">Female</option>
	  <?php }?>
	</select><br>
	<label>Phone Number</label><br>
	<input type="text" name="phone" id="phone" class="form-control" value="<?php echo isset($get_user['phone']) ? $get_user['phone'] : '';?>"> <br>
	<label>Date of Birth</label><br>
	<input type="date" name="dob" id="dob" class="form-control" value="<?php echo isset($get_user['dob']) ? $get_user['dob'] : '';?>"><br>
	<label>Email Address</label><br>
	<input type="text" name="email" id="email" class="form-control" value="<?php echo isset($get_user['email']) ? $get_user['email'] : '';?>" ><br>
	<label>Home Address</label><br>
	<textarea rows="5" cols="10" class="form-control" name="home_address" id="home_address"><?php echo isset($get_user['home_address']) ? $get_user['home_address'] : '';?></textarea><br>
	<label>Bank Name</label><br>
	<input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo isset($get_user['bank_name']) ? $get_user['bank_name'] : '';?>"><br>
	<div class="row">
	<div class="col-md-6"> 
	  <label>Account Name</label><br>
	  <input type="text" name="account_name" id="account_name" class="form-control" value="<?php echo isset($get_user['account_name']) ? $get_user['account_name'] : '';?>"> 
	</div>  
	<div class="col-md-6">
	  <label>Account Number</label><br>
	    <input type="number" name="account_number" id="account_number" class="form-control" value="<?php echo isset($get_user['account_number']) ? $get_user['account_number'] : 0;?>"> 
	  </div>
	</div>   
	</br>
	<div class="row">
	<div class="col-md-6"> 
	  <label>BVN</label><br>
	  <input type="text" name="bvn" id="bvn" class="form-control" value="<?php echo isset($get_user['bvn']) ? $get_user['bvn'] : '';?>"> 
	</div>  
	<div class="col-md-6">
	  <label>Account Type</label><br>
	    <input type="text" name="account_type" id="account_type" class="form-control" value="<?php echo isset($get_user['account_type']) ? $get_user['account_type'] : '';?>"> 
	  </div>
	</div>   
	</br>

	</br>
	<input class="btn btn-sm btn-success" type="submit" id="cmd_edit_user" value="Edit User" name="cmd_edit_user">
	</form>
	</div>
