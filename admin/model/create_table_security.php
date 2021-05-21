<div class="container">
    <?php
        //require connection file
        require 'root_config.php';
        //select table name
        $table = 'security';

        try{

            // create db
            $s="CREATE TABLE IF NOT EXISTS $table (
                ID INT(6) AUTO_INCREMENT PRIMARY KEY, 
                Username VARCHAR(50) UNIQUE KEY NOT NULL ,
                Password VARCHAR(255) NOT NULL , 
                FirstName VARCHAR(50) NOT NULL,
                LastName VARCHAR(50) NOT NULL,
                RegDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP   
            )";
            //use exec() because no results are returned
            $conn->exec($s); 
            echo "TABLE $table CREATED SUCCESSFULLY"; 
            // include 'create_table_students.php';                         
            
        }catch (PDOException $e){
            echo "Table Creation Failed: ".$e->getMessage();
        }
        $conn = null;
    ?>
</div>