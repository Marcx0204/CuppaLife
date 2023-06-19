<?php
// Check if the user is already logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
   include_once '../../Backend/logic/login-user.php';
}
?>

<!-- Start of Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <!-- Navbar Toggle Button for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- Home Link -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>

                <!-- Products Link -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="produkte.php">Produkte</a>
                </li>

                <!-- Admin Settings Link Visible Only to Admin Users -->
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && strtolower($_SESSION['username']) == 'admin') {
                    echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                    echo 'Admin Einstellungen';
                    echo '</a>';
                    echo '<ul class="dropdown-menu" aria-labelledby="adminDropdown">';
                    echo '<li><a class="dropdown-item" href="produkte_bearbeiten.php">Produkte bearbeiten</a></li>';
                    echo '<li><a class="dropdown-item" href="kunden_bearbeiten.php">Kunden bearbeiten</a></li>';
                    echo '<li><a class="dropdown-item" href="gutscheine_verwalten.php">Gutscheine verwalten</a></li>';
                    echo '</ul>';
                    echo '</li>';
                }
                ?>
            </ul>

            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="../res/img/Logo.png" alt="CuppaLife Logo" style="width: 250px; height: auto;">
            </a>

            <!-- Account and Cart Links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <?php
                // If user is logged in, show user dropdown menu
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                    echo '<i class="fas fa-user me-2"></i>' . $_SESSION['username'];
                    echo '</a>';
                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    echo '<li><a class="dropdown-item" href="profile.php">Mein Konto</a></li>';
                    echo '<li><hr class="dropdown-divider"></li>';
                    echo '<li><a class="dropdown-item" href="payment.php">Zahlungsmethode</a></li>';
                    echo '<li><hr class="dropdown-divider"></li>';
                    echo '<li><a class="dropdown-item" href="../../Backend/logic/logout.php">Abmelden</a></li>';
                    echo '</ul>';
                    echo '</li>';
                } 
                // If user is not logged in, show login link
                else {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="login.php"><i class="fas fa-user me-2"></i>Anmelden</a>';
                    echo '</li>';
                }
                ?>

                <!-- Cart Link -->
                <li class="nav-item">
                <a class="nav-link" href="warenkorb.php"><i class="fas fa-shopping-bag me-2"></i>Warenkorb <span
                    class="badge rounded-pill bg-secondary" id="cart-count"></span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End of Navigation Bar -->

<!-- JavaScript Code to Update the Cart Count -->
<script>
    $(document).ready(function() {
        // AJAX call to get the cart content
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
                // Log any error to the console
                console.error(err);
            }
        });
    });
</script>
