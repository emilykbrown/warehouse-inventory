<?php
require_once 'config/db.php';

class AuthController {
    public function login($username, $password) {
        global $con;

        $query = "SELECT user_id, username, password FROM users WHERE username = :username";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $user_id = $user['user_id'];

            $roleStmt = $con->prepare("SELECT role_id FROM user_roles WHERE user_id = :user_id");
            $roleStmt->bindParam(':user_id', $user_id);
            $roleStmt->execute();
            $role = $roleStmt->fetch(PDO::FETCH_ASSOC);

            if ($role) {
                session_start();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $user['username'];
                $_SESSION['role_id'] = $role['role_id'];

                // Redirect based on role
                $this->redirectByRole($role['role_id']);
                return;
            }
        } else {

        }

        // Login failed
        header("Location: login.php?error=1");
        exit();
    }

    public function logout() {
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header("Location: index.php");
        exit;
    }

    private function redirectByRole($role_id) {
        $role_pages = [
            "employee"=> "employee-dashboard.php",
        ];

        if (array_key_exists($role_id, $role_pages)) {
            header("Location: " . $role_pages[$role_id]);
        } else {
            header("Location: access-restricted.php");
        }
        exit();
    }
}
