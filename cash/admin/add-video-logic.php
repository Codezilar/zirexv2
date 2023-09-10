<?php

require 'config/database.php';

if(isset($_POST['submit'])){
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // check  is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // form validation
    if(!$title){
        $_SESSION['add-video'] = "Enter post title";
    }elseif(!$category_id){
        $_SESSION['add-video'] = "Select post category";
    }elseif(!$thumbnail['name']){
        $_SESSION['add-video'] = "Choose Video";
    }else{
        // work thumbnail
        //rename the video
        $time = time(); 
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../videos/' . $thumbnail_name;

        // make sure file is an image
        $allowed_files = ['mp4', 'webm', 'flv', 'avi'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);
        if(in_array($extension, $allowed_files)){
            // ensure image is not too big. (100mb +)
            if($thumbnail['size'] < 100_000_000){
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            }else{
                $_SESSION['add-video'] = "Video size too big. Should be less than 100mb";
            }
        }else{
            $_SESSION['add-video'] = "Video should be mp4, avi, webm or flv";
        }
    }

   // redirect back (width form data) to add-pot page if there is any problem
    if(isset($_SESSION['add-video'])){
        $_SESSION['add-video-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-video.php');
        die();
    }else{
        // set is_feature post of all videos to 0 if is_featured for this post is 1
        if($is_featured == 1){
            $zero_all_is_feature_query = "UPDATE videos SET is_featured=0";
            $zero_all_is_feature_result = mysqli_query($connection, $zero_all_is_feature_query);
        } 

        // insert post into database
        $query = "INSERT INTO videos(title, thumbnail, category_id, author_id, is_featured) VALUES ('$title', '$thumbnail_name', $category_id, $author_id, $is_featured)";
        $result = mysqli_query($connection, $query);
        if(!mysqli_errno($connection)){
            $_SESSION['add-video-success'] = 'New post added successfully';
            header('location: ' . ROOT_URL . 'admin/manage-video.php');
            die();
        }
    }
}

header('location: ' . ROOT_URL . 'admin/add-video.php');
die();
?>