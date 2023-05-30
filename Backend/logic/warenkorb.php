<?php
    session_start();

    if (!isset($_SESSION['warenkorb'])) {
        $_SESSION['warenkorb'] = [];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'], $_POST['product_img'])) {
            $product = [
                'id' => $_POST['product_id'],
                'name' => $_POST['product_name'],
                'price' => $_POST['product_price'],
                'img' => $_POST['product_img'],
                'quantity' => 1
            ];
            $_SESSION['warenkorb'][$_POST['product_id']] = $product;

            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Produkt hinzugefügt', 'product' => $product]);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Produktdaten fehlen']);
        }



    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
        http_response_code(200);
        echo json_encode(array_values($_SESSION['warenkorb']));



    } elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
    
        if ($product_id !== null && isset($_SESSION['warenkorb'][$product_id])) {
            unset($_SESSION['warenkorb'][$product_id]);
    
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Produkt entfernt']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Produkt ID fehlt oder Produkt nicht gefunden']);
        }
    
    


    } elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
        $data = json_decode(file_get_contents("php://input"), true);
        $product_id = isset($data['product_id']) ? $data['product_id'] : null;
        $quantity_change = isset($data['quantity_change']) ? $data['quantity_change'] : null;
    
        if ($product_id !== null && $quantity_change !== null && isset($_SESSION['warenkorb'][$product_id])) {
            $_SESSION['warenkorb'][$product_id]['quantity'] += $quantity_change;
            if ($_SESSION['warenkorb'][$product_id]['quantity'] <= 0) {
                unset($_SESSION['warenkorb'][$product_id]);
            }
    
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Menge geändert']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Produkt ID oder Mengenänderung fehlt oder Produkt nicht gefunden']);
        }
    }
    
?>
