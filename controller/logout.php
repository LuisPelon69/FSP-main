<?php
// Archivo: controller/Logout.php
session_start();
session_destroy();
header("Location: ../index.php");
exit();
?>
