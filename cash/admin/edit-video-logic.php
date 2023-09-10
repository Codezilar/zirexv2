<?php
include 'config/database.php';

// make sure edit button was clicked
if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //  set is_featured to 0 if it was unchecked
    $is_featured = $is_featured == 1 ?: 0;

    //  checked and validate input valus
    if(!$title){
        $_SESSION['edit-video'] = "Couldn't update video. invalid form data on edit video page";
    }elseif(!$category_id){
        $_SESSION['edit-video'] = "Couldn't update video. invalid form data on edit video page";
    }else{
        // delete existing thumbnail if new thumbnail is available
        if($thumbnail['name']){
            $previous_thumbnail_path = '../videos/' . $previous_thumbnail_name;
            if($previous_thumbnail_path){
                unlink($previous_thumbnail_path);
            }

            // work on thumbnail
            // rename image
            $time = time(); // to make sure the name if each uploaded image is unique
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../videos/' . $thumbnail_name;

            // make sure file is an image
            $allowed_files = ['mp4', 'webm', 'flv', 'avi'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);
            if(in_array($extension, $allowed_files)){
                // ensure image is not too big. (100mb +)
                if($thumbnail['size'] < 100000000){
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                }else{
                    $_SESSION['edit-video'] = "Couldn't update video. Thumbnail size too big. Should be less than 100mb";
                }
            }else{
                $_SESSION['edit-video'] = "Couldn't update video. Thumbnail should be mp4, webm, flv or avi";
            }
            
        }
    }
    // redirect back (width form data) to add-pot page if there is any problem
    if(isset($_SESSION['edit-video'])){
        // redirect to manage form page if form was invalid
        header('location: ' . ROOT_URL . 'admin/manage-video.php');
        die();
    }else{
        // set is_feature video of all videos to 0 if is_featured for this video is 1
        if($is_featured == 1){
            $zero_all_is_feature_query = "UPDATE videos SET is_featured=0";
            $zero_all_is_feature_result = mysqli_query($connection, $zero_all_is_feature_query);
        } 

        // set thumbnail name if new thumb nail was uploaded, else keep old thumbnail
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        $query = "UPDATE videos SET title='$title', thumbnail='$thumbnail_to_insert', category_id=$category_id, is_featured=$is_featured WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

    }

    if(!mysqli_errno($connection)){
        $_SESSION['edit-video-success'] = 'Post updated successfully';
        header('location: ' . ROOT_URL . 'admin/manage-video.php');
        die();
    }

}

header('location: ' . ROOT_URL . 'admin/manage-video.php');
die();



?>