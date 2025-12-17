<?php
require 'helper.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $username = isset($_POST['username']) ? sanitize_input($_POST['username']) : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    try {
        if (!$username || !$email || !$password) {
            throw new Exception("All fields are required!");
        }

        if(!sanitize_email($email)) {
            throw new Exception("Invalid email format");
        }

        if (strlen($password) < 8) {
            throw new Exception("Password must be greater than 8 characters");
        }
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $data = json_encode(['username' => $username, 'email' => $email, 'password' => $hashedPassword]);
        if (!file_put_contents('users.json', $data)) {
            throw new Exception("Failed to save user data");
        }
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        // $success = ['status' => true, 'message' => 'You\'ve, successfully registered'];
        redirect('dashboard.php');
    } catch (\Exception $e) {
        $error = ["error" => true, "message" => $e->getMessage()];
    }
}
