<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 
$created_by = $_SESSION['adminid'];


 $get_users = $object->get_rows_from_one_table('users_tbl');
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
        
              <h3 class="mb-0">Backdate a Customer's Investment(RECURRENT)</h3>
            </div>
            <?php if($get_users == null){
              echo "No record found!";
            }{ ?>
            <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form  method="post" id="backdate_investment_form"> 
                      <!-- <div class="form-group"> -->
                      
                        <label class="form-control-label" for="input-first-name">Select a Customer</label>
                       
                        <select name="user_id" id="user_id" class="form-control select-2">
                            <option value="">Select a Customer</option>
                            <?php foreach($get_users as $users){?>
                            <option value="<?php echo $users['unique_id']; ?>"><?php echo $users['other_names'].' '.$users['surname']; ?></option>
                            <?php } ?>
                            
                        </select>
                          
                        <br>
                        <div id="spinner_class" class="text-center"></div>
                         <div id="subscribed_package">
                             
                         </div>
                        <!--   <input type="file" value="" id="filehh" name="file"  class="form-control">
                          <br> -->
                          <br>
                           <!--<input type="submit" value="Backdate Investment" id="cmd_backdate_investment" name="cmd_backdate_investment"  class="btn btn-sm btn-danger">-->
                           <a href="" data-toggle="modal"  data-target="#confirm_investment" class="btn btn-sm btn-danger">Backdate Investment</a>

                      <!-- </div> -->
                         
                           
                        <!-- View Modal-->
                                        <div class="modal fade" id="confirm_investment"  role="dialog" aria-labelledby="myLargeModalLabel"  aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content modal-lg ">
                                        <div class="modal-header">
                                        <h2 class="modal-title" id="exampleModalLabel"> Backdating Investment: <?php echo $package_details['package_name'];?></h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                              <span style="font-size:18px;">Are you sure you want to backdate this investment? </span> <br>
                                              <input type="submit" value="Confirm Backdate Investment" id="cmd_backdate_investment_request" name="cmd_backdate_investment_request"  class="btn btn-sm btn-danger">
                                        </div>
                                        
                                        </div>
                                        </div>
                                        </div>
                            <!-- end of view Modal -->
                      
                      
                       </form>
                       
                       
                      
                       
                       
                       
                     
                       
                       
                       
                       
                       
                       <div id="spinner_classb" class="text-center"></div>
                       
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
      
      $('#cmd_backdate_investment_request').hide();
      // $('#confirm_investment').hide();
    
    //get div for users subscribed packages
    $('#user_id').change(function(e){
        e.preventDefault();
        var userid = $(this).val();
        
        
        
          $.ajax({
            url:"ajax_admin/get_investment_to_backdate_rec.php",
            method:"POST",
            data:{userid:userid},
                        beforeSend: function(){
                        $("#spinner_class").html('<br>Loading... <div class="spinner-border" role="status"></div>');
                        },
            success:function(data){
                      $("#spinner_class").empty();
                      $('#subscribed_package').html(data);
                         
                        
            
            }
    
      });
        
    });
    
    //send backdate request
    $('#cmd_backdate_investment_request').click(function(e){
        e.preventDefault();
        
        $.ajax({
        url:"ajax_admin/send_investment_backdate_request_rec.php",
        method:"POST",
        data:$('#backdate_investment_form').serialize(),
        beforeSend: function(){
        $("#spinner_classb").html('<br>Loading... <div class="spinner-border" role="status"></div>');
        },
        success:function(data){
        $("#spinner_classb").empty();
        
        	if(data == "success"){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully sent request for backdating this investment. It will be effected after other admins have acted on it."
							});
						   setTimeout( function(){ window.location.href = "backdate_investment_rec";}, 7000);
				}
			
			if(data == "exists"){
				    
				    	$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "This request has been sent already"
							});
				}
				
			if(data == "server_error"){
				    
				    	$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Server error Occurred"
							});
				}
                // alert(data);
        
        
        
        }
        
        });
        
    });
    



    
    
});


  </script>