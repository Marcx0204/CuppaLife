<!DOC<!DOCTYPE HTML>
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
        <div class="container mt-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Warenkorb</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group" id="cart-list"></ul>
        
                    <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                        <div class="mt-4">
                            <label class="text-muted font-weight-normal">Promocode</label>
                            <input type="text" placeholder="ABC" class="form-control">
                        </div>
                        <div class="d-flex">
                            <div class="text-right mt-4 mr-4">
                                <strong><label class="text-muted font-weight-normal m-0">Total price</label></strong>
                                <strong><div id="total-price"></div></strong>
                            </div>
                        </div>
                    </div>
        
                    <div class="float-right">
                        <button type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">Zurück zu Produkten</button>
                        <button type="button" class="btn btn-lg btn-primary mt-2" onclick="window.location.href = 'kassa.php';">Zur Kasse</button>
                    </div>

                </div>
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

    var productImage = $('<img src="../../Backend/uploads/'+ item.img +'" alt="'+ item.name +'">');
    productImage.addClass("img-thumbnail").attr("style", "width:120px; height:120px;"); // set image size

    var productName = $('<div>').addClass('font-weight-bold mb-1').text('Produkt: ' + item.name);
    var productPrice = $('<div>').text('Preis: ' + item.price);
    var productQuantity = $('<div>').text('Anzahl: ' + item.quantity);

    var productInfo = $('<div>').addClass('d-flex align-items-center').append(productImage, $('<div>').addClass('ml-3').append(productName, productPrice, productQuantity));
    
    var decreaseButton = $("<button>").addClass('btn2').text("-");
        decreaseButton.click(function() {
            changeQuantity(item, -1);
        });

    var increaseButton = $("<button>").addClass('btn2').text("+");
    increaseButton.click(function() {
    changeQuantity(item, 1);
        });
    var removeButton = $("<button>").addClass('btn2').text("Entfernen");
    removeButton.click(function() {
        removeItem(item);
    });

    

    var buttonGroup = $('<div>').addClass('d-flex flex-column align-items-end').append(increaseButton, decreaseButton, removeButton);

    listItem.append(productInfo, buttonGroup);

    total += parseFloat(item.price) * item.quantity;
    cartList.append(listItem);
});

$('#total-price').text(total);
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
