<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php"; 
    
    // fetch current users post from database
    $query = "SELECT * FROM notifications ORDER BY id DESC";
    $posts = mysqli_query($connection, $query);   
?>

<div class="manage">
    <h2>
        <a href="./interface.php"><i class="fas fa-arrow-left"></i> Manage Posts</a>
    </h2>
    <?php if(isset($_SESSION['edit-notify-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['edit-notify-success'];
                unset($_SESSION['edit-notify-success'])
            ?>
        </h3>    
    <?php elseif(isset($_SESSION['send-noty-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['send-noty-success'];
                unset($_SESSION['send-noty-success'])
            ?>
        </h3>    
    <?php elseif(isset($_SESSION['delete-noty-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['delete-noty-success'];
                unset($_SESSION['delete-noty-success'])
            ?>
        </h3>    
    <?php endif ?>
    <div class="manage-container">
        <div class="category-top">
            <div class="manage-text">
                Title
            </div>
            <div class="manage-text">
                Edit
            </div>
            <div class="manage-text">
                Delete
            </div>
        </div>
        <div class="cat-edit">
            <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                <div class="category-top">
                    <div class="category-edit">
                        <?= $post['title'] ?>
                    </div>
                    <a href="<?= ROOT_URL ?>admin/edit-notification.php?id=<?= $post['id'] ?>" class="category-edit">
                        Edit
                    </a>
                    <a href="<?= ROOT_URL ?>admin/delete-notification.php?id=<?= $post['id'] ?>" class="category-edit">
                        Delete
                    </a>
                </div>
            <?php endwhile ?>
        </div>
    </div>
</div>

<?php
    include "../includes/footer.php";   
?>

                    