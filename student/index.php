<?php require_once('./includes/header.php'); ?>
<?php require_once('../config/session.php'); ?>

<?php 
    $selectQuery = "SELECT * FROM users WHERE user_id = '$session_id' ";
    $result = mysqli_query($conn, $selectQuery);
    $student = mysqli_fetch_array($result);
?>

<?php 
    $lecturer = $module = $general_1 = $general_2 = $class_preparation_3 = $class_preparation_4 = $class_conduct_5 = $class_conduct_6 = $class_conduct_7 = $class_conduct_8 = $support_assistance_9 = $support_assistance_10 = $evaluation_11 = $overall_12 = "";

    // Check if form is submit
    if(isset($_POST['submit'])) {
        // echo 'working';
        // Validating
        $lecturer = filter_input(INPUT_POST, 'lecturer', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $module = filter_input(INPUT_POST, 'module', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $general_1 = filter_input(INPUT_POST, 'general_1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $general_2 = filter_input(INPUT_POST, 'general_2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $class_preparation_3 = filter_input(INPUT_POST, 'class_preparation_3', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $class_preparation_4 = filter_input(INPUT_POST, 'class_preparation_4', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $class_conduct_5 = filter_input(INPUT_POST, 'class_conduct_5', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $class_conduct_6 = filter_input(INPUT_POST, 'class_conduct_6', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $class_conduct_7 = filter_input(INPUT_POST, 'class_conduct_7', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $class_conduct_8 = filter_input(INPUT_POST, 'class_conduct_8', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $support_assistance_9 = filter_input(INPUT_POST, 'support_assistance_9', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $support_assistance_10 = filter_input(INPUT_POST, 'support_assistance_10', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $evaluation_11 = filter_input(INPUT_POST, 'evaluation_11', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $overall_12 = filter_input(INPUT_POST, 'overall_12', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $score = $general_1 + $general_2 + $class_preparation_3 + $class_preparation_4 + $class_conduct_5 + $class_conduct_6 + $class_conduct_7 + $class_conduct_8 + $support_assistance_9 + $support_assistance_10 + $evaluation_11 + $overall_12;

        // query string
        $query = "SELECT * FROM appraisal WHERE module = '$module' && user_id = '$session_id' ";
        // Called the mysqli_query() method
        $result = mysqli_query($conn, $query);
        
        // check if user already exist
        if (mysqli_num_rows($result) > 0){
            $err = "Already Appraised";
        }
        else {
            // Add to users table in database
            $insert = "INSERT INTO appraisal (user_id, lecturer_appraised, module, general_1, general_2, class_preparation_3, class_preparation_4, class_conduct_5, class_conduct_6, class_conduct_7, class_conduct_8, support_assistance_9, support_assistance_10, evaluation_11, overall_12, scores) VALUES('$session_id', '$lecturer', '$module', '$general_1', '$general_2', '$class_preparation_3', '$class_preparation_4', '$class_conduct_5', '$class_conduct_6', '$class_conduct_7', '$class_conduct_8', '$support_assistance_9', '$support_assistance_10', '$evaluation_11', '$overall_12', '$score')";

            // mysqli_query($conn, $insert);
            if(mysqli_query($conn, $insert)) {
                header('Location: index.php');
            }
            else {
                echo "Error" . mysqli_error($conn);
            }
        }

    }
?>


<body>
    <?php require_once('./includes/nav.php'); ?>
    <main class="main">
        <div class="form_head">
            <img src="./assets/limkokwing_logo.png" alt="">
            <div class="form_content">
                <h3>FMG021 FACULTY MANAGEMANT</h3>
                <P>Student Appraisal Form</P>
                <p>This form will be collected and passed to program leader for verify</p>
            </div>
        </div>
        
        <div class="container">
            <div class="info_container">
                <h1>Questions | Instructions</h1>
                <div class="info_content">
                    <div class="head">
                        <h2>General</h2>
                    </div>
                    <div class="infos">
                        <div class="info">
                            <p>1. The Lecturer be in class on time</p>
                        </div>
                        <div class="info">
                            <p>2. The Lecturer treated the students with respect</p>
                        </div>
                    </div>
                </div>

                <div class="info_content">
                    <div class="head">
                        <h2>Class Preparation</h2>
                    </div>
                    <div class="infos">
                        <div class="info">
                            <p>3. The Lecturer was prepared and organised for each class session</p>
                        </div>
                        <div class="info">
                            <p>4. Criteria for grading and submission are clearly stated</p>
                        </div>
                    </div>
                </div>

                <div class="info_content">
                    <div class="head">
                        <h2>Delevery & Class Conduct</h2>
                    </div>
                    <div class="infos">
                        <div class="info">
                            <p>5. The assignment made the students think</p>
                        </div>
                        <div class="info">
                            <p>6. The Lecturer language proficiency is</p>
                        </div>
                        <div class="info">
                            <p>7. The Lecturer stimulates and encourage students participation and independent thought</p>
                        </div>
                        <div class="info">
                            <p>8. The Lecturer uses interactive & useful teaching aid</p>
                        </div>
                    </div>
                </div>

                <div class="info_content">
                    <div class="head">
                        <h2>Support & Assistance</h2>
                    </div>
                    <div class="infos">
                        <div class="info">
                            <p>9. The Lecturer was concerned with whether or not students learned/understand the material/topic</p>
                        </div>
                        <div class="info">
                            <p>10. The Lecturer was available outside of class, and during appointment hours</p>
                        </div>
                    </div>
                </div>

                <div class="info_content">
                    <div class="head">
                        <h2>Feedback & Work Evaluation</h2>
                    </div>
                    <div class="infos">
                        <div class="info">
                            <p>11. The Lecturer provided immediate & useful feedback regarding the student performance</p>
                        </div>
                    </div>
                </div>

                <div class="info_content">
                    <div class="head">
                        <h2>Overall</h2>
                    </div>
                    <div class="infos">
                        <div class="info">
                            <p>12. How would you grade your Lecturer</p>
                        </div>
                    </div>
                </div>
            </div>
            <form action=""  method="POST" class="form">
                <?php if(isset($err)): ?>
                    <p class="error"><?php echo $err; ?></p>
                <?php endif; ?>
                <div class="form_container">
                    <div class="form_group">
                        <label for="">Lecturer:</label>
                        <input type="text" name="lecturer" id="" placeholder="Enter lecturer name" required>
                    </div>
                    <div class="form_group">
                        <label for="">Module:</label>
                        <input type="text" name="module" id="" placeholder="Enter module" required>
                    </div>
                    <h3>Please answer all questions by selecting your choice from the corresponding choice box</h3>
                    <div class="tag">
                        <h4>General</h4>
                        <div>
                            <div class="form_group">
                                <select name="general_1" id="" required>
                                    <option value="">Choose Choice</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Good</option>
                                    <option value="3">3 - Satisfactory</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                            <div class="form_group">
                                <select name="general_2" id="" required>
                                    <option value="">Choose Choice</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Good</option>
                                    <option value="3">3 - Satisfactory</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="tag">
                        <h4>Class Preparation</h4>
                        <div>
                            <div class="form_group">
                                <select name="class_preparation_3" id="" required>
                                    <option value="">Choose Choice</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Good</option>
                                    <option value="3">3 - Satisfactory</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                            <div class="form_group">
                                <select name="class_preparation_4" id="" required>
                                    <option value="">Choose Choice</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Good</option>
                                    <option value="3">3 - Satisfactory</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="tag">
                        <h4>Delivery & Class Conduct</h4>
                        <div>
                            <div class="form_group">
                                <select name="class_conduct_5" id="" required>
                                    <option value="">Choose Choice</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Good</option>
                                    <option value="3">3 - Satisfactory</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                            <div class="form_group">
                                <select name="class_conduct_6" id="" required>
                                    <option value="">Choose Choice</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Good</option>
                                    <option value="3">3 - Satisfactory</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                            <div class="form_group">
                                <select name="class_conduct_7" id="" required>
                                    <option value="">Choose Choice</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Good</option>
                                    <option value="3">3 - Satisfactory</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                            <div class="form_group">
                                <select name="class_conduct_8" id="" required>
                                    <option value="">Choose Choice</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Good</option>
                                    <option value="3">3 - Satisfactory</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="tag">
                        <h4>Support & Assistance</h4>
                        <div>
                            <div class="form_group">
                                <select name="support_assistance_9" id="" required>
                                    <option value="">Choose Choice</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Good</option>
                                    <option value="3">3 - Satisfactory</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                            <div class="form_group">
                                <select name="support_assistance_10" id="" required>
                                    <option value="">Choose Choice</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Good</option>
                                    <option value="3">3 - Satisfactory</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="tag_">
                        <h4>Feedback & Work Evaluation</h4>
                        <div class="form_group">
                            <select name="evaluation_11" id="" required>
                                <option value="">Choose Choice</option>
                                <option value="5">5 - Excellent</option>
                                <option value="4">4 - Good</option>
                                <option value="3">3 - Satisfactory</option>
                                <option value="2">2 - Fair</option>
                                <option value="1">1 - Poor</option>
                            </select>
                        </div>
                    </div>

                    <div class="tag_">
                        <h4>Overall</h4>
                        <div class="form_group">
                            <select name="overall_12" id="" required>
                                <option value="">Choose Choice</option>
                                <option value="5">5 - Excellent</option>
                                <option value="4">4 - Good</option>
                                <option value="3">3 - Satisfactory</option>
                                <option value="2">2 - Fair</option>
                                <option value="1">1 - Poor</option>
                            </select>
                        </div>
                    </div>

                    <div class="form_group">
                        <button type="submit" name="submit" id="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
<?php require_once('./includes/footer.php'); ?>