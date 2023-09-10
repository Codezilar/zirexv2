<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php";    

    // check if id isset
    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM users WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($result);
    }else{
        header('location: ' . ROOT_URL . 'admin/manage-users.php');
        die();
    }
?>
<div class="form-user">
    <h3>Edit User</h3>  
    <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">
        <input type="hidden" value="<?= $user['id'] ?>" name="id">
        <input type="text" value="<?= $user['firstname'] ?>" name="firstname" placeholder="First Name">
        <input type="text" value="<?= $user['lastname'] ?>" name="lastname" placeholder="Last Name">
        <select name="userrole">
            <option value="0">Nornal User</option>
            <option value="1">Admin</option>
        </select>
        <button type="submit" name="submit" >
            Update User
        </button>
    </form>
</div>
