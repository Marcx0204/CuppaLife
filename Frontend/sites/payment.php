<!DOCTYPE html>
<html lang="de-AT">
<head>
    <title>Help</title>

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
<main>
    <div class="row g-3">
        <div class="col-md-6 mx-auto">
            <h4>Payment Method</h4>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="cardProvider" class="font-weight-normal card-text">Card Provider</label>
                        <div class="input-group">
                            <div class="dropdown">
                                <button class="btn btn-light btn-block dropdown-toggle" type="button"
                                        id="cardProviderDropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    Select Card Provider
                                </button>
                                <div class="dropdown-menu" aria-labelledby="cardProviderDropdown">
                                    <a class="dropdown-item card-option" href="#" data-card="Visa">
                                        <span class="card-icon visa"></span>
                                        Visa
                                    </a>
                                    <a class="dropdown-item card-option" href="#" data-card="Mastercard">
                                        <span class="card-icon mastercard"></span>
                                        Mastercard
                                    </a>
                                    <a class="dropdown-item card-option" href="#" data-card="American Express">
                                        <span class="card-icon amex"></span>
                                        American Express
                                    </a>
                                    <a class="dropdown-item card-option" href="#" data-card="Discover">
                                        <span class="card-icon discover"></span>
                                        Discover
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardNumber" class="font-weight-normal card-text">Card Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                            </div>
                            <input type="text" class="form-control" id="cardNumber"
                                   placeholder="0000 0000 0000 0000">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="expiryDate" class="font-weight-normal card-text">Expiry
                                Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control" id="expiryDate"
                                       placeholder="MM/YY">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cvv" class="font-weight-normal card-text">CVC/CVV</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="text" class="form-control" id="cvv" placeholder="000">
                            </div>
                        </div>
                    </div>
                    <small class="text-muted certificate-text"><i class="fa fa-lock"></i> Your
                        transaction is secured with ssl certificate</small>
                </div>
            </div>
        </div>
    </div>
</main>
<footer>
    <?php
    include 'footer.php';
    ?>
</footer>
</body>
</html>
