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

    //validating if faculty is empty
    if (empty($_POST['faculty'])){
        $faculty = null;
        $msg = 'emptyfaculty';
        $Err[] = 'emptyfaculty';
    }else{
        $faculty = validateFormData(strtoupper($_POST['faculty']));
        // echo $faculty;
    }

    //Validating studentID, not to be left blank
    if (!empty($_POST['studentId'])){
        $studentId = validateFormData(strtoupper($_POST['studentId']));
        // echo $studentId;   
    }else{
        $studentId = null;
        $msg = 'emptyStudentId';
        $Err[] = 'emptyStudentId';
    }

    
    //check if there is an existing user
    if (empty($Err)){
        //update student details to the db
        try{
            $stm= $conn->prepare("UPDATE staff SET WorkEmail=:we, DepartmentName=:dp WHERE StaffID=:sid LIMIT 1");
            $q= $conn->prepare("UPDATE students SET RegNo=:reg, FirstName=:fname, LastName=:lname, IDNo=:idNo, Faculty=:faculty
                                WHERE ID=:sid LIMIT 1");
            $q->bindParam(":reg",$regNo, PDO::PARAM_STR);
            $q->bindParam(":fname",$firstName, PDO::PARAM_STR);
            $q->bindParam(":lname",$lastName, PDO::PARAM_STR);
            $q->bindParam(":idNo",$idNo, PDO::PARAM_INT);
            $q->bindParam(":faculty",$faculty, PDO::PARAM_STR);
            $q->bindParam(":sid",$studentId, PDO::PARAM_INT);
                        
            $v = $q->execute();

            if ($v){
                $msg = 'success';
            }else{
                $msg = 'fail';
            }            
        }catch(PDOException $e){
            $rr = date('y/m/d h:i:s A').":. Server Error :. Student update Failed:  ".$e->getMessage()." ==> edit_students.php\n";
            error_log($rr,3, 'error-log.php');
        }
            
        
    }
    echo $msg;
}
?>