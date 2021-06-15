<?php

require './connection.php';

$item_id = $_POST['id'];

$stmt = $conn->prepare("SELECT * FROM food WHERE id = ?");

if ($stmt->execute([$item_id]) === true) {

    $item = $stmt->fetch();

    $modalData = '<div class="wrapper align-items-center justify-content-center modal modalBase">
    <div class="p-5 w-100">
        <h3 class="text-center">Item ' . $item['foodName'] . '</h3>
        <form class="w-100" id="addNewFoodItemForm">
            <div class="form-group">
                <label for="newFoodName">Food Name</label>
                <input type="email" class="form-control" readonly value=' . $item['foodName'] . ' id="editedFoodName" aria-describedby="emailHelp" placeholder="Enter new food">
            </div>
        </form>
    </div>
</div>';
    echo json_encode([
        'error' => false,
        'message' => 'Food created Succesfully!',
        'data' => $modalData
    ]);
} else {
    echo json_encode([
        'error' => true,
        'message' => 'error getting item!',
    ]);
}
