<?php
include('includes/instantiated_files2.php');
include('includes/header.php'); 
  if(isset($_POST['package_id'])){
  $package_id = $_POST['package_id'];
  $pack = $object->get_one_row_from_one_table('package_definition', 'unique_id', $package_id);
  $cid = $pack['package_category'];
  $getcat = $object->get_one_row_from_one_table('package_category','unique_id',$cid);
     if($pack['package_type']  == 1){
         $product_type = "Fixed";
      }
     else {
        $product_type = "Recurrent";
      }
      $user_id = $_POST['user_id'];
}

?>

<div><strong>Package Description:</strong></div><textarea class="form-control ckeditor" id="editor1" readonly name="editor1" rows="10"><?php echo $pack['package_description'];?></textarea><br>
 <!--  -->
  <div>Product Type: <strong><?php echo $product_type; ?></strong></div>
  <!--<div>Product Type: <strong><?php //echo $user_id; ?></strong></div>-->
  <br>
  <div>Available Slots: <strong><?php echo number_format($pack['no_of_slots']); ?></strong> </div>

  <br>

  <div>Minimum Slot You can buy: <strong><?php echo $pack['min_no_slots']; ?></strong> </div>

  <br>

  <div>Package Unit Price: <strong><?php echo '&#8358;'.number_format($pack['package_unit_price']); ?></strong> </div>

  <br>


  <div>Tenure of Product: <strong><?php if($pack['tenure_of_product'] == 'inf'){echo "INFINITE"; }else{ echo $pack['tenure_of_product'].' days';} ?></strong> </div>

  <br>

  <?php if($product_type == "Fixed"){?>

  <div>Expected Capital Balance After Investment for 1 slot:<br> <strong><?php if($pack['tenure_of_product'] == 'inf'){echo "Based on the number of days your investment is left to run"; }else{ echo '&#8358;'.number_format(   $pack['package_unit_price'] + ($pack['package_unit_price'] * $pack['multiplying_factor'] * $pack['tenure_of_product'])   ); } ?></strong> </div>

  <?php }
  echo "<br>";
  ?>



  <form method="POST" id="buy_package_for_user_form">
  <div>No of slots to buy: <input type="number" size="6"  name="slots_to_buy" id="slots_to_buy" > </div>


  <!-- required=""  -->

  <input type="hidden"  name="no_of_slots" id="no_of_slots" value="<?php echo $pack['no_of_slots']; ?>">
  <input type="hidden"  name="min_slots" id="min_slots" value="<?php echo $pack['min_no_slots']; ?>">
  <input type="hidden" name="unique_id" id="unique_id" value="<?php echo $pack['unique_id']; ?>">
  <input type="hidden" name="package_type" id="package_type" value="<?php echo $pack['package_type']; ?>">
  <!-- <input type="hidden" name="package_id" id="package_id" value="<?php //echo $package_id?>"> -->
  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id?>">
  <input type="hidden" name="package_category" id="package_category" value="<?php echo $pack['package_category']; ?>">
  <input type="hidden" name="package_commission" id="package_commission" value="<?php echo $pack['package_commission']; ?>">
  <hr>

  <input type="checkbox" name="terms_conditions"  id="terms_conditions"><span> Agree to terms and conditions</span>
  <br><br>
  <!-- <input  id="<?php //echo $pack['unique_id']; ?>" type="submit" name="cmd_subscribe_pack"  value="Subscribe to Package" class="btn btn-sm btn-success cmd_subscribe_pack" > -->
  <button type="button" class="btn btn-sm btn-success"  data-toggle="modal" data-target="#myModal">Buy Package</button>


  </form>
  <hr>
  <div class="display_results"  id="display_results<?php echo $pack['unique_id']; ?>">


  </div>




<!-- <button class="btn btn-success btn-sm" id="buy_package_for_user" type="button">Buy Package</button> -->