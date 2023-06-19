<!DOCTYPE html>
<html lang="de-AT">

<head>
    <title>Help</title>
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

    <main>
    <div class="row g-3">
        <div class="col-md-6 mx-auto">
            <h4>Payment Method</h4>
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <div id="error" style="display:none; background: #c05353;color: #fff;padding: 10px;border-radius: 7px;margin-bottom: 10px;"></div>
                        <form id="add-payment-form">
                            <div class="input-group">
                                <div class="form-group col-md-8">
                                    <label for="cardProvider">Kreditkartenanbieter*</label>
                                    <select class="form-control" name="cardProvider" id="cardProvider" required>
                                        <option value="Visa">Visa</option>
                                        <option value="Mastercard">Mastercard</option>
                                        <option value="American Express">American Express</option>
                                        <option value="Discover">Discover</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="cardNumber" class="font-weight-normal card-text">Card Number*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="cardNumber" placeholder="0000 0000 0000 0000" required maxlength="16">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="expiryDate" class="font-weight-normal card-text">Expiry Date*</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" required maxlength="5">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cvv" class="font-weight-normal card-text">CVC/CVV*</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="cvv" placeholder="000" required maxlength="3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-block">Zahlungsmethode hinzufügen</button>
                            </div>
                            <small class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is secured with ssl certificate</small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


    <script>
 function formatCardNumber(input) {
        // Entferne alle Leerzeichen aus der Eingabe
        var value = input.value.replace(/\s/g, '');

        // Füge Leerzeichen nach jedem vierten Zeichen ein
        var formattedValue = value.replace(/(\d{4})/g, '$1 ').trim();

        // Aktualisiere die Eingabe mit dem formatierten Wert
        input.value = formattedValue;
    }

    function formatExpiryDate(input) {
        // Entferne alle Zeichen außer Ziffern aus der Eingabe
        var value = input.value.replace(/[^\d]/g, '');

        // Füge den "/" nach den ersten zwei Zeichen ein
        var formattedValue = value.replace(/(\d{2})(\d{0,2})/, '$1/$2').trim();

        // Aktualisiere die Eingabe mit dem formatierten Wert
        input.value = formattedValue;
    }


        $(document).ready(function() {
            $('#add-payment-form').submit(function(e) {
                e.preventDefault(); // Verhindert das Standardformular-Verhalten

                // Daten aus dem Formular sammeln
                var cardProvider = $('#cardProvider').val();
                var cardNumber = $('#cardNumber').val();
                var expiryDate = $('#expiryDate').val();
                var cvv = $('#cvv').val();

                var username = '<?php echo $_SESSION["username"]; ?>';

                // AJAX-Anfrage senden
                $.ajax({
                    type: 'POST',
                    url: "../../Backend/logic/add-payment.php", // 
                    data: {
                        cardProvider: cardProvider,
                        cardNumber: cardNumber,
                        expiryDate: expiryDate,
                        cvv: cvv,
                        username: username
                    },
                    success: function(response) {
                        // Erfolgreiche Antwort verarbeiten
                        console.log(response); 
                        // erfolgreichen Abschluss
                        $('#add-payment-form')[0].reset(); // Formularfelder zurücksetzen
                        $('#error').hide(); // Fehlermeldung ausblenden
                        $('#success-message').text('Zahlungsmethode hinzugefügt.'); // Erfolgsmeldung anzeigen
                        $('#success-message').show(); // Erfolgsmeldung einblenden
                    },
                    error: function(xhr, status, error) {
                      
                        console.error(error); 
                        
                        $('#success-message').hide(); // Erfolgsmeldung ausblenden
                        $('#error').text('Fehler: ' + error); // Fehlermeldung anzeigen
                        $('#error').show(); // Fehlermeldung einblenden
                    }
                });
            });
        });
    </script>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>
