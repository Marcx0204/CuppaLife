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

        <ul id="data-list" class="list-group"></ul>

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

                    data.forEach(function(item) {
                        var listItem = $("<li>");

                        listItem.text('Produkt: ' + item.Name + ', Preis: ' + item.Preis + ', Bewertung: ' + item.Bewertung + ' Sterne');

                        if(item.Bild) {
                            var productImage = $('<img src="../../Backend/uploads/'+ item.Bild +'" alt="'+ item.Name +'">');
                            productImage.css('width', '50px');
                            listItem.prepend(productImage);
                        }

                        var cartLink = $("<a href='#'>In den Warenkorb legen</a>");
                        cartLink.data('product-id', item.product_id);
                        cartLink.click(addToCart);

                        listItem.append(cartLink);

                        dataList.append(listItem);
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

            var productId = $(this).data('product-id');

            $.ajax({
                url: '../../Backend/logic/warenkorb.php',
                type: 'POST',
                data: { product_id: productId },
                success: function(data) {
                    console.log(productId);
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
