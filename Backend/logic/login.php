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
?>
