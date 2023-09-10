<?php
    include "../includes/header.php";   
    include "../includes/aside-video.php";   
    include "../includes/video-center.php";

    // fetch post from database if id isset
    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM videos WHERE category_id=$id ORDER BY date_time DESC";
        $videos = mysqli_query($connection, $query);
    }else{
        header('location: ' . ROOT_URL . 'admin/index.php');
        die();
    }

    // fetch category from categories table useing category_id of post
    $category_id = $id;
    $category_query = "SELECT * FROM categories WHERE id=$id";
    $category_result = mysqli_query($connection, $category_query);
    $category = mysqli_fetch_assoc($category_result);    
?>
<h2><?= $category['title'] ?></h2>

<?php while($video = mysqli_fetch_assoc($videos)) : ?>
    <div class="feed">
        <div class="title-div">
            <div class="head-title">
                <?php
                        $author_id = $video['author_id'];
                        $author_query = "SELECT * FROM users WHERE id=$author_id";
                        $author_result = mysqli_query($connection, $author_query);
                        $author = mysqli_fetch_assoc($author_result);
                ?>
                <div class="profile-pic">
                    <img class="profile-image" src="../images/<?= $author['avatar'] ?>">
                </div>
                <div class="head-name">                    
                    <h3><?= "{$author['firstname']} {$author['lastname']}" ?></h3>
                    <p><?= date("M d, Y - H:i", strtotime($video['date_time'])) ?></p>
                </div>
            </div>
            <div class="menu-icon">
                <!-- <a href="">Category</a> -->
            </div>
        </div>
        <a href="<?= ROOT_URL ?>admin/post.php?id=<?= $video['id'] ?>">
            <h4 class="post_title"><?= $video['title'] ?></h4>
        </a>
        <div class="post-img">
            <video controls src="../videos/<?= $video['thumbnail'] ?>"></video>
        </div>
    </div>
<?php endwhile ?>

<?php
    include "../includes/footer.php";   
?>