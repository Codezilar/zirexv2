<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php";   
    
    // fetch users from database but not current user
    $current_admin_id = $_SESSION['user-id'];
    $query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
    $users = mysqli_query($connection, $query);
?>



<div class="manage-user">
    <h2>
        <a href="./interface.php"><i class="fas fa-arrow-left"></i> Manage Users</a>
    </h2>

    <?php if(isset($_SESSION['edit-user-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success'])
            ?>
        </h3>
    <?php elseif(isset($_SESSION['edit-user'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['edit-user'];
                unset($_SESSION['edit-user'])
            ?>
        </h3>
    <?php elseif(isset($_SESSION['delete-user-success'])): ?>
        <h3 class="success">
            <?= 
                $_SESSION['delete-user-success'];
                unset($_SESSION['delete-user-success'])
            ?>
        </h3>
    <?php elseif(isset($_SESSION['delete-user'])): ?>
        <h3 class="error">
            <?= 
                $_SESSION['delete-user'];
                unset($_SESSION['delete-user'])
            ?>
        </h3>
    <?php endif ?>  
    <div class="manage-container">
        <div class="user-top">
            <div class="manage-text">
                Name
            </div>
            <div class="manage-text">
                Username
            </div>
            <div class="manage-text">
                Edit
            </div>
            <div class="manage-text">
                Delete
            </div>
            <div class="manage-text">
                Admin
            </div>
        </div>
        <div class="cat-edit">
            <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                <div class="user-top">
                    <div class="category-edit">
                        <?= "{$user['firstname']} {$user['lastname']}" ?>
                    </div>
                    <div class="category-edit">
                        <?= $user['username'] ?>
                    </div>
                    <div class="category-edit">
                        <a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="">Edit</a>
                    </div>
                    <div class="category-edit">
                        <a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="">Delete</a>
                    </div>
                    <div class="category-edit">
                        <?= $user['is_admin'] ? 'Yes' : 'No' ?>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
    </div>
</div>


<?php
    include "../includes/footer.php";   
?>
