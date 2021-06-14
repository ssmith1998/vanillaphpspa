<?php
include '../connection.php';
//get email and password
$email = $_POST['email'];
$password = $_POST['password'];

try {
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    // set the resulting array to associative
    $result = $stmt->fetch();

    if ($result !== false) {
        header('Location:/?error=true&&message=Account Exists');
    } else {
        //create account
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (email, userpassword, username) VALUES (?,?,?)");
            $stmt->execute([$email, $hashed_password, $email]);
            $stmt = null;
            header('Location:/?error=false&&message=Account_created');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//check if already exists 


//if not insert and send back with message