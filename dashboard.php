<?php
session_start();
if (!$_SESSION['loggedUser']) {
    header('Location:/');
}

echo $_SESSION['loggedUser'];

//get logged in user from session

//display data
