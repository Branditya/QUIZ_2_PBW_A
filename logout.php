<?php
session_start();
session_unset();
session_destroy();
setcookie('User', '', time()-3600);
setcookie('Pass', '', time()-3600);
header("location: index.php");
exit;
?>