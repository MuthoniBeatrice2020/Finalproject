<?php

session_start();
unset($_SESSION['security']);
session_destroy();
$index_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
header('location: ' . $index_url);
