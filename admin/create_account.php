<?php require_once('./includes/header.php'); ?>
<?php require_once('../config/session.php'); ?>

<?php 
    $selectQuery = "SELECT * FROM users WHERE user_id = '$session_id' ";
    $result = mysqli_query($conn, $selectQuery);
    $admin = mysqli_fetch_array($result);
?>

<?php
    $username = $email = $password = '';
    if(isset($_POST['signUp'])){
        $username = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // query string
        $query = "SELECT * FROM users WHERE email = '$email' ";
        // Called the mysqli_query() method
        $result = mysqli_query($conn, $query);
        
        // check if user already exist
        if (mysqli_num_rows($result) > 0){
            $err = "User Already Exist";
        }
        else {
            // Add to users table in database
            $insert = "INSERT INTO users (username, email, password, role) VALUES('$username', '$email', '$password', 'admin')";

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
        <div class="register_container">
            <div class="head">
                <p>Create new admin</p>
            </div>
            <form action="" method="POST" class="form">
                <?php if(isset($err)): ?>
                    <p class="error"><?php echo $err; ?></p>
                <?php endif; ?>
                <div class="form_group">
                    <label for="name">Username</label>
                    <input type="text" name="name" id="name" placeholder="Enter your username" required>
                </div>
                <div class="form_group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form_group pass">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <i class="fas fa-eye  fa-eye-slash icon toggle"></i>
                </div>
                <div class="form_group">
                <button type="submit" name="signUp" class="register_btn">Create Account</button>
                </div>
            </form>
        </div>
    </main>
<?php require_once('./includes/footer.php'); ?>