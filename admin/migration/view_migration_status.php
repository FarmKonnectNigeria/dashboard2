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


if(  isset($_GET['del'])  && isset($_GET['usid']) && isset($_GET['amount'])    ){
		$delid = $_GET['del'];
		$user_id = $_GET['usid'];
        $current_wallbal = $object->get_wallet_balance($user_id);
        $cwlldec = json_decode($current_wallbal,true);
        $wlbbb = $cwlldec['msg'];
        
        
        
        $amount = $_GET['amount'];
        $new_wall_bal = $wlbbb - $amount;
        $user_id = $_GET['usid'];
        
        
        ////update wallet balance
        $update_wallet_balance = $object->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_wall_bal);
        $uwdec = json_decode($update_wallet_balance,true);
        if($uwdec['status'] == '0'){
              $msg2 = '<meta http-equiv="refresh" content="5; URL=view_deposits.php" /><div class="alert alert-danger"><strong>Success! </strong>Deposit deletion was NOT successfull. </div>'; 
        }else{
            $delete = $object-> delete_a_row('debit_wallet_tbl','unique_id',$delid);
            $delete2 = $object-> delete_a_row('credit_wallet_tbl','unique_id',$delid);
            $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
            $user_name = $get_user['surname']." ".$get_user['other_names'];
            if(   ($delete === true)   &&  ($delete2 === true) ){
            $msg2 = '<meta http-equiv="refresh" content="5; URL=view_deposits.php" /><div class="alert alert-success"><strong>Success! </strong>Deposit entry was deleted successfully. </div>'; 
            $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
            $fullname = $get_fullname['surname'].' '.$get_fullname['other_names']; 
            $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Deleted Deposits of ".$user_name);
            }else{
            $msg2 = '<meta http-equiv="refresh" content="5; URL=view_deposits.php" /><div class="alert alert-danger"><strong>Success! </strong>Deposit deletion was NOT successfull. </div>'; 
            }
        }
        
       
     
}

 ?>
<!DOCTYPE html>
<html>
<head>

	<title>Migration Status</title>
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
		     <?php if(!empty($msg2)){

		     		echo $msg2;

		      } ?>	
			<br>
		    
		<div class="row">
			<div class="col-md-3"> </div>
			<div class="col-md-6"> 
				<a href="index.php">Back to Home</a> | <a href="#">Check Migration STATUS</a>  <hr>
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
                
                        <th scope="col"></th>
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
                        <td></td>
                      
                       <!--  <td><?php //echo $value['date_created'];?></td> -->
                   <!--  <td><a href="#" data-target="#view_earnings<?php //echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm btn-primary">view earnings</a></td> -->


                    <!-- view history here -->


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
</script>
</body>
</html>