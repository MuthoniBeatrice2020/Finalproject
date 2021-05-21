<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
    //load additional files
    require 'helpers.php'; //data sanitizer
    require '../model/config.php'; //db connection
    $msg = '';
    $Err = array();
 
    //Validating regNo, not to be left blank
    if (!empty($_POST['regNo'])){
        $regNo = validateFormData(strtoupper($_POST['regNo']));
        // echo $regNo;
        
    }else{
        $regNo = null;
        $msg = 'emptyRegNo';
        $Err[] = 'emptyRegNo';
    }

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

    //Validating serialNo, not to be left blank
    if (!empty($_POST['serialNo'])){
        $serialNo = validateFormData(strtoupper($_POST['serialNo']));
        // echo $serialNo;
    }else{
        $serialNo = null;
        $msg = 'emptyserialNo';
        $Err[] = 'emptyserialNo';
    }

    //Validating model, not to be left blank
    if (!empty($_POST['model'])){
        $model = validateFormData(strtoupper($_POST['model']));
        // echo $model;
        
    }else{
        $model = null;
        $msg = 'emptymodel';
        $Err[] = 'emptymodel';
    }

    //validating if faculty is empty
    if (empty($_POST['faculty'])){
        $faculty = null;
        $msg = 'emptyfaculty';
        $Err[] = 'emptyfaculty';
    }else{
        $faculty = validateFormData(strtoupper($_POST['faculty']));
        // echo $faculty;
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
            $s= $conn->prepare("SELECT * FROM students WHERE RegNo=:regNo");
            $s->bindParam("regNo",$regNo, PDO::PARAM_STR);
            $s->execute();
            
            if ($s->rowCount() < 1){
                // echo "Yes";
                //add student details to the db
               try{
                    $q= $conn->prepare("INSERT INTO students (RegNo, FirstName, LastName, IDNo, Faculty, Password) VALUES (:reg, :fname, :lname, :idNo, :faculty, :pswd)");
                    $q->bindParam(":reg",$regNo, PDO::PARAM_STR);
                    $q->bindParam(":fname",$firstName, PDO::PARAM_STR);
                    $q->bindParam(":lname",$lastName, PDO::PARAM_STR);
                    $q->bindParam(":idNo",$idNo, PDO::PARAM_INT);
                    $q->bindParam(":faculty",$faculty, PDO::PARAM_STR);
                    $q->bindParam(":pswd",$password, PDO::PARAM_STR);
                    
                    $v = $q->execute();

                    if ($v){
                        $msg = 'student_success';
                        //add device details to the db
                        $status = '0';
                        try{
                            $stm= $conn->prepare("INSERT INTO devices (RegNo, SerialNo, Model, Status) VALUES (:regNo, :sNo, :model, :status)");
                            $stm->bindParam(":regNo",$regNo, PDO::PARAM_STR);
                            $stm->bindParam(":sNo",$serialNo, PDO::PARAM_STR);
                            $stm->bindParam(":model",$model, PDO::PARAM_STR);
                            $stm->bindParam(":status",$status, PDO::PARAM_INT);
                                                
                            $value = $stm->execute();

                            if($value){
                                $msg = 'success';  
                            }
                        }catch(PDOException $e){
                            $rr = date('y/m/d h:i:s A').":. Server Error :. Device registration Failed:  ".$e->getMessage()." ==> add_users.php\n";
                            error_log($rr,3, 'error-log.php');
                        }

                    }else{
                        $msg = 'fail';
                    }            
               }catch(PDOException $e){
                    $rr = date('y/m/d h:i:s A').":. Server Error :. Student registration Failed:  ".$e->getMessage()." ==> add_users.php\n";
                    error_log($rr,3, 'error-log.php');
               }
            }else{
                $msg = 'userExists';
                $userErr='User Already Exists';
                $user_email=$department=$password1=$password2='';
            }
        }catch(PDOException $e){
            $rr = date('y/m/d h:i:s A').":. Server Error => Adding users :. ".$e->getMessage()." ==> add_users.php\n";
            error_log($rr,3, 'error-log.php');
            $msg = 'serverErr';
        }
    }
    echo $msg;
}
?>
