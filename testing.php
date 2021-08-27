<?php include('includes/header.php');?>
<div class="container">
	<form method="post" id="submit_form">
		<div class="form-control">
			<label>Name:</label>
			<input type="text" name="name" id="name">
		</div><br>
		<div class="form-control">
			<label>Email:</label>
			<input type="email" name="email" id="email">
		</div><br>
		<div class="form-control">
			<label>Password:</label>
			<input type="password" name="password" id="password">
		</div>
		<div class="" id="errors"></div>
		<button class="btn btn-primary" id="submit_data" type="button">Submit</button>
	</form>
</div>
<?php include('includes/scripts.php');?>
<script type="text/javascript">
	$('#submit_data').click(function(){
		var name = $('#name').val();
		var email = $('#email').val();
		var password = $('#password').val();
		if(!name | !email | !password){
			$('#errors').text("Empty field(s) found").removeClass("text-green").addClass("text-red");
		}else{
		$('#errors').addClass("text-green").text(name + ' '+ email +' ' + password);
		//alert(name + email + password);
	}
	});
</script>