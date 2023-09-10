<?php
    include "../includes/header.php";   
    include "../includes/aside-video.php";   
    include "../includes/center.php"; 
    
    // fetch current users video from database
    $current_user_id = $_SESSION['user-id'];
    $query = "SELECT id, title, category_id FROM videos WHERE author_id=$current_user_id ORDER BY id DESC";
    $videos = mysqli_query($connection, $query);   
?>

<div class="manage">
    <h2>
        <a href="./interface.php"><i class="fas fa-arrow-left"></i> Manage Videos</a>
    </h2>
    <?php if(isset($_SESSION['edit-video-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['edit-video-success'];
                unset($_SESSION['edit-video-success'])
            ?>
        </h3>    
    <?php elseif(isset($_SESSION['edit-video'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['edit-video'];
                unset($_SESSION['edit-video'])
            ?>
        </h3>    
    <?php elseif(isset($_SESSION['add-video'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['add-video'];
                unset($_SESSION['add-video'])
            ?>
        </h3>    
    <?php elseif(isset($_SESSION['delete-video-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['delete-video-success'];
                unset($_SESSION['delete-video-success'])
            ?>
        </h3>    
    <?php elseif(isset($_SESSION['add-video-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['add-video-success'];
                unset($_SESSION['add-video-success'])
            ?>
        </h3>    
    <?php endif ?>
    <div class="manage-container">
        <div class="manage-top">
            <div class="manage-text">
                Title
            </div>
            <div class="manage-text">
                Category
            </div>
            <div class="manage-text">
                Edit
            </div>
            <div class="manage-text">
                Delete
            </div>
        </div>
        <div class="cat-edit">
            <?php while($video = mysqli_fetch_assoc($videos)) : ?>
                <div class="manage-top">
                    <div class="category-edit">
                        <?= $video['title'] ?>
                    </div>
                    <div class="category-edit">
                        <!-- get category title of each video from categories table -->
                        <?php 
                            $category_id = $video['category_id'];
                            $category_query = "SELECT title FROM categories WHERE id=$category_id";
                            $category_result = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                        ?>
                        <?= $category['title'] ?>
                    </div>
                    <a href="<?= ROOT_URL ?>admin/edit-video.php?id=<?= $video['id'] ?>" class="category-edit">
                        Edit
                    </a>
                    <a href="<?= ROOT_URL ?>admin/delete-video.php?id=<?= $video['id'] ?>" class="category-edit">
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

                    