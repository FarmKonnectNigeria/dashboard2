<?php 
include('../includes/instantiated_files.php');
$user_id = $_POST['user_id'];
$get_user_bank_details = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
?>
<div class="row" id="">
  <div class="col-lg-12">
       <label class="form-control-label" for="input-first-name">Bank Name</label><br>
   <input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo $get_user_bank_details['bank_name'];?>">
  </div>
</div>   
<div class="row" id="">
  <div class="col-lg-12">
    <label class="form-control-label" for="input-first-name">Account Name</label><br>
    <input type="text" name="account_name" id="account_name" class="form-control" value="<?php echo $get_user_bank_details['account_name'];?>">
  </div>
</div>
 <div class="row" id="">
  <div class="col-lg-12">
    <label class="form-control-label" for="input-first-name" >Account Number</label><br>
    <input type="text" name="account_number" id="account_number" class="form-control" value="<?php echo $get_user_bank_details['account_number'];?>">
  </div>
</div>
 <div class="row" id="">
  <div class="col-lg-12">
    <label class="form-control-label" for="input-first-name" >BVN</label><br>
    <input type="text" name="bvn" id="bvn" class="form-control" value="<?php echo $get_user_bank_details['bvn'];?>">
  </div>
</div>
 <div class="row" id="">
  <div class="col-lg-12">
    <label class="form-control-label" for="input-first-name" >Account Type</label><br>
    <input type="text" name="account_type" id="account_type" class="form-control" value="<?php echo $get_user_bank_details['account_type'];?>">
  </div>
</div>
