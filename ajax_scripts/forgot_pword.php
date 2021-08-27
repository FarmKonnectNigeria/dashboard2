    <?php
    require_once('../classes/db_class.php');
    require_once('../includes/config.php');
    $email = $_POST['email'];
    $table = 'users_tbl';
    $param = 'email';
    $object = new DbQueries;
    $check_user_exists = $object->check_row_exists_by_one_param($table,$param,$email);
    if(empty($email)){
        echo 600;
    }
    else if($check_user_exists === false){
        echo 500;
    }
    else{
        $get_user = $object->get_one_row_from_one_table($table,$param,$email);
        $unique_id = $get_user['unique_id'];
        $reset_password = $object -> user_reset_password_link($unique_id, $email);
        echo 200;
        //$object->insert_users_logs($_SESSION['uid'], 'Requested for reset password link');
    }
?>