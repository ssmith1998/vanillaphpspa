<?php

require './connection.php';

$stmt = $conn->prepare("SELECT * FROM activity");

$stmt->execute();

$logs = $stmt->fetchAll();

echo json_encode([
    'data' => $logs
]);
