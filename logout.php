<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('k', '', time() - 3600);
setcookie('x', '', time() - 3600);
header("location: login.php");
exit;
