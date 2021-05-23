<?php
//page header load
include 'layout/header.php';
//session redirect

if (isset($_SESSION['security'])){
    header('location: home.php');
}
//form submission management
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //loading additional files
    //input sanitizer
    require_once 'php/helpers.php';
    
    $username= $admin_password='';
    $Err= array();

    //Validating username, not to be left blank
    if (!empty($_POST['username'])){
        $username = strtolower($_POST['username']);
        
    }else{
        $username = null;
        $requiredUsername = 'Username is required';
        $Err=array($requiredUsername);
    }

    //validating if password is empty
    if (!empty($_POST['password'])){
        $admin_password= validateFormData($_POST['password']);
        
    }else{
        $admin_password=null;
        $requiredPassword='Password is required';
        $Err=array($requiredPassword);
    }

    if (!empty($username && $admin_password)){
        try{
            $stm= $conn->prepare("SELECT * FROM security WHERE IDNo=:u");
            $stm->bindParam(":u",$username, PDO::PARAM_INT);
            $stm->execute();
            $userRow= $stm->fetch(PDO::FETCH_ASSOC);
    
            if ($stm->rowCount() > 0){
    
                if (password_verify($admin_password,$userRow['Password'])){
                    session_start();
                    $_SESSION['security']=$username;
                    header('location: home.php');
                }else{
                    $passwordErr='Incorrect Password';
                    $Err=array($passwordErr);
                }
    
            }else{
                $emailErr='Admin does not exist';
                $Err=array($emailErr);
            }
        }catch(PDOException $e){
            //catch the error and log it with a datetime stamp
            $rr = date('y/m/d h:i:s A').":. Server Error loggin in :. ".$e->getMessage()." ==> index.php\n";
            error_log($rr,3, 'error_log.php');
        }
        
    }

}
?>
<br>
<div class="container">    
    <div class="card w-50 mx-auto">
        <div id="login_group" class="container mt-3 mb-3">
            <h4 id="login_header">SECURITY</h4>
            <br>
            <form id="loginForm" method="post" action="" autocomplete="off">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" id="username" value="<?php if(!empty($username)){echo $username;}?>"
                    placeholder="<?php if(!empty($username)){echo $username;}else{echo 'Username';}?>">
                    <small class="form-text text-muted">Enter your ID Number</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                    <?php if (!empty($requiredUsername)){
                        echo '<small class="form-text text-danger font-italic font-weight-bold">'.$requiredUsername.'</small>';
                    }
                    if (!empty($emailErr)){
                        echo '<small class="form-text text-danger font-italic font-weight-bold">'.$emailErr.'</small>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" >
                    <small class="form-text text-muted">Enter your Password</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                    <?php 
                        if (!empty($requiredPassword)){
                            echo '<small class="form-text text-danger font-italic font-weight-bold">'.$requiredPassword.'</small>';
                        }
                        if (!empty($passwordErr)){
                            echo '<small class="form-text text-danger font-italic font-weight-bold">'.$passwordErr.'</small>';
                        }
                    ?>
                </div>
                <div class="form-group">
                    <!-- <small class="form-text text-muted">Forgot Your Password?
                        <a href="reset_password.php">Reset Password</a>
                    </small> -->
                </div>
                <button class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    Log In
                </button>
            </form>
        </div>
    </div>  
</div>
<div class="position-relative"> 
    <hr>
    <div class="container">
        <!-- <span class="float-right mb-1">&copy; copyright 2021 | Designed by Tris</span> -->
    </div>
</div>
<script src="<?php echo $jquery_js;?>"></script>
<script src="<?php echo $jqueryValidate_js;?>"></script>
<script src="<?php echo $index_js;?>"></script>