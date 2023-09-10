<?php
    include "../includes/header.php";   
    include "../includes/aside.php";      

    // fetch post from database
    $post_query = "SELECT * FROM notifications ORDER BY time DESC";
    $posts = mysqli_query($connection, $post_query);
?>
    
<div class="notifyer">
    <div class="manage-category">
        <h2>
            <a href="./index.php"><i class="fas fa-arrow-left"></i> Notifications</a>
        </h2>
    </div>
    <?php while($post = mysqli_fetch_assoc($posts)) : ?>
        <div class="feed">
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
                        <p><?= date("M d, Y - H:i", strtotime($post['time'])) ?></p>
                    </div>
                </div>
                <div class="menu-icon">
                    <a href="#">$@</a>
                </div>
            </div>
            <a class="post_title" href="#">
                <h4 ><?= $post['title'] ?> </h4> 
                <p><?= $post['body'] ?></p>
            </a>
            <div class="post-img">
                <img src="../images/<?= $post['thumbnail'] ?>">
            </div>
        </div>
    <?php endwhile ?>
</div>
<?php
    include "../includes/footer.php";   
?>

