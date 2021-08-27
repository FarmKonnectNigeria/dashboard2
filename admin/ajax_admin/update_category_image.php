<?php
 include('../includes/instantiated_files.php');
$category_name_img = $_POST['category_name_img'];
if($category_name_img == ""){
        $packaged = $object->get_one_row_from_one_table('package_category','unique_id',$category_name_img);
        // $form .="<h3>Package Details</h3>";
        $form = "<h5><b>No category was selected!</b></h5>";
        
        
        echo $form;
}else{
        $packaged = $object->get_one_row_from_one_table('package_category','unique_id',$category_name_img);
        // $form .="<h3>Category Details</h3>";
        $form = "<h5><b><u>Current Image:</u></b></h5>";
        $form .= '<img src="'.$packaged['image_url'].'" width="120px" height="120px;"><hr>';
        $form .='<input type="file"  id="package_image"  name="package_image"><hr>';
        $form .='<input type="submit"  id="cmd_update" value="Update Image" name="cmd_update" class="btn btn-sm btn-success"><hr>';
        
        echo $form;
}


 ?>