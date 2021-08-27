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
        
              <h3 class="mb-0">Initiate Withdrawal Request for Client</h3>
            </div>
            <?php if($get_users == null){
              echo "No record found!";
            }{ ?>
            <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form  method="post" id="withdraw_for_client_form"> 
                      <!-- <div class="form-group"> -->
                      
                        <label class="form-control-label" for="input-first-name">Select a Customer</label>
                       
                        <select name="user_id" id="user_id" class="form-control select-2">
                            <option value="">Select a Customer</option>
                            <?php foreach($get_users as $users){?>
                            <option value="<?php echo $users['unique_id']; ?>"><?php echo $users['surname'].' '.$users['other_names'].' ('.$users['email'].')'; ?></option>
                            <?php } ?>
                            
                        </select>
                        <br><br>
                        <div id="spinner_class" class="text-center"></div>
                         <b>Wallet Balance: <b> &#8358;<span id="subscribed_package"></span><br>
                          <input type="hidden" name="wallet_balance" id="wallet_balance">
                          <div id="amount_to_withdraw" style="display: none;" class="mt-3">
                            <label >Amount to Withdraw</label>
                            <input type="number" name="amount_to_withdraw" id="" class="form-control form-control-sm"><br>
                          </div>
                          <button type="button" class="btn btn-primary btn-sm  mb-3" data-toggle="modal" data-target="#add_slot_modal" id="withdraw" style="display: none;">Submit Withdrawal</button>
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

  <div class="modal" id="add_slot_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Withdraw for Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to initiate withdrawal for this client? Please Confirm
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="withdraw_for_client">Submit withdrawal</button>
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
    $('#user_id').change(function(e){
      e.preventDefault();
      var userid = $(this).val(); 
      if(user_id == ""){
        alert("Please select a user");
      }
      else{      
      	$.ajax({
          url:"ajax_admin/get_wallet_balance.php",
          method:"POST",
          data:{userid:userid},
          beforeSend: function(){
            $("#spinner_class").html('Loading... <div class="spinner-border" role="status"></div>');
          },
          success:function(data){
            var wallet_balance = data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $("#spinner_class").empty();
            $('#subscribed_package').html(wallet_balance);
            $('#wallet_balance').val(data);
            $('#amount_to_withdraw').css("display", "block");
            $('#withdraw').css("display", "block");
          //$('#get_liquidation_details').html(data);
          }   
        });
      }
    });  
  });
</script>