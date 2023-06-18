<?php

// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cuppalife_db";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

if (isset($_COOKIE['remember_me'])) {
    // Der Cookie existiert, den Benutzernamen entschlüsseln
    $encrypted_username = $_COOKIE['remember_me'];
    $encryption_key = "DeinVerschlüsselungsschlüssel";
    $decrypted_username = decryptUsername($encrypted_username, $encryption_key);

    // Überprüfen, ob der entschlüsselte Benutzername in der Datenbank existiert
    $check_query = "SELECT * FROM user WHERE username = '$decrypted_username' LIMIT 1";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $user = mysqli_fetch_assoc($check_result);
       
            $_SESSION['username'] = $user['username'];
            $_SESSION['loggedin'] = true;
    }
}

// Funktion zum Entschlüsseln des Benutzernamens
function decryptUsername($encrypted_username, $key) {
    $cipher = "AES-256-CBC";
    $data = base64_decode($encrypted_username);
    $iv = substr($data, 0, openssl_cipher_iv_length($cipher));
    $decrypted = openssl_decrypt(substr($data, openssl_cipher_iv_length($cipher)), $cipher, $key, OPENSSL_RAW_DATA, $iv);
    return $decrypted;
}
