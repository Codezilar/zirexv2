<?php

require 'config/database.php';

if(isset($_POST['submit'])){
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_SPECIAL_CHARS);
    $author_id = 1;
    $thumbnail = $_FILES['thumbnail'];
    
    // form validation
    if(!$title){
        $_SESSION['send-noty'] = "Enter post title";
    }elseif(!$body){
        $_SESSION['send-noty'] = "Enter post body";
    }elseif(!$thumbnail['name']){
        $_SESSION['send-noty'] = "Choose post thumnail";
    }else{
        // work thumbnail
        //rename the image
        $time = time(); 
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;

        // make sure file is an image
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);
        if(in_array($extension, $allowed_files)){
            // ensure image is not too big. (2mb +)
            if($thumbnail['size'] < 2_000_000){
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            }else{
                $_SESSION['send-noty'] = "Thumbnail size too big. Should be less than 2mb";
            }
        }else{
            $_SESSION['send-noty'] = "Thumbnail should be png, jpg or jpeg";
        }
    }

   // redirect back (width form data) to add-pot page if there is any problem
    if(isset($_SESSION['send-noty'])){
        $_SESSION['send-noty-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/notification.php');
        die();
    }else{

        // insert post into database
        $query = "INSERT INTO notifications(title, body, thumbnail, author_id) VALUES ('$title', '$body', '$thumbnail_name', '$author_id')";
        $result = mysqli_query($connection, $query);
        if(!mysqli_errno($connection)){
            $_SESSION['send-noty-success'] = 'New post added successfully';
            header('location: ' . ROOT_URL . 'admin/manage-notification.php');
            die();
        }
    }
}else{

    header('location: ' . ROOT_URL . 'admin/notification.php');
    die();
}
?>