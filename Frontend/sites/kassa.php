<!DOCTYPE HTML>
<html>
<head>
    <title>CuppaLife - Kassa</title>
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

    <div class="container mt-4">
        <h2>Kassa</h2>
        <ul class="list-group" id="cart-list"></ul>
        <div class="mt-4">
            <h4>Gesamtpreis: <span id="total-price"></span></h4>
        </div>
        <div class="mt-4">
    <h4>Zahlungsmethode auswählen:</h4>
    <select class="form-control" id="payment-method">
        <option value="">Bitte wählen...</option>
    </select>
</div>

        </div>
        <div class="mt-4">
            <button type="button" class="btn btn-primary" id="bestellenButton">Jetzt bezahlen</button>
        </div>
    </div>

    <script>
        
        function loadCartItems() {
            $.ajax({
                url: '../../Backend/logic/warenkorb.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var cartList = $("#cart-list");
                    cartList.empty();
                    var total = 0;

                    data.forEach(function(item) {
                        var listItem = $("<li>").addClass("list-group-item d-flex justify-content-between");

                        var productImage = $('<img src="../../Backend/uploads/' + item.img + '" alt="' + item.name + '">');
                        productImage.addClass("img-thumbnail").attr("style", "width:120px; height:120px;");

                        var productName = $('<div>').addClass('font-weight-bold mb-1').text('Produkt: ' + item.name);
                        var productPrice = $('<div>').text('Preis: ' + item.price);
                        var productQuantity = $('<div>').text('Anzahl: ' + item.quantity);

                        var productInfo = $('<div>').addClass('d-flex align-items-center').append(productImage, $('<div>').addClass('ml-3').append(productName, productPrice, productQuantity));

                        listItem.append(productInfo);
                        cartList.append(listItem);

                        total += parseFloat(item.price) * item.quantity;
                    });

                    $('#total-price').text(total);
                },
                error: function(err) {
                    console.error(err);
                }
            });
        }

        $(document).ready(function() {
            loadCartItems();
        // AJAX-Anfrage, um Zahlungsmethoden abzurufen
        $.ajax({
            type: 'GET',
            url: '../../Backend/logic/get-payment-methods.php',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'OK') {
                    var paymentMethods = response.paymentMethods;

                    // Dropdown-Menü mit den Zahlungsmethoden füllen
                    var dropdown = $('#payment-method');
                    dropdown.empty();

                    paymentMethods.forEach(function(method) {
                        var option = $('<option>').attr('value', method).text(method);
                        dropdown.append(option);
                    });
                } else {
                    // Fehler beim Abrufen der Zahlungsmethoden
                    alert('Fehler beim Abrufen der Zahlungsmethoden');
                }
            },
            error: function(xhr, status, error) {
                // Fehler beim AJAX-Aufruf
                alert('Ein Fehler ist aufgetreten: ' + error);
            }
        });
    });

    

    
    $("#bestellenButton").click(function() {
    // Ausgewählte Zahlungsmethode abrufen
    var selectedPaymentMethod = $('#payment-method').val();
    
    // Request the shopping cart data from the server before clearing the cart
    $.ajax({
        url: '../../Backend/logic/warenkorb.php', // URL of the PHP script that returns the cart data
        method: 'GET',
        dataType: 'json',
        success: function(warenkorb) {
            // Once the cart data has been received, send it to the order processing script
            var orderData = {
                warenkorb: warenkorb,
                paymentMethod: selectedPaymentMethod // Hinzufügen der ausgewählten Zahlungsmethode zur Bestelldaten
            };

            $.ajax({
                url: '../../Backend/logic/kassa.php', // 
                method: 'POST',
                data: JSON.stringify(orderData),
                contentType: "application/json",
                cache: false,
                success: function(response) {
                    // The request was successful
                    console.log(response);

                    // After order is successfully placed, clear the cart
                    $.ajax({
                        url: '../../Backend/logic/warenkorb.php?empty_cart=true',
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            // reset cart count
                            $('#cart-count').text(0);
                            window.location.href = "profile.php";

                        },
                        error: function(err) {
                            console.error(err);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // The request failed. 
                    console.error(error);
                }
            });
        },
        error: function(xhr, status, error) {
            // The request for the cart data failed.
            console.error(error);
        }
    });
});


    </script>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
