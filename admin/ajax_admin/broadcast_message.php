<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $package_category = isset($_POST['package_category']) ? $_POST['package_category'] : "";
    $package = isset($_POST['package_id']) ? $_POST['package_id'] : "" ;
    $users = isset($_POST['users'] ) ? $_POST['users'] : "";
    $message = $_POST['editor1'];
    $select_receipient = $_POST['recipient'];
    $subject = $_POST['subject']." - FarmKonnect";
    $content = $message;
    $object = new DbQueries();
    if($subject == "" || $message == ""){
        echo 500;
    }else{
        if($select_receipient == 'all_users'){
            $get_user_email = $object->get_rows_from_one_table('users_tbl');
            foreach ($get_user_email as $value) {
                $send_email = $object->email_function($value['email'], $subject, $content); 
            }
            if($send_email){
                echo 200;
            }
        }
        else if($select_receipient == 'select_from_package'){
            if($package == ""){
                echo 500;
            }   
            else{
                foreach ($package as $each_package) {
                    //echo $each_package;
                    $get_subscribed_user = $object->get_rows_from_one_table_by_id('subscribed_packages', 'package_id', $each_package);
                    if($get_subscribed_user == null){
                        echo 600;
                    }else{
                        foreach ($get_subscribed_user as $value) {
                            $subscribed_user_email = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $value['user_id']);
                            $send_email = $object->email_function($subscribed_user_email['email'], $subject, $content);
                        }
                        if($send_email){
                            echo 200;
                        }
                    }
                //}
            }
        }
        }
        else if($select_receipient == 'select_from_category'){
            if($package_category == ""){
                echo 500;
            }
            else{
                $get_subscribed_user = $object->get_rows_from_one_table_by_id('subscribed_packages', 'package_category', $package_category);
                if($get_subscribed_user == null){
                    echo 600;
                }else{
                foreach ($get_subscribed_user as $value) {
                    $subscribed_user_email = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $value['user_id']);
                    $subscribed_user_email['email'];
                    $send_email = $object->email_function($subscribed_user_email['email'], $subject, $content);
                }
                 if($send_email){
                    echo 200;
                }
            }
        }
    }
      else if($select_receipient == 'specific_recipients'){
        if($users == ""){
            echo 500;
        }
            else{
                foreach ($users as $value) {
                    $subscribed_user_email = $object->get_one_row_from_one_table('users_tbl', 'unique_id', $value);
                    //$subscribed_user_email['email'];
                    //$recipient = isset($_POST['users'] ) ? implode(',', $_POST['users']) : "";
                    $send_email = $object->email_function($subscribed_user_email['email'], $subject, $content);
                }
                if($send_email){
                    echo 200;
                }
            }
    }
    $object->insert_logs($_SESSION['adminid'], 'Sent Broadcast Message to Users'); 
}

?>
