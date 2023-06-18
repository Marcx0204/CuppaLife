<?php
    session_start();

    // Session löschen
    session_unset();
    session_destroy();

    // Cookie löschen
    if (isset($_COOKIE['remember_me'])) {
        setcookie('remember_me', '', time() - 3600, '/');
    }

    // Zurück zur Login-Seite weiterleiten
    header("Location: ../../Frontend/sites/index.php");
    exit;
?>



