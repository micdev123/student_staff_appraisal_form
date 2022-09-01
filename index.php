<?php
    session_start();
    include('config/database.php');
    if(isset($_POST['signIn'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $sql ="SELECT * FROM users where email ='$email' AND password = '$password' ";
        $query= mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);
        if($count > 0)
        {
            while ($user = mysqli_fetch_assoc($query)) {
                if ($user['role'] == 'admin') {
                    $_SESSION['alogin'] = $user['user_id'];
                    echo "<script type='text/javascript'> document.location = 'admin/index.php'; </script>";
                }
                elseif ($user['role'] == 'student') {
                    $_SESSION['alogin'] = $user['user_id'];
                    echo "<script type='text/javascript'> document.location = 'student/index.php'; </script>";
                }
            }

        } 
        else{
        
            $message = 'Invalid Details';

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
        <div class="login_container">
            <div class="head">
                <!-- <h1>E-Classroom</h1> -->
                <i class="fa-solid fa-hands-clapping icon"></i>
                <h2>Limkokwing University Staff Appraisal Form</h2>
                <p>Login to your account</p>
            </div>
            <form action="" method="POST" class="form">
                <?php if(isset($message)): ?>
                    <p class="error"><?php echo $message; ?></p>
                <?php endif; ?>

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
                <button type="submit" name="signIn" class="login_btn">Login</button>
                </div>
                <p>Don't have an account? <a href="register.php">SignUp</a></p>
            </form>
        </div>
    </main>
    <footer class="footer">
        <p>Copyright &copy; Mic__Dev :: Limkokwing University SL</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
