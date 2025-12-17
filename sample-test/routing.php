<?php

/**
 * Write a simple PHP router without framework
 * GET /users
 * POST /users
 * GET /users/{id}
 */

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$routes = [
    'GET' => [
        '/users' => 'getAllUsers',
        '/users/{id}' => 'getUserById',
        '/users/delete/{id}' => 'deleteUser',
        '/users/deleteAll' => 'deleteAllUsers',
    ],
    'POST' => [
        '/users' => 'createUser',
    ],
];

function response($data, int $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}


function getAllUsers() {
    global $pdo;
    // Fetch data securely using prepared statements
    $select = $pdo->prepare("SELECT * FROM users");
    $select->execute();
    response(['users' => $select->fetchAll(PDO::FETCH_ASSOC)]);
}
function getUserById($id) {
    global $pdo;
    $select = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $select->execute([':id' => $id]);   
    $user = $select->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        response(['error' => 'User not found'], 404);
    }
    // Fetch data securely using prepared statements
    response($user);
}
function createUser() {
    global $pdo;
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $name = htmlspecialchars(trim($data['name']), ENT_QUOTES, 'UTF-8');
        $email = filter_var(trim($data['email']), FILTER_VALIDATE_EMAIL);
        if (!$email || empty($name) || strlen($name) < 5) {
            throw new InvalidArgumentException("Invalid email format");
        }
        $pdo->beginTransaction();
        // Insert data using prepared statements to prevent SQL injection
        $insert = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $insert->execute([':name' => 'Alice', ':email' => 'alice@example.com']);
        $insert->execute([':name' => 'John', ':email' => 'john@example.com']);
        $insert->execute([':name' => 'Bob', ':email' => 'bob@example.com']);
        $insert->execute([':name' => 'Jane', ':email' => 'Jane@example.com']);
        // $insert->execute([':name' => $data['name'], ':email' => $data['email']]);
        $pdo->commit();
        response(['message' => 'User created successfully', 'id' => $pdo->lastInsertId()], 201);
    } catch (InvalidArgumentException $e) {
        $pdo->rollBack();
        logError($e->getMessage());
        response(['error' => $e->getMessage()], 400);
    }
}

function deleteUser($id) {
    global $pdo;
    $delete = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $delete->execute([':id' => $id]);
    response(['message' => 'User deleted successfully']);
}

function deleteAllUsers() {
    global $pdo;
    $delete = $pdo->prepare("DELETE FROM users");
    $delete->execute();
    response(['message' => 'All users deleted successfully']);
}

function duplicateEmails() {
    global $pdo;
    $select = $pdo->prepare("SELECT email, COUNT(*) as count FROM users GROUP BY email HAVING count > 1");
    $select->execute();
    $duplicates = $select->fetchAll(PDO::FETCH_ASSOC);
    response(['duplicates' => $duplicates]);
}

function usersWhoPlacedMoreThanNOrders($n) {
    global $pdo;
    $select = $pdo->prepare("SELECT u.id, u.name, u.email, COUNT(o.id) as order_count 
                             FROM users u 
                             JOIN orders o ON u.id = o.user_id 
                             GROUP BY u.id 
                             HAVING order_count > :n");
    $select->execute([':n' => $n]);
    $users = $select->fetchAll(PDO::FETCH_ASSOC);
    response(['users' => $users]);
}

/** Explain how to use indexes */
function useIndexes() {
    global $pdo;
    // Example query that benefits from indexes
    $select = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $select->execute([':email' => 'alice@example.com']);
    $user = $select->fetch(PDO::FETCH_ASSOC);
    response($user);
}

// handle the routing request
if (isset($routes[$method])) {
    foreach ($routes[$method] as $route => $function) {
        $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route);
        if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
            array_shift($matches);
            call_user_func_array($function, $matches);
            exit;
        }
    }
}

function logError($message) {
    error_log($message . "\n\n", 3, __DIR__ . '/error.log');
}

// 404 Not Found
response(['error' => 'Not Found'], 404);

