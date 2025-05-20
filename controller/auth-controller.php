<?php

class AuthController {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function login($username, $password) {
        $query = "SELECT user_id, username, user_first_name, user_last_name, user_email, password_hash, user_role
                  FROM user_tbl WHERE username = :username";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $user_id = $user['user_id'];

            $roleStmt = $this->con->prepare("SELECT user_role FROM user_tbl WHERE user_id = :user_id");
            $roleStmt->bindParam(':user_id', $user_id);
            $roleStmt->execute();
            $role = $roleStmt->fetch(PDO::FETCH_ASSOC);

            if ($role) {
                session_start();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $role['user_role'];

                $this->redirectByRole($role['user_role']);
                return;
            }
        } 
    }

    private function redirectByRole($role) {
        $role_pages = [
            'inventory_manager' => 'employee-dashboard.php',
            'warehouse_staff' => 'employee-dashboard.php',
            'customer_support' => 'employee-dashboard.php',
            'customer' => '../public/index.php'
        ];

        if (array_key_exists($role, $role_pages)) {
            header("Location: " . $role_pages[$role]);
        } else {
            header("Location: access-restricted.php");
        }
        exit();
    }
}
