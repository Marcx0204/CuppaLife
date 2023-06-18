<?php
session_start();
include_once '../config/dbaccess.php';

$warenkorb = json_decode(file_get_contents('php://input'), true); // Parse the JSON request body
$username = $_SESSION['username'];
$order_id = uniqid(); // Generiere eine eindeutige Bestell-ID

foreach ($warenkorb as $product) { // Loop through the products
    $product_id = $product['id'];
    $product_name = $product['name'];
    $product_price = $product['price'];
    $quantity = $product['quantity'];

    // Prepare and execute an SQL statement to insert the product into the orders table
    $insertQuery = "INSERT INTO orders (username, product_id, product_name, product_price, quantity, order_id) 
                    VALUES ('$username', '$product_id', '$product_name', '$product_price', '$quantity', '$order_id')";

    if (mysqli_query($conn, $insertQuery)) {
        // Erfolgreich eingefügt
        $response = array('status' => 'OK', 'message' => 'Bestellung erfolgreich aufgegeben');
        echo json_encode($response);
    } else {
        // Fehler beim Einfügen
        $response = array('status' => 'ERROR', 'message' => 'Fehler beim Aufgeben der Bestellung');
        echo json_encode($response);
    }
}

// Verbindung schließen
mysqli_close($conn);
?>
