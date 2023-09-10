<div class="aside">
                <div class="aside-container">
                    <!-- aside anv -->
                    <div class="aside-nav">
                        <div class="aside-nav-container">
                            <div class="notify">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="details">   
                                <?php if(isset($_SESSION['user-id'])) : ?>
                                    <div class="detail-text">
                                        <h1><?= $avatar['username'] ?></h1>
                                        <p>Active</p>
                                    </div>
                                    <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>" alt="">
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <!-- status -->
                    <div class="status-container">
                        <div class="status">
                            <h5>
                                ZIREX
                            </h5>
                            <div class="status-details">
                                <p>Become Empowered</p>
                                <img src="blue.png" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- nav item -->
                    <div class="mobiles-nav-item">
                        <a href="">Home</a>
                        <?php
                            $all_categories = "SELECT * FROM categories ORDER BY title";
                            $all_categories_result = mysqli_query($connection, $all_categories);
                        ?>
                        <?php while($category = mysqli_fetch_assoc($all_categories_result)) : ?>
                        <a href="<?= ROOT_URL ?>admin/category-videos.php?id=<?= $category['id'] ?>"><?= $category['title'] ?></a>
                        <?php endwhile ?>
                    </div>
                    <!-- check -->
                    <a href="./interface.php">
                        <div class="check">
                            <div class="chexk-container">
                                <div class="check-content">
                                    <div class="check-items">
                                        <h6>
                                            Developer Tools
                                        </h6>
                                        <p>
                                            Add a photo, one-liner, and a little bit about you. See
                                            some beautiful examples here, here, and here
                                        </p>
                                        <a href="./interface.php">
                                            <button class="check-btn">
                                                Manage
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- goal -->                    
                    <a href="./monetize.php">
                        <div class="check">
                            <div class="chexk-container">
                                <div class="check-content">
                                    <div class="check-items">
                                        <h6>
                                            Monetization
                                        </h6>
                                        <p>
                                            Our monetization model  is based on the principles
                                            of transparency and user-center design. 
                                        </p>
                                        
                                        <a href="./monetize.php">
                                            <button class="check-btn">
                                                Get Started
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a class="log-out-btn" href="<?= ROOT_URL ?>logout.php">Log out</a>

                    
                </div>
            </div>