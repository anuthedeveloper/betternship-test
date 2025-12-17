<?php 
require 'helper.php';
include 'partials/header.php';
startSessionIfNotExist();
isLoggedIn();
?>
<body>

<h2>User Dashboard</h2>
<div><hr></div>
<div>Welcome: <?= $_SESSION['username']?></div>
<div>Your Email: <?= $_SESSION['email']?></div>
<div><a href="<?= logoutUser() ?>">Logout</a></div>
<div><hr></div>
</body>
</html>