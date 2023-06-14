<?php

if (isset($_COOKIE['remember_me'])) {
    // Der Cookie existiert, Benutzer einloggen
    $_SESSION['username'] = $_COOKIE['remember_me'];
    $_SESSION['loggedin'] = true;
}