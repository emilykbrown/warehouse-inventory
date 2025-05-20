<?php


require_once '../config/database.php';
require_once '../config/variables.php';
require_once '../controller/auth-controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_btn'])) {
    
    $auth = new AuthController($con);
    $auth->login($_POST['username'], $_POST['password']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $login_error = "Please enter both username and password.";
    } else {
        $auth = new AuthController($con);
        if (!$auth->login($username, $password)) {
            $login_error = "Invalid username or password.";
        }
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "components/css-links.php"; ?>
</head>

<body class="card-bg">
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="d-flex justify-content-center align-items-center bg-light">
            <div class="card p-3 shadow">
                <form action="" method="POST">
                    <div class="mb-3 mt-3">
                        <label for="text" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username"
                            name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-dark" name="login_btn">Login</button>
                        <p class="error" style="color:red;"><?php echo $login_error; ?></p>
                    </div>
                
            </div>
        </div>
    </div>

    <?php include "components/js-scripts.php"; ?>


</body>

</html>