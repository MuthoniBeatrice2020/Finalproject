<?php
    //require connection file
    require 'root_config.php';
    //admin credentials
    $admin_username = 'admin';
    $admin_password = password_hash('Password123', PASSWORD_BCRYPT);
    $FirstName = 'Tris';
    $LastName = 'Macharia';
    //inserting admin credentials
    try{
        $q = $conn->prepare("INSERT INTO admin (Username, Password, FirstName, LastName) VALUES (:u,:p,:f,:l)");
        $q->bindParam(":u",$admin_username, PDO::PARAM_STR);
        $q->bindParam(":p",$admin_password, PDO::PARAM_STR);
        $q->bindParam(":f",$FirstName, PDO::PARAM_STR);
        $q->bindParam(":l",$LastName, PDO::PARAM_STR);

        if($q->execute()){
            echo '<div class="text-success">Admin table and Admin account created successfully </div>';
        }
    }catch(PDOException $e){
        echo '<div class="text-danger" style="font-size: 20px;">Error creating admin account: ' . $e->getMessage().'</div>';
    }