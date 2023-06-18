<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../config/dbaccess.php';

    if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
        $response = array('status' => 'error', 'message' => 'Benutzername ist erforderlich');
        echo json_encode($response);
        exit;
    }

    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
    $currentPassword = mysqli_real_escape_string($conn, $_POST['currentPassword']);
    $fields_to_update = array();

    // Überprüfen des aktuellen Passworts
    $sql = "SELECT password FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        // Überprüfen des eingegebenen Passworts
        if (!password_verify($currentPassword, $hashedPassword)) {
            $response = array('status' => 'error', 'message' => 'Das eingegebene Passwort ist falsch');
            echo json_encode($response);
            mysqli_close($conn);
            exit;
        }
    }

    $expected_fields = array('f_name', 'l_name', 'address', 'zip_code', 'town', 'email');
    foreach ($expected_fields as $field) {
        if (isset($_POST[$field]) && !empty($_POST[$field])) {
            $value = mysqli_real_escape_string($conn, $_POST[$field]);

            // Überprüfen Sie die Eindeutigkeit der E-Mail-Adresse
            if ($field == 'email') {
                $sql = "SELECT * FROM user WHERE email = '$value' AND username != '$username'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $response = array('status' => 'error', 'message' => 'Diese E-Mail-Adresse wird bereits verwendet');
                    echo json_encode($response);
                    mysqli_close($conn);
                    exit;
                }
            }

            $fields_to_update[] = "$field = '$value'";
        }
    }

    if (count($fields_to_update) > 0) {
        $sql = "UPDATE user SET " . implode(", ", $fields_to_update) . " WHERE username = '$username'";

        if (mysqli_query($conn, $sql)) {
            $response = array('status' => 'success', 'message' => 'Profil erfolgreich aktualisiert');
        } else {
            $response = array('status' => 'error', 'message' => 'Fehler beim Aktualisieren des Profils');
        }
    } else {
        $response = array('status' => 'success', 'message' => 'Keine Änderungen vorgenommen');
    }

    echo json_encode($response);
    mysqli_close($conn);
}
?>
