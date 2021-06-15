<?php
session_start();

require './connection.php';
$user = isset($_SESSION['loggedUser']) ? $_SESSION['loggedUser'] : null;


$stmt = $conn->prepare("SELECT * FROM food where user_id = ?");

$stmt->execute([$user]);

$food = $stmt->fetchAll();

$newFood = [];

foreach ($food as $item) {
    $newFood[] = [
        'id' => $item['id'],
        'foodName' => $item['foodName'],
        'actions' => '<button class="btn btn-primary editItem" data-id=' . $item['id'] . '" modal-id="#addNewItemModal">Edit</button>
        <button class="btn btn-danger deleteItem" data-id="' . $item['id'] . '">Delete</button>
        <button class="btn btn-primary viewItem" data-id="' . $item['id'] . '">View</button>'
    ];
}

echo json_encode([
    'data' => $newFood
]);
