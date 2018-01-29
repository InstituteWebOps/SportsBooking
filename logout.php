<?php
session_start();
session_unset($_SESSION['rollno']);
header('location: index.php');
?>