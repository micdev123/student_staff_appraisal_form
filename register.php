<?php include('config/database.php'); ?>
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
            $insert = "INSERT INTO users (username, email, password, role) VALUES('$username', '$email', '$password', 'student')";

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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff-Appraisal</title>
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header class="header">
        <nav class="nav">
            <div class="logo">
                <h1>Staff-Appraisal</h1>
            </div>
        </nav>
    </header>
    <main class="main">
        <div class="register_container">
            <div class="head">
                <!-- <h1>E-Classroom</h1> -->
                <i class="fa-solid fa-hands-clapping icon"></i>
                <h2>Limkokwing University Staff Appraisal Form</h2>
                <p>Create an account</p>
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
                <button type="submit" name="signUp" class="register_btn">Register</button>
                </div>
                <p>Already have an account? <a href="index.php">SignIn</a></p>
            </form>
        </div>
    </main>
    <footer class="footer">
        <p>Copyright &copy; Mic__Dev :: Limkokwing University SL</p>
    </footer>

    <!-- script -->
    <script src="script.js"></script>
</body>
</html>