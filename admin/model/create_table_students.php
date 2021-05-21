<div class="container">
    <?php
        //require connection file
        require 'root_config.php';
        //select table name
        $table = 'students';

        try{

            // create db
            $s="CREATE TABLE IF NOT EXISTS $table (
                ID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                RegNo VARCHAR(50) NOT NULL UNIQUE KEY,
                FirstName VARCHAR(50) NOT NULL ,
                LastName VARCHAR(50) NOT NULL,
                IDNo VARCHAR(8) NOT NULL UNIQUE KEY,
                Faculty VARCHAR(50) NOT NULL,
                Password VARCHAR(255) NOT NULL , 
                DATETIME TIMESTAMP NOT NULL 
            )";
            //use exec() because no results are returned
            $conn->exec($s);
            echo "TABLE $table CREATED SUCCESSFULLY"; 
            // include 'create_table_devices.php';   
            
                        
            
        }catch (PDOException $e){
            echo "Table Creation Failed: ".$e->getMessage();
        }
        $conn = null;
    ?>
</div>