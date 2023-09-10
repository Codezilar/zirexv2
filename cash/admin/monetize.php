<?php
    include "../includes/header.php";   
    include "../includes/aside.php";   
    include "../includes/center.php";    
?>

                <div class="eligibility-status">
                    <div class="not-yet">
                        <h3>You're not yet eligible for monetization!</h3>
                        <br>
                        <p>
                            Hey <?php if(isset($_SESSION['user-id'])) : ?> <big><?= $avatar['username'] ?></big><?php endif ?>! 
                            listen up, we want to keep the content on our platform fresh, engaging and diverse. 
                            So, we're introducing a new policy that rewards users for uploading more posts and videos. 
                            The more engaging content you upload, the more eligible you are to unlock exclusive features, perk 
                            and even prizes. Think of it as virtual content creation Olympics. So come on, flex those creative
                            muscless and become a creator!
                        </p>
                    </div>
                </div>
                <div class="insights">
                    <div class="sales insight-container">
                        <span class="material-icons-sharp">analytics</span>
                        <div class="middle">
                            <div class="middle-left">
                                <h3>Total Income</h3>
                                <h1>$0</h1>
                            </div>
                            <div class="progress">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="number">
                                    <p>81%</p>
                                </div>
                            </div>
                           
                        </div>
                        <small class="text-muted">
                            Last 7 Days
                        </small>
                    </div>
                    <div class="expences insight-container">
                        <span class="material-icons-sharp">bar_chart</span>
                        <div class="middle">
                            <div class="middle-left">
                                <h3>Total Withdrawal</h3>
                                <h1>$0</h1>
                            </div>
                            <div class="progress">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="number">
                                    <p>81%</p>
                                </div>
                            </div>                            
                        </div>
                        <small class="text-muted">
                            Last 7 Days
                        </small>
                    </div>
                    <div class="income insight-container">
                        <span class="material-icons-sharp">stacked_line_chart</span>
                        <div class="middle">
                            <div class="middle-left">
                                <h3>Total Withdrawal</h3>
                                <h1>$0</h1>
                            </div>
                            <div class="progress">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="number">
                                    <p>55%</p>
                                </div>
                            </div>                            
                        </div>
                        <small class="text-muted">
                            Last 7 Days
                        </small>
                    </div>
                </div>

<?php
    include "../includes/footer.php";   
?>

