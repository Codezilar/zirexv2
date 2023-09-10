<?php
    include "../includes/header.php";   
    include "../includes/aside-video.php";   
    include "../includes/center.php"; 

    // fetch categories from database
    $query = "SELECT * FROM categories";
    $categories = mysqli_query($connection, $query);

    //get back form data if form was invalid
    $title = $_SESSION['add-video-data']['title'] ?? null;

    // delete form data session
    unset($_SESSION['add-video-data']); 
?>
<div class="post">
    <h2>
        <a href="./interface.php"><i class="fas fa-arrow-left"></i> Add Video</a>
    </h2>
    <?php if(isset($_SESSION['add-video'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['add-video'];
                unset($_SESSION['add-video']);
            ?>
        </h3>
    <?php endif ?> 
    <form action="<?= ROOT_URL ?>admin/add-video-logic.php" enctype="multipart/form-data" method="POST">
        <div class="inputs">
            <input class="input" name="title" value="<?= $title ?>" type="text" placeholder="Title">
            <select name="category" class="input">
                <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="inputs">
            <input name="thumbnail" class="file" type="file">
        </div>
        
        <?php if(isset($_SESSION['user_is_admin'])) : ?>
            <div class="check-con">
                <input name="is_featured" class="checkbox" checked value="1" type="checkbox">
                <h6>Featured</h6>
            </div>
        <?php endif ?>
        <button type="submit" name="submit">
            Add Video
        </button>
    </form>
</div>

<?php
    include "../includes/footer.php";   
?>

