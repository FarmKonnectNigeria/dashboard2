<?php      
     include('includes/instantiated_files2.php');
     $test = $object->total_withdrawn_per_package('8a38a07ee59c57209f48803de8d0c2bb','d0da8e6af6c47e21291ec94878b27a84');
     $test_decode = json_decode($test,true);
      echo $test_decode['msg'];
    // echo $test;
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<form enctype="multipart/form-data" method="post"> 
                        <!-- Default input -->
              <label for="formGroupExampleInput">Package Category Name</label>
              <input type="text" class="form-control" id="name" name="name">
              <input type="hidden" value="<?php echo $uid; ?>" name="uid" id="uid">
                     
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea class="form-control ckeditor" id="description" name="description" rows="10"></textarea>
                     
                          <input type="file" name="file"  id="file">
              <input type="submit" class="btn btn-primary mt-2 float-right" name="create_packages" value="Create Category" id="create_packages">
        </form> 
</body>
</html>
