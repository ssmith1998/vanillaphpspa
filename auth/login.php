<?php
session_start();
include '../connection.php';

//get values 
$email = $_POST['email'];
$password = $_POST['password'];
//check values against db starting with email
try {
    $stmt = $conn->prepare("SELECT email, userpassword, id FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    // set the resulting array to associative
    $result = $stmt->fetch();

    if ($result === false) {
        header('Location:/?loginError=true&&message=incorrect_credentials');
    } else {
        $hashed_password = $result['userpassword'];
        //check password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedUser'] = $result['id'];
            header('Location:/dashboard.php');
        } else {
            header('Location:/?loginError=true&&message=incorrect_credentials');
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//if user exists check password


//if all is good create session for user 


//else redirect with error
