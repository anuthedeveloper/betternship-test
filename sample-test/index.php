<?php

/**
 * PDO to evaluate SQL injection prevention
 * OOP to demonstrate class and interface usage
 * Data Structures to show array manipulations
 * Routing to implement a simple PHP router without a framework
 */
$filePath = __DIR__ . '/db.sqlite';
try {
    $pdo = new PDO('sqlite:' . $filePath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create a sample table and insert data securely
    $query = "CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, name TEXT, email TEXT)";
    $pdo->exec($query);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
    
/**
 * Main entry point to include various PHP code snippets
 */

// // Include OOP related code
// include 'oop.php';
// // Include Data Structure related code
// include 'data-structure.php';
// // Include Routing related code
include 'routing.php';

echo "\n\nAll included files executed successfully.\n";

