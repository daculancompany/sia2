<?php
  session_start();
require('config.php');

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users`(`name`, `email`,  `password`) VALUES ('$name','$email','$password')";

    $result = $conn->query($sql);
    if ($result == TRUE) {
        header("Location: sign-up.php?message=New record created successfully.&type=login");
    } else {
        header("Location: sign-up.php?message=error");
    }
    $conn->close();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password =  $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE email='" . $email . "' ";
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    if (isset($row)) {
        if (password_verify($password, $row[3])) {
            $_SESSION['USER_ID'] = $row[0];
            header("Location: index.php");
        } else {
            header("Location: login.php?type=error");
        }
        return;
    }
    header("Location: login.php?type=error");
}

if (isset($_GET['type']) && $_GET['type'] === 'logout') {
    session_destroy(); 
    //unset($_SESSION['USER_ID']);
    header("Location: login.php");

}



else{
    echo 'no data found';
}
