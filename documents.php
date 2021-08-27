<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
$created_by = $_SESSION['uid'];
 if(isset($_POST['upload_document'])){
            $filename =  $_FILES['file']['name'];
            $created_by = $_SESSION['uid'];
            $size =  $_FILES['file']['size'];
            $type =  $_FILES['file']['type'];
            $tmpName  = $_FILES['file']['tmp_name'];
            $document_name = $_POST['document_name'];
            $table = 'document_tbl';
            $upload_document = $object->upload_document($table, $document_name, $created_by, $filename, $size, $tmpName, $type);
    $upload_document_decode = json_decode($upload_document, true);
     //$msg = $upload_document_decode['msg'];
    if($upload_document_decode['status'] == '1'){ 
      $object->insert_users_logs($_SESSION['uid'], 'Uploaded a document');
      echo "<script> alert('Document uploaded successfully');
      window.location.href = '';
      </script>";
   }else{
      echo "<script> alert('Error in uploading document');
      </script>";
   }
 }

 $get_documents = $object->get_rows_from_table_by_user_id('document_tbl','user_id',$created_by);
$get_admin_documents = $object->get_rows_from_one_table_by_id('admin_document_tbl', 'shared_status', 1);
?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->


    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8"  >
     
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->

      <div class="row" style="margin-top: -160px;">

        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
                        <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#add_slot_modal"><i class="fas fa-plus-circle"></i> 
            Upload Documents
          </button>

            <!-- Modal -->
            <div class="modal fade" id="add_slot_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="" enctype="multipart/form-data">
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-10">
                        <input type="text" name="document_name" class="form-control" placeholder="Document Name">
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-10">
                        <div class="form-group mt-4">
                          <label for="">Document</label>
                          <input type="file" class="form-control" id="" name="file">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-success mt-2" type="submit" name="upload_document">Upload Document</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </form >
                  </div>
                </div>
              </div>
            </div>
              <h3 class="mb-0">These are the documents you uploaded</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_documents == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Document Name</th>
                        
                        <th scope="col">Document</th>
                        <th scope="col">Date Uploaded</th>
                        <!-- <th scope="col">Date</th> -->
                        <th scope="col">Action</th>

                  </tr>
                </thead>
                <?php
                      foreach ($get_documents as $value) {
                        $image_url = explode('/', $value['image_url']);
                        if($image_url[1] == 'uploads'){
                            $image = $image_url[2];
                        }else{
                            $image = $image_url[1];
                        }
                      ?>
                <tbody>
                  <tr>
                        <td><?php echo $value['document_name']?></td>
                        <td><a href="<?php echo $value['image_url']?>" class="thumbnail fancybox" rel="ligthbox"><?php echo $image?></a></td>
                        <td><?php echo $value['date_created']?></td>
                        <td><button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $value['id']; ?>"><i class="fa fa-trash-alt"></i></button></td>
                      </tr>
                </tbody>

                         <div class="modal fade" id="delete<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete Document</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                 Are you sure you want to delete this document?
                                </div>
                                <div class="modal-footer">
                                   <form method="post" id="document_form<?php echo $value['unique_id']; ?>">
                                     <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                  </form> 
                                  <button class="btn btn-success get_delete_id" id="<?php echo $value['unique_id']; ?>">Yes</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                     
                      <?php } }?>
              </table><br><br>
            </div>

             <h3 class="mb-0 mx-4">These are the documents uploaded by FarmKonnect</h3>
            <div class="table-responsive"><br><br>
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                      <tr>
                        <th scope="col">Document Name</th>
                        <th scope="col">Image Url</th>
                        <th scope="col">Date Uploaded</th>
                        <th scope="col">Action</th>

                      </tr>
                    </thead>
                    <?php
                      if($get_admin_documents){
                      foreach ($get_admin_documents as $value) {
                        $image_url = explode('/', $value['image_url']);
                        $image = $image_url[1];
                      ?>
                    <tbody>
                      <tr>
                        <td><?php echo $value['document_name']?></td>
                        <td><a href="admin/<?php echo $value['image_url']?>" class="thumbnail fancybox" rel="ligthbox"><?php echo $image;?></a></td>
                        <td><?php echo $value['date_created']?></td>
                        <td><a href="admin/<?php echo $value['image_url']?>" class="btn btn-primary btn-sm" download><i class="fas fa-download"></i> Download</a></td>
                      </tr>
                    </tbody>
                      <?php } }?>
              </table>
            </div>
            <div class="card-footer py-4">
              <!-- <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav> -->
            </div>
          </div>
        </div>
      </div>
      
          
      <br>
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>

  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
  </script>