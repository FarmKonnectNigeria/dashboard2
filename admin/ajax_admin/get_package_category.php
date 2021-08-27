<?php
    session_start();
    require_once('../../classes/db_class.php');
    require_once('../../includes/config.php');
    $object = new DbQueries();
    $get_cat = $object->get_rows_from_one_table_by_id('package_category','category_type',$_GET['package_type']);
    echo "<select id='package_plan' name='package_plan' class='form-control form-control-sm'>";
     echo "<option value=''>Select a category</option>";
    foreach ($get_cat as $cat) { ?>
        <option value="1"><?php echo $cat['name']; ?></option>
    <?php }
     echo "</select>";



 ?>