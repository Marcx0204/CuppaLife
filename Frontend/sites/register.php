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


        <div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h1 class="text-center">CREATE AN ACCOUNT</h1>
        </div>

        <div class="card-body">
          <div id="error" style="display:none; background: #c05353;color: #fff;padding: 10px;border-radius: 7px;margin-bottom: 10px;"></div>
          <form onsubmit="return false;">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="type">Title</label>
                  <select class="form-control" name="type" id="type">
                    <option value="Mr">Mr</option>
                    <option value="Ms">Ms</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="f_name">First Name*</label>
                  <input type="text" class="form-control" name="f_name" id="f_name" required>
                </div>

                <div class="form-group">
                  <label for="l_name">Last Name*</label>
                  <input type="text" class="form-control" name="l_name" id="l_name" required>
                </div>

                <div class="form-group">
                  <label for="address">Address*</label>
                  <input type="text" class="form-control" name="address" id="address" required>
                </div>

                <div class="form-group">
                  <label for="zip_code">Zip Code*</label>
                  <input type="text" class="form-control" name="zip_code" id="zip_code" required>
                </div>

                <div class="form-group">
                  <label for="town">Town*</label>
                  <input type="text" class="form-control" name="town" id="town" required>
                </div>

                <div class="form-group">
                  <label for="email">Email Address*</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="username">Username*</label>
                  <input type="text" class="form-control" name="username" id="username" required>
                </div>

                <div class="form-group">
                  <label for="password">Password*</label>
                  <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class="form-group">
                  <label for="confirm_password">Confirm Password*</label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                </div>
              </div>
            </div>

            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary" onclick="register()">Register</button>
            </div>
          </form>
        </div>
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
	           url:"../Backend/logic/register.php",
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