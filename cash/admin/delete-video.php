<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
    // fetch video from database in other to delete thumbnail from image folder
    $query = "SELECT * FROM videos WHERE id=$id";
    $result = mysqli_query($connection, $query);

    //make sure only one 1 record is returned
    if(mysqli_num_rows($result) == 1){
        $video = mysqli_fetch_assoc($result);
        $thumbnail_name = $video['thumbnail'];
        $thumbnail_path = '../videos/' . $thumbnail_name;
        if($thumbnail_path){
            unlink($thumbnail_path);

            // delete video from database
            $delete_post_query = "DELETE FROM videos WHERE id=$id LIMIT 1";
            $delete_post_result = mysqli_query($connection, $delete_post_query);
            if(!mysqli_errno($connection)){
                $_SESSION['delete-video-success'] = "Video deleted successfully";
            }
        }
    }
}


header('location: ' . ROOT_URL . 'admin/manage-video.php');
die();

?>