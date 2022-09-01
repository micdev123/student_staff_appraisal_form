<?php require_once('./includes/header.php'); ?>
<?php require_once('../config/session.php'); ?>

<?php 
    $selectQuery = "SELECT * FROM users WHERE user_id = '$session_id' ";
    $result = mysqli_query($conn, $selectQuery);
    $admin = mysqli_fetch_array($result);
?>

<?php
    $appraisals_per_page = 6;
    // Getting data from appraisal table
    $selectQuery = "SELECT * FROM appraisal";
    
    $result = mysqli_query($conn, $selectQuery);

    // number of appraisal
    $num_of_appraisals = mysqli_num_rows($result);
    // number of page 
    $num_of_pages = ceil($num_of_appraisals / $appraisals_per_page);
    // echo $num_of_pages;

    // determine current page
    if(!isset($_GET['page'])) {
        // set page to 1
        $page = 1;
    }
    else {
        // set page to the current page
        $page = $_GET['page'];
    }

    // determine output limit per page
    $start = ($page - 1) * $appraisals_per_page;

    // Getting specify data from appraisal table :: using the LIMIT
    $selectQuery = "SELECT * FROM appraisal LIMIT $start, $appraisals_per_page";
    
    $result = mysqli_query($conn, $selectQuery);

    $appraisals = mysqli_fetch_all($result, MYSQLI_ASSOC);

    

    $id = 1;
?>

<!-- delete appraisal -->
<?php
    if (isset($_GET['delete'])) {
        $get_id = $_GET['delete'];

        $delete = "DELETE FROM appraisal WHERE _id = '$get_id' ";
        
        // mysqli_query();
        if(mysqli_query($conn, $delete)) {
            header('Location: index.php');
        }
        else {
            echo "Error" . mysqli_error($conn);
        }
    }
?>

<body>
    <?php require_once('./includes/nav.php'); ?>
    <main class="main">
        <div class="container">
            <div class="head_">
                <h2>
                    <i class="fa-solid fa-table-columns icon"></i>
                    Dashboard
                </h2>
                <p>
                    <?php 
                        $selectQuery = "SELECT * FROM appraisal";
        
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
                        <div class="appraised_head">
                            <p>_ID</p>
                            <p>Lecturer</p>
                            <p>Module</p>
                            <p>General</p>
                            <p>Class Preparation</p>
                            <p>Delivery & Class Conduct</p>
                            <p>Support & Assistance</p>
                            <p>Feedback & Work Evaluation</p>
                            <p>Overall</p>
                            <p>Result</p>
                            <p>Action</p>
                        </div>

                        <div class="appraised_content">
                            <?php foreach($appraisals as $appraisal):?>
                                <div class="content">
                                    <p><?php echo $id++; ?></p>
                                    <p><?php echo $appraisal['lecturer_appraised']; ?></p>
                                    <p><?php echo $appraisal['module']; ?></p>
                                    <p><?php echo $appraisal['general_1'] + $appraisal['general_2']; ?>/10</p>
                                    <p><?php echo $appraisal['class_preparation_3'] + $appraisal['class_preparation_4']; ?>/10</p>
                                    <p><?php echo $appraisal['class_conduct_5'] + $appraisal['class_conduct_6'] + $appraisal['class_conduct_7'] + $appraisal['class_conduct_8']; ?>/20</p>
                                    <p><?php echo $appraisal['support_assistance_9'] + $appraisal['support_assistance_10']; ?>/10</p>
                                    <p><?php echo $appraisal['evaluation_11']; ?>/5</p>
                                    <p><?php echo $appraisal['overall_12']; ?>/5</p> 
                                    <p class="total"><?php echo $appraisal['scores']; ?>/60
                                        <span>
                                        <?php
                                            $total = $appraisal['scores'];
                                            if($total >= 50) { ?>
                                                <span>Excellent</span>
                                            <?php }
                                            elseif($total >= 40) { ?>
                                                <span>Good</span>
                                            <?php }
                                            elseif($total >= 30) { ?>
                                                <span>Satisfactory</span>
                                            <?php }
                                            elseif($total >= 20) { ?>
                                                <span>Fair</span>
                                            <?php }
                                            else { ?>
                                                <span>Poor</span>
                                            <?php }
                                        ?>
                                        </span>
                                    </p>
                                    <div class="action">
                                        <p>
                                            <a href="view.php?view=<?php echo base64_encode($appraisal['lecturer_appraised']); ?>_<?php echo $appraisal['_id']?>">
                                                <i class="fa-solid fa-eye icon"></i>
                                            </a>
                                        </p>
                                        <p>
                                            <a href="index.php?delete=<?php echo $appraisal['_id']?>">
                                                <i class="fa-solid fa-trash icon trash"></i>
                                            </a>
                                        </p>
                                    </div>
                                    
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- pagination -->
                        <div class="pagination">
                            <?php
                                if($page > 1) { ?>
                                    <p>
                                        <a href="index.php?page=<?php echo ($page - 1); ?>">
                                            Previous
                                        </a>
                                    </p>
                                <?php }
                                else { ?>
                                    <p>
                                        <a href="index.php?page=<?php echo $page; ?>">
                                            Previous
                                        </a>
                                    </p>
                                <?php }
                            ?>
                             
                            <?php for($page = 1; $page <= $num_of_pages; $page++): ?>
                                <p>
                                    <a href="index.php?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                </p>
                            <?php endfor; ?>

                            <?php if($page = $page) :?>
                                <p>
                                    <a href="index.php?page=<?php echo ($page - 1); ?>">
                                        Next
                                    </a>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php }
            ?>
            
        </div>
    </main>
<?php require_once('./includes/footer.php'); ?>