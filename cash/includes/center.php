<div class="center">
    <div class="center-container">
        <div class="center-nav">
            <a href="<?= ROOT_URL ?>admin/index.php">Home</a>
            <?php
                $all_categories = "SELECT * FROM categories ORDER BY title";
                $all_categories_result = mysqli_query($connection, $all_categories);
            ?>
            <?php while($category = mysqli_fetch_assoc($all_categories_result)) : ?>
            <a href="<?= ROOT_URL ?>admin/category-posts.php?id=<?= $category['id'] ?>"><?= $category['title'] ?></a>
            <?php endwhile ?>
        </div>
        <span id="bar">
            <i class="fas fa-bars">df</i>
        </span>
        <span id="close">
            <i class="fas fa-times">ccfvgb</i>
        </span>
    </div>
<div class="feeds mainFeed">
    <div class="switch">
        <a class="switcher" href="./index.php">POSTS</a>
        <a href="./index-video.php">VIDEOS</a>
    </div>