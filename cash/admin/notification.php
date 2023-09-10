<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php";    

    //get back form data if form was invalid
    $title = $_SESSION['send-noty-data']['title'] ?? null;
    $body = $_SESSION['send-noty-data']['body'] ?? null;

    // delete form data session
    unset($_SESSION['send-noty-data']); 
?>

<div class="post">
    <h2>
        <a href="./interface.php"><i class="fas fa-arrow-left"></i> Notify Users</a>
    </h2>
    <?php if(isset($_SESSION['send-noty'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['send-noty'];
                unset($_SESSION['send-noty'])
            ?>
        </h3>
    <?php endif ?> 
    <form action="<?= ROOT_URL ?>admin/notification-logic.php" enctype="multipart/form-data" method="POST">
        <div class="inputs">
            <input class="input" name="title" value="<?= $title ?>" type="text" placeholder="Title">
        </div>
        <textarea name="body" placeholder="Type here..."><?= $body ?></textarea>
        <div class="inputs">
            <input name="thumbnail" class="file" type="file">
        </div>
        <button type="submit" name="submit">
            Notify
        </button>
    </form>
</div>

<?php
    include "../includes/footer.php";   
?>