<?php require_once 'include/config.php'; ?>

<?php
session_start();
session_destroy();
header("Location: login.php");
?>
