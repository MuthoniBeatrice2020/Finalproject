<?php
    require 'links.php';
    //db connection
    require_once 'model/config.php';

    session_start();
    if (isset($_SESSION['student'])){
        $student = $_SESSION['student'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JESP [Students]</title>
    <link rel="stylesheet" href="<?php echo $fontawesome_css;?>">
    <link rel="stylesheet" href="<?php echo $bootstrap_css;?>">
    <link rel="stylesheet" href="<?php echo $datatables_css;?>">
    <link rel="stylesheet" href="<?php echo $chartjs_css;?>">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-sm navbar-dark" id="green-bg">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">JKUAT Electronic Security Portal</span>
        <?php 
        if(isset($student)){
            echo '
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="log_out.php">
                        <i class="fas fa-sign-out-alt"></i>
                        Log Out
                    </a>
                </li>
            </ul>';
        }?>
    </div>
</nav>
