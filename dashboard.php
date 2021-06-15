<?php
require './connection.php';
require './header.php';
if (!$_SESSION['loggedUser']) {
    header('Location:/');
}

$user_id =  $_SESSION['loggedUser'];

//get logged in user from session
$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
//display data from user
$userData = $stmt->fetch();

$stmt = $conn->prepare("SELECT * FROM food WHERE user_id = :id");
$stmt->execute(['id' => $user_id]);

$foodData = $stmt->fetchAll();


?>
<div class="dashboardWrapper d-flex align-items-center justify-content-center">
    <div class=" card p-5 w-75">
        <div class="cardTop d-flex justify-content-between align-items-center mb-4">
            <h3>Hello <?php echo $userData['username']; ?></h3>
            <div class="actionBtns">
                <a href="#showLogs" rel="modal:open"><button class="addNewBtn btn btn-primary mb-2">Show Logs</button></a>
                <a href="#addNewItemModal" rel="modal:open"><button class="addNewBtn btn btn-primary mb-2">+</button></a>
            </div>
        </div>
        <div class="listWrapper">
            <table id="mainTable" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Food Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="foodTable">
                    <?php
                    foreach ($foodData as $index => $food) {
                    ?>
                        <tr>
                            <td><?php echo $index + 1 ?></td>
                            <td><?php echo $food['foodName'] ?></td>
                            <td>
                                <button class="btn btn-primary editItem" data-id="<?php echo $food['id'] ?>" modal-id="#addNewItemModal">Edit</button>
                                <button class="btn btn-danger deleteItem" data-id="<?php echo $food['id'] ?>">Delete</button>
                                <button class="btn btn-primary viewItem" data-id="<?php echo $food['id'] ?>">View</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal -->
<div id="addNewItemModal" class="modal">
    <div class="wrapper d-flex align-items-center justify-content-center">
        <div class="p-5 w-100">
            <h3 class="text-center">Add New Item</h3>
            <form class="w-100" id="addNewFoodItemForm">
                <div class="form-group">
                    <label for="newFoodName">Food Name</label>
                    <input type="text" class="form-control" id="newFoodName" placeholder="Enter new food">
                </div>
                <div class="form-group mt-3">
                    <button type="button" id="addNewFoodItemBtn" class="btn btn-success">Save Item</button>
                </div>
                <p class="userAddMessage"></p>
            </form>
        </div>
    </div>
</div>

<!-- modal end -->

<!-- modal show logs -->
<div id="showLogs" class="modal modalBase">
    <div class="wrapper d-flex align-items-center justify-content-center">
        <div class="p-5 w-100">
            <h3 class="text-center">Logs</h3>
            <table class="table tableLogs w-100" id="tableLogs">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Action</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal end -->

<?php

include './footer.php';
