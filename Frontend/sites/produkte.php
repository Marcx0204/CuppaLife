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

        <div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="category-link" data-category="Indischer Tee">Indischer Tee</a> |
            <a href="#" class="category-link" data-category="Japanischer Tee">Japanischer Tee</a> |
            <a href="#" class="category-link" data-category="Chinesischer Tee">Chinesischer Tee</a>
        </div>
    </div>
    <div class="row mt-4" id="data-list">
    </div>
</div>

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
                                var cardColumn = $('<div class="col-lg-4 col-md-6 mb-4">');
                                var card = $('<div class="card h-100">');
                                var cardBody = $('<div class="card-body">');

                                var cardTitle = $('<h5 class="card-title">').text(item.Name);
                                cardBody.append(cardTitle);

                                if(item.Bild) {
                                    var productImage = $('<img class="card-img-top" src="../../Backend/uploads/'+ item.Bild +'" alt="'+ item.Name +'">');
                                    card.append(productImage);
                                }

                                // Erstelle eine separate Zeile für jeden Datenpunkt
                                var priceRow = $('<p class="card-text">').text('Preis: ' + item.Preis);
                                var ratingRow = $('<p class="card-text">').text('Bewertung: ' + item.Bewertung + ' Sterne');
                                cardBody.append(priceRow);
                                cardBody.append(ratingRow);

                                var cartLink = $("<a href='#' class='btn'>In den Warenkorb legen</a>");
                                cartLink.data('product-name', item.Name);
                                cartLink.data('product-img', item.Bild);
                                cartLink.data('product-price', item.Preis);
                                cartLink.data('product-id', item.product_id);
                                cartLink.click(addToCart);

                                // Check if item is in cart
                                var isInCart = cartItemNames.includes(item.Name);
                                if(isInCart) {
                                    cartLink.addClass('disabled').text('Zum Warenkorb hinzugefügt');
                                    cartLink.off('click'); // Remove click event to disable the link
                                }

                                cardBody.append(cartLink);
                                card.append(cardBody);
                                cardColumn.append(card);
                                dataList.append(cardColumn);
                            });
                        }
                    });
                },
            error: function(err) {
                console.error(err);
            }
        });
    }

    $('.category-link').on('click', function(event) {
        event.preventDefault();
        var category = $(this).data('category');
        loadProducts(category);
    });

    function addToCart(event) {
        event.preventDefault();

        var productName = $(this).data('product-name');
        var productPrice = $(this).data('product-price');
        var productId = $(this).data('product-id');
        var productImg = $(this).data('product-img');


        $.ajax({
            url: '../../Backend/logic/warenkorb.php',
            type: 'POST',
            data: { product_name: productName, product_price:productPrice, product_id : productId, product_img : productImg},
            success: function(data) {
                console.log(productImg, productName, productPrice, productId);
                $(event.target).addClass('added').text('Zum Warenkorb hinzugefügt');
                $(event.target).off('click'); // Remove click event to disable the link
            },
            error: function(err) {
                console.error(err);
            }
        });
    }

    $(document).ready(function() {
        // Standardmäßig laden Sie den ersten Link ("Indischer Tee") beim Laden der Seite
        loadProducts('Indischer Tee');
    });
</script>


        <footer>
        <?php
            include 'footer.php';
        ?>
        </footer>
    </body>
</html>
