<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo_tab.png" type="x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management | Login</title>
    <link rel="stylesheet" href="../assets/css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <div></div>
    <div class="container">
        <h1 class="form-title">Login Form</h1>
        <form id="form" class="form" method="POST">
            <div class="main-user-info">
                <div class="user-input-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter email" autocomplete="email">
                    <small>Error Message</small>
                </div>
                <div class="user-input-box">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="Enter password"
                            autocomplete="new-password">
                        <i class="fas fa-eye password-toggle"></i>
                    </div>
                    <small>Error Message</small>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const passwordInput = document.getElementById('password');
                        const passwordToggle = document.querySelector('.password-toggle');

                        passwordToggle.addEventListener('click', function () {
                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                passwordToggle.classList.remove('fa-eye');
                                passwordToggle.classList.add('fa-eye-slash');
                            } else {
                                passwordInput.type = 'password';
                                passwordToggle.classList.remove('fa-eye-slash');
                                passwordToggle.classList.add('fa-eye');
                            }
                        });
                    });
                </script>
            </div>
            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" id="remember" name="remember"> Remember me
                </label>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            <div class="form-submit-btn">
                <input type="submit" value="Login">
            </div>
        </form>
        <div class="signup-redirect">
            <p>Don't have an account? <a href="registration.php">Sign up</a></p>
        </div>
    </div>
</body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo $conn->connect_error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
}

$sql = "SELECT * FROM user_tbl WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    if (password_verify($hashed_password, $password)) {
        echo '<script>alert("Login Successfully");</script>';
        echo '<script>window.location.href="#";</script>';
    } else {
        echo '<script>alert("Invalid Email or Password");</script>';
        echo '<script>window.location.href="index.php";</script>';
    }
} else {
    echo "error";
}

$conn->close();
?>

</html>