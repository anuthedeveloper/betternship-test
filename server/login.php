<?php
require 'helper.php';
startSessionIfNotExist();
$error = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $email    = isset($_POST['email']) ? sanitize_email($_POST['email']) : null;
        $password = $_POST['password'] ?? '';
        if (!$email || !$password) {
            throw new Exception("Email and password are required");
        }
        $file = 'data/users.json';
        if (!file_exists($file)) {
            throw new Exception("Invalid login credentials");
        }
        $users = json_decode(file_get_contents($file), true);
        if (!is_array($users)) {
            throw new Exception("Invalid login credentials");
        }
        $authenticatedUser = null;
        foreach ($users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                $authenticatedUser = $user;
                break;
            }
        }
        if (!$authenticatedUser) {
            throw new Exception("Invalid email or password");
        }
        $_SESSION['username'] = $authenticatedUser['username'];
        $_SESSION['email']    = $authenticatedUser['email'];
        redirect('dashboard.php');
    } catch (Exception $e) {
        $error = ["error" => true, "message" => $e->getMessage()];
    }
}