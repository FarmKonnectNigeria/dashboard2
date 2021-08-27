<?php include('../includes/instantiated_files.php');
$get_rows = $object->get_rows_from_one_table_by_one_param('users_tbl','access_level',1);
$view = "";
$msg2 = "";
if(isset($_POST['cmd_submit'])){
  $user_id = $_POST['user_id'];
  $unit_price = $_POST['unit_price'];
  $slots_bought = $_POST['slots_bought'];
  $start_date = $_POST['start_date'];
  $no_of_days = $_POST['no_of_days'];
  $change_mf = $_POST['change_mf'];
   $mf = $_POST['mf'];

  if($change_mf == 'yes'){
     $day_interval_for_change = $_POST['day_interval_for_change'];
     $mf_increase_by = $_POST['mf_increase_by'];

     

      $view = $object->compute_contributory_package_algo_old_investments_with_mf_change($user_id,$unit_price,$slots_bought,$start_date,$no_of_days,$mf,$day_interval_for_change,$mf_increase_by);

      if(  !empty($view) ){

      $msg = 'not_empty'; 


      }else{
      $msg = ''; 

      }
   
  }else{

       $day_interval_for_change = "";
     $mf_increase_by = "";

        $view = $object->compute_contributory_package_algo_old_investments_no_mf_change($user_id,$unit_price,$slots_bought,$start_date,$no_of_days,$mf);

      if(  !empty($view) ){

      $msg = 'not_empty'; 


      }else{
      $msg = ''; 

      }


  }

 
 
}


// if(isset($_GET['del'])){
// 		$delid = $_GET['del'];
//       $delete = $object-> delete_a_row('transfer_log','unique_id',$delid);
//      	$delete2 = $object-> delete_a_row('debit_wallet_tbl','unique_id',$delid);
//         if(   ($delete === true)   &&  ($delete2 === true) ){
//         	 $msg2 = '<meta http-equiv="refresh" content="5; URL=view_transfers.php" /><div class="alert alert-success"><strong>Success! </strong>Transfer entry was deleted successfully. </div>'; 
//         }else{
//         	 $msg2 = '<meta http-equiv="refresh" content="5; URL=view_transfers.php" /><div class="alert alert-danger"><strong>Success! </strong>Transfer deletion was NOT successfull. </div>'; 
//         }
     
// }

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
<style type="text/css">
    #other_params{
       display: none;
    }
</style>

</head>

<body>
	<div class="container">
		     <br>
		    <br>
		     <?php if(!empty($msg2)){

		     		echo $view;

		      } ?>	
			<br>
		    
		<div class="row">
			<div class="col-md-3"> </div>
			<div class="col-md-6"> 
        <a href="index.php">Back to Home</a> | <a href="#">View Client Investment Details</a>  
        <h3><strong>Computing Basal/Contributory Plans</strong> </h3>
				<form method="post">
        <label>Client Name</label><br>
        <select required="" class="js-example-basic-single" id="user_id" name="user_id">
        <?php foreach($get_rows as $client){?>
        <option value="<?php echo $client['unique_id']; ?>"><?php echo $client['surname'].' - '.$client['other_names']; ?></option>
        <?php } ?>
        </select></br><br>
        
        <label>Daily Contributory Amount</label><br>
        <input required=""  type="number" name="unit_price" id="unit_price"><br><br>

        <label>No of Slots:</label><br>
        <input required=""   type="number" value="1" name="slots_bought" id="slots_bought"><br><br>

        <label>Changing MF?:</label><br>
        <select id="change_mf" name="change_mf" >
            <option value="no">no</option>
            <option value="yes">yes</option>
        </select><br><br>

        <div id="other_params">
             <input value="180" required="" class="form-control" placeholder="day interval to switch mf e.g every 180 days mf should switch" type="text" name="day_interval_for_change" id="day_interval_for_change"><br><br>
             <input value="2" required="" class="form-control" placeholder="Multiplying value to increase mf by: e.g 0.00011 by 2 will switch mf to 0.00022" type="number" name="mf_increase_by" id="mf_increase_by"><br><br>
        </div>
        

        
        <label>Investment Start Date:</label><br>
        <input required=""   type="date" name="start_date" id="start_date"><br><br>

        <label>No of days for investment to run:</label><br>
        <input required=""   type="number" name="no_of_days" id="no_of_days"><br><br>

        <label>Multiplying Factor:</label><br>
        <input required=""   type="text" name="mf" id="mf"><br><br>

        <input class="btn btn-sm btn-success" type="submit" id="cmd_submit" value="Compute Investment" name="cmd_submit">
        </form>
			</div>
			<div class="col-md-3"> </div>
		</div>
		
		<br>
		<br>
		     <?php if(!empty($msg)){ 

            echo $view;

           } ?>	
			<br>	

	</div>
 

<script type="text/javascript">
		// In your Javascript (external .js resource or <script> tag)
		$(document).ready(function() {
		$('.js-example-basic-single').select2();
    $('.js-example-basic-single2').select2();
    $('#other_params').hide();

     $('#change_mf').change(function(){
             var change_mf = $(this).val();

             if(change_mf == 'yes'){

                $('#other_params').show();

             }

             if(change_mf == 'no'){

                $('#other_params').hide();

             }


            $.ajax({
            url:"ajax_migration/wallet_bal.php",
            method:"GET",
            data:{user_id:user_id},
            success:function(data){
        
                    $('#wallet_bal').html(data);


            }
            });
        });


		});  
</script>
</body>
</html>