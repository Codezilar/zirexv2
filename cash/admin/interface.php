<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php";    
?>

<div class="audience-wrapp">
    <a href="./add-post.php">
        <div class="audience-container">
            <span><i class="fas fa-cloud"></i></span>
            <h1>Add Post</h1>
            <p>Your post should give readers a taste of what they expect from the categpory</p>
        </div>
    </a>

    <a href="./manage-post.php">
        <div class="audience-container">
            <span><i class="fas fa-tasks"></i></span>
            <h1>Manage Posts</h1>
            <p>Manage and delete posts</p>
        </div>
    </a>
    <a href="./add-video.php">
        <div class="audience-container">
            <span><i class="fas fa-cloud"></i></span>
            <h1>Add Video</h1>
            <p>Your video should give readers a taste of what they expect from the categpory</p>
        </div>
    </a>

    <a href="./manage-video.php">
        <div class="audience-container">
            <span><i class="fas fa-tasks"></i></span>
            <h1>Manage Videos</h1>
            <p>Manage and delete videos</p>
        </div>
    </a>
    <a href="./manage-post.php">
        <div class="audience-container">
            <span><i class="fas fa-tasks"></i></span>
            <h1>Monetization Tools</h1>
            <p>Become a creator and make a living from zirex</p>
        </div>
    </a>

    <?php if(isset($_SESSION['user_is_admin'])) : ?>

        <a href="./notification.php">
            <div class="audience-container">
                <span><i class="fas fa-users"></i></span>
                <h1>Notify Users</h1>
                <p>Send notification to all your users</p>
            </div>
        </a>
        
        <a href="./manage-notification.php">
            <div class="audience-container">
                <span><i class="fas fa-users"></i></span>
                <h1>Manage Notifications</h1>
                <p>Make Notification changes</p>
            </div>
        </a>
        
        <a href="./manage-users.php">
            <div class="audience-container">
                <span><i class="fas fa-users"></i></span>
                <h1>Manage Users</h1>
                <p>Share Link With Your Audience To Get Started</p>
            </div>
        </a>

        <a href="./add-category.php">
            <div class="audience-container">
                <span><i class="fas fa-puzzle-piece"></i></span>
                <h1>Add Category</h1>
                <p>Share Link With Your Audience To Get Started</p>
            </div>
        </a>

        <a href="./manage-category.php">
            <div class="audience-container">
                <span><i class="fas fa-edit"></i><i class="fas fa-puzzle-piece"></i></span>
                <h1>Manage Category</h1>
                <p>Share Link With Your Audience To Get Started</p>
            </div>
        </a>
    <?php endif ?>

</div>

<?php
    include "../includes/footer.php";   
?>

