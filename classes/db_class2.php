<?php require_once('db_connect.php');

class DbQueries{
 public function __construct(){
       $this->connection = mysqli_connect('localhost', 'f42v5vy0h3bw_app2_farmkonnect', 'f42v5vy0h3bw_app2_farmkonnect', 'f42v5vy0h3bw_app2_farmkonnect');
		if(mysqli_connect_error()){
			die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
		}
	}

////other functions
function secure_database($value){
	$value = mysqli_real_escape_string($this->connection, $value);
	return $value;
}


function unique_id_generator($data){
     $data = $this->secure_database($data);
     $newid = md5(uniqid().time().rand(11111,99999).rand(11111,99999).$data);
     return $newid;
}

//02-06-2020
function funds_request($amount, $admin_id){
  $amount = $this->secure_database($amount);
  $admin_id = $this->secure_database($admin_id);
  $unique_id = $this->unique_id_generator($admin_id.rand());
  //$check = $this->check_row_exists_by_one_param('bank_accounts','account_number', $account_number);
  
  if($admin_id == '' || $amount == '' ){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

  // if($check === true){
  //   return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  // }
  else{
    $insert_fund_request_sql = "INSERT INTO `cash_request_log` SET `unique_id` = '$unique_id', `admin_id` = '$admin_id',`amount` = '$amount', `status`= 0, `date_created` = now()";
         $insert_fund_request_query = mysqli_query($this->connection, $insert_fund_request_sql) or die(mysqli_error($this->connection));
         if($insert_fund_request_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}

//02-06-2020
function insert_expense_logs($admin_id, $description, $amount){
  $admin_id = $this->secure_database($admin_id);
  $amount = $this->secure_database($amount);
  $description = $this->secure_database($description);
  $data = $admin_id.$description;
  $unique_id = $this->unique_id_generator($data);

  if($admin_id == '' || $description == '' || $amount == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
  else{
    $insert_expense_log_sql = "INSERT INTO `accountant_expense_log` SET `unique_id` = '$unique_id',`description` = '$description', `admin_id`='$admin_id', `amount`='$amount', `date_created` = now()";
         $insert_expense_log_query = mysqli_query($this->connection, $insert_expense_log_sql) or die(mysqli_error($this->connection));
         if($insert_expense_log_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}


}

?>