<?php
session_start();
session_destroy();   // ❌ remove login
header("Location: login.php");
exit();
?>