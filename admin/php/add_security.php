<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
    //load additional files
    require 'helpers.php'; //data sanitizer
    require '../model/config.php'; //db connection
    $msg = '';
    $Err = array();
    $idNo = $firstName = $lastName = $password = '';
    //Validating idNo, not to be left blank
    if (!empty($_POST['idNo'])){
        $idNo = validateFormData($_POST['idNo']);
        // echo $idNo;
        
    }else{
        $idNo = null;
        $msg = 'emptyidNo';
        $Err[] = 'emptyidNo';
    }

    //Validating firstName, not to be left blank
    if (!empty($_POST['firstName'])){
        $firstName = validateFormData(strtoupper($_POST['firstName']));
        // echo $firstName;
        
    }else{
        $firstName = null;
        $msg = 'emptyfirstName';
        $Err[] = 'emptyfirstName';
    }

    //Validating lastName, not to be left blank
    if (!empty($_POST['lastName'])){
        $lastName = validateFormData(strtoupper($_POST['lastName']));
        // echo $lastName;
        
    }else{
        $lastName = null;
        $msg = 'emptylastName';
        $Err[] = 'emptylastName';
    }

    //validating if password is empty
    if (empty($_POST['password1'])){
        $password1 = null;
        $msg = 'emptyPass';
        $Err[] = 'emptyPass';
    }else{
        $password1 = $_POST['password1'];
        // echo $password1;
    }

    //validating if password is empty
    if (empty($_POST['password2'])){
        $password2 = null;
        $msg = 'confirmPass';
        $Err[] = 'confirmPass';
    }else{
        $password2 = $_POST['password2'];
        // echo $password2;
    }

    //compare passwords
    if ($password1 == $password2){
        $password = password_hash($password1, PASSWORD_DEFAULT);
        // echo $password;
    }else{
        $password = null;
        $msg = 'misPass';
        $Err[] = 'misPass';
    }
    // print_r($Err);
    //check if there is an existing user
    if (empty($Err)){
        try{
            $s= $conn->prepare("SELECT * FROM security WHERE IDNo=:idNo");
            $s->bindParam("idNo",$idNo, PDO::PARAM_STR);
            $s->execute();
            
            if ($s->rowCount() < 1){
                // echo "Yes";
                //add student details to the db
               try{
                    $q= $conn->prepare("INSERT INTO security (IDNO, FirstName, LastName, Password) VALUES (:idNo, :fname, :lname, :pswd)");
                    $q->bindParam(":idNo",$idNo, PDO::PARAM_INT);
                    $q->bindParam(":fname",$firstName, PDO::PARAM_STR);
                    $q->bindParam(":lname",$lastName, PDO::PARAM_STR);
                    $q->bindParam(":pswd",$password, PDO::PARAM_STR);
                    
                    $v = $q->execute();

                    if ($v){
                        $msg = 'success';
                        $idNo = $firstName = $lastName = $password = '';
                        
                    }else{
                        $msg = 'fail';
                    }            
               }catch(PDOException $e){
                    $rr = date('y/m/d h:i:s A').":. Server Error :. Security guard registration Failed:  ".$e->getMessage()." ==> add_security.php\n";
                    error_log($rr,3, 'error-log.php');
               }
            }else{
                $msg = 'userExists';
                $userErr='User Already Exists';
                $idNo = $firstName = $lastName = $password = '';
            }
        }catch(PDOException $e){
            $rr = date('y/m/d h:i:s A').":. Server Error => Adding security guards :. ".$e->getMessage()." ==> add_security.php\n";
            error_log($rr,3, 'error-log.php');
            $msg = 'serverErr';
        }
    }
    echo $msg;
}
?>
