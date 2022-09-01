<?php require_once('./includes/header.php'); ?>
<?php require_once('../config/session.php'); ?>

<?php 
    $selectQuery = "SELECT * FROM users WHERE user_id = '$session_id' ";
    $result = mysqli_query($conn, $selectQuery);
    $admin = mysqli_fetch_array($result);
?>

<?php
    $get_id = $_GET['view'];
    $split = explode('_', $get_id);
    // print_r($split);
    $lecturer = base64_decode($split[0]);
    
    // Getting data from appraisal table
    $selectQuery = "SELECT * FROM appraisal WHERE lecturer_appraised = '$lecturer' ";
    
    $result = mysqli_query($conn, $selectQuery);

    $appraisals = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $id = 1;
?>

<body>
    <?php require_once('./includes/nav.php'); ?>
    <main class="main">
        <div class="container">
            <div class="back_btn">
                <a href="index.php">
                    <i class="fa-solid fa-hand-point-left icon"></i>
                    Back
                </a>
            </div>
            
            <div class="head_">
                <h2>
                    <i class="fa-solid fa-user"></i>
                    <?php echo $lecturer; ?>
                </h2>
                <p>
                    <?php 
                        $selectQuery = "SELECT * FROM appraisal WHERE lecturer_appraised = '$lecturer'";
        
                        $result = mysqli_query($conn, $selectQuery);
                        echo mysqli_num_rows($result) 
                    ?>
                    Appraisal Submitted
                </p>
            </div>
            <?php
                $query = "SELECT * FROM appraisal";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) == 0){ ?>
                    <p class="empty_appraisal">No Appraisal Available For Now</p>
                <?php }
                else { ?>
                    <div class="appraised_container">
                        <div class="view_head">
                            <p>ID</p>
                            <p>Module</p>
                            <p>Result</p>
                        </div>

                        <div class="view_content">
                            <?php foreach($appraisals as $appraisal):?>
                                <div class="content">
                                    <p><?php echo $id++; ?></p>
                                    <p><?php echo $appraisal['module']; ?></p>
                                    <p><?php echo $appraisal['scores']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="total_score">
                            <div class="score">
                                <h2>Total Scores</h2>
                                <p class="rate">
                                    <?php 
                                        if(count($appraisals) > 1) {
                                            $total = 0;

                                            foreach($appraisals as $appraisal) {
                                                $total += $appraisal['scores'];
                                            }

                                            $score = round($total/2);
                                            echo $score;

                                            if($score >= 50) { ?>
                                                <span>Excellent</span>
                                            <?php }
                                            elseif($score >= 40) { ?>
                                                <span>Good</span>
                                            <?php }
                                            elseif($score >= 30) { ?>
                                                <span>Satisfactory</span>
                                            <?php }
                                            elseif($score >= 20) { ?>
                                                <span>Fair</span>
                                            <?php }
                                            else { ?>
                                                <span>Poor</span>
                                            <?php }
                                        
                                        }
                                        else {
                                            $score_ = $appraisal['scores'];
                                            echo $score_;
                                            if($score_ >= 50) { ?>
                                                <span>Excellent</span>
                                            <?php }
                                            elseif($score_ >= 40) { ?>
                                                <span>Good</span>
                                            <?php }
                                            elseif($score_ >= 30) { ?>
                                                <span>Satisfactory</span>
                                            <?php }
                                            elseif($score_ >= 20) { ?>
                                                <span>Fair</span>
                                            <?php }
                                            else { ?>
                                                <span>Poor</span>
                                            <?php }
                                        } 
                                    ?>
                                </p>
                                
                                
                            </div>
                        </div>
                    </div>
                <?php }
            ?>
            
        </div>
    </main>
<?php require_once('./includes/footer.php'); ?>