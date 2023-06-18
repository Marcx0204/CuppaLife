<?php
session_start();

// Überprüfen, ob das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../config/dbaccess.php';

    // Daten aus dem POST-Array abrufen und escapen
    $usernameOrEmail = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Überprüfen, ob der Benutzername oder die E-Mail existiert
    $check_query = "SELECT * FROM user WHERE username = '$usernameOrEmail' OR email = '$usernameOrEmail' LIMIT 1";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        // Benutzer gefunden, Überprüfen des Passworts
        $user = mysqli_fetch_assoc($check_result);
        $hashed_password = $user['password'];

        if (password_verify($password, $hashed_password)) {
            // Passwort stimmt überein, Benutzer einloggen
            $_SESSION['username'] = $user['username'];
            $_SESSION['loggedin'] = true;
            
            // Verschlüsseln des Benutzernamens
            $encryption_key = "DeinVerschlüsselungsschlüssel"; // Hier den Verschlüsselungsschlüssel einsetzen
            $encrypted_username = encryptUsername($user['username'], $encryption_key);
            
            // Setze den Login-Cookie, wenn "Login merken" ausgewählt wurde
            if (isset($_POST['remember_me']) && $_POST['remember_me'] === 'true') {
                $cookie_name = 'remember_me';
                $cookie_value = $encrypted_username;
                $cookie_expiry = time() + (86400 * 30); // Cookie bleibt für 30 Tage gültig

                setcookie($cookie_name, $cookie_value, $cookie_expiry, '/');
            }

            $response = array('status' => 'OK', 'message' => 'Login erfolgreich');
            echo json_encode($response);
            exit; 
        }
    }        

    // Benutzername oder Passwort ist ungültig
    $response = array('status' => 'NO', 'message' => 'Ungültige Anmeldedaten');
    echo json_encode($response);

    // Verbindung schließen
    mysqli_close($conn);
}

// Funktion zum Verschlüsseln des Benutzernamens
function encryptUsername($username, $key) {
    $cipher = "AES-256-CBC";
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
    $encrypted = openssl_encrypt($username, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    $encrypted_data = base64_encode($iv . $encrypted);
    return $encrypted_data;
}
