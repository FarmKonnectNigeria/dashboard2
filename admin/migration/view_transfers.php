<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table_by_one_param('users_tbl','access_level',1);
$view = "";
$msg2 = "";
if(isset($_POST['cmd_submit'])){
  $sender_id = $_POST['sender_id'];
	$beneficiary_id = $_POST['beneficiary_id'];
  $view = $object->get_rows_from_one_table_by_two_params("transfer_log",'sender_id',$sender_id,'beneficiary_id',$beneficiary_id);

	if($view != null){

          $msg = 'not_empty'; 
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Viewed Transfers ");
		

	}else{
          $msg = 'empty'; 
          $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Viewed Transfers ");

	}
}


if(isset($_GET['del'])){
		$delid = $_GET['del'];
      $delete = $object-> delete_a_row('transfer_log','unique_id',$delid);
     	$delete2 = $object-> delete_a_row('debit_wallet_tbl','unique_id',$delid);
        if(   ($delete === true)   &&  ($delete2 === true) ){
        	 $msg2 = '<meta http-equiv="refresh" content="5; URL=view_transfers.php" /><div class="alert alert-success"><strong>Success! </strong>Transfer entry was deleted successfully. </div>';
           $get_fullname =$object->get_one_row_from_one_table('admin_tbl','unique_id',$uid);
                $fullname = $get_fullname['surname'].' '.$get_fullname['other_names'];
          $insert_migration_log = $object->insert_migration_logs($fullname, $uid, "Deleted Transfers "); 
        }else{
        	 $msg2 = '<meta http-equiv="refresh" content="5; URL=view_transfers.php" /><div class="alert alert-danger"><strong>Success! </strong>Transfer deletion was NOT successfull. </div>'; 
        }
     
}

 ?>
<!DOCTYPE html>
<html>
<head>

	<title>Withdrawals</title>
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
				<a href="index.php">Back to Home</a> | <a href="transfers.php">Add Transfers</a>  
				<h3><strong>View Transfers(From Wallet to Wallet)</strong> </h3>
				<form method="post">
				<label>Sender Client Name</label><br>
				<select required="" class="form-control form-control-sm js-example-basic-single" id="sender_id" name="sender_id">
				<?php foreach($get_rows as $client){?>
				<option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].' - '.$client['other_names']; ?></option>
				<?php } ?>
				</select></br><br>

          <label>Beneficiary Client Name</label><br>
        <select required="" class="form-control form-control-sm js-example-basic-single2" id="beneficiary_id" name="beneficiary_id">
        <?php foreach($get_rows as $client){?>
        <option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].' - '.$client['other_names']; ?></option>
        <?php } ?>
        </select></br><br>

				
				<input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="View Transfers" name="cmd_submit">
				</form>
		
			</div>
			<div class="col-md-3"> </div>
		</div>
		
		<br>
		<br>
		     <?php if(!empty($msg)){ ?>
					<table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($view == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Amount Transfered</th>
                        <th scope="col">Sender</th>
                        <th scope="col">Beneficiary</th>
                        <th scope="col">Date Transfered</th>
                        <th scope="col"></th>
                        <!-- <th scope="col">Date</th> -->
                        <!-- <th scope="col">Action</th> -->

                  </tr>
                </thead>
                <tbody>
                   <?php
                       


                      foreach($view as $value){
                    

                          $get_sender_info = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['sender_id']);
                          $get_benef_info = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['beneficiary_id']);
                       
                        
                      ?>
                     <tr>
                      
                        <td><?php echo '&#8358;'.number_format($value['amount_sent']);?></td>
                        <td><?php echo $get_sender_info['surname'].' - '.$get_sender_info['other_names'];?></td>
                        <td><?php echo $get_benef_info['surname'].' - '.$get_benef_info['other_names'];?></td>
                      
                        <td><?php echo $object->formatted_date($value['date_created']); ?></td>
                        <td><a style="color:red; font-size: 12px;" href="view_transfers.php?del=<?php echo $value['unique_id']; ?>" ><strong>delete</strong></a></td>
                      
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
    $('.js-example-basic-single2').select2();
		});  
</script>
</body>
</html>