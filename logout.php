<!-- logout.php - Logout -->
<?php
session_start();
session_unset();
session_destroy();
setcookie("username", "", time() - 3600); // Expire cookie
header("Location: login.php");
?>

