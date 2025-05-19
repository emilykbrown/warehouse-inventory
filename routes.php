<?php
require_once 'config/database.php';
require_once 'controller/auth-controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_btn'])) {
   $auth = new AuthController($con);
   $auth->login($_POST['username'], $_POST['password']);
}
?>
