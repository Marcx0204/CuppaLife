
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
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h1 class="text-center">Erstelle einen Konto</h1>
        </div>

        <div class="card-body">
          <div id="error" style="display:none; background: #c05353;color: #fff;padding: 10px;border-radius: 7px;margin-bottom: 10px;"></div>
          <form id="registration-form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group col-md-11">
                  <label for="type">Anrede*</label>
                  <select class="form-control" name="type" id="type">
                    <option value="Herr">Herr</option>
                    <option value="Frau">Frau</option>
                  </select>
                </div>

                <div class="form-group col-md-11">
                  <label for="f_name">Vorname*</label>
                  <input type="text" class="form-control" name="f_name" id="f_name" required>
                </div>

                <div class="form-group col-md-11">
                  <label for="l_name">Nachname*</label>
                  <input type="text" class="form-control" name="l_name" id="l_name" required>
                </div>

                <div class="form-group col-md-11">
                  <label for="address">Adresse*</label>
                  <input type="text" class="form-control" name="address" id="address" required>
                </div>

                <div class="form-group col-md-11">
                  <label for="zip_code">PLZ*</label>
                  <input type="text" class="form-control" name="zip_code" id="zip_code" required>
                </div>

                <div class="form-group col-md-11">
                  <label for="town">Stadt*</label>
                  <input type="text" class="form-control" name="town" id="town" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group col-md-11">
                  <label for="username">Benutzername*</label>
                  <input type="text" class="form-control" name="username" id="username" required>
                </div>

                <div class="form-group col-md-11">
                  <label for="email">Email Adresse*</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>

                <div class="form-group col-md-11">
                  <label for="password">Passwort*</label>
                  <input type="password" class="form-control" name="password" id="password" minlength="8" required>
                </div>

                <div class="form-group col-md-11">
                  <label for="confirm_password">Passwort wiederholen*</label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password" minlength="8" required>
                </div>
              </div>
            </div>

            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary">Registrieren</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
 $(document).ready(function() {
  $('#registration-form').submit(function(e) {
    e.preventDefault(); // Verhindert das Standardformular-Verhalten

    // Daten aus dem Formular sammeln
    var password = $('#password').val();
    var confirm_password = $('#confirm_password').val();

    // Überprüfen, ob die Passwörter übereinstimmen
    if (password !== confirm_password) {
      $('#error').text('Die Passwörter stimmen nicht überein'); // Fehlermeldung anzeigen
      $('#error').show(); // Fehlermeldung einblenden
      return;
    }

      // Daten aus dem Formular sammeln
      var type = $('#type').val();
      var username = $('#username').val();
      var f_name = $('#f_name').val();
      var l_name = $('#l_name').val();
      var address = $('#address').val();
      var zip_code = $('#zip_code').val();
      var town = $('#town').val();
      var email = $('#email').val();
      var password = $('#password').val();
      var confirm_password = $('#confirm_password').val();

      // AJAX-Anfrage senden
      $.ajax({
        type: 'POST',
        url: '../../Backend/logic/register.php',
        data: {
          type: type,
          username: username,
          f_name: f_name,
          l_name: l_name,
          address: address,
          zip_code: zip_code,
          town: town,
          email: email,
          password: password,
          confirm_password: confirm_password
        },
        success: function(response) {
          // Erfolgreiche Antwort verarbeiten
          console.log(response); // Hier können Sie die Serverantwort überprüfen
          // Fügen Sie hier den Code hinzu, um auf den erfolgreichen Abschluss zu reagieren
          $('#registration-form')[0].reset(); // Formularfelder zurücksetzen
          $('#error').hide(); // Fehlermeldung ausblenden
          $('#success-message').text('Registrierung erfolgreich.'); // Erfolgsmeldung anzeigen
          $('#success-message').show(); // Erfolgsmeldung einblenden
          window.location.href = 'index.php';
        },
        error: function(xhr, status, error) {
          // Fehlerhafte Antwort verarbeiten
          console.error(error); // Hier können Sie den Fehler überprüfen
          // Fügen Sie hier den Code hinzu, um auf den Fehler zu reagieren
          $('#success-message').hide(); // Erfolgsmeldung ausblenden
          $('#error').text('Fehler: ' + error); // Fehlermeldung anzeigen
          $('#error').show(); // Fehlermeldung einblenden
        }
      });
    });
  });
</script>




</body>

<footer>
<?php
				include 'footer.php';
			?>
</footer>

</html>