<?php

require 'config/database.php';

if(isset($_POST['submit'])){
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // check  is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // form validation
    if(!$title){
        $_SESSION['add-post'] = "Enter post title";
    }elseif(!$category_id){
        $_SESSION['add-post'] = "Select post category";
    }elseif(!$body){
        $_SESSION['add-post'] = "Enter post body";
    }elseif(!$thumbnail['name']){
        $_SESSION['add-post'] = "Choose post thumnail";
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
                $_SESSION['add-post'] = "Thumbnail size too big. Should be less than 2mb";
            }
        }else{
            $_SESSION['add-post'] = "Thumbnail should be png, jpg or jpeg";
        }
    }

   // redirect back (width form data) to add-pot page if there is any problem
    if(isset($_SESSION['add-post'])){
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    }else{
        // set is_feature post of all posts to 0 if is_featured for this post is 1
        if($is_featured == 1){
            $zero_all_is_feature_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_feature_result = mysqli_query($connection, $zero_all_is_feature_query);
        } 

        // insert post into database
        $query = "INSERT INTO posts(title, body, thumbnail, category_id, author_id, is_featured) VALUES ('$title', '$body', '$thumbnail_name', $category_id, $author_id, $is_featured)";
        $result = mysqli_query($connection, $query);
        if(!mysqli_errno($connection)){
            $_SESSION['add-post-success'] = 'New post added successfully';
            header('location: ' . ROOT_URL . 'admin/manage-post.php');
            die();
        }
    }
}

header('location: ' . ROOT_URL . 'admin/add-post.php');
die();
?>