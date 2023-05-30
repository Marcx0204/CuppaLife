<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="produkte.php">Produkte</a>
                </li>
                 <?php
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && strtolower($_SESSION['username']) == 'admin') {
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="produkte_bearbeiten.php">Produkte bearbeiten</a>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="kunden_bearbeiten.php">Kunden bearbeiten</a>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="gutscheine_verwalten.php">Gutscheine verwalten</a>';
        echo '</li>';
    }
        ?>
            </ul>
        <a class="navbar-brand" href="#">
            <img src="../res/img/Logo.png" alt="CuppaLife Logo" style="width: 250px; height: auto;">
        </a>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

   

        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
            echo '<i class="fas fa-user me-2"></i>' . $_SESSION['username'];
            echo '</a>';
            echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
            echo '<li><a class="dropdown-item" href="profile.php">Mein Konto</a></li>';
            echo '<li><hr class="dropdown-divider"></li>';
            echo '<li><a class="dropdown-item" href="../../Backend/logic/logout.php">Abmelden</a></li>';
            echo '</ul>';
            echo '</li>';
        } else {
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="login.php"><i class="fas fa-user me-2"></i>Anmelden</a>';
            echo '</li>';
        }
        ?>

                <li class="nav-item">
                <a class="nav-link" href="warenkorb.php"><i class="fas fa-shopping-bag me-2"></i>Warenkorb <span
                    class="badge rounded-pill bg-secondary" id="cart-count"></span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    $(document).ready(function() {
        $.ajax({
        url: '../../Backend/logic/warenkorb.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {

            var cartCount = data.length;
            $('#cart-count').text(cartCount);

        },
        error: function(err) {
            console.error(err);
        }
    });

});

</script>