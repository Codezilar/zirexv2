<?php
include 'config/database.php';

// make sure edit button was clicked
if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];

    //  checked and validate input valus
    if(!$title){
        $_SESSION['edit-notify'] = "Couldn't update notification. invalid form data on edit notification page";
    }elseif(!$body){
        $_SESSION['edit-notify'] = "Couldn't update notification. invalid form data on edit notification page";
    }else{
        // delete existing thumbnail if new thumbnail is available
        if($thumbnail['name']){
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if($previous_thumbnail_path){
                unlink($previous_thumbnail_path);
            }

            // work on thumbnail
            // rename image
            $time = time(); // to make sure the name if each uploaded image is unique
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;

            // make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);
            if(in_array($extension, $allowed_files)){
                // ensure image is not too big. (2mb +)
                if($thumbnail['size'] < 2000000){
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                }else{
                    $_SESSION['edit-notify'] = "Couldn't update notification. Thumbnail size too big. Should be less than 2mb";
                }
            }else{
                $_SESSION['edit-notify'] = "Couldn't update notification. Thumbnail should be png, jpg or jpeg";
            }
            
        }
    }
    // redirect back (width form data) to add-pot page if there is any problem
    if(isset($_SESSION['edit-notify'])){
        // redirect to manage form page if form was invalid
        header('location: ' . ROOT_URL . 'admin/manage-notification.php');
        die();
    }else{
        // set thumbnail name if new thumb nail was uploaded, else keep old thumbnail
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        $query = "UPDATE notifications SET title='$title', body='$body', thumbnail='$thumbnail_to_insert' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

    }

    if(!mysqli_errno($connection)){
        $_SESSION['edit-notify-success'] = 'Post updated successfully';
        header('location: ' . ROOT_URL . 'admin/manage-notification.php');
        die();
    }

}

header('location: ' . ROOT_URL . 'admin/manage-notification.php');
die();



?>