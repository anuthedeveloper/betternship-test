<?php
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