<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php";

    // fetch post from database if id isset
    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM posts WHERE id=$id";
        $resul = mysqli_query($connection, $query);
        $post = mysqli_fetch_assoc($resul);
    }else{
        header('location: ' . ROOT_URL . 'admin/index.php');
        die();
    }
?>
<div class="feed feeed">
    <div class="title-div">
        <div class="head-title">
            <?php
                    $author_id = $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
            ?>
            <div class="profile-pic">
                <img class="profile-image" src="../images/<?= $author['avatar'] ?>">
            </div>
            <div class="head-name">                    
                <h3><?= "{$author['firstname']} {$author['lastname']}" ?></h3>
                <p><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></p>
            </div>
        </div>
        <div class="menu-icon">
                <?php
                    // fetch category from categories table useing category_id of post
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);    
                ?>
                <a href="<?= ROOT_URL ?>admin/category-posts.php?id=<?= $category_id ?>"><?= $category['title'] ?></a>
        </div>
    </div>

    <h4 class="post_title"><?= $post['title'] ?></h4>

    <div class="post-img">
        <img src="../images/<?= $post['thumbnail'] ?>">
    </div>
    <p>
        <?= $post['body'] ?>
    </p>
</div>

<?php
    include "../includes/footer.php";   
?>