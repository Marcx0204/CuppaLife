<?php
session_start();

// Überprüfen, ob das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../config/dbaccess.php';

    // Überprüfen, ob alle erwarteten Felder vorhanden und nicht leer sind
    $expected_fields = array('username', 'currentPassword', 'newPassword');
    foreach ($expected_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $response = array('status' => 'error', 'message' => 'Fehlende Felder im Formular');
            echo json_encode($response);
            exit;
        }
    }

    // Daten aus dem POST-Array abrufen und escapen
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $currentPassword = mysqli_real_escape_string($conn, $_POST['currentPassword']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);

    // Überprüfen, ob das aktuelle Passwort korrekt ist
    $check_password_query = "SELECT password FROM user WHERE username = '$username' LIMIT 1";
    $check_password_result = mysqli_query($conn, $check_password_query);
    if (mysqli_num_rows($check_password_result) > 0) {
        $user = mysqli_fetch_assoc($check_password_result);
        if (!password_verify($currentPassword, $user['password'])) {
            $response = array('status' => 'error', 'message' => 'Das aktuelle Passwort ist falsch');
            echo json_encode($response);
            exit;
        }
    }

    // Passwort hashen
    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

    // SQL-Abfrage zum Aktualisieren des Passworts in der Tabelle user
    $sql = "UPDATE user SET password='$hashed_password' WHERE username = '$username'";

    // Abfrage ausführen
    if (mysqli_query($conn, $sql)) {
        // Passwort erfolgreich geändert
        $response = array('status' => 'success', 'message' => 'Passwort erfolgreich geändert');
        echo json_encode($response);
    } else {
        // Fehler beim Ändern des Passworts
        $response = array('status' => 'error', 'message' => 'Fehler beim Ändern des Passworts');
        echo json_encode($response);
    }

    // Verbindung schließen
    mysqli_close($conn);
}
?>
