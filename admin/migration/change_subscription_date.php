<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table('users_tbl');
$view = "";
$msg2 = "";
if(isset($_POST['cmd_submit'])){
 	$user_id = $_POST['user_id'];
    $view_sub_status = $object->get_rows_from_one_table_by_one_param("subscribed_packages",'user_id',$user_id);
    $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
    $user_name = $get_user['surname']." ".$get_user['other_names'];

	if($view_sub_status != null){

          $msg = 'not_empty';
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names']; 
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Viewed Deposits of ".$user_name);
		

	}else{
          $msg = 'empty'; 
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names']; 
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Viewed Deposits of ".$user_name);

	}
}


?>
<!DOCTYPE html>
<html>
<head>

	<title>Change Subscription Date</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>

</head>

<body>
	<div class="container">
		     <br>
		    <br>
		     <?php if(!empty($msg2)){

		     		echo $msg2;

		      } ?>	
			<br>
		    
		<div class="row">
			<div class="col-md-3"> </div>
			<div class="col-md-6"> 
				<a href="index.php">Back to Home</a> | <a href="#">Change Package Subscription date</a>  <hr>
				<!--<h3><strong>Deposit(From Bank Account to Wallet)</strong> </h3>-->
				<form method="post">
				<label>Client Name</label><br>
				<select required="" class="form-control form-control-sm js-example-basic-single" id="user_id" name="user_id">
				<?php foreach($get_rows as $client){?>
				<option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].' - '.$client['other_names']. ' ('.$client['email'].')'; ?></option>
				<?php } ?>
				</select></br><br>

				
				<input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="View Status" name="cmd_submit">
				</form>
		
			</div>
			<div class="col-md-3"> </div>
		</div>
		
		<br>
		<br>
		     <?php if(!empty($msg)){ ?>
					<table class="table align-items-center table-flush">
                <thead class="thead-light">
                    
                 <?php 
                 
                         $getuser = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
                        $current_wallbal2 = $object->get_wallet_balance($user_id);
                        $fullname = $getuser['other_names'].' '.$getuser['surname'];
                        $cwlldec2 = json_decode($current_wallbal2,true);
                        $wlbbb2 = $cwlldec2['msg'];
                        echo '<h4>Name:<strong>'.$fullname.'</strong></h4><br>';
                        echo '<h4>Current Wallet Balance:<strong>N'.number_format($wlbbb2).'</strong></h4><br>';
                 
                 if($view_sub_status == null){
                        echo "<tr><td>No Package bought Yet...</td></td></tr><br>";
                       
                     
                        
                        //echo "<td><input type='text' name='wallet_bal' id='wallet_bal' placeholder='update wallet balance'><input type='submit' value='update wallet balance' >";
                        
                      } else{ 
                      
                      
                      
                      ?>
                      
                      
                      <h5><strong>List of Bought Packages</strong></h5>
                      
                  <tr>
                    
                        <th scope="col">Fullname & Email</th>
                        <th scope="col">Package Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Backdate Status</th>
                        <th scope="col">Subscription Date</th>
                        <th scope="col">Action</th>
                        <!-- <th scope="col">Date</th> -->
                        <!-- <th scope="col">Action</th> -->

                  </tr>
                </thead>
                <tbody>
                   <?php
                      foreach($view_sub_status as $value){
                        $getpackagedet = $object->get_one_row_from_one_table('package_definition','unique_id',$value['package_id']);
                        $investmentid = $value['unique_id'];
                        $backdate_stat = $object->get_one_row_from_one_table('backdate_investment_maker_checker','investment_id',$investmentid);
                        
                        if($backdate_stat == null){
                          $bds = "No Backdate Record";
                        }
                        else{
                              if($backdate_stat['status'] == 3){
                                  $bds = "Backdate Record APPROVED | <a href='#'>undo backdate</a>";
                              }else{
                                  $bds = "Backdate Record Pending | <a href='#'>delete</a>";
                              }
                              
                          }
                      ?>
                     <tr>
                      
                        <td><?php echo $getuser['other_names'].' '.$getuser['surname'].' ('.$getuser['email'].') <===>'. $getuser['unique_id'];?></td>
                        <td><?php echo $getpackagedet['package_name'];?></td>
                         <td><?php echo number_format($value['total_amount']);?></td>
                        <td><?php echo $bds;?></td>
                        <td><?php echo date('Y-m-d', strtotime($value['date_created']));?></td>
                        <td>
                          <?php
                            if($backdate_stat == null){
                              ?>
                              <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#change<?php echo $value['id']; ?>">Change Subscription Date</small>
                              <?php
                            }
                          ?>
                        </td>
                      
                       <!--  <td><?php //echo $value['date_created'];?></td> -->
                   <!--  <td><a href="#" data-target="#view_earnings<?php //echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm btn-primary">view earnings</a></td> -->


                    <!-- view history here -->
                      <div class="modal fade bd-example-modal-md" id="change<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Change Subscription Date</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form method="post" id="change_sub_date_form<?php echo $value['unique_id']; ?>">
                                    <input type="date" name="sub_date" id="sub_date" class="form-control" required="required">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                    <input type="hidden" name="user_name" value="<?php echo $getuser['other_names'].' '.$getuser['surname']?>">
                                     <input type="hidden" class="form-control" id="package_name" name="package_name" value="<?php echo $getpackagedet['package_name']; ?>">
                                </form>
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-success change_sub_date" name="change_sub_date" id="<?php echo $value['unique_id']?>">Change</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                          </div>
                        </div>

                      </tr>
                <?php } } ?> 
                </tbody>
              </table>
          </div>
		     	

		     <?php  } ?>	
			<br>	

	</div>
 

<script type="text/javascript">
	// In your Javascript (external .js resource or <script> tag)
	$(document).ready(function() {
	$('.js-example-basic-single').select2();
	});  

$('.change_sub_date').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_migration/change_sub_date.php",
  method:"POST",
  data:$('#change_sub_date_form'+id).serialize(),
  success:function(data){
    if(parseInt(data) == 200){
        $.alert({
      title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "Package Subscription Date has been changed successfully...refresh to see effected change"
      });
      //alert("Package Subscription Date has been changed successfully");
      //setTimeout( function(){ window.location.href = "change_subscription_date";}, 2000);
    }
    else if(parseInt(data) == 400){
      $.alert({
      title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "Date cannot be empty!"
      });
      //alert("Error! Date cannot be empty");
    } 

    else{
      $.alert({
      title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
      closeAnimation: 'left',content: "Error changing subscription date!"
      });
      //alert("Error changing subscription date!");
    }
      
  }
  });
});
</script>
</body>
</html>