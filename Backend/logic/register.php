<?php
session_start();

// Überprüfen, ob das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../config/dbaccess.php';

    // Daten aus dem POST-Array abrufen und escapen
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $zip_code = mysqli_real_escape_string($conn, $_POST['zip_code']);
    $town = mysqli_real_escape_string($conn, $_POST['town']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Überprüfen, ob das Passwort mit der Bestätigung übereinstimmt
    if ($password !== $confirm_password) {
        $response = array('status' => 'error', 'message' => 'Die Passwörter stimmen nicht überein');
        echo json_encode($response);
        exit;
    }

    // Überprüfen, ob der Benutzername bereits vorhanden ist
    $check_username_query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
    $check_username_result = mysqli_query($conn, $check_username_query);
    if (mysqli_num_rows($check_username_result) > 0) {
        $response = array('status' => 'error', 'message' => 'Der Benutzername ist bereits vergeben');
        echo json_encode($response);
        exit;
    }
    // Passwort hashen
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL-Abfrage zum Einfügen der Daten in die Tabelle user
    $sql = "INSERT INTO user (type, username, f_name, l_name, address, zip_code, town, email, password)
            VALUES ('$type', '$username', '$f_name', '$l_name', '$address', '$zip_code', '$town', '$email', '$hashed_password')";

    // Abfrage ausführen
    if (mysqli_query($conn, $sql)) {
        // Erfolgreich eingefügt
        $_SESSION['username'] = $username; // Benutzer einloggen
        $_SESSION['loggedin'] = true; // Anmeldestatus auf true setzen

        $response = array('status' => 'success', 'message' => 'Daten erfolgreich gespeichert');
        echo json_encode($response);
    } else {
        // Fehler beim Einfügen
        $response = array('status' => 'error', 'message' => 'Fehler beim Speichern der Daten');
        echo json_encode($response);
    }

    // Verbindung schließen
    mysqli_close($conn);
}
?>
