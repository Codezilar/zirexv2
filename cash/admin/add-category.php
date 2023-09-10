<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php";    

    // get back form data if invalid
    $title = $_SESSION['add-category-data']['title'] ?? null;
    $description = $_SESSION['add-category-data']['description'] ?? null;

    unset($_SESSION['add-category-data']);
?>
<div class="category">
    <h2>
        <a href="./interface.php"><i class="fas fa-arrow-left"></i> Add Category</a>
    </h2>
    <?php if(isset($_SESSION['add-category'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['add-category'];
                unset($_SESSION['add-category'])
            ?>
        </h3>
    <?php endif ?>  
    <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
        <div class="inputs">
            <input class="input" value="<?= $title ?>" name="title" type="text" placeholder="Title">
        </div>
        <textarea name="description" placeholder="Type here..."><?= $description ?></textarea>
        
        <button type="submit" name="submit">
            Add Category
        </button>
    </form>
</div>

<?php
    include "../includes/footer.php";   
?>

                   
