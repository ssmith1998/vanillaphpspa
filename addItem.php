<?php
session_start();
require './connection.php';

$foodItem = $_POST['food'];
$user = isset($_SESSION['loggedUser']) ? $_SESSION['loggedUser'] : null;


$stmt = $conn->prepare("INSERT INTO food (foodName, user_id) VALUES (?,?)");


if ($stmt->execute([$foodItem, $user]) === true) {

    $last_id = $conn->lastInsertId();

    $stmt = $conn->prepare("SELECT * FROM food WHERE id = ?");
    $stmt->execute([$last_id]);
    $insertedColumn = $stmt->fetch();
    echo json_encode([
        'error' => false,
        'message' => 'Food created Succesfully!',
        'data' => $insertedColumn
    ]);
} else {
    echo json_encode([
        'error' => true,
        'message' => 'There was an error creating your new food!'
    ]);
}
