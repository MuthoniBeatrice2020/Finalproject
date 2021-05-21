<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
    //load additional files
    require 'helpers.php'; //data sanitizer
    require '../model/config.php'; //db connection
    $msg = '';
    $Err = array();
 
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

   //Validating securityId, not to be left blank
    if (!empty($_POST['securityId'])){
        $securityId = validateFormData(strtoupper($_POST['securityId']));
        // echo $securityId;   
    }else{
        $securityId = null;
        $msg = 'emptysecurityId';
        $Err[] = 'emptysecurityId';
    }

    
    //check if there is an existing user
    if (empty($Err)){
        //update student details to the db
        try{
            $q= $conn->prepare("UPDATE security SET FirstName=:fname, LastName=:lname, IDNo=:idNo 
                                WHERE ID=:sid LIMIT 1");
            $q->bindParam(":fname",$firstName, PDO::PARAM_STR);
            $q->bindParam(":lname",$lastName, PDO::PARAM_STR);
            $q->bindParam(":idNo",$idNo, PDO::PARAM_INT);
            $q->bindParam(":sid",$securityId, PDO::PARAM_INT);      
            $v = $q->execute();

            if ($v){
                $msg = 'success';
            }else{
                $msg = 'fail';
            }            
        }catch(PDOException $e){
            $rr = date('y/m/d h:i:s A').":. Server Error :. Edit SEcurity Failed:  ".$e->getMessage()." ==> edit_security.php\n";
            error_log($rr,3, 'error-log.php');
        }
  
    }
    echo $msg;
}
?>