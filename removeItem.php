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

    $stmt = $conn->prepare("SELECT * FROM food WHERE id = ?");
    $stmt->execute([$item_id]);
    $deletedColumn = $stmt->fetch();
    echo json_encode([
        'error' => false,
        'message' => 'Food removed Succesfully!',
        'data' => $deletedColumn
    ]);
} else {

    echo json_encode([
        'error' => true,
        'message' => 'error deleting item',
    ]);
}
