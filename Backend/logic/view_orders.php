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

// SQL-Abfrage, um die gruppierten Bestellungen des eingeloggten Benutzers abzurufen
$selectQuery = "SELECT order_id, GROUP_CONCAT(product_id) AS product_ids, GROUP_CONCAT(product_name) AS product_names, 
                GROUP_CONCAT(product_price) AS product_prices, GROUP_CONCAT(quantity) AS quantities
                FROM orders
                WHERE username = '$username'
                GROUP BY order_id";

// Ausführen der SQL-Abfrage
$result = mysqli_query($conn, $selectQuery);

// Überprüfen, ob Bestellungen vorhanden sind
if (mysqli_num_rows($result) > 0) {
    $orders = array();

    // Bestellungen in ein Array speichern
    while ($row = mysqli_fetch_assoc($result)) {
        $productIds = explode(',', $row['product_ids']);
        $productNames = explode(',', $row['product_names']);
        $productPrices = explode(',', $row['product_prices']);
        $quantities = explode(',', $row['quantities']);

        $order = array(
            'order_id' => $row['order_id'],
            'products' => array()
        );

        // Produkte der Bestellung hinzufügen
        for ($i = 0; $i < count($productIds); $i++) {
            $product = array(
                'product_id' => $productIds[$i],
                'product_name' => $productNames[$i],
                'product_price' => $productPrices[$i],
                'quantity' => $quantities[$i]
            );

            $order['products'][] = $product;
        }

        $orders[] = $order;
    }

    // Erfolgreiche Antwort mit den Bestellungen zurückgeben
    $response = array('status' => 'OK', 'orders' => $orders);
    echo json_encode($response);
} else {
    // Keine Bestellungen gefunden
    $response = array('status' => 'OK', 'message' => 'Keine Bestellungen gefunden');
    echo json_encode($response);
}

// Verbindung schließen
mysqli_close($conn);
?>
