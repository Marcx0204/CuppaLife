<?php
session_start();
include_once '../config/dbaccess.php';

$rawData = file_get_contents('php://input');
$orderData = json_decode($rawData, true);

$warenkorb = $orderData['warenkorb'];
$username = $_SESSION['username'];
$order_id = uniqid(); // Generiere eine eindeutige Bestell-ID
$paymentMethod = $orderData['paymentMethod']; // Holen Sie die Zahlungsmethode aus den Bestelldaten

foreach ($warenkorb as $product) { // Loop through the products
    $product_id = $product['id'];
    $product_name = $product['name'];
    $product_price = $product['price'];
    $quantity = $product['quantity'];

    // Prepare and execute an SQL statement to insert the product into the orders table
    $insertQuery = "INSERT INTO orders (username, product_id, product_name, product_price, quantity, order_id, payment_method) 
                    VALUES ('$username', '$product_id', '$product_name', '$product_price', '$quantity', '$order_id', '$paymentMethod')";

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
