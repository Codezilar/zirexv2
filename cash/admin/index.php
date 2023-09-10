<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php";    

    // fetch post from database
    $post_query = "SELECT * FROM posts ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $post_query);
?>

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
        <a class="post_title" href="<?= ROOT_URL ?>admin/post.php?id=<?= $post['id'] ?>">
            <h4 ><?= $post['title'] ?> </h4> <p> Read more..</p>
        </a>
        <div class="post-img">  
            <img src="../images/<?= $post['thumbnail'] ?>">
        </div>
        <div id="error-status">
            
        </div>
        <div class="post-review">
            <div class="liker">
                <div class="like-content">
                    <i class="heart">@</i> 
                    <span class="like">Like</span>
                    <span class="numb">13</span>
                </div>
            </div>
            <form class="comment" action="">
                <input type="hidden" class="post_id" value="<?= $post['id'] ?>">
                    <textarea class="text-box-comment" name="" id=""></textarea>
                    
                    <button class="comment-btn" type="button">
                        >
                    </button>
            </form>
        </div>
        <div class="talks">
            <div class="talks-img">
                <img src="../images/1692879019goku.jpeg" alt="">
            </div>
            <div class="talk-right">
                <div class="talker-name">Goodness Christopher</div>
                <h5>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis officia non repellendus ea molestias sunt fugiat incidunt officiis pariatur voluptatibus qui iusto praesentium exercitationem ipsam, suscipit similique omnis, error, provident iure vitae labore? Tempora eum quia vitae commodi perferendis id deserunt ipsum aliquam eius quasi! Dolorem illum labore expedita quibusdam.
                </h5>
                <div class="talks-event">
                    <span class="view-comment">View more comments</span>
                </div>
            </div>
        </div>
    </div>
<?php endwhile ?>
<?php
    include "../includes/footer.php";   
?>

