<?php
  include 'config.php';

  $password='Password123';
  $hashed_password=password_hash($password, PASSWORD_BCRYPT);

  $sql="UPDATE admin SET Password='$hashed_password'";
  if (mysqli_query($conn,$sql) == true){
    echo "Passwords hashed successfully";
  }else{
    echo "Passwords hashing unsuccessful <br> Hashed Password:".$hashed_password;
  }

