<?php
require './connection.php';

$item_id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM food WHERE id = ?");

if ($stmt->execute([$item_id]) === true) {
    $stmt = $conn->prepare("SELECT * FROM food WHERE id = ?");
    $stmt->execute([$item_id]);
    $deletedColumn = $stmt->fetch();
    echo json_encode([
        'error' => false,
        'message' => 'Food created Succesfully!',
        'data' => $deletedColumn
    ]);
} else {

    echo json_encode([
        'error' => true,
        'message' => 'error deleting item',
    ]);
}
