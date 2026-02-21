<?php
require 'server/login.php';
include 'partials/header.php';
?>
<h3>Login</h3>
<?php if (!empty($error['error'])): ?>
    <div class="error">
        <?= htmlspecialchars($error['message']) ?>
    </div>
<?php endif; ?>
<form method="POST" action="" autocomplete="off">
       <div class="input-wrapper">    
        <label for="email">Email: </label>
        <input type="email" name="email" required />
    </div>
    <div class="input-wrapper">
        <label for="password">Password:</label>
        <input type="password" name="password" required />
    </div>
    <div class="align-end">
        <button type="submit">Login</button>
    </div>
    <p>Don't have an account?&nbsp;<a href="/">Register</a></p>
</form>
<?php include 'partials/footer.php'; ?>