<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'; ?>
    <title>Login</title>
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>
    <div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card border-0">
        <div class="card-header bg-white">
          <h1 class="text-center">LOGIN OR CREATE AN ACCOUNT</h1>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="card border-secondary mb-3">
                <div class="card-header bg-transparent border-secondary">
                  <h3 class="text-center">NEW CUSTOMERS</h3>
                </div>

                <div class="card-body text-secondary">
                  <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                  <a class="btn btn-primary btn-lg btn-block" href="register.php">Create an Account</a>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card border-secondary mb-3">
                <div class="card-header bg-transparent border-secondary">
                  <h3 class="text-center">REGISTERED CUSTOMERS</h3>
                </div>

                <div class="card-body text-secondary">
                  <div id="error" style="display:none; background: #c05353;color: #fff;padding: 10px;border-radius: 7px;text-align: center;margin-bottom: 10px;"></div>
                  <form onsubmit="return false;">
                    <div class="form-group">
                      <label for="email">Username</label>
                      <input type="email" class="form-control form-control-lg" id="email" name="username" required>
                    </div>

                    <div class="form-group">
                      <label for="password">Password*</label>
                      <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                    </div>

                    <div class="form-check mb-3">
                      <input type="checkbox" class="form-check-input" name="remember" id="remember">
                      <label class="form-check-label" for="remember">Remember Me</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="login()">Login</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


    <!-- AJAX -->
	<script type="text/javascript">
	    function login(e) {
	        var email 	 = $('#email').val();
	        var password = $('#password').val();
	        var remember = false;
		    if ($("#remember").prop('checked') == true) {
		        remember = true;
		    }
	        $.ajax({
	           type:'POST',
	           url:"../../Backend/logic/login.php",
	           data:{ email:email, password: password, remember: remember},
	           success:function(response){
	           	 	var responseObj = JSON.parse(response);
	                console.log(responseObj.status);
		            if (responseObj.status == "NO") {
		                $("#error").html("These credentials don't match our records.");
		                $("#error").css("display", 'block');
		            } else if (responseObj.status == "OK") {
		                $(location).attr('href', 'index.php');
		            }
	           }
	        });
	    }
	</script>