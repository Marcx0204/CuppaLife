<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

include_once '../config/dbaccess.php';

// get category and query parameters from GET
$category = isset($_GET['category']) ? $_GET['category'] : null;
$query = isset($_GET['query']) ? $_GET['query'] : null;

if ($category) {
    // prevent SQL injection
    $category = mysqli_real_escape_string($conn, $category);
    $sql = "SELECT * FROM produkte WHERE Kategorie = '$category'";
} elseif ($query) {
    $query = mysqli_real_escape_string($conn, $query);
    $sql = "SELECT * FROM produkte WHERE Name LIKE '%$query%'";
} else {
    $sql = "SELECT * FROM produkte";
}


$result = $conn->query($sql);

// fetch data and transform it to JSON format
if ($result->num_rows > 0) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo json_encode(array('error' => 'No data found'));
}

// close connection
mysqli_close($conn);
?>