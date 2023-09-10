<?php

require 'config/database.php';
// fetch user data 

if (!isset($_SESSION['user-id'])) {
    header('location: ' .  ROOT_URL . 'login.php');
    die();
}else{        
    if(isset($_SESSION['user-id'])) {
        $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($connection, $query);
        $avatar = mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIREX</title>
    <!-- fontawesome icon -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    <!-- material icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
    
    <!-- bootstrap -->
    <!-- <link rel="stylesheet" href="<?= ROOT_URL ?>assets/bootstrap.min.css">
     -->
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">
        <div class="main-container">
            