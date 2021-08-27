<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 
ini_set('memory_limit', '-1');
$get_packages = $object->get_rows_from_one_table('package_definition');
?>
<body class="">
  <?php include('includes/sidebar.php'); 
    if($role_name !=  'Accountant'){
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
        
              <h3 class="mb-0">View Floating Profit</h3>
            </div>
            <?php if($get_packages == null){
              echo "No record found!";
            }{ ?>
            <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form  method="post" id="view_payout_form"> 
                      <!-- <div class="form-group"> -->
                        <label class="form-control-label" for="input-first-name">Select how you want to view payout</label>
                        <select class="form-control form-control-sm" id="select_payout_option">
                          <option value="">Select an option</option>
                          <option value="all">View payout for all client</option>
                          <option value="view_for_package">View payout for Package</option>
                        </select><br>
                        <div id="view_all_client">
                          <label class="form-control-label" for="input-first-name">Start Date</label>
                          <input type="date" name="start_date" class="form-control form-control-sm" id="start_date" min="<?php echo date("Y-m-d");?>">
                          <br>
                          <label class="form-control-label" for="input-first-name">End Date</label>
                          <input type="date" name="end_date" class="form-control form-control-sm" id="end_date" min="<?php echo date("Y-m-d");?>"><br>
                        </div>
                        <div id="view_by_package">
                          <label class="form-control-label" for="input-first-name">Select a Package</label>
                          <select name="package_id" id="package_id" class="form-control select-2">
                            <option value="">Select a Package</option>
                            <?php foreach($get_packages as $package){?>
                            <option value="<?php echo $package['unique_id']; ?>"><?php echo $package['package_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div><br>
                        <button class="btn btn-primary btn-sm" type="button" id="view_payouts">View Payouts</button>
                        <div id="spinner_class" class="text-center">
                        
                      </div>
                         <div id="payouts_details">
                             
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
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("div#view_all_client").hide();
    $("div#view_by_package").hide();
    $("select#select_payout_option").change(function(){
      var selected_option = $("select#select_payout_option").children("option:selected").val();
      if(selected_option == ''){
        $("div#view_all_client").hide();
        $("div#view_by_package").hide();
        alert("Please select an option");
      }else if(selected_option == 'all'){
        $("div#view_all_client").show();
        $("div#view_by_package").hide();
        $('#view_payouts').click(function(e){
          e.preventDefault();
          if($('#start_date').val() == '' || $('#end_date').val() == ''){
            alert("Please fill all fields");
          }
          else if($('#start_date').val() > $('#end_date').val()){
            alert("Start date must be greater than end date");
          }
          else{ 
            $.ajax({
              url:"ajax_admin/payouts_details.php",
              method:"POST",
              data:$('#view_payout_form').serialize(),
              beforeSend:function(){
                $("#spinner_class").html('Loading... <div class="spinner-border" role="status"></div>');
              },
              success:function(data){
                $("#spinner_class").empty();
               $("#payouts_details").empty();
               $("#payouts_details").html(data);    
              }
            });
          }
        });
      }
      else if(selected_option == 'view_for_package'){
        $("div#view_all_client").show();
        $("div#view_by_package").show();
        $('#view_payouts').click(function(e){
          e.preventDefault();
          var package_id = $("select#package_id").children("option:selected").val();
          if($('#start_date').val() == '' || $('#end_date').val() == '' || package_id == ''){
            alert("Please fill all fields");
          }
          else if($('#start_date').val() > $('#end_date').val()){
            alert("Start date must be greater than end date");
          }
          else{ 
            $.ajax({
              url:"ajax_admin/payouts_details.php",
              method:"POST",
              data:$('#view_payout_form').serialize(),
              beforeSend:function(){
                $("#spinner_class").html('Loading... <div class="spinner-border" role="status"></div>');
              },
              success:function(data){
                $("#spinner_class").empty();
               $("#payouts_details").empty();
               $("#payouts_details").html(data);    
              }
            });
          }
        });
      }
    });
  });
</script>