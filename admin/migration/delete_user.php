<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table('users_tbl');
$msg = "";
if(isset($_POST['cmd_submit'])){
  $user_id = $_POST['user_id'];
  $check_deposit = $object->get_rows_from_one_table_by_one_param('credit_wallet_tbl','user_id', $user_id);
  $check_subscribed_package = $object->get_rows_from_one_table_by_one_param('subscribed_packages','user_id', $user_id);
  if($check_deposit !== null || $check_subscribed_package !== null){
    $msg = "investment_exists";
  }else{
      $delete_user = $object->delete_a_row('users_tbl','unique_id',$user_id);
      if($delete_user){
        $msg = "success";
      }else{
        $msg = "error";
      }
  }
     
}

 ?>
<!DOCTYPE html>
<html>
<head>

  <title>Deposits</title>
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
         <?php if(!empty($msg)){
          if($msg == "investment_exists"){
            echo "<div class='alert alert-danger'>Error! User has a running investment or Deposits have been added for the user</div>";
          }else if($msg == "error"){
            echo "<div class='alert alert-danger'>Error in deleting user</div>";
          }else if($msg == "success"){
            echo "<div class='alert alert-success'>User's Detail has been deleted successfully</div>";
                $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                    $fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
              $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Deleted a user ");
              echo '<meta http-equiv="refresh" content="5; URL=delete_user" />';
          }
          } 
          ?>  
      <br>
        
    <div class="row">
      <div class="col-md-3"> </div>
      <div class="col-md-6"> 
        <a href="index.php">Back to Home</a>  
        <h3><strong>Delete User</strong> </h3>
        <form method="post">
        <label>Client Name</label><br>
        <select required="" class="form-control form-control-sm js-example-basic-single" id="user_id" name="user_id">
        <?php foreach($get_rows as $client){?>
        <option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].' - '.$client['other_names']. ' ('.$client['email'].')'; ?></option>
        <?php } ?>
        </select></br><br>

        
        <input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="Delete User" name="cmd_submit">
        </form>
    
      </div>
      <div class="col-md-3"> </div>
    </div>
    
    <br>
    <br>
          </div>

  </div>
 

<script type="text/javascript">
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
    });  
</script>
</body>
</html>