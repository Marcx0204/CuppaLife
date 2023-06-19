<?php
session_start();
include_once '../config/dbaccess.php';

// Überprüfen, ob der Benutzer eingeloggt ist, sonst Fehlermeldung zurückgeben
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $response = array('status' => 'ERROR', 'message' => 'Benutzer ist nicht eingeloggt');
    echo json_encode($response);
    exit;
}

// Benutzername des eingeloggten Benutzers
$username = $_SESSION['username'];

// SQL-Abfrage, um die Zahlungsmethoden des Benutzers abzurufen
$selectQuery = "SELECT card_company FROM payment WHERE username = '$username'";

// Ausführen der SQL-Abfrage
$result = mysqli_query($conn, $selectQuery);

if ($result) {
    $paymentMethods = array();

    // Zahlungsmethoden in ein Array speichern
    while ($row = mysqli_fetch_assoc($result)) {
        $paymentMethods[] = $row['card_company'];
    }

    // Erfolgreiche Antwort mit den Zahlungsmethoden zurückgeben
    $response = array('status' => 'OK', 'paymentMethods' => $paymentMethods);
    echo json_encode($response);
} else {
    // Fehler beim Ausführen der SQL-Abfrage
    $response = array('status' => 'ERROR', 'message' => 'Fehler beim Abrufen der Zahlungsmethoden');
    echo json_encode($response);
}

// Verbindung schließen
mysqli_close($conn);
?>
