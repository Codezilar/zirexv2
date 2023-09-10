<?php

include './includes/introheader.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);

?>
    <!-- login -->
    <div class="log lopper">
        <div class="log-container">
            <h2>Login</h2>
            <div class="log-content">
                <form action="login-logic.php" method="POST">
                    <?php if(isset($_SESSION['signup-success'])): ?>
                        <h3 class="success">
                            <?= 
                                $_SESSION['signup-success'];
                                unset($_SESSION['signup-success']);
                            ?>
                        </h3>
                    <?php elseif(isset($_SESSION['signin'])) : ?>    
                        <h3>
                            <?= 
                                $_SESSION['signin'];
                                unset($_SESSION['signin'])
                            ?>
                        </h3>
                    <?php endif ?>    
                    <div class="form-content">
                        <input type="text" value="<?= $username_email ?>" name="username_email" placeholder="Enter your username or email">
                    </div>
                    <div class="form-content">
                        <input type="password" value="<?= $password ?>" name="password" placeholder="Password">
                    </div>
                    </div>
                    <div class="login-btns">
                        <div class="form-content">
                            <button type="submit" name="submit">Login</button>
                        </div>                    
                        <div class="form-content">
                            <span>Don't have an accont? Sign Up</span>
                            <a href="sign-up.php" class="sign">
                                Sign Up
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