<?php
session_start();
require './connection.php';

$item_id = $_POST['id'];
$food = $_POST['food'];
$user = isset($_SESSION['loggedUser']) ? $_SESSION['loggedUser'] : null;


$stmt = $conn->prepare("UPDATE food SET foodName = ? WHERE id = ?");

if ($stmt->execute([$food, $item_id]) === true) {
    //activity
    $stmt2 = $conn->prepare("INSERT INTO activity (user_id, action) VALUES (?,?)");
    $stmt2->execute([$user, 'updated Item ' . $item_id]);

    $stmt3 = $conn->prepare("SELECT * FROM activity");
    $stmt3->execute();
    $items = $stmt3->fetchAll();

    $stmt4 = $conn->prepare("SELECT * FROM food WHERE user_id = ?");
    $stmt4->execute([$user]);
    $food = $stmt4->fetchAll();

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
        'error' => false,
        'message' => 'Food updated Succesfully!',
        'data' => $items,
        'food' => $newFood
    ]);
} else {
    echo json_encode([
        'error' => true,
        'message' => 'error updating item!',
    ]);
}
