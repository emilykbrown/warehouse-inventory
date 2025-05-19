<?php
// $error = isset($_GET['login_error']) ? 'Invalid username or password.' : '';

include "../config/database.php";
include "../config/variables.php";
include "../controller/auth-controller.php";

 
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
                        <p style="color:red;"><?php echo $login_error; ?></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include "components/js-scripts.php"; ?>


</body>

</html>