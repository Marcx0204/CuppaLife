<?php
include_once '../config/dbaccess.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Daten aus dem POST-Array abrufen und escapen
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $cardProvider = mysqli_real_escape_string($conn, $_POST['cardProvider']);
    $cardNumber = mysqli_real_escape_string($conn, $_POST['cardNumber']);
    $expiryDate = mysqli_real_escape_string($conn, $_POST['expiryDate']);
    $cvv = mysqli_real_escape_string($conn, $_POST['cvv']);


    // SQL-Abfrage zum Einfügen der Zahlungsinformationen in die Datenbank
    $insertQuery = "INSERT INTO payment (username, card_company, card_number, card_date, card_cvv) VALUES ('$username', '$cardProvider', '$cardNumber', '$expiryDate', '$cvv')";

    if (mysqli_query($conn, $insertQuery)) {
        // Erfolgreich eingefügt
        $response = array('status' => 'OK', 'message' => 'Zahlungsmethode hinzugefügt');
        echo json_encode($response);
    } else {
        // Fehler beim Einfügen
        $response = array('status' => 'ERROR', 'message' => 'Fehler beim Hinzufügen der Zahlungsmethode');
        echo json_encode($response);
    }

    // Verbindung schließen
    mysqli_close($conn);
}
?>
