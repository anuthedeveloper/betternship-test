<?php

// Mayowa from Betternship
// 1:58 PM
// You’re building a simple login system for a web dashboard.
// Please write PHP scripts to handle the following:
// Registration: Accepts username, email, and password; hashes the password using password_hash(); and saves users to a users.json file.
// Login: Verifies credentials and starts a session if successful.
// Dashboard: Displays “Welcome, [username]” only if the user is logged in; otherwise redirects to the login page.
// (Bonus) Add a logout script that ends the session and redirects back to the login page.
// Note: You can assume this will be tested locally (no database).
// The goal is clean, functional, and secure code that could work in a real-world PHP environment.
// Invitation to Technical Interview with Betternship
require 'server.php';
include 'partials/header.php';
?>
<body>
<style>
    .error {
        color: red;
    }
    .success {
        color: green;
    }
    .center {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 80vh;
    }
</style>

<div class="center">
    <?php if (!empty($error['error'])): ?>
        <div class="error">
            <?= htmlspecialchars($error['message']) ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($success['status'])): ?>
        <div class="success">
            <?= htmlspecialchars($success['message']) ?>
        </div>
    <?php endif; ?>

<form method="POST" autocomplete="off">
    <div>
        <label for="username">Username: </label>
        <input type="text" name="username" />
    </div>
    <div>    
        <label for="email">Email: </label>
        <input type="email" name="email" />
    </div>
    <div>
        <label for="password">Password: </label>
        <input type="password" name="password" />
    </div>
    <div>
        <button type="submit">Register</button>
    </div>
</form>
</div>

</body>
</html>