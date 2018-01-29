<?php
session_start();
if(isset($_SESSION['admin'])) require('panel.php');
else require('loginadmin.php');
?>