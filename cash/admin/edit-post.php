<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php"; 

    //fetch categories from database
    $category_query = "SELECT * FROM categories";
    $categories = mysqli_query($connection, $category_query);

    // fetch post data from database if id isset
    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query ="SELECT * FROM posts WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $post = mysqli_fetch_assoc($result);
    }else{
        header('location: ' . ROOT_URL . 'admin/interface.php');
        die();
    }
?>
<div class="post">
    <h2>
        <a href="./manage-post.php"><i class="fas fa-arrow-left"></i> Edit Post</a>
    </h2>
    <?php if(isset($_SESSION['edit-post'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['edit-post'];
                unset($_SESSION['edit-post'])
            ?>
        </h3>
    <?php endif ?> 
    <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" method="POST" enctype="multipart/form-data">
        <div class="inputs">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
            <input class="input"  type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title">
            <select name="category" class="input">
                <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <textarea name="body" placeholder="Type here..."><?= $post['body'] ?></textarea>
        <div class="inputs">
            <input name="thumbnail" id="thumbnail" class="file" type="file">
        </div>
        
        <?php if(isset($_SESSION['user_is_admin'])) : ?>
            <div class="check-con">
                <input class="checkbox" checked type="checkbox" name="is_featured" id="is_featured" value="1">
                <h6>Featured</h6>
            </div>
        <?php endif ?>
        <button type="submit" name="submit">
            Update Post
        </button>
    </form>
</div>

<?php
    include "../includes/footer.php";   
?>

