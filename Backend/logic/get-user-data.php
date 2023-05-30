<?php
session_start();
include_once '../config/dbaccess.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $username = $_SESSION['username'];

    // Holen Sie sich die Benutzerinformationen aus der Datenbank
    $query = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo json_encode(array("message" => "Keine Benutzerinformationen gefunden."));
    }
} else {
    echo json_encode(array("message" => "Benutzer ist nicht eingeloggt."));
}
?>
