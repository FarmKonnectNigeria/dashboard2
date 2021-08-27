<?php
session_start();
require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
        
    $object = new DbQueries();
    $object->get_page_access('8a09c8aab2e4e66cb7ee8729bd1fd42b');
    //echo md5(uniqid());
 ?>
