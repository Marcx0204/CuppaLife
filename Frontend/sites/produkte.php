<!DOCTYPE HTML>
<html>
    <head>
        <title>CuppaLife</title>
        <!-- Include head -->
        <?php include 'head.php'; ?>
    </head>
    <body>
        <header>
            <!-- Include navigation bar -->
            <?php include 'navbar.php'; ?>
        </header>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <!-- Search input -->
                    <input type="text" id="product-search" placeholder="Search products...">

                    <!-- Category links -->
                    <a href="#" class="category-link" data-category="Indischer Tee">Indischer Tee</a> |
                    <a href="#" class="category-link" data-category="Japanischer Tee">Japanischer Tee</a> |
                    <a href="#" class="category-link" data-category="Chinesischer Tee">Chinesischer Tee</a>
                </div>
            </div>
            
            <!-- Product list -->
            <div class="row mt-4" id="data-list"></div>
        </div>

        <!-- JavaScript -->
        <script>
            // Function to load products
            function loadProducts(selectedCategory, query) {
                var requestData = {};

                // If a category is selected
                if (selectedCategory) {
                    requestData.category = selectedCategory;
                }

                // If a query is provided
                if (query) {
                    requestData.query = query;
                }

                // AJAX call to fetch products
                $.ajax({
                    url: '../../Backend/logic/produkte.php',
                    type: 'GET',
                    data: requestData,
                    dataType: 'json',
                    success: function(data) {
                        var dataList = $("#data-list");
                        dataList.empty(); // Clear the data list

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

                                // Loop through each product and add it to the data list
                                data.forEach(function(item) {
                                    var cardColumn = $('<div class="col-lg-4 col-md-6 mb-4">');
                                    var card = $('<div class="card h-100">');
                                    var cardBody = $('<div class="card-body">');

                                    // Product details
                                    var cardTitle = $('<h5 class="card-title">').text(item.Name);
                                    cardBody.append(cardTitle);

                                    // Product image
                                    if(item.Bild) {
                                        var productImage = $('<img class="card-img-top" src="../../Backend/uploads/'+ item.Bild +'" alt="'+ item.Name +'">');
                                        card.append(productImage);
                                    }

                                    // Product price and rating
                                    var priceRow = $('<p class="card-text">').text('Preis: ' + item.Preis);
                                    var ratingRow = $('<p class="card-text">').text('Bewertung: ' + item.Bewertung + ' Sterne');
                                    cardBody.append(priceRow);
                                    cardBody.append(ratingRow);

                                    // Add to cart button
                                    var cartLink = $("<a href='#' class='btn'>In den Warenkorb legen</a>");
                                    cartLink.data('product-name', item.Name);
                                    cartLink.data('product-img', item.Bild);
                                    cartLink.data('product-price', item.Preis);
                                    cartLink.data('product-id', item.product_id);
                                    cartLink.click(addToCart);

                                    // If the item is in the cart, disable the link
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

            // Event listeners for category links
            $('.category-link').on('click', function(event) {
                event.preventDefault();
                var category = $(this).data('category');
                loadProducts(category);
            });

            // Event listener for search input
            $('#product-search').on('input', function() {
                var query = $(this).val();
                loadProducts(null, query);
            });

            // Function to add a product to the cart
            function addToCart(event) {
                event.preventDefault();

                // Get product details from the data attributes
                var productName = $(this).data('product-name');
                var productPrice = $(this).data('product-price');
                var productId = $(this).data('product-id');
                var productImg = $(this).data('product-img');

                // AJAX call to add the product to the cart
                $.ajax({
                    url: '../../Backend/logic/warenkorb.php',
                    type: 'POST',
                    data: { product_name: productName, product_price:productPrice, product_id : productId, product_img : productImg},
                    success: function(data) {
                        // Disable the link and change the text
                        $(event.target).addClass('added').text('Zum Warenkorb hinzugefügt');
                        $(event.target).off('click'); // Remove click event to disable the link
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });

                // AJAX call to update the cart count
                $.ajax({
                    url: '../../Backend/logic/warenkorb.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var totalQuantity = 0;
                        
                        // Iterate over each item in the cart
                        for(var i = 0; i < data.length; i++) {
                            // Sum the quantity of the current item
                            totalQuantity += data[i].quantity;
                        }

                        // Set the total quantity as the cart count
                        $('#cart-count').text(totalQuantity);
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            }

            // Load the first category on page load
            $(document).ready(function() {
                loadProducts('Indischer Tee');
            });
        </script>

        <footer>
            <!-- Include footer -->
            <?php include 'footer.php'; ?>
        </footer>
    </body>
</html>
