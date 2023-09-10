<?php
require 'config/database.php';


if(isset($_POST['add_comment'])){
    $msg = mysqli_real_escape_string($connection, $_POST['msg']);
    $post_id = mysqli_real_escape_string($connection, $_POST['post_id']);
    $user_id = $_SESSION['user-id'];

    $comment_query = "INSERT INTO comments (user_id, msg, post_id) VALUES ('$user_id', '$msg', '$post_id')";
    $comment_result = mysqli_query($connection, $comment_query);
    if($comment_result){
        echo "Comment Added Successfully";
    }else{
        echo "Comment not added! Something Went Wrong";
    }

}

?>