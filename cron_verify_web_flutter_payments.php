<?php include('classes/db_class.php');
          $object = new DbQueries();
          $object->cron_verify_payments();
    //   echo  $this->email_function('samuel.adebunmi@cloudware.ng', 'testiiii', 'am testing99');
      //echo "sdfsdfsdfs";
?>