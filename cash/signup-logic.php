<?php

session_start();

require 'config/database.php';

// get data if sign up button is clicked

if(isset($_POST['submit'])){
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];
    
    // validate inpute value
    if(!$firstname){
        $_SESSION['signup'] = "Please enter your First Name";
    }elseif (!$lastname) {
        $_SESSION['signup'] = "Please enter your Last Name";
    }elseif (!$username) {
        $_SESSION['signup'] = "Please enter your Username";
    }elseif (!$email) {
        $_SESSION['signup'] = "Please enter a valid Email";
    }elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password should be 8+ characters";
    }elseif (!$avatar){
        $_SESSION['signup'] = "Please add Avatar";
    }else{
        // check if password does not match
        if($createpassword !== $confirmpassword){
            $_SESSION['signup'] = "Password do not match!";
        }else{
            // hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
            // check if username or email already exist in the data base
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if(mysqli_num_rows($user_check_result) > 0){
                $_SESSION['signup'] = "Username or Email already exist";
            }else{
                // work on avatar
                // rename avatar
                $time = time(); // make each image name unique using current time stamp
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                // this is to ensure file been uploaded is an image
                $allowed_files = ['png', 'jpeg', 'jpg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if(in_array($extention, $allowed_files)){
                    // ensuring the image size is not to large
                    if($avatar['size'] < 1000000){
                        //  upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    }else{
                        $_SESSION['signup'] = "Avatar size too big. Should be less than 1mb";
                    }
                }else{
                    $_SESSION['signup'] = "File should be png, jpg or jpeg";
                }
            }
        }
    }

    //  redirect back to sign uppage if any problem occurs
    if(isset($_SESSION['signup'])){
        // pass form data back to sign up page
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'sign-up.php');
        die();
    }else{
        // insert data into database table
        $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name', 0)";
        $insert_user_query = mysqli_query($connection, $insert_user_query);
        
        if(!mysqli_errno($connection)){
            // redirect to login page with success message
            $_SESSION['signup-success'] = "Registration Successfull. Please log in";
            header('location: ' . ROOT_URL . 'login.php');
            die();
        }
    }

}else{
    // if button is not clicke, go to sign up page
    header('location: ' . ROOT_URL . 'sign-up.php');
    die();
}
?>