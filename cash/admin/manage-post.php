<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php"; 
    
    // fetch current users post from database
    $current_user_id = $_SESSION['user-id'];
    $query = "SELECT id, title, category_id FROM posts WHERE author_id=$current_user_id ORDER BY id DESC";
    $posts = mysqli_query($connection, $query);   
?>

<div class="manage">
    <h2>
        <a href="./interface.php"><i class="fas fa-arrow-left"></i> Manage Posts</a>
    </h2>
    <?php if(isset($_SESSION['edit-post-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['edit-post-success'];
                unset($_SESSION['edit-post-success'])
            ?>
        </h3>    
    <?php elseif(isset($_SESSION['edit-post'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['edit-post'];
                unset($_SESSION['edit-post'])
            ?>
        </h3>    
    <?php elseif(isset($_SESSION['add-post'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['add-post'];
                unset($_SESSION['add-post'])
            ?>
        </h3>    
    <?php elseif(isset($_SESSION['delete-post-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['delete-post-success'];
                unset($_SESSION['delete-post-success'])
            ?>
        </h3>    
    <?php elseif(isset($_SESSION['add-post-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['add-post-success'];
                unset($_SESSION['add-post-success'])
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
            <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                <div class="manage-top">
                    <div class="category-edit">
                        <?= $post['title'] ?>
                    </div>
                    <div class="category-edit">
                        <!-- get category title of each post from categories table -->
                        <?php 
                            $category_id = $post['category_id'];
                            $category_query = "SELECT title FROM categories WHERE id=$category_id";
                            $category_result = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                        ?>
                        <?= $category['title'] ?>
                    </div>
                    <a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="category-edit">
                        Edit
                    </a>
                    <a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="category-edit">
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

                    