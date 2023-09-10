
<?php

include './includes/introheader.php';

// get back form data if there was an error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

// delee signuup data session
unset($_SESSION['signup-data']);

?>

    <!-- login -->
    <div class="log">
        <div class="log-container">
            <h2>Sign Up</h2>
            <div class="log-content">
                <form action="<?= ROOT_URL ?>signup-logic.php" method="POST" enctype="multipart/form-data">
                    <?php if(isset($_SESSION['signup'])): ?>
                        <h3>
                            <?= 
                                $_SESSION['signup'];
                                unset($_SESSION['signup'])
                            ?>
                        </h3>
                    <?php endif ?>    
                    <div class="form-content">
                        <input name="firstname" value="<?= $firstname ?>" type="text" placeholder="First Name">
                    </div>
                    <div class="form-content">
                        <input name="lastname" value="<?= $lastname ?>" type="text" placeholder="Last Name">
                    </div>
                    <div class="form-content">
                        <input name="username" value="<?= $username ?>" type="text" placeholder="Username">
                    </div>
                    <div class="form-content">
                        <input name="email" value="<?= $email ?>" type="email" placeholder="Enter your email">
                    </div>
                    <div class="form-content">
                        <input name="createpassword" value="<?= $createpassword ?>" type="password" placeholder="Password">
                    </div>
                    <div class="form-content">
                        <input name="confirmpassword" value="<?= $confirmpassword ?>" type="password" placeholder="Confirm Password">
                    </div>
                    <div class="form-content">
                        Profile Picture
                        <input name="avatar" type="file">
                    </div>
                    </div>
                    <div class="login-btns">
                                          
                        <div class="form-content">
                            <button name="submit" type="submit">Sign Up</button>
                        </div>    
                        <div class="form-content">
                            <span>Already have an accont? Login</span>
                            <a href="login.php" class="sign">
                                Login
                            </a>
                        </div>   
                    </div>              
                    
                </form>
            </div>
        </div>
    </div>

   

<?php

include './includes/introfooter.php';

?>