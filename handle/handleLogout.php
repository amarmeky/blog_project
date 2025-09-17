<?php
require_once '../inc/conn.php';
unset($_SESSION['user_id']);
header('Location: ../login.php');
exit();
?>