<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
    //load additional files
    require 'helpers.php'; //data sanitizer
    require '../model/config.php'; //db connection
    $msg = '';
    $Err = array();
 
    //Validating deviceID, not to be left blank
    if (!empty($_POST['deviceID'])){
        $deviceID = validateFormData($_POST['deviceID']);
        // echo $deviceID;
        
    }else{
        $deviceID = null;
        $msg = 'emptydeviceID';
        $Err[] = 'emptydeviceID';
    }

    //Validating comment, not to be left blank
    if (!empty($_POST['comment'])){
        $comment = validateFormData($_POST['comment']);
        //set status to stolen
        $status = '1';
        // echo $comment;
        
    }else{
        $comment = null;
        $msg = 'emptyComment';
        $Err[] = 'emptyComment';
    }

    // print_r($Err);
    //check if there is an existing user
    if (empty($Err)){

        try{
            $q= $conn->prepare("UPDATE devices SET Comment=:comment, Status=:status WHERE ID=:deviceID  LIMIT 1");
            $q->bindParam(":deviceID",$deviceID, PDO::PARAM_INT);
            $q->bindParam(":comment",$comment, PDO::PARAM_STR);
            $q->bindParam(":status",$status, PDO::PARAM_INT);
            
            $v = $q->execute();

            if ($v){
                $msg = 'success';
            }else{
                $msg = 'fail';
            }            
        }catch(PDOException $e){
            $rr = date('y/m/d h:i:s A').":. Server Error :. Device reporting Failed:  ".$e->getMessage()." ==> report_stolen.php\n";
            error_log($rr,3, 'error-log.php');
        }
            
    }
    echo $msg;
}
?>
