<?php
require 'server/register.php';
include 'partials/header.php';
?>
<h3>Create an account</h3>
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
<p>Already have an account?&nbsp;<a href="/login.php">Login</a></p>
<form method="POST" autocomplete="off">
    <div class="input-wrapper">
        <label for="username">Username: </label>
        <input type="text" name="username" />
    </div>
    <div class="input-wrapper">    
        <label for="email">Email: </label>
        <input type="email" name="email" />
    </div>
    <div class="input-wrapper">
        <label for="password">Password: </label>
        <input type="password" name="password" />
    </div>
    <div class="align-end">
        <button type="submit">Register</button>
    </div>
</form>
<?php include 'partials/footer.php'; ?>