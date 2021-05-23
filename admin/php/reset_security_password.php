<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
    //load additional files
    require 'helpers.php'; //data sanitizer
    require '../model/config.php'; //db connection
    $msg = '';
    $Err = array();
    
    //Validating securityId, not to be left blank
    if (!empty($_POST['securityId'])){
        $securityId = validateFormData($_POST['securityId']);
        // echo $securityId;   
    }else{
        $securityId = null;
        $msg = 'emptySecurityId';
        $Err[] = 'emptySecurityId';
    }

    //Validating currentPass, not to be left blank
    if (!empty($_POST['currentPass'])){
        $currentPass = validateFormData($_POST['currentPass']);
        // echo $currentPass;
    }else{
        $currentPass = null;
        $msg = 'emptyCurrentPass';
        $Err[] = 'emptyCurrentPass';
    }

    //Validating newPass, not to be left blank
    if (!empty($_POST['newPass'])){
        $newPass = validateFormData($_POST['newPass']);
        // echo $newPass;
    }else{
        $newPass = null;
        $msg = 'emptyNewPass';
        $Err[] = 'emptyNewPass';
    }

    //Validating confirmPass, not to be left blank
    if (!empty($_POST['confirmPass'])){
        $confirmPass = validateFormData($_POST['confirmPass']);
        // echo $confirmPass;   
    }else{
        $confirmPass = null;
        $msg = 'emptyConfirmPass';
        $Err[] = 'emptyConfirmPass';
    }

    //compare password
    if ($newPass == $confirmPass){
        //Confirming current password
        try{
            $stm= $conn->prepare("SELECT * FROM security WHERE ID=:sid");
            $stm->bindParam(":sid",$securityID, PDO::PARAM_INT);
            $stm->execute();
            $userRow= $stm->fetch(PDO::FETCH_ASSOC);
    
            if ($stm->rowCount() > 0){
    
                if (password_verify($admin_password,$userRow['Password'])){
                    //assign new password
                    $pass = password_hash($newPass, PASSWORD_BCRYPT);
                }else{
                    //to be echoed
                    $msg = 'incorectPass';
                    $passwordErr='Incorrect Password';
                    $Err=array($passwordErr);
                }
    
            }else{
                //to be echoed
                $msg = 'incorectUser';
                $emailErr='User does not exist';
                $Err=array($emailErr);
            }
        }catch(PDOException $e){
            //catch the error and log it with a datetime stamp
            $rr = date('y/m/d h:i:s A').":. Server Error confirming current password :. ".$e->getMessage()." ==> index.php\n";
            error_log($rr,3, 'error_log.php');
        }
        
    }else{
        $passwordErr = 'Passwords Do not match';
        $pass = null;
        $Err = array($passwordErr);
    }
   
    //check if there is an existing user
    if (empty($Err)){
        //update student details to the db
        try{
            $q= $conn->prepare("UPDATE security SET Password=:pass WHERE ID=:sid LIMIT 1");
            $q->bindParam("sid",$securityId, PDO::PARAM_INT);
            $q->bindParam("pass",$pass, PDO::PARAM_STR);      
            $v = $q->execute();

            if ($v){
                $msg = 'success';
            }else{
                $msg = 'fail';
            }            
        }catch(PDOException $e){
            $rr = date('y/m/d h:i:s A').":. Server Error :. Security Password Change Failed:  ".$e->getMessage()." ==> reset_security_password.php\n";
            error_log($rr,3, 'error-log.php');
        }
  
    }
    echo $msg;
}
?>