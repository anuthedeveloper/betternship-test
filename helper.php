<?php

function startSessionIfNotExist(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function isLoggedIn(): void {
    startSessionIfNotExist();
    if (empty($_SESSION['username']) && empty($_SESSION['email'])) {
        redirect('index.php');
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

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    // destroy session and redirect back entry point
    session_destroy();
    redirect('index.php');
}
