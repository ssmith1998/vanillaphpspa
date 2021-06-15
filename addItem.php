<?php
session_start();
require './connection.php';

$foodItem = $_POST['food'];
$user = isset($_SESSION['loggedUser']) ? $_SESSION['loggedUser'] : null;


$stmt = $conn->prepare("INSERT INTO food (foodName, user_id) VALUES (?,?)");


if ($stmt->execute([$foodItem, $user]) === true) {

    $stmt = $conn->prepare("INSERT INTO activity (user_id, action) VALUES (?,?)");
    $stmt->execute([$user, 'added Item']);

    $last_id = $conn->lastInsertId();

    $stmt = $conn->prepare("SELECT * FROM food WHERE user_id = ?");
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
        'error' => false,
        'message' => 'Food created Succesfully!',
        'data' => $newFood
    ]);
} else {
    echo json_encode([
        'error' => true,
        'message' => 'There was an error creating your new food!'
    ]);
}
