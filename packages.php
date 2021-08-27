<?php include('includes/instantiated_files.php');
 include('includes/header.php');
//$getpack = $object->get_rows_from_one_table('package_definition');
$military = "";


$getcate = $object->get_rows_from_one_table_by_id('package_category','visibility',1);
$getpack = $object->get_rows_from_one_table_by_id('package_definition','visibility',1);



?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          
          
                <div class='row'>
                     <div class='col-md-1'></div>
                     <div class='col-md-10'>
                            <form method='post'>
                                <label style='color:white;'>Select A Category</label><br>
                                <select class='form-control form-control-sm js-example-basic-single' id='category_det' name='category_det'>
                                    <option value=''>Filter Package Category</option>
                                    <!--<option value='all'>View All Packages</option>-->
                                    <?php 
                                            foreach($getcate as $catt){
                                    ?>
                               
                                     <option value='<?php echo $catt['unique_id']; ?>'><?php echo $catt['name']; ?></option>
                               
                                   <?php } ?>
                                </select>
                            </form>
                     </div>
                     <div class='col-md-1'></div>
                 </div>
                 
                 
          
          <div id="spinner_class" class="text-center" style="color:white; margin-top: 18px;"></div>
      <!--<div class="text-center"></div>-->
          
          <hr>
           
       
          <div id='display_packages'>

                
                
            </div>
            <!--  end display div-->
                
                

        </div>
      </div>
    </div>
    
    
    <hr>
    <div class="container-fluid mt--7">
      <!-- Table -->
    
    




    </div>

  </div>
    <!-- Footer -->
 
  <?php //include('includes/footer.php'); ?>
  <!--   Core   -->
  <?php include('includes/scripts.php'); ?>
    
    
    <script type="text/javascript">
    // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
        $('.js-example-basic-single').select2();
        //$('#display_packages').empty();
        
        
        
        
        
        
         $('.cmd_subscribe_pack222').click(function(e){
        
            e.preventDefault();
		    let unique_id = $(this).attr('id');
		    //alert('unique_id');
		    $('#display_results'+unique_id).empty();
              $.ajax({
						url:"ajax_scripts/subscribe_to_package.php",
						method:"POST",
						data: $('#subscribe_pack_form'+unique_id).serialize(),
						
						success:function(data){
				
                		// $('#display_results'+unique_id).html("<div style='background-color:lightgrey;'>"+data+"</div>");
							
						if(data == 300){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Please enter number of slots to buy"
							});
						}

							if(data == 400){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Please agree to terms and conditions"
							});
						}


						if(data == 500){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You cannot buy more than available slots"
							});
						}

					
							if(data == 600){
							$.alert({
							title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You cannot buy less than the minimum slot"
							});
						}


						if(data == 700){
							$.alert({
							title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Insufficient wallet balance. Fund your wallet"
							});
						}

							if(data == 800){
							$.alert({
							title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Transaction Log Insertion Error"
							});
						}

							if(data == 900){
							$.alert({
							title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Something went wrong"
							});
						}
						
						if(data == 1000){
							$.alert({
							title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Your Wallet has been deactivated, please contact FarmKonnect for more information"
							});
						}

							if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully subscribed to this package, you will be redirected shortly..."
							});
						   setTimeout( function(){ window.location.href = "mypackages";}, 4000);

						}



							// setTimeout( function(){ window.location.href = "profile";}, 4000);
							}	


						
						});
        });
        
        
        
        	$('.cmd_subscribe_pack_military').click(function(e){
			e.preventDefault();
		    var unique_id = $(this).attr('id');
		    //alert(unique_id);
		    $('#display_results'+unique_id).empty();
              $.ajax({
						url:"ajax_scripts/send_request_military.php",
						method:"POST",
						data: $('#subscribe_pack_form'+unique_id).serialize(),
						
						success:function(data){
				        //alert(data);
                		// $('#display_results'+unique_id).html("<div style='background-color:lightgrey;'>"+data+"</div>");
							
						if(data == 300){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Please enter number of slots to buy"
							});
						}

						if(data == 400){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Please agree to terms and conditions"
							});
						}


						if(data == 500){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You cannot buy more than available slots"
							});
						}

					
                       if(data == 600){
                        $.alert({
                        title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
                        closeAnimation: 'left',content: "You cannot buy less than the minimum slot"
                        });
                        }


						
                        if(data == 900){
                        $.alert({
                        title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
                        closeAnimation: 'left',content: "Something went wrong"
                        });
                        }
						
						
						if(data == 1000){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Oops! You have a pending request"
							});
						}
					

                        if(data == 200){
                        $.alert({
                        title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
                        closeAnimation: 'left',content: "You have successfully sent a subscription request for military package, Kindly ensure you have sufficient money in your wallet to ensure successful approval. You will be redirected shortly..."});
                        setTimeout( function(){ window.location.href = "mypackages";}, 4000);
                        
                        }


						} ///close function
						
						});
		    
		
	});
        
        
        
        
        
        $('#category_det').change(function(){
        var catid = $(this).val();
        //alert(catid);
        if(catid == 'all'){
            setTimeout( function(){ window.location.href = "packages";}, 1000);
        }else{
               $.ajax({
        		url:"ajax_scripts/display_unique_packages.php",
        		method:"POST",
        		data:{catid:catid},
                beforeSend: function(){
                $("#spinner_class").html('Loading... <div class="spinner-border" role="status"></div>');
                },
        		success:function(data){
        		            $("#spinner_class").empty();
                    		$('#display_packages').html(data);
        		}
        	});
        }
         
        });
        
         });  
    </script>