<?php

function startSessionIfNotExist(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function isLoggedIn(): void {
    startSessionIfNotExist();
    if (empty($_SESSION['username']) && empty($_SESSION['email'])) {
        redirect('login.php');
    }
}

function redirect(string $file): void {
    header("Location: $file");
    exit;
}

function sanitize_input(string $str): string {
    return htmlspecialchars(
        trim(strip_tags($str)),
        ENT_QUOTES,
        'UTF-8'
    );
}

function sanitize_email(string $email): ?string {
    $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    return $email ?: null;
}

function logoutUser(): void {
    startSessionIfNotExist();
    $_SESSION = [];
    // destroy session and redirect back entry point
    session_destroy();
    redirect('login.php');
}
