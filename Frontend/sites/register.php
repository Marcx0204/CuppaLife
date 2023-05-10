<?php 
  session_start(); 
  if (isset($_SESSION['name'])) {
  	header('location: index.php');
  }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>CuppaLife</title>
        <?php
			include 'head.php';
		?>
		
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		</script>
		<!----webfonts---->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<!----//webfonts---->
		<!----start-alert-scroller---->
		<script src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.easy-ticker.js"></script>
		<!----start-alert-scroller---->
		<!-- start menu -->
		<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
		<script type="text/javascript" src="js/megamenu.js"></script>
		<script src="js/menu_jquery.js"></script>
		<!-- //End menu -->
		<!---slider---->
		<link rel="stylesheet" href="css/slippry.css">
		<script src="js/jquery-ui.js" type="text/javascript"></script>
		<script src="js/scripts-f0e4e0c2.js" type="text/javascript"></script>
		<!----start-pricerage-seletion---->
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
		<!----//End-pricerage-seletion---->
		<!---move-top-top---->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<!---//move-top-top---->


		<script src="js/code-js/login.js"></script>
		<script src="js/code-js/register.js"></script>

		<style type="text/css">
			input[type="password"],
			input[type="email"]
			{
				border: 1px solid #EEE;
			    outline-color: #E45D5D;
			    width: 96%;
			    font-size: 1em;
			    padding: 0.5em;
			    font-family: 'Open Sans', sans-serif;
			}
		</style>
	</head>
	<body>
		<!---start-wrap---->

        <header>
			<?php 
				include 'navbar.php';
			?>
		</header>


			<!--- start-content---->
			<div class="content login-box">
				<div class="login-main">
					<div class="wrap">
						<h1>CREATE AN ACCOUNT</h1>

						<div id="error" style="display:none; background: #c05353;color: #fff;padding: 10px;border-radius: 7px;margin-top: 10px;"></div>

						<div class="register-grids">
							<form onsubmit="return false;">
								<div class="register-top-grid">
										<h3>PERSONAL INFORMATION</h3>

										<div>
											<span>Mr/Ms<label>*</label></span>
											<select name="type" id="type" style="border: 1px solid #EEE;outline-color: #E45D5D;width: 96%;font-size: 0.9em;padding: 0.5em;font-family: 'Open Sans', sans-serif;">
												<option value="Mr">Mr</option>
												<option value="Ms">Ms</option>
											</select> 
										</div>

										<div>
											<span>Username<label>*</label></span>
											<input type="text" name="username" id="username" required> 
										</div>

										<div>
											<span>First Name<label>*</label></span>
											<input type="text" name="f_name" id="f_name" required> 
										</div>

										<div>
											<span>Last Name<label>*</label></span>
											<input type="text" name="l_name" id="l_name" required> 
										</div>

										<div>
											<span>Address<label>*</label></span>
											<input type="text" name="address" id="address" required> 
										</div>

										<div>
											<span>Zip Code<label>*</label></span>
											<input type="text" name="zip_code" id="zip_code" required> 
										</div>

										<div>
											<span>Town<label>*</label></span>
											<input type="text" name="town" id="town" required> 
										</div>

										<div>
											<span>Email Address<label>*</label></span>
											<input type="email" name="email" id="email" required> 
										</div>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<div class="register-bottom-grid">
										<h3>LOGIN INFORMATION</h3>
										<div>
											<span>Password<label>*</label></span>
											<input type="password" name="password" id="password" required>
										</div>
										<div>
											<span>Confirm Password<label>*</label></span>
											<input type="password" name="confirm_password" id="confirm_password" required>
										</div>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<button onclick="register()" class="acount-btn">Register</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		
	<!-- AJAX -->
	<script type="text/javascript">
	    function register(e) {
	        var type 	 	= $('#type').val();
	        var username 	= $('#username').val();
	        var f_name 	 	= $('#f_name').val();
	        var l_name 	 	= $('#l_name').val();
	        var address 	= $('#address').val();
	        var zip_code 	= $('#zip_code').val();
	        var town 	= $('#town').val();
	        var email 	 	= $('#email').val();
	        var password 	= $('#password').val();
	        var confirm_password = $('#confirm_password').val();

	        if (confirm_password != password) {
	        	$("#error").html("Password should match confirm password.");
		        $("#error").css("display", 'block');
		        return false;
	        }
	        
	        $.ajax({
	           type:'POST',
	           url:"../../Backend/logic/register.php",
	           data:{
	           		type: type, 
	           		username: username, 
	           		f_name: f_name, 
	           		l_name: l_name, 
	           		address: address, 
	           		zip_code: zip_code, 
	           		town: town, 
	           		email:email, 
	           		password: password, 
	           		confirm_password:confirm_password
	           	},
	           success:function(response){
	           	 	var responseObj = JSON.parse(response);
	                console.log(responseObj.status);
		            if (responseObj.status == "Yes") {
		            	$(location).attr('href', 'login.php');
		            } else {
		                $("#error").html(responseObj.status);
		                $("#error").css("display", 'block');
		            }
	           }
	        });
	    }
	</script>

</body>

<footer>
<?php
				include 'footer.php';
			?>
</footer>

</html>