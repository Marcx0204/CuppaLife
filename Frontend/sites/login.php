<!DOCTYPE HTML>
<html>
	<head>
		<title>CuppaLife</title>
        <?php
			include 'head.php';
		?>
	
	</head>
	<body>
        <header>
			<?php 
				include 'navbar.php';
			?>
		</header>

    <div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-7">
    <div class="card">
        <div class="card-header">
          <h1 class="text-center">Anmelden</h1>
        </div>

        <div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card border-secondary mb-3">
                <div class="card-header bg-transparent border-secondary">
                    <h3 class="text-center">Neuer Kunde</h3>
                </div>

                <div class="card-body text-secondary">
                    <p>Indem Sie ein Konto in unserem Shop erstellen, können Sie den Bestellvorgang schneller durchlaufen, mehrere Lieferadressen speichern, Ihre Bestellungen anzeigen und verfolgen und vieles mehr.</p>
                    <a class="btn" href="register.php">Konto erstellen</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-secondary mb-3">
                <div class="card-header bg-transparent border-secondary">
                    <h3 class="text-center">Registrierte Kunden</h3>
                </div>

                <div class="card-body text-secondary">
                    <div id="error" style="display:none; background: #c05353;color: #fff;padding: 10px;border-radius: 7px;text-align: center;margin-bottom: 10px;"></div>
                    <form id="form">
                        <div class="form-group col-md-11">
                            <label for="username">Benutzername*</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="form-group col-md-11">
                            <label for="password">Passwort*</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn">Anmelden</button>
                        </div>
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

   <script type="text/javascript">
    $(document).ready(function() {
        $('form').submit(function(e) {
            e.preventDefault(); // Das Standardverhalten des Submit-Buttons verhindern
            login(); // Die login-Funktion aufrufen
        });
    });
   
   function login() {
        var username = $('#username').val(); // Hier wird der Wert des Benutzernamens aus dem E-Mail-Eingabefeld gelesen
        var password = $('#password').val();

        $.ajax({
            type: 'POST',
            url: "../../Backend/logic/login.php",
            data: {
                username: username, // Hier wird der Benutzername als "username" gesendet
                password: password,
            },
            success: function(response) {
                var responseObj = JSON.parse(response);
                console.log(responseObj.status);
                if (responseObj.status === "NO") {
                    $("#error").html("These credentials don't match our records.");
                    $("#error").css("display", 'block');
                } else if (responseObj.status === "OK") {
                    window.location.href = 'index.php';
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
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