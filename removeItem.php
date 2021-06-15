<?php
session_start();
require './connection.php';

$item_id = $_POST['id'];
$user = isset($_SESSION['loggedUser']) ? $_SESSION['loggedUser'] : null;


$stmt = $conn->prepare("DELETE FROM food WHERE id = ?");

if ($stmt->execute([$item_id]) === true) {
    //activity
    $stmt = $conn->prepare("INSERT INTO activity (user_id, action) VALUES (?,?)");
    $stmt->execute([$user, 'deleted Item ' . $item_id]);

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
        'message' => 'Food removed Succesfully!',
        'data' => $newFood
    ]);
} else {

    echo json_encode([
        'error' => true,
        'message' => 'error deleting item',
    ]);
}
