<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 
ini_set('memory_limit', '-1');
$get_users = $object->get_rows_from_one_table('users_tbl');
?>
<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Investment Manager'){
    echo '<meta http-equiv="refresh" content="0; URL=no_access" />';
  }
  ?>
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
        
              <h3 class="mb-0">Transfer Package Ownership</h3>
            </div>
            <?php if($get_users == null){
              echo "No record found!";
            }{ ?>
            <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form  method="post" id="transfer_package_ownership_form"> 
                      <!-- <div class="form-group"> -->
                      <label class="form-control-label" for="input-first-name">Select Owner of Investment</label>
                       
                        <select name="owner_id" id="owner_id" class="form-control select-2">
                          <option value="">Select a Client</option>
                          <?php foreach($get_users as $users){?>
                          <option value="<?php echo $users['unique_id']; ?>"><?php echo $users['surname'].' '.$users['other_names'].' ('.$users['email'].')'; ?></option>
                          <?php } ?>
                        </select>
                        <br><br>
                        <label class="form-control-label" for="input-first-name">Select Receiver of Investment</label>
                        <select name="receiver_id" id="receiver_id" class="form-control select-2">
                          <option value="">Select a Client</option>
                          <?php foreach($get_users as $users){?>
                          <option value="<?php echo $users['unique_id']; ?>"><?php echo $users['surname'].' '.$users['other_names'].' ('.$users['email'].')'; ?></option>
                          <?php } ?>
                        </select>
                        <br><br>
                        <div id="spinner_class" class="text-center">
                        
                      </div>
                         <div id="subscribed_package">
                             
                         </div>
                          <br>
                       </form>
                       <br>
                    </div>
                    <div class="col-lg-3"></div>
             </div>
             <?php } ?>
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
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>

  </div>

   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Initiate Liquidation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to transfer this investment? Please Confirm
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger transfer_package_ownership" id="transfer_package_ownership" type="button">Transfer Ownership</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>

    </div>
  </div>
</div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
    //get div for users subscribed packages
    $('#owner_id').change(function(e){
        e.preventDefault();
        var userid = $(this).val();        
          $.ajax({
            url:"ajax_admin/get_investment_details_for_transfer.php",
            method:"POST",
            data:{userid:userid},
             beforeSend: function(){
                        $("#spinner_class").html('Loading... <div class="spinner-border" role="status"></div>');
                        },
            success:function(data){
                $("#spinner_class").empty();
            $('#subscribed_package').html(data);
            //$('#get_liquidation_details').html(data);
            }   
      });
        
    });  
});
  </script>