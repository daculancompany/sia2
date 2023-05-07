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

if (isset($_POST['save-product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    //$file_name = basename($_FILES['product_image']['name']);
    $file_extension =  pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
    $filename = rand(1,9999999999999) . strtotime( date('Y-m-d H:i:s')) .  '.'.$file_extension;
    if (move_uploaded_file($_FILES['product_image']['tmp_name'], "uploads/$filename")) {
        $sql = "INSERT INTO `products`(`image`, `product_name`, `product_price`) VALUES ('$filename', '$product_name', '$product_price')";
        if (!$conn->query( $sql )) {
            echo("Error description: " . $conn->error);
        }else{
            echo 'success';
        }
       // $result = $conn->query($sql);
    } else {
      echo "An error occurred";
    }
}


if (isset($_POST['save-product2'])) {
    //basename($_FILES['image']['name'])
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $file_extension =  pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
    $filename = rand(1,9999999999999) . strtotime( date('Y-m-d H:i:s')) .  '.'.$file_extension;
    if (move_uploaded_file($_FILES['product_image']['tmp_name'], "uploads/$filename")) {
        $sql = "INSERT INTO `products`(`image`, `product_name`, `product_price`) VALUES ('$filename', '$product_name', '$product_price')";
        if (!$conn->query( $sql )) {
            echo("Error description: " . $conn->error);
        }else{
            echo 'success';
        }
       // $result = $conn->query($sql);
    } else {
      echo "An error occurred";
    }
}

if (isset($_POST['testApi'])) {
    var_dump($_POST['name']);
}

if (isset($_POST['saveOrder'])) {
    $total_amount = $_POST['total_amount'];
    foreach($_POST['orders'] as $order){
        var_dump($order['id']);
        //add save code here
    }
}


else{
    echo 'no data found';
}
