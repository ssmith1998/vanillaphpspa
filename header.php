<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - SPA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resources/main.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
</head>

<body>
    <?php if (isset($_SESSION['loggedUser'])) : ?>
        <header class="mb-5">
            <!-- As a link -->
            <nav class="navbar navbar-light bg-light d-flex justify-coentent-between align-items-center px-4">
                <a class="navbar-brand" href="#">Navbar</a>
                <a class="navbar-brand" href="./logout.php">Logout</a>
            </nav>
        </header>
    <?php endif; ?>