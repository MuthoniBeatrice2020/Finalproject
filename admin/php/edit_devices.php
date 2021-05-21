<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
    //load additional files
    require 'helpers.php'; //data sanitizer
    require '../model/config.php'; //db connection
    $msg = '';
    $Err = array();
 
    //Validating serialNo, not to be left blank
    if (!empty($_POST['serialNo'])){
        $serialNo = validateFormData($_POST['serialNo']);
        // echo $serialNo;
    }else{
        $serialNo = null;
        $msg = 'emptySerialNo';
        $Err[] = 'emptySerialNo';
    }

    //Validating model, not to be left blank
    if (!empty($_POST['model'])){
        $model = validateFormData(strtoupper($_POST['model']));
        // echo $model;
    }else{
        $model = null;
        $msg = 'emptyModel';
        $Err[] = 'emptyModel';
    }

    //Validating status, not to be left blank
    if (!empty($_POST['status'])){
        $status_init = strtolower(validateFormData($_POST['status']));
        if($status_init == 'active'){
            $status = '0';
            // echo $status;
        }elseif($status_init == 'stolen'){
            $status = '1';
            // echo $status;
        }  
    }else{
        $status = null;
        $msg = 'emptyStatus';
        $Err[] = 'emptyStatus';
    }

    //Validating deviceID, not to be left blank
    if (!empty($_POST['deviceID'])){
        $deviceID = validateFormData($_POST['deviceID']);
        // echo $deviceID;   
    }else{
        $deviceID = null;
        $msg = 'emptyDeviceID';
        $Err[] = 'emptyDeviceID';
    }
   
    //check if there is an existing user
    if (empty($Err)){
        //update student details to the db
        try{
            $q= $conn->prepare("UPDATE devices SET SerialNo=:serialNo, Model=:model, Status=:status 
                                WHERE ID=:did LIMIT 1");
            $q->bindParam(":serialNo",$serialNo, PDO::PARAM_STR);
            $q->bindParam(":model",$model, PDO::PARAM_STR);
            $q->bindParam(":status",$status, PDO::PARAM_INT);
            $q->bindParam(":did",$deviceID, PDO::PARAM_INT);      
            $v = $q->execute();

            if ($v){
                $msg = 'success';
            }else{
                $msg = 'fail';
            }            
        }catch(PDOException $e){
            $rr = date('y/m/d h:i:s A').":. Server Error :. Device Update Failed:  ".$e->getMessage()." ==> edit_devices.php\n";
            error_log($rr,3, 'error-log.php');
        }
  
    }
    echo $msg;
}
?>