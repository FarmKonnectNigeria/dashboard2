<?php include('../includes/instantiated_files.php');
  if(isset($_POST['cmd_add_user'])){
    $msg = '';
    $table = 'users_tbl';
    $other_names = $_POST['other_names'];
    // $gender = $_POST['gender'];
    $surname = $_POST['surname'];
    // $password = $_POST['password'];
    // $confirm_password = $_POST['confirm_password'];
    // $phone = $_POST['phone'];
    $email = $_POST['email'];
    // $dob = $_POST['dob'];
    // $home_address = $_POST['home_address'];
    // $bank_name = $_POST['bank_name'];
    // $account_name = $_POST['account_name'];
    // $account_number = $_POST['account_number'];
    // $bvn = $_POST['bvn'];
    $account_type = $_POST['account_type'];
    $unique_id = $object->unique_id_generator($other_names.$email.$surname);
    //$add_users = $object->insert_migrated_users($table, $other_names, $gender, $surname, $password, $confirm_password, $phone , $email, $dob, $home_address, $bank_name, $account_name, $account_number, $bvn, $account_type, $unique_id);
    $add_users = $object->insert_migrated_users($table, $other_names,  $surname,  $email, $unique_id);
    $add_users_decode = json_decode($add_users, true);
    $msg = $add_users_decode['msg'];

  }
?>
<!DOCTYPE html>
<html>
<head>

	<title>Create Customer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

</head>

<body>
	<div class="container">
		     <br>
		    <br>
		    
		    
		<div class="row">
			<div class="col-md-3"> </div>
			<div class="col-md-6">
       <?php if(!empty($msg)){

          if($msg == 'empty_fields'){
            echo "<div style='color: red; font-size:17px;'><strong>Please fill required fields</strong></div>";
            // echo "naaahhhh";
          }else if($msg == 'record_exists'){
            echo "<div style='color: red; font-size:17px;'><strong>User already exists</strong></div>";
            // echo "naaahhhh";
          }else if($msg == 'password_mismatch'){
            echo "<div style='color: red; font-size:17px;'><strong>Passwords do not match</strong></div>";
            // echo "naaahhhh";
          }else if($msg == 'success'){
            echo "<div class='alert alert-success'>User has been added successfully</div>";
            $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Added a new user ".$user_name);

            // echo "naaahhhh";
          }else{
            echo "<div style='color: red; font-size:17px;'><strong>Error!</strong></div>";
          }


          } ?>  
      <br> 
				<a href="index.php">Back to Home</a></a>  
				<h3><strong>Add a Customer</strong> </h3>
        <div style='color: red;'>Note: all fields with ** are required</div><br>
		<form method="post" action="">
          <div class="row">
                <div class="col-md-12"> 
                <label>**Surname</label><br>
                <input type="text" name="surname" id="surname" class="form-control"> 
                </div>
         </div>
         </br>
         <div class="row">
        <div class="col-md-12">
          <label>**Other Names</label><br>
            <input type="text" name="other_names" id="other_names" class="form-control"> 
          </div>
          </div>   
        </br>
        <!--<div class="row">-->
        <!--  <div class="col-md-6">-->
        <!--    <label>**Password</label><br>-->
        <!--      <input type="password" name="password" id="password" class="form-control"> -->
        <!--  </div>-->
        <!--  <div class="col-md-6">-->
        <!--    <label>**Confirm Password</label><br>-->
        <!--      <input type="password" name="confirm_password" id="confirm_password" class="form-control"> -->
        <!--  </div>-->
        <!--</div><br>-->
        <!--<label>**Gender</label><br>-->
        <!--    <select name="gender" id="gender" class="form-control">-->
        <!--      <option value="Select an Option">Select an Option</option>-->
        <!--      <option value="Male">Male</option>-->
        <!--      <option value="Female">Female</option>-->
        <!--    </select><br>-->
        <!--<label>**Phone Number</label><br>-->
        <!--      <input type="text" name="phone" id="phone" class="form-control"> <br>-->
        <!--  <label>**Date of Birth</label><br>-->
        <!--      <input type="date" name="dob" id="dob" class="form-control"><br>-->
              <label>**Email Address</label><br>
              <input type="text" name="email" id="email" class="form-control"><br>
              <!--<label>**Home Address</label><br>-->
              <!--<textarea rows="5" cols="10" class="form-control" name="home_address" id="home_address"></textarea><br>-->
              <!--<label>**Bank Name</label><br>-->
              <!--<input type="text" required="" name="bank_name" id="bank_name" class="form-control"><br>-->
              <!--<div class="row">-->
              <!--  <div class="col-md-6"> -->
              <!--    <label>**Account Name</label><br>-->
              <!--    <input type="text" required="" name="account_name" id="account_name" class="form-control"> -->
              <!--  </div>  -->
              <!--  <div class="col-md-6">-->
              <!--    <label>**Account Number</label><br>-->
              <!--      <input type="number" required="" name="account_number" id="account_number" class="form-control"> -->
              <!--    </div>-->
              <!--  </div>   -->
              <!--  </br>-->
              <!--  <div class="row">-->
              <!--  <div class="col-md-6"> -->
              <!--    <label>BVN</label><br>-->
              <!--    <input type="text" name="bvn" id="bvn" class="form-control"> -->
              <!--  </div>  -->
              <!--  <div class="col-md-6">-->
              <!--    <label>**Account Type</label><br>-->
                    <!--<input type="text" name="account_type" id="account_type" class="form-control"> -->
              <!--      <select required="" name="account_type" id="account_type" class="form-control">-->
              <!--          <option value="">select an account type</option>-->
              <!--          <option value="savings">Savings</option>-->
              <!--          <option value="current">Current</option>-->
              <!--      </select>-->
              <!--    </div>-->
              <!--  </div>   -->
              <!--  </br>-->

        </br>
				<input class="btn btn-sm btn-success" type="submit" id="cmd_add_user" value="Add a Customer" name="cmd_add_user">
				</form>
		
			</div>
			<div class="col-md-3"> </div>
		</div>
		
		<br>
		<br>
		     <?php if(!empty($msg)){ ?>
					
          </div>
		     	

		     <?php  } ?>	
			<br>	

	</div>
 

<script type="text/javascript">
		// In your Javascript (external .js resource or <script> tag)
		$(document).ready(function() {
		$('.js-example-basic-single').select2();
		});  
</script>
</body>
</html>