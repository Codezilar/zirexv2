<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php";    

    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        // fetch category from dfatabase
        $query = "SELECT * FROM categories WHERE id=$id";
        $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result) == 1){
            $category = mysqli_fetch_assoc($result);
        }

    }else{
        header('location: ' . ROOT_URL . 'admin/manage-category.php');
        die();
    }
?>
<div class="category">
    <h2>
        <a href="./manage-category.php"><i class="fas fa-arrow-left"></i> Edit Category</a>
    </h2>
    <?php if(isset($_SESSION['edit-category'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['edit-category'];
                unset($_SESSION['edit-category'])
            ?>
        </h3>
    <?php endif ?>  
    <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" method="POST">
        <input type="hidden" name="id" value ="<?= $category['id'] ?>">

        <div class="inputs">
            <input class="input" name="title" value ="<?= $category['title'] ?>" type="text" placeholder="Title">
        </div>
        <textarea name="description" placeholder="Type here..."><?= $category['description'] ?></textarea>
        
        <button type="submit" name="submit">
            Update Category
        </button>
    </form>
</div>

<?php
    include "../includes/footer.php";   
?>

                   
