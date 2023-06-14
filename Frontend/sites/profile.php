<?php

// Überprüfen, ob der Benutzer eingeloggt ist, sonst zur Login-Seite weiterleiten

?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'head.php';
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    } ?>
</head>

<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-md-7">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Informationen</div>
                    <div class="card-body">
                        <form id="account-details-form">
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Benutzername</label>
                                <input class="form-control" id="inputUsername" type="text"
                                    value="<?php echo $_SESSION['username']; ?>" readonly>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email Adresse</label>
                                <input class="form-control" id="email" type="email">
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">Vorname</label>
                                    <input class="form-control" id="inputFirstName" type="text">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Nachname</label>
                                    <input class="form-control" id="inputLastName" type="text">
                                </div>
                            </div>
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="address">Straße</label>
                                    <input class="form-control" id="address" type="text">
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="zip_code">PLZ</label>
                                    <input class="form-control" id="zip_code" type="text">
                                </div>
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="town">Stadt</label>
                                    <input class="form-control" id="town" type="text">
                                
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="currentPassword">Passwort</label>
                                <input class="form-control" id="currentPassword" type="password"
                                    placeholder="Gebe dein Passwort ein um Daten zu ändern">
                            </div>
                        </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit">Änderungen speichern</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <!-- Change password card-->
                <div class="card mb-4">
                    <div class="card-header">Passwort ändern</div>
                    <div class="card-body">
                        <form id="change-password-form">
                            <!-- Form Group (current password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="currentPassword1">altes Passwort</label>
                                <input class="form-control" id="currentPassword1" type="password"
                                    placeholder="Gebe dein altes Passwort ein">
                            </div>
                            <!-- Form Group (new password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="newPassword">Neues Passwort</label>
                                <input class="form-control" id="newPassword" type="password"
                                    placeholder="Gebe ein neues Passwort ein">
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="confirmPassword">Passwort wiederholen</label>
                                <input class="form-control" id="confirmPassword" type="password"
                                    placeholder="Bestätige dein neues Passwort">
                            </div>
                            <button class="btn btn-primary" type="submit">Neues Passwort speichern</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <script>
        $(document).ready(function() {
            // AJAX-Anfrage, um Benutzerdaten abzurufen
            $.ajax({
                type: 'GET',
                url: '../../Backend/logic/get-user-data.php',
                success: function(response) {
                    var user = JSON.parse(response);

                    // Setzen Sie die Werte der Formularfelder
                    $('#inputUsername').val(user.username);
                    $('#email').val(user.email);
                    $('#inputFirstName').val(user.f_name);
                    $('#inputLastName').val(user.l_name);
                    $('#address').val(user.address);
                    $('#zip_code').val(user.zip_code);
                    $('#town').val(user.town);

                // Überprüfen des Passworts
                if (currentPassword === "") {
                    alert("Bitte gebe dein aktuelles Passwort ein.");
                    return;
                }
                },
                error: function(xhr, status, error) {
                    alert('Ein Fehler ist aufgetreten: ' + error);
                }
            });

            $('#account-details-form').submit(function(e) {
                e.preventDefault();

                var email = $('#email').val();
                var firstName = $('#inputFirstName').val();
                var lastName = $('#inputLastName').val();
                var street = $('#address').val();
                var zipCode = $('#zip_code').val();
                var city = $('#town').val();
                var currentPassword = $('#currentPassword').val();

                // Überprüfen des Passworts
                if (currentPassword === "") {
                    alert("Bitte gebe dein aktuelles Passwort ein.");
                    return;
                }

                // AJAX-Anfrage, um Benutzerdaten zu aktualisieren
                $.ajax({
                    type: 'POST',
                    url: '../../Backend/logic/update-profile.php',
                    data: {
                        email: email,
                        f_name: firstName,
                        l_name: lastName,
                        address: street,
                        zip_code: zipCode,
                        town: city,
                        currentPassword: currentPassword
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        alert(result.message);
                    },
                    error: function(xhr, status, error) {
                        alert('Ein Fehler ist aufgetreten: ' + error);
                    }
                });
            });
            
        $('#change-password-form').submit(function(e) {
        e.preventDefault();

        var username = $('#inputUsername').val();
        var currentPassword1 = $('#currentPassword1').val();
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();

        if (newPassword !== confirmPassword) {
        alert('Die Passwörter stimmen nicht überein.');
        return;
    }

    // Überprüfen des Passworts
    if (currentPassword1 === "") {
        alert("Bitte gebe dein altes Passwort ein.");
        return;
    }


        $.ajax({
            type: 'POST',
            url: '../../Backend/logic/update-password.php',
            data: {
                username: username,
                currentPassword: currentPassword1,
                newPassword: newPassword
            },
            success: function(response) {
                var result = JSON.parse(response);
                alert(result.message);
            },
            error: function(xhr, status, error) {
                alert('Ein Fehler ist aufgetreten: ' + error);
            }
        });
    });
        });
    </script>
</body>

</html>
