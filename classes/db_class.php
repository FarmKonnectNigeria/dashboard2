<?php 
ini_set('memory_limit', '-1');
require_once('db_connect.php');


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

function update_package_image($package_id,$file_name, $size, $tmpName, $type){
    $imgchange = $this->image_upload($file_name, $size, $tmpName, $type);
      $img_dec = json_decode($imgchange,true);
      $new_image_path = 'uploads/'.$file_name;
      if($img_dec['status'] == 1){
          $sql = "UPDATE `package_definition` SET `image_url` = '$new_image_path' WHERE `unique_id` = '$package_id'";
          $query = mysqli_query($this->connection, $sql);
          if($query){
               
               return  json_encode(["status"=>"1", "msg"=>"Package Image was successfully uploaded!"]);
              
          }else{
           
               return  json_encode(["status"=>"0", "msg"=>"Server Error"]);

          }


      }else{
         return  json_encode(["status"=>"0", "msg"=>"Please try uploading again"]);
      }
}


function update_category_image($package_id,$file_name, $size, $tmpName, $type){
    $imgchange = $this->image_upload($file_name, $size, $tmpName, $type);
      $img_dec = json_decode($imgchange,true);
      $new_image_path = 'uploads/'.$file_name;
      if($img_dec['status'] == 1){
          $sql = "UPDATE `package_category` SET `image_url` = '$new_image_path' WHERE `unique_id` = '$package_id'";
          $query = mysqli_query($this->connection, $sql);
          if($query){
               
               return  json_encode(["status"=>"1", "msg"=>"Category Image was successfully uploaded!"]);
              
          }else{
           
               return  json_encode(["status"=>"0", "msg"=>"Server Error"]);

          }


      }else{
         return  json_encode(["status"=>"0", "msg"=>"Please try uploading again"]);
      }
}

function format_date($date){
    $date = $this->secure_database($date);
    $new_date_format = date('F-d-Y', strtotime($date));
    return $new_date_format;
}
////end other functions

////db functions starts
function check_row_exists_by_one_param($table,$param,$value){
  $table = $this->secure_database($table);
  $param = $this->secure_database($param);
  $value = $this->secure_database($value);
  $sql = "SELECT * FROM `$table` WHERE `$param` = '$value'";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0 ){
    return true;
  }else{
    return false;
  }
}

function check_row_exists_by_two_params($table,$param,$value,$param2,$value2){
  $table = $this->secure_database($table);
  $param = $this->secure_database($param);
  $value = $this->secure_database($value);
  $param2 = $this->secure_database($param2);
  $value2 = $this->secure_database($value2);
  $sql = "SELECT * FROM `$table` WHERE `$param` = '$value' AND `$param2` = '$value2' ";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0 ){
    return true;
  }else{
    return false;
  }
}

///notification/message
function message_notification1($returned_url,$status,$actual_message){
      if($status == 0){
          return '<meta http-equiv="refresh" content="133; URL='.$returned_url.'" /><div class="alert alert-danger"><strong>Oops! </strong>'.$actual_message.' </div>';
      }

      if($status == 1){
        return '<meta http-equiv="refresh" content="133; URL='.$returned_url.'" /><div class="alert alert-success"><strong>Success! </strong>'.$actual_message.' </div>';
      }
}

function simple_message($value){
      $value = $this->secure_database($value);
      if($value = ""){
        return null;
      }else{
        return $value;
      }
      
}

///create function
function insert_into_db($table,$data,$param,$validate_value){
  $validate_value = $this->secure_database($validate_value);
  $param = $this->secure_database($param);
  $table = $this->secure_database($table);
  $unique_id = $this->unique_id_generator(md5(uniqid()));
  $emptyfound = 0;
  $check = $this->check_row_exists_by_one_param($table,$param,$validate_value);
  if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{

      if( is_array($data) && !empty($data) ){
     $sql = "INSERT INTO `$table` SET  `unique_id` = '$unique_id',";
     $sql .= "`date_created` = now(), ";
     //$sql .= "`privilege` = '1', ";
        for($i = 0; $i < count($data); $i++){
            $each_data = $data[$i];
            
            if($_POST[$each_data] == ""  ){
              $emptyfound++;
            }


            if($i ==  (count($data) - 1)  ){
                 $sql .= " $data[$i] = '$_POST[$each_data]' ";
              }else{
                if($data[$i] === "password"){
                $enc_password = md5($_POST[$data[$i]]); 
                $sql .= " $data[$i] = '$enc_password' ,";
                }else{
                $sql .= " $data[$i] = '$_POST[$each_data]' ,";
                } 
            }

        }
    
      
      if($emptyfound > 0){
          return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
      } 
       else{
        $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
        }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }

      }  


    }
    else{
      return json_encode(["status"=>"0", "msg"=>"error"]);
    }

  } 

}


function unique_id_generator($data){
     $data = $this->secure_database($data);
     $newid = md5(uniqid().time().rand(11111,99999).rand(11111,99999).$data);
     return $newid;
}


////end create


///email function start
 function email_function($email, $subject, $content){
//   $headers = "MIME-Version: 1.0" . "\r\n";
//   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//   $headers .= 'From: FarmKonnect <admin@farmkonnect.com>' . "\r\n";
//   $headers .= 'Cc: support@loyalty.com' . "\r\n";
$headers = "From: FarmKonnect <admin@farmkonnectng.com>"."\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $mail = mail($email, $subject, $content, $headers);
  return $mail;
}

  function send_lead_msg($lead_email,$subject, $msg, $aff_email, $aff_name){
  $msg = $this->secure_database($msg);
 
  $subject = $this->secure_database($subject);

  $lead_email = $this->secure_database($lead_email);
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= 'From: '.$aff_name.'  '.$aff_email.' ' . "\r\n";
  $headers .= 'Cc: admin@farmkonnect.com' . "\r\n";
  $headers .= 'Cc: support@loyalty.com' . "\r\n";
  $mail = @mail($lead_email, $subject, $msg, $headers);
    return json_encode(["status"=>"1", "msg"=>$mail]);
  
   // if($mail){
   //  return json_encode(["status"=>"1", "msg"=>"success"]);
    
   // }else{
   //  return json_encode(["status"=>"0", "msg"=>"failure"]);
      
   // }
  
}
///email function end




function insert_users_without_referral($table, $other_names, $gender, $surname, $password, $confirm_password, $phone , $email, $param, $unique_id){
    $other_names = $this->secure_database($other_names);
    $surname = $this->secure_database($surname);
    $password = $this->secure_database($password);
    $phone = $this->secure_database($phone);
    $email = $this->secure_database($email);
    $gender = $this->secure_database($gender);

    $check = $this->check_row_exists_by_one_param($table,$param,$email);
    $check_lead_exist = $this->check_row_exists_by_one_param('leads','email',$email);
  
  if($other_names == "" || $surname == "" || $password == "" || $phone == "" || $confirm_password == "" || $email == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }

  else{
       if ($password != $confirm_password){
        return json_encode(["status"=>"0", "msg"=>"password_mismatch"]);
       }
       else{
        if($check_lead_exist === true){
          $update_lead = $this->update_with_one_param('leads','email', $email,'classification','prospect');
        }
        $enc_password = md5($password);
       $sql = "INSERT INTO $table SET `referral_id`='admin',`unique_id` = '$unique_id',`other_names` = '$other_names',`surname` = '$surname',  `phone` = '$phone', `password` = '$enc_password', `email` = '$email', `gender` = '$gender',`date_created` = now()";
          $query = mysqli_query($this->connection, $sql);
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
        }
  }
}


