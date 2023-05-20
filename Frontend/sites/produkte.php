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

        <select id="category-select">
            <option value="grüner Tee">grüner Tee</option>
            <option value="japanisches Tee">japanisches Tee</option>
            <option value="Chineschises Tee">Chineschises Tee</option>
        </select>

        <ul class="list-group" id="data-list" ></ul>

        <script>
    function loadProducts(selectedCategory) {
        $.ajax({
            url: '../../Backend/logic/produkte.php',
            type: 'GET',
            data: { category: selectedCategory },
            dataType: 'json',
            success: function(data) {
                var dataList = $("#data-list");
                dataList.empty();

                // Fetch current cart items
                $.ajax({
                    url: '../../Backend/logic/warenkorb.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(cartItems) {
                        // Map cart items to names for easier lookup
                        var cartItemNames = cartItems.map(function(item) {
                            return item.name;
                        });

                        data.forEach(function(item) {
                            var listItem = $("<li>");
                            listItem.addClass("list-group-item");
                            listItem.text('Produkt: ' + item.Name + ', Preis: ' + item.Preis + ', Bewertung: ' + item.Bewertung + ' Sterne');

                            if(item.Bild) {
                                var productImage = $('<img src="../../Backend/uploads/'+ item.Bild +'" alt="'+ item.Name +'">');
                                productImage.css('width', '50px');
                                listItem.prepend(productImage);
                            }

                            var cartLink = $("<a href='#' class='cart-link'>In den Warenkorb legen</a>");
                            cartLink.data('product-name', item.Name);
                            cartLink.data('product-price', item.Preis);
                            cartLink.data('product-id', item.product_id);

                            cartLink.click(addToCart);

                            // Check if item is in cart
                            var isInCart = cartItemNames.includes(item.Name);
                            if(isInCart) {
                                cartLink.addClass('added').text('Hinzugefügt zum Warenkorb');
                                cartLink.off('click'); // Remove click event to disable the link
                            }

                            listItem.append(cartLink);

                            dataList.append(listItem);
                        });
                    }
                });
            },
            error: function(err) {
                console.error(err);
            }
        });
    }

    $('#category-select').on('change', function() {
        loadProducts($(this).val());
    });

    function addToCart(event) {
        event.preventDefault();

        var productName = $(this).data('product-name');
        var productPrice = $(this).data('product-price');
        var productId = $(this).data('product-id');


        $.ajax({
            url: '../../Backend/logic/warenkorb.php',
            type: 'POST',
            data: { product_name: productName, product_price:productPrice, product_id : productId },
            success: function(data) {
                console.log(productName, productPrice, productId);
                $(event.target).addClass('added').text('Hinzugefügt zum Warenkorb');
                $(event.target).off('click'); // Remove click event to disable the link
            },
            error: function(err) {
                console.error(err);
            }
        });
    }

    $(document).ready(function() {
        loadProducts($('#category-select').val());
    });
</script>


        <footer>
        <?php
            include 'footer.php';
        ?>
        </footer>
    </body>
</html>
