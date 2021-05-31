<?php
//setting default time zone
date_default_timezone_set("Africa/Nairobi");

//disabling development error reporting
// error_reporting(0);

// Set the database access information as constants:
define('host','localhost');
//define('user','admin');
define('DB_USER','admin');
define('DB_PASSWORD','TaLEEGXLACvWUmO4');

try{
  //create connection
  $conn = new PDO("mysql:host=localhost;dbname=esp", DB_USER, DB_PASSWORD);
  //set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connection Successful";


}catch (PDOException $e){
  $msg = 'Connection Failed: '.$e->getMessage();
  $rr = date('y/m/d h:i:s A')." :. Server Error :. ".$e->getMessage()." ==> config.php\n";
  error_log($rr, 3, "error_log.php");
  echo '</div></nav>
  <div class="flex container">
    <div class="text-danger text-center" style="font-size: 20px; padding-top: 20px;">'.$msg.'</div></div>';
    die();    
}
;?>
