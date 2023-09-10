<?php
    include "../includes/header.php";   
    include "../includes/aside-video.php";   
    include "../includes/video-center.php";    

    // fetch post from database
    $video_query = "SELECT * FROM videos ORDER BY date_time DESC";
    $videos = mysqli_query($connection, $video_query);
?>
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
                <?php
                    // fetch category from categories table useing category_id of post
                    $category_id = $video['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);    
                ?>
                <a href="<?= ROOT_URL ?>admin/category-videos.php?id=<?= $category_id ?>"><?= $category['title'] ?></a>
            </div>
        </div>
        <a class="post_title">
            <h4 ><?= $video['title'] ?> </h4>
        </a>
        <div class="post-img">
            <video controls src="../videos/<?= $video['thumbnail'] ?>"></video>
        </div>
    </div>
<?php endwhile ?>
<?php
    include "../includes/footer.php";   
?>

