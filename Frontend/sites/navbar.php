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
                    <a class="nav-link" href="register.php">Tee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Tee-Sets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Produkte</a>
                </li>
            </ul>
            <a class="navbar-brand" href="#">CuppaLife - Dein Teeladen</a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                    echo '<i class="fas fa-user me-2"></i>' . $_SESSION['username'];
                    echo '</a>';
                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    echo '<li><a class="dropdown-item" href="#">Profile</a></li>';
                    echo '<li><hr class="dropdown-divider"></li>';
                    echo '<li><a class="dropdown-item" href="../../Backend/logic/logout.php">Logout</a></li>';
                    echo '</ul>';
                    echo '</li>';
                } else {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="login.php"><i class="fas fa-user me-2"></i>User-Login</a>';
                    echo '</li>';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-shopping-bag me-2"></i>Warenkorb <span
                            class="badge rounded-pill bg-secondary">0</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
