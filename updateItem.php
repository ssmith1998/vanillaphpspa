<?php
session_start();
require './connection.php';

$item_id = $_POST['id'];
$food = $_POST['food'];
$user = isset($_SESSION['loggedUser']) ? $_SESSION['loggedUser'] : null;


$stmt = $conn->prepare("UPDATE food SET foodName = ? WHERE id = ?");

if ($stmt->execute([$food, $item_id]) === true) {
    //activity
    $stmt = $conn->prepare("INSERT INTO activity (user_id, action) VALUES (?,?)");
    $stmt->execute([$user, 'updated Item ' . $item_id]);

    $stmt = $conn->prepare("SELECT * FROM food WHERE id = ?");
    $stmt->execute([$item_id]);
    $item = $stmt->fetch();
    echo json_encode([
        'error' => false,
        'message' => 'Food updated Succesfully!',
        'data' => $item
    ]);
} else {
    echo json_encode([
        'error' => true,
        'message' => 'error updating item!',
    ]);
}
