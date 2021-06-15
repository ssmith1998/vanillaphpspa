<?php

require './connection.php';

$item_id = $_POST['id'];
$food = $_POST['food'];

$stmt = $conn->prepare("UPDATE food SET foodName = ? WHERE id = ?");

if ($stmt->execute([$food, $item_id]) === true) {
    $stmt = $conn->prepare("SELECT * FROM food WHERE id = ?");
    $stmt->execute([$item_id]);
    $item = $stmt->fetch();
    echo json_encode([
        'error' => false,
        'message' => 'Food created Succesfully!',
        'data' => $item
    ]);
} else {
    echo json_encode([
        'error' => true,
        'message' => 'error updating item!',
    ]);
}
