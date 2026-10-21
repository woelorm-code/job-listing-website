<?php
session_start();
$_SESSION['logged_in'] = false;
$_SESSION['user'] = null;
SESSION_destroy();
header('Location: login.php');
exit;
