<?php
session_start();
session_unset();
session_destroy();
session_reset();
setcookie("name", NULL, 0);
header("Location: login.php");
?>
