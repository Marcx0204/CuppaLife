<!DOCTYPE HTML>
<html>
    <head>
        <title>Warenkorb - CuppaLife</title>
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

        <h1>Ihr Warenkorb</h1>
        


        <ul id="cart-list" class="list-group"></ul>

        <div id="total-price"></div>

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
                var listItem = $("<li>");
                listItem.text('Produkt: ' + item.name + ', Preis: ' + item.price + ', Anzahl: ' + item.quantity );

                var removeButton = $("<button>").text("Entfernen");
                removeButton.click(function() {
                    removeItem(item);
                });
                listItem.append(removeButton);

                var decreaseButton = $("<button>").text("-");
                decreaseButton.click(function() {
                    changeQuantity(item, -1);
                });
                listItem.append(decreaseButton);

                var increaseButton = $("<button>").text("+");
                increaseButton.click(function() {
                    changeQuantity(item, 1);
                });
                listItem.append(increaseButton);

                total += parseFloat(item.price) * item.quantity;

                cartList.append(listItem);
            });

            $('#total-price').text('Gesamtpreis: ' + total);
        },
        error: function(err) {
            console.error(err);
        }
    });
}

function removeItem(item) {
    $.ajax({
        url: '../../Backend/logic/warenkorb.php?product_id=' + item.id,
        type: 'DELETE',
        dataType: 'json',
        success: function(data) {
            loadCartItems();
        },
        error: function(err) {
            console.error(err);
        }
    });
}


function changeQuantity(item, change) {
    $.ajax({
        url: '../../Backend/logic/warenkorb.php',
        type: 'PATCH',
        dataType: 'json',
        data: JSON.stringify({ product_id: item.id, quantity_change: change }),
        contentType: 'application/json',  // This line is important
        success: function(data) {
            loadCartItems();
        },
        error: function(err) {
            console.error(err);
        }
    });
}


$(document).ready(function() {
    loadCartItems();
});

        </script>

        <footer>
        <?php
            include 'footer.php';
        ?>
        </footer>
    </body>
</html>
