<?php 
session_start();
unset($_SESSION['login_user']);
unset($_SESSION['username_user']);

setcookie("id", "", time() - 3600);
setcookie("key", "", time() - 3600);

header("Location: index.php");
exit;
