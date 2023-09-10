<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php"; 

    // fetch post data from database if id isset
    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query ="SELECT * FROM notifications WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $post = mysqli_fetch_assoc($result);
    }else{
        header('location: ' . ROOT_URL . 'admin/interface.php');
        die();
    }
?>
<div class="post">
    <h2>
        <a href="./manage-notification.php"><i class="fas fa-arrow-left"></i> Edit Post</a>
    </h2>
    <?php if(isset($_SESSION['edit-notify'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['edit-notify'];
                unset($_SESSION['edit-notify'])
            ?>
        </h3>
    <?php endif ?> 
    <form action="<?= ROOT_URL ?>admin/edit-notification-logic.php" method="POST" enctype="multipart/form-data">
        <div class="inputs">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
            <input class="input"  type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title">
        </div>
        <textarea name="body" placeholder="Type here..."><?= $post['body'] ?></textarea>
        <div class="inputs">
            <input name="thumbnail" id="thumbnail" class="file" type="file">
        </div>
        
        <button type="submit" name="submit">
            Update Notification
        </button>
    </form>
</div>

<?php
    include "../includes/footer.php";   
?>

