<?php 
    session_start();
    if (isset($_SESSION['student'])){
        $student = $_SESSION['student'];
    }else{
        header('location: index.php');
    }