function insert_affiliate($table, $user_id, $other_names, $surname, $password, $confirm_password, $phone , $email, $param, $unique_id,$affiliate_status){
   
    $other_names = $this->secure_database($other_names);
    $user_id = $this->secure_database($user_id);

    $surname = $this->secure_database($surname);
    $password = $this->secure_database($password);
    $phone = $this->secure_database($phone);
    $email = $this->secure_database($email);
    $affiliate_status = $this->secure_database($affiliate_status);


    $check = $this->check_row_exists_by_one_param($table,'user_id',$user_id);

   // $check2 = $this->check_row_exists_by_one_param('users_tbl','unique_id',$user_id);
  
  if($other_names == "" || $surname == "" || $user_id == "" || $password == "" || $phone == "" || $confirm_password == "" || $email == "" ){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true  ){  
    // || $check2 == true
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{
       if ($password != $confirm_password){
        return json_encode(["status"=>"0", "msg"=>"password_mismatch"]);
       }
       else{
        $enc_password = md5($password);
       $sql = "INSERT INTO $table SET `user_id`='$user_id',`unique_id` = '$unique_id',`other_names` = '$other_names',`surname` = '$surname',  `phone` = '$phone', `password` = '$enc_password',`email` = '$email',`affilliate_level` = '$affiliate_status',`access_level`=1,`date_created` = now()";
          $query = mysqli_query($this->connection, $sql);
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
        }
  }
}

function insert_audio($table,$title,$imageurl,$adminid,$param,$validate_value){
  $title = $this->secure_database($title);
  $imageurl = $this->secure_database($imageurl);
  $adminid = $this->secure_database($adminid);
  $table = $this->secure_database($table);
  $param = $this->secure_database($param);
  $validate_value = $this->secure_database($validate_value);
 

 $check = $this->check_row_exists_by_one_param($table,$param,$validate_value);
  
  if($title == "" || $imageurl == "" || $adminid == "" || $table == "" || $param == "" || $validate_value == "" ){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{

       $sql = "INSERT INTO `audio_tbl` SET `title` = '$title',`imageurl` = '$imageurl',  `adminid` = '$adminid',`dateadded` = now()";
          $query = mysqli_query($this->connection, $sql);
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
  }
}

///update function
function update_data($table, $data,$conditional_param,$conditional_value){
  
  $conditional_value = $this->secure_database($conditional_value);

  if( is_array($data) && !empty($data) ){
   $sql = "UPDATE `$table` SET ";
      for($i = 0; $i < count($data); $i++){
          $each_data = $data[$i];
          if($i ==  (count($data) - 1)  ){
            $sql .= " $data[$i] = '$_POST[$each_data]' ";
          }else{
            $sql .= " $data[$i] = '$_POST[$each_data]' ,";
          }

      }

      $sql .= "WHERE `$conditional_param` = '$conditional_value'";
  
    $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
    if($query){
       return json_encode(["status"=>"1", "msg"=>"success"]);
    }else{
      return json_encode(["status"=>"0", "msg"=>"db_error"]);
    }
  }
  else{
    return json_encode(["status"=>"0", "msg"=>"error"]);
  }
}
////end update data   
         
function get_rows_from_one_table($table){
        
        $table = $this->secure_database($table);
        // if($this->secure_database($order_param) != "" ){
        //   $sql = "SELECT * FROM `$table` ORDER BY `$order_param` ASC ";
        // }
        // else{
          $sql = "SELECT * FROM `$table` ORDER BY `date_created` DESC";
        //}
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_rows_from_one_table_with_limit($table,$order_option,$limit_value){
        
        $table = $this->secure_database($table);
        $order_option = $this->secure_database($order_option);
        $limit_value = $this->secure_database($limit_value);
        // if($this->secure_database($order_param) != "" ){
        //   $sql = "SELECT * FROM `$table` ORDER BY `$order_param` ASC ";
        // }
        // else{
          $sql = "SELECT * FROM $table ORDER BY $order_option DESC LIMIT $limit_value";
        //}
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}




function get_rows_from_one_table_by_id($table,$theid,$idvalue){
        $table = $this->secure_database($table);
        $theid = $this->secure_database($theid);
        $idvalue = $this->secure_database($idvalue);
        $sql = "SELECT * FROM `$table` WHERE `$theid`='$idvalue'";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_rows_from_one_table_by_two_params($table,$param1,$value1,$param2,$value2){
        $table = $this->secure_database($table);
        $param1 = $this->secure_database($param1);
        $value1 = $this->secure_database($value1);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
        $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' AND `$param2`='$value2' ORDER BY date_created DESC ";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_all_pending_withrawals(){
     
        $sql = "SELECT * FROM `debit_wallet_tbl` WHERE (`purpose`=2 OR `purpose`=5) ORDER BY date_created DESC ";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_my_pending_withrawals($investor_id){
        $investor_id = $this->secure_database($investor_id);
        $sql = "SELECT * FROM `debit_wallet_tbl` WHERE (`purpose`=2 OR `purpose`=5) AND `user_id` = '$investor_id' ORDER BY date_created DESC ";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}


function get_rows_from_one_table_by_three_params($table,$param1,$value1,$param2,$value2,$param3,$value3){
        $table = $this->secure_database($table);
        $param1 = $this->secure_database($param1);
        $value1 = $this->secure_database($value1);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
        $param3 = $this->secure_database($param3);
        $value3 = $this->secure_database($value3);
        $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' AND `$param2`='$value2' AND `$param3`='$value3' ORDER BY date_created DESC ";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}



function get_data_within_a_range($table,$param,$datefrom,$dateto){
        $table = $this->secure_database($table);
        $param = $this->secure_database($param);
        $datefrom = $this->secure_database($datefrom);
        $dateto = $this->secure_database($dateto);
        $sql = "SELECT * FROM `$table` WHERE `$param` >= '$datefrom' AND `$param` <= '$dateto' ORDER BY date_created DESC ";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_rows_for_non_workers($table,$param1,$param2,$value2){
        $table = $this->secure_database($table);
        $param1 = $this->secure_database($param1);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
        $sql = "SELECT * FROM `$table` WHERE `$param1` IS NULL AND `$param2`='$value2' ORDER BY date_created DESC ";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_rows_from_one_table_by_one_param($table,$param1,$value1){
        $table = $this->secure_database($table);
        $param1 = $this->secure_database($param1);
        $value1 = $this->secure_database($value1);
        $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' ORDER BY date_created DESC";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}


function get_rows_from_one_table_group_by($table,$group_by){
        $table = $this->secure_database($table);
        $group_by = $this->secure_database($group_by);
        $sql = "SELECT * FROM `$table` GROUP BY `$group_by` ASC ";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
      
         if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }

      else{
             return null;
          }


}

function get_number_of_rows($table){
        $table = $this->secure_database($table);
        $sql= "SELECT id FROM `$table`";
        $query = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($query);
        return $count;  
}

function get_number_of_rows_one_param($table,$param,$value){
        $table = $this->secure_database($table);
        $param = $this->secure_database($param);
        $value = $this->secure_database($value);
        $sql= "SELECT id FROM `$table` WHERE `$param`='$value'";
        $query = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($query);
        return $count;   
}


function get_number_of_rows_two_params($table,$param1,$value1,$param2,$value2){
        $table = $this->secure_database($table);
        $param1 = $this->secure_database($param1);
        $value1 = $this->secure_database($value1);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
        $sql= "SELECT id FROM `$table` WHERE `$param1`='$value1' AND `$param2`='$value2'";
        $query = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($query);
      return $count;     
}


function get_number_of_rows_for_non_workers($table,$param1,$param2,$value2){
        $table = $this->secure_database($table);
        $param1 = $this->secure_database($param1);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
        $sql= "SELECT id FROM `$table` WHERE `$param1` IS NULL AND `$param2`='$value2'";
        $query = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($query);
      return $count;     
}


function get_one_row_from_one_table($table,$param,$value){
        $table = $this->secure_database($table);
        $param = $this->secure_database($param);
        $value = $this->secure_database($value);
        $sql = "SELECT * FROM `$table` WHERE `$param` = '$value'";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            $row = mysqli_fetch_array($query);
            return $row;
          }
          else{
             return null;
          }
}

function get_one_row_from_one_table_by_two_params($table,$param,$value,$param2,$value2){
        $table = $this->secure_database($table);
        $param = $this->secure_database($param);
        $value = $this->secure_database($value);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
        $sql = "SELECT * FROM `$table` WHERE `$param` = '$value' AND `$param2` = '$value2'";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            $row = mysqli_fetch_array($query);
            return $row;
          }
          else{
             return null;
          }
}

function get_one_row_from_one_table_by_three_params($table,$param,$value,$param2,$value2,$param3,$value3){
        $table = $this->secure_database($table);
        $param = $this->secure_database($param);
        $value = $this->secure_database($value);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
         $param3 = $this->secure_database($param3);
        $value3 = $this->secure_database($value3);
        $sql = "SELECT * FROM `$table` WHERE `$param` = '$value' AND `$param2` = '$value2' AND `$param3` = '$value3'";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            $row = mysqli_fetch_array($query);
            return $row;
          }
          else{
             return null;
          }
}


////delete a row
function delete_a_row($table,$param,$value){
    $value = $this->secure_database($value);
    $sql = "DELETE FROM `$table` WHERE `$param` = '$value' ";
    $res = mysqli_query($this->connection, $sql);
    if($res){
      return true;
    }else{
      return false;
    }
  } 

///end delete a row


//get current admin info
function get_current_user_info($table,$uid){
        $uid = $this->secure_database($uid);
        $table = $this->secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE unique_id = '$uid'";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
        if($num > 0 ){
            $row = mysqli_fetch_assoc($query);
                return $row;
        }else{
            return null;
        }
}

function get_current_aff_info($table,$uid){
        $uid = $this->secure_database($uid);
        $table = $this->secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE user_id = '$uid'";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
        if($num > 0 ){
            $row = mysqli_fetch_assoc($query);
                return $row;
        }else{
            return null;
        }
}
 ///end get current admin info



function check_password_match($password,$cpassword){
    $password = $this->secure_database($password);
    $cpassword = $this->secure_database($cpassword);
      if($password == $cpassword){
          return 1;
      }else{
         return 0;
      }
}

function check_user_login($email_or_phone,$password){
        $email_or_phone = $this->secure_database($email_or_phone);
        $password = $this->secure_database($password);
        $enc_password = md5($password);
        $sql = "SELECT * FROM users_tbl WHERE (email = '$email_or_phone' OR phone ='$email_or_phone') AND password = '$enc_password' AND access_level = 1";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
        if($num > 0 ){
            $row = mysqli_fetch_array($query);
            return $row;
        }else{
            return null;
        }
}

function check_admin_login($email,$password){
        $email = $this->secure_database($email);
        $password = $this->secure_database($password);
        $enc_password = md5($password);
        $sql = "SELECT * FROM admin_tbl WHERE email = '$email' AND password = '$enc_password' AND access_level=1";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
        if($num > 0 ){
            $row = mysqli_fetch_array($query);
            return $row;
        }else{
            return null;
        }
}

function check_aff_login($email,$password){
        $email = $this->secure_database($email);
        $password = $this->secure_database($password);
        $enc_password = md5($password);
        $sql = "SELECT * FROM affilliate_tbl WHERE email = '$email' AND password = '$enc_password' AND access_level=1";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
        if($num > 0 ){
            $row = mysqli_fetch_array($query);
            return $row;
        }else{
            return null;
        }
}

function check_aff_login_for_switch($email,$password){
        $email = $this->secure_database($email);
        $password = $this->$password;
        
        $sql = "SELECT * FROM affilliate_tbl WHERE email = '$email' AND password = '$password' AND access_level=1";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
        if($num > 0 ){
            $row = mysqli_fetch_array($query);
            return $row;
        }else{
            return null;
        }
}

function update_access_level($table,$email){
  $email = $this->secure_database($email);
  $sql = "UPDATE `$table` SET `access_level` = 0 WHERE `email` = '$email'";
  $query = mysqli_query($this->connection, $sql);
  if($query){
    return json_encode(["status"=>"1", "msg"=>"success"]);
  }
  else{
    return json_encode(["status"=>"0", "msg"=>"error"]);
  }

}

function activate_user($user_id){
  $user_id = $this->secure_database($user_id);
  $sql = "UPDATE `users_tbl` SET `access_level` = 1 WHERE `unique_id` = '$user_id'";
  $query = mysqli_query($this->connection, $sql);
  $check_if_wallet_exist = $this->check_row_exists_by_one_param('wallet_tbl','user_id',$user_id);
if($check_if_wallet_exist === false){
         $data = rand().$user_id;
         $unique_id = $this->unique_id_generator($data);
         $insert_wallet_sql = "INSERT INTO `wallet_tbl` SET `unique_id` = '$unique_id',`balance` = 0, `user_id`='$user_id', `date_created` = now()";
         $insert_wallet_query = mysqli_query($this->connection,$insert_wallet_sql);
        if($query && $insert_wallet_query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
        }
        else{
          return json_encode(["status"=>"0", "msg"=>"error"]);
        }
      }

}

function user_activation_link_mail($unique_id, $email){
  $actual_link = "https://$_SERVER[HTTP_HOST]"."/activate_user.php?id=".$unique_id;
  $toEmail = $email;
  $subject = "User Registration Activation Email";
  $content = "Click <a href='".$actual_link."'> here </a> to activate your account or copy the link below and paste it on your browser<br> 
  <a href='".$actual_link."'>".$actual_link. "</a>";
  $mailHeaders = "From: FarmKonnect <admin@farmkonnectng.com>"."\r\n";
  $mailHeaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  mail($toEmail, $subject, $content, $mailHeaders);
}

function user_reset_password_link($unique_id, $email){
  $actual_link = "https://$_SERVER[HTTP_HOST]"."/reset_password.php?id=".$unique_id;
  $toEmail = $email;
  $subject = "User Password reset link";
  $content = "Click <a href='".$actual_link."'> here </a> to reset your password or copy the link below and paste it on your browser<br> 
  <a href='".$actual_link."'>".$actual_link. "</a>";
  $mailHeaders = "From: FarmKonnect <admin@farmkonnectng.com>"."\r\n";
  $mailHeaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  mail($toEmail, $subject, $content, $mailHeaders);
}

////Tosin's functions

function reset_password($table, $unique_id, $password, $confirm_password){
  $table = $this->secure_database($table);
  //$unique_id = $this->secure_database($unique_id);
  $password = $this->secure_database($password);
  $confirm_password = $this->secure_database($confirm_password);
  if($unique_id == "" || $password == "" || $confirm_password == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else{
      if ($password != $confirm_password){
        return json_encode(["status"=>"0", "msg"=>"Passwords Doens't Match"]);
      }
      else{
      $enc_password = md5($password);
      $sql = "UPDATE `$table` SET access_level = 1, password = '$enc_password' WHERE unique_id = '$unique_id'";
      $query = mysqli_query($this->connection, $sql);
      if($query){
        return json_encode(["status"=>"1", "msg"=>"success"]);
      }
      else{
        return json_encode(["status"=>"0", "msg"=>"error"]);
  }
 
}
}
}


function image_upload($filename, $size, $tmpName, $type){


  //$currentDir = getcwd();
  //$dir =  dirname(__DIR__);
  
  //$uploadPath = $dir.'/uploads';
  //$uploadPath = "https://".$_SERVER['HTTP_HOST']."/uploads";
  $uploadPath= "uploads/".$filename;
  //$uploadPath = "https://$_SERVER[HTTP_HOST]"."/uploads/".$filename;
  $fileExtensions = ['jpeg','jpg','png', 'pdf','xlsx','csv','docx','doc'];
  $fileExtension = substr($filename, strpos($filename, '.') + 1);

  @$fileExtension = strtolower(end(explode('.',$filename)));
 // $uploadPath = $currentDir . $file_path . basename($filename);
  if (!in_array($fileExtension,$fileExtensions)) {
   return json_encode(["status"=>"0", "msg"=>"This file extension is not allowed. Please upload a JPEG or PNG file"]);
  }
  else{
     if ($size > 2000000) {
      return json_encode(["status"=>"0", "msg"=>"File size is more than 2MB"]);
    }
    else{
      $didUpload = move_uploaded_file($tmpName, $uploadPath);
      if ($didUpload) {
        return json_encode(["status"=>"1", "msg"=>$uploadPath]);
      }
      else{
        return json_encode(["status"=>"0", "msg"=>"Server Error"]);
      }
    }
  }
}


function image_upload2($filename, $size, $tmpName, $type){


  //$currentDir = getcwd();
  //$dir =  dirname(__DIR__);
  
  //$uploadPath = $dir.'/uploads';
  //$uploadPath = "https://".$_SERVER['HTTP_HOST']."/uploads";
  $uploadPath= "../uploads/".$filename;
  //$uploadPath = "https://$_SERVER[HTTP_HOST]"."/uploads/".$filename;
  $fileExtensions = ['jpeg','jpg','png', 'pdf','xlsx','csv','docx','doc'];
  $fileExtension = substr($filename, strpos($filename, '.') + 1);

  @$fileExtension = strtolower(end(explode('.',$filename)));
 // $uploadPath = $currentDir . $file_path . basename($filename);
  if (!in_array($fileExtension,$fileExtensions)) {
   return json_encode(["status"=>"0", "msg"=>"This file extension is not allowed. Please upload a JPEG or PNG file"]);
  }
  else{
     if ($size > 2000000) {
      return json_encode(["status"=>"0", "msg"=>"File size is more than 2MB"]);
    }
    else{
      $didUpload = move_uploaded_file($tmpName, $uploadPath);
      if ($didUpload) {
        return json_encode(["status"=>"1", "msg"=>$uploadPath]);
      }
      else{
        return json_encode(["status"=>"0", "msg"=>"Server Error"]);
      }
    }
  }
}


function insert_package_category_OLD($table, $name, $description,$created_by, $filename, $size, $tmpName, $type){
    
    $table = $this->secure_database($table);
    $name = $this->secure_database($name);
    $created_by = $this->secure_database($created_by);
    $data = $filename.$size;

    $filename = $this->secure_database($filename);
    $unique_id = $this->unique_id_generator($data);
    $image_url = $this->image_upload($filename, $size, $tmpName, $type);
    $description = $this->secure_database($description);
    $check = $this->check_row_exists_by_one_param($table,'name',$name);
  
  if($table == "" || $name == "" || $unique_id == "" || $image_url == "" || $description == "" || $created_by == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{
        $imageurl_decode = json_decode($image_url,true);
        if($imageurl_decode['status'] == '1'){
              $imageurl2 = $imageurl_decode['msg'];
              $sql = "INSERT INTO $table SET `name` = '$name',`unique_id` = '$unique_id',`image_url` = '$imageurl2',  `description` = '$description',`created_by`='$created_by', `date_created` = now()";
              $query = mysqli_query($this->connection, $sql) ;
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        }
        else{

            return json_encode(["status"=>"0", "msg"=>$imageurl_decode['msg'] ]);

        }


      
  }
}




function insert_package_category($name, $description,$created_by){
    
    $name = $this->secure_database($name);
    $created_by = $this->secure_database($created_by);
    $data = $name.$created_by;
    $unique_id = $this->unique_id_generator($data);
    $description = $this->secure_database($description);
    $check = $this->check_row_exists_by_one_param('package_category','name',$name);
    $imageurl2 = "uploads/basal_daily.jpg";
  
  if($name == "" || $unique_id == "" || $description == "" || $created_by == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{
       
              $sql = "INSERT INTO `package_category` SET `name` = '$name',`unique_id` = '$unique_id',`image_url` = '$imageurl2',  `description` = '$description',`created_by`='$created_by', `date_created` = now()";
              $query = mysqli_query($this->connection, $sql) ;
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        }
       


      

}


function check_row_exists_by_one_param_edit($table,$param,$value){
  $table = $this->secure_database($table);
  $param = $this->secure_database($param);
  $value = $this->secure_database($value);
  $sql = "SELECT * FROM `$table` WHERE `$param` = '$value'";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
  if($num === 1 ){
    return true;
  }else{
    return false;
  }
}


function update_package_category($name, $description, $unique_id){
    $name = $this->secure_database($name);
    $description = $this->secure_database($description);
    $unique_id = $this->secure_database($unique_id);
    $imageurl2 = "uploads/basal_daily.jpg";

    //$check = $this->check_row_exists_by_one_param('package_category','name',$name);
  
  if($name == "" || $description == "" || $unique_id == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  
//  else if($check == true){
//     return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
//   }
  
  else{
       $sql = "UPDATE `package_category` SET `name` = '$name',`description` = '$description' WHERE `unique_id` ='$unique_id' ";
          $query = mysqli_query($this->connection, $sql);
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
  }
}






//////////////below contains some redundant functions

function insert_package($package_name,$withdrawable_month, $package_description, $package_category_id, $slot, $amount_per_slot, $interest_rate, $package_category, $no_of_month, $max_no_of_month, $created_by, $filename, $size, $tmpName, $type){
    $package_name = $this->secure_database($package_name);
    $package_description = $this->secure_database($package_description);
    $package_category_id = $this->secure_database($package_category_id);
    $slot = $this->secure_database($slot);
    $amount_per_slot = $this->secure_database($amount_per_slot);
    $interest_rate = $this->secure_database($interest_rate);
    $package_category = $this->secure_database($package_category);
    $no_of_month = $this->secure_database($no_of_month);
    $max_no_of_month = $this->secure_database($max_no_of_month);
    $withdrawable_month = $this->secure_database($withdrawable_month);
    $created_by = $this->secure_database($created_by);
    $filename = $this->secure_database($filename);
    $data = $filename.$size.$package_name;
    $table = 'package_tbl';
    $unique_id = $this->unique_id_generator($data);
    $image_url = $this->image_upload($filename, $size, $tmpName, $type);
    $check = $this->check_row_exists_by_one_param($table,'unique_id',$unique_id);
  
  if($slot == "" || $package_name == "" || $withdrawable_month == ""  || $unique_id == "" || $image_url == "" || $package_description == "" || $created_by == "" || $amount_per_slot == "" || $interest_rate == "" || $package_category == "" || $no_of_month == "" || $max_no_of_month == "" ){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
  else if($no_of_month > $max_no_of_month){
    return  json_encode(["status"=>"0", "msg"=>"no_of_month_less_than_min"]);
  }
  else if($withdrawable_month < $no_of_month ||  $withdrawable_month > $max_no_of_month){
    return  json_encode(["status"=>"0", "msg"=>"no_of_month_less_than_min2"]);
 }
  else{
        $imageurl_decode = json_decode($image_url,true);
        if($imageurl_decode['status'] == '1'){
              $imageurl2 = $imageurl_decode['msg'];
              $sql = "INSERT INTO `package_tbl` SET `package_name` = '$package_name',`unique_id` = '$unique_id',`image_url` = '$imageurl2',  `package_description` = '$package_description', `package_category_id` = '$package_category_id', `slot` = '$slot', `fixed_amount` = '$amount_per_slot', `package_category` = '$package_category', `interest_rate` = '$interest_rate', `no_of_month` = '$no_of_month', `max_no_of_months` = '$max_no_of_month',`withdrawable_month`='$withdrawable_month', `created_by`='$created_by', `date_created` = now()";
              $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        }else{
                return json_encode(["status"=>"0", "msg"=>$imageurl_decode['msg'] ]);
        }


      
  }
}


function update_package($package_name, $package_description, $unique_id, $slot, $amount_per_slot, $interest_rate, $no_of_month, $max_no_of_months, $visibility){
    $package_name = $this->secure_database($package_name);
    $package_description = $this->secure_database($package_description);
    $unique_id = $this->secure_database($unique_id);
    $slot = $this->secure_database($slot);
    $amount_per_slot = $this->secure_database($amount_per_slot);
    $interest_rate = $this->secure_database($interest_rate);
    $no_of_month = $this->secure_database($no_of_month);
    $max_no_of_months = $this->secure_database($max_no_of_months);
    $visibility = $this->secure_database($visibility);
  if($package_name == "" || $package_description == "" || $unique_id == "" || $slot == "" || $amount_per_slot == "" || $interest_rate == "" || $no_of_month == "" || $max_no_of_months == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
 else{
       $sql = "UPDATE `package_tbl` SET `package_name` = '$package_name',`package_description` = '$package_description', `slot` = '$slot', `fixed_amount` = '$amount_per_slot', `interest_rate` = '$interest_rate', `no_of_month` = '$no_of_month', `max_no_of_months` = '$max_no_of_months', `visibility` = '$visibility' WHERE `unique_id` ='$unique_id' ";
          $query = mysqli_query($this->connection, $sql);
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
  }
}


//sam
function  update_package_slot($package_id,$slot_input){
    $package_id = $this->secure_database($package_id);
    $slot_input = $this->secure_database($slot_input);

        $get_current_slot = $this->get_one_row_from_one_table('package_tbl','unique_id',$package_id);
        if($get_current_slot == null){
            return json_encode(["status"=>"0", "msg"=>"error_occured" ]);
        }else{
            $newslot = $get_current_slot['slot'] + $slot_input;
            $sql = "UPDATE `package_definition` SET `no_of_slots` = '$newslot' WHERE `unique_id` ='$package_id' ";
            $query = mysqli_query($this->connection, $sql);
            if($query){
              return json_encode(["status"=>"1", "msg"=>"success_update"]);
            }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);

            }
        }
   }
//sam

function add_slot($package_id, $no_of_slots, $created_by){
  $package_id = $this->secure_database($package_id);
  $no_of_slots = $this->secure_database($no_of_slots);
  $data = $no_of_slots.$package_id;
  $unique_id = $this->unique_id_generator($data);

  if($unique_id == "" || $package_id == "" || $no_of_slots == "" || $created_by == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else{
      $sql = "INSERT INTO `package_slot` SET `unique_id` = '$unique_id', `no_of_slots` = '$no_of_slots',`package_id` = '$package_id' ,`created_by`='$created_by', `date_created` = now()";
      $query = mysqli_query($this->connection, $sql);

      $update_package_slot = $this->update_package_slot($package_id,$no_of_slots);
      $slot_decode = json_decode($update_package_slot,true);

       if(  ($query) &&  ($slot_decode['status'] == 1)    ){
         return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
    


    }

}
////end of Tosin's functions


// Fucntions by Abraham

//  function subscribe_to_a_package($table,$wallet_tbl,$param,$package_id,$user_id,$unique_id,$unique_id_for_package,$slot,$duration){
//         $table = $this->secure_database($table);
//         $package_id = $this->secure_database($package_id);
//         $user_id = $this->secure_database($user_id);
//         $unique_id = $this->secure_database($unique_id);
//         $slot = $this->secure_database($slot);
//         $duration = $this->secure_database($duration);

//         //return $table.$package_id.$user_id.$unique_id.$slot.$duration;
    
//         if($slot == "" || $duration == "" ){
//           return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
//         }
//         else{
//              $row_package = $this->get_rows_from_one_table_by_id($table,$unique_id,$package_id);
//              $row_wallet = $this->get_rows_from_one_table_by_id($wallet_tbl,$param,$user_id);
//              $db_slot =  $row_package['slot'];
//              $db_package_amount = $row_package['fixed_amount'];
//              $no_of_month = $row_package['no_of_month'];
//              $max_no_of_months = $row_package['max_no_of_months'];
//              $user_wallet = $row_wallet['balance'];
//              // Checking if slots is enough
//                 if($slot <= $db_slot){
//                   //echo "Success slots";
//                   // Checking if DUration fall in the right range
//                   if($duration >= $no_of_month && $duration <= $max_no_of_months ){
//                   //  echo "Success duration";
//                     $net_pay_for_slot = $db_package_amount * $slot;
//                     // Checking if the user has enough money to buy
//                     if($net_pay_for_slot <= $user_wallet){
//                     //  echo "Good to buy";
//                       // Defining the new sb slot
//                       $new_slot = $db_slot - $slot;
//                       $new_user_wallet = $user_wallet - $net_pay_for_slot;
//                       // Inserting into the user subscribed table
//                        $sql = "INSERT INTO  subscribed_user_tbl SET `unique_id` = '$unique_id_for_package',`user_id` = '$user_id',`package_id` = '$package_id',`date_created` = now()";
//                           $query = mysqli_query($this->connection, $sql);
//                           if($query){
//                               // Updating the Slots column in the package table
//                               $sql_update = "UPDATE package_tbl SET `slot` = '$new_slot' WHERE `$unique_id` = '$package_id'";                     
//                                $query_update = mysqli_query($this->connection, $sql_update);
//                                   if($query_update){
//                                     // Updating the User Wallet balance column in the package table
//                               $sql_update_wallet = "UPDATE wallet_tbl SET `balance` = '$new_user_wallet' WHERE user_id = '$user_id'";                     
//                                $query_update_wallet = mysqli_query($this->connection, $sql_update_wallet);
//                                   if($query_update_wallet){
//                                   return json_encode(["status"=>"1", "msg"=>"success3"]);
//                                   }else{
//                                   return json_encode(["status"=>"0", "msg"=>"db_error"]);
//                                   }
//                                     // End of Slots Update  
//                                   }else{
//                                   return json_encode(["status"=>"0", "msg"=>"db_error"]);
//                                   }
//                        // End of Slots Update   
//                           }else{
//                           return json_encode(["status"=>"0", "msg"=>"db_error"]);
//                           }
//                       // End of inserting to USer Subscribed table

//                     }else{
//                     //  echo "no good to buy";
//                     }
//                    // echo $user_wallet;
//                    //echo $db_package_amount;
//                   }else{
//                     echo "Invalid duration";
//                   }
//                 }else{
//                   echo "No enough slots ";
//                 }
//               };             
// } 
// End of subscribe function






///sams fxns starts here
function checkslot($slot_entered,$package_id){
      $slot_entered = $this->secure_database($slot_entered);
      $package_id = $this->secure_database($package_id);

        $sql = "SELECT * FROM `package_definition` WHERE `unique_id` = '$package_id'";
        $query = mysqli_query($this->connection, $sql);
        
        if($query){
            $row = mysqli_fetch_array($query);
            $db_slot = $row['slot'];
            if($db_slot < $slot_entered){
            return json_encode(["status"=>"0", "msg"=>"slot_less"]);
            }else{
            return json_encode(["status"=>"1", "msg"=>"success"]);
            }
        }
        else{
                  return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
    }


function check_wallet_balance($user_package_amount,$user_id){
      $user_package_amount = $this->secure_database($user_package_amount);
      $user_id = $this->secure_database($user_id);

        $sql = "SELECT * FROM wallet_tbl WHERE user_id = '$user_id'";
        $query = mysqli_query($this->connection, $sql);
        
        if($query){
            $row = mysqli_fetch_array($query);
            $db_balance = $row['balance'];
            if($db_balance < $user_package_amount){
            return json_encode(["status"=>"0", "msg"=>'balance_less']);
            }else{
            return json_encode(["status"=>"1", "msg"=>"success"]);
            }
        }
        else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
    

}

function check_admin_wallet_balance($amount,$admin_id){
      $amount = $this->secure_database($amount);
      $admin_id = $this->secure_database($admin_id);

        $sql = "SELECT * FROM accountant_wallet_tbl WHERE admin_id = '$admin_id'";
        $query = mysqli_query($this->connection, $sql);
        
        if($query){
            $row = mysqli_fetch_array($query);
            $db_balance = $row['balance'];
            if($db_balance < $amount){
            return json_encode(["status"=>"0", "msg"=>'balance_less']);
            }else{
            return json_encode(["status"=>"1", "msg"=>"success"]);
            }
        }
        else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
    

}


function check_no_of_months($package_id,$user_no_of_months){
      $package_id = $this->secure_database($package_id);
      $user_no_of_months = $this->secure_database($user_no_of_months);


        $sql = "SELECT * FROM package_tbl WHERE unique_id = '$package_id'";
        $query = mysqli_query($this->connection, $sql);
        
        if($query){
            $row = mysqli_fetch_array($query);
            $db_max = $row['max_no_of_months'];
            $db_min = $row['no_of_month'];
            if($db_min <= $user_no_of_months  && $db_max >= $user_no_of_months ){
            return json_encode(["status"=>"0", "msg"=>"success"]);
            }else{
            return json_encode(["status"=>"1", "msg"=>"less_or_more"]);
            }
        }
        else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
    

}


function update_with_one_param($table,$param,$value,$new_value_param,$new_value){
      $table = $this->secure_database($table);
      $value = $this->secure_database($value);
      $param = $this->secure_database($param);
      $new_value_param = $this->secure_database($new_value_param);
      $new_value = $this->secure_database($new_value);

        $sql = "UPDATE `$table` SET `$new_value_param`='$new_value' WHERE `$param` = '$value'";
        $query = mysqli_query($this->connection, $sql)or die(mysqli_error($this->connection));
        
        if($query){
            return json_encode(["status"=>"1", "msg"=>"success"]);
            
        }
        else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }


}


function update_with_two_params($table,$param,$value,$new_value_param1,$new_value1, $new_value_param2,$new_value2){
      $table = $this->secure_database($table);
      $value = $this->secure_database($value);
      $param = $this->secure_database($param);
      $new_value_param1 = $this->secure_database($new_value_param1);
      $new_value1 = $this->secure_database($new_value1);
      $new_value_param2 = $this->secure_database($new_value_param2);
      $new_value2 = $this->secure_database($new_value2);

        $sql = "UPDATE `$table` SET `$new_value_param1`='$new_value1' AND `$new_value_param2`='$new_value2' WHERE `$param` = '$value'";
        $query = mysqli_query($this->connection, $sql)or die(mysqli_error($this->connection));
        
        if($query){
            return json_encode(["status"=>"1", "msg"=>"success"]);
            
        }
        else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }


}



function get_wallet_balance($user_id){
      $user_id = $this->secure_database($user_id);
      $sql = "SELECT * FROM `wallet_tbl` WHERE `user_id` = '$user_id'";
      $query = mysqli_query($this->connection, $sql);
        
        if($query){
          $row = mysqli_fetch_array($query);
          $balance = $row['balance'];
            return json_encode(["status"=>"1", "msg"=>$balance]);
         }
        else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
}

function get_admin_wallet_balance($admin_id){
      $admin_id = $this->secure_database($admin_id);
      $sql = "SELECT * FROM `accountant_wallet_tbl` WHERE `admin_id` = '$admin_id'";
      $query = mysqli_query($this->connection, $sql);
        
        if($query){
          $row = mysqli_fetch_array($query);
          $balance = $row['balance'];
            return json_encode(["status"=>"1", "msg"=>$balance]);
         }
        else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
}

function get_slot_balance($package_id){
      $package_id = $this->secure_database($package_id);
      $sql = "SELECT * FROM `package_definition` WHERE `unique_id` = '$package_id'";
      $query = mysqli_query($this->connection, $sql);
        
        if($query){
          $row = mysqli_fetch_array($query);
          $slot = $row['no_of_slots'];
            return json_encode(["status"=>"1", "msg"=>$slot]);
         }
        else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
}



// 1 - subscribe to a package_id 
//2 - profit withrawal to wallet on pending------this will hardly run, infact it shouldnt run
// 3 - profit withrawal to wallet on rejected------this will hardly run, infact it shouldnt run
// 4 - profit withrawal to wallet on complete 
// 5 - wallet withrawal to bank account on pending
// 6 - wallet withrawal to bank account on declined 
// 7 - wallet withrawal to bank account on processed --processed means it has reached clients bank account
// 8 - wallet withrawal to bank account on cancelled---cancelled by client 
// 9 - wallet withrawal to bank account on approved---considered as legitimate 
//10 -  crediting --- bankacct to wallet pending  
//11 -  crediting --- bankacct to wallet confirmed
//12 -  crediting --- bankacct to wallet not_confirmed
//13 -  SENDER wallet to wallet transfer ---  pending
//14 -   SENDER wallet to wallet transfer --- not_confirmed
//15 -  SENDER wallet to wallet transfer --- confirmed
//16 -  RECEIVER wallet to wallet transfer ---  pending
//17 -   RECEIVER wallet to wallet transfer --- not_confirmed
//18 -  RECEIVER wallet to wallet transfer --- confirmed



function insert_subscription_to_a_package($user_id,$package_amount,$package_id){
  $user_id = $this->secure_database($user_id);
  $package_amount = $this->secure_database($package_amount);
  $package_id = $this->secure_database($package_id);
  $purpose = 1;
  $data = $user_id.$package_id;
  $unique_id = $this->unique_id_generator($data);

      if($package_amount == "" || $user_id == "" || $package_id == ""  ){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  } else{
          $sql = "INSERT INTO `debit_wallet_tbl` SET `unique_id` = '$unique_id',`user_id` = '$user_id',  `amount_withdrawn` = '$package_amount',`purpose`='$purpose',`package_id`='$package_id',`withdrawal_status`='1',`date_created` = now()";
          $query = mysqli_query($this->connection, $sql);
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
  

  }

     
}

///when you subscrib to a package:::
// 1. check slots availability
// 2. check wallet balance
// 3. ensure terms and conditions is checked
// 4. ensure all fields are fields
// 5. populate package_subscribe
// 6. update wallet tbl with new balance
// 7. update package tbl with new slot
// 8. check to ensure months is not greater than max no of months, min too

function subscribe_to_a_package($user_id,$package_id,$slot,$months,$package_amount){
      $user_id = $this->secure_database($user_id);
      $package_id = $this->secure_database($package_id);
      $slot = $this->secure_database($slot);
      $months = $this->secure_database($months);
      $package_amount = $this->secure_database($package_amount);
      $data = $slot.$months.$user_id;
      $unique_id = $this->unique_id_generator($data);

      $checkslot = $this->checkslot($slot,$package_id);
      $checkslot_decode = json_decode($checkslot,true);
      
      $check_no_of_months = $this->check_no_of_months($package_id,$months);
      $check_no_of_months_decode = json_decode($check_no_of_months,true);

      $check_wallet_balance = $this->check_wallet_balance($package_amount,$user_id);
      $check_wallet_balance_decode = json_decode($check_wallet_balance,true);

      //$check_exist = $this->check_row_exists_by_two_params('subscribed_user_tbl','user_id',$user_id,'package_id',$package_id);

      //if($check_exist === true){
      //    return json_encode(["status"=>"0", "msg"=>"exists"]);

     //   }else
       if($checkslot_decode['msg'] == "slot_less" ){
          return json_encode(["status"=>"0", "msg"=>"slot_less"]);
      }
      else if($check_wallet_balance_decode['msg'] == "balance_less" ){
          return json_encode(["status"=>"0", "msg"=>"balance_less"]);
      }
      else if($check_no_of_months_decode['msg'] == "less_or_more" ){
          return json_encode(["status"=>"0", "msg"=>"less_or_more"]);
      }
      else {

          $get_wallet_balance = $this->get_wallet_balance($user_id);
          $get_wallet_balance_decode = json_decode($get_wallet_balance,true);


          $get_slot_balance = $this->get_slot_balance($package_id);
          $get_slot_balance_decode = json_decode($get_slot_balance,true);
          
          if($get_slot_balance_decode['status'] === 0){
            return  json_encode(["status"=>"0", "msg"=>"getting_slot_balance_error"]);
          }

         $new_balance = $get_wallet_balance_decode['msg'] - $package_amount;
         $new_slot = $get_slot_balance_decode['msg'] - $slot;
         

          ////update wallet balance
          $update_wallet_balance = $this->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_balance);

          ///update package slot
          $update_package_slot = $this->update_with_one_param('package_tbl','unique_id',$package_id,'slot',$new_slot);

           ///update package slot
          $update_investment_status = $this->update_with_one_param('users_tbl','unique_id',$user_id,'investment_status',1);

          ////debit history
          $insert_debit_wallet_tbl = $this->insert_subscription_to_a_package($user_id,$package_amount,$package_id);
          $insert_debit_wallet_tbl_decode = json_decode($insert_debit_wallet_tbl,true);
          if($insert_debit_wallet_tbl_decode['status'] == 0){
            return json_encode(["status"=>"0", "msg"=>"insert_debit_wallet_tbl_error"]);
          }

          ///insert into subscribe to package
           $insert_subscribed_user_sql = "INSERT INTO  subscribed_user_tbl SET 
           `unique_id` = '$unique_id',
           `user_id` = '$user_id',
           `package_id` = '$package_id',
           `slot` = '$slot',
           `duration` = '$months',
           `amount_paid` = '$package_amount',
           `liquidation_status`='0',
           `date_created` = now()";
           $query_insert = mysqli_query($this->connection, $insert_subscribed_user_sql);
           if($query_insert){
            return  json_encode(["status"=>"1", "msg"=>"successful insertion"]);
            }else{
            return  json_encode(["status"=>"0", "msg"=>"db_error"]);
            }

        }
}


///thsi is for profits::: for an investor
function total_withdrawn($investor_id){
    $investor_id = $this->secure_database($investor_id);
     $sql = "SELECT SUM(amount_withdrawn) as `amount` FROM `debit_wallet_tbl` WHERE `user_id`='$investor_id' AND (`purpose` = 4) ";
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $sum = $row['amount'];
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}

function total_withdrawn_all($investor_id){
    $investor_id = $this->secure_database($investor_id);
     $sql = "SELECT SUM(amount_withdrawn) as `amount` FROM `debit_wallet_tbl` WHERE `user_id`='$investor_id' AND (`purpose` = 4 OR `purpose`=7) ";
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $sum = $row['amount'];
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}

function total_wallet_withdrawn($investor_id){
    $investor_id = $this->secure_database($investor_id);
     $sql = "SELECT SUM(amount_withdrawn) as `amount` FROM `debit_wallet_tbl` WHERE `user_id`='$investor_id' AND `purpose` = 7";
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $sum = $row['amount'];
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}

function total_withdrawn_per_package($investor_id,$package_id){
    $investor_id = $this->secure_database($investor_id);
    $package_id = $this->secure_database($package_id);
    $sql = "SELECT SUM(amount_withdrawn) as `amount` FROM `debit_wallet_tbl` WHERE `user_id`='$investor_id' AND `package_id`='$package_id' AND `purpose` = 4";
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $sum = $row['amount'];
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}

//my_pending_wallet_withdrawn

function my_pending_wallet_withdrawn($investor_id){
    $investor_id = $this->secure_database($investor_id);
     $sql = "SELECT SUM(amount_withdrawn) as `amount` FROM `debit_wallet_tbl` WHERE `user_id`='$investor_id' AND (`purpose` = 5 )";   
     // OR `purpose`=5
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $sum = $row['amount'];
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}

function my_pending_profit_withdrawn($investor_id){
    $investor_id = $this->secure_database($investor_id);
     $sql = "SELECT SUM(amount_withdrawn) as `amount` FROM `debit_wallet_tbl` WHERE `user_id`='$investor_id' AND (`purpose` =2 )";   
     // OR `purpose`=5
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $sum = $row['amount'];
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}

function my_total_pending_withdrawn($investor_id){
    $investor_id = $this->secure_database($investor_id);
    
     $sql = "SELECT SUM(amount_withdrawn) as `amount` FROM `debit_wallet_tbl` WHERE user_id = '$investor_id' AND  (`purpose` =2 OR `purpose`=5)";
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $sum = $row['amount'];
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}

function total_pending_withdrawn(){
    
     $sql = "SELECT SUM(amount_withdrawn) as `amount` FROM `debit_wallet_tbl` WHERE (`purpose` =2 OR `purpose`=5)";
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $sum = $row['amount'];
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}


function total_completed_withdrawn(){
    
     $sql = "SELECT SUM(amount_withdrawn) as `amount` FROM `debit_wallet_tbl` WHERE (`purpose` =4 OR `purpose`=7)";
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $sum = $row['amount'];
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}

function count_complete_withdrawn(){
    
     $sql = "SELECT id FROM `debit_wallet_tbl` WHERE (`purpose` = 4 OR `purpose`=7)";
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($num)]);    
}

function count_pending_withdrawn(){
    
     $sql = "SELECT id FROM `debit_wallet_tbl` WHERE (`purpose` =2 OR `purpose`=5)";
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($num)]);    
}

function total_pending_withdrawn_per_package($investor_id,$package_id){
    $investor_id = $this->secure_database($investor_id);
    $package_id = $this->secure_database($package_id);
    $sql = "SELECT SUM(amount_withdrawn) as `amount` FROM `debit_wallet_tbl` WHERE `user_id`='$investor_id' AND `package_id`='$package_id' AND `purpose` = 2";
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $sum = $row['amount'];
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}


function get_profits_per_package($package_id,$investor_id){
    $package_id = $this->secure_database($package_id);
    $investor_id = $this->secure_database($investor_id);

    //loop through all user's investment
     $sql = "SELECT * FROM `subscribed_user_tbl` WHERE `user_id`='$investor_id' AND `package_id`='$package_id'";
      $query = mysqli_query($this->connection,$sql);
       $row = mysqli_fetch_array($query);
      $current_date = date('d-m-Y');
      $added_profit = 0;
      $total_added_profit = 0;
      $total_withdrawable_profit = 0;
      $withdrawable_profit = 0;
      $each_month_count = 0; 
     
      $package_id = $row['package_id'];
      $investment_date = $row['date_created'];
        $investment_amt = $row['amount_paid'];
        $duration = $row['duration'];


        $getpackage = $this->get_one_row_from_one_table('package_tbl','unique_id',$row['package_id']);
        $withdrawable_month = $getpackage['withdrawable_month'];
        $interest = intval($getpackage['interest_rate']);
        $invested_amount_plus_interest = $investment_amt + ($investment_amt * ($interest/100));
        $total_roi = $investment_amt * ($interest/100);
        $interest_amount_per_month = intval(($total_roi)/$duration);
        $invested_amount_per_month = $invested_amount_plus_interest / $duration; 
        
        

        // for($i = 1; $i <= $row['duration']; $i++){
        //     $next_month_loop =  date('d-m-Y', strtotime('+'.$i.' month', strtotime($row['date_created'])));
        //     //echo $next_month_loop.'<br>';

        //     if( strtotime($next_month_loop) > strtotime($current_date) ){
        //                 $status = '<small class="btn btn-default btn-sm">pending</small>';
                        
        //                 if($each_month_count % $withdrawable_month == 0){
        //                    $withdrawable_profit = $interest_amount_per_month * $each_month_count;
        //                 }else{
        //                     $new_each_month_count = $each_month_count - ($each_month_count % $withdrawable_month);
        //                     $withdrawable_profit = $interest_amount_per_month * $new_each_month_count;
        //                   }

        //           }else{
        //                 $status = '<small class="btn btn-success btn-sm">added</small>';
        //                 $added_profit = $added_profit + $interest_amount_per_month;
                        
                        
        //                 $each_month_count++;

        //           }


        //      }

          //reset month count for next loop
          //$each_month_count = 0;


          for($i = 1; $i <= $row['duration']; $i++){ 
                  $next_month_loop  = date('d-m-Y', strtotime('+'.$i.' month', strtotime($row['date_created'])));


                 $added_profit = $added_profit + $interest_amount_per_month;
                 
                 if( strtotime($next_month_loop) < strtotime($current_date) ){
                      if(   (number_format((strtotime($next_month_loop) - strtotime($row['date_created']))/(60*60*24*30),0))   % $getpackage['withdrawable_month'] == 0 ) { 
                      $withdrawable_profit = ($interest_amount_per_month*$getpackage['withdrawable_month']) + $withdrawable_profit;
                       }
                    // $status = '<small class="badge badge-success badge-sm">added</small>';

                  } else{
                   
                    //$status = '<small class="badge badge-default badge-sm">pending</small>';

                  }

          //reset month count for next loop
          //$each_month_count= 0;
         
            }
         

    //here check if withdrawals have been done
    $withdrawal_amount = $this->total_withdrawn_per_package($investor_id,$package_id);
    $withdrawal_amount_decode = json_decode($withdrawal_amount,true);
    $amount_withdrawn = $withdrawal_amount_decode['msg'];

     $pending_withdrawal_amount = $this->total_pending_withdrawn_per_package($investor_id,$package_id);
    $pending_withdrawal_amount_decode = json_decode($pending_withdrawal_amount,true);
    $amount_pending_withdrawn = $pending_withdrawal_amount_decode['msg'];

    $actual_balance = $withdrawable_profit - $amount_withdrawn - $amount_pending_withdrawn;



    return  json_encode(["status"=>"1","actual_withdrawable_profit"=>intval($actual_balance) ,"total_profit"=>intval($added_profit),"withdrawable_profit"=> intval($withdrawable_profit) ]);

 
}

////profits balance for Investments of a user::: dont be decieved by the naming convention
function get_profits1($investor_id){
    //get total investment
    //$total_investment = $this->get_total_investment($investor_id);
    //$total_investment_decode = json_decode($total_investment,true);
     //return  json_encode(["status"=>"1", "msg"=>intval($total_investment_decode['msg']  )]);

    //loop through all user's investment
     $sql = "SELECT *  FROM `subscribed_user_tbl` WHERE `user_id`='$investor_id'";
     $query = mysqli_query($this->connection,$sql);
     $current_date = date('d-m-Y');
      $added_profit = 0;
      $total_added_profit = 0;
      $total_withdrawable_profit = 0;
      $withdrawable_profit = 0;
      $each_month_count = 0; 
     while($row = mysqli_fetch_array($query)){
        $package_id = $row['package_id'];
        $investment_date = $row['date_created'];
        $investment_amt = $row['amount_paid'];
        $duration = $row['duration'];


        $getpackage = $this->get_one_row_from_one_table('package_tbl','unique_id',$row['package_id']);
        $withdrawable_month = $getpackage['withdrawable_month'];
        $interest = intval($getpackage['interest_rate']);
        $invested_amount_plus_interest = $investment_amt + ($investment_amt * ($interest/100));
        $total_roi = $investment_amt * ($interest/100);
        $interest_amount_per_month = ($total_roi)/$duration;
        $invested_amount_per_month = $invested_amount_plus_interest / $duration; 
        
        

        // for($i = 1; $i <= $row['duration']; $i++){
        //     $next_month_loop =  date('d-m-Y', strtotime('+'.$i.' month', strtotime($row['date_created'])));
        //     //echo $next_month_loop.'<br>';

        //     if( strtotime($next_month_loop) < strtotime($current_date) ){
        //                 $status = '<small class="btn btn-default btn-sm">pending</small>';
                        
        //                 if($each_month_count % $withdrawable_month == 0){
        //                    $withdrawable_profit = $interest_amount_per_month * $each_month_count;
        //                 }else{
        //                     $new_each_month_count = $each_month_count - ($each_month_count % $withdrawable_month);
        //                     $withdrawable_profit = $interest_amount_per_month * $new_each_month_count;
        //                   }

        //           }else{
        //                 $status = '<small class="btn btn-success btn-sm">added</small>';
        //                 $added_profit = $added_profit + $interest_amount_per_month;
                        
                        
        //                 $each_month_count++;

        //           }


        //      }

        for($i = 1; $i <= $row['duration']; $i++){ 
                  $next_month_loop  = date('d-m-Y', strtotime('+'.$i.' month', strtotime($row['date_created'])));


                 $added_profit = $added_profit + $interest_amount_per_month;
                 
                 if( strtotime($next_month_loop) < strtotime($current_date) ){
                      if(   (number_format((strtotime($next_month_loop) - strtotime($row['date_created']))/(60*60*24*30),0))   % $getpackage['withdrawable_month'] == 0 ) { 
                      $withdrawable_profit = ($interest_amount_per_month*$getpackage['withdrawable_month']) + $withdrawable_profit;
                       }
                    // $status = '<small class="badge badge-success badge-sm">added</small>';

                  } else{
                   
                    //$status = '<small class="badge badge-default badge-sm">pending</small>';

                  }

          //reset month count for next loop
          //$each_month_count = 0;
         
            }
        
        }

   //here check if withdrawals have been done
    $withdrawal_amount = $this->total_withdrawn($investor_id);
    $withdrawal_amount_decode = json_decode($withdrawal_amount,true);
    $amount_withdrawn = $withdrawal_amount_decode['msg'];

    //   $pending_withdrawal_amount = $this->my_pending_profit_withdrawn($investor_id);
    // $pending_withdrawal_amount_decode = json_decode($pending_withdrawal_amount,true);
    // $amount_pending_withdrawn = $pending_withdrawal_amount_decode['msg']; --- this shouldnt run annymore

    $actual_balance = $withdrawable_profit - $amount_withdrawn;
    return  json_encode(["status"=>"1","actual_withdrawable_profit"=>intval($actual_balance) ,"total_profit"=>intval($added_profit),"withdrawable_profit"=> intval($withdrawable_profit) ]);
}


////profits balance for Investments of a user::: dont be decieved by the naming convention
function get_profits2($investor_id){
    //get total investment
    //$total_investment = $this->get_total_investment($investor_id);
    //$total_investment_decode = json_decode($total_investment,true);
     //return  json_encode(["status"=>"1", "msg"=>intval($total_investment_decode['msg']  )]);

    //loop through all user's investment
     $sql = "SELECT *  FROM `subscribed_user_tbl` WHERE `user_id`='$investor_id'";
     $query = mysqli_query($this->connection,$sql);
     $current_date = date('d-m-Y');
      $added_profit = 0;
      $total_added_profit = 0;
      $total_withdrawable_profit = 0;
      $withdrawable_profit = 0;
      $each_month_count = 0; 

     while($row = mysqli_fetch_array($query)){
        $package_id = $row['package_id'];
        $investment_date = $row['date_created'];
        $investment_amt = $row['amount_paid'];
        $duration = $row['duration'];


        $getpackage = $this->get_one_row_from_one_table('package_tbl','unique_id',$row['package_id']);
        $withdrawable_month = $getpackage['withdrawable_month'];
        $interest = intval($getpackage['interest_rate']);
        $invested_amount_plus_interest = $investment_amt + ($investment_amt * ($interest/100));
        $total_roi = $investment_amt * ($interest/100);
        $interest_amount_per_month = ($total_roi)/$duration;
        $invested_amount_per_month = $invested_amount_plus_interest / $duration; 
        
        

        for($i = 1; $i <= $row['duration']; $i++){
            $next_month_loop =  date('d-m-Y', strtotime('+'.$i.' month', strtotime($row['date_created'])));
            //echo $next_month_loop.'<br>';

            if( strtotime($next_month_loop) > strtotime($current_date) ){
                        $status = '<small class="btn btn-default btn-sm">pending</small>';
                        
                        if($each_month_count % $withdrawable_month == 0){
                           $withdrawable_profit = $interest_amount_per_month * $each_month_count;
                        }else{
                            $new_each_month_count = $each_month_count - ($each_month_count % $withdrawable_month);
                            $withdrawable_profit = $interest_amount_per_month * $new_each_month_count;
                          }

                  }else{
                        $status = '<small class="btn btn-success btn-sm">added</small>';
                        $added_profit = $added_profit + $interest_amount_per_month;
                        
                        
                        $each_month_count++;

                  }


             }

          //reset month count for next loop
          $each_month_count = 0;
         
     }
  


       //here check if withdrawals have been done
    $withdrawal_amount = $this->total_withdrawn($investor_id);
    $withdrawal_amount_decode = json_decode($withdrawal_amount,true);
    $amount_withdrawn = $withdrawal_amount_decode['msg'];

      $pending_withdrawal_amount = $this->my_pending_wallet_withdrawn($investor_id);
    $pending_withdrawal_amount_decode = json_decode($pending_withdrawal_amount,true);
    $amount_pending_withdrawn = $pending_withdrawal_amount_decode['msg'];



    $actual_balance = $withdrawable_profit - $amount_withdrawn - $amount_pending_withdrawn;
    return  json_encode(["status"=>"1","actual_withdrawable_profit"=>intval($actual_balance) ,"total_profit"=>intval($added_profit),"withdrawable_profit"=> intval($withdrawable_profit) ]);
}


function insert_withdrawal_request($package_id,$investor_id,$amount_withdrawn,$profit_balance){
        $package_id = $this->secure_database($package_id);
        $investor_id = $this->secure_database($investor_id);
        $profit_balance = $this->secure_database($profit_balance);
        $data = $package_id.$investor_id.$profit_balance;
        $unique_id = $this->unique_id_generator($data);

        $sql = "INSERT INTO `debit_wallet_tbl` SET `unique_id` = '$unique_id',`amount_withdrawn` = '$amount_withdrawn',`user_id` = '$investor_id',  `purpose` = 2 , `package_id` = '$package_id',`withdrawal_status` = 1 ,`date_created` = now()";
        $query = mysqli_query($this->connection, $sql);
        if($query){
            return  json_encode(["status"=>1, "msg"=>"success"]);
        }else{
            return  json_encode(["status"=>0, "msg"=>"db_error"]);
        }

}


function insert_earnings_to_wallet($investor_id,$total_earnings){
        $investor_id = $this->secure_database($investor_id);
        $total_earnings = $this->secure_database($total_earnings);
        $data = $investor_id.$total_earnings;
        $unique_id = $this->unique_id_generator($data);

        ///get current wallet balance of user::::
        $get_wallet_balance = $this->get_wallet_balance($investor_id);
        $get_wallet_balance_decode = json_decode($get_wallet_balance,true);

        if($get_wallet_balance_decode['status'] ==  '0'){
            return  json_encode(["status"=>0, "msg"=>"wallet_balance_error"]);

        }else{

            $wallet_balance = $get_wallet_balance_decode['msg'];
            $new_balance = $wallet_balance + $total_earnings;
            ////update wallet balance

            ////update wallet balance
          $update_wallet_balance = $this->update_with_one_param('wallet_tbl','user_id',$investor_id,'balance',$new_balance);

          if($update_wallet_balance){
            //return json_encode(["status"=>"1", "msg"=>"success"]);
             $sql = "INSERT INTO `debit_wallet_tbl` SET `unique_id` = '$unique_id',`amount_withdrawn` = '$total_earnings',`user_id` = '$investor_id',  `purpose` = 4, `package_id` = 'earnings_to_wallet',`withdrawal_status` = 1 ,`date_created` = now()";
            $query = mysqli_query($this->connection, $sql);
            if($query){
            return  json_encode(["status"=>1, "msg"=>"success"]);
            }else{
            return  json_encode(["status"=>0, "msg"=>"db_error"]);
            }

          }
          else{
            return json_encode(["status"=>"0", "msg"=>"update_wallet_balance_error"]);
          }

      }

}

function insert_wallet_withdrawal_request($investor_id,$amount_withdrawn,$wallet_balance){
        $investor_id = $this->secure_database($investor_id);
        $amount_withdrawn = $this->secure_database($amount_withdrawn);
        $wallet_balance = $this->secure_database($wallet_balance);
        $new_balance = $wallet_balance - $amount_withdrawn;
        $data = $investor_id.$wallet_balance;
        $unique_id = $this->unique_id_generator($data);
        $get_wallet_status = $this->get_one_row_from_one_table('wallet_tbl', 'user_id', $user_id);
        $wallet_status = $get_wallet_status['wallet_status'];


  if($investor_id == "" || $amount_withdrawn == "" || $wallet_balance == "" ){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else if($wallet_status == 0){
                return json_encode(["status"=>"0", "msg"=>"wallet_deactivated"]);
          }
  
  else{

           $sql = "INSERT INTO `debit_wallet_tbl` SET `unique_id` = '$unique_id',`amount_withdrawn` = '$amount_withdrawn',`user_id` = '$investor_id',  `purpose` = 5 , `package_id` = 'from_wallet',`withdrawal_status` = 1 ,`date_created` = now()";
        // $sqlupdate = "UPDATE  `wallet_tbl` SET `balance` = '$new_balance' WHERE `user_id` = '$investor_id'";
        // $queryupdate = mysqli_query($this->connection,$sqlupdate);
        $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
       
        if($query){
            return  json_encode(["status"=>1, "msg"=>"success"]);
        }else{
            return  json_encode(["status"=>0, "msg"=>"db_error"]);
        }


  }

   

}

function get_total_investment($investor_id){
    $investor_id = $this->secure_database($investor_id);
     $sql = "SELECT SUM(total_amount) as `sum` FROM `subscribed_packages` WHERE `user_id`='$investor_id'";
     $query = mysqli_query($this->connection, $sql);
     $row = mysqli_fetch_array($query);
     $sum = $row['sum'];
     $num = mysqli_num_rows($query);
     return  json_encode(["status"=>"1", "msg"=>intval($sum)]);
}


function create_lead($first_name, $surname, $phone,$email,$created_by){
    $first_name = $this->secure_database($first_name);
    $surname = $this->secure_database($surname);
    $phone = $this->secure_database($phone);
    $email = $this->secure_database($email);
    $created_by = $this->secure_database($created_by);
    $data = $phone.$email.$created_by;
    $unique_id = $this->unique_id_generator($data);

    $check = $this->check_row_exists_by_one_param('leads_tbl','email',$email);

    $check2 = $this->check_row_exists_by_one_param('users_tbl','email',$email);
  
  if($first_name == "" || $surname == "" || $phone == "" || $email == "" || $created_by == "" ){
    return json_encode(["status"=>0, "msg"=>"empty_fields"]);
  }else if($check == true){
     return json_encode(["status"=>0, "msg"=>"record_exists"]);
  }
  else if($check2 == true){
     return json_encode(["status"=>0, "msg"=>"already_a_user"]);
  }
  else{
         $sql = "INSERT INTO `leads_tbl` SET `unique_id` = '$unique_id',`first_name` = '$first_name',`surname` = '$surname',  `phone` = '$phone' , `email` = '$email',`created_by` = '$created_by',`date_created` = now()";
        
        $query = mysqli_query($this->connection, $sql);

         if($query){
            return  json_encode(["status"=>1, "msg"=>"success"]);
        }else{
            return  json_encode(["status"=>0, "msg"=>"db_error"]);
        }

  }
    

}


///sams fxns ends here



///////TOSIN'S CODES STARTS

///THIS IS A REPEATED FXN--- CHECK THIS FUNCTION====>get_rows_from_one_table_by_id
function get_rows_from_table_by_user_id($table,$param1,$value1){
        $table = $this->secure_database($table);
        $param1 = $this->secure_database($param1);
        $value1 = $this->secure_database($value1);
        $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' ORDER BY date_created DESC";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

//check transfer pin
function check_transfer_pin($transfer_pin, $user_id){
        $transfer_pin = $this->secure_database($transfer_pin);
        $sql = "SELECT * FROM wallet_tbl WHERE `user_id` = '$user_id'";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            $row = mysqli_fetch_array($query);
            if($transfer_pin == $row['transfer_pin']){
              return true;
            }else{
              return false;
            }
          }
      }



function transfer_to_wallet($user_id, $amount, $beneficiary_id, $beneficiary_email, $transfer_pin, $verification_status){
    $user_id = $this->secure_database($user_id);
    $amount = $this->secure_database($amount);
    $beneficiary_id = $this->secure_database($beneficiary_id);
    $beneficiary_email = $this->secure_database($beneficiary_email);
    $transfer_pin = $this->secure_database($transfer_pin);

    $get_wallet_balance = $this->get_wallet_balance($user_id);
    $get_wallet_balance_decode = json_decode($get_wallet_balance,true);
    
    $get_wallet_status = $this->get_one_row_from_one_table('wallet_tbl', 'user_id', $user_id);
    $wallet_status = $get_wallet_status['wallet_status'];

     $get_beneficiary_balance = $this->get_wallet_balance($beneficiary_id);
       $get_beneficiary_balance_decode = json_decode($get_beneficiary_balance,true);

    

    $check_wallet_balance = $this->check_wallet_balance($amount,$user_id);
    $check_wallet_balance_decode = json_decode($check_wallet_balance,true);

    $check_if_beneficiary_wallet_exist = $this->check_row_exists_by_one_param('wallet_tbl','user_id',$beneficiary_id);
    $check_if_beneficiary_email_exist = $this->check_row_exists_by_one_param('users_tbl', 'unique_id',$beneficiary_id);

     $check_transfer_pin = $this->check_transfer_pin($transfer_pin, $user_id);


     if($user_id == '' || $amount == 0 || $beneficiary_email == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
          
    else if($wallet_status == 0){
    return json_encode(["status"=>"0", "msg"=>"wallet_deactivated"]);
    }

    
     else if($check_if_beneficiary_email_exist === false){
        return json_encode(["status"=>"0", "msg"=>"user_does_not_exist"]);
      }
      
       else if($check_wallet_balance_decode['msg'] == "balance_less" ){
          return json_encode(["status"=>"0", "msg"=>"balance_less"]);
        }


      else if ($check_transfer_pin === false) {
        return json_encode(["status"=>"0", "msg"=>"incorrect_transfer_pin"]);
      }

else{

      //  if($check_if_beneficiary_wallet_exist === false){
      //    $data = $beneficiary_id.$amount;
      //    $beneficiary_unique_id = $this->unique_id_generator($data);
      //    $insert_benef_into_wallet_sql = "INSERT INTO `wallet_tbl` SET `unique_id` = '$beneficiary_unique_id',`balance` = 0, `user_id`='$beneficiary_id'";
      //    $insert_benef_into_wallet_query = mysqli_query($this->connection,$insert_benef_into_wallet_sql);
      //    if($insert_benef_into_wallet_query === false){
      //       return  json_encode(["status"=>"0", "msg"=>"error_creating_benef_wallet"]);
      //    }
      // }
      
      //else{

            if ($verification_status == 0) {
              
              $data = $beneficiary_id.$amount;
            $beneficiary_unique_id = $this->unique_id_generator($data);
            $insert_into_transfer_log = "INSERT INTO `transfer_log` SET `unique_id` = '$beneficiary_unique_id', `sender_id`='$user_id',`transfer_status` = 0, `beneficiary_id`='$beneficiary_id', `amount_sent`='$amount', `date_created` = now()";
            $insert_into_transfer_log_query = mysqli_query($this->connection,$insert_into_transfer_log);


             ////debitwa
            $data = rand().$user_id;
            $unique_id = $this->unique_id_generator($data);
            $sql_insert_transaction_sender = "INSERT into debit_wallet_tbl set
                    `unique_id`='$unique_id',
                    `user_id`='$user_id',
                    `amount_withdrawn`='$amount',
                    `purpose`='15',
                    `package_id`='from_wallet_to_wallet',
                    `withdrawal_status`='1',
                    `processing_status`='0',
                    `date_created`=now()

                    ";
              $query_insert_transaction_sender = mysqli_query($this->connection,$sql_insert_transaction_sender);


               $sql_insert_transaction_receiver = "INSERT into debit_wallet_tbl set
                    `unique_id`='$unique_id',
                    `user_id`='$beneficiary_id',
                    `amount_withdrawn`='$amount',
                    `purpose`='18',
                    `package_id`='from_wallet_to_wallet',
                    `withdrawal_status`='1',
                    `processing_status`='0',
                    `date_created`=now()

                    ";
              $query_insert_transaction_receiver  = mysqli_query($this->connection,$sql_insert_transaction_receiver);


            if($insert_into_transfer_log_query === false  || $query_insert_transaction_sender === false || $query_insert_transaction_receiver === false){
            return  json_encode(["status"=>"0", "msg"=>"error_creating_transfer_log"]);
            }else{
              return json_encode(["status"=>"1", "msg"=>"success_creating_log"]);
            }

            }else if($verification_status == 1){
              
            $data = $beneficiary_id.$amount;
            $beneficiary_unique_id = $this->unique_id_generator($data);
            $insert_into_transfer_log = "INSERT INTO `transfer_log` SET `unique_id` = '$beneficiary_unique_id', `sender_id`='$user_id',`transfer_status` = 1, `processing_status`= 2, `beneficiary_id`='$beneficiary_id', `amount_sent`='$amount', `date_created` = now()";
            $insert_into_transfer_log_query = mysqli_query($this->connection,$insert_into_transfer_log);

              ////debitwa

            $data = rand().$beneficiary_id;
            $unique_id = $this->unique_id_generator($data);

            $sql_insert_transaction_sender = "INSERT into debit_wallet_tbl set
                    `unique_id`='$unique_id',
                    `user_id`='$user_id',
                    `amount_withdrawn`='$amount',
                    `purpose`='15',
                    `package_id`='from_wallet_to_wallet',
                    `withdrawal_status`='1',
                    `processing_status`='0',
                    `date_created`=now()

                    ";
              $query_insert_transaction_sender = mysqli_query($this->connection,$sql_insert_transaction_sender);


               $sql_insert_transaction_receiver = "INSERT into debit_wallet_tbl set
                    `unique_id`='$unique_id',
                    `user_id`='$beneficiary_id',
                    `amount_withdrawn`='$amount',
                    `purpose`='18',
                    `package_id`='from_wallet_to_wallet',
                    `withdrawal_status`='1',
                    `processing_status`='0',
                    `date_created`=now()

                    ";
              $query_insert_transaction_receiver  = mysqli_query($this->connection,$sql_insert_transaction_receiver);


            if($insert_into_transfer_log_query === false || $query_insert_transaction_sender === false || $query_insert_transaction_receiver === false){
            return  json_encode(["status"=>"0", "msg"=>"error_creating_transfer_log"]);
            }

           $new_balance = $get_wallet_balance_decode['msg'] - $amount;
           $new_beneficiary_balance = $get_beneficiary_balance_decode['msg'] + $amount;



          ////update wallet balance
          $update_wallet_balance = $this->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_balance);
          $update_beneficiary_balance = $this->update_with_one_param('wallet_tbl','user_id',$beneficiary_id,'balance',$new_beneficiary_balance);

          ////we need to log the transfer transaction 
          ///id of the sender, id of the beneficiary,


          if($update_wallet_balance && $update_beneficiary_balance){
            return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
            return json_encode(["status"=>"0", "msg"=>"error"]);
          }

        }
        else{
              return json_encode(["status"=>"0", "msg"=>"something_went_wrong"]);

        }
     // }
      }


}



// function transfer_to_wallet_old($user_id, $amount, $beneficiary_id, $beneficiary_email){
//     $user_id = $this->secure_database($user_id);
//     $amount = $this->secure_database($amount);
//     $beneficiary_id = $this->secure_database($beneficiary_id);
//     $beneficiary_email = $this->secure_database($beneficiary_email);

//     $get_wallet_balance = $this->get_wallet_balance($user_id);
//     $get_wallet_balance_decode = json_decode($get_wallet_balance,true);
    

//     $check_wallet_balance = $this->check_wallet_balance($amount,$user_id);
//     $check_wallet_balance_decode = json_decode($check_wallet_balance,true);

//     $check_if_beneficiary_wallet_exist = $this->check_row_exists_by_one_param('wallet_tbl','user_id',$beneficiary_id);

//      $check_if_beneficiary_email_exist = $this->check_row_exists_by_one_param('users_tbl', 'unique_id',$beneficiary_id);

//      if($user_id == '' || $amount == 0 || $beneficiary_email == ''){
//             return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
//           }

    
//      if($check_if_beneficiary_email_exist === false){
//         return json_encode(["status"=>"0", "msg"=>"user_does_not_exist"]);
//       }
      
//        if($check_wallet_balance_decode['msg'] == "balance_less" ){
//           return json_encode(["status"=>"0", "msg"=>"balance_less"]);
//         }

// else{

//        if($check_if_beneficiary_wallet_exist === false){
//          $data = $beneficiary_id.$amount;
//          $beneficiary_unique_id = $this->unique_id_generator($data);
//          $insert_benef_into_wallet_sql = "INSERT INTO `wallet_tbl` SET `unique_id` = '$beneficiary_unique_id',`balance` = 0, `user_id`='$beneficiary_id'";
//          $insert_benef_into_wallet_query = mysqli_query($this->connection,$insert_benef_into_wallet_sql);
//          if($insert_benef_into_wallet_query === false){
//             return  json_encode(["status"=>"0", "msg"=>"error_creating_benef_wallet"]);
//          }
//       }
      
//       else{
              
//             $data = $beneficiary_id.$amount;
//             $beneficiary_unique_id = $this->unique_id_generator($data);
            
//             $insert_into_transfer_log = "INSERT INTO `transfer_log` SET `unique_id` = '$beneficiary_unique_id', `sender_id`='$user_id',`transfer_status` = 0, `beneficiary_id`='$beneficiary_id', `amount_sent`='$amount', `date_created` = now()";
//             $insert_into_transfer_log_query = mysqli_query($this->connection,$insert_into_transfer_log);


//              $sql_insert_transaction_sender = "INSERT into debit_wallet_tbl set
//                     `unique_id`='$unique_id',
//                     `user_id`='$userid',
//                     `amount_withdrawn`='$amount',
//                     `purpose`='15',
//                     `package_id`='from_wallet_to_wallet',
//                     `withdrawal_status`='1',
//                     `processing_status`='0',
//                     `date_created`='$deposit_date2'

//                     ";
//               $query_insert_transaction_sender = mysqli_query($this->connection,$sql_insert_transaction_sender);


//                $sql_insert_transaction_receiver = "INSERT into debit_wallet_tbl set
//                     `unique_id`='$unique_id',
//                     `user_id`='$beneficiary_id',
//                     `amount_withdrawn`='$amount',
//                     `purpose`='18',
//                     `package_id`='from_wallet_to_wallet',
//                     `withdrawal_status`='1',
//                     `processing_status`='0',
//                     `date_created`='$deposit_date2'

//                     ";
//               $query_insert_transaction_receiver  = mysqli_query($this->connection,$sql_insert_transaction_receiver);



//             if($insert_into_transfer_log_query === false   || $query_insert_transaction_sender == false || $query_insert_transaction_receiver === false){
//             return  json_encode(["status"=>"0", "msg"=>"error_creating_transfer_log"]);
//             }else{
//             return json_encode(["status"=>"1", "msg"=>"success"]);

//             }

//         }
//       }


// }


  


function upload_document($table, $document_name, $created_by, $filename, $size, $tmpName, $type){
    $document_name = $this->secure_database($document_name);
    $created_by = $this->secure_database($created_by);
    $filename = $this->secure_database($filename);
    $data = $filename.$size;
    $table = $this->secure_database($table);
    $unique_id = $this->unique_id_generator($data);
    $image_url = $this->image_upload($filename, $size, $tmpName, $type);
    $check = $this->check_row_exists_by_one_param($table,'unique_id',$unique_id);
  
  if($unique_id == "" || $image_url == "" || $document_name == "" || $created_by == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{
        $imageurl_decode = json_decode($image_url,true);
        if($imageurl_decode['status'] == '1'){
              $imageurl2 = $imageurl_decode['msg'];
              $sql = "INSERT INTO `$table` SET `document_name` = '$document_name',`unique_id` = '$unique_id',`image_url` = '$imageurl2', `user_id`='$created_by', `date_created` = now()";
  
            $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        }


      
  }
}

function upload_document2($table, $document_name, $created_by, $filename, $size, $tmpName, $type){
    $document_name = $this->secure_database($document_name);
    $created_by = $this->secure_database($created_by);
    $filename = $this->secure_database($filename);
    $data = $filename.$size;
    $table = $this->secure_database($table);
    $unique_id = $this->unique_id_generator($data);
    $image_url = $this->image_upload2($filename, $size, $tmpName, $type);
    $check = $this->check_row_exists_by_one_param($table,'unique_id',$unique_id);
  
  if($unique_id == "" || $image_url == "" || $document_name == "" || $created_by == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{
        $imageurl_decode = json_decode($image_url,true);
        if($imageurl_decode['status'] == '1'){
              $imageurl2 = $imageurl_decode['msg'];
              $sql = "INSERT INTO `$table` SET `document_name` = '$document_name',`unique_id` = '$unique_id',`image_url` = '$imageurl2', `user_id`='$created_by', `date_created` = now()";
  
            $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        }


      
  }
}  


function insert_into_access_tbl($user_id){
  $user_id = $this->secure_database($user_id);
  $data = md5($user_id);
  $unique_id = $this->unique_id_generator($data);
  $check = $this->check_row_exists_by_one_param('access_card_tbl','user_id',$user_id);
  if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{
       $sql = "INSERT INTO `access_card_tbl` SET `unique_id` = '$unique_id',`user_id` = '$user_id', `date_created` = now()";
          $query = mysqli_query($this->connection, $sql);
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
}
}




///////tosin

function get_pending_withdrawal_from_wallet_and_profit(){
   $sql = "SELECT * FROM `debit_wallet_tbl` WHERE `purpose`= 2 || `purpose` = 5";
        $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }

}

function get_all_pending_withdrawal_from_wallet(){
   $sql = "SELECT * FROM `debit_wallet_tbl` WHERE `purpose` = 5";
        $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }

}


//23-01-2020
function approve_credit_wallet($user_id, $amount){
    $user_id = $this->secure_database($user_id);
    $amount = $this->secure_database($amount);
    $get_wallet_balance = $this->get_wallet_balance($user_id);
    $get_wallet_balance_decode = json_decode($get_wallet_balance,true);

    $check_if_wallet_exist = $this->check_row_exists_by_one_param('wallet_tbl','user_id',$user_id);

     if($user_id == '' || $amount == 0){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
    else if($check_if_wallet_exist === false){
         $data = $user_id.$amount;
         $unique_id = $this->unique_id_generator($data);
         $insert_into_wallet_sql = "INSERT INTO `wallet_tbl` SET `unique_id` = '$unique_id',`balance` = '$amount', `user_id`='$user_id'";
         $insert_into_wallet_query = mysqli_query($this->connection,$insert_into_wallet_sql) or die(mysqli_error($this->connection));
         if($insert_into_wallet_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         }
    }

else{
       if($get_wallet_balance_decode['status'] === 0){
            return  json_encode(["status"=>"0", "msg"=>"get_wallet_balance_error"]);
          }

      else{
         $new_balance = $get_wallet_balance_decode['msg'] + $amount;
          ////update wallet balance
          $update_wallet_balance = $this->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_balance);
          ///update credit wallet table
          if($update_wallet_balance){
            return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
            return json_encode(["status"=>"0", "msg"=>"error"]);
          }

      }
    }

}


/////18-02-2020
function insert_logs($admin_id, $description){
  $admin_id = $this->secure_database($admin_id);
  $description = $this->secure_database($description);
  $data = $admin_id.$description;
  $unique_id = $this->unique_id_generator($data);

  if($admin_id == '' || $description == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
  else{
    $insert_log_sql = "INSERT INTO `logs_tbl` SET `unique_id` = '$unique_id',`description` = '$description', `admin_id`='$admin_id', `date_created` = now()";
         $insert_log_query = mysqli_query($this->connection, $insert_log_sql) or die(mysqli_error($this->connection));
         if($insert_log_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}


//19-02-2020

function approve_pending_transfers($sender_id, $amount, $beneficiary_id){
  $sender_id = $this->secure_database($sender_id);
    $amount = $this->secure_database($amount);
    $beneficiary_id = $this->secure_database($beneficiary_id);
    $get_wallet_balance = $this->get_wallet_balance($sender_id);
    $get_wallet_balance_decode = json_decode($get_wallet_balance,true);
    $get_beneficiary_balance = $this->get_wallet_balance($beneficiary_id);
    $get_beneficiary_balance_decode = json_decode($get_beneficiary_balance,true);

    if($get_wallet_balance_decode['status'] === 0){
            return  json_encode(["status"=>"0", "msg"=>"get_wallet_balance_error"]);
          }
      else if($get_beneficiary_balance_decode['status'] === 0){
            return  json_encode(["status"=>"0", "msg"=>"get_balance_balance_error"]);
          }

      else{
         $new_balance = $get_wallet_balance_decode['msg'] - $amount;
         $new_beneficiary_balance = $get_beneficiary_balance_decode['msg'] + $amount;

          ////update wallet balance
          $update_wallet_balance = $this->update_with_one_param('wallet_tbl','user_id',$sender_id,'balance',$new_balance);
          $update_beneficiary_balance = $this->update_with_one_param('wallet_tbl','user_id',$beneficiary_id,'balance',$new_beneficiary_balance);

          if($update_wallet_balance){
            if($update_beneficiary_balance){
            return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
            return json_encode(["status"=>"0", "msg"=>"error"]);
          }
        }

      }

}



///03-03-2020

function add_role($role_name, $role_description, $function_id, $assigned_by, $page_ids){

    $role_name = $this->secure_database($role_name);
  $role_description = $this->secure_database($role_description);
    $assigned_by = $this->secure_database($assigned_by);
    $data1 = $role_name.$role_description;
    $unique_id1 = $this->unique_id_generator($data1);
    @$data2 = $role_name.$function_id;
    $unique_id2 = $this->unique_id_generator($data2);
    @$data3 = $role_name.$page_ids;
    $unique_id3 = $this->unique_id_generator($data3);
    $role_name = ucwords($role_name);
  

  if($role_name == "" || $role_description == "" || $assigned_by == "" || $function_id == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else{
      $sql = "INSERT INTO `admin_roles` SET `role_name` = '$role_name', `role_description` = '$role_description', `added_by` = '$assigned_by', `unique_id` = '$unique_id1', `date_created` = now()";
      $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
       if($query){
        $get_role_id = mysqli_query($this->connection, "SELECT * FROM `admin_roles` WHERE `role_name` = '$role_name'") or die(mysqli_error($this->connection));
        if($row = mysqli_fetch_array($get_role_id)){
            $role_id = $row['unique_id'];
        }
        $value = json_encode($function_id);
        $val = json_encode($page_ids);
        //foreach ($function_id as $value) {     
        $insert_function_sql = "INSERT INTO `function_role_rights` SET `role_id` = '$role_id', `function_id` = '$value',`assigned_by` = '$assigned_by', `unique_id` = '$unique_id2', `date_created` = now()";
      $insert_function = mysqli_query($this->connection, $insert_function_sql) or die(mysqli_error($this->connection));
    
    $insert_pages_sql = "INSERT INTO `page_role_rights` SET `role_id` = '$role_id', `page_id` = '$val',`assigned_by` = '$assigned_by', `unique_id` = '$unique_id3', `date_created` = now()";
      $insert_pages = mysqli_query($this->connection, $insert_pages_sql) or die(mysqli_error($this->connection));
        //}
              if($insert_function){
                if($insert_pages){
         return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
      }
    }

    }

}



function update_role($role_id, $function_id, $page_id){

    $role_id = $this->secure_database($role_id);

  if($role_id == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else{
    $value = json_encode($function_id);
        // foreach ($function_id as $value) {     
        $update_function_sql = "UPDATE function_role_rights SET `function_id` = '$value' WHERE `role_id` = '$role_id'";
      $update_function = mysqli_query($this->connection, $update_function_sql) or die(mysqli_error($this->connection));
       $val = json_encode($page_id);
        // foreach ($function_id as $value) {     
        $update_page_sql = "UPDATE page_role_rights SET `page_id` = '$val' WHERE `role_id` = '$role_id'";
      $update_page = mysqli_query($this->connection, $update_page_sql) or die(mysqli_error($this->connection));
        }
              if($update_function && $update_page){
         return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
      //}

}



function add_admin_to_role($other_names, $surname, $username, $password, $confirm_password, $phone , $email, $role_id, $address, $gender, $def=""){
   
    $other_names = $this->secure_database($other_names);
    $surname = $this->secure_database($surname);
    $password = $this->secure_database($password);
    $confirm_password = $this->secure_database($confirm_password);
    $address = $this->secure_database($address);
    $phone = $this->secure_database($phone);
    $email = $this->secure_database($email);
    $gender = $this->secure_database($gender);
    $data = $surname.$password.$email;

    if($def != ""){
      //call that id
      $unique_id = $def;
    }else{

    $unique_id = $this->unique_id_generator($data);

    }

    $check = $this->check_row_exists_by_one_param('admin_tbl','email', $email);
  
  if($other_names == "" || $surname == "" || $password == "" || $phone == "" || $confirm_password == "" || $email == "" || $role_id == "" || $address == "" || $username == "" || $gender == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{
       if ($password != $confirm_password){
        return json_encode(["status"=>"0", "msg"=>"password_mismatch"]);
       }
       else{
        $enc_password = md5($password);
       $sql = "INSERT INTO `admin_tbl` SET `surname`='$surname',`unique_id` = '$unique_id',`other_names` = '$other_names',`username` = '$username',  `phone` = '$phone', `gender` = '$gender', `password` = '$enc_password',`email` = '$email', `address` = '$address', `role_right` = '$role_id',`date_created` = now()";

          $get_role_name = $this->get_one_row_from_one_table('admin_roles','unique_id', $role_id);
        $role_name = $get_role_name['role_name'];
        if($role_name == 'Business Executive'){
        $insert_business_executive = $this->add_business_executive($unique_id);
        }
          $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
        }
  }
}


//05-03-2020

function add_leads($fullname, $phone, $added_by, $assigned_to, $email, $location, $other_location, $classification, $interest_level, $social_media){
   
    $fullname = $this->secure_database($fullname);
    $email = $this->secure_database($email);
    $location = $this->secure_database($location);
    $phone = $this->secure_database($phone);
    $other_location = $this->secure_database($other_location);
    $classification = $this->secure_database($classification);
    $interest_level = $this->secure_database($interest_level);
    $social_media = $this->secure_database($social_media);
    $assigned_to = $this->secure_database($assigned_to);
    $data = $email.$location;
    $unique_id = $this->unique_id_generator($data);

    $check = $this->check_row_exists_by_one_param('leads','email',$email);
    //$check2 = $this->check_row_exists_by_one_param('users_tbl','email',$email);
  
  if($fullname == "" || $email == "" || $phone == ""  || $location == "" || $classification == "" || $interest_level == "" || $added_by == "" ){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
  else{
       $sql = "INSERT INTO `leads` SET `fullname`='$fullname',`unique_id` = '$unique_id',`email` = '$email', `phone` = '$phone', `location` = '$location', `other_location` = '$other_location',  `classification` = '$classification', `interest_level` = '$interest_level', `social_media` = '$social_media', `assigned_to` = '$assigned_to',  `added_by` = '$added_by', `date_created` = now()";
          $query = mysqli_query($this->connection, $sql);
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
        }
}


//09-03-2020
function update_leads($fullname, $phone, $unique_id, $email, $location, $other_location, $classification, $interest_level){
   
    $fullname = $this->secure_database($fullname);
    $email = $this->secure_database($email);
    $location = $this->secure_database($location);
    $phone = $this->secure_database($phone);
    $other_location = $this->secure_database($other_location);
    $unique_id = $this->secure_database($unique_id);
    $classification = $this->secure_database($classification);
    $interest_level = $this->secure_database($interest_level);
    $data = $email.$location;
       $sql = "UPDATE `leads` SET `fullname`='$fullname',`unique_id` = '$unique_id',`email` = '$email', `phone` = '$phone', `location` = '$location', `other_location` = '$other_location',  `classification` = '$classification', `interest_level` = '$interest_level' WHERE `unique_id` = '$unique_id'";
          $query = mysqli_query($this->connection, $sql);
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
}


function get_clients($table, $param1, $value1, $param2, $value2, $param3, $value3){
        $table = $this->secure_database($table);
        $param1 = $this->secure_database($param1);
        $value1 = $this->secure_database($value1);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
        $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' AND (`$param2`='$value2' ||   `$param3` = '$value3') ORDER BY date_created DESC ";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
        if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}


//28-03-2020
function insert_terms_n_conditions($admin_id, $description, $conditions_for_what){
  $admin_id = $this->secure_database($admin_id);
  $description = $this->secure_database($description);
  $conditions_for_what = $this->secure_database($conditions_for_what);
  $data = $admin_id.$description;
  $unique_id = $this->unique_id_generator($data);
  $check = $this->check_row_exists_by_one_param('terms_n_conditions','conditions_for_what', $conditions_for_what);
  
  if($admin_id == '' || $description == '' || $conditions_for_what == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

  if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
  else{
    $insert_terms_conditions_sql = "INSERT INTO `terms_n_conditions` SET `unique_id` = '$unique_id',`description` = '$description', `added_by`='$admin_id', `conditions_for_what`='$conditions_for_what', `date_created` = now()";
         $insert_terms_conditions_query = mysqli_query($this->connection, $insert_terms_conditions_sql) or die(mysqli_error($this->connection));
         if($insert_terms_conditions_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}



function insert_bank_account($admin_id, $bank_name, $description, $account_number, $account_name, $account_type){
  $admin_id = $this->secure_database($admin_id);
  $bank_name = $this->secure_database($bank_name);
  $description = $this->secure_database($description);
  $account_number = $this->secure_database($account_number);
  $account_name = $this->secure_database($account_name);
  $account_type = $this->secure_database($account_type);
  $data = $bank_name.$account_name.$account_number;
  $unique_id = $this->unique_id_generator($data);
  $check = $this->check_row_exists_by_one_param('bank_accounts','account_number', $account_number);
  
  if($admin_id == '' || $bank_name == '' || $account_number == ''  || $account_name == '' || $account_type == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

  if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
  else{
    $insert_bank_account_sql = "INSERT INTO `bank_accounts` SET `unique_id` = '$unique_id',`bank_name` = '$bank_name', `description` = '$description', `added_by`='$admin_id', `account_number`='$account_number', `account_name`='$account_name', `account_type`='$account_type', `date_created` = now()";
         $insert_bank_account_query = mysqli_query($this->connection, $insert_bank_account_sql) or die(mysqli_error($this->connection));
         if($insert_bank_account_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}


function update_bank_account($unique_id, $bank_name, $description, $account_number, $account_name, $account_type){
  $bank_name = $this->secure_database($bank_name);
  $account_number = $this->secure_database($account_number);
  $account_name = $this->secure_database($account_name);
  $account_type = $this->secure_database($account_type);
  $check = $this->check_row_exists_by_one_param('bank_accounts','account_number', $account_number);
  
  if($bank_name == '' || $account_number == '' || $account_name == '' || $account_type == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
  else{
    $update_bank_account_sql = "UPDATE `bank_accounts` SET `bank_name` = '$bank_name', `description`='$description', `account_number`='$account_number', `account_name`='$account_name', `account_type`='$account_type' WHERE `unique_id` = '$unique_id'";
         $update_bank_account_query = mysqli_query($this->connection, $update_bank_account_sql) or die(mysqli_error($this->connection));
         if($update_bank_account_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}


//30-03-2020
function add_business_executive($unique_id){
    $check = $this->check_row_exists_by_one_param('business_executive_tbl','unique_id',$unique_id);
    if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
       else{
       $sql = "INSERT INTO `business_executive_tbl` SET `unique_id` = '$unique_id', `no_of_assigned_lead` = 0, `date_created` = now()";
          $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
        }
}

//31-03-2020
function roll_balance_over($BE_id){
  $get_balance =  $this->get_one_row_from_one_table('be_target','BE_id', $BE_id);
  $balance = $get_balance['balance'];
  $target_set = $get_balance['target_set'];
  $date_added = date($get_balance['date_created']);
  $today = date('Y-m-d');
  $split_date_created = explode('-', $date_added);
  $new_month = $split_date_created[1] + 1;
  $nextdate = $split_date_created[0].'-'.$new_month.'-'.$split_date_created[2];
  $nextdate = date('Y-m-d', strtotime($nextdate));
  $unique_id = $this->unique_id_generator($balance.$date_added);
  if($today == $nextdate){
  $new_target_set = $target_set + $balance;
  $present_month = $get_balance['month'] + 1;
    $update_target_sales = $this->update_with_one_param('be_target', 'BE_id', $BE_id,'target_set',$new_target_set);
    $update_month = $this->update_with_one_param('be_target', 'BE_id', $BE_id,'month',$present_month);
    $get_new_balance =  $this->get_one_row_from_one_table('be_target','BE_id', $BE_id);
    $new_balance = $get_new_balance['target_set'] - $get_new_balance['sales_made'];
    $update_balance = $this->update_with_one_param('be_target', 'BE_id', $BE_id,'balance',$new_balance);
            if($update_target_sales AND $update_month AND $update_balance){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
            } 
}



function be_register_sales($transaction, $amount, $product, $sales_date, $admin_id){
  $transaction = $this->secure_database($transaction);
  $amount = $this->secure_database($amount);
  $product = $this->secure_database($product);
  $sales_date = $this->secure_database($sales_date);
  $admin_id = $this->secure_database($admin_id);

  $data = $transaction.$amount.$product.$sales_date.$admin_id;
  $unique_id = $this->unique_id_generator($data);

  //$check = $this->check_row_exists_by_two_params('be_sales',$param,$value,$param2,$value2);
  
  if($transaction == '' || $amount == '' || $product == '' || $sales_date == '' || $admin_id == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

  // if($check === true){
  //   return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  // }
  else{
    $register_sales_sql = "INSERT INTO `be_sales` SET `unique_id` = '$unique_id',`transaction` = '$transaction', `added_by`='$admin_id', `amount`='$amount', `product`='$product', `sales_date`='$sales_date', `date_created` = now()";
         $register_sales_query = mysqli_query($this->connection, $register_sales_sql) or die(mysqli_error($this->connection));
         if($register_sales_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}


//01-04-2020

function get_complaint_BE($admin_id){
        $sql = "SELECT * FROM `leads` WHERE `added_by` = '$admin_id' ||   `assigned_to` = '$admin_id' ORDER BY date_created DESC ";
        $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
              $user_id = $row['unique_id'];
              $get_complaint_sql = "SELECT * FROM `contact_us_tbl` WHERE `user_id` = '$user_id' ORDER BY date_created DESC ";
              $get_complaint_query = mysqli_query($this->connection, $get_complaint_sql) or die(mysqli_error($this->connection));
              if($get_complaint_query){
              while ($get_complaint = mysqli_fetch_array($get_complaint_query)) {
                $row_display[]= $get_complaint;
                return $row_display;
              }
              
            }else{
              return null;
            }
        }

      }
}

function get_feedback_BE($admin_id){
        $sql = "SELECT * FROM `leads` WHERE `added_by` = '$admin_id' ||   `assigned_to` = '$admin_id' ORDER BY date_created DESC ";
        $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
              $user_id = $row['unique_id'];
              $get_feedback_sql = "SELECT * FROM `feedback_tbl` WHERE `user_id` = '$user_id' ORDER BY date_created DESC ";
              $get_feedback_query = mysqli_query($this->connection, $get_feedback_sql) or die(mysqli_error($this->connection));
              if($get_feedback_query){
              while ($get_feedback = mysqli_fetch_array($get_feedback_query)) {
                $row_display[]= $get_feedback;
                return $row_display;
              }
              
            }else{
              return null;
            }
        }

      }
}

function transfer_client_temporarily($BE_id, $client_id, $transfer_to, $time_frame){
  //$client_id = $this->secure_database($client_id);
  $transfer_to = $this->secure_database($transfer_to);
  $unique_id = $this->unique_id_generator($transfer_to.$time_frame);
  if($transfer_to == "" || empty($client_id) || $time_frame == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else{
  $count = count($client_id);
  for ($i=0; $i < $count; $i++) {
  //echo $client_id[$i]; 
    $update_data = $this->update_with_one_param('leads', 'unique_id', $client_id[$i], 'assigned_to', $transfer_to);
  }

  $get_num_leads1 = $this->get_number_of_rows_one_param('leads','assigned_to', $BE_id);
  $get_num_leads2 = $this->get_number_of_rows_one_param('leads','assigned_to', $transfer_to);

  $update_num_leads1 = $this->update_with_one_param('business_executive_tbl', 'unique_id', $BE_id, 'no_of_assigned_lead', $get_num_leads1);

  $update_num_leads2 = $this->update_with_one_param('business_executive_tbl', 'unique_id', $transfer_to, 'no_of_assigned_lead', $get_num_leads2);

  $value = json_encode($client_id);

  $insert_transfer_client_log = "INSERT INTO `transfer_client_log` SET `transferred_from` = '$BE_id', `transferred_to` = '$transfer_to', `clients_id` = '$value', `time_frame` = '$time_frame', `unique_id` = '$unique_id', `status` = 1, `date_created` = now()";
      $insert_transfer_client_log_query = mysqli_query($this->connection, $insert_transfer_client_log) or die(mysqli_error($this->connection));

      if($update_data && $update_num_leads1 && $update_num_leads1 && $insert_transfer_client_log){

          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
    }
  }


function transfer_back_client($BE_id){
  $get_transfer_client_log = $this->get_rows_from_one_table_by_id('transfer_client_log', 'transferred_from', $BE_id);
  foreach ($get_transfer_client_log as $value) {
    if($value['time_frame'] !== 'permanent'){
      $get_BE_log = $this->get_rows_from_one_table_by_two_params('transfer_client_log', 'transferred_from', $BE_id, 'time_frame', $value['time_frame']);
      foreach ($get_BE_log as $val) {
        $time_frame = $val['time_frame'];
        $date_created = date_create($val['date_created']);
        $today = date('Y-m-d');
        $date_to_add = $time_frame.' days';
        $next_date = date_add($date_created, date_interval_create_from_date_string($date_to_add));
        // $split_date_created = explode('-', $date_created);
        // $new_month = $split_date_created[1] + $time_frame;
        // $nextdate = $split_date_created[0].'-'.$new_month.'-'.$split_date_created[2];
        //$nextdate = date('Y-m-d', strtotime($nextdate));
        if($today == date_format($next_date,"Y-m-d")){
          $client_id = json_decode($val['clients_id']);
          foreach ($client_id as $key => $vals) {
            $update_data = $this->update_with_one_param('leads', 'unique_id', $vals, 'assigned_to', $val['transferred_to']);
            $get_num_leads1 = $this->get_number_of_rows_one_param('leads','assigned_to', $BE_id);
            $get_num_leads2 = $this->get_number_of_rows_one_param('leads','assigned_to', $val['transferred_to']);

            $update_num_leads1 = $this->update_with_one_param('business_executive_tbl', 'unique_id', $BE_id, 'no_of_assigned_lead', $get_num_leads1);

            $update_num_leads2 = $this->update_with_one_param('business_executive_tbl', 'unique_id', $val['transferred_to'], 'no_of_assigned_lead', $get_num_leads2);
          }

        }
         
      }
    }
  }
   if(@$update_data && $update_num_leads1 && $update_num_leads1){

              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }

}

function transfer_client_permanently($BE_id, $client_id, $transfer_to){
  $BE_id = $this->secure_database($BE_id);
  $transfer_to = $this->secure_database($transfer_to);
  $unique_id = $this->unique_id_generator($BE_id.$transfer_to);

  if($transfer_to == "" || empty($client_id)){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else{

  $value = json_encode($client_id);

  $insert_transfer_client_log = "INSERT INTO `transfer_client_log` SET `transferred_from` = '$BE_id', `transferred_to` = '$transfer_to', `clients_id` = '$value', `time_frame` = 'permanent', `unique_id` = '$unique_id', `status` = 0, `date_created` = now()";
      $insert_transfer_client_log_query = mysqli_query($this->connection, $insert_transfer_client_log) or die(mysqli_error($this->connection));

      if($insert_transfer_client_log){

          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
        }

}


function request_invoice($fullname, $address, $package_bought, $quantity, $email, $phone, $admin_id){

  $admin_id = $this->secure_database($admin_id);
  $fullname = $this->secure_database($fullname);
  $address = $this->secure_database($address);
  $package_bought = $this->secure_database($package_bought);
  $quantity = $this->secure_database($quantity);
  $email = $this->secure_database($email);
  $phone = $this->secure_database($phone);
  $data = $fullname.$address.$package_bought;
  $unique_id = $this->unique_id_generator($data);
  //$check = $this->check_row_exists_by_one_param('bank_accounts','account_number', $account_number);
  
  if($admin_id == '' || $fullname == '' || $address == '' || $package_bought == '' || $quantity == '' || $email == '' || $phone == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

  // if($check === true){
  //   return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  // }
  else{
    $insert_invoice_request_sql = "INSERT INTO `client_invoice` SET `unique_id` = '$unique_id',`fullname` = '$fullname', `added_by`='$admin_id', `address`='$address', `package_bought`='$package_bought', `quantity`='$quantity', `email`='$email', `phone`='$phone', `date_created` = now()";
         $insert_invoice_request_query = mysqli_query($this->connection, $insert_invoice_request_sql) or die(mysqli_error($this->connection));
         if($insert_invoice_request_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}



function set_reminder($admin_id, $item, $frequency, $date_of_reminder){
  $admin_id = $this->secure_database($admin_id);
  $item = $this->secure_database($item);
  $frequency = $this->secure_database($frequency);
  $date_of_reminder = $this->secure_database($date_of_reminder);
  $data = $item.$frequency;
  $unique_id = $this->unique_id_generator($data);
  $check = $this->check_row_exists_by_two_params('reminder','set_by',$admin_id,'item',$item);
  $check2 = $this->check_row_exists_by_one_param('reminder','date_of_reminder',$date_of_reminder);
  
  if($admin_id == '' || $item == '' || $frequency == '' || $date_of_reminder == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

  if($check === true && $check2 === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
  else{
    $insert_reminder_sql = "INSERT INTO `reminder` SET `unique_id` = '$unique_id', `item` = '$item', `set_by`='$admin_id', `frequency`='$frequency', `date_of_reminder` = '$date_of_reminder'";
         $insert_reminder_query = mysqli_query($this->connection, $insert_reminder_sql) or die(mysqli_error($this->connection));
         if($insert_reminder_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}


function action_reminder($BE_id){
  $get_admin_reminder =  $this->get_rows_from_one_table_by_id('reminder','set_by', $BE_id);
  foreach ($get_admin_reminder as $value) {
    $unique_id = $this->unique_id_generator($value['date_of_reminder'].$value['item']);
    date_default_timezone_set('Africa/Lagos');
   $date_of_reminder = date($value['date_of_reminder']);
    $present = date('Y-m-d h:i:s');
    if($present == $date_of_reminder){
      $notification = "You set a reminder for today on ".$value['item'];
       $insert_notification_sql = "INSERT INTO `admin_notifications_tbl` SET `unique_id` = '$unique_id', `user_id` = '$BE_id', `notification` = '$notification' `date_created` = now()";
         $insert_notification_query = mysqli_query($this->connection, $insert_notification_sql) or die(mysqli_error($this->connection));
              if($insert_notification_query){
            return json_encode(["status"=>"1", "msg"=>"success"]);
            }else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
            }
              } 
  }
}


//07-04-2020
function set_payment_reminder($admin_id, $client_id, $message, $frequency, $date_to_commence, $date_to_end){
  $admin_id = $this->secure_database($admin_id);
  $client_id = $this->secure_database($client_id);
  $message = $this->secure_database($message);
  $frequency = $this->secure_database($frequency);
  $date_to_commence = $this->secure_database($date_to_commence);
  $date_to_commence = date('Y-m_d', strtotime($date_to_commence));
  $date_to_end = $this->secure_database($date_to_end);
  $date_to_end = date('Y-m_d', strtotime($date_to_end));
  $data = $message.$frequency.$client_id;
  $unique_id = $this->unique_id_generator($data);
  $check = $this->check_row_exists_by_two_params('payment_reminder','set_by',$admin_id,'client_id',$client_id);
  $check2 = $this->check_row_exists_by_one_param('payment_reminder','message',$message);
  
  if($admin_id == '' || $client_id == '' || $message == '' || $frequency == '' || $date_to_commence == '' || $date_to_end == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

  if($check === true && $check2 === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
  else{
    $insert_reminder_sql = "INSERT INTO `payment_reminder` SET `unique_id` = '$unique_id', `client_id` = '$client_id', `set_by`='$admin_id', `frequency`='$frequency', `message` = '$message', `date_to_commence` = '$date_to_commence', `date_to_end` = '$date_to_end'";
         $insert_reminder_query = mysqli_query($this->connection, $insert_reminder_sql) or die(mysqli_error($this->connection));
         if($insert_reminder_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}

function payment_confirmation_request($admin_id, $client_id, $package_category_id, $package_id, $quantity, $amount){
  $admin_id = $this->secure_database($admin_id);
  $client_id = $this->secure_database($client_id);
  $package_category_id = $this->secure_database($package_category_id);
  $package_id = $this->secure_database($package_id);
  $quantity = $this->secure_database($quantity);
  $amount = $this->secure_database($amount);
  $data = $package_id.$package_category_id.$amount;
  $unique_id = $this->unique_id_generator($data);
  
  if($admin_id == '' || $client_id == '' || $package_category_id == '' || $package_id == '' || $quantity == '' || $amount == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
  else{
    $insert_payment_confirmation_sql = "INSERT INTO `client_payment_log` SET `unique_id` = '$unique_id', `client_id` = '$client_id', `admin_id`='$admin_id', `package_category_id`='$package_category_id', `package_id` = '$package_id', `quantity` = '$quantity', `amount` = '$amount', `date_created` = now()";
         $insert_payment_confirmation_query = mysqli_query($this->connection, $insert_payment_confirmation_sql) or die(mysqli_error($this->connection));
         if($insert_payment_confirmation_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}

//14-04-2020
function suspend_be_request($time_frame, $BE_id){
  $time_frame = $this->secure_database($time_frame);
  $BE_id = $this->secure_database($BE_id);
  $data = $time_frame.$BE_id;
  $unique_id = $this->unique_id_generator($data);
  
  if($time_frame == '' || $BE_id == '' ){
     return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else{
    $data = [];
    $get_BE_client = $this->get_rows_from_one_table_by_one_param('leads', 'assigned_to', $BE_id);
    foreach ($get_BE_client as $value) {
      array_push($data, $value['unique_id']);
    }
    $BE_clients = json_encode($data);
    $insert_be_suspension_request_sql = "INSERT INTO `be_suspension_tbl` SET `unique_id` = '$unique_id', `BE_id` = '$BE_id', `time_frame`='$time_frame', `BE_clients` = '$BE_clients', `date_created` = now()";
         $insert_be_suspension_request_query = mysqli_query($this->connection, $insert_be_suspension_request_sql) or die(mysqli_error($this->connection));
    $update_be_status = $this->update_with_one_param('business_executive_tbl','unique_id',$BE_id,'status',4);
         if($insert_be_suspension_request_query && $update_be_status){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"error"]);

         } 
  }

}

//24-04-2020
function get_active_be($admin_id){
  $admin_id = $this->secure_database($admin_id);
  $sql = "SELECT * FROM `business_executive_tbl` WHERE `assigned_to`='$admin_id' AND `status` != 5";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
 if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
    else{
       return null;
    }
}


//24-04-2020
function set_target($sales_target, $admin_id){
  $sales_target = $this->secure_database($sales_target);
  $admin_id = $this->secure_database($admin_id);
  $data = $sales_target.$admin_id;
  
  
  if($sales_target == '' || $admin_id == '' ){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
  else{
    $get_BEs = $this->get_active_be($admin_id);
    if($get_BEs !== null){
      foreach ($get_BEs as $value) {
        $BE_id = $value['unique_id'];
        //if($value['status'] != 5){
          $get_be_target = $this->get_one_row_from_one_table('be_target', 'BE_id', $BE_id);
          $new_be_balance = $sales_target - $get_be_target['sales_made'];

          $check1 = $this->check_row_exists_by_one_param('be_target','BE_id',$BE_id);
          $check2 = $this->check_row_exists_by_one_param('target_bonus_commission','set_for',$BE_id);

          $unique_id = $this->unique_id_generator($sales_target.$admin_id);
         $unique_id2 = $this->unique_id_generator($sales_target.$BE_id);
         if($check1 || $check2){
          $update_target_sql = "UPDATE `target_bonus_commission` SET  `monthly_target` = '$sales_target',
          `date_created` = now() WHERE `set_for` = '$BE_id'";
          //var_dump($update_target_sql);
              $update_target_query = mysqli_query($this->connection, $update_target_sql) or die(mysqli_error($this->connection));
         $update_be_target_sql = "UPDATE `be_target` SET `target_set`='$sales_target', `balance`='$new_be_balance', `date_created` = now() WHERE `BE_id` = '$BE_id'";
             $update_be_target_query = mysqli_query($this->connection, $update_be_target_sql) or die(mysqli_error($this->connection));
          }else{

          $insert_target_sql = "INSERT INTO `target_bonus_commission` SET `unique_id` = '$unique_id', `monthly_target` = '$sales_target', `set_by`='$admin_id', `set_for`='$BE_id', `date_created` = now()";
          //var_dump($insert_target_sql);
          $insert_target_query = mysqli_query($this->connection, $insert_target_sql) or die(mysqli_error($this->connection));
          $insert_be_target_sql = "INSERT INTO `be_target` SET `unique_id` = '$unique_id2', `BE_id` = '$BE_id', `target_set`='$sales_target', `balance`='$sales_target', `date_created` = now()";
            $insert_be_target_query = mysqli_query($this->connection, $insert_be_target_sql) or die(mysqli_error($this->connection));
          }
        //}
       }
    }
    if((@$insert_target_query && $insert_be_target_query) || ($update_target_query && $update_be_target_query)){
          return  json_encode(["status"=>"1", "msg"=>"success"]);
       }else{
          return  json_encode(["status"=>"0", "msg"=>"error"]);
       } 
  }

}

function update_probation_be_target($admin_id, $probation_target){
  $admin_id = $this->secure_database($admin_id);
  $probation_target = $this->secure_database($probation_target);
  $get_probation_be = $this->get_rows_from_one_table_by_two_params('business_executive_tbl','assigned_to',$admin_id,'status', 5);
  if($get_probation_be !== null){
    foreach ($get_probation_be as $value) {
      $BE_id = $value['unique_id'];
      $get_be_target = $this->get_one_row_from_one_table('be_target', 'BE_id', $BE_id);
      $new_be_balance = $probation_target - $get_be_target['sales_made'];

      $check1 = $this->check_row_exists_by_one_param('be_target','BE_id',$BE_id);
      $check2 = $this->check_row_exists_by_one_param('target_bonus_commission','set_for',$BE_id);

      $unique_id = $this->unique_id_generator($probation_target.$admin_id);
      $unique_id2 = $this->unique_id_generator($probation_target.$BE_id);
      if($check1 || $check2){
        $update_target_sql = "UPDATE `target_bonus_commission` SET  `monthly_target` = '$probation_target',
        `date_created` = now() WHERE `set_for` = '$BE_id'";
        //var_dump($update_target_sql);
        $update_target_query = mysqli_query($this->connection, $update_target_sql) or die(mysqli_error($this->connection));
        $update_be_target_sql = "UPDATE `be_target` SET `target_set`='$probation_target', `balance`='$new_be_balance', `date_created` = now() WHERE `BE_id` = '$BE_id'";
        $update_be_target_query = mysqli_query($this->connection, $update_be_target_sql) or die(mysqli_error($this->connection));
      }
    }
    if($update_target_query AND $update_be_target_query){
      return  json_encode(["status"=>"1", "msg"=>"success"]);
    }else{
      return  json_encode(["status"=>"0", "msg"=>"error"]);

    }
  }
}

function set_probation_target($probation_target, $admin_id){
  $probation_target = $this->secure_database($probation_target);
  $admin_id = $this->secure_database($admin_id);
  $data = $probation_target.$admin_id;
  $unique_id = $this->unique_id_generator($data);
  
  
  if($probation_target == '' || $admin_id == '' ){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  $check = $this->check_row_exists_by_one_param('probation_target','set_by',$admin_id);
  if($check){
    //return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
    $update_probation_target_sql = "UPDATE `probation_target` SET `unique_id` = '$unique_id', `monthly_target` = '$probation_target', `date_created` = now() WHERE `set_by`='$admin_id'";
    $update_probation_target_query = mysqli_query($this->connection, $update_probation_target_sql) or die(mysqli_error($this->connection));

    if($update_probation_target_query){
      //return  json_encode(["status"=>"1", "msg"=>"success"]);
      $update_probation_be_target = $this->update_probation_be_target($admin_id, $probation_target);
      $update_probation_be_target_decode = json_decode($update_probation_be_target, true);
      if($update_probation_be_target_decode['status'] == "1"){
        return  json_encode(["status"=>"1", "msg"=>"success"]);
      }
      else{
        return  json_encode(["status"=>"0", "msg"=>"error"]);
      }
    }
    else{
      return  json_encode(["status"=>"0", "msg"=>"error"]);

    }
  }
  else{
    $insert_probation_target_sql = "INSERT INTO `probation_target` SET `unique_id` = '$unique_id', `monthly_target` = '$probation_target', `set_by`='$admin_id', `date_created` = now()";
    //var_dump($insert_probation_target_sql);
    $insert_probation_target_query = mysqli_query($this->connection, $insert_probation_target_sql) or die(mysqli_error($this->connection));

    if($insert_probation_target_query){
     $update_probation_be_target = $this->update_probation_be_target($admin_id, $probation_target);
      $update_probation_be_target_decode = json_decode($update_probation_be_target, true);
      if($update_probation_be_target_decode['status'] == "1"){
        return  json_encode(["status"=>"1", "msg"=>"success"]);
      }
      else{
        return  json_encode(["status"=>"0", "msg"=>"error"]);
      }
    }
    else{
      return  json_encode(["status"=>"0", "msg"=>"error"]);

    } 
  }
}


function edit_individual_target_request($monthly_target, $BE_id, $admin_id){
  $monthly_target = $this->secure_database($monthly_target);
  $admin_id = $this->secure_database($admin_id);
  $BE_id = $this->secure_database($BE_id);
  $data = $monthly_target.$admin_id.$BE_id;
  $unique_id = $this->unique_id_generator($data);
  
  
  if($monthly_target == '' || $admin_id == '' || $BE_id == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

      $check = $this->check_row_exists_by_two_params('target_request','set_by',$admin_id,'set_for',$BE_id);

     if($check){
       $get_request = $this->get_one_row_from_one_table('target_request', 'set_for', $BE_id);
      $update_request = $this->update_with_one_param('target_request','unique_id',$get_request['unique_id'],'monthly_target', $monthly_target);
      if($update_request){
         return  json_encode(["status"=>"1", "msg"=>"success"]);
      }
    }else{

    $insert_edit_request_sql = "INSERT INTO `target_request` SET `unique_id` = '$unique_id', `monthly_target` = '$monthly_target', `set_by`='$admin_id',`set_for`='$BE_id', `date_created` = now()";
    //var_dump($insert_edit_request_sql);
          $insert_edit_request_query = mysqli_query($this->connection, $insert_edit_request_sql) or die(mysqli_error($this->connection));

            if($insert_edit_request_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"error"]);

         } 
       }
    
  }


 function insert_migration_logs($fullname, $admin_id, $description){
  $admin_id = $this->secure_database($admin_id);
  $description = $this->secure_database($description);
  $data = $admin_id.$description;
  $unique_id = $this->unique_id_generator($data);

  if($admin_id == '' || $description == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
  else{
    $insert_log_sql = "INSERT INTO `migration_logs_tbl` SET `unique_id` = '$unique_id',`description` = '$description', `admin_id`='$admin_id', `fullname`='$fullname', `date_created` = now()";
         $insert_log_query = mysqli_query($this->connection, $insert_log_sql) or die(mysqli_error($this->connection));
         if($insert_log_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}
//30-04-2020

function approve_be_sales($BE_id, $amount, $unique_id){
  $BE_id = $this->secure_database($BE_id);
  $amount = $this->secure_database($amount);
  $get_be_target = $this->get_one_row_from_one_table('be_target', 'BE_id', $BE_id);
  @$new_balance = $get_be_target['balance'] - $amount; 
  @$new_sales_made = $get_be_target['sales_made'] + $amount; 
  if($BE_id !== '' && $amount!== ''){
    $get_BE_commission = $this->get_one_row_from_one_table('bonus_commission_request', 'set_for', $BE_id);
    if($get_BE_commission['commission_status'] == 1){
      $update_be_commission = $this->update_with_one_param('be_sales', 'unique_id', $unique_id, 'commission', $get_BE_commission['commission']);
    }else{
      $update_be_commission = $this->update_with_one_param('be_sales', 'unique_id', $unique_id, 'commission', 0);
    }
    $update_be_sales = $this->update_with_one_param('be_sales', 'unique_id', $unique_id, 'sales_status', 3);
    $update_be_sales_made = $this->update_with_one_param('be_target', 'BE_id', $BE_id, 'sales_made', $new_sales_made);
    $update_be_balance = $this->update_with_one_param('be_target', 'BE_id', $BE_id, 'balance', $new_balance);
    if($update_be_sales && $update_be_sales_made && $update_be_balance){
       return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"error"]);

         } 
    }
  }



function approve_client_transfer_request($unique_id){
  $get_transfer_client_log = $this->get_one_row_from_one_table('transfer_client_log', 'unique_id', $unique_id);
  //echo $unique_id;
          $client_id = json_decode($get_transfer_client_log['clients_id']);
          foreach ($client_id as $key => $vals) {
            //echo $vals;
            $update_data = $this->update_with_one_param('leads', 'unique_id', $vals, 'assigned_to', $get_transfer_client_log['transferred_to']);
            $get_num_leads1 = $this->get_number_of_rows_one_param('leads','assigned_to',  $get_transfer_client_log['transferred_from']);
            $get_num_leads2 = $this->get_number_of_rows_one_param('leads','assigned_to', $get_transfer_client_log['transferred_to']);

            $update_num_leads1 = $this->update_with_one_param('business_executive_tbl', 'unique_id', $get_transfer_client_log['transferred_from'], 'no_of_assigned_lead', $get_num_leads1);

            $update_num_leads2 = $this->update_with_one_param('business_executive_tbl', 'unique_id', $get_transfer_client_log['transferred_to'], 'no_of_assigned_lead', $get_num_leads2);

            $update_transfer_client_log = $this->update_with_one_param('transfer_client_log', 'unique_id', $unique_id, 'status', 1);

          }
        if($update_data && $update_num_leads1 && $update_num_leads1 && $update_transfer_client_log){

              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"error"]);
              }
         
      }
//12-06-2020
function credit_user_wallet($user_id, $amount, $admin_id){
    $user_id = $this->secure_database($user_id);
    $amount = $this->secure_database($amount);
    $admin_id = $this->secure_database($admin_id);
    $get_user_wallet_balance = $this->get_wallet_balance($admin_id);
    $get_user_wallet_balance_decode = json_decode($get_user_wallet_balance,true);

    $get_admin_wallet_balance = $this->get_wallet_balance($admin_id);
    $get_admin_wallet_balance_decode = json_decode($get_admin_wallet_balance,true);
    

    $check_wallet_balance = $this->check_admin_wallet_balance($amount,$admin_id);
    $check_wallet_balance_decode = json_decode($check_wallet_balance,true);

    $check_if_user_wallet_exist = $this->check_row_exists_by_one_param('wallet_tbl','user_id',$user_id);

     if($user_id == '' || $amount == 0 || $admin_id == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

      
       if($check_wallet_balance_decode['msg'] == "balance_less" ){
          return json_encode(["status"=>"0", "msg"=>"balance_less"]);
        }
      if($get_user_wallet_balance_decode['status'] === 0 || $get_admin_wallet_balance_decode ['status'] === 0){
            return  json_encode(["status"=>"0", "msg"=>"get_wallet_balance_error"]);
          }

else{

       if($check_if_user_wallet_exist === false){
         $data = $user_id.$amount;
         $beneficiary_unique_id = $this->unique_id_generator($data);
         $insert_benef_into_wallet_sql = "INSERT INTO `wallet_tbl` SET `unique_id` = '$beneficiary_unique_id',`balance` = 0, `user_id`='$user_id'";
         $insert_benef_into_wallet_query = mysqli_query($this->connection,$insert_benef_into_wallet_sql);
         if($insert_benef_into_wallet_query === false){
            return  json_encode(["status"=>"0", "msg"=>"error_creating_benef_wallet"]);
         }
      }
      
      else{
        $get_user_wallet_balance = $this->get_wallet_balance($user_id);
        $get_user_wallet_balance_decode = json_decode($get_user_wallet_balance,true);

      $get_admin_wallet_balance = $this->get_admin_wallet_balance($admin_id);
      $get_admin_wallet_balance_decode = json_decode($get_admin_wallet_balance,true);

        $new_admin_balance = $get_admin_wallet_balance_decode['msg'] - $amount;
        $new_user_balance = $get_user_wallet_balance_decode['msg'] + $amount;



          ////update wallet balance
          $update_admin_wallet_balance = $this->update_with_one_param('accountant_wallet_tbl','admin_id',$admin_id,'balance',$new_admin_balance);
          $update_user_balance = $this->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_user_balance);
              
            $data = $user_id.$amount.$admin_id;
            $unique_id = $this->unique_id_generator($data);
            
            $insert_into_transfer_log = "INSERT INTO `credit_user_wallet_log` SET `unique_id` = '$unique_id', `user_id`='$user_id', `admin_id`='$admin_id',`amount`='$amount', `date_created` = now()";
            $insert_into_transfer_log_query = mysqli_query($this->connection,$insert_into_transfer_log);
            $insert_credit_wallet_tbl = "INSERT INTO `credit_wallet_tbl` SET `unique_id` = '$unique_id', `user_id`='$user_id', `amount`='$amount', `description`='Credited by Accountant', `payment_type` = 'admin', `payment_status` = 1, `date_created` = now()";
            $insert_credit_wallet_tbl_query = mysqli_query($this->connection,$insert_credit_wallet_tbl);
            $insert_debit_wallet_tbl = "INSERT INTO `debit_wallet_tbl` SET `unique_id` = '$unique_id', `user_id`='$user_id', `amount_withdrawn`='$amount',  `purpose` = 11, `withdrawal_status` = 1, `package_id`='from_accountant', `description`='Credited by Accountant', `date_created` = now()";
            $insert_debit_wallet_tbl_query = mysqli_query($this->connection,$insert_debit_wallet_tbl);
          if($update_admin_wallet_balance && $update_user_balance && $insert_into_transfer_log_query && $insert_credit_wallet_tbl_query && $insert_debit_wallet_tbl_query){
            return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
            return json_encode(["status"=>"0", "msg"=>"error"]);
          }

        }
      }


}

function error_credit($unique_id, $user_id, $admin_id, $amount){
  $unique_id = $this->secure_database($unique_id);
  $user_id = $this->secure_database($user_id);
  $admin_id = $this->secure_database($admin_id);
  if($unique_id =='' || $user_id == '' || $amount == 0 || $admin_id == ''){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else{
    $get_user_wallet_balance = $this->get_wallet_balance($user_id);
    $get_user_wallet_balance_decode = json_decode($get_user_wallet_balance,true);

    $get_admin_wallet_balance = $this->get_admin_wallet_balance($admin_id);
    $get_admin_wallet_balance_decode = json_decode($get_admin_wallet_balance,true);
    if($get_user_wallet_balance_decode['msg'] < $amount){
      return  json_encode(["status"=>"0", "msg"=>"user_balance_less"]);
    }
    else{

      $new_admin_balance = $get_admin_wallet_balance_decode['msg'] + $amount;
      $new_user_balance = $get_user_wallet_balance_decode['msg'] - $amount;
      $update_admin_wallet_balance = $this->update_with_one_param('accountant_wallet_tbl','admin_id',$admin_id,'balance',$new_admin_balance);
      $update_user_balance = $this->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_user_balance);
      $update_credit_user_wallet_log = $this->update_with_one_param('credit_user_wallet_log','unique_id',$unique_id,'status', 2);
      if($update_admin_wallet_balance && $update_user_balance && $update_credit_user_wallet_log){
        return json_encode(["status"=>"1", "msg"=>"success"]);
      }
      else{
        return json_encode(["status"=>"0", "msg"=>"error"]);
      }
    }

  }
}


//22-05-2020
function insert_migrated_usersOLLD($table, $other_names, $gender, $surname, $password, $confirm_password, $phone , $email, $dob, $home_address, $bank_name, $account_name, $account_number, $bvn, $account_type, $unique_id){
   
    $other_names = $this->secure_database($other_names);
    $surname = $this->secure_database($surname);
    $password = $this->secure_database($password);
    $confirm_password = $this->secure_database($confirm_password);
    $phone = $this->secure_database($phone);
    $email = $this->secure_database($email);
    $gender = $this->secure_database($gender);
    $dob = $this->secure_database($dob);
    $home_address = $this->secure_database($home_address);
    $bank_name = $this->secure_database($bank_name);
    $account_name = $this->secure_database($account_name);
    $account_number = $this->secure_database($account_number);
    $bvn = $this->secure_database($bvn);
    $account_type = $this->secure_database($account_type);

    $check = $this->check_row_exists_by_one_param($table,'email',$email);
  
  if($other_names == "" || $surname == "" || $password == "" || $phone == "" || $confirm_password == "" || $email == "" || $gender == "" || $dob == "" || $home_address == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{
       if ($password != $confirm_password){
        return json_encode(["status"=>"0", "msg"=>"password_mismatch"]);
       }
       else{
        $enc_password = md5($password);
       $sql = "INSERT INTO $table SET `referral_id`='admin',`unique_id` = '$unique_id',`other_names` = '$other_names',`surname` = '$surname',  `phone` = '$phone', `password` = '$enc_password', `email` = '$email', `gender` = '$gender', `dob` = '$dob', `home_address` = '$home_address', `bank_name` = '$bank_name', `account_name` = '$account_name', `account_number` = '$account_number', `bvn` = '$bvn',`account_type` = '$account_type',`access_level` = 1,`date_created` = now()";
          $query = mysqli_query($this->connection, $sql);
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
        }
  }
}


function insert_migrated_users($table, $other_names,  $surname,  $email, $unique_id){
   
    $other_names = $this->secure_database($other_names);
    $surname = $this->secure_database($surname);
    $email = $this->secure_database($email);
    $password = md5('password');

    $check = $this->check_row_exists_by_one_param($table,'email',$email);
  
  if($other_names == "" || $surname == "" || $email == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{
      
       $enc_password = md5($password);
       
       $sql = "INSERT INTO $table SET `referral_id`='admin',`unique_id` = '$unique_id',`other_names` = '$other_names',`surname` = '$surname',  `password` = '$password', `email` = '$email', `access_level` = 1,`date_created` = now()";
        $query = mysqli_query($this->connection, $sql);
         if($query){
            $get_user_id = $this->get_one_row_from_one_table('users_tbl', 'email', $email);
            $user_id = $get_user_id['unique_id'];
            $data2 = $other_names.$surname;
         $unique_idw = $this->unique_id_generator($data2);
         $insert_wallet_sql = "INSERT INTO `wallet_tbl` SET `unique_id` = '$unique_idw',`balance` = 0, `user_id`='$user_id', `date_created` = now()";
         $insert_wallet_query = mysqli_query($this->connection,$insert_wallet_sql);
       
          if($query == true && $insert_wallet_query == true ){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
         }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
         }  
        
  }
}

function edit_migrated_users($table, $other_names, $gender, $surname, $phone , $email, $dob, $home_address, $bank_name, $account_name, $account_number, $bvn, $account_type, $user_id){
   
    $other_names = $this->secure_database($other_names);
    $surname = $this->secure_database($surname);
    $phone = $this->secure_database($phone);
    $email = $this->secure_database($email);
    $gender = $this->secure_database($gender);
    $dob = $this->secure_database($dob);
    $home_address = $this->secure_database($home_address);
    $bank_name = $this->secure_database($bank_name);
    $account_name = $this->secure_database($account_name);
    $account_number = $this->secure_database($account_number);
    $bvn = $this->secure_database($bvn);
    $account_type = $this->secure_database($account_type);
    
    if($other_names == "" || $surname == "" || $email == ""){
      return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
    }
    //$check = $this->check_row_exists_by_one_param($table,'email',$email);
        $enc_password = md5('password');
       $sql = "UPDATE $table SET `referral_id`='admin',`other_names` = '$other_names',`surname` = '$surname',  `phone` = '$phone', `password` = '$enc_password', `email` = '$email', `gender` = '$gender', `dob` = '$dob', `home_address` = '$home_address', `bank_name` = '$bank_name', `account_name` = '$account_name', `account_number` = '$account_number', `bvn` = '$bvn',`account_type` = '$account_type',`access_level` = 1,`date_created` = now() WHERE `unique_id` = '$user_id'";
          $query = mysqli_query($this->connection, $sql)or die(mysqli_error($this->connection));
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
}




////////packages and categories code by sam starts
////////packages and categories code by sam starts
////////packages and categories code by sam starts
////////packages and categories code by sam starts
////////packages and categories code by sam starts
////////////from 01-04-2020 SAM starts here
 function create_fixed_package_OLD($package_name,$package_category,$package_description,$package_type,$package_unit_price,$min_no_slots,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$backdatable,$no_of_slots,$visibility,$package_commission,$created_by,$filename,$size,$tmpName,$type){

    $package_name = $this->secure_database($package_name);
    $package_category = $this->secure_database($package_category);
    $package_description = $this->secure_database($package_description);
    $package_type = $this->secure_database($package_type);
    $package_unit_price = $this->secure_database($package_unit_price);
    $min_no_slots = $this->secure_database($min_no_slots);
    $moratorium = $this->secure_database($moratorium);
    $free_liquidation_period = $this->secure_database($free_liquidation_period);
    $liquidation_surcharge = $this->secure_database($liquidation_surcharge);
    $tenure_of_product = $this->secure_database($tenure_of_product);
    $float_time = $this->secure_database($float_time);
    $multiplying_factor = $this->secure_database($multiplying_factor);
    $capital_refund = $this->secure_database($capital_refund);
    $backdatable = $this->secure_database($backdatable);
    $no_of_slots = $this->secure_database($no_of_slots);
    $visibility = $this->secure_database($visibility);
    $package_commission = $this->secure_database($package_commission);
    $created_by = $this->secure_database($created_by);
  

    $data = $filename.$size.$package_name;
    $table = 'package_definition';
    $unique_id = $this->unique_id_generator($data);
    $image_url = $this->image_upload($filename, $size, $tmpName, $type);
    $check = $this->check_row_exists_by_one_param($table,'package_name',$package_name);

  if($package_name == "" || $package_category == "" || $package_type == "" || $package_unit_price == ""  || $min_no_slots == ""  || $moratorium == "" || $free_liquidation_period == "" || $liquidation_surcharge == "" || $tenure_of_product == "" || $float_time == "" || $multiplying_factor == "" || $capital_refund == "" || $backdatable == "" || $no_of_slots == "" || $visibility == "" || $package_commission == "" || $created_by == "" || $filename == ""|| $size == "" || $tmpName == "" || $type == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }

  else{
        $imageurl_decode = json_decode($image_url,true);
        if($imageurl_decode['status'] == '1'){
              $imageurl2 = $imageurl_decode['msg'];
              $sql = "INSERT INTO `package_definition` SET 
              `package_category` = '$package_category',
              `package_description` = '$package_description',
              `package_name` = '$package_name',
              `unique_id` = '$unique_id',
              `package_type` = '$package_type',
              `package_unit_price` = '$package_unit_price',
              `image_url` = '$imageurl2',
              `min_no_slots` = '$min_no_slots',
              `moratorium` = '$moratorium',
              `free_liquidation_period` = '$free_liquidation_period',
              `liquidation_surcharge` = '$liquidation_surcharge',
              `tenure_of_product` = '$tenure_of_product',
              `float_time` = '$float_time',
              `multiplying_factor`='$multiplying_factor',
              `capital_refund`='$capital_refund',
              `backdatable`='$backdatable',
              `no_of_slots`='$no_of_slots',
              `visibility`='$visibility',
              `package_commission`='$package_commission',
              `created_by`='$created_by',
              `date_created` = now()";
              $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        }else{
                return json_encode(["status"=>"0", "msg"=>$filename.$imageurl_decode['msg'] ]);
        }


      
  }

 }


 function create_fixed_package($package_name,$package_category,$package_description,$package_type,$package_unit_price,$min_no_slots,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$capital_refund_days,$backdatable,$no_of_slots,$visibility,$package_commission,$created_by){
  // ,$created_by,$filename,$size,$tmpName,$type

    $package_name = $this->secure_database($package_name);
    $package_category = $this->secure_database($package_category);
    $package_description = $this->secure_database($package_description);
    $package_type = $this->secure_database($package_type);
    $package_unit_price = $this->secure_database($package_unit_price);
    $min_no_slots = $this->secure_database($min_no_slots);
    $moratorium = $this->secure_database($moratorium);
    $free_liquidation_period = $this->secure_database($free_liquidation_period);
    $liquidation_surcharge = $this->secure_database($liquidation_surcharge);
    $tenure_of_product = $this->secure_database($tenure_of_product);
    $float_time = $this->secure_database($float_time);
    $multiplying_factor = $this->secure_database($multiplying_factor);
    $capital_refund = $this->secure_database($capital_refund);
    $capital_refund_days = $this->secure_database($capital_refund_days);
    $backdatable = $this->secure_database($backdatable);
    $no_of_slots = $this->secure_database($no_of_slots);
    $visibility = $this->secure_database($visibility);
    $package_commission = $this->secure_database($package_commission);
    $created_by = $this->secure_database($created_by);
    $imageurl2 = "uploads/basal_daily.jpg";
    

    $data = $created_by.$moratorium.$package_name;
    $table = 'package_definition';
    $unique_id = $this->unique_id_generator($data);
    //$image_url = $this->image_upload($filename, $size, $tmpName, $type);
    $check = $this->check_row_exists_by_one_param($table,'package_name',$package_name);

  if($package_name == "" || $package_category == "" || $package_type == "" || $package_unit_price == ""  || $min_no_slots == ""  || $moratorium == "" || $free_liquidation_period == "" || $liquidation_surcharge == "" || $tenure_of_product == "" || $float_time == "" || $multiplying_factor == "" || $capital_refund == "" || $capital_refund_days == "" || $backdatable == "" || $no_of_slots == "" || $visibility == "" || $package_commission == "" || $created_by == "" ){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }

  else{
        //$imageurl_decode = json_decode($image_url,true);
        //if($imageurl_decode['status'] == '1'){
          //    $imageurl2 ="";
              $sql = "INSERT INTO `package_definition` SET 
              `package_category` = '$package_category',
              `package_description` = '$package_description',
              `package_name` = '$package_name',
              `unique_id` = '$unique_id',
              `package_type` = '$package_type',
              `package_unit_price` = '$package_unit_price',
              `image_url` = '$imageurl2',
              `min_no_slots` = '$min_no_slots',
              `moratorium` = '$moratorium',
              `free_liquidation_period` = '$free_liquidation_period',
              `liquidation_surcharge` = '$liquidation_surcharge',
              `tenure_of_product` = '$tenure_of_product',
              `float_time` = '$float_time',
              `multiplying_factor`='$multiplying_factor',
              `capital_refund`='$capital_refund',
              `capital_refund_days`='$capital_refund_days',
              `backdatable`='$backdatable',
              `no_of_slots`='$no_of_slots',
              `visibility`='$visibility',
              `package_commission`='$package_commission',
              `created_by`='$created_by',
              `date_created` = now()";
              $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        //}else{
          //      return json_encode(["status"=>"0", "msg"=>$filename.$imageurl_decode['msg'] ]);
        //}
  }

 }


 function create_recurrent_package($recurrence_value,$contribution_period,$incubation_period,$recurrence_type,$package_name,$package_category,$package_description,$package_type,$package_unit_price,$min_no_slots,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$capital_refund_days,$backdatable,$no_of_slots,$visibility,$package_commission,$created_by){
   // ,$filename,$size,$tmpName,$type
    $recurrence_value = $this->secure_database($recurrence_value);
    $contribution_period = $this->secure_database($contribution_period);
    $incubation_period = $this->secure_database($incubation_period);
    $recurrence_type = $this->secure_database($recurrence_type);


    $package_name = $this->secure_database($package_name);
    $package_category = $this->secure_database($package_category);
    $package_description = $this->secure_database($package_description);
    $package_type = $this->secure_database($package_type);
    $package_unit_price = $this->secure_database($package_unit_price);
    $min_no_slots = $this->secure_database($min_no_slots);
    $moratorium = $this->secure_database($moratorium);
    $free_liquidation_period = $this->secure_database($free_liquidation_period);
    $liquidation_surcharge = $this->secure_database($liquidation_surcharge);
    $tenure_of_product = $this->secure_database($tenure_of_product);
    $float_time = $this->secure_database($float_time);
    $multiplying_factor = $this->secure_database($multiplying_factor);
    $capital_refund = $this->secure_database($capital_refund);
    $capital_refund_days = $this->secure_database($capital_refund_days);
    $backdatable = $this->secure_database($backdatable);
    $no_of_slots = $this->secure_database($no_of_slots);
    $visibility = $this->secure_database($visibility);
    $package_commission = $this->secure_database($package_commission);
    $created_by = $this->secure_database($created_by);
    $imageurl2 = "uploads/basal_daily.jpg";


    $data = $package_category.$moratorium.$package_name;
    $table = 'package_definition';
    $unique_id = $this->unique_id_generator($data);
    // $image_url = $this->image_upload($filename, $size, $tmpName, $type);
    $check = $this->check_row_exists_by_one_param($table,'package_name',$package_name);

  if( $recurrence_value == "" || $contribution_period == "" || $incubation_period == "" || $recurrence_type == "" ||   $package_name == "" || $package_category == "" || $package_type == "" || $package_unit_price == ""  || $min_no_slots == ""  || $moratorium == "" || $free_liquidation_period == "" || $liquidation_surcharge == "" || $tenure_of_product == "" || $float_time == "" || $multiplying_factor == "" || $capital_refund == "" || $capital_refund_days == ""  || $backdatable == "" || $no_of_slots == "" || $visibility == ""|| $package_commission == "" || $created_by == "" ){
    // || $filename == ""|| $size == ""|| $tmpName == "" || $type == ""
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }

  else{
        //$imageurl_decode = json_decode($image_url,true);
        //if($imageurl_decode['status'] == '1'){
          //    $imageurl2 = $imageurl_decode['msg'];
              $sql = "INSERT INTO `package_definition` SET 
              `package_category` = '$package_category',
              `package_description` = '$package_description',
              `package_name` = '$package_name',
              `unique_id` = '$unique_id',
              `package_type` = '$package_type',
              `package_unit_price` = '$package_unit_price',
              `image_url` = '$imageurl2',
              `recurrence_value` = '$package_unit_price',
              `contribution_period` = '$contribution_period',
              `incubation_period` = '$incubation_period',
              `recurrence_type` = '$recurrence_type',
              `min_no_slots` = '$min_no_slots',
              `moratorium` = '$moratorium',
              `free_liquidation_period` = '$free_liquidation_period',
              `liquidation_surcharge` = '$liquidation_surcharge',
              `tenure_of_product` = '$tenure_of_product',
              `float_time` = '$float_time',
              `multiplying_factor`='$multiplying_factor',
              `capital_refund`='$capital_refund',
              `capital_refund_days`='$capital_refund_days',
              `backdatable`='$backdatable',
              `no_of_slots`='$no_of_slots',
              `visibility`='$visibility',
              `package_commission`='$package_commission',
              `created_by`='$created_by',
              `date_created` = now()";
              $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
    //    }else{
      //          return json_encode(["status"=>"0", "msg"=>$filename.$imageurl_decode['msg'] ]);
        //}


      
  }

 }  

function update_fixed_package($package_id,$package_name,$package_category,$package_description,$package_type,$package_unit_price,$min_no_slots,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$capital_refund_days,$backdatable,$no_of_slots,$visibility,$package_commission,$created_by){
// ,$filename,$size,$tmpName,$type
    $package_id = $this->secure_database($package_id);
    $package_name = $this->secure_database($package_name);
    $package_category = $this->secure_database($package_category);
    $package_description = $this->secure_database($package_description);
    $package_type = $this->secure_database($package_type);
    $package_unit_price = $this->secure_database($package_unit_price);
    $min_no_slots = $this->secure_database($min_no_slots);
    $moratorium = $this->secure_database($moratorium);
    $free_liquidation_period = $this->secure_database($free_liquidation_period);
    $liquidation_surcharge = $this->secure_database($liquidation_surcharge);
    $tenure_of_product = $this->secure_database($tenure_of_product);
    $float_time = $this->secure_database($float_time);
    $multiplying_factor = $this->secure_database($multiplying_factor);
    $capital_refund = $this->secure_database($capital_refund);
    $backdatable = $this->secure_database($backdatable);
    $no_of_slots = $this->secure_database($no_of_slots);
    $visibility = $this->secure_database($visibility);
    $package_commission = $this->secure_database($package_commission);
    $created_by = $this->secure_database($created_by);
  

    $data = $package_unit_price.$package_id.$package_name;
    $table = 'package_definition';
    $unique_id = $this->unique_id_generator($data);
    // $image_url = $this->image_upload($filename, $size, $tmpName, $type);
    //$check = $this->check_row_exists_by_one_param($table,'package_name',$package_name);

  if($package_name == "" || $package_category == "" || $package_type == "" || $package_unit_price == ""  || $min_no_slots == ""  || $moratorium == "" || $free_liquidation_period == "" || $liquidation_surcharge == "" || $tenure_of_product == "" || $float_time == "" || $multiplying_factor == "" || $capital_refund == "" || $backdatable == "" || $no_of_slots == "" || $visibility == ""|| $package_commission == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
 
  // else if($check === true){
  //   return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  // }

  else{
        // $imageurl_decode = json_decode($image_url,true);
        // if($imageurl_decode['status'] == '1'){
              // $imageurl2 = $imageurl_decode['msg'];
              $sql = "UPDATE `package_definition` SET 
              `package_category` = '$package_category',
              `package_description` = '$package_description',
              `package_name` = '$package_name',
              
              `package_type` = '$package_type',
              `package_unit_price` = '$package_unit_price',
              `min_no_slots` = '$min_no_slots',
              `incubation_period`= NULL,
              `contribution_period`= NULL,
              `recurrence_type`= NULL,
              `recurrence_value`= NULL,
              `moratorium` = '$moratorium',
              `free_liquidation_period` = '$free_liquidation_period',
              `liquidation_surcharge` = '$liquidation_surcharge',
              `tenure_of_product` = '$tenure_of_product',
              `float_time` = '$float_time',
              `multiplying_factor`='$multiplying_factor',
              `capital_refund`='$capital_refund',
              `backdatable`='$backdatable',
              `package_commission`='$package_commission',
              `no_of_slots`='$no_of_slots',
              `visibility`='$visibility',
              
              `created_by`='$created_by'  WHERE `unique_id`='$package_id'";
              $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        //}else{
          //      return json_encode(["status"=>"0", "msg"=>$filename.$imageurl_decode['msg'] ]);
        //}


      
  }

 }


function update_recurrent_package($package_id,$recurrence_value,$contribution_period,$incubation_period,$recurrence_type,$package_name,$package_category,$package_description,$package_type,$package_unit_price,$min_no_slots,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$backdatable,$no_of_slots,$visibility,$package_commission,$created_by){
  // ,$filename,$size,$tmpName,$type
    $package_id = $this->secure_database($package_id); 
    $recurrence_value = $this->secure_database($recurrence_value);
    $contribution_period = $this->secure_database($contribution_period);
    $incubation_period = $this->secure_database($incubation_period);
    $recurrence_type = $this->secure_database($recurrence_type);


    $package_name = $this->secure_database($package_name);
    $package_category = $this->secure_database($package_category);
    $package_description = $this->secure_database($package_description);
    $package_type = $this->secure_database($package_type);
    $package_unit_price = $this->secure_database($package_unit_price);
    $min_no_slots = $this->secure_database($min_no_slots);
    $moratorium = $this->secure_database($moratorium);
    $free_liquidation_period = $this->secure_database($free_liquidation_period);
    $liquidation_surcharge = $this->secure_database($liquidation_surcharge);
    $tenure_of_product = $this->secure_database($tenure_of_product);
    $float_time = $this->secure_database($float_time);
    $multiplying_factor = $this->secure_database($multiplying_factor);
    $capital_refund = $this->secure_database($capital_refund);
    $backdatable = $this->secure_database($backdatable);
    $no_of_slots = $this->secure_database($no_of_slots);
    $visibility = $this->secure_database($visibility);
    $package_commission = $this->secure_database($package_commission);
    $created_by = $this->secure_database($created_by);
  

    $data = $package_unit_price.$package_category.$package_name;
    $table = 'package_definition';
    $unique_id = $this->unique_id_generator($data);
    // $image_url = $this->image_upload($filename, $size, $tmpName, $type);
   // $check = $this->check_row_exists_by_one_param($table,'package_name',$package_name);

  if( $recurrence_value == "" || $contribution_period == "" || $incubation_period == "" || $recurrence_type == "" ||   $package_name == "" || $package_category == "" || $package_type == "" || $package_unit_price == ""  || $min_no_slots == ""  || $moratorium == "" || $free_liquidation_period == "" || $liquidation_surcharge == "" || $tenure_of_product == "" || $float_time == "" || $multiplying_factor == "" || $capital_refund == "" || $backdatable == "" || $no_of_slots == "" || $visibility == ""|| $package_commission == "" || $created_by == "" ){
    //| $filename == ""|| $size == ""|| $tmpName == "" || $type == ""
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  // else if($check === true){
  //   return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  // }

  else{
        // $imageurl_decode = json_decode($image_url,true);
        // if($imageurl_decode['status'] == '1'){
              // $imageurl2 = $imageurl_decode['msg'];
              $sql = "UPDATE `package_definition` SET 
              `package_category` = '$package_category',
              `package_description` = '$package_description',
              `package_name` = '$package_name', 
              `package_type` = '$package_type',
              `package_unit_price` = '$package_unit_price',
              `recurrence_value` = '$recurrence_value',
              `contribution_period` = '$contribution_period',
              `incubation_period` = '$incubation_period',
              `recurrence_type` = '$recurrence_type',
              `min_no_slots` = '$min_no_slots',
              `moratorium` = '$moratorium',
              `free_liquidation_period` = '$free_liquidation_period',
              `liquidation_surcharge` = '$liquidation_surcharge',
              `tenure_of_product` = '$tenure_of_product',
              `float_time` = '$float_time',
              `multiplying_factor`='$multiplying_factor',
              `capital_refund`='$capital_refund',
              `backdatable`='$backdatable',
              `no_of_slots`='$no_of_slots',
              `visibility`='$visibility',
              `package_commission`='$package_commission',
              `created_by`='$created_by' WHERE `unique_id`='$package_id'";
              $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        //}else{
          //      return json_encode(["status"=>"0", "msg"=>$filename.$imageurl_decode['msg'] ]);
        //}


      
  }

 }  


function subscribe_to_recurrent_package($package_type,$package_category,$package_commission,$user_id,$package_id,$package_unit_price,$incubation_period,$recurrence_value,$contribution_period,$recurrence_type,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$no_of_slots_bought,$available_slots){
$package_type = $this->secure_database($package_type); 
    $package_category = $this->secure_database($package_category); 
    $package_commission = $this->secure_database($package_commission); 
    $user_id = $this->secure_database($user_id); 
    $package_id = $this->secure_database($package_id); 
    $no_of_slots_bought = $this->secure_database($no_of_slots_bought); 
    $package_unit_price = $this->secure_database($package_unit_price); 
    $total_amount = $no_of_slots_bought * $package_unit_price; 
    $incubation_period = $this->secure_database($incubation_period); 
    $recurrence_value = $this->secure_database($recurrence_value); 
    $contribution_period = $this->secure_database($contribution_period); 
    $recurrence_type = $this->secure_database($recurrence_type); 
    $moratorium = $this->secure_database($moratorium); 
    $free_liquidation_period = $this->secure_database($free_liquidation_period); 
    $liquidation_surcharge = $this->secure_database($liquidation_surcharge); 
    $tenure_of_product = $this->secure_database($tenure_of_product); 
    $float_time = $this->secure_database($float_time); 
    $multiplying_factor = $this->secure_database($multiplying_factor); 
    $capital_refund = $this->secure_database($capital_refund); 
   
    $data = $user_id.$package_id;
    $unique_id = $this->unique_id_generator($data);

    //check wallet balance
    $getwallet = $this->get_wallet_balance($user_id);
    $decode_wallet = json_decode($getwallet,true);
    $wallet_balance = $decode_wallet['msg'];

    $get_wallet_status = $this->get_one_row_from_one_table('wallet_tbl', 'user_id', $user_id);
    $wallet_status = $get_wallet_status['wallet_status'];
    if($wallet_balance < $total_amount){
            return json_encode(["status"=>"0", "msg"=>"insufficient_wallet_balance"]);

    }else if($wallet_status == 0){
          return json_encode(["status"=>"0", "msg"=>"wallet_deactivated"]);
    }

    else{
        $get_lead = $this->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
        $check_lead_exist = $this->check_row_exists_by_one_param('leads','email',$get_lead['email']);
        if($check_lead_exist === true){
          $update_lead = $this->update_with_one_param('leads','email', $get_lead['email'],'classification','client');
        }
         //$new_balance = $wallet_balance - $total_amount;
         $new_slot_bal = $available_slots - $no_of_slots_bought;
         

          ////update wallet balance
          //$update_wallet_balance = $this->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_balance);

          ///update package slot
          $update_package_slot = $this->update_with_one_param('package_definition','unique_id',$package_id,'no_of_slots',$new_slot_bal);

           ///update package slot
          $update_investment_status = $this->update_with_one_param('users_tbl','unique_id',$user_id,'investment_status',1);

          ////debit history
          $insert_debit_wallet_tbl = $this->insert_subscription_to_a_package($user_id,$total_amount,$package_id);
          $insert_debit_wallet_tbl_decode = json_decode($insert_debit_wallet_tbl,true);
          if($insert_debit_wallet_tbl_decode['status'] == 0){
            return json_encode(["status"=>"0", "msg"=>"insert_debit_wallet_tbl_error"]);
          }

          ///insert into subscribe to package
           $insert_subscribed_packages = "INSERT INTO  subscribed_packages SET 
           `unique_id` = '$unique_id',
           `user_id` = '$user_id',
           `package_id` = '$package_id',
            `package_type` = '$package_type',
           `package_category` = '$package_category',
           `package_commission` = '$package_commission',
           `package_unit_price` = '$package_unit_price',
           `incubation_period` = '$incubation_period',
           `recurrence_value` = '$recurrence_value',
           `contribution_period` = '$contribution_period',
           `recurrence_type` = '$recurrence_type',
           `total_amount` = '$total_amount',
           `moratorium` = '$moratorium',
           `free_liquidation_period` = '$free_liquidation_period',
           `liquidation_surcharge` = '$liquidation_surcharge',
           `tenure_of_product` = '$tenure_of_product',
           `float_time` = '$float_time',
           `float_time_incremental` = '$float_time',
           `multiplying_factor` = '$multiplying_factor',
           `capital_refund` = '$capital_refund',
           `no_of_slots_bought` = '$no_of_slots_bought',
           `date_created` = now()";
           //$query_insert = mysqli_query($this->connection, $insert_subscribed_packages);
           $query_insert = mysqli_query($this->connection, $insert_subscribed_packages) or die(mysqli_error($this->connection));
           // return $query_insert;
           if($query_insert){
            return  json_encode(["status"=>"1", "msg"=>"successful_susbscription"]);
            }else{
            return  json_encode(["status"=>"0", "msg"=>"db_error"]);
            }

        }    




}


function subscribe_to_fixed_package($package_type,$package_category,$package_commission,$user_id,$package_id,$package_unit_price,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$no_of_slots_bought,$available_slots){
    $package_type = $this->secure_database($package_type); 
    $package_category = $this->secure_database($package_category); 
    $package_commission = $this->secure_database($package_commission); 
    $user_id = $this->secure_database($user_id); 
    $package_id = $this->secure_database($package_id);  
    $package_unit_price = $this->secure_database($package_unit_price); 
    $no_of_slots_bought = $this->secure_database($no_of_slots_bought); 
    $total_amount = $no_of_slots_bought * $package_unit_price; 
    $moratorium = $this->secure_database($moratorium); 
    $free_liquidation_period = $this->secure_database($free_liquidation_period); 
    $liquidation_surcharge = $this->secure_database($liquidation_surcharge); 
    $tenure_of_product = $this->secure_database($tenure_of_product); 
    $float_time = $this->secure_database($float_time); 
    $multiplying_factor = $this->secure_database($multiplying_factor); 
    $capital_refund = $this->secure_database($capital_refund); 
    $data = $user_id.$package_id;
    $unique_id = $this->unique_id_generator($data);

    //check wallet balance
    $getwallet = $this->get_wallet_balance($user_id);
    $decode_wallet = json_decode($getwallet,true);
    $wallet_balance = $decode_wallet['msg'];
    $get_wallet_status = $this->get_one_row_from_one_table('wallet_tbl', 'user_id', $user_id);
    $wallet_status = $get_wallet_status['wallet_status'];

    if($wallet_balance < $total_amount){
            return json_encode(["status"=>"0", "msg"=>"insufficient_wallet_balance"]);

    }else if($wallet_status == 0){
          return json_encode(["status"=>"0", "msg"=>"wallet_deactivated"]);
    }

    else{
        $get_lead = $this->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
        $check_lead_exist = $this->check_row_exists_by_one_param('leads','email',$get_lead['email']);
        if($check_lead_exist === true){
          $update_lead = $this->update_with_one_param('leads','email', $get_lead['email'],'classification','client');
        }
         $new_balance = $wallet_balance - $total_amount;
         $new_slot_bal = $available_slots - $no_of_slots_bought;
         

          ////update wallet balance
          $update_wallet_balance = $this->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_balance);

          ///update package slot
          $update_package_slot = $this->update_with_one_param('package_definition','unique_id',$package_id,'no_of_slots',$new_slot_bal);

           ///update package slot
          $update_investment_status = $this->update_with_one_param('users_tbl','unique_id',$user_id,'investment_status',1);

          ////debit history
          $insert_debit_wallet_tbl = $this->insert_subscription_to_a_package($user_id,$total_amount,$package_id);
          $insert_debit_wallet_tbl_decode = json_decode($insert_debit_wallet_tbl,true);
          if($insert_debit_wallet_tbl_decode['status'] == 0){
            return json_encode(["status"=>"0", "msg"=>"insert_debit_wallet_tbl_error"]);
          }

          ///insert into subscribe to package
           $insert_subscribed_packages = "INSERT INTO  subscribed_packages SET 
           `unique_id` = '$unique_id',
           `user_id` = '$user_id',
           `package_id` = '$package_id',
           `package_type` = '$package_type',
           `package_category` = '$package_category',
           `package_commission` = '$package_commission',
           `package_unit_price` = '$package_unit_price',
           `total_amount` = '$total_amount',
           `moratorium` = '$moratorium',
           `free_liquidation_period` = '$free_liquidation_period',
           `liquidation_surcharge` = '$liquidation_surcharge',
           `tenure_of_product` = '$tenure_of_product',
           `float_time` = '$float_time',
           `float_time_incremental` = '$float_time',
           `multiplying_factor` = '$multiplying_factor',
           `capital_refund` = '$capital_refund',
           `no_of_slots_bought` = '$no_of_slots_bought',
           `date_created` = now()";
           $query_insert = mysqli_query($this->connection, $insert_subscribed_packages);
           if($query_insert){
            return  json_encode(["status"=>"1", "msg"=>"successful_susbscription"]);
            }else{
            return  json_encode(["status"=>"0", "msg"=>"db_error"]);
            }

        }    



}



////////packages and categories code by sam ends
////////packages and categories code by sam ends
////////packages and categories code by sam ends
////////packages and categories code by sam ends
////////packages and categories code by sam ends
////////////from 01-04-2020 SAM ends here




//20-05-2020
function draft_agreement($user_id, $name_of_client, $package_bought, $product_of_interest, $special_consideration, $discount, $email, $phone, $home_address, $admin_id){

  $user_id = $this->secure_database($user_id);
  $admin_id = $this->secure_database($admin_id);
  $name_of_client = $this->secure_database($name_of_client);
  $home_address = $this->secure_database($home_address);
  $package_bought = $this->secure_database($package_bought);
    $product_of_interest = $this->secure_database($product_of_interest);
  $special_consideration = $this->secure_database($special_consideration);
  $discount = $this->secure_database($discount);
  $email = $this->secure_database($email);
  $phone = $this->secure_database($phone);
  $data = $name_of_client.$home_address.$name_of_client;
  $unique_id = $this->unique_id_generator($data);
  //$check = $this->check_row_exists_by_one_param('bank_accounts','account_number', $account_number);
  
  if($admin_id == '' || $name_of_client == '' || $home_address == '' || $package_bought == '' || $product_of_interest == '' || $special_consideration == '' || $email == '' || $phone == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }

  // if($check === true){
  //   return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  // }
  else{
    $inser_draft_agreement_sql = "INSERT INTO `draft_agreement` SET `unique_id` = '$unique_id', `user_id` = '$user_id',`name_of_client` = '$name_of_client', `added_by`='$admin_id', `home_address`='$home_address', `package_bought`='$package_bought', `product_of_interest`='$product_of_interest', `discount` = '$discount', `special_consideration` = '$special_consideration', `email`='$email', `phone`='$phone', `date_created` = now()";
         $inser_draft_agreement_query = mysqli_query($this->connection, $inser_draft_agreement_sql) or die(mysqli_error($this->connection));
         if($inser_draft_agreement_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}



///// TOSINS CODES ENDS



////////////from 01-04-2020 SAM starts here
   function create_basal_package($package_name,$package_type,$package_description,$package_category_id,$recurrence_value,$incubation_period,$package_unit_price,$moratorium,$free_liquidation_period,$liquidation_surcharge,$float_time,$capital_refund_type,$no_of_slots,$min_no_slots,$multiplying_factor,$basal_type,$tenure_of_product,$backdatable,$package_commission,$created_by,$visibility, $filename, $size, $tmpName,$type){
    $package_name = $this->secure_database($package_name);
    $package_type = $this->secure_database($package_type);
    $package_description = $this->secure_database($package_description);
    $package_category_id = $this->secure_database($package_category_id);
    $recurrence_value = $this->secure_database($recurrence_value);
    $incubation_period = $this->secure_database($incubation_period);
    $package_unit_price = $this->secure_database($package_unit_price);
    $moratorium = $this->secure_database($moratorium);
    $free_liquidation_period = $this->secure_database($free_liquidation_period);
    $liquidation_surcharge = $this->secure_database($liquidation_surcharge);
    $float_time = $this->secure_database($float_time);
    $capital_refund_type = $this->secure_database($capital_refund_type);
    $no_of_slots = $this->secure_database($no_of_slots);
    $multiplying_factor = $this->secure_database($multiplying_factor);
    $basal_type = $this->secure_database($basal_type);
    $min_no_slots = $this->secure_database($min_no_slots);
    // $min_tenure_days = $this->secure_database($min_tenure_days);
    $tenure_of_product = $this->secure_database($tenure_of_product);
    $backdatable = $this->secure_database($backdatable);
    $package_commission = $this->secure_database($package_commission);
    $created_by = $this->secure_database($created_by);
    $visibility = $this->secure_database($visibility);
 
    $filename = $this->secure_database($filename);
    $size = $this->secure_database($size);
    $tmpName = $this->secure_database($tmpName);
    $type = $this->secure_database($type);

    $data = $filename.$size.$package_name;
    $table = 'basal_package_tbl';
    $unique_id = $this->unique_id_generator($data);
    $image_url = $this->image_upload($filename, $size, $tmpName, $type);
    $check = $this->check_row_exists_by_one_param($table,'package_name',$package_name);
 
   
  
  if($package_name == "" || $package_type == "" || $package_description == ""  || $recurrence_value == "" || $image_url == "" || $incubation_period == "" || $package_unit_price == "" || $moratorium == "" || $free_liquidation_period == "" || $float_time == "" || $capital_refund_type == "" || $no_of_slots == "" || $multiplying_factor == ""|| $basal_type == "" || $tenure_of_product == "" || $backdatable == ""|| $package_commission == ""|| $created_by == "" || $visibility == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }
  // }
  // else if($no_of_month > $max_no_of_month){
  //   return  json_encode(["status"=>"0", "msg"=>"no_of_month_less_than_min"]);
  // }
  
 //  }else if($withdrawable_month < $no_of_month ||  $withdrawable_month > $max_no_of_month){
 //    return  json_encode(["status"=>"0", "msg"=>"no_of_month_less_than_min2"]);
 // }
  else{
        $imageurl_decode = json_decode($image_url,true);
        if($imageurl_decode['status'] == '1'){
              $imageurl2 = $imageurl_decode['msg'];
              $sql = "INSERT INTO `basal_package_tbl` SET 
              `package_name` = '$package_name',
              `unique_id` = '$unique_id',
              `package_type` = '$unique_id',
              `package_description` = '$package_description',
              `recurrence_value` = '$recurrence_value',
              `image_url` = '$image_url',
              `incubation_period` = '$incubation_period',
              `package_unit_price` = '$package_unit_price',
              `moratorium` = '$moratorium',
              `free_liquidation_period` = '$free_liquidation_period',
              `float_time` = '$float_time',
              `capital_refund_type` = '$capital_refund_type',
              `no_of_slots`='$no_of_slots',
              `multiplying_factor`='$multiplying_factor',
              `basal_type`='$basal_type',
              `tenure_of_product`='$tenure_of_product',
              `backdatable`='$backdatable',
              `package_commission`='$package_commission',
              `created_by`='$created_by',
              `visibility`='$visibility',
              `date_created` = now()";
              $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
              if($query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
        }else{
                return json_encode(["status"=>"0", "msg"=>$imageurl_decode['msg'] ]);
        }


      
  }
}

//////migration TOOL in August 2020  NOOOOTEEEE: simply logs withdrawals
function insert_withdrawals_and_net_from_wallet($userid,$amount,$purpose,$withdrawal_date,$desc){
    $userid = $this->secure_database($userid);
    $desc = $this->secure_database($desc);
    $amount = $this->secure_database($amount);
    $purpose = $this->secure_database($purpose);
    $withdrawal_date = $this->secure_database($withdrawal_date);
    $withdrawal_date2 = date("Y-m-d H:i:s",strtotime($withdrawal_date));
    $unique_id = $this->unique_id_generator("withdrawal");

    $sql = "INSERT into debit_wallet_tbl set
       `unique_id`='$unique_id',
       `user_id`='$userid',
       `amount_withdrawn`='$amount',
       `purpose`='$purpose',
       `package_id`='from_wallet',
       `withdrawal_status`='6',
       `description`= '$desc',
       `processing_status`='0',
       `date_created`='$withdrawal_date2'

       ";
    $query = mysqli_query($this->connection,$sql);
    
      ////update wallet
    $get_wallet_balance = $this->get_wallet_balance($userid);
    $gwb_decode = json_decode($get_wallet_balance,true);
    $currentbal = $gwb_decode['msg'];
    $newbal =  $currentbal - $amount;
    
    
    $sql_new_wall = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE `user_id`='$userid'";
    $qryupdatew = mysqli_query($this->connection,$sql_new_wall);
    
    if($query == true && $qryupdatew == true){
        return true;
    }else{
        return false;
    }
    
    
    
}

//////migration in april 2020 starts here: this NOOOOTEEEE: simply logs withdrawals and nets it from wallet...
function insert_withdrawals($userid,$amount,$purpose,$withdrawal_date,$desc){
    $userid = $this->secure_database($userid);
    $desc = $this->secure_database($desc);
    $amount = $this->secure_database($amount);
    $purpose = $this->secure_database($purpose);
    $withdrawal_date = $this->secure_database($withdrawal_date);
    $withdrawal_date2 = date("Y-m-d H:i:s",strtotime($withdrawal_date));
    $unique_id = $this->unique_id_generator("withdrawal");

    $sql = "INSERT into debit_wallet_tbl set
       `unique_id`='$unique_id',
       `user_id`='$userid',
       `amount_withdrawn`='$amount',
       `purpose`='$purpose',
       `package_id`='from_wallet',
       `withdrawal_status`='6',
       `description`= '$desc',
       `processing_status`='0',
       `date_created`='$withdrawal_date2'

       ";
       
       
    $query = mysqli_query($this->connection,$sql);
    if($query){
        return true;
    }else{
        return false;
    }
}


function insert_wallet_bal($userid,$balance_amount){
    $userid = $this->secure_database($userid);
    $balance_amount = $this->secure_database($balance_amount);
    $unique_id = $this->unique_id_generator("wallet_bal");
    $check = $this->get_one_row_from_one_table('wallet_tbl','user_id',$userid);
    if($check === null){
            $sql = "INSERT into wallet_tbl set
            `unique_id`='$unique_id',
            `user_id`='$userid',
            `balance`='$balance_amount',
            `date_created`= now()
            ";
            $query = mysqli_query($this->connection,$sql);
            if($query){
            return true;
            }else{
            return false;
            }

    } else{

         $sql = "UPDATE wallet_tbl set
            `balance`='$balance_amount' where `user_id`='$userid'
            ";
            $query = mysqli_query($this->connection,$sql);
            if($query){
            return true;
            }else{
            return false;
            }


    }

    
}




function credit_wallet_online_web($userid,$amount,$payment_method,$deposit_date,$purpose, $description,$refid,$transid){
    $unique_id = $this->unique_id_generator("deposits");
    //$trans_id = $this->unique_id_generator("deposits22");
    //$trans_id2 = "trans_".$trans_id;
    $userid = $this->secure_database($userid);
    $refid = $this->secure_database($refid);
    $description = $this->secure_database($description);
    $amount = $this->secure_database($amount);
    //$deposit_date = $this->secure_database($deposit_date);
    //$deposit_date2 = date("Y-m-d H:i:s",strtotime($deposit_date));
    $purpose = $this->secure_database($purpose);
    $payment_method = $this->secure_database($payment_method);

  //   if($payment_method == 'pactpay'){
  //       $payment_description = "Credited using PactPay";
  //   }

  //   if( $payment_method == 'paystack' ){
  //       $payment_description = "Credited using Paystack";
  //   }

  //   if( $payment_method == 'bank_transfer' ){
  //       $payment_description = "Credited using bank transfer";
  //   }

  //  if( $payment_method == 'cash_deposit' ){
  //       $payment_description = "Credited using cash deposit";
  //   }
    
  // if( $payment_method == 'conversion' ){
  //       $payment_description = "Credited using conversion method";
  //   }
  
  // if( $payment_method == 'flutter_rave' ){
  //       $payment_description = "Credited using flutterwave Rave";
  //   }
      
      ////insert into crdit tbl
    $sqloo = "INSERT into `credit_wallet_tbl` set
          `unique_id`='$unique_id',
          `user_id`='$userid',
          `amount`='$amount',
          `payment_type`='$payment_method',
          `payment_status`= 1,
          `txn_ref`='$refid',
          `transaction_id`='$transid',
          `description`='$description',
          `date_created`= '$deposit_date'
          ";
    $query = mysqli_query($this->connection,$sqloo);
            
    ////update wallet
    $get_wallet_balance = $this->get_wallet_balance($userid);
    $gwb_decode = json_decode($get_wallet_balance,true);
    $currentbal = $gwb_decode['msg'];
    $newbal =  $currentbal + $amount;
    $sql_new_wall = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE `user_id`='$userid'";
    $qryupdatew = mysqli_query($this->connection,$sql_new_wall);
    
    if($query){
      ///insert into transaction table
      //11 -  crediting --- bankacct to wallet confirmed
      $sql2 = "INSERT into debit_wallet_tbl set
      `unique_id`='$unique_id',
      `user_id`='$userid',
      `amount_withdrawn`='$amount',
      `purpose`='$purpose',
      `package_id`='from_bank_account',
      `withdrawal_status`='1',
      `processing_status`='0',
      `date_created`='$deposit_date'

      ";
      $query2 = mysqli_query($this->connection,$sql2);
      if($query2){
            
             return json_encode(['status'=>1,'msg'=>'success']); 
            
      }else{
      
            return json_encode(['status'=>0,'msg'=>'credit1_error']); 
      
      }

    }else{
             
             return json_encode(['status'=>0,'msg'=>'credit2_error']);
             
    }

 
}



//cron to verify payments
function cron_verify_payments(){
    // global $dbc;
    
    $sql = "SELECT * FROM `verify_flutter_payments` WHERE `process_status`=2  AND `conversion_status`=0 ";
    $qry = mysqli_query($this->connection,$sql);
    $num_count = mysqli_num_rows($qry);
    if($num_count > 0){
            while($row = mysqli_fetch_array($qry)){

            $unique_id = $row['unique_id'];
            $transaction_id = intval($row['transaction_id']);
            $refid = $row['our_ref'];
            $user_id = $row['user_id'];
            $email = $row['email'];
            $deposit_date = $row['date_created'];
            $description = "Credited using flutterwave Rave";
            $purpose = 11;
            $payment_method = "flutter_rave";
            $secret_key = 'FLWSECK-c0e8df77117baadceda4ec7df7ca5fb2-X';


            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/".$transaction_id ."/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$secret_key
            )
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $payment_response_amount = json_decode($response, true)['data']['amount'];           
            //$user_id = json_decode($response, true)['data']['meta']['userid'];  
            // $resp_stat = json_decode($response, true)['data']['status'];           
            
            $resp_stat = json_decode($response, true)['status'];

           // echo $response.'ppp<br>';

          
          
            // if($resp_stat == "success"){

            ///call the wallet update function
            $credit_wallet_online_web = $this->credit_wallet_online_web($user_id,$payment_response_amount,$payment_method,$deposit_date,$purpose,$description,$refid,$transaction_id);
            $cre_dec = json_decode($credit_wallet_online_web,true);
            if($cre_dec['status'] == 1){
           

            $sql_update = "UPDATE `verify_flutter_payments` SET `conversion_status`=1 WHERE `unique_id`='$unique_id'";
            $qry_update = mysqli_query($this->connection,$sql_update) or die(mysqli_error($this->connection));

            $get_user_email =  $this->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
            $email = $get_user_email['email'];

            $subject = "Wallet was Credited Succesfully";
            $content = "Your wallet was succesfully credited using flutterwave.";   
            $emailf  = $this->email_function($email, $subject, $content);
            echo $emailf;
            $notf  = $this->insert_into_notifications_tbl("Wallet Crediting", $user_id, "Wallet Crediting" ,"Your wallet was successfully credited");
            echo $notf;
            $userslogf  = $this->insert_users_logs($user_id, 'Credited Wallet using Flutterwave Rave');
            echo $userslogf;

             echo "Correct::::<br>";


            }else{
            //bad
            echo $cred_dec['msg'].'<br>';
            }

            // }
            
            // else{
            // echo "error: No Update Happened. Check Flutterwave".$unique_id."<br>";

            // }
        


            }


           
        
       

    } else{
                    echo "notif: No record foundd.<br>";

    }
}



function cron_verify_paymentsBACKUP(){
    // global $dbc;
    $sql = "SELECT * FROM `verify_flutter_payments` WHERE `process_status`=2  AND `conversion_status`=0 ";
    $qry = mysqli_query($this->connection,$sql);
    $num_count = mysqli_num_rows($qry);
    if($num_count > 0){
            while($row = mysqli_fetch_array($qry)){

            $unique_id = $row['unique_id'];
            $transaction_id = intval($row['transaction_id']);
            $refid = $row['our_ref'];
            $user_id = $row['user_id'];
            $email = $row['email'];
            $deposit_date = $row['date_created'];
            $description = "Credited using flutterwave Rave";
            $purpose = 11;
            $payment_method = "flutter_rave";
            $secret_key = 'FLWSECK-c0e8df77117baadceda4ec7df7ca5fb2-X';


            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/".$transaction_id ."/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$secret_key
            )
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $payment_response_amount = json_decode($response, true)['data']['amount'];           
            //$user_id = json_decode($response, true)['data']['meta']['userid'];  
            // $resp_stat = json_decode($response, true)['data']['status'];           
            
            $resp_stat = json_decode($response, true)['status'];

           // echo $response.'ppp<br>';

            if($resp_stat == "success"){

            ///call the wallet update function
            $credit_wallet_online_web = $this->credit_wallet_online_web($user_id,$payment_response_amount,$payment_method,$deposit_date,$purpose,$description,$refid,$transaction_id);
            $cre_dec = json_decode($credit_wallet_online_web,true);
            if($cre_dec['status'] == 1){
           

            $sql_update = "UPDATE `verify_flutter_payments` SET `conversion_status`=1 WHERE `unique_id`='$unique_id'";
            $qry_update = mysqli_query($this->connection,$sql_update) or die(mysqli_error($this->connection));

            $get_user_email =  $this->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
            $email = $get_user_email['email'];

            $subject = "Wallet was Credited Succesfully";
            $content = "Your wallet was succesfully credited using flutterwave.";   
            $emailf  = $this->email_function($email, $subject, $content);
            echo $emailf;
            $notf  = $this->insert_into_notifications_tbl("Wallet Crediting", $user_id, "Wallet Crediting" ,"Your wallet was successfully credited");
            echo $notf;
            $userslogf  = $this->insert_users_logs($user_id, 'Credited Wallet using Flutterwave Rave');
            echo $userslogf;

             echo "Correct::::<br>";


            }else{
            //bad
            echo $cred_dec['msg'].'<br>';
            }

            }else{
            echo "error: No Update Happened. Check Flutterwave".$unique_id."<br>";

            }
        


            }


           
        
       

    } else{
                    echo "notif: No record foundd.<br>";

    }
}



function cron_verify_payments_wrong_transid(){
    // global $dbc;
    $sql = "SELECT * FROM `verify_flutter_payments` WHERE `process_status`=2  AND `conversion_status`=0 ";
    $qry = mysqli_query($this->connection,$sql);
    $num_count = mysqli_num_rows($qry);
    if($num_count > 0){
            while($row = mysqli_fetch_array($qry)){

            $unique_id = $row['unique_id'];
            $transaction_id = intval($row['transaction_id']);
            $refid = $row['our_ref'];
            $user_id = $row['user_id'];
            $email = $row['email'];
            $deposit_date = $row['date_created'];
            $description = "Credited using flutterwave Rave";
            $purpose = 11;
            $payment_method = "flutter_rave";
            $secret_key = 'FLWSECK-c0e8df77117baadceda4ec7df7ca5fb2-X';


            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/".$transaction_id ."/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$secret_key
            )
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $payment_response_amount = json_decode($response, true)['data']['amount'];           
            //$user_id = json_decode($response, true)['data']['meta']['userid'];  
            // $resp_stat = json_decode($response, true)['data']['status'];           
            
            $resp_stat = json_decode($response, true)['status'];

           // echo $response.'ppp<br>';

            if($resp_stat != "success"){

            ///call the wallet update function
            $credit_wallet_online_web = $this->credit_wallet_online_web($user_id,$payment_response_amount,$payment_method,$deposit_date,$purpose,$description,$refid,$transaction_id);
            $cre_dec = json_decode($credit_wallet_online_web,true);
            if($cre_dec['status'] == 1){
           

            $sql_update = "UPDATE `verify_flutter_payments` SET `conversion_status`=1 WHERE `unique_id`='$unique_id'";
            $qry_update = mysqli_query($this->connection,$sql_update) or die(mysqli_error($this->connection));

            $get_user_email =  $this->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
            $email = $get_user_email['email'];

            $subject = "Wallet was Credited Succesfully";
            $content = "Your wallet was succesfully credited using flutterwave.";   
            $emailf  = $this->email_function($email, $subject, $content);
            echo $emailf;
            $notf  = $this->insert_into_notifications_tbl("Wallet Crediting", $user_id, "Wallet Crediting" ,"Your wallet was successfully credited");
            echo $notf;
            $userslogf  = $this->insert_users_logs($user_id, 'Credited Wallet using Flutterwave Rave');
            echo $userslogf;

             echo "Correct::::<br>";


            }else{
            //bad
            echo $cred_dec['msg'].'<br>';
            }

            }else{
            echo "error: No Update Happened. Check Flutterwave".$unique_id."<br>";

            }
        


            }


           
        
       

    } else{
                    echo "notif: No record foundd.<br>";

    }
}


//on flutter callback WEB
function submit_flutter_payment($process_status,$transaction_id,$our_ref){
  $unique_id = $this->unique_id_generator('depositthing'.rand(22222,99999));
  
    $secret_key = 'FLWSECK-c0e8df77117baadceda4ec7df7ca5fb2-X';
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/".$transaction_id ."/verify",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer ".$secret_key
    )
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    $payment_response_amount = json_decode($response, true)['data']['amount'];
    $user_id = json_decode($response, true)['data']['meta']['userid'];

    $get_user_email =  $this->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
    $email = $get_user_email['email'];


  ///check if txn id exists
    $check_ref_id = $this->check_row_exists_by_one_param('verify_flutter_payments', 'our_ref', $our_ref);
    $check_txn_id = $this->check_row_exists_by_one_param('verify_flutter_payments', 'transaction_id', $transaction_id);
    $check_txn_two_para = $this->check_row_exists_by_two_params('verify_flutter_payments','our_ref',$our_ref,'transaction_id',$transaction_id);


    if($check_ref_id){
          return json_encode(['status'=>0, 'msg'=>'This transaction exists1']); 
    }else if($check_txn_id){
          return json_encode(['status'=>0, 'msg'=>'This transaction exists2']); 
    }else if($check_txn_two_para){
          return json_encode(['status'=>0, 'msg'=>'This transaction exists3']); 
    }

    else{
          $sql = "INSERT INTO `verify_flutter_payments` SET 
          `unique_id`='$unique_id',
          `user_id`='$user_id',
          `email`='$email',
          `amount`='$payment_response_amount',
          `channel`='web',
          `process_status`='$process_status',
          `conversion_status` = 0,
          `transaction_id`='$transaction_id',
          `our_ref`='$our_ref',
          `date_created`=now()
          ";
          $qry = mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
          if($qry){
          return json_encode(['status'=>1, 'msg'=>'success']); 
          }else{
          return json_encode(['status'=>0,'msg'=>'credit1_error']); 
          }

    }


 
}

/////mobile via api
function submit_flutter_payment_mobile($user_id,$transaction_id,$amount){
    $unique_id = $this->unique_id_generator('depositthing'.rand(22222,99999));
    $our_ref = $this->unique_id_generator('deposittnioooo'.rand(44444,88888));
    $process_status = 2; ///indicates successful payment
    
    $get_user_email =  $this->get_one_row_from_one_table('users_tbl','unique_id',$user_id);
    $email = $get_user_email['email'];
   
  ///check if txn id exists
    $check_ref_id = $this->check_row_exists_by_one_param('verify_flutter_payments', 'our_ref', $our_ref);
    $check_txn_id = $this->check_row_exists_by_one_param('verify_flutter_payments', 'transaction_id', $transaction_id);
    $check_txn_two_para = $this->check_row_exists_by_two_params('verify_flutter_payments','our_ref',$our_ref,'transaction_id',$transaction_id);


    if($check_ref_id){
          return json_encode(['status'=>0, 'msg'=>'This generated id exsits']); 
    }else if($check_txn_id){
          return json_encode(['status'=>0, 'msg'=>'This flutter transaction id exists']); 
    }else if($check_txn_two_para){
          return json_encode(['status'=>0, 'msg'=>'This transaction exists-- both generated id and flutter id']); 
    }

    else{
          $sql = "INSERT INTO `verify_flutter_payments` SET 
          `unique_id`='$unique_id',
          `user_id`='$user_id',
          `email`='$email',
          `channel`='mobile',
          `amount`='$amount',
          `process_status`='$process_status',
          `conversion_status` = 0,
          `transaction_id`='$transaction_id',
          `our_ref`='$our_ref',
          `date_created`=now()
          ";
          $qry = mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
          if($qry){
          return json_encode(['status'=>1, 'msg'=>'Transaction was successfully logged']); 
          }else{
          return json_encode(['status'=>0,'msg'=>'credit1_error']); 
          }

    }
}



function credit_wallet_online($userid,$amount,$payment_method,$deposit_date,$purpose, $description,$refid,$transid){
    $unique_id = $this->unique_id_generator("deposits");
    $trans_id = $this->unique_id_generator("deposits22");
    $trans_id2 = "trans_".$trans_id;
    $userid = $this->secure_database($userid);
    $refid = $this->secure_database($refid);
    $description = $this->secure_database($description);
    $amount = $this->secure_database($amount);
    $deposit_date = $this->secure_database($deposit_date);
    $deposit_date2 = date("Y-m-d H:i:s",strtotime($deposit_date));
    $purpose = $this->secure_database($purpose);
    $payment_method = $this->secure_database($payment_method);

  //   if($payment_method == 'pactpay'){
  //       $payment_description = "Credited using PactPay";
  //   }

  //   if( $payment_method == 'paystack' ){
  //       $payment_description = "Credited using Paystack";
  //   }

  //   if( $payment_method == 'bank_transfer' ){
  //       $payment_description = "Credited using bank transfer";
  //   }

  //  if( $payment_method == 'cash_deposit' ){
  //       $payment_description = "Credited using cash deposit";
  //   }
    
  // if( $payment_method == 'conversion' ){
  //       $payment_description = "Credited using conversion method";
  //   }
  
  // if( $payment_method == 'flutter_rave' ){
  //       $payment_description = "Credited using flutterwave Rave";
  //   }
      
      ////insert into crdit tbl
    $sqloo = "INSERT into credit_wallet_tbl set
          `unique_id`='$unique_id',
          `user_id`='$userid',
          `amount`='$amount',
          `payment_type`='$payment_method',
          `payment_status`= 1,
          `txn_ref`='$refid',
          `transaction_id`='$transid',
          `description`='$description',
          `date_created`= '$deposit_date2'
          ";
    $query = mysqli_query($this->connection,$sqloo);
            
    ////update wallet
    $get_wallet_balance = $this->get_wallet_balance($userid);
    $gwb_decode = json_decode($get_wallet_balance,true);
    $currentbal = $gwb_decode['msg'];
    $newbal =  $currentbal + $amount;
    $sql_new_wall = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE `user_id`='$userid'";
    $qryupdatew = mysqli_query($this->connection,$sql_new_wall);
    
            
            
    if($query){
      ///insert into transaction table
      //11 -  crediting --- bankacct to wallet confirmed
      $sql2 = "INSERT into debit_wallet_tbl set
      `unique_id`='$unique_id',
      `user_id`='$userid',
      `amount_withdrawn`='$amount',
      `purpose`='$purpose',
      `package_id`='from_bank_account',
      `withdrawal_status`='1',
      `processing_status`='0',
      `date_created`='$deposit_date2'

      ";
      $query2 = mysqli_query($this->connection,$sql2);
      if($query2){
            
             return json_encode(['status'=>1,'msg'=>'success']); 
            
      }else{
      
            return json_encode(['status'=>0,'msg'=>'credit1_error']); 
      
      }

    }else{
             
             return json_encode(['status'=>0,'msg'=>'credit2_error']);
             
    }

 
}


function insert_deposits($userid,$amount,$payment_method,$deposit_date,$purpose, $description){
    $unique_id = $this->unique_id_generator("deposits");
    $trans_id = $this->unique_id_generator("deposits");
    $trans_id2 = "trans_".$trans_id;
    $userid = $this->secure_database($userid);
    $description = $this->secure_database($description);
    $amount = $this->secure_database($amount);
    $deposit_date = $this->secure_database($deposit_date);
    $deposit_date2 = date("Y-m-d H:i:s",strtotime($deposit_date));
    $purpose = $this->secure_database($purpose);
    $payment_method = $this->secure_database($payment_method);

  //   if($payment_method == 'pactpay'){
  //       $payment_description = "Credited using PactPay";
  //   }

  //   if( $payment_method == 'paystack' ){
  //       $payment_description = "Credited using Paystack";
  //   }

  //   if( $payment_method == 'bank_transfer' ){
  //       $payment_description = "Credited using bank transfer";
  //   }

  //  if( $payment_method == 'cash_deposit' ){
  //       $payment_description = "Credited using cash deposit";
  //   }
    
  // if( $payment_method == 'conversion' ){
  //       $payment_description = "Credited using conversion method";
  //   }
  
  // if( $payment_method == 'flutter_rave' ){
  //       $payment_description = "Credited using flutterwave Rave";
  //   }
      
      ////insert into crdit tbl
    $sqloo = "INSERT into credit_wallet_tbl set
          `unique_id`='$unique_id',
          `user_id`='$userid',
          `amount`='$amount',
          `payment_status`=1,
          `payment_type`='$payment_method',
          `txn_ref`='$trans_id2',
          `description`='$description',
          `date_created`= '$deposit_date2'
          ";
    $query = mysqli_query($this->connection,$sqloo);
            
    ////update wallet
    $get_wallet_balance = $this->get_wallet_balance($userid);
    $gwb_decode = json_decode($get_wallet_balance,true);
    $currentbal = $gwb_decode['msg'];
    $newbal =  $currentbal + $amount;
    $sql_new_wall = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE `user_id`='$userid'";
    $qryupdatew = mysqli_query($this->connection,$sql_new_wall);
    
            
            
    if($query){
      ///insert into transaction table
      //11 -  crediting --- bankacct to wallet confirmed
      $sql2 = "INSERT into debit_wallet_tbl set
      `unique_id`='$unique_id',
      `user_id`='$userid',
      `amount_withdrawn`='$amount',
      `purpose`='$purpose',
      `package_id`='from_bank_account',
      `withdrawal_status`='1',
      `processing_status`='0',
      `date_created`='$deposit_date2'

      ";
      $query2 = mysqli_query($this->connection,$sql2);
      if($query2){
      return true;
      }else{
      return false;
      }

    }else{
    return false;
    }

 
}


function insert_deposits_unactivated($userid,$amount,$payment_method,$deposit_date,$purpose, $description){
    $unique_id = $this->unique_id_generator("deposits");
    $trans_id = $this->unique_id_generator("deposits");
    $trans_id2 = "trans_".$trans_id;
    $userid = $this->secure_database($userid);
    $description = $this->secure_database($description);
    $amount = $this->secure_database($amount);
    $deposit_date = $this->secure_database($deposit_date);
    $deposit_date2 = date("Y-m-d H:i:s",strtotime($deposit_date));
    $purpose = $this->secure_database($purpose);
    $payment_method = $this->secure_database($payment_method);
    $check_if_wallet_exist = $this->check_row_exists_by_one_param('wallet_tbl','user_id',$userid);
    if($check_if_wallet_exist === false){
         $data = rand().$userid;
         $unique_id = $this->unique_id_generator($data);
         $insert_wallet_sql = "INSERT INTO `wallet_tbl` SET `unique_id` = '$unique_id',`balance` = 0, `user_id`='$userid', `date_created` = now()";
         $insert_wallet_query = mysqli_query($this->connection,$insert_wallet_sql);
        if($insert_wallet_query){
               ////insert into crdit tbl
          $sqloo = "INSERT into credit_wallet_tbl set
                `unique_id`='$unique_id',
                `user_id`='$userid',
                `amount`='$amount',
                `payment_status`=1,
                `payment_type`='$payment_method',
                `txn_ref`='$trans_id2',
                `description`='$description',
                `date_created`= '$deposit_date2'
                ";
          $query = mysqli_query($this->connection,$sqloo);
                  
          ////update wallet
          $get_wallet_balance = $this->get_wallet_balance($userid);
          $gwb_decode = json_decode($get_wallet_balance,true);
          $currentbal = $gwb_decode['msg'];
          $newbal =  $currentbal + $amount;
          $sql_new_wall = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE `user_id`='$userid'";
          $qryupdatew = mysqli_query($this->connection,$sql_new_wall);
          
                  
                  
          if($query){
            ///insert into transaction table
            //11 -  crediting --- bankacct to wallet confirmed
            $sql2 = "INSERT into debit_wallet_tbl set
            `unique_id`='$unique_id',
            `user_id`='$userid',
            `amount_withdrawn`='$amount',
            `purpose`='$purpose',
            `package_id`='from_bank_account',
            `withdrawal_status`='1',
            `processing_status`='0',
            `date_created`='$deposit_date2'

            ";
            $query2 = mysqli_query($this->connection,$sql2);
            if($query2){
            return true;
            }else{
            return false;
            }

          }else{
          return false;
          }
        }
        else{
          return false;
        }
    }     
          ////insert into crdit tbl
    $sqloo = "INSERT into credit_wallet_tbl set
          `unique_id`='$unique_id',
          `user_id`='$userid',
          `amount`='$amount',
          `payment_status`=1,
          `payment_type`='$payment_method',
          `txn_ref`='$trans_id2',
          `description`='$description',
          `date_created`= '$deposit_date2'
          ";
    $query = mysqli_query($this->connection,$sqloo);
            
    ////update wallet
    $get_wallet_balance = $this->get_wallet_balance($userid);
    $gwb_decode = json_decode($get_wallet_balance,true);
    $currentbal = $gwb_decode['msg'];
    $newbal =  $currentbal + $amount;
    $sql_new_wall = "UPDATE `wallet_tbl` SET `balance`='$newbal' WHERE `user_id`='$userid'";
    $qryupdatew = mysqli_query($this->connection,$sql_new_wall);
    
            
            
    if($query){
      ///insert into transaction table
      //11 -  crediting --- bankacct to wallet confirmed
      $sql2 = "INSERT into debit_wallet_tbl set
      `unique_id`='$unique_id',
      `user_id`='$userid',
      `amount_withdrawn`='$amount',
      `purpose`='$purpose',
      `package_id`='from_bank_account',
      `withdrawal_status`='1',
      `processing_status`='0',
      `date_created`='$deposit_date2'

      ";
      $query2 = mysqli_query($this->connection,$sql2);
      if($query2){
      return true;
      }else{
      return false;
      }

    }else{
    return false;
    }
 
}




///for now unique id contradiction--will figure that out later
function insert_tranfers($senderid,$beneficiary_id,$amount,$transfer_date){
    $unique_id = $this->unique_id_generator("transfers");
   
    $senderid = $this->secure_database($senderid);
    $beneficiary_id = $this->secure_database($beneficiary_id);
    $amount = $this->secure_database($amount);
    $transfer_date = $this->secure_database($transfer_date);
    $transfer_date2 = date("Y-m-d H:i:s",strtotime($transfer_date));
  
      
      ////insert into crdit tbl
      $sql = "INSERT into transfer_log set
            `unique_id`='$unique_id',
            `sender_id`='$senderid',
            `beneficiary_id`='$beneficiary_id',
            `amount_sent`='$amount',
            `transfer_status`='1',
            `processing_status`='2',
            `date_created`= '$transfer_date2'
            ";
            $query = mysqli_query($this->connection,$sql);
            if($query){
                    ///insert into transaction table
              //11 -  crediting --- bankacct to wallet confirmed
          
                    $sql_insert_transaction_sender = "INSERT into debit_wallet_tbl set
                    `unique_id`='$unique_id',
                    `user_id`='$senderid',
                    `amount_withdrawn`='$amount',
                    `purpose`='15',
                    `package_id`='from_wallet_to_wallet',
                    `withdrawal_status`='1',
                    `processing_status`='0',
                    `date_created`='$transfer_date2'

                    ";
              $query_insert_transaction_sender = mysqli_query($this->connection,$sql_insert_transaction_sender);


               $sql_insert_transaction_receiver = "INSERT into debit_wallet_tbl set
                    `unique_id`='$unique_id',
                    `user_id`='$beneficiary_id',
                    `amount_withdrawn`='$amount',
                    `purpose`='18',
                    `package_id`='from_wallet_to_wallet',
                    `withdrawal_status`='1',
                    `processing_status`='0',
                    `date_created`='$transfer_date2'

                    ";
              $query_insert_transaction_receiver  = mysqli_query($this->connection,$sql_insert_transaction_receiver);


                    if($query_insert_transaction_sender != false && $query_insert_transaction_receiver != false ){
                    return true;
                    }else{
                    return false;
                    }

            }else{
            return false;
            }

 
}



function compute_fixed_package_algo_old_investments($user_id,$unit_price,$slots_bought,$start_date,$no_of_days,$mf){
     $user_id = $this->secure_database($user_id);
     $unit_price = $this->secure_database($unit_price);
     $slots_bought = $this->secure_database($slots_bought);
     $start_date = $this->secure_database($start_date);
     $start_date2 = date("Y-m-d H:i:s",strtotime($start_date));
     $no_of_days = $this->secure_database($no_of_days);
     $mf = $this->secure_database($mf);
     $new_unit_price = $slots_bought * $unit_price;
     $msg = "";
     $profit_and_investment = 0;
     $current_date = date('Y-m-d');
       $msg = "<strong>Investment Amount: ".number_format($new_unit_price)."&nbsp; Investment Date: ".$start_date."</strong><br>";
     for($i = 1; $i <= $no_of_days; $i++){
           $next_date =  date('Y-m-d' ,strtotime("+".$i." day", strtotime($start_date)));
           $profit_only = ($new_unit_price * $mf);
           $profit_cumulative = ($new_unit_price * $mf * $i);
           $profit_and_investment = $new_unit_price + $profit_cumulative;
         
         if($next_date == $current_date){
           $msg .= 'TODAY:   Day '. $i. ' Profit: &#8358;'. number_format($profit_only,2).' Total Profit So Far: <span class="btn btn-sm btn-success">&#8358;'.number_format($profit_cumulative,2).'</span>  ::: Total Profit and Investment So Far: <span class="btn btn-sm btn-success">&#8358;'.number_format($profit_and_investment,2).'</span>:::: Date: '.$next_date.'<br>';
         }else{
           $msg .= 'Day '. $i. ' Profit: &#8358;'. number_format($profit_only,2).' Total Profit: &#8358;'.number_format($profit_cumulative,2).'  ::: Profit and Investment: &#8358;'.number_format($profit_and_investment,2).':::: Date: '.$next_date.'<br>';
         } 
         
          


     }

     return $msg;


}


function compute_contributory_package_algo_old_investments_no_mf_change($user_id,$unit_price,$slots_bought,$start_date,$no_of_days,$mf){
     $user_id = $this->secure_database($user_id);
     $unit_price = $this->secure_database($unit_price);
     $slots_bought = $this->secure_database($slots_bought);
   
     $start_date = $this->secure_database($start_date);
     $start_date2 = date("Y-m-d H:i:s",strtotime($start_date));
     $no_of_days = $this->secure_database($no_of_days);
     $mf = $this->secure_database($mf);
     $new_unit_price = $slots_bought * $unit_price ;
     $msg = "";
     $profit_and_investment = 0;
     $current_date = date('Y-m-d');
     $gross_profit = 0;
       $msg = "<strong>Daily Investment Amount: ".number_format($new_unit_price)."&nbsp; Investment Date: ".$start_date."</strong><br>";
     for($i = 1; $i <= $no_of_days; $i++){
          
    

               $next_date =  date('Y-m-d' ,strtotime("+".$i." day", strtotime($start_date)));
              $profit_only = strval($new_unit_price  * $mf);
              $profit_cumulative = ($new_unit_price * $i * $mf );
              $profit_and_investment = ($new_unit_price * $i) + $profit_cumulative;

              if($next_date == $current_date){
              $msg .= 'TODAY:   Day '. $i. ' Profit: &#8358;'. number_format($profit_only,2).' Total Profit So Far: <span class="btn btn-sm btn-success">&#8358;'.number_format($profit_cumulative).'</span>  ::: Total Profit and Investment So Far: <span class="btn btn-sm btn-success">&#8358;'.number_format($profit_and_investment).'</span>:::: Date: '.$next_date.'<br>';
              }else{
              $msg .= 'Day '. $i. ' Profit: &#8358;'. number_format($profit_only,2).' Total Profit: &#8358;'.number_format($profit_cumulative).'  ::: Profit and Investment: &#8358;'.number_format($profit_and_investment,2).':::: Date: '.$next_date.'<br>';
              } 
          
            $gross_profit += $profit_cumulative;
      
         
      

     }
           $msg .= "<strong>Accrued Profit: ".number_format($gross_profit,2)."</strong><br>";

     return $msg;




}




function compute_contributory_package_algo_old_investments_with_mf_change($user_id,$unit_price,$slots_bought,$start_date,$no_of_days,$mf,$day_interval_for_change,$mf_increase_by){
     $user_id = $this->secure_database($user_id);
     $unit_price = $this->secure_database($unit_price);
     $slots_bought = $this->secure_database($slots_bought);
     $day_interval_for_change = $this->secure_database($day_interval_for_change);
     $mf_increase_by = $this->secure_database($mf_increase_by);
     $start_date = $this->secure_database($start_date);
     $start_date2 = date("Y-m-d H:i:s",strtotime($start_date));
     $no_of_days = $this->secure_database($no_of_days);
     $mf = $this->secure_database($mf);
     $new_unit_price = $slots_bought * $unit_price ;
     $msg = "";
     $profit_and_investment = 0;
     $current_date = date('Y-m-d');
       $msg = "<strong>Daily Investment Amount: ".number_format($new_unit_price)."&nbsp; Investment Date: ".$start_date."</strong><br>";
     for($i = 1; $i <= $no_of_days; $i++){
          
          if(  $i > $day_interval_for_change ){
              //$mf = $mf * $mf_increase_by;
               $next_date =  date('Y-m-d' ,strtotime("+".$i." day", strtotime($start_date)));
              $profit_only = floatval($new_unit_price  * $mf * $mf_increase_by);
              $profit_cumulative = ($new_unit_price * $mf * $mf_increase_by * $i);
              $profit_and_investment = ($new_unit_price * $i)  + $profit_cumulative;

              if($next_date == $current_date){
              $msg .= 'TODAY:   Day '. $i. ' Profit: &#8358;'. number_format($profit_only,2).' Total Profit So Far: <span class="btn btn-sm btn-success">&#8358;'.number_format($profit_cumulative).'</span>  ::: Total Profit and Investment So Far: <span class="btn btn-sm btn-success">&#8358;'.number_format($profit_and_investment,2).'</span>:::: Date: '.$next_date.'<br>';
              }else{
              $msg .= 'Day '. $i. ' Profit: &#8358;'. number_format($profit_only,2).' Total Profit: &#8358;'.number_format($profit_cumulative,2).'  ::: Profit and Investment: &#8358;'.number_format($profit_and_investment,2).':::: Date: '.$next_date.'<br>';
              } 

          }else{

               $next_date =  date('Y-m-d' ,strtotime("+".$i." day", strtotime($start_date)));
              $profit_only = ($new_unit_price  * $mf);
              $profit_cumulative = ($new_unit_price * $mf * $i);
              $profit_and_investment = ($new_unit_price * $i) + $profit_cumulative;

              if($next_date == $current_date){
              $msg .= 'TODAY:   Day '. $i. ' Profit: &#8358;'. number_format($profit_only,2).' Total Profit So Far: <span class="btn btn-sm btn-success">&#8358;'.number_format($profit_cumulative).'</span>  ::: Total Profit and Investment So Far: <span class="btn btn-sm btn-success">&#8358;'.number_format($profit_and_investment,2).'</span>:::: Date: '.$next_date.'<br>';
              }else{
              $msg .= 'Day '. $i. ' Profit: &#8358;'. number_format($profit_only,2).' Total Profit: &#8358;'.number_format($profit_cumulative).'  ::: Profit and Investment: &#8358;'.number_format($profit_and_investment,2).':::: Date: '.$next_date.'<br>';
              } 
          }
             
          

         $gross_profit += $profit_cumulative;
         $gross_profit_plus_investment += $profit_and_investment;
      
         
      

     }
           $msg .= "<strong>Accrued Profit: ".number_format($gross_profit,2)."::::: </strong><br>";


}




// function move_profits(){
  
// }



////////sam starts
function get_page_access($role_id){

    $page_url =  basename($_SERVER['PHP_SELF']);
    if(substr($page_url, -4) == '.php' ){ $page_slug =  rtrim($page_url,substr($page_url, -4) );  }
    else{ $page_slug =  rtrim($page_url,substr($page_url, -4) );  }
   

    $found = 0;
    $user_role_pages = $this->get_rows_from_table_by_user_id('page_role_rights','role_id',$role_id);
    foreach ($user_role_pages as $key => $value) {
      $valllss = json_decode($value['page_id']);
     for ($i=0; $i < count($valllss); $i++) { 
      // echo "<br>";
      //   echo $valllss[$i];
          $each_page_slug = $this->get_one_row_from_one_table('site_pages','id',$valllss[$i]);
          $each_page_slug = $each_page_slug['page_slug'];
          if($each_page_slug == $page_slug){
          $found++;
          }
        }
}
    if($found == 0){
      return ['status'=>0,'msg'=>'no_access'];
    }else{
      return ['status'=>1,'msg'=>'access'];

    }


}



/////////19th march after last review
function my_latest_withdrawal($user_id){
    $user_id = $this->secure_database($user_id);
    $sql = "SELECT `amount_withdrawn` from debit_wallet_tbl where `user_id`='$user_id' and `purpose`=7 order by date_created desc limit 1";
    $query = mysqli_query($this->connection,$sql);
     if($query){
      $row = mysqli_fetch_array($query);
      return json_encode(['status'=>1,'msg'=>$row['amount_withdrawn']]);       
     }else{
      return json_encode(['status'=>0,'msg'=>0]);
     }
}

function my_total_withdrawal($user_id){
    $user_id = $this->secure_database($user_id);
    $sql = "SELECT sum(amount_withdrawn) as sum from debit_wallet_tbl where `user_id`='$user_id' and `purpose`=7";
    $query = mysqli_query($this->connection,$sql);
     if($query){
      $row = mysqli_fetch_array($query);
      return json_encode(['status'=>1,'msg'=>$row['sum']]);       
     }else{
      return json_encode(['status'=>0,'msg'=>0]);
     }
}

///deposit from bank accoutn to wallert
function my_latest_deposit($user_id){
    $user_id = $this->secure_database($user_id);
    $sql = "SELECT `amount` from credit_wallet_tbl where `user_id`='$user_id' order by date_created desc limit 1";
    $query = mysqli_query($this->connection,$sql);
     if($query){
      $row = mysqli_fetch_array($query);
      return json_encode(['status'=>1,'msg'=>$row['amount']]);       
     }else{
      return json_encode(['status'=>0,'msg'=>0]);
     }
}

function my_total_deposit($user_id){
    $user_id = $this->secure_database($user_id);
    $sql = "SELECT sum(amount) as sum from credit_wallet_tbl where `user_id`='$user_id'";
    $query = mysqli_query($this->connection,$sql);
     if($query){
      $row = mysqli_fetch_array($query);
      return json_encode(['status'=>1,'msg'=>$row['sum']]);       
     }else{
      return json_encode(['status'=>0,'msg'=>0]);
     }
}
 

 function my_withdrawal_requests($user_id){
    $user_id = $this->secure_database($user_id);
    $sql = "SELECT * from debit_wallet_tbl where `user_id`='$user_id' and (`purpose`=5 or `purpose`=6 or `purpose`=7 or `purpose`=8 or `purpose`=9) order by `date_created` desc ";
    $query = mysqli_query($this->connection,$sql);
    $num = mysqli_num_rows($query);
     if($num > 0){
       while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
     }else{
            return null;
     }
} 


 function my_transaction_history($user_id){
    $user_id = $this->secure_database($user_id);
    $sql = "SELECT * from debit_wallet_tbl where `user_id`='$user_id' and (`purpose`=5 or `purpose`=6 or `purpose`=7 or `purpose`=8 or `purpose`=9 or  `purpose`=10 or `purpose`=11) order by `date_created` desc ";
    $query = mysqli_query($this->connection,$sql);
    $num = mysqli_num_rows($query);
     if($num > 0){
       while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
     }else{
            return null;
     }
}  

function formatted_date($date){
  $date = $this->secure_database($date);
  return date('l d, F Y',strtotime($date));
}






////sam ends code here

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

//03-06-2020
function set_bonus_commission($bonus, $commission, $set_by, $BE_id){
  //$BE_id = $this->secure_database($BE_id);
  $bonus = $this->secure_database($bonus);
  $commission = $this->secure_database($commission);
  $set_by = $this->secure_database($set_by);
  $data = $bonus.$commission.$set_by;
  
  //$encoded_BE_id = json_encode($BE_id);
  $check = $this->check_row_exists_by_one_param('bonus_commission_request','set_by',$set_by);
  $check2 = $this->check_row_exists_by_one_param('target_bonus_commission','set_by',$set_by);
  if(!isset($set_by) || $BE_id == '' || ($bonus == 0 AND $commission == '')){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
          else if($check2 == false){
            return  json_encode(["status"=>"0", "msg"=>"no_target_found"]);
          }

     else if($check){
      foreach ($BE_id as $value){
       $get_request = $this->get_one_row_from_one_table('bonus_commission_request', 'set_for', $value);
       if($commission == ''){
      $update_bonus_request = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'bonus', $bonus);
      $update_bonus_date = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'date_created', date('Y-m-d:H-i-s'));
      $update_bonus_status = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'bonus_status', 0);
      $update_bonus_for_BE = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'set_for', $value);
      if($update_bonus_request AND $update_bonus_status AND $update_bonus_for_BE){
         return  json_encode(["status"=>"1", "msg"=>"success"]);
      }
    }else if($bonus == ''){
       $update_commission_request = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'commission', $commission);
        $update_commission_status = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'commission_status', 0);
        $update_commission_date = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'date_created', date('Y-m-d:H-i-s'));
        $update_commission_for_BE = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'set_for', $value);
       if($update_commission_request AND $update_commission_status AND $update_commission_for_BE){
         return  json_encode(["status"=>"1", "msg"=>"success"]);
      }
     }else{
        $update_bonus_request = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'bonus', $bonus);
      $update_bonus_status = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'bonus_status', 0);
      $update_bonus_date = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'date_created', date('Y-m-d:H-i-s'));
    $update_commission_request = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'commission', $commission);
        $update_commission_status = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'commission_status', 0);
        $update_commission_date = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'date_created', date('Y-m-d:H-i-s'));
        $update_commission_for_BE = $this->update_with_one_param('bonus_commission_request','unique_id',$get_request['unique_id'],'set_for', $value);  

         if($update_bonus_request AND $update_bonus_status AND $update_commission_request AND $update_commission_status AND $update_commission_for_BE){
         return  json_encode(["status"=>"1", "msg"=>"success"]);
      } 
      }
    }
  }
  else{
    foreach ($BE_id as $value){
      $unique_id = $this->unique_id_generator($data);
    $insert_bonus_commission_sql = "INSERT INTO `bonus_commission_request` SET `unique_id` = '$unique_id',`bonus` = '$bonus', `set_by`='$set_by', `commission`='$commission', `set_for` = '$value', `date_created` = now()";
         $insert_bonus_commission_query = mysqli_query($this->connection, $insert_bonus_commission_sql) or die(mysqli_error($this->connection));
       }
        if($insert_bonus_commission_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}


function approve_bonus_request($bonus, $unique_id, $BE_id, $admin_id){
  $admin_id = $this->secure_database($admin_id);
   $bonus = $this->secure_database($bonus);
  $unique_id = $this->secure_database($unique_id);
  $BE_id = $this->secure_database($BE_id);
$get_target_bonus = $this->get_one_row_from_one_table_by_two_params('target_bonus_commission','set_for',$BE_id, 'set_by', $admin_id);
// $get_bonus = $this->get_one_row_from_one_table_by_two_params('bonus_commission_request','unique_id',$unique_id,'set_by',$BE_id);
//if($get_target_bonus){
    $new_bonus = $bonus + $get_target_bonus['bonus'];
  $update_bonus = $this->update_with_one_param('target_bonus_commission','set_for', $BE_id, 'bonus', $new_bonus);
  $update_bonus_status = $this->update_with_one_param('target_bonus_commission','set_for', $BE_id, 'bonus_status', 0);
  if($update_bonus AND $update_bonus_status){
  $update_bonus_request = $this->update_with_one_param('bonus_commission_request','unique_id',$unique_id,'bonus_status', 1);
  if($update_bonus_request){
    return  json_encode(["status"=>"1", "msg"=>"success"]);
         }
         else{
            return  json_encode(["status"=>"0", "msg"=>"database_error"]);

         } 
  }else{
      return  json_encode(["status"=>"0", "msg"=>"database_error"]);
  }
//}
 
}


function approve_commission_request($commission, $BE_id, $unique_id, $admin_id){
$commission = $this->secure_database($commission);
$unique_id = $this->secure_database($unique_id);
  $admin_id = $this->secure_database($admin_id);
  $BE_id = $this->secure_database($BE_id);
$get_target_commission = $this->get_one_row_from_one_table_by_two_params('target_bonus_commission','set_for',$BE_id, 'set_by', $admin_id);
// $get_bonus = $this->get_one_row_from_one_table_by_two_params('bonus_commission_request','unique_id',$unique_id,'set_by',$admin_id);
//if($get_target_bonus){
  $update_commission = $this->update_with_one_param('target_bonus_commission','set_for', $BE_id,'commission', $commission);
  if($update_commission){
  $update_commission_request = $this->update_with_one_param('bonus_commission_request','unique_id',$unique_id,'commission_status', 1);
  if($update_commission_request){
    return  json_encode(["status"=>"1", "msg"=>"success"]);
         }
         else{
            return  json_encode(["status"=>"0", "msg"=>"database_error"]);

         } 
  }else{
      return  json_encode(["status"=>"0", "msg"=>"database_error"]);
  }
//}
 
}

function get_bonus_claim($table,$param1,$value1,$param2,$value2){
        $table = $this->secure_database($table);
        $param1 = $this->secure_database($param1);
        $value1 = $this->secure_database($value1);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
        $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' || `$param2`='$value2' ORDER BY date_created DESC ";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}


function approve_bonus_claim($BE_id, $bonus, $unique_id){
  $BE_id = $this->secure_database($BE_id);
  $bonus = $this->secure_database($bonus);
  $unique_id1 = $this->unique_id_generator($BE_id.rand());
  $approve_bonus_claim = $this->update_with_one_param('target_bonus_commission','unique_id',$unique_id,'bonus_status', 2);
    $update_bonus = $this->update_with_one_param('target_bonus_commission','unique_id',$unique_id, 'bonus', 0);
    $insert_approved_bonus_sql = "INSERT INTO `approved_bonus_commission` SET `unique_id` = '$unique_id1', `BE_id` = '$BE_id',`bonus_amount` = '$bonus', `date_created` = now()";
         $insert_approved_bonus_query = mysqli_query($this->connection, $insert_approved_bonus_sql) or die(mysqli_error($this->connection));
         if($update_bonus AND $insert_approved_bonus_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 

}

function approve_commission_claim($BE_id, $commission, $unique_id){
  $BE_id = $this->secure_database($BE_id);
  $commission = $this->secure_database($commission);
  $unique_id1 = $this->unique_id_generator($BE_id.rand());
  $approve_bonus_claim = $this->update_with_one_param('be_sales','unique_id',$unique_id,'commission_status', 2);
    //$update_commission = $this->update_with_one_param('target_bonus_commission','unique_id',$unique_id, 'bonus', 0);
    $insert_approved_commission_sql = "INSERT INTO `approved_bonus_commission` SET `unique_id` = '$unique_id1', `BE_id` = '$BE_id',`commission_amount` = '$commission', `date_created` = now()";
         $insert_approved_commission_query = mysqli_query($this->connection, $insert_approved_commission_sql) or die(mysqli_error($this->connection));
         if($insert_approved_commission_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 

}

function get_withdrawal_requests(){
        $sql = "SELECT * FROM `debit_wallet_tbl` WHERE `purpose`= 5 || `purpose`= 6 || `purpose`= 7 ORDER BY date_created DESC";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}


function process_withdrawal_request($name_of_bank, $method_of_transfer, $reference_number, $teller_number, $created_by, $amount_withdrawn, $request_id, $filename, $size, $tmpName, $type, $user_id){
    $name_of_bank = $this->secure_database($name_of_bank);
    $method_of_transfer = $this->secure_database($method_of_transfer);
    $reference_number = $this->secure_database($reference_number);
    $teller_number = $this->secure_database($teller_number);
    $created_by = $this->secure_database($created_by);
    $filename = $this->secure_database($filename);
    $data = $filename.$size;
    $unique_id = $this->unique_id_generator($data);
    $image_url = $this->image_upload($filename, $size, $tmpName, $type);
    @$check = $this->check_row_exists_by_one_param($table,'unique_id',$unique_id);
    $get_wallet_balance = $this->get_wallet_balance($user_id);
    $get_wallet_balance_decode = json_decode($get_wallet_balance, true);
    $wallet_balance = $get_wallet_balance_decode['msg'];
    // $amount_withdrawn = $_POST['amount_withdrawn'];
    $new_balance = $wallet_balance - $amount_withdrawn;
    // $get_purpose = $this->get_one_row_from_one_table('debit_wallet_tbl','unique_id',$unique_id);
    //   if($get_purpose['purpose'] == 2){
    //     $new_value = 4;
    //   }else if($get_purpose['purpose'] == 5){
    //     $new_value = 7;
    //   }
       
  
  if($name_of_bank == "" || $method_of_transfer == "" || $created_by == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);

  }else if($wallet_balance < $amount_withdrawn){
    return  json_encode(["status"=>"0", "msg"=>"balance_less"]);
  }

  else{
        $imageurl_decode = json_decode($image_url,true);
        // echo $imageurl_decode;
        if($imageurl_decode['status'] == 1){
          $imageurl2 = $imageurl_decode['msg'];
        }else{
          $imageurl2 ='No Image';
        }
              
              $sql = "INSERT INTO `processed_withdrawal_request` SET `name_of_bank` = '$name_of_bank', `method_of_transfer` = '$method_of_transfer', `reference_number` = '$reference_number', `teller_number` = '$teller_number', `unique_id` = '$unique_id',`transfer_slip` = '$imageurl2', `added_by`='$created_by', `date_created` = now()";  
            $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
            if($query){
            $update_wallet = $this->update_with_one_param('wallet_tbl','user_id',$user_id, 'balance',$new_balance);

             
            $approve_request = $this->update_with_one_param('debit_wallet_tbl','unique_id',$request_id,'purpose', 7);
            $update_withdrawal_status = $this->update_with_one_param('debit_wallet_tbl','unique_id',$request_id,'withdrawal_status', 6);
          }
              if($query AND $update_wallet AND $approve_request AND $update_withdrawal_status){
              return json_encode(["status"=>"1", "msg"=>"success"]);
              }else{
              return json_encode(["status"=>"0", "msg"=>"db_error"]);
              }
//


      
  }
}

function insert_online_payment($bank_name, $amount, $depositor_id){
  $bank_name = $this->secure_database($bank_name);
  $amount = $this->secure_database($amount);
  $depositor_id = $this->secure_database($depositor_id);
  $unique_id = $this->unique_id_generator($depositor_id.rand());
  if($bank_name == '' || $amount == '' || $depositor_id == ''){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else{
    $insert_online_payment_log_sql = "INSERT INTO `online_payments` SET `unique_id` = '$unique_id', `bank_name` = '$bank_name',`amount` = '$amount', `depositor_id` = '$depositor_id', `date_created` = now()";
         $insert_online_payment_log_query = mysqli_query($this->connection, $insert_online_payment_log_sql) or die(mysqli_error($this->connection));
         if($insert_online_payment_log_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}

//16-06-2020
function update_profile_image($filename, $size, $tmpName, $type, $user_id){
  $filename = $this->secure_database($filename);
  $image_url = $this->image_upload($filename, $size, $tmpName, $type);
  $get_present_image = $this->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
  $present_image = $get_present_image['imageurl'];  
  $imageurl_decode = json_decode($image_url,true);
  if($imageurl_decode['status'] == '1'){
    $imageurl2 = $imageurl_decode['msg'];
    $sql = "UPDATE `users_tbl` SET `imageurl` = '$imageurl2' WHERE `unique_id`='$user_id'"; 
    $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
    if($present_image !== 'uploads/user.png'){
        unlink($present_image);
    }
    if($query){
    return json_encode(["status"=>"1", "msg"=>"success"]);
    }else{
    return json_encode(["status"=>"0", "msg"=>"db_error"]);
    }
  }else{
    return json_encode(["status"=>"0", "msg"=>$imageurl_decode['msg']]);
  }
}

function debit_account($user_id, $amount, $remarks, $admin_id){
    $user_id = $this->secure_database($user_id);
    $amount = $this->secure_database($amount);
    $remarks = $this->secure_database($remarks);
    $admin_id = $this->secure_database($admin_id);
    $unique_id =$this->unique_id_generator($user_id.$amount.$remarks);
    $get_wallet_balance = $this->get_wallet_balance($user_id);
    $get_wallet_balance_decode = json_decode($get_wallet_balance, true);
    $wallet_balance = $get_wallet_balance_decode['msg'];
    $amount = (int)$amount;
    $new_balance = $wallet_balance - $amount;
  
  if($user_id == "" || $amount == "" || $remarks == "" || $admin_id == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($wallet_balance < $amount){
    return  json_encode(["status"=>"0", "msg"=>"balance_less"]);
  }

  else{
    $update_wallet = $this->update_with_one_param('wallet_tbl','user_id',$user_id, 'balance',$new_balance);
    if($update_wallet){
      $insert_debit_account_log_sql = "INSERT INTO `debit_account_log` SET `unique_id` = '$unique_id', `user_id` = '$user_id', `amount` = '$amount', `remarks` = '$remarks',  `admin_id`='$admin_id', `date_created` = now()";  
      $insert_debit_account_log_query = mysqli_query($this->connection, $insert_debit_account_log_sql) or die(mysqli_error($this->connection));
    }
    if($insert_debit_account_log_query AND $update_wallet){
    return json_encode(["status"=>"1", "msg"=>"success"]);
    }else{
    return json_encode(["status"=>"0", "msg"=>"db_error"]);
    }
    
  }
}


function error_debit($unique_id, $user_id, $amount){
   $unique_id = $this->secure_database($unique_id);
    $user_id = $this->secure_database($user_id);
    if($unique_id =='' || $user_id == '' || $amount == 0){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
    }else{
        $get_user_wallet_balance = $this->get_wallet_balance($user_id);
        $get_user_wallet_balance_decode = json_decode($get_user_wallet_balance,true);
        $new_user_balance = $get_user_wallet_balance_decode['msg'] + (int)$amount;
          $update_user_balance = $this->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_user_balance);
          $update_debit_account_log = $this->update_with_one_param('debit_account_log','unique_id',$unique_id,'status', 2);
          if($update_user_balance && $update_debit_account_log){
            return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
            return json_encode(["status"=>"0", "msg"=>"error"]);
          }

    }
}

function insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification){
  $user_id = $this->secure_database($user_id);
  $notification_type = $this->secure_database($notification_type);
  $notification_heading = $this->secure_database($notification_heading);
  $notification = $this->secure_database($notification);
  $data = md5($user_id.$notification_type);
  $unique_id = $this->unique_id_generator($data);
  //$check = $this->check_row_exists_by_one_param('access_card_tbl','user_id',$user_id);
  if($user_id == "" || $notification_type == "" || $notification == "" || $notification_heading == ""){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else{
       $sql = "INSERT INTO `notifications_tbl` SET `unique_id` = '$unique_id',`user_id` = '$user_id', `notification_type` = '$notification_type', `notification` = '$notification', `notification_heading` = '$notification_heading', `date_created` = now()";
          $query = mysqli_query($this->connection, $sql);
          if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
}
}

function total_investment($table, $param){
 $sql = "SELECT SUM($param) as `$param` FROM `$table`";
 $query = mysqli_query($this->connection, $sql)or die(mysqli_error($this->connection));
 $row = mysqli_fetch_array($query);
 $sum = $row[$param];
 $num = mysqli_num_rows($query);
 return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}

function get_hottest_product($table, $param){
    $sql = "SELECT $param, COUNT($param) AS $param from $table GROUP BY $param ORDER BY COUNT($param) DESC";
    $query= mysqli_query($this->connection, $sql)or die(mysqli_error($this->connection));
    $row = mysqli_fetch_array($query);
    //var_dump($row);
    return json_encode(["status"=>"1", "msg"=>$row[0]]);

//}
}

function get_top_ten_clients(){
  $sql = "SELECT *
FROM subscribed_packages
ORDER BY total_amount DESC
LIMIT 10";
$query= mysqli_query($this->connection, $sql)or die(mysqli_error($this->connection));
    $row = mysqli_fetch_array($query);
    var_dump($row);
}

function total_investment_with_user_id($table, $param, $param1, $user_id){
 $sql = "SELECT SUM($param) as param FROM `$table` WHERE `$param1` = '$user_id'";
 $query = mysqli_query($this->connection, $sql)or die(mysqli_error($this->connection));
 $row = mysqli_fetch_array($query);
 $sum = $row['param'];
 $num = mysqli_num_rows($query);
 return  json_encode(["status"=>"1", "msg"=>intval($sum)]);    
}


function insert_edit_sensitive_details_request($admin_id, $user_id, $new_email, $new_phone){
  $admin_id = $this->secure_database($admin_id);
  $user_id = $this->secure_database($user_id);
  $new_email = $this->secure_database($new_email);
  $new_phone = $this->secure_database($new_phone);
  $data = $user_id.$new_email.$new_phone;
  $unique_id = $this->unique_id_generator($data);

  if($admin_id == '' || $user_id == '' || ($new_email == '' && $new_phone == '')){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else{
    $insert_edit_sensitive_details_request_sql = "INSERT INTO `edit_sensitive_details_log` SET `unique_id` = '$unique_id',`user_id` = '$user_id', `admin_id`='$admin_id', `new_email`='$new_email', `new_phone`='$new_phone', `date_created` = now()";
         $insert_edit_sensitive_details_request_query = mysqli_query($this->connection, $insert_edit_sensitive_details_request_sql) or die(mysqli_error($this->connection));
         if($insert_edit_sensitive_details_request_query){
          $get_user_details = $this->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
            $check_if_user_assigned = $this->check_row_exists_by_one_param('leads','email',$get_user_details['email']);
            if(!$check_if_user_assigned){
              $get_bEs = $this->get_rows_from_one_table('business_executive_tbl');
              $numbers_of_leads = array_column($get_bEs, 'no_of_assigned_lead');
              $least_no_of_lead = min($numbers_of_leads);
              $BE_with_least_no_lead = $this->get_one_row_from_one_table('business_executive_tbl','no_of_assigned_lead', $least_no_of_lead);
              $fullname = $get_user_details['surname'].' '.$get_user_details['other_names'];
              $phone = $get_user_details['phone'];
              $added_by = 'system';
              $assigned_to = $BE_with_least_no_lead['unique_id'];
              $email = $get_user_details['email'];
              $location = 'default';
              $other_location = '';
              $classification = 'client';
              $interest_level = 5;
              $social_media = '';
              $assign_user_to_BE = $this->add_leads($fullname, $phone, $added_by, $assigned_to, $email, $location, $other_location, $classification, $interest_level, $social_media);
              $no_assigned_lead = $this->get_number_of_rows_one_param('leads','assigned_to', $assigned_to);
              //@$no_assigned_lead = $no_assigned_lead + 1;
              $update_bussiness_executive_tbl = $this->update_with_one_param('business_executive_tbl', 'unique_id', $assigned_to, 'no_of_assigned_lead', $no_assigned_lead);
              $assign_user_to_BE_decode = json_decode($assign_user_to_BE, true);
             if($assign_user_to_BE_decode['status'] == "1"){
                 return  json_encode(["status"=>"1", "msg"=>"success"]);
               }else{return $assign_user_to_BE_decode['msg'];}
              //return $assign_user_to_BE_decode['msg'];
            }
            else{return  json_encode(["status"=>"1", "msg"=>"success"]);}
         }
         else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}

function create_third_party_account($other_names, $dob, $gender, $surname, $password, $phone , $email, $unique_id){
   
    $other_names = $this->secure_database($other_names);
    $dob = $this->secure_database($dob);
    $surname = $this->secure_database($surname);
    $password = $this->secure_database($password);
    $phone = $this->secure_database($phone);
    $email = $this->secure_database($email);
    $gender = $this->secure_database($gender);

    $check = $this->check_row_exists_by_one_param('users_tbl','email',$email);
  
  if($other_names == "" || $surname == "" || $password == "" || $phone == "" || $email == "" || $gender == "" || $dob == ""){
    return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
  }else{
       // if ($password != $confirm_password){
       //  return json_encode(["status"=>"0", "msg"=>"password_mismatch"]);
       // }
       //else{
        $enc_password = md5($password);
       $sql = "INSERT INTO `users_tbl` SET `referral_id`='admin',`unique_id` = '$unique_id',`other_names` = '$other_names',`surname` = '$surname', `access_level` = 1,  `phone` = '$phone', `password` = '$enc_password', `email` = '$email', `gender` = '$gender', `dob` = '$dob', `date_created` = now()";
          $query = mysqli_query($this->connection, $sql);
          if($query){
            $get_user_id = $this->get_one_row_from_one_table('users_tbl', 'email', $email);
            $user_id = $get_user_id['unique_id'];
            $check_if_wallet_exist = $this->check_row_exists_by_one_param('wallet_tbl','user_id',$user_id);
             if($check_if_wallet_exist === false){
             $data = rand().$user_id;
             $unique_id2 = $this->unique_id_generator($data);
             $insert_wallet_sql = "INSERT INTO `wallet_tbl` SET `unique_id` = '$unique_id2',`balance` = 0, `user_id`='$user_id', `date_created` = now()";
             $insert_wallet_query = mysqli_query($this->connection,$insert_wallet_sql);
            if($insert_wallet_query){
              return json_encode(["status"=>"1", "msg"=>"success"]);
            }
            else{
              return json_encode(["status"=>"0", "msg"=>"error"]);
            }
          }
          }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
          }
        //}
  }
}


function insert_users_logs($user_id, $description){
  $user_id = $this->secure_database($user_id);
  $description = $this->secure_database($description);
  $data = $user_id.$description;
  $unique_id = $this->unique_id_generator($data);

  if($user_id == '' || $description == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
  else{
    $insert_log_sql = "INSERT INTO `users_logs_tbl` SET `unique_id` = '$unique_id',`description` = '$description', `user_id`='$user_id', `date_created` = now()";
         $insert_log_query = mysqli_query($this->connection, $insert_log_sql) or die(mysqli_error($this->connection));
         if($insert_log_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}


function insert_wallet_balance(){
  $get_users = $this->get_rows_from_one_table('users_tbl');
  //if (is_array($get_users) || is_object($get_users))
//{
$count = count($get_users);
//for($i = 0; $i<=$count; $i++){
   foreach ($get_users as $value) {
    $user_id = $get_users['unique_id'];
    $check_if_wallet_exist = $this->check_row_exists_by_one_param('wallet_tbl2','user_id',$get_users['unique_id']);
    if($check_if_wallet_exist === false){
         $data = rand().$user_id;
         $unique_id = $this->unique_id_generator($data);
         $insert_wallet_sql = "INSERT INTO `wallet_tbl2` SET `unique_id` = '$unique_id',`balance` = 0, `user_id`='$user_id', `date_created` = now()";
         $insert_wallet_query = mysqli_query($this->connection,$insert_wallet_sql);
        if($insert_wallet_query){
              echo "success<br>";
        }else{
              echo "failed<br>";
        }

      }else{
        // return json_encode(["status"=>"0", "msg"=>"wallet_exists"]);
         
              echo "wallet exists<br>";


      }
  }
// }else{
//     echo "nothing in array";
// }

}

 function unsuspend_be(){
  $sql = "SELECT * FROM `business_executive_tbl` WHERE `status` = 2";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0){
    while($row = mysqli_fetch_array($query)){
      $BE_id = $row['unique_id'];
      $get_be_suspension = $this->get_one_row_from_one_table('be_suspension_tbl', 'BE_id', $row['unique_id']);
      if($get_be_suspension['status'] == 1){
        $time_frame = $get_be_suspension['time_frame'];
        $date_created = date_create($get_be_suspension['date_created']);
        $today = date('Y-m-d');
        //$today = '2020-07-09';
        $date_to_add = $time_frame.' days';
        $next_date = date_add($date_created, date_interval_create_from_date_string($date_to_add));
        if($today == date_format($next_date,"Y-m-d")){
          $unsuspend_be_sql = "UPDATE `business_executive_tbl` SET `status` = 1 WHERE  `unique_id`= '$BE_id'";
          $unsuspend_be_query = mysqli_query($this->connection, $unsuspend_be_sql);

          $BE_clients = json_decode($get_be_suspension['BE_clients']);
          foreach ($BE_clients as $val) {
            $update_assigned_to = $this->update_with_one_param('leads','unique_id', $val, 'assigned_to', $BE_id);
          }
          $get_num_leads = $this->get_number_of_rows_one_param('leads','assigned_to', $BE_id);
          $update_num_leads = $this->update_with_one_param('business_executive_tbl', 'unique_id', $BE_id, 'no_of_assigned_lead', $get_num_leads);
          if($unsuspend_be_query && $update_assigned_to && $update_num_leads){
            echo "success";
          }
        }else{
          //echo "not yet time";
        }
      }
    }
  }
}



function undo_package_sub($no_of_slots_bought, $user_id, $investment_id, $total_amount, $package_id){
    $no_of_slots_bought = $this->secure_database($no_of_slots_bought);
    $user_id = $this->secure_database($user_id); 
    $investment_id = $this->secure_database($investment_id); 
    $total_amount = $this->secure_database($total_amount); 

    ///check if investment is in maker checker
    $sql_mc = "SELECT id FROM `backdate_investment_maker_checker` WHERE `investment_id`='$investment_id'";
    $qry_mc = mysqli_query($this->connection, $sql_mc);
    $mcount = mysqli_num_rows($qry_mc);

      if($mcount >= 1){
              return  json_encode(["status"=>"0", "msg"=>"backdate_request_pending"]);
          }else{


    //check wallet balance
    $getwallet = $this->get_wallet_balance($user_id);
    $decode_wallet = json_decode($getwallet,true);
    $wallet_balance = $decode_wallet['msg'];
    // $get_wallet_status = $this->get_one_row_from_one_table('wallet_tbl', 'user_id', $user_id);
    // $wallet_status = $get_wallet_status['wallet_status'];
    $get_package_details = $this->get_one_row_from_one_table('package_definition', 'unique_id', $package_id);
    $available_slots = $get_package_details['no_of_slots'];
         $new_balance = $wallet_balance + $total_amount;
         $new_slot_bal = $available_slots + $no_of_slots_bought;
          ////update wallet balance
          $update_wallet_balance = $this->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_balance);

          ///update package slot
          $update_package_slot = $this->update_with_one_param('package_definition','unique_id',$package_id,'no_of_slots',$new_slot_bal);

           ///update package slot
          //$update_investment_status = $this->update_with_one_param('users_tbl','unique_id',$user_id,'investment_status',1)
          
        
            $delete_subscription = "DELETE FROM `subscribed_packages` WHERE `unique_id` = '$investment_id'";
            $query_delete = mysqli_query($this->connection, $delete_subscription) or die(mysqli_error($this->connection));
            if($query_delete){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
            }else{
            return  json_encode(["status"=>"0", "msg"=>"db_error"]);
            }  
            
            
            

          }

         


}


function undo_package_sub_rec($no_of_slots_bought, $user_id, $investment_id, $package_id){
    $no_of_slots_bought = $this->secure_database($no_of_slots_bought);
    $user_id = $this->secure_database($user_id); 
    $investment_id = $this->secure_database($investment_id); 
    //$total_amount = $this->secure_database($total_amount); 

    ///check if investment is in maker checker
    $sql_mc = "SELECT id FROM `backdate_investment_maker_checker` WHERE `investment_id`='$investment_id'";
    $qry_mc = mysqli_query($this->connection, $sql_mc);
    $mcount = mysqli_num_rows($qry_mc);

      if($mcount >= 1){
              return  json_encode(["status"=>"0", "msg"=>"backdate_request_pending"]);
          }else{


    //check wallet balance
    // $getwallet = $this->get_wallet_balance($user_id);
    // $decode_wallet = json_decode($getwallet,true);
    // $wallet_balance = $decode_wallet['msg'];
    // // $get_wallet_status = $this->get_one_row_from_one_table('wallet_tbl', 'user_id', $user_id);
    // // $wallet_status = $get_wallet_status['wallet_status'];
    $get_package_details = $this->get_one_row_from_one_table('package_definition', 'unique_id', $package_id);
    $available_slots = $get_package_details['no_of_slots'];
         //$new_balance = $wallet_balance + $total_amount;
         $new_slot_bal = $available_slots + $no_of_slots_bought;
          ////update wallet balance
          //$update_wallet_balance = $this->update_with_one_param('wallet_tbl','user_id',$user_id,'balance',$new_balance);

          ///update package slot
          $update_package_slot = $this->update_with_one_param('package_definition','unique_id',$package_id,'no_of_slots',$new_slot_bal);

           ///update package slot
          //$update_investment_status = $this->update_with_one_param('users_tbl','unique_id',$user_id,'investment_status',1)
          
        
            $delete_subscription = "DELETE FROM `subscribed_packages` WHERE `unique_id` = '$investment_id'";
            $query_delete = mysqli_query($this->connection, $delete_subscription) or die(mysqli_error($this->connection));
            if($query_delete){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
            }else{
            return  json_encode(["status"=>"0", "msg"=>"db_error"]);
            }  
            
            
            

          }

}


function generate_token($email, $password){
  $secret_key = 'Bearer fk_'.md5(uniqid()).rand(1000, 9999);
  $unique_id = $this->unique_id_generator($secret_key);
   $check = $this->check_row_exists_by_two_params('secret_key_tbl','email',$email, 'password', $password);
  if($email == "" || $password == ""){
    return json_encode(["status"=>"0", "msg"=>"Empty Field(s)"]);
  }else if($check === true){
    $update_db = $this->update_with_one_param('secret_key_tbl','email', $email,'secret_key', $secret_key);
    if(mysqli_affected_rows($this->connection)){
      $_SESSION['secret_key'] = $secret_key;
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
      $_SESSION['start'] = time();
      $_SESSION['expire'] = $_SESSION['start'] + (60*10);
      return json_encode(["status"=>"1", "msg"=>$secret_key]);
    }
  }
  else{
     return json_encode(["status"=>"0", "msg"=>"Incorrect Email or Password"]);
  }
}

function check_token_exists($secret_key){
  $secret_key = $this->secure_database($secret_key);
  $email = $_SESSION['email'];
  $password = $_SESSION['password'];
  $sql = "SELECT * FROM `secret_key_tbl` WHERE `password` = '$password' AND `email` = '$email'";
  //var_dump($sql);
  $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
  if($query){
    $num = mysqli_num_rows($query);
    if($num > 0 ){
      $row = mysqli_fetch_array($query);
      if($secret_key == $row['secret_key']){
        return true;
        //session_destroy();
      }
      else{
        return false;
      }
    }
    else{
      return false;
    }
  }
  else{
    return false;
  }
}

function insert_be_target($referral, $def){
  $referral = $this->secure_database($referral);
  $def = $this->secure_database($def);
  $unique_id1 = $this->unique_id_generator($def.$referral);
  $unique_id2 = $this->unique_id_generator(md5(uniqid));
  $get_probation_target = $this->get_one_row_from_one_table('probation_target', 'set_by', $referral);
  $probation_target = $get_probation_target['monthly_target'];
  $insert_target_sql = "INSERT INTO `target_bonus_commission` SET `unique_id` = '$unique_id1', `monthly_target` = '$probation_target', `set_by`='$referral', `set_for`='$def', `date_created` = now()";
  //var_dump($insert_target_sql);
  $insert_target_query = mysqli_query($this->connection, $insert_target_sql) or die(mysqli_error($this->connection));
  $insert_be_target_sql = "INSERT INTO `be_target` SET `unique_id` = '$unique_id2', `BE_id` = '$def', `target_set`='$probation_target', `balance`='$probation_target', `date_created` = now()";
  $insert_be_target_query = mysqli_query($this->connection, $insert_be_target_sql) or die(mysqli_error($this->connection));
  if($insert_target_query && $insert_be_target_query){
      return  json_encode(["status"=>"1", "msg"=>"success"]);
   }else{
      return  json_encode(["status"=>"0", "msg"=>"error"]);

   } 

}



///military purchase rquest
function send_subscription_request_military($package_type,$package_category,$package_commission,$user_id,$package_id,$package_unit_price,$moratorium,$free_liquidation_period,$liquidation_surcharge,$tenure_of_product,$float_time,$multiplying_factor,$capital_refund,$no_of_slots_bought,$available_slots){
    
    $package_type = $this->secure_database($package_type); 
    $package_category = $this->secure_database($package_category); 
    $package_commission = $this->secure_database($package_commission); 
    $user_id = $this->secure_database($user_id); 
    $package_id = $this->secure_database($package_id);  
    $package_unit_price = $this->secure_database($package_unit_price); 
    $no_of_slots_bought = $this->secure_database($no_of_slots_bought); 
    $total_amount = $no_of_slots_bought * $package_unit_price; 
    $moratorium = $this->secure_database($moratorium); 
    $free_liquidation_period = $this->secure_database($free_liquidation_period); 
    $liquidation_surcharge = $this->secure_database($liquidation_surcharge); 
    $tenure_of_product = $this->secure_database($tenure_of_product); 
    $float_time = $this->secure_database($float_time); 
    $multiplying_factor = $this->secure_database($multiplying_factor); 
    $capital_refund = $this->secure_database($capital_refund); 
    $data = $user_id.$package_id;
    $unique_id = $this->unique_id_generator($data);
    
    $check_entry = $this->check_row_exists_by_two_params('military_package_maker_checker','user_id',$user_id,'approval_status',0);
    if($check_entry){
        return  json_encode(["status"=>"0", "msg"=>"exists"]);
    }else{
        
        //only slot is updated
         $new_slot_bal = $available_slots - $no_of_slots_bought;
         
        ///update package slot
         $update_package_slot = $this->update_with_one_param('package_definition','unique_id',$package_id,'no_of_slots',$new_slot_bal);
        
          
          ///insert into subscribe to package
           $insert_subscribed_packages = "INSERT INTO  `military_package_maker_checker` SET 
           `unique_id` = '$unique_id',
           `user_id` = '$user_id',
           `approval_status` = 0,
           `package_id` = '$package_id',
           `package_type` = '$package_type',
           `package_category` = '$package_category',
           `package_commission` = '$package_commission',
           `package_unit_price` = '$package_unit_price',
           `total_amount` = '$total_amount',
           `moratorium` = '$moratorium',
           `free_liquidation_period` = '$free_liquidation_period',
           `liquidation_surcharge` = '$liquidation_surcharge',
           `tenure_of_product` = '$tenure_of_product',
           `float_time` = '$float_time',
           `float_time_incremental` = '$float_time',
           `multiplying_factor` = '$multiplying_factor',
           `capital_refund` = '$capital_refund',
           `no_of_slots_bought` = '$no_of_slots_bought',
           `date_created` = now()";
           $query_insert = mysqli_query($this->connection, $insert_subscribed_packages);
           //return $query_insert;
          if($query_insert){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
            }else{
            return  json_encode(["status"=>"0", "msg"=>"db_error"]);
            }
        
    }
    
}


//dissapprove military purchase request
function disapprove_subscription_request_military($unique_id){
    global $dbc;
   $check_entry = $this->check_row_exists_by_one_param('military_package_maker_checker','unique_id',$unique_id);
   
    if($check_entry == false){
        return  json_encode(["status"=>"0", "msg"=>"This request appears to be treated already"]);
    }else{
            
            $row_get_military_det = $this->get_one_row_from_one_table('military_package_maker_checker','unique_id',$unique_id);
            $user_id = $row_get_military_det['user_id'];
            $package_id = $row_get_military_det['package_id'];
            
            $no_of_slots_bought = $row_get_military_det['no_of_slots_bought']; 
            
            $sb = $this->get_slot_balance($package_id);  
            $get_slot_balance = json_decode($sb,true)['msg'];
            $newslot = $get_slot_balance + $no_of_slots_bought;
            
            
              ///update package slot
            $update_package_slot = $this->update_with_one_param('package_definition','unique_id',$package_id,'no_of_slots',$newslot);
            
         
            
            $sqldel = "DELETE FROM `military_package_maker_checker` WHERE `unique_id`='$unique_id' ";
            $query_del = mysqli_query($this->connection, $sqldel);
        
            //return $query_insert;
            if($query_del){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
            }else{
            return  json_encode(["status"=>"0", "msg"=>"Something went wrong"]);
            }
        
    }
    
    
}


///approve military purchase rquest
function approve_subscription_request_military($unique_id){
    
    $check_entry = $this->check_row_exists_by_two_params('military_package_maker_checker','unique_id',$unique_id,'approval_status',1);
    
    if($check_entry){
        return  json_encode(["status"=>"0", "msg"=>"This Approval has been done Already"]);
        
    }
    
    else{
            $row_get_military_det = $this->get_one_row_from_one_table('military_package_maker_checker','unique_id',$unique_id);
            $user_id = $row_get_military_det['user_id'];
            $package_type = $row_get_military_det['package_type']; 
            $package_category = $row_get_military_det['package_category']; 
            $package_commission = $row_get_military_det['package_commission']; 
            $user_id = $row_get_military_det['user_id']; 
            $package_id = $row_get_military_det['package_id'];  
            $package_unit_price = $row_get_military_det['package_unit_price']; 
            $no_of_slots_bought = $row_get_military_det['no_of_slots_bought']; 
            $total_amount = $row_get_military_det['total_amount']; 
            $moratorium = $row_get_military_det['moratorium']; 
            $free_liquidation_period = $row_get_military_det['free_liquidation_period']; 
            $liquidation_surcharge = $row_get_military_det['liquidation_surcharge']; 
            $tenure_of_product = $row_get_military_det['tenure_of_product']; 
            $float_time = $row_get_military_det['float_time']; 
            $multiplying_factor = $row_get_military_det['multiplying_factor']; 
            $capital_refund = $row_get_military_det['capital_refund']; 
            
            
            //update wallet
            $wallb = $this->get_wallet_balance($user_id);
            $decwb = json_decode($wallb,true)['msg'];
            if($decwb['msg'] == NULL){
                 return  json_encode(["status"=>"0", "msg"=>"Wallet Balance Insufficient"]);
            }
            
            
            
            else{
            
                //ensure sufficient balance
                $newb = $decwb - $total_amount;
                if($newb < 0){
                    return  json_encode(["status"=>"0", "msg"=>"Insufficient Wallet Balance"]);
                  }else{
                      
                    // //update wallet balance
                    $sqlupu = "UPDATE `wallet_tbl` SET `balance`='$newb' WHERE `user_id`='$user_id'";
                    $qryupu = mysqli_query($this->connection,$sqlupu);
                      
                    //update approval status
                    $sqlupd = "UPDATE `military_package_maker_checker` SET `approval_status`=1 WHERE `unique_id`='$unique_id'";
                    $qryupd = mysqli_query($this->connection,$sqlupd);
                    
                    ///insert into subscribe to package
                    $insert_subscribed_packages = "INSERT INTO  `subscribed_packages` SET
                    `unique_id` = '$unique_id',
                    `user_id` = '$user_id',
                    `package_id` = '$package_id',
                    `package_type` = '$package_type',
                    `package_category` = '$package_category',
                    `package_commission` = '$package_commission',
                    `package_unit_price` = '$package_unit_price',
                    `total_amount` = '$total_amount',
                    `moratorium` = '$moratorium',
                    `free_liquidation_period` = '$free_liquidation_period',
                    `liquidation_surcharge` = '$liquidation_surcharge',
                    `tenure_of_product` = '$tenure_of_product',
                    `float_time` = '$float_time',
                    `float_time_incremental` = '$float_time',
                    `multiplying_factor` = '$multiplying_factor',
                    `capital_refund` = '$capital_refund',
                    `no_of_slots_bought` = '$no_of_slots_bought',
                    `date_created` = now()";
                    $query_insert = mysqli_query($this->connection, $insert_subscribed_packages);
                    
                    //return $query_insert;
                    if($query_insert == true && $qryupd == true && $sqlupu == true){
                    return  json_encode(["status"=>"1", "msg"=>"success"]);
                    }else{
                    return  json_encode(["status"=>"0", "msg"=>"Something went wrong"]);
                    }
                
                      
                  }
   
               }
                
            }
}


function insert_edit_user_bank_details_request($admin_id, $user_id, array $bank_details_array){
  $admin_id = $this->secure_database($admin_id);
  $user_id = $this->secure_database($user_id);
  $bank_name = ($bank_details_array['bank_name'] == '') ? NULL : $bank_details_array['bank_name'];
  $account_name = ($bank_details_array['account_name'] == '') ? NULL : $bank_details_array['account_name'];
  $account_number = ($bank_details_array['account_number'] == '') ? NULL : $bank_details_array['account_number'];
  $bvn = ($bank_details_array['bvn'] == '') ? NULL : $bank_details_array['bvn'];
  $account_type = ($bank_details_array['account_type'] == '') ? NULL : $bank_details_array['account_type'];

  if($admin_id == '' || $user_id == '' || ($bank_name == NULL && $account_name == NULL && $account_number == NULL && $bvn == NULL && $account_type == NULL)){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }
  else{
    $data = $account_name.$account_number;
    $unique_id = $this->unique_id_generator($data);
    $insert_edit_sensitive_details_request_sql = "INSERT INTO `edit_bank_details_request` SET `unique_id` = '$unique_id',`user_id` = '$user_id', `admin_id`='$admin_id', `bank_name`='$bank_name', `account_name`='$account_name', `account_number`='$account_number', `bvn`='$bvn', `account_type`='$account_type', `date_created` = now()";
         $insert_edit_sensitive_details_request_query = mysqli_query($this->connection, $insert_edit_sensitive_details_request_sql) or die(mysqli_error($this->connection));
         if($insert_edit_sensitive_details_request_query){
          $get_user_details = $this->get_one_row_from_one_table('users_tbl', 'unique_id', $user_id);
            $check_if_user_assigned = $this->check_row_exists_by_one_param('leads','email',$get_user_details['email']);
            if(!$check_if_user_assigned){
              $get_bEs = $this->get_rows_from_one_table('business_executive_tbl');
              $numbers_of_leads = array_column($get_bEs, 'no_of_assigned_lead');
              $least_no_of_lead = min($numbers_of_leads);
              $BE_with_least_no_lead = $this->get_one_row_from_one_table('business_executive_tbl','no_of_assigned_lead', $least_no_of_lead);
              $fullname = $get_user_details['surname'].' '.$get_user_details['other_names'];
              $phone = $get_user_details['phone'];
              $added_by = 'system';
              $assigned_to = $BE_with_least_no_lead['unique_id'];
              $email = $get_user_details['email'];
              $location = 'default';
              $other_location = '';
              $classification = 'client';
              $interest_level = 5;
              $social_media = '';
              $assign_user_to_BE = $this->add_leads($fullname, $phone, $added_by, $assigned_to, $email, $location, $other_location, $classification, $interest_level, $social_media);
              $no_assigned_lead = $this->get_number_of_rows_one_param('leads','assigned_to', $assigned_to);
              //@$no_assigned_lead = $no_assigned_lead + 1;
              $update_bussiness_executive_tbl = $this->update_with_one_param('business_executive_tbl', 'unique_id', $assigned_to, 'no_of_assigned_lead', $no_assigned_lead);
              $assign_user_to_BE_decode = json_decode($assign_user_to_BE, true);
               if($assign_user_to_BE_decode['status'] == "1"){
                 return  json_encode(["status"=>"1", "msg"=>"success"]);
               }else{return $assign_user_to_BE_decode['msg'];}
              //return $assign_user_to_BE_decode['msg'];
            }else{
              return  json_encode(["status"=>"1", "msg"=>"success"]);
            }
         }
         else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}

function approve_change_bank_details($unique_id){
  $unique_id = $this->secure_database($unique_id);
  $get_request = $this->get_one_row_from_one_table('edit_bank_details_request', 'unique_id', $unique_id);
  $user_id = $get_request['user_id'];
  $bank_name = $get_request['bank_name'];
  $account_name = $get_request['account_name'];
  $account_number = $get_request['account_number'];
  $bvn = $get_request['bvn'];
  $account_type = $get_request['account_type'];
  $approve_request = $this->update_with_one_param('edit_bank_details_request','unique_id',$unique_id,'status', 2);
  $approve_request_decode = json_decode($approve_request, true);
  if($approve_request_decode['status'] == 1){
    $sql = "UPDATE `users_tbl` SET `bank_name`='$bank_name', `account_name`='$account_name', `account_number`='$account_number', `bvn`='$bvn', `account_type`='$account_type' WHERE `unique_id` = '$user_id'";
    $query = mysqli_query($this->connection, $sql)or die(mysqli_error($this->connection));
    if(mysqli_affected_rows($this->connection)){
      return json_encode(["status"=>"1", "msg"=>"success"]);   
    }
    else{
      return json_encode(["status"=>"0", "msg"=>"db_error"]);
    }
  }
  else{
    return json_encode(["status"=>"0", "msg"=>"error"]);
  }
}

function credit_wallet($user_id, $amount)
  {
    $sql = "UPDATE wallet_tbl SET `balance` = `balance` + '$amount' WHERE `user_id` = '$user_id'";
    $query = mysqli_query($this->connection, $sql);

    if (mysqli_affected_rows($this->connection) > 0) {
      
      return true;
    
    }

    return false;
  }

  function log_remita_payment(array $payment_details)
  {
    $txn_id = $payment_details['txn_id'];
    $txn_ref = $payment_details['txn_ref'];
    $amount = $payment_details['amount'];
    $user_id = $payment_details['user_id'];
    $uuid = md5(mt_rand());
    $status = $payment_details['status'];

    $sql = "INSERT INTO credit_wallet_tbl (unique_id, user_id, transaction_id, amount, description, payment_type, txn_ref, payment_status) VALUES ('$uuid', '$user_id', '$txn_id', '$amount', 'Credited Using Remita', 'remita', '$txn_ref', '$status')";

    $query = mysqli_query($this->connection, $sql);

    if ($query == true) {
      # code...

      return true;
    } 


    return false;

  }

  function remita_payment($user_id, $txn_id, $txn_ref, $amount, $status)
  {


    if($status == '1'){

      $credit_wallet = $this->credit_wallet($user_id, $amount);
      
      if ($credit_wallet == false) {
        # code...

        $response = [
          'status' => '0',
          'msg' => 'Error Crediting User Wallet.'
        ];

        return json_encode($response);
      }
  }

    $payment_details = [
      'txn_id' => $txn_id,
      'txn_ref' => $txn_ref,
      'user_id' => $user_id,
      'amount' => $amount,
      'status' => $status
    ];

    $log_remita_payment = $this->log_remita_payment($payment_details);

    if ($log_remita_payment == false) {
      # code...

        $response = [
          'status' => '0',
          'msg' => 'Error Logging Payment Attempt.'
        ];

        return json_encode($response);
    }

        if ($status == 2) {
          # code...
          $response = [
            'status' => '0',
            'msg' => 'Error Making Payment.'
          ];

          return json_encode($response);
        }

        $response = [
          'status' => '1',
          'msg' => 'Payment Successfully Saved.'
        ];

        return json_encode($response);

  }
  
  function upload_payment_proof($description, $amount, $user_id, $bank_name, $account_name, $account_number, $filename, $size, $tmpName, $type){
    $description = $this->secure_database($description);
    $user_id = $this->secure_database($user_id);
    $amount = $this->secure_database($amount);
    $bank_name = $this->secure_database($bank_name);
    $account_name = $this->secure_database($account_name);
    $account_number = $this->secure_database($account_number);
    $filename = $this->secure_database($filename);
    $data = $filename.$size;
    $unique_id = $this->unique_id_generator($data);
    $image_url = $this->image_upload($filename, $size, $tmpName, $type);
    $check = $this->check_row_exists_by_one_param('bank_transfer_tbl','unique_id',$unique_id);
    if($unique_id == "" || $image_url == "" || $description == "" || $user_id == "" || $amount == ""){
      return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
    }
    else if($check === true){
      return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
    }
    else{
      $imageurl_decode = json_decode($image_url,true);
      if($imageurl_decode['status'] == '1'){
        $imageurl2 = $imageurl_decode['msg'];
        $sql = "INSERT INTO `bank_transfer_tbl` SET `description` = '$description',`unique_id` = '$unique_id',`payment_proof` = '$imageurl2', `user_id`='$user_id', `amount`='$amount', `bank_name`='$bank_name', `account_number`='$account_number', `account_name`='$account_name', `date_created` = now()";

        $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
        }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
      }
    }
  }
  
  function upload_payment_proof2($description, $amount, $user_id, $bank_name, $account_name, $account_number, $filename, $size, $tmpName, $type){
    $description = $this->secure_database($description);
    $user_id = $this->secure_database($user_id);
    $amount = $this->secure_database($amount);
    $bank_name = $this->secure_database($bank_name);
    $account_name = $this->secure_database($account_name);
    $account_number = $this->secure_database($account_number);
    $filename = $this->secure_database($filename);
    $data = $filename.$size;
    $unique_id = $this->unique_id_generator($data);
    $image_url = $this->image_upload2($filename, $size, $tmpName, $type);
    $check = $this->check_row_exists_by_one_param('bank_transfer_tbl','unique_id',$unique_id);
    if($unique_id == "" || $image_url == "" || $description == "" || $user_id == "" || $amount == ""){
      return json_encode(["status"=>"0", "msg"=>"empty_fields"]);
    }
    else if($check === true){
      return  json_encode(["status"=>"0", "msg"=>"record_exists"]);
    }
    else{
      $imageurl_decode = json_decode($image_url,true);
      if($imageurl_decode['status'] == '1'){
        $imageurl2 = $imageurl_decode['msg'];
        $sql = "INSERT INTO `bank_transfer_tbl` SET `description` = '$description',`unique_id` = '$unique_id',`payment_proof` = '$imageurl2', `user_id`='$user_id', `amount`='$amount', `bank_name`='$bank_name', `account_number`='$account_number', `account_name`='$account_name', `date_created` = now()";

        $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
        }else{
          return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }
      }
    }
  }
  
  function view_user_email(){
    $get_email = mysqli_query($this->connection, "SELECT email FROM users_tbl");
    $count = mysqli_num_rows($get_email);
    $ctt = 0;
    while($row = mysqli_fetch_assoc($get_email)){
      // $implode_email = implode($row['email'], ',');
      // echo $implode_email;
      $ctt++;
      $len = strlen($row['email']); 
     if($len <= 40){
         
            if($count == $ctt){
            echo $row['email']; 
            }else{
            echo $row['email'].',';
            }
         
     }
   
      
    }
  }
  
  function get_withdrawal_requests_user($user_id){
    $sql = "SELECT * FROM `debit_wallet_tbl` WHERE (`user_id` = '$user_id') AND (`purpose`= 5 || `purpose`= 6 || `purpose`= 7) ORDER BY date_created DESC";
    $query = mysqli_query($this->connection, $sql);
    $num = mysqli_num_rows($query);
   if($num > 0){
      while($row = mysqli_fetch_array($query)){
        $row_display[] = $row;
      }
      return $row_display;
    }
    else{
      return null;
    }
  }
  
  function assign_account_officer($account_officer_id, $user_id){
    $account_officer_id = $this->secure_database($account_officer_id);
    $user_id = isset($user_id) ? $user_id : '';
    if($user_id == '' || $account_officer_id == ''){
      return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
    }
    else{
      foreach ($user_id as $user) {
        $assign_account_officer = $this->update_with_one_param('users_tbl','unique_id', $user,'account_officer_id', $account_officer_id);
        $assign_account_officer_decode = json_decode($assign_account_officer, true);
      }
      if($assign_account_officer_decode['status'] == 1){
        return json_encode(["status"=>"1", "msg"=>"success"]);
      }else{
        return json_encode(["status"=>"0", "msg"=>"db_error"]);
      }
    }
  }
 }//ends class



  


?>