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
                <!-- Hier werden die Zahlungsmethoden des eingeloggten Benutzers dynamisch generiert -->
                <?php
                // Füge hier den Code ein, um die Zahlungsmethoden des Benutzers abzurufen und anzuzeigen
                ?>
            </select>
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

            
        });

        $("#bestellenButton").click(function() {
    // Request the shopping cart data from the server
    $.ajax({
        url: '../../Backend/logic/warenkorb.php', // URL of the PHP script that returns the cart data
        method: 'GET',
        dataType: 'json',
        success: function(warenkorb) {
            // Once the cart data has been received, send it to the order processing script
            $.ajax({
                url: '../../Backend/logic/kassa.php', // URL of the server-side script that processes the order
                method: 'POST',
                data: JSON.stringify(warenkorb),
                contentType: "application/json",
                success: function(response) {
                    // The request was successful. You can notify the user or update the UI here.
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // The request failed. Handle the error here.
                    console.error(error);
                }
            });
        },
        error: function(xhr, status, error) {
            // The request for the cart data failed. Handle the error here.
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
