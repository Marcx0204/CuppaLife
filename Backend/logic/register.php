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

    // SQL-Abfrage zum Einfügen der Daten in die Tabelle user2
    $sql = "INSERT INTO user (type, username, f_name, l_name, address, zip_code, town, email, password)
            VALUES ('$type', '$username', '$f_name', '$l_name', '$address', '$zip_code', '$town', '$email', '$password')";

    // Abfrage ausführen
    if (mysqli_query($conn, $sql)) {
        // Erfolgreich eingefügt
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
