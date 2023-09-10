<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php";    

    // fetch category data from database
    $query = "SELECT * FROM categories ORDER BY title";
    $categories = mysqli_query($connection, $query);

?>


<div class="manage-category">
    <h2>
        <a href="./interface.php"><i class="fas fa-arrow-left"></i> Manage Categories</a>
    </h2>
    <?php if(isset($_SESSION['add-category'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['add-category'];
                unset($_SESSION['add-category'])
            ?>
        </h3>
    <?php elseif(isset($_SESSION['add-category-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['add-category-success'];
                unset($_SESSION['add-category-success'])
            ?>
        </h3>
    <?php elseif(isset($_SESSION['edit-category-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-success'])
            ?>
        </h3>
    <?php elseif(isset($_SESSION['edit-category'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['edit-category'];
                unset($_SESSION['edit-category'])
            ?>
        </h3>
    <?php elseif(isset($_SESSION['delete-category-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['delete-category-success'];
                unset($_SESSION['delete-category-success'])
            ?>
        </h3>
    <?php endif ?>
    <div class="manage-container">
        <div class="category-top">
            <div class="manage-text">
                Name
            </div>
            <div class="manage-text">
                Edit
            </div>
            <div class="manage-text">
                Delete
            </div>
        </div>
        <div class="cat-edit">
            <?php while ($category = mysqli_fetch_array($categories)) : ?>
                <div class="category-top">
                    <div class="category-edit">
                        <?= $category['title'] ?>
                    </div>
                    <a href="edit-category.php?id=<?= $category['id'] ?>" class="category-edit">
                        Edit
                    </a>
                    <a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>" class="category-edit">
                        Delete
                    </a>
                </div>
            <?php endwhile ?>
        </div>
    </div>  
</div>

<?php
    include "../includes/footer.php";   
?>